<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\SwimSession;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // ── Dashboard ──────────────────────────────────────────────
    public function dashboard()
    {
        $today = today();

        $revenueToday   = Order::whereDate('created_at', $today)->where('status', 'paid')->sum('total_price');
        $ticketsToday   = Order::whereDate('created_at', $today)->where('status', 'paid')->sum(DB::raw('qty_adult + qty_child'));
        $visitorsToday  = Order::whereDate('visit_date', $today)->where('status', 'paid')->sum(DB::raw('qty_adult + qty_child'));
        $transactionsToday = Order::whereDate('created_at', $today)->count();

        // Chart: last 7 days revenue
        $chartData = Order::where('status', 'paid')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        $chartLabels = collect();
        $chartValues = collect();
        for ($i = 6; $i >= 0; $i--) {
            $d = now()->subDays($i)->toDateString();
            $chartLabels->push(now()->subDays($i)->translatedFormat('d M'));
            $chartValues->push($chartData->get($d, 0));
        }

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'revenueToday', 'ticketsToday', 'visitorsToday', 'transactionsToday',
            'chartLabels', 'chartValues', 'recentOrders'
        ));
    }

    // ── Transaksi ──────────────────────────────────────────────
    public function transactions(Request $request)
    {
        $query = Order::with('user')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('order_number', 'like', '%' . $request->search . '%')
                  ->orWhere('name', 'like', '%' . $request->search . '%');
            });
        }

        $orders = $query->paginate(15)->withQueryString();

        return view('admin.transactions', compact('orders'));
    }

    public function transactionDetail(Order $order)
    {
        $order->load('user', 'ticket');
        return view('admin.transaction-detail', compact('order'));
    }

    public function approveTransaction(Order $order)
    {
        abort_if(!in_array($order->status, ['pending_cash', 'pending_payment']), 422);

        if ($order->payment_method === 'online' && !$order->ticket) {
            $ticketCode = Ticket::generateCode();
            $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($ticketCode);
            Ticket::create([
                'order_id' => $order->id,
                'code'     => $ticketCode,
                'qr_code'  => $qrUrl,
                'status'   => 'unused',
            ]);
        }

        $order->update(['status' => 'paid']);

        return back()->with('success', 'Transaksi berhasil di-approve.');
    }

    public function cancelTransaction(Order $order)
    {
        abort_if(!in_array($order->status, ['pending_cash', 'pending_payment']), 422);
        $order->update(['status' => 'cancelled']);
        return back()->with('success', 'Transaksi dibatalkan.');
    }

    // ── Scan Tiket ─────────────────────────────────────────────
    public function scanPage()
    {
        return view('admin.scan');
    }

    public function scanValidate(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $ticket = Ticket::where('code', $request->code)->with('order')->first();

        if (!$ticket) {
            return response()->json(['status' => 'invalid', 'message' => 'Tiket tidak ditemukan.'], 404);
        }

        if ($ticket->status === 'used') {
            return response()->json([
                'status'  => 'used',
                'message' => 'Tiket sudah digunakan.',
                'ticket'  => $this->ticketData($ticket),
            ]);
        }

        $ticket->update(['status' => 'used']);

        return response()->json([
            'status'  => 'valid',
            'message' => 'Tiket valid. Selamat datang!',
            'ticket'  => $this->ticketData($ticket),
        ]);
    }

    public function scanRevert(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $ticket = Ticket::where('code', $request->code)->with('order')->first();

        if (!$ticket) {
            return response()->json(['status' => 'error', 'message' => 'Tiket tidak ditemukan.'], 404);
        }

        if ($ticket->status !== 'used') {
            return response()->json(['status' => 'error', 'message' => 'Tiket belum di-scan, tidak perlu dibatalkan.'], 422);
        }

        $ticket->update(['status' => 'unused']);

        return response()->json([
            'status'  => 'reverted',
            'message' => 'Scan berhasil dibatalkan. Tiket kembali ke status belum digunakan.',
        ]);
    }

    public function resetTicketScan(Ticket $ticket)
    {
        abort_if($ticket->status !== 'used', 422, 'Tiket belum digunakan.');

        $ticket->update(['status' => 'unused']);

        return back()->with('success', 'Tiket berhasil direset. Pengunjung bisa scan ulang.');
    }    private function ticketData(Ticket $ticket): array
    {
        return [
            'code'         => $ticket->code,
            'order_number' => $ticket->order->order_number,
            'name'         => $ticket->order->name,
            'visit_date'   => $ticket->order->visit_date->format('d M Y'),
            'session'      => $ticket->order->session_label,
            'qty'          => $ticket->order->total_qty,
            'ticket_status'=> $ticket->status,
        ];
    }

    // ── Sesi ───────────────────────────────────────────────────
    public function sessions()
    {
        $sessions = SwimSession::orderBy('start_time')->get();
        return view('admin.sessions', compact('sessions'));
    }

    public function storeSession(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:100',
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time',
            'price'      => 'required|integer|min:0',
            'quota'      => 'required|integer|min:1',
        ]);

        SwimSession::create($data);
        return back()->with('success', 'Sesi berhasil ditambahkan.');
    }

    public function updateSession(Request $request, SwimSession $session)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:100',
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time',
            'price'      => 'required|integer|min:0',
            'quota'      => 'required|integer|min:1',
            'is_active'  => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $session->update($data);
        return back()->with('success', 'Sesi berhasil diperbarui.');
    }

    public function destroySession(SwimSession $session)
    {
        $session->delete();
        return back()->with('success', 'Sesi berhasil dihapus.');
    }

    // ── Laporan ────────────────────────────────────────────────
    public function reports(Request $request)
    {
        $period = $request->get('period', 'daily');
        $from   = $request->get('from', now()->startOfMonth()->toDateString());
        $to     = $request->get('to', now()->toDateString());

        $query = Order::where('status', 'paid')
            ->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);

        if ($period === 'monthly') {
            $rows = $query->selectRaw("strftime('%Y-%m', created_at) as period, SUM(total_price) as revenue, COUNT(*) as transactions, SUM(qty_adult + qty_child) as tickets")
                ->groupBy('period')->orderBy('period')->get();
        } else {
            $rows = $query->selectRaw("DATE(created_at) as period, SUM(total_price) as revenue, COUNT(*) as transactions, SUM(qty_adult + qty_child) as tickets")
                ->groupBy('period')->orderBy('period')->get();
        }

        $totalRevenue      = $rows->sum('revenue');
        $totalTransactions = $rows->sum('transactions');
        $totalTickets      = $rows->sum('tickets');

        return view('admin.reports', compact('rows', 'period', 'from', 'to', 'totalRevenue', 'totalTransactions', 'totalTickets'));
    }

    public function exportCsv(Request $request)
    {
        $from = $request->get('from', now()->startOfMonth()->toDateString());
        $to   = $request->get('to', now()->toDateString());

        $orders = Order::where('status', 'paid')
            ->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
            ->with('user')
            ->get();

        $filename = 'laporan-' . $from . '-sd-' . $to . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($orders) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['No. Pesanan', 'Nama', 'Tanggal Kunjungan', 'Sesi', 'Metode', 'Qty', 'Total', 'Tanggal Transaksi']);
            foreach ($orders as $o) {
                fputcsv($handle, [
                    $o->order_number,
                    $o->name,
                    $o->visit_date->format('d/m/Y'),
                    $o->session_label,
                    strtoupper($o->payment_method),
                    $o->total_qty,
                    $o->total_price,
                    $o->created_at->format('d/m/Y H:i'),
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
