@extends('admin.layouts.app')
@section('title', 'Transaksi')
@section('breadcrumb', 'Kelola semua transaksi')

@section('content')
{{-- Filter --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-4">
    <form method="GET" class="flex flex-wrap gap-3 items-end">
        <div>
            <label class="block text-xs text-slate-500 mb-1">Cari</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="No. pesanan / nama..."
                   class="border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300 w-48">
        </div>
        <div>
            <label class="block text-xs text-slate-500 mb-1">Status</label>
            <select name="status" class="border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                <option value="">Semua</option>
                <option value="pending_cash"    {{ request('status')=='pending_cash'    ? 'selected':'' }}>Pending Cash</option>
                <option value="pending_payment" {{ request('status')=='pending_payment' ? 'selected':'' }}>Pending Online</option>
                <option value="paid"            {{ request('status')=='paid'            ? 'selected':'' }}>Paid</option>
                <option value="cancelled"       {{ request('status')=='cancelled'       ? 'selected':'' }}>Cancelled</option>
            </select>
        </div>
        <div>
            <label class="block text-xs text-slate-500 mb-1">Tanggal</label>
            <input type="date" name="date" value="{{ request('date') }}"
                   class="border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <button type="submit" class="px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-xl text-sm font-medium transition-colors">Filter</button>
        <a href="{{ route('admin.transactions') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-sm font-medium transition-colors">Reset</a>
    </form>
</div>

{{-- Table --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">No. Pesanan</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Nama</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide hidden md:table-cell">Tanggal</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide hidden lg:table-cell">Sesi</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide hidden md:table-cell">Metode</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide hidden lg:table-cell">Total</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Status</th>
                    <th class="text-right px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($orders as $order)
                @php
                $badge = match($order->status) {
                    'paid'            => 'bg-emerald-100 text-emerald-700',
                    'pending_cash'    => 'bg-amber-100 text-amber-700',
                    'pending_payment' => 'bg-sky-100 text-sky-700',
                    'cancelled'       => 'bg-red-100 text-red-700',
                    default           => 'bg-slate-100 text-slate-600',
                };
                $statusLabel = match($order->status) {
                    'paid'            => 'Paid',
                    'pending_cash'    => 'Pending Cash',
                    'pending_payment' => 'Pending Online',
                    'cancelled'       => 'Cancelled',
                    default           => $order->status,
                };
                @endphp
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-4 py-3 font-mono text-xs text-slate-600">{{ $order->order_number }}</td>
                    <td class="px-4 py-3">
                        <p class="font-medium text-slate-800">{{ $order->name }}</p>
                        <p class="text-xs text-slate-400">{{ $order->phone }}</p>
                    </td>
                    <td class="px-4 py-3 text-slate-600 hidden md:table-cell">{{ $order->visit_date->format('d M Y') }}</td>
                    <td class="px-4 py-3 text-slate-600 hidden lg:table-cell text-xs">{{ $order->session_label }}</td>
                    <td class="px-4 py-3 hidden md:table-cell">
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $order->payment_method === 'cash' ? 'bg-slate-100 text-slate-600' : 'bg-blue-100 text-blue-700' }}">
                            {{ strtoupper($order->payment_method) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-slate-700 font-medium hidden lg:table-cell">Rp {{ number_format($order->total_price,0,',','.') }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $badge }}">{{ $statusLabel }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.transactions.detail', $order) }}"
                               class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-xs font-medium transition-colors">Detail</a>
                            @if(in_array($order->status, ['pending_cash','pending_payment']))
                            <form method="POST" action="{{ route('admin.transactions.approve', $order) }}" class="inline">
                                @csrf
                                <button type="submit" class="px-3 py-1.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg text-xs font-medium transition-colors">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('admin.transactions.cancel', $order) }}" class="inline"
                                  onsubmit="return confirm('Batalkan transaksi ini?')">
                                @csrf
                                <button type="submit" class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-xs font-medium transition-colors">Batal</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 py-12 text-center text-slate-400">Tidak ada transaksi ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="px-4 py-3 border-t border-slate-100">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
