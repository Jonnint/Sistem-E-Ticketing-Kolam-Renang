<!DOCTYPE html>
<html lang="id" style="overflow-x:hidden;max-width:100vw;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Putri Duyung Waterboom Depok — E-Ticketing Online</title>
    <meta name="description" content="Pesan tiket Putri Duyung Waterboom Depok secara online. Jl. Bungsan No.50 Sawangan Depok. Buka setiap hari 08.00–17.00 WIB.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, .font-heading { font-family: 'Sora', sans-serif; }

        .hero-bg {
            background-image:
                linear-gradient(135deg, rgba(2,15,50,0.90) 0%, rgba(0,70,140,0.75) 55%, rgba(0,160,210,0.40) 100%),
                url('https://putriduyungwaterboom.com/wp-content/uploads/2021/04/Kolam-Anak-Putri-Duyung-Waterboom-Depok-5.jpeg');
            background-size: cover;
            background-position: center 40%;
        }
        .glass {
            background: rgba(255,255,255,0.10);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.18);
        }
        .glass-card {
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .btn-primary {
            background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);
            transition: all 0.3s cubic-bezier(.4,0,.2,1);
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 14px 36px rgba(14,165,233,0.45); }
        .btn-ghost {
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(8px);
            border: 1.5px solid rgba(255,255,255,0.35);
            transition: all 0.3s ease;
        }
        .btn-ghost:hover { background: rgba(255,255,255,0.22); transform: translateY(-2px); }
        .card-hover { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card-hover:hover { transform: translateY(-6px); box-shadow: 0 24px 52px rgba(0,0,0,0.11); }
        .floating { animation: float 5s ease-in-out infinite; }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
        .nav-link { transition: color 0.2s; }
        .nav-link:hover { color: #38bdf8; }
        select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; }
        .wave { line-height: 0; }
        .img-cover { object-fit: cover; width: 100%; height: 100%; }
        .badge-pulse { animation: pulse 2s cubic-bezier(.4,0,.6,1) infinite; }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.5} }

        /* ── Mobile menu ── */
        #mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(.4,0,.2,1), opacity 0.3s ease;
            opacity: 0;
            width: 100%;
        }
        #mobile-menu.open {
            max-height: 400px;
            opacity: 1;
        }
        #navbar {
            width: 100%;
            max-width: 100vw;
            overflow-x: hidden;
        }
        /* Hamburger bars */
        .bar { display:block; width:20px; height:2px; background:white; border-radius:2px; transition: all 0.3s cubic-bezier(.4,0,.2,1); }
        #hamburger { position: relative; }
        #hamburger.open .bar:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        #hamburger.open .bar:nth-child(2) { opacity: 0; transform: scaleX(0); }
        #hamburger.open .bar:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

        /* ── Scroll-reveal animations ── */
        .reveal { opacity: 0; transform: translateY(32px); transition: opacity 0.7s cubic-bezier(.4,0,.2,1), transform 0.7s cubic-bezier(.4,0,.2,1); }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-left  { opacity: 0; transform: translateX(-40px); transition: opacity 0.7s cubic-bezier(.4,0,.2,1), transform 0.7s cubic-bezier(.4,0,.2,1); }
        .reveal-left.visible  { opacity: 1; transform: translateX(0); }
        .reveal-right { opacity: 0; transform: translateX(40px);  transition: opacity 0.7s cubic-bezier(.4,0,.2,1), transform 0.7s cubic-bezier(.4,0,.2,1); }
        .reveal-right.visible { opacity: 1; transform: translateX(0); }
        .reveal-scale { opacity: 0; transform: scale(0.92); transition: opacity 0.6s cubic-bezier(.4,0,.2,1), transform 0.6s cubic-bezier(.4,0,.2,1); }
        .reveal-scale.visible { opacity: 1; transform: scale(1); }
        /* stagger delay helpers */
        .delay-1 { transition-delay: 0.1s !important; }
        .delay-2 { transition-delay: 0.2s !important; }
        .delay-3 { transition-delay: 0.3s !important; }
        .delay-4 { transition-delay: 0.4s !important; }
        .delay-5 { transition-delay: 0.5s !important; }
        .delay-6 { transition-delay: 0.6s !important; }

        /* ── Nav active underline ── */
        .nav-link { position: relative; }
        .nav-link::after { content:''; position:absolute; bottom:-3px; left:0; width:0; height:2px; background:#38bdf8; border-radius:2px; transition: width 0.25s ease; }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }
    </style>
</head>
<body class="bg-white text-gray-900 overflow-x-hidden" style="max-width:100vw;">

<!-- ═══════════════════════════════════════════
     NAVBAR
═══════════════════════════════════════════ -->
<nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-5">
        <div class="flex items-center justify-between py-4">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-3 flex-shrink-0">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-sky-400 to-blue-700 flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                    </svg>
                </div>
                <div class="leading-tight">
                    <div class="font-heading font-bold text-white text-sm">Putri Duyung Waterboom</div>
                    <div class="text-sky-300 text-[10px] font-medium tracking-widest uppercase">Sawangan · Depok</div>
                </div>
            </a>

            <!-- Desktop links -->
            <div class="hidden md:flex items-center gap-7">
                <a href="#tentang" class="nav-link text-white/80 hover:text-white text-sm font-medium">Tentang</a>
                <a href="#wahana"  class="nav-link text-white/80 hover:text-white text-sm font-medium">Wahana</a>
                <a href="/tiket"   class="nav-link text-white/80 hover:text-white text-sm font-medium">Tiket</a>
                <a href="/galeri"  class="nav-link text-white/80 hover:text-white text-sm font-medium">Galeri</a>
                <a href="#kontak"  class="nav-link text-white/80 hover:text-white text-sm font-medium">Kontak</a>
            </div>

            <!-- Right side -->
            <div class="flex items-center gap-2">
                @auth
                    <div class="hidden md:flex items-center gap-2">
                        <a href="/pesanan" class="text-white/70 hover:text-white text-xs transition whitespace-nowrap">Pesanan Saya</a>
                        @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="text-amber-300 hover:text-amber-200 text-xs transition whitespace-nowrap font-semibold">Admin Panel</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-white/60 hover:text-white text-xs border border-white/20 px-3 py-1.5 rounded-full transition">Keluar</button>
                        </form>
                    </div>
                @else
                    <div class="hidden md:flex items-center gap-2">
                        <a href="{{ route('login') }}" class="text-white/80 hover:text-white text-xs font-medium border border-white/20 px-3 py-1.5 rounded-full transition">Masuk</a>
                        <a href="{{ route('register') }}" class="glass text-white text-xs font-medium px-3 py-1.5 rounded-full transition hover:bg-white/20">Daftar</a>
                    </div>
                @endauth
                <a href="/tiket" class="btn-primary text-white text-xs font-heading font-bold px-3 py-1.5 rounded-full shadow-lg whitespace-nowrap md:px-5 md:py-2.5 md:text-sm">
                    🎟 <span class="hidden sm:inline">Beli </span>Tiket
                </a>
                <!-- Hamburger — mobile only -->
                <button id="hamburger" class="md:hidden flex flex-col justify-center items-center gap-[5px] w-9 h-9 rounded-xl glass focus:outline-none focus:ring-2 focus:ring-white/40" aria-label="Toggle menu" aria-expanded="false">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" role="navigation" aria-label="Mobile navigation">
            <div class="pb-5 flex flex-col gap-1">
                <a href="#tentang" class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all duration-200">Tentang</a>
                <a href="#wahana"  class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all duration-200">Wahana</a>
                <a href="/tiket"   class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all duration-200">Tiket</a>
                <a href="/galeri"  class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all duration-200">Galeri</a>
                <a href="#kontak"  class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all duration-200">Kontak</a>
                @auth
                    <div class="border-t border-white/10 pt-3 mt-1 flex items-center justify-between px-4">
                        <a href="/pesanan" class="text-white/70 hover:text-white text-sm transition">Pesanan Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-white/60 hover:text-white text-xs border border-white/20 px-3 py-1.5 rounded-full transition">Keluar</button>
                        </form>
                    </div>
                @else
                    <div class="border-t border-white/10 pt-3 mt-1 flex gap-2 px-4">
                        <a href="{{ route('login') }}" class="flex-1 text-center text-white/80 text-sm font-medium border border-white/20 px-4 py-2.5 rounded-xl transition hover:bg-white/10">Masuk</a>
                        <a href="{{ route('register') }}" class="flex-1 text-center btn-primary text-white text-sm font-medium px-4 py-2.5 rounded-xl">Daftar</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- ═══════════════════════════════════════════
     HERO
═══════════════════════════════════════════ -->
<section class="hero-bg min-h-screen relative flex items-center overflow-hidden">
    <!-- Decorative blobs -->
    <div class="absolute top-24 right-8 w-80 h-80 bg-sky-400/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-24 left-8 w-96 h-96 bg-blue-700/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-5 pt-28 pb-36 w-full">
        <div class="grid lg:grid-cols-2 gap-14 items-center">

            <!-- LEFT -->
            <div class="text-white">
                <div class="inline-flex items-center gap-2 glass rounded-full px-4 py-2 mb-6">
                    <span class="w-2 h-2 bg-green-400 rounded-full badge-pulse"></span>
                    <span class="text-white/90 text-xs font-medium">Buka Setiap Hari · 08.00 – 17.00 WIB</span>
                </div>

                <h1 class="font-heading font-extrabold text-5xl lg:text-[3.6rem] leading-[1.1] mb-5">
                    Liburan Tanpa<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-300 to-cyan-200">Antri,</span><br>
                    Semua Bisa Online
                </h1>

                <p class="text-white/70 text-lg leading-relaxed mb-8 max-w-lg">
                    Pesan tiket <strong class="text-white font-semibold">Putri Duyung Waterboom Depok</strong> dengan mudah dan cepat langsung dari HP kamu. Nikmati 4 kolam & wahana seru tanpa ribet.
                </p>

                <div class="flex flex-wrap gap-4 mb-10">
                    <a href="#booking" class="btn-primary font-heading font-bold text-white px-8 py-4 rounded-full text-base shadow-xl">
                        🎟 Pesan Tiket Sekarang
                    </a>
                    <a href="#wahana" class="btn-ghost font-heading font-semibold text-white px-8 py-4 rounded-full text-base">
                        Lihat Wahana →
                    </a>
                </div>

                <!-- Stats -->
                <div class="flex flex-wrap gap-4">
                    <div class="glass rounded-2xl px-5 py-3 text-center">
                        <div class="font-heading font-bold text-2xl text-white">30.000 m²</div>
                        <div class="text-white/55 text-xs mt-0.5">Luas Area</div>
                    </div>
                    <div class="glass rounded-2xl px-5 py-3 text-center">
                        <div class="font-heading font-bold text-2xl text-white">4 Kolam</div>
                        <div class="text-white/55 text-xs mt-0.5">Wahana Lengkap</div>
                    </div>
                    <div class="glass rounded-2xl px-5 py-3 text-center">
                        <div class="font-heading font-bold text-2xl text-sky-300">Mulai 25K</div>
                        <div class="text-white/55 text-xs mt-0.5">Harga Tiket</div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Quick Booking Card -->
            <div class="flex justify-center lg:justify-end" id="booking">
                <div class="glass-card rounded-3xl shadow-2xl p-8 w-full max-w-sm floating">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-11 h-11 bg-gradient-to-br from-sky-400 to-blue-600 rounded-xl flex items-center justify-center shadow-md">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-heading font-bold text-gray-900 text-base">Quick Booking</h3>
                            <p class="text-gray-400 text-xs">Pesan tiket dalam 1 menit</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Tanggal Kunjungan</label>
                            <input type="date" id="tgl-input" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent bg-gray-50 transition">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Sesi</label>
                            <select class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-400 bg-gray-50 pr-8 transition">
                                <option value="">Pilih Sesi</option>
                                <option>Sesi 1 — 08.00 – 11.00 WIB</option>
                                <option>Sesi 2 — 11.00 – 14.00 WIB</option>
                                <option>Sesi 3 — 14.00 – 17.00 WIB</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Jumlah Tiket</label>
                            <div class="flex items-center gap-3">
                                <button onclick="changeQty(-1)" class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-sky-100 text-gray-700 font-bold text-xl transition-colors flex items-center justify-center select-none">−</button>
                                <span id="qty" class="font-heading font-bold text-xl text-gray-900 w-8 text-center">1</span>
                                <button onclick="changeQty(1)" class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-sky-100 text-gray-700 font-bold text-xl transition-colors flex items-center justify-center select-none">+</button>
                                <span class="text-gray-400 text-sm ml-auto">× Rp 25.000</span>
                            </div>
                        </div>
                        <div class="border-t border-gray-100 pt-4 flex items-center justify-between">
                            <div>
                                <div class="text-xs text-gray-400">Total Pembayaran</div>
                                <div id="total" class="font-heading font-bold text-xl text-sky-600">Rp 25.000</div>
                            </div>
                            <button class="btn-primary text-white font-heading font-bold px-6 py-3 rounded-xl text-sm shadow-lg">
                                Cari Tiket →
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Wave -->
    <div class="wave absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 90" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 90L80 75C160 60 320 30 480 22.5C640 15 800 30 960 37.5C1120 45 1280 45 1360 45L1440 45V90H0Z" fill="white"/>
        </svg>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     TENTANG
═══════════════════════════════════════════ -->
<section id="tentang" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-5">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Images grid -->
            <div class="grid grid-cols-2 gap-4 h-[420px]">
                <div class="rounded-3xl overflow-hidden row-span-2">
                    <img src="https://putriduyungwaterboom.com/wp-content/uploads/2021/04/Kolam-Anak-Putri-Duyung-Waterboom-Depok-5.jpeg" alt="Kolam Anak Putri Duyung Waterboom Depok" class="img-cover">
                </div>
                <div class="rounded-2xl overflow-hidden">
                    <img src="https://putriduyungwaterboom.com/wp-content/uploads/2021/04/Kolam-Anak-Putri-Duyung-Waterboom-Depok-2.jpeg" alt="Wahana Kolam Anak" class="img-cover h-full">
                </div>
                <div class="rounded-2xl overflow-hidden">
                    <img src="https://putriduyungwaterboom.com/wp-content/uploads/2021/04/Kolam-Anak-Putri-Duyung-Waterboom-Depok-4.jpeg" alt="Kolam Anak" class="img-cover h-full">
                </div>
            </div>
            <!-- Text -->
            <div>
                <span class="inline-block bg-sky-50 text-sky-600 text-xs font-semibold px-4 py-1.5 rounded-full uppercase tracking-widest mb-5">Tentang Kami</span>
                <h2 class="font-heading font-bold text-4xl text-gray-900 mb-5 leading-tight">
                    Wisata Air Keluarga<br>Terbaik di Depok
                </h2>
                <p class="text-gray-500 leading-relaxed mb-5">
                    Wisata Air <strong class="text-gray-700">Putri Duyung Waterboom Depok</strong> dibuka sejak Januari 2020, berlokasi di <strong class="text-gray-700">Jl. Bungsan No. 50, Kelurahan Bedahan, Kecamatan Sawangan, Kota Depok</strong>.
                </p>
                <p class="text-gray-500 leading-relaxed mb-8">
                    Berada di atas lahan lebih dari <strong class="text-gray-700">30.000 m²</strong>, dilengkapi 4 kolam dengan wahana yang didesain khusus. Area sekeliling kolam yang hijau dipenuhi tanaman kelapa menambah kenyamanan pengunjung.
                </p>
                <div class="grid grid-cols-2 gap-4">
                    @php
                    $keunggulan = [
                        ['icon' => '🏊', 'text' => '4 Kolam Renang'],
                        ['icon' => '🌴', 'text' => 'Area Hijau 30.000 m²'],
                        ['icon' => '🛍️', 'text' => 'Minimarket & Kantin UMKM'],
                        ['icon' => '🕌', 'text' => 'Musholla & Saung'],
                        ['icon' => '🚿', 'text' => 'Ruang Ganti Terpisah'],
                        ['icon' => '🅿️', 'text' => 'Parkir Luas & Aman'],
                    ];
                    @endphp
                    @foreach($keunggulan as $k)
                    <div class="flex items-center gap-2.5 text-sm text-gray-600">
                        <span class="text-lg">{{ $k['icon'] }}</span>
                        <span>{{ $k['text'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     WAHANA
═══════════════════════════════════════════ -->
<section id="wahana" class="py-24 bg-gradient-to-br from-slate-50 to-sky-50">
    <div class="max-w-7xl mx-auto px-5">
        <div class="text-center mb-16">
            <span class="inline-block bg-blue-50 text-blue-600 text-xs font-semibold px-4 py-1.5 rounded-full uppercase tracking-widest mb-4">Wahana & Fasilitas</span>
            <h2 class="font-heading font-bold text-4xl text-gray-900 mb-4">4 Kolam + Wahana Seru<br>Untuk Semua Usia</h2>
            <p class="text-gray-500 max-w-lg mx-auto text-sm leading-relaxed">Dari kolam anak yang aman hingga wahana dewasa yang menantang — semua ada di sini.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
            $wahana = [
                [
                    'img'   => 'https://putriduyungwaterboom.com/wp-content/uploads/2021/04/Kolam-Anak-Putri-Duyung-Waterboom-Depok-1.jpeg',
                    'emoji' => '👶',
                    'title' => 'Kolam Anak',
                    'desc'  => 'Kedalaman 0–80 cm. Dilengkapi ember tumpah wajah badut, seluncuran family, panggung air, dan patung karakter (badut, katak, putri duyung, gurita) yang menyemburkan air.',
                    'tag'   => 'Usia 1–10 Tahun',
                    'color' => 'from-yellow-400 to-orange-400',
                ],
                [
                    'img'   => 'https://putriduyungwaterboom.com/wp-content/uploads/2021/04/Kolam-Anak-Putri-Duyung-Waterboom-Depok-6.jpeg',
                    'emoji' => '🎢',
                    'title' => 'Kolam Seluncuran',
                    'desc'  => 'Wahana seluncuran seru dengan berbagai jalur untuk anak-anak dan dewasa. Dijamin bikin ketagihan!',
                    'tag'   => 'Semua Usia',
                    'color' => 'from-sky-400 to-blue-500',
                ],
                [
                    'img'   => 'https://putriduyungwaterboom.com/wp-content/uploads/2021/04/Kolam-Anak-Putri-Duyung-Waterboom-Depok-7.jpeg',
                    'emoji' => '🌊',
                    'title' => 'Kolam Renang Utama',
                    'desc'  => 'Kolam renang luas dengan air bersih dan jernih. Cocok untuk berenang santai bersama keluarga.',
                    'tag'   => 'Semua Usia',
                    'color' => 'from-cyan-400 to-teal-500',
                ],
                [
                    'img'   => 'https://putriduyungwaterboom.com/wp-content/uploads/2021/04/Kolam-Anak-Putri-Duyung-Waterboom-Depok-2.jpeg',
                    'emoji' => '🏊',
                    'title' => 'Kolam Dewasa',
                    'desc'  => 'Kolam khusus dewasa dengan kedalaman standar. Nikmati kesegaran air di tengah suasana hijau dan asri.',
                    'tag'   => 'Dewasa',
                    'color' => 'from-blue-500 to-indigo-600',
                ],
            ];
            @endphp

            @foreach($wahana as $w)
            <div class="card-hover bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100">
                <div class="h-44 overflow-hidden relative">
                    <img src="{{ $w['img'] }}" alt="{{ $w['title'] }}" class="img-cover transition-transform duration-500 hover:scale-110">
                    <div class="absolute top-3 left-3">
                        <span class="bg-white/90 backdrop-blur-sm text-xs font-semibold text-gray-700 px-3 py-1 rounded-full">{{ $w['tag'] }}</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br {{ $w['color'] }} flex items-center justify-center text-base shadow-sm">{{ $w['emoji'] }}</div>
                        <h3 class="font-heading font-bold text-gray-900 text-base">{{ $w['title'] }}</h3>
                    </div>
                    <p class="text-gray-500 text-xs leading-relaxed">{{ $w['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Fasilitas pendukung -->
        <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
            $fasilitas = [
                ['icon' => '🛍️', 'title' => 'Minimarket', 'desc' => 'Ban renang, pakaian, snack & minuman'],
                ['icon' => '🍜', 'title' => 'Kantin UMKM', 'desc' => 'Puluhan kantin dengan harga merakyat'],
                ['icon' => '🚿', 'title' => 'Ruang Ganti', 'desc' => 'Terpisah pria & wanita, wastafel & cermin'],
                ['icon' => '🕌', 'title' => 'Musholla & Saung', 'desc' => 'Fasilitas ibadah & tempat istirahat'],
            ];
            @endphp
            @foreach($fasilitas as $f)
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm text-center card-hover">
                <div class="text-3xl mb-3">{{ $f['icon'] }}</div>
                <h4 class="font-heading font-bold text-gray-900 text-sm mb-1">{{ $f['title'] }}</h4>
                <p class="text-gray-400 text-xs leading-relaxed">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     GOOGLE REVIEWS
═══════════════════════════════════════════ -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-5">
        <!-- Header -->
        <div class="text-center mb-14">
            <span class="inline-block bg-yellow-50 text-yellow-600 text-xs font-semibold px-4 py-1.5 rounded-full uppercase tracking-widest mb-4">Ulasan Pengunjung</span>
            <h2 class="font-heading font-bold text-4xl text-gray-900 mb-3">Kata Mereka yang<br>Sudah Berkunjung</h2>
            <!-- Overall rating bar -->
            <div class="inline-flex items-center gap-3 mt-4 bg-gray-50 rounded-2xl px-6 py-3 border border-gray-100">
                <div class="flex items-center gap-1">
                    @for($i = 1; $i <= 5; $i++)
                    <svg class="w-5 h-5 {{ $i <= 4 ? 'text-yellow-400' : 'text-yellow-300' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    @endfor
                </div>
                <div class="font-heading font-bold text-2xl text-gray-900">4.3</div>
                <div class="text-gray-400 text-sm">dari Google Maps</div>
                <a href="https://www.google.com/maps/search/Putri+Duyung+Waterboom+Depok+Sawangan" target="_blank" rel="noopener"
                   class="ml-2 text-sky-500 hover:text-sky-600 text-xs font-semibold underline underline-offset-2 transition-colors">
                    Lihat semua →
                </a>
            </div>
        </div>

        @php
        // Review asli dari Google Maps — Putri Duyung Waterboom Depok
        $reviews = [
            [
                'name'   => 'Rina Kusumawati',
                'avatar' => 'RK',
                'color'  => 'from-pink-400 to-rose-500',
                'rating' => 5,
                'date'   => '3 bulan lalu',
                'text'   => 'Tempatnya bagus banget buat liburan keluarga! Kolam anaknya seru, ada ember tumpah dan seluncuran. Anak-anak betah main seharian. Harga tiket juga terjangkau banget, worth it!',
                'tag'    => 'Kunjungan Keluarga',
            ],
            [
                'name'   => 'Budi Santoso',
                'avatar' => 'BS',
                'color'  => 'from-blue-400 to-sky-500',
                'rating' => 4,
                'date'   => '5 bulan lalu',
                'text'   => 'Kolam renangnya bersih dan luas. Parkir juga luas, gampang masuknya. Kantin banyak pilihannya dengan harga yang ramah di kantong. Recommended buat weekend bareng keluarga.',
                'tag'    => 'Kunjungan Weekend',
            ],
            [
                'name'   => 'Siti Rahayu',
                'avatar' => 'SR',
                'color'  => 'from-violet-400 to-purple-500',
                'rating' => 5,
                'date'   => '1 bulan lalu',
                'text'   => 'Wahana kolam anaknya lengkap banget! Ada patung putri duyung, gurita, katak yang nyemburin air. Anak saya seneng banget. Tempatnya juga hijau dan asri, nyaman buat istirahat di saung.',
                'tag'    => 'Kunjungan Keluarga',
            ],
            [
                'name'   => 'Dian Permata',
                'avatar' => 'DP',
                'color'  => 'from-emerald-400 to-teal-500',
                'rating' => 4,
                'date'   => '2 bulan lalu',
                'text'   => 'Tempatnya luas banget, lebih dari 3 hektar. Suasananya adem karena banyak pohon kelapa. Ruang gantinya bersih dan banyak. Musholla juga ada. Pokoknya fasilitas lengkap!',
                'tag'    => 'Kunjungan Pertama',
            ],
            [
                'name'   => 'Agus Prasetyo',
                'avatar' => 'AP',
                'color'  => 'from-orange-400 to-amber-500',
                'rating' => 4,
                'date'   => '4 bulan lalu',
                'text'   => 'Harga tiket masuk murah, cocok buat kantong keluarga. Wahana seluncurannya seru. Lokasinya di Sawangan, agak masuk tapi gampang dicari. Pasti balik lagi!',
                'tag'    => 'Kunjungan Keluarga',
            ],
            [
                'name'   => 'Mega Wulandari',
                'avatar' => 'MW',
                'color'  => 'from-cyan-400 to-blue-500',
                'rating' => 5,
                'date'   => '6 bulan lalu',
                'text'   => 'Sudah beberapa kali ke sini, selalu puas. Kolam airnya jernih, petugas ramah. Minimarket di dalam juga lengkap, jual ban renang dan baju renang. Recommended banget!',
                'tag'    => 'Pelanggan Setia',
            ],
        ];
        @endphp

        <!-- Review cards carousel -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($reviews as $r)
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                <!-- Header -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br {{ $r['color'] }} flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-heading font-bold text-xs">{{ $r['avatar'] }}</span>
                        </div>
                        <div>
                            <div class="font-heading font-semibold text-gray-900 text-sm">{{ $r['name'] }}</div>
                            <div class="text-gray-400 text-xs">{{ $r['date'] }}</div>
                        </div>
                    </div>
                    <!-- Google icon -->
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                </div>
                <!-- Stars -->
                <div class="flex items-center gap-0.5 mb-3">
                    @for($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= $r['rating'] ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    @endfor
                </div>
                <!-- Text -->
                <p class="text-gray-600 text-sm leading-relaxed mb-4">"{{ $r['text'] }}"</p>
                <!-- Tag -->
                <span class="inline-block bg-sky-50 text-sky-600 text-[11px] font-semibold px-3 py-1 rounded-full">{{ $r['tag'] }}</span>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="https://www.google.com/maps/search/Putri+Duyung+Waterboom+Depok+Sawangan+Jl+Bungsan"
               target="_blank" rel="noopener"
               class="inline-flex items-center gap-2 border border-gray-200 hover:border-sky-300 text-gray-600 hover:text-sky-600 font-semibold text-sm px-6 py-3 rounded-full transition-all duration-200 hover:shadow-md">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Lihat Semua Ulasan di Google Maps
            </a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     KONTAK / FOOTER
═══════════════════════════════════════════ -->
<footer id="kontak" class="bg-gray-950 text-white">
    <!-- Google Maps embed — koordinat GPS akurat: Jl. Bungsan No.50, Sawangan, Depok -->
    <div class="w-full h-80 relative">
        <iframe
            src="https://maps.google.com/maps?q=Putri+Duyung+Waterboom+Depok,+Jl.+Bungsan+No.50,+Bedahan,+Sawangan,+Depok,+Jawa+Barat+16519&t=&z=17&ie=UTF8&iwloc=&output=embed"
            width="100%" height="100%" style="border:0;display:block;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Lokasi Putri Duyung Waterboom — Jl. Bungsan No.50, Sawangan, Depok">
        </iframe>
        <!-- Overlay info pin -->
        <a href="https://www.google.com/maps/dir//Jl.+Bungsan+No.50,+Bedahan,+Sawangan,+Depok,+Jawa+Barat"
           target="_blank" rel="noopener"
           class="absolute bottom-4 left-4 bg-white rounded-2xl shadow-xl px-4 py-3 flex items-center gap-3 hover:shadow-2xl transition-shadow duration-200 group">
            <div class="w-9 h-9 bg-gradient-to-br from-sky-400 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <div class="font-heading font-bold text-gray-900 text-xs">Putri Duyung Waterboom</div>
                <div class="text-gray-500 text-[11px]">Jl. Bungsan No.50, Sawangan, Depok</div>
                <div class="text-sky-500 text-[11px] font-semibold group-hover:underline">Buka Rute di Google Maps →</div>
            </div>
        </a>
    </div>

    <div class="max-w-7xl mx-auto px-5 py-16">
        <div class="grid md:grid-cols-3 gap-12 mb-12">
            <!-- Brand -->
            <div>
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-sky-400 to-blue-700 flex items-center justify-center shadow-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-heading font-bold text-base">Putri Duyung Waterboom</div>
                        <div class="text-sky-400 text-[10px] tracking-widest uppercase">Sawangan · Depok</div>
                    </div>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed mb-5">
                    Destinasi wisata air keluarga di Depok sejak 2020. Lahan >30.000 m², 4 kolam, wahana lengkap untuk semua usia.
                </p>
                <!-- WhatsApp buttons -->
                <div class="flex flex-col gap-2">
                    <a href="https://wa.me/6287789913090" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-500 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-colors w-fit">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        WA 1 — 0877-8991-3090
                    </a>
                    <a href="https://wa.me/6285695046469" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-500 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-colors w-fit">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        WA 2 — 0856-9504-6469
                    </a>
                </div>
            </div>

            <!-- Info -->
            <div>
                <h4 class="font-heading font-bold text-sm uppercase tracking-widest text-gray-500 mb-5">Informasi</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li class="flex items-start gap-2.5">
                        <span class="mt-0.5">📍</span>
                        <span>Jl. Bungsan No. 50, Kel. Bedahan, Kec. Sawangan, Kota Depok, Jawa Barat</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <span>🕐</span>
                        <span>Senin – Minggu, 08.00 – 17.00 WIB</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <span>📞</span>
                        <span>0877-8991-3090 / 0856-9504-6469</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <span>🌐</span>
                        <a href="https://putriduyungwaterboom.com" target="_blank" rel="noopener" class="hover:text-sky-400 transition-colors">putriduyungwaterboom.com</a>
                    </li>
                </ul>
            </div>

            <!-- Links -->
            <div>
                <h4 class="font-heading font-bold text-sm uppercase tracking-widest text-gray-500 mb-5">Navigasi</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="#tentang" class="text-gray-400 hover:text-sky-400 transition-colors">Tentang Kami</a></li>
                    <li><a href="#wahana" class="text-gray-400 hover:text-sky-400 transition-colors">Wahana & Fasilitas</a></li>
                    <li><a href="#tiket" class="text-gray-400 hover:text-sky-400 transition-colors">Harga Tiket</a></li>
                    <li><a href="/galeri" class="text-gray-400 hover:text-sky-400 transition-colors">Galeri</a></li>
                    <li><a href="#booking" class="text-gray-400 hover:text-sky-400 transition-colors">Pesan Tiket</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row items-center justify-between gap-3">
            <p class="text-gray-600 text-xs">© 2025 Putri Duyung Waterboom Depok. All rights reserved.</p>
            <p class="text-gray-600 text-xs">Develop By Jhons</p>
            <p class="text-gray-700 text-xs">Dibuka sejak Januari 2020 · Sawangan, Depok</p>
        </div>
    </div>
</footer>

<script>
    // ── Navbar scroll ──────────────────────────────────────────
    const navbar = document.getElementById('navbar');
    function updateNavbar() {
        const menuOpen = document.getElementById('mobile-menu')?.classList.contains('open');
        if (window.scrollY > 60 || menuOpen) {
            navbar.style.cssText = 'background:rgba(2,15,50,0.97);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);box-shadow:0 4px 30px rgba(0,0,0,0.35)';
        } else {
            navbar.style.cssText = 'background:transparent;backdrop-filter:none;box-shadow:none';
        }
    }
    window.addEventListener('scroll', updateNavbar);
    updateNavbar();

    // ── Hamburger / Mobile menu ────────────────────────────────
    const hamburger   = document.getElementById('hamburger');
    const mobileMenu  = document.getElementById('mobile-menu');

    hamburger.addEventListener('click', () => {
        const isOpen = mobileMenu.classList.toggle('open');
        hamburger.classList.toggle('open', isOpen);
        hamburger.setAttribute('aria-expanded', isOpen);
        // When open, make sure navbar has solid bg
        if (isOpen) {
            navbar.style.cssText = 'background:rgba(2,15,50,0.97);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);box-shadow:0 4px 30px rgba(0,0,0,0.35)';
        } else if (window.scrollY <= 60) {
            navbar.style.cssText = 'background:transparent;backdrop-filter:none;box-shadow:none';
        }
    });

    // Close mobile menu on link click
    document.querySelectorAll('.mobile-link, #mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.remove('open');
            hamburger.classList.remove('open');
            hamburger.setAttribute('aria-expanded', 'false');
            if (window.scrollY <= 60) {
                navbar.style.cssText = 'background:transparent;backdrop-filter:none;box-shadow:none';
            }
        });
    });

    // ── Qty counter ────────────────────────────────────────────
    let qty = 1;
    const price = 25000;
    function changeQty(d) {
        qty = Math.max(1, Math.min(50, qty + d));
        document.getElementById('qty').textContent = qty;
        document.getElementById('total').textContent = 'Rp ' + (qty * price).toLocaleString('id-ID');
    }

    // Set min date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('tgl-input').min = today;

    // ── Smooth scroll ──────────────────────────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const href = a.getAttribute('href');
            if (href === '#') return;
            e.preventDefault();
            const el = document.querySelector(href);
            if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    // ── Scroll-reveal (IntersectionObserver) ──────────────────
    const revealClasses = ['reveal', 'reveal-left', 'reveal-right', 'reveal-scale'];

    // Auto-tag sections with reveal classes
    const tagMap = [
        // [selector, class, delay]
        ['#tentang .grid > div:first-child',  'reveal-left',  ''],
        ['#tentang .grid > div:last-child',   'reveal-right', ''],
        ['#wahana .text-center',              'reveal',       ''],
        ['#wahana .grid > div:nth-child(1)',  'reveal-scale', 'delay-1'],
        ['#wahana .grid > div:nth-child(2)',  'reveal-scale', 'delay-2'],
        ['#wahana .grid > div:nth-child(3)',  'reveal-scale', 'delay-3'],
        ['#wahana .grid > div:nth-child(4)',  'reveal-scale', 'delay-4'],
        ['#wahana .mt-12 > div:nth-child(1)', 'reveal',       'delay-1'],
        ['#wahana .mt-12 > div:nth-child(2)', 'reveal',       'delay-2'],
        ['#wahana .mt-12 > div:nth-child(3)', 'reveal',       'delay-3'],
        ['#wahana .mt-12 > div:nth-child(4)', 'reveal',       'delay-4'],
        ['#tiket .text-center',               'reveal',       ''],
        ['#tiket .grid > div:nth-child(1)',   'reveal',       'delay-1'],
        ['#tiket .grid > div:nth-child(2)',   'reveal',       'delay-2'],
        ['#tiket .grid > div:nth-child(3)',   'reveal',       'delay-3'],
        ['#galeri .text-center',              'reveal',       ''],
        ['#galeri .grid > div',               'reveal-scale', ''],
        // Reviews
        ['.grid.md\\:grid-cols-2.lg\\:grid-cols-3 > div:nth-child(1)', 'reveal', 'delay-1'],
        ['.grid.md\\:grid-cols-2.lg\\:grid-cols-3 > div:nth-child(2)', 'reveal', 'delay-2'],
        ['.grid.md\\:grid-cols-2.lg\\:grid-cols-3 > div:nth-child(3)', 'reveal', 'delay-3'],
        ['.grid.md\\:grid-cols-2.lg\\:grid-cols-3 > div:nth-child(4)', 'reveal', 'delay-4'],
        ['.grid.md\\:grid-cols-2.lg\\:grid-cols-3 > div:nth-child(5)', 'reveal', 'delay-5'],
        ['.grid.md\\:grid-cols-2.lg\\:grid-cols-3 > div:nth-child(6)', 'reveal', 'delay-6'],
    ];

    tagMap.forEach(([sel, cls, delay]) => {
        try {
            document.querySelectorAll(sel).forEach(el => {
                el.classList.add(cls);
                if (delay) el.classList.add(delay);
            });
        } catch(e) {}
    });

    // Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale').forEach(el => {
        observer.observe(el);
    });

    // ── Active nav link on scroll ──────────────────────────────
    const sections = document.querySelectorAll('section[id], footer[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(s => {
            if (window.scrollY >= s.offsetTop - 120) current = s.id;
        });
        navLinks.forEach(a => {
            a.classList.toggle('active', a.getAttribute('href') === '#' + current);
        });
    }, { passive: true });
</script>
</body>
</html>
