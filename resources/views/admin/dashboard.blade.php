@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('breadcrumb', 'Selamat datang, ' . auth()->user()->name)

@section('content')
{{-- Stat Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    @php
    $cards = [
        ['label'=>'Pendapatan Hari Ini','value'=>'Rp '.number_format($revenueToday,0,',','.'),'icon'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z','color'=>'from-sky-500 to-sky-600'],
        ['label'=>'Tiket Terjual','value'=>$ticketsToday.' tiket','icon'=>'M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z','color'=>'from-emerald-500 to-emerald-600'],
        ['label'=>'Pengunjung Hari Ini','value'=>$visitorsToday.' orang','icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z','color'=>'from-violet-500 to-violet-600'],
        ['label'=>'Total Transaksi','value'=>$transactionsToday.' transaksi','icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2','color'=>'from-amber-500 to-amber-600'],
    ];
    @endphp

    @foreach($cards as $card)
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $card['color'] }} flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}"/>
            </svg>
        </div>
        <div>
            <p class="text-slate-500 text-xs">{{ $card['label'] }}</p>
            <p class="font-heading font-bold text-slate-800 text-lg leading-tight">{{ $card['value'] }}</p>
        </div>
    </div>
    @endforeach
</div>

<div class="grid lg:grid-cols-3 gap-4">
    {{-- Chart --}}
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
        <h3 class="font-heading font-semibold text-slate-700 mb-4">Pendapatan 7 Hari Terakhir</h3>
        <canvas id="revenueChart" height="100"></canvas>
    </div>

    {{-- Recent Orders --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-heading font-semibold text-slate-700">Transaksi Terbaru</h3>
            <a href="{{ route('admin.transactions') }}" class="text-sky-600 text-xs hover:underline">Lihat semua</a>
        </div>
        <div class="space-y-3">
            @forelse($recentOrders as $order)
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-sky-100 flex items-center justify-center text-sky-700 text-xs font-bold flex-shrink-0">
                    {{ strtoupper(substr($order->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-700 truncate">{{ $order->name }}</p>
                    <p class="text-xs text-slate-400">{{ $order->order_number }}</p>
                </div>
                @php
                $badge = match($order->status) {
                    'paid'            => 'bg-emerald-100 text-emerald-700',
                    'pending_cash'    => 'bg-amber-100 text-amber-700',
                    'pending_payment' => 'bg-sky-100 text-sky-700',
                    default           => 'bg-red-100 text-red-700',
                };
                $label = match($order->status) {
                    'paid'            => 'Paid',
                    'pending_cash'    => 'Cash',
                    'pending_payment' => 'Online',
                    default           => 'Batal',
                };
                @endphp
                <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $badge }}">{{ $label }}</span>
            </div>
            @empty
            <p class="text-slate-400 text-sm text-center py-4">Belum ada transaksi.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
<script>
const ctx = document.getElementById('revenueChart');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [{
            label: 'Pendapatan (Rp)',
            data: {!! json_encode($chartValues) !!},
            backgroundColor: 'rgba(14,165,233,0.15)',
            borderColor: '#0EA5E9',
            borderWidth: 2,
            borderRadius: 8,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: {
                beginAtZero: true,
                grid: { color: '#f1f5f9' },
                ticks: { callback: v => 'Rp ' + (v/1000).toFixed(0) + 'k', font: { size: 11 } }
            },
            x: { grid: { display: false }, ticks: { font: { size: 11 } } }
        }
    }
});
</script>
@endpush
