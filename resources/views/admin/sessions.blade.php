@extends('admin.layouts.app')
@section('title', 'Manajemen Sesi')
@section('breadcrumb', 'Kelola sesi kunjungan kolam renang')

@section('content')
<div class="grid lg:grid-cols-3 gap-4">
    {{-- Form Tambah --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
        <h3 class="font-heading font-semibold text-slate-700 mb-4">Tambah Sesi Baru</h3>
        <form method="POST" action="{{ route('admin.sessions.store') }}" class="space-y-3">
            @csrf
            <div>
                <label class="block text-xs text-slate-500 mb-1">Nama Sesi</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="cth: Sesi Pagi"
                       class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300 @error('name') border-red-300 @enderror">
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label class="block text-xs text-slate-500 mb-1">Jam Mulai</label>
                    <input type="time" name="start_time" value="{{ old('start_time') }}"
                           class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                    @error('start_time')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs text-slate-500 mb-1">Jam Selesai</label>
                    <input type="time" name="end_time" value="{{ old('end_time') }}"
                           class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                    @error('end_time')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div>
                <label class="block text-xs text-slate-500 mb-1">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price') }}" placeholder="25000"
                       class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs text-slate-500 mb-1">Kuota</label>
                <input type="number" name="quota" value="{{ old('quota') }}" placeholder="100"
                       class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                @error('quota')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="w-full py-2.5 bg-sky-500 hover:bg-sky-600 text-white rounded-xl text-sm font-medium transition-colors">
                + Tambah Sesi
            </button>
        </form>
    </div>

    {{-- List Sesi --}}
    <div class="lg:col-span-2 space-y-3">
        @forelse($sessions as $session)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5" x-data="{ editing: false }">
            {{-- View mode --}}
            <div x-show="!editing">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <h4 class="font-heading font-semibold text-slate-800">{{ $session->name }}</h4>
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $session->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                {{ $session->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-4 text-sm text-slate-600">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ \Carbon\Carbon::parse($session->start_time)->format('H:i') }} – {{ \Carbon\Carbon::parse($session->end_time)->format('H:i') }} WIB
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Rp {{ number_format($session->price,0,',','.') }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Kuota: {{ $session->quota }}
                            </span>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button @click="editing=true" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-xs font-medium transition-colors">Edit</button>
                        <form method="POST" action="{{ route('admin.sessions.destroy', $session) }}"
                              onsubmit="return confirm('Hapus sesi ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg text-xs font-medium transition-colors">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Edit mode --}}
            <div x-show="editing" x-cloak>
                <form method="POST" action="{{ route('admin.sessions.update', $session) }}" class="space-y-3">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-2 gap-3">
                        <div class="col-span-2">
                            <label class="block text-xs text-slate-500 mb-1">Nama Sesi</label>
                            <input type="text" name="name" value="{{ $session->name }}"
                                   class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                        <div>
                            <label class="block text-xs text-slate-500 mb-1">Jam Mulai</label>
                            <input type="time" name="start_time" value="{{ \Carbon\Carbon::parse($session->start_time)->format('H:i') }}"
                                   class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                        <div>
                            <label class="block text-xs text-slate-500 mb-1">Jam Selesai</label>
                            <input type="time" name="end_time" value="{{ \Carbon\Carbon::parse($session->end_time)->format('H:i') }}"
                                   class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                        <div>
                            <label class="block text-xs text-slate-500 mb-1">Harga (Rp)</label>
                            <input type="number" name="price" value="{{ $session->price }}"
                                   class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                        <div>
                            <label class="block text-xs text-slate-500 mb-1">Kuota</label>
                            <input type="number" name="quota" value="{{ $session->quota }}"
                                   class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                        </div>
                        <div class="col-span-2 flex items-center gap-2">
                            <input type="checkbox" name="is_active" id="active_{{ $session->id }}" value="1" {{ $session->is_active ? 'checked' : '' }}
                                   class="rounded border-slate-300 text-sky-500 focus:ring-sky-300">
                            <label for="active_{{ $session->id }}" class="text-sm text-slate-600">Sesi Aktif</label>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-xl text-sm font-medium transition-colors">Simpan</button>
                        <button type="button" @click="editing=false" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-sm font-medium transition-colors">Batal</button>
                    </div>
                </form>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-12 text-center">
            <p class="text-slate-400">Belum ada sesi. Tambahkan sesi pertama.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
