<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri — Putri Duyung Waterboom Depok</title>
    <meta name="description" content="Galeri foto Putri Duyung Waterboom Depok. Lihat keseruan wahana, kolam anak, dan fasilitas lengkap kami.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, .font-heading { font-family: 'Sora', sans-serif; }
        .page-hero {
            background-image:
                linear-gradient(135deg, rgba(2,15,50,0.92) 0%, rgba(0,70,140,0.80) 60%, rgba(0,160,210,0.50) 100%),
                url('https://putriduyungwaterboom.com/wp-content/uploads/2021/04/Kolam-Anak-Putri-Duyung-Waterboom-Depok-5.jpeg');
            background-size: cover;
            background-position: center 40%;
        }
        .glass { background: rgba(255,255,255,0.10); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.18); }
        .btn-primary { background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%); transition: all 0.3s cubic-bezier(.4,0,.2,1); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 14px 36px rgba(14,165,233,0.45); }
        .nav-link { position:relative; transition: color 0.2s; }
        .nav-link:hover { color: #38bdf8; }
        .nav-link::after { content:''; position:absolute; bottom:-3px; left:0; width:0; height:2px; background:#38bdf8; border-radius:2px; transition:width 0.25s ease; }
        .nav-link:hover::after, .nav-link.active::after { width:100%; }
        .badge-pulse { animation: pulse 2s cubic-bezier(.4,0,.6,1) infinite; }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.5} }

        /* Mobile menu */
        #mobile-menu { max-height:0; overflow:hidden; transition: max-height 0.4s cubic-bezier(.4,0,.2,1), opacity 0.3s ease; opacity:0; }
        #mobile-menu.open { max-height:400px; opacity:1; }
        .bar { display:block; width:20px; height:2px; background:white; border-radius:2px; transition: all 0.3s cubic-bezier(.4,0,.2,1); }
        #hamburger.open .bar:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        #hamburger.open .bar:nth-child(2) { opacity:0; transform:scaleX(0); }
        #hamburger.open .bar:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

        /* Scroll reveal */
        .reveal { opacity:0; transform:translateY(32px); transition: opacity 0.7s cubic-bezier(.4,0,.2,1), transform 0.7s cubic-bezier(.4,0,.2,1); }
        .reveal.visible { opacity:1; transform:translateY(0); }
        .reveal-scale { opacity:0; transform:scale(0.93); transition: opacity 0.55s cubic-bezier(.4,0,.2,1), transform 0.55s cubic-bezier(.4,0,.2,1); }
        .reveal-scale.visible { opacity:1; transform:scale(1); }
        .delay-1 { transition-delay:0.08s !important; }
        .delay-2 { transition-delay:0.16s !important; }
        .delay-3 { transition-delay:0.24s !important; }
        .delay-4 { transition-delay:0.32s !important; }
        .delay-5 { transition-delay:0.40s !important; }
        .delay-6 { transition-delay:0.48s !important; }
        .delay-7 { transition-delay:0.56s !important; }
        .delay-8 { transition-delay:0.64s !important; }
        .delay-9 { transition-delay:0.72s !important; }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.5} }

        /* Gallery grid */
        .gallery-item { overflow: hidden; border-radius: 1rem; cursor: pointer; position: relative; }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s cubic-bezier(.4,0,.2,1); display: block; }
        .gallery-item:hover img { transform: scale(1.07); }
        .gallery-item .overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(2,15,50,0.75) 0%, transparent 60%);
            opacity: 0; transition: opacity 0.3s ease;
            display: flex; align-items: flex-end; padding: 1rem;
        }
        .gallery-item:hover .overlay { opacity: 1; }

        /* Lightbox */
        #lightbox { display: none; position: fixed; inset: 0; z-index: 9999; background: rgba(2,10,40,0.96); backdrop-filter: blur(12px); align-items: center; justify-content: center; }
        #lightbox.active { display: flex; }
        #lightbox img { max-width: 90vw; max-height: 85vh; object-fit: contain; border-radius: 1rem; box-shadow: 0 40px 80px rgba(0,0,0,0.6); }
        #lb-prev, #lb-next { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); color: white; width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 0.2s; font-size: 1.2rem; }
        #lb-prev:hover, #lb-next:hover { background: rgba(255,255,255,0.25); }
        #lb-prev { left: 1.5rem; }
        #lb-next { right: 1.5rem; }
        #lb-close { position: absolute; top: 1.25rem; right: 1.25rem; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 0.2s; }
        #lb-close:hover { background: rgba(239,68,68,0.5); }
        #lb-caption { position: absolute; bottom: 1.5rem; left: 50%; transform: translateX(-50%); color: white; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 0.85rem; background: rgba(0,0,0,0.4); padding: 0.4rem 1rem; border-radius: 999px; white-space: nowrap; }
        #lb-counter { position: absolute; top: 1.5rem; left: 50%; transform: translateX(-50%); color: rgba(255,255,255,0.6); font-size: 0.8rem; font-family: 'Sora', sans-serif; }

        /* Filter tabs */
        .filter-btn { transition: all 0.2s ease; }
        .filter-btn.active { background: linear-gradient(135deg, #0ea5e9, #0369a1); color: white; box-shadow: 0 6px 20px rgba(14,165,233,0.35); }
    </style>
</head>
<body class="bg-white text-gray-900 overflow-x-hidden">

<!-- NAVBAR -->
<nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-5">
        <div class="flex items-center justify-between py-4">
            <a href="/" class="flex items-center gap-3 flex-shrink-0">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-sky-400 to-blue-700 flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                    </svg>
                </div>
                <div class="leading-tight">
                    <div class="font-heading font-bold text-white text-sm">Putri Duyung Waterboom</div>
                    <div class="text-sky-300 text-[10px] font-medium tracking-widest uppercase">Sawangan � Depok</div>
                </div>
            </a>
            <div class="hidden md:flex items-center gap-7">
                <a href="/#tentang" class="nav-link text-white/80 hover:text-white text-sm font-medium">Tentang</a>
                <a href="/#wahana"  class="nav-link text-white/80 hover:text-white text-sm font-medium">Wahana</a>
                <a href="/#tiket"   class="nav-link text-white/80 hover:text-white text-sm font-medium">Tiket</a>
                <a href="/galeri"   class="nav-link active text-sky-300 text-sm font-semibold">Galeri</a>
                <a href="/#kontak"  class="nav-link text-white/80 hover:text-white text-sm font-medium">Kontak</a>
            </div>
            <div class="flex items-center gap-2">
                @auth
                    <div class="hidden md:flex items-center gap-2">
                        <a href="/pesanan" class="text-white/70 hover:text-white text-xs transition whitespace-nowrap">Pesanan Saya</a>
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
                <button id="hamburger" class="md:hidden flex flex-col justify-center items-center gap-[5px] w-9 h-9 rounded-xl glass focus:outline-none focus:ring-2 focus:ring-white/40" aria-label="Toggle menu" aria-expanded="false">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu">
            <div class="pb-5 flex flex-col gap-1">
                <a href="/#tentang" class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all">Tentang</a>
                <a href="/#wahana"  class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all">Wahana</a>
                <a href="/tiket"    class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all">Tiket</a>
                <a href="/galeri"   class="mobile-link text-sky-300 font-semibold bg-white/10 text-sm px-4 py-3 rounded-xl transition-all">Galeri</a>
                <a href="/#kontak"  class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all">Kontak</a>
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

<!-- PAGE HERO -->
<section class="page-hero pt-32 pb-20 relative overflow-hidden">
    <div class="absolute top-20 right-10 w-72 h-72 bg-sky-400/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 left-10 w-64 h-64 bg-blue-700/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-5 relative text-center text-white">
        <div class="inline-flex items-center gap-2 glass rounded-full px-4 py-2 mb-6">
            <span class="w-2 h-2 bg-green-400 rounded-full badge-pulse"></span>
            <span class="text-white/90 text-xs font-medium">Foto Asli dari Lokasi</span>
        </div>
        <h1 class="font-heading font-extrabold text-5xl lg:text-6xl mb-4">Galeri Foto</h1>
        <p class="text-white/70 text-lg max-w-xl mx-auto leading-relaxed">
            Lihat langsung keseruan wahana, kolam, dan fasilitas <strong class="text-white">Putri Duyung Waterboom Depok</strong>.
        </p>
        <!-- Breadcrumb -->
        <div class="flex items-center justify-center gap-2 mt-6 text-sm text-white/50">
            <a href="/" class="hover:text-white transition-colors">Beranda</a>
            <span>/</span>
            <span class="text-white/80">Galeri</span>
        </div>
    </div>
    <!-- Wave -->
    <div style="line-height:0" class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 60L80 50C160 40 320 20 480 15C640 10 800 20 960 25C1120 30 1280 30 1360 30L1440 30V60H0Z" fill="white"/>
        </svg>
    </div>
</section>

<!-- GALLERY CONTENT -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-5">

        <!-- Filter Tabs -->
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <button class="filter-btn active font-heading font-semibold text-sm px-6 py-2.5 rounded-full border border-gray-200" data-filter="all">
                Semua Foto
            </button>
            <button class="filter-btn font-heading font-semibold text-sm px-6 py-2.5 rounded-full border border-gray-200 text-gray-600 hover:border-sky-300" data-filter="kolam-anak">
                🧒 Kolam Anak
            </button>
            <button class="filter-btn font-heading font-semibold text-sm px-6 py-2.5 rounded-full border border-gray-200 text-gray-600 hover:border-sky-300" data-filter="wahana">
                🎢 Wahana
            </button>
            <button class="filter-btn font-heading font-semibold text-sm px-6 py-2.5 rounded-full border border-gray-200 text-gray-600 hover:border-sky-300" data-filter="fasilitas">
                🏊 Fasilitas
            </button>
        </div>

        @php
        // Semua foto real dari putriduyungwaterboom.com/wp-content/uploads/2021/04/
        $base = 'https://putriduyungwaterboom.com/wp-content/uploads/2021/04';
        $photos = [
            // Kolam Anak series (1–9 confirmed exist)
            ['src' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-1.jpeg", 'thumb' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-1-400x284.jpeg", 'caption' => 'Kolam Anak — Wahana Ember Tumpah', 'cat' => 'kolam-anak'],
            ['src' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-2.jpeg", 'thumb' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-2-400x284.jpeg", 'caption' => 'Kolam Anak — Seluncuran Family', 'cat' => 'kolam-anak'],
            ['src' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-3.jpeg", 'thumb' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-3-400x284.jpeg", 'caption' => 'Kolam Anak — Panggung Air', 'cat' => 'kolam-anak'],
            ['src' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-4.jpeg", 'thumb' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-4-400x284.jpeg", 'caption' => 'Kolam Anak — Patung Karakter', 'cat' => 'kolam-anak'],
            ['src' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-5.jpeg", 'thumb' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-5-400x284.jpeg", 'caption' => 'Kolam Anak — Area Bermain Air', 'cat' => 'wahana'],
            ['src' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-6.jpeg", 'thumb' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-6-400x284.jpeg", 'caption' => 'Wahana Seluncuran', 'cat' => 'wahana'],
            ['src' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-7.jpeg", 'thumb' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-7-400x284.jpeg", 'caption' => 'Kolam Renang Utama', 'cat' => 'fasilitas'],
            ['src' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-8.jpeg", 'thumb' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-8-400x284.jpeg", 'caption' => 'Area Kolam & Wahana', 'cat' => 'fasilitas'],
            ['src' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-9.jpeg", 'thumb' => "$base/Kolam-Anak-Putri-Duyung-Waterboom-Depok-9-400x284.jpeg", 'caption' => 'Suasana Putri Duyung Waterboom', 'cat' => 'fasilitas'],
        ];
        @endphp

        <!-- Masonry Grid -->
        <div class="columns-1 sm:columns-2 lg:columns-3 gap-4 space-y-4" id="gallery-grid">
            @foreach($photos as $i => $photo)
            <div class="gallery-item break-inside-avoid shadow-sm border border-gray-100"
                 data-cat="{{ $photo['cat'] }}"
                 data-index="{{ $i }}"
                 onclick="openLightbox({{ $i }})">
                <img
                    src="{{ $photo['thumb'] }}"
                    data-full="{{ $photo['src'] }}"
                    alt="{{ $photo['caption'] }}"
                    loading="lazy"
                    onerror="this.src='{{ $photo['src'] }}'"
                >
                <div class="overlay">
                    <div>
                        <p class="text-white font-heading font-semibold text-sm">{{ $photo['caption'] }}</p>
                        <p class="text-white/60 text-xs mt-0.5">Putri Duyung Waterboom Depok</p>
                    </div>
                    <div class="ml-auto">
                        <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Stats bar -->
        <div class="mt-16 grid grid-cols-3 gap-6 max-w-lg mx-auto text-center">
            <div>
                <div class="font-heading font-bold text-3xl text-sky-600">9</div>
                <div class="text-gray-400 text-xs mt-1">Foto Tersedia</div>
            </div>
            <div>
                <div class="font-heading font-bold text-3xl text-sky-600">4</div>
                <div class="text-gray-400 text-xs mt-1">Kolam & Wahana</div>
            </div>
            <div>
                <div class="font-heading font-bold text-3xl text-sky-600">2020</div>
                <div class="text-gray-400 text-xs mt-1">Berdiri Sejak</div>
            </div>
        </div>

        <!-- CTA -->
        <div class="mt-14 text-center">
            <p class="text-gray-500 text-sm mb-5">Tertarik? Yuk langsung pesan tiketnya!</p>
            <a href="/#booking" class="btn-primary inline-block text-white font-heading font-bold px-10 py-4 rounded-full text-base shadow-xl">
                🎟 Pesan Tiket Sekarang
            </a>
        </div>
    </div>
</section>

<!-- LIGHTBOX -->
<div id="lightbox" role="dialog" aria-modal="true" aria-label="Lightbox galeri">
    <button id="lb-close" onclick="closeLightbox()" aria-label="Tutup">✕</button>
    <button id="lb-prev"  onclick="lbNav(-1)"      aria-label="Sebelumnya">‹</button>
    <button id="lb-next"  onclick="lbNav(1)"        aria-label="Berikutnya">›</button>
    <div id="lb-counter"></div>
    <img id="lb-img" src="" alt="">
    <div id="lb-caption"></div>
</div>

<!-- FOOTER -->
<footer class="bg-gray-950 text-white py-12">
    <div class="max-w-7xl mx-auto px-5 flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-sky-400 to-blue-700 flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                </svg>
            </div>
            <div>
                <div class="font-heading font-bold text-sm">Putri Duyung Waterboom Depok</div>
                <div class="text-gray-500 text-xs">Jl. Bungsan No. 50, Sawangan, Depok</div>
            </div>
        </div>
        <div class="flex items-center gap-6 text-sm">
            <a href="/" class="text-gray-400 hover:text-sky-400 transition-colors">Beranda</a>
            <a href="/#wahana" class="text-gray-400 hover:text-sky-400 transition-colors">Wahana</a>
            <a href="/#tiket" class="text-gray-400 hover:text-sky-400 transition-colors">Tiket</a>
            <a href="/#kontak" class="text-gray-400 hover:text-sky-400 transition-colors">Kontak</a>
        </div>
        <p class="text-gray-600 text-xs">© 2025 Putri Duyung Waterboom Depok</p>
    </div>
</footer>

<script>
    // ── Navbar scroll ──────────────────────────────
    const navbar = document.getElementById('navbar');
    function updateNavbar() {
        const menuOpen = document.getElementById('mobile-menu')?.classList.contains('open');
        navbar.style.cssText = (window.scrollY > 60 || menuOpen)
            ? 'background:rgba(2,15,50,0.97);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);box-shadow:0 4px 30px rgba(0,0,0,0.35)'
            : 'background:transparent;backdrop-filter:none;box-shadow:none';
    }
    window.addEventListener('scroll', updateNavbar);
    updateNavbar();

    // ── Hamburger ──────────────────────────────────
    const hamburger  = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobile-menu');
    hamburger.addEventListener('click', () => {
        const isOpen = mobileMenu.classList.toggle('open');
        hamburger.classList.toggle('open', isOpen);
        hamburger.setAttribute('aria-expanded', isOpen);
        if (isOpen) navbar.style.cssText = 'background:rgba(2,15,50,0.97);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);box-shadow:0 4px 30px rgba(0,0,0,0.35)';
        else if (window.scrollY <= 60) navbar.style.cssText = 'background:transparent;backdrop-filter:none;box-shadow:none';
    });
    document.querySelectorAll('.mobile-link').forEach(l => {
        l.addEventListener('click', () => {
            mobileMenu.classList.remove('open');
            hamburger.classList.remove('open');
        });
    });

    // ── Filter tabs ────────────────────────────────
    const filterBtns = document.querySelectorAll('.filter-btn');
    const items      = document.querySelectorAll('.gallery-item');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const f = btn.dataset.filter;
            items.forEach(item => {
                const show = f === 'all' || item.dataset.cat === f;
                item.style.display = show ? 'block' : 'none';
            });
        });
    });

    // ── Scroll reveal ──────────────────────────────
    const observer = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); } });
    }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });

    // Tag gallery items with stagger
    document.querySelectorAll('.gallery-item').forEach((el, i) => {
        el.classList.add('reveal-scale');
        el.style.transitionDelay = (i * 0.07) + 's';
        observer.observe(el);
    });
    // Tag filter buttons
    document.querySelectorAll('.filter-btn').forEach((el, i) => {
        el.classList.add('reveal');
        el.style.transitionDelay = (i * 0.08) + 's';
        observer.observe(el);
    });

    // ── Lightbox ───────────────────────────────────
    const photos = @json($photos);
    let currentIndex = 0;

    function openLightbox(idx) {
        currentIndex = idx;
        renderLightbox();
        document.getElementById('lightbox').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
        document.getElementById('lightbox').classList.remove('active');
        document.body.style.overflow = '';
    }
    function lbNav(dir) {
        currentIndex = (currentIndex + dir + photos.length) % photos.length;
        renderLightbox();
    }
    function renderLightbox() {
        const p = photos[currentIndex];
        const img = document.getElementById('lb-img');
        img.src = p.src; img.alt = p.caption;
        document.getElementById('lb-caption').textContent = p.caption;
        document.getElementById('lb-counter').textContent = (currentIndex + 1) + ' / ' + photos.length;
    }
    document.addEventListener('keydown', e => {
        if (!document.getElementById('lightbox').classList.contains('active')) return;
        if (e.key === 'ArrowLeft')  lbNav(-1);
        if (e.key === 'ArrowRight') lbNav(1);
        if (e.key === 'Escape')     closeLightbox();
    });
    document.getElementById('lightbox').addEventListener('click', e => {
        if (e.target === document.getElementById('lightbox')) closeLightbox();
    });
</script>
</body>
</html>
