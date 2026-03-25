<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\QrCode as QrCodeGenerator;
use Endroid\QrCode\Writer\SvgWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function __construct()
    {
        MidtransConfig::$serverKey    = config('services.midtrans.server_key');
        MidtransConfig::$isProduction = config('services.midtrans.is_production');
        MidtransConfig::$isSanitized  = true;
        MidtransConfig::$is3ds        = true;
    }

    public function index()
    {
        $orders = Auth::user()->orders()->with('ticket')->latest()->get();
        return view('pesanan', compact('orders'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'visit_date'     => 'required|date|after_or_equal:today',
            'session'        => 'required|in:1,2,3',
            'ticket_type'    => 'required|in:weekday,weekend',
            'qty_adult'      => 'required|integer|min:0',
            'qty_child'      => 'required|integer|min:0',
            'name'           => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'email'          => 'nullable|email',
            'notes'          => 'nullable|string|max:500',
            'payment_method' => 'required|in:cash,online',
        ]);

        if ($data['qty_adult'] + $data['qty_child'] < 1) {
            return back()->withErrors(['qty' => 'Minimal 1 tiket.'])->withInput();
        }

        $price  = $data['ticket_type'] === 'weekday' ? 25000 : 35000;
        $total  = ($data['qty_adult'] + $data['qty_child']) * $price;
        $status = $data['payment_method'] === 'cash' ? 'pending_cash' : 'pending_payment';

        $order = Order::create([
            ...$data,
            'user_id'          => Auth::id(),
            'order_number'     => Order::generateOrderNumber(),
            'price_per_ticket' => $price,
            'total_price'      => $total,
            'status'           => $status,
        ]);

        // Jika online, langsung buat Snap token
        if ($data['payment_method'] === 'online') {
            $snapToken = $this->createSnapToken($order);
            if ($snapToken) {
                $order->update(['snap_token' => $snapToken]);
            }
            return redirect()->route('pesanan')->with('success', $order->order_number);
        }

        return redirect('/pesanan')->with('success', $order->order_number);
    }

    public function update(Request $request, Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);
        abort_if(!in_array($order->status, ['pending_cash', 'pending_payment']), 422, 'Hanya pesanan pending yang bisa diedit.');

        $data = $request->validate([
            'visit_date'  => 'required|date|after_or_equal:today',
            'session'     => 'required|in:1,2,3',
            'ticket_type' => 'required|in:weekday,weekend',
            'qty_adult'   => 'required|integer|min:0',
            'qty_child'   => 'required|integer|min:0',
            'name'        => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
            'email'       => 'nullable|email',
            'notes'       => 'nullable|string|max:500',
        ]);

        if ($data['qty_adult'] + $data['qty_child'] < 1) {
            return back()->withErrors(['qty' => 'Minimal 1 tiket.']);
        }

        $price = $data['ticket_type'] === 'weekday' ? 25000 : 35000;
        $total = ($data['qty_adult'] + $data['qty_child']) * $price;

        $order->update([
            ...$data,
            'price_per_ticket' => $price,
            'total_price'      => $total,
            'snap_token'       => null, // reset token jika order diedit
        ]);

        // Buat ulang snap token jika payment method online
        if ($order->payment_method === 'online') {
            $snapToken = $this->createSnapToken($order->fresh());
            if ($snapToken) {
                $order->update(['snap_token' => $snapToken]);
            }
        }

        return back()->with('updated', $order->order_number);
    }

    public function cancel(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);
        abort_if(!in_array($order->status, ['pending_cash', 'pending_payment']), 422);

        $order->update(['status' => 'cancelled']);
        return back()->with('cancelled', true);
    }

    /**
     * Endpoint untuk mendapatkan Snap token (dipanggil via AJAX dari pesanan.blade.php)
     */
    public function getSnapToken(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);
        abort_if($order->status !== 'pending_payment', 422);

        // Gunakan token yang sudah ada jika masih ada
        if ($order->snap_token) {
            return response()->json(['token' => $order->snap_token]);
        }

        $token = $this->createSnapToken($order);
        if (!$token) {
            return response()->json(['error' => 'Gagal membuat token pembayaran.'], 500);
        }

        $order->update(['snap_token' => $token]);
        return response()->json(['token' => $token]);
    }

    /**
     * Webhook dari Midtrans — tidak perlu auth, tapi diverifikasi signature-nya
     */
    public function notification(Request $request)
    {
        $payload = $request->all();

        // Verifikasi signature key dari Midtrans
        $orderId           = $payload['order_id'] ?? '';
        $statusCode        = $payload['status_code'] ?? '';
        $grossAmount       = $payload['gross_amount'] ?? '';
        $serverKey         = config('services.midtrans.server_key');
        $signatureKey      = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if ($signatureKey !== ($payload['signature_key'] ?? '')) {
            Log::warning('Midtrans: signature tidak valid', ['order_id' => $orderId]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $order = Order::where('order_number', $orderId)->first();
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $transactionStatus = $payload['transaction_status'] ?? '';
        $fraudStatus       = $payload['fraud_status'] ?? '';
        $transactionId     = $payload['transaction_id'] ?? null;

        $order->update(['midtrans_transaction_id' => $transactionId]);

        if ($transactionStatus === 'capture') {
            if ($fraudStatus === 'accept') {
                $this->markAsPaid($order);
            }
        } elseif ($transactionStatus === 'settlement') {
            $this->markAsPaid($order);
        } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
            $order->update(['status' => 'cancelled']);
        }

        return response()->json(['message' => 'OK']);
    }

    /**
     * Halaman sukses setelah bayar (redirect dari Midtrans)
     */
    public function paymentSuccess(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);
        return redirect()->route('pesanan')->with('paid', $order->order_number);
    }

    public function downloadPdf(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);

        $order->load('ticket');
        $ticket = $order->ticket;

        if ($ticket) {
            $qrCode = new QrCodeGenerator(data: $ticket->code, size: 300, margin: 0);
            $writer = new SvgWriter();
            $result = $writer->write($qrCode);
            $ticket->qr_svg = 'data:image/svg+xml;base64,' . base64_encode($result->getString());
        }

        $pdf = Pdf::loadView('ticket.pdf', compact('order', 'ticket'))
            ->setPaper([0, 0, 595, 350], 'landscape')
            ->setOption('margin_top', 0)
            ->setOption('margin_bottom', 0)
            ->setOption('margin_left', 0)
            ->setOption('margin_right', 0)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', false);

        return $pdf->download('tiket-' . $order->order_number . '.pdf');
    }

    // ─── Private helpers ────────────────────────────────────────────────────────

    private function createSnapToken(Order $order): ?string
    {
        try {
            $params = [
                'transaction_details' => [
                    'order_id'     => $order->order_number,
                    'gross_amount' => $order->total_price,
                ],
                'customer_details' => [
                    'first_name' => $order->name,
                    'phone'      => $order->phone,
                    'email'      => $order->email ?? 'noreply@putriduyung.com',
                ],
                'item_details' => [
                    [
                        'id'       => $order->ticket_type,
                        'price'    => $order->price_per_ticket,
                        'quantity' => $order->qty_adult + $order->qty_child,
                        'name'     => 'Tiket ' . ucfirst($order->ticket_type) . ' — Sesi ' . $order->session,
                    ],
                ],
                'callbacks' => [
                    'finish' => route('payment.success', $order),
                ],
            ];

            return Snap::getSnapToken($params);
        } catch (\Exception $e) {
            Log::error('Midtrans Snap token error: ' . $e->getMessage());
            return null;
        }
    }

    private function markAsPaid(Order $order): void
    {
        if ($order->status === 'paid') return;

        $ticketCode = Ticket::generateCode();
        $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($ticketCode);

        Ticket::create([
            'order_id' => $order->id,
            'code'     => $ticketCode,
            'qr_code'  => $qrUrl,
            'status'   => 'unused',
        ]);

        $order->update(['status' => 'paid']);
    }
}
