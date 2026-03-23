@extends('admin.layouts.app')
@section('title', 'Laporan Penjualan')
@section('breadcrumb', 'Ringkasan pendapatan dan transaksi')

@section('content')
{{-- Filter --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-4">
    <form method="GET" class="flex flex-wrap gap-3 items-end">
        <div>
            <label class="block text-xs text-slate-500 mb-1">Periode</label>
            <select name="period" class="border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                <option value="daily"   {{ $period==='daily'   ? 'selected':'' }}>Harian</option>
                <option value="monthly" {{ $period==='monthly' ? 'selected':'' }}>Bulanan</option>
            </select>
        </div>
        <div>
            <label class="block text-xs text-slate-500 mb-1">Dari</label>
            <input type="date" name="from" value="{{ $from }}"
                   class="border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <div>
            <label class="block text-xs text-slate-500 mb-1">Sampai</label>
            <input type="date" name="to" value="{{ $to }}"
                   class="border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
        </div>
        <button type="submit" class="px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-xl text-sm font-medium transition-colors">Tampilkan</button>
        <a href="{{ route('admin.reports.export', ['from'=>$from,'to'=>$to]) }}"
           class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-sm font-medium transition-colors flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            Export CSV
        </a>
    </form>
</div>

{{-- Summary Cards --}}
<div class="grid grid-cols-3 gap-4 mb-4">
    @php
    $summaries = [
        ['label'=>'Total Pendapatan','value'=>'Rp '.number_format($totalRevenue,0,',','.'),'color'=>'text-sky-600'],
        ['label'=>'Total Transaksi','value'=>$totalTransactions.' transaksi','color'=>'text-violet-600'],
        ['label'=>'Total Tiket','value'=>$totalTickets.' tiket','color'=>'text-emerald-600'],
    ];
    @endphp
    @foreach($summaries as $s)
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 text-center">
        <p class="text-xs text-slate-500 mb-1">{{ $s['label'] }}</p>
        <p class="font-heading font-bold text-lg {{ $s['color'] }}">{{ $s['value'] }}</p>
    </div>
    @endforeach
</div>

{{-- Chart --}}
@if($rows->count())
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 mb-4">
    <h3 class="font-heading font-semibold text-slate-700 mb-4">Grafik Pendapatan</h3>
    <canvas id="reportChart" height="80"></canvas>
</div>
@endif

{{-- Table --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Periode</th>
                    <th class="text-right px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Transaksi</th>
                    <th class="text-right px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Tiket</th>
                    <th class="text-right px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Pendapatan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($rows as $row)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-4 py-3 text-slate-700 font-medium">{{ $row->period }}</td>
                    <td class="px-4 py-3 text-right text-slate-600">{{ $row->transactions }}</td>
                    <td class="px-4 py-3 text-right text-slate-600">{{ $row->tickets }}</td>
                    <td class="px-4 py-3 text-right font-semibold text-sky-600">Rp {{ number_format($row->revenue,0,',','.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-12 text-center text-slate-400">Tidak ada data untuk periode ini.</td>
                </tr>
                @endforelse
            </tbody>
            @if($rows->count())
            <tfoot>
                <tr class="bg-slate-50 border-t-2 border-slate-200">
                    <td class="px-4 py-3 font-bold text-slate-700">Total</td>
                    <td class="px-4 py-3 text-right font-bold text-slate-700">{{ $totalTransactions }}</td>
                    <td class="px-4 py-3 text-right font-bold text-slate-700">{{ $totalTickets }}</td>
                    <td class="px-4 py-3 text-right font-bold text-sky-600">Rp {{ number_format($totalRevenue,0,',','.') }}</td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>
@endsection

@push('scripts')
@if($rows->count())
<script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
<script>
new Chart(document.getElementById('reportChart'), {
    type: 'line',
    data: {
        labels: {!! json_encode($rows->pluck('period')) !!},
        datasets: [{
            label: 'Pendapatan',
            data: {!! json_encode($rows->pluck('revenue')) !!},
            borderColor: '#0EA5E9',
            backgroundColor: 'rgba(14,165,233,0.08)',
            borderWidth: 2,
            pointBackgroundColor: '#0EA5E9',
            pointRadius: 4,
            fill: true,
            tension: 0.4,
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
@endif
@endpush
