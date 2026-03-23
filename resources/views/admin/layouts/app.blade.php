<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — @yield('title', 'Panel Admin')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen" style="font-family:'Plus+Jakarta+Sans',sans-serif; background:#F1F5F9;">

<div class="flex min-h-screen" x-data="{ sidebarOpen: false }">

    {{-- Overlay mobile --}}
    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen=false"
         class="fixed inset-0 bg-black/50 z-20 lg:hidden"></div>

    {{-- ── SIDEBAR ── --}}
    <aside class="fixed inset-y-0 left-0 z-30 w-64 flex flex-col transition-transform duration-300 lg:translate-x-0"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           style="background: linear-gradient(160deg, #0c4a6e 0%, #075985 50%, #0369a1 100%);">

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-5 py-5" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
            <div class="w-10 h-10 rounded-2xl flex items-center justify-center flex-shrink-0"
                 style="background: linear-gradient(135deg, #38bdf8, #0ea5e9);">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                          d="M3 10h18M3 14h18M10 3v18M14 3v18"/>
                </svg>
            </div>
            <div>
                <p style="font-family:'Sora',sans-serif; font-weight:700; color:white; font-size:0.875rem; line-height:1.2;">Putri Duyung Waterboom</p>
                <p style="color:#7dd3fc; font-size:0.7rem;">Admin Panel</p>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-3 py-4 overflow-y-auto" style="display:flex; flex-direction:column; gap:2px;">

            @php
            $navItems = [
                ['route'=>'admin.dashboard',    'label'=>'Dashboard',        'match'=>'admin.dashboard',    'icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['route'=>'admin.transactions', 'label'=>'Transaksi',        'match'=>'admin.transactions*','icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                ['route'=>'admin.scan',         'label'=>'Scan Tiket',       'match'=>'admin.scan*',        'icon'=>'M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z'],
                ['route'=>'admin.sessions',     'label'=>'Manajemen Sesi',   'match'=>'admin.sessions*',    'icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['route'=>'admin.reports',      'label'=>'Laporan',          'match'=>'admin.reports*',     'icon'=>'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
            ];
            @endphp

            @foreach($navItems as $item)
            @php $active = request()->routeIs($item['match']); @endphp
            <a href="{{ route($item['route']) }}"
               style="display:flex; align-items:center; gap:12px; padding:10px 14px; border-radius:12px; font-size:0.875rem; font-weight:500; text-decoration:none; transition:all 0.2s;
                      {{ $active
                          ? 'background:rgba(255,255,255,0.18); color:white; box-shadow:0 2px 8px rgba(0,0,0,0.15);'
                          : 'color:rgba(186,230,253,0.85);' }}"
               onmouseover="if(!{{ $active ? 'true' : 'false' }}) { this.style.background='rgba(255,255,255,0.1)'; this.style.color='white'; }"
               onmouseout="if(!{{ $active ? 'true' : 'false' }}) { this.style.background=''; this.style.color='rgba(186,230,253,0.85)'; }">
                <span style="display:flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px; flex-shrink:0;
                             {{ $active ? 'background:rgba(255,255,255,0.2);' : 'background:rgba(255,255,255,0.07);' }}">
                    <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                    </svg>
                </span>
                {{ $item['label'] }}
                @if($active)
                <span style="margin-left:auto; width:6px; height:6px; border-radius:50%; background:#38bdf8; flex-shrink:0;"></span>
                @endif
            </a>
            @endforeach

            {{-- Divider --}}
            <div style="height:1px; background:rgba(255,255,255,0.08); margin:8px 4px;"></div>

            <a href="/" target="_blank"
               style="display:flex; align-items:center; gap:12px; padding:10px 14px; border-radius:12px; font-size:0.875rem; font-weight:500; text-decoration:none; color:rgba(186,230,253,0.7); transition:all 0.2s;"
               onmouseover="this.style.background='rgba(255,255,255,0.08)'; this.style.color='white';"
               onmouseout="this.style.background=''; this.style.color='rgba(186,230,253,0.7)';">
                <span style="display:flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px; background:rgba(255,255,255,0.07); flex-shrink:0;">
                    <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </span>
                Lihat Website
            </a>
        </nav>

        {{-- User info --}}
        <div style="padding:16px; border-top:1px solid rgba(255,255,255,0.1);">
            <div style="display:flex; align-items:center; gap:10px;">
                <div style="width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg,#38bdf8,#0ea5e9); display:flex; align-items:center; justify-content:center; color:white; font-size:0.8rem; font-weight:700; flex-shrink:0;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div style="flex:1; min-width:0;">
                    <p style="color:white; font-size:0.8rem; font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ auth()->user()->name }}</p>
                    <p style="color:#7dd3fc; font-size:0.7rem;">Administrator</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Logout"
                            style="display:flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px; background:rgba(255,255,255,0.07); border:none; cursor:pointer; color:rgba(186,230,253,0.7); transition:all 0.2s;"
                            onmouseover="this.style.background='rgba(239,68,68,0.2)'; this.style.color='#fca5a5';"
                            onmouseout="this.style.background='rgba(255,255,255,0.07)'; this.style.color='rgba(186,230,253,0.7)';">
                        <svg style="width:15px; height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- ── MAIN ── --}}
    <div class="flex-1 flex flex-col min-w-0 lg:ml-64">

        {{-- Topbar --}}
        <header style="position:sticky; top:0; z-index:10; background:white; border-bottom:1px solid #e2e8f0; padding:0 24px; height:64px; display:flex; align-items:center; gap:16px; box-shadow:0 1px 3px rgba(0,0,0,0.05);">
            {{-- Hamburger --}}
            <button @click="sidebarOpen=!sidebarOpen"
                    class="lg:hidden"
                    style="display:flex; align-items:center; justify-content:center; width:36px; height:36px; border-radius:10px; background:#f1f5f9; border:none; cursor:pointer; color:#64748b;">
                <svg style="width:18px; height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Breadcrumb --}}
            <div style="flex:1;">
                <div style="display:flex; align-items:center; gap:6px; margin-bottom:1px;">
                    <span style="color:#94a3b8; font-size:0.7rem;">Admin</span>
                    <svg style="width:10px; height:10px; color:#cbd5e1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span style="color:#64748b; font-size:0.7rem;">@yield('title', 'Dashboard')</span>
                </div>
                <h1 style="font-family:'Sora',sans-serif; font-weight:700; color:#1e293b; font-size:1.1rem; line-height:1.2;">@yield('title', 'Dashboard')</h1>
            </div>

            {{-- Right side --}}
            <div style="display:flex; align-items:center; gap:10px;">
                {{-- Date badge --}}
                <div class="hidden sm:flex" style="align-items:center; gap:6px; background:#f0f9ff; border:1px solid #bae6fd; border-radius:10px; padding:6px 12px;">
                    <svg style="width:13px; height:13px; color:#0ea5e9;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span style="color:#0369a1; font-size:0.75rem; font-weight:500;">{{ now()->translatedFormat('d M Y') }}</span>
                </div>

                {{-- Avatar --}}
                <div style="display:flex; align-items:center; gap:8px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:6px 12px 6px 6px;">
                    <div style="width:28px; height:28px; border-radius:8px; background:linear-gradient(135deg,#38bdf8,#0369a1); display:flex; align-items:center; justify-content:center; color:white; font-size:0.7rem; font-weight:700;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span style="color:#475569; font-size:0.8rem; font-weight:500;">{{ auth()->user()->name }}</span>
                </div>
            </div>
        </header>

        {{-- Flash messages --}}
        @if(session('success'))
        <div style="margin:16px 24px 0; background:#f0fdf4; border:1px solid #bbf7d0; color:#15803d; border-radius:12px; padding:12px 16px; font-size:0.875rem; display:flex; align-items:center; gap:8px;">
            <svg style="width:16px; height:16px; flex-shrink:0;" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        {{-- Content --}}
        <main class="flex-1 p-4 lg:p-6">
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
