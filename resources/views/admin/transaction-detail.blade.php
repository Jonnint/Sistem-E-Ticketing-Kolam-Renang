@extends('admin.layouts.app')
@section('title', 'Detail Transaksi')
@section('breadcrumb', $order->order_number)

@section('content')
<div class="max-w-3xl">
    <a href="{{ route('admin.transactions') }}" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-sky-600 mb-4 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>

    <div class="grid md:grid-cols-2 gap-4">
        {{-- Order Info --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
            <h3 class="font-heading font-semibold text-slate-700 mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Info Pesanan
            </h3>
            @php
            $badge = match($order->status) {
                'paid'            => 'bg-emerald-100 text-emerald-700',
                'pending_cash'    => 'bg-amber-100 text-amber-700',
                'pending_payment' => 'bg-sky-100 text-sky-700',
                'cancelled'       => 'bg-red-100 text-red-700',
                default           => 'bg-slate-100 text-slate-600',
            };
            @endphp
            <dl class="space-y-3 text-sm">
                <div class="flex justify-between"><dt class="text-slate-500">No. Pesanan</dt><dd class="font-mono font-medium text-slate-700">{{ $order->order_number }}</dd></div>
                <div class="flex justify-between"><dt class="text-slate-500">Status</dt><dd><span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $badge }}">{{ $order->status }}</span></dd></div>
                <div class="flex justify-between"><dt class="text-slate-500">Tanggal Kunjungan</dt><dd class="text-slate-700">{{ $order->visit_date->format('d M Y') }}</dd></div>
                <div class="flex justify-between"><dt class="text-slate-500">Sesi</dt><dd class="text-slate-700 text-right">{{ $order->session_label }}</dd></div>
                <div class="flex justify-between"><dt class="text-slate-500">Jenis Tiket</dt><dd class="text-slate-700 capitalize">{{ $order->ticket_type }}</dd></div>
                <div class="flex justify-between"><dt class="text-slate-500">Dewasa</dt><dd class="text-slate-700">{{ $order->qty_adult }} orang</dd></div>
                <div class="flex justify-between"><dt class="text-slate-500">Anak</dt><dd class="text-slate-700">{{ $order->qty_child }} orang</dd></div>
                <div class="flex justify-between"><dt class="text-slate-500">Harga/Tiket</dt><dd class="text-slate-700">Rp {{ number_format($order->price_per_ticket,0,',','.') }}</dd></div>
                <div class="flex justify-between border-t border-slate-100 pt-3"><dt class="font-semibold text-slate-700">Total</dt><dd class="font-bold text-sky-600">Rp {{ number_format($order->total_price,0,',','.') }}</dd></div>
                <div class="flex justify-between"><dt class="text-slate-500">Metode Bayar</dt><dd class="text-slate-700 uppercase">{{ $order->payment_method }}</dd></div>
                <div class="flex justify-between"><dt class="text-slate-500">Dibuat</dt><dd class="text-slate-700">{{ $order->created_at->format('d M Y H:i') }}</dd></div>
            </dl>
        </div>

        <div class="space-y-4">
            {{-- Customer Info --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
                <h3 class="font-heading font-semibold text-slate-700 mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Data Pemesan
                </h3>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between"><dt class="text-slate-500">Nama</dt><dd class="text-slate-700 font-medium">{{ $order->name }}</dd></div>
                    <div class="flex justify-between"><dt class="text-slate-500">Telepon</dt><dd class="text-slate-700">{{ $order->phone }}</dd></div>
                    <div class="flex justify-between"><dt class="text-slate-500">Email</dt><dd class="text-slate-700">{{ $order->email ?? '-' }}</dd></div>
                    @if($order->notes)
                    <div class="pt-2 border-t border-slate-100"><dt class="text-slate-500 mb-1">Catatan</dt><dd class="text-slate-700 text-xs bg-slate-50 rounded-lg p-2">{{ $order->notes }}</dd></div>
                    @endif
                </dl>
            </div>

            {{-- Ticket / QR --}}
            @if($order->ticket)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
                <h3 class="font-heading font-semibold text-slate-700 mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                    Tiket
                </h3>
                <div class="flex items-start gap-4">
                    <img src="{{ $order->ticket->qr_code }}" alt="QR Code" class="w-24 h-24 rounded-xl border border-slate-200 flex-shrink-0">
                    <div class="flex-1 space-y-2">
                        <p class="font-mono text-xs text-slate-500">{{ $order->ticket->code }}</p>
                        @if($order->ticket->status === 'used')
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                                Sudah Digunakan
                            </span>
                            <form method="POST"
                                  action="{{ route('admin.tickets.resetScan', $order->ticket) }}"
                                  onsubmit="return confirm('Reset tiket ini?\nStatus akan kembali ke belum digunakan dan bisa di-scan ulang.')">
                                @csrf
                                <button type="submit"
                                        class="mt-1 flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg border border-amber-300 bg-amber-50 text-amber-700 hover:bg-amber-100 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                    Reset — Bisa Scan Ulang
                                </button>
                            </form>
                        @else
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Belum Digunakan
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            {{-- Actions --}}
            @if(in_array($order->status, ['pending_cash','pending_payment']))
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
                <h3 class="font-heading font-semibold text-slate-700 mb-3">Aksi</h3>
                <div class="flex gap-3">
                    <form method="POST" action="{{ route('admin.transactions.approve', $order) }}" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-sm font-medium transition-colors">
                            ✓ Approve Pembayaran
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.transactions.cancel', $order) }}" class="flex-1"
                          onsubmit="return confirm('Batalkan transaksi ini?')">
                        @csrf
                        <button type="submit" class="w-full py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-xl text-sm font-medium transition-colors">
                            ✕ Batalkan
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
