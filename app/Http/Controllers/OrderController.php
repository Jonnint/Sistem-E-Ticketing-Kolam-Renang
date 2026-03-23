<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
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
        ]);

        return back()->with('updated', $order->order_number);
    }

    public function cancel(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);
        abort_if(!in_array($order->status, ['pending_cash', 'pending_payment']), 422);

        $order->update(['status' => 'cancelled']);
        return back()->with('cancelled', true);
    }

    public function pay(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);
        abort_if($order->status !== 'pending_payment', 422, 'Pesanan tidak bisa dibayar.');

        $ticketCode = Ticket::generateCode();
        // QR code via free API — no PHP extension needed
        $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($ticketCode);

        Ticket::create([
            'order_id' => $order->id,
            'code'     => $ticketCode,
            'qr_code'  => $qrUrl,
            'status'   => 'unused',
        ]);

        $order->update(['status' => 'paid']);

        return back()->with('paid', $order->order_number);
    }

    public function downloadPdf(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);

        $order->load('ticket');
        $ticket = $order->ticket;

        if ($ticket) {
            // Use QR server API with base64 embed
            $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($ticket->code);
            $ticket->qr_url = $qrUrl;
        }

        $pdf = Pdf::loadView('ticket.pdf', compact('order', 'ticket'))
            ->setPaper([0, 0, 595, 350], 'landscape')
            ->setOption('margin_top', 0)
            ->setOption('margin_bottom', 0)
            ->setOption('margin_left', 0)
            ->setOption('margin_right', 0)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);

        return $pdf->download('tiket-' . $order->order_number . '.pdf');
    }
}
