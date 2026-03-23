<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesan Tiket — Putri Duyung Waterboom Depok</title>
    <meta name="description" content="Pesan tiket Putri Duyung Waterboom Depok secara online. Pilih tanggal, sesi, dan jumlah tiket dengan mudah.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1,h2,h3,h4,.font-heading { font-family: 'Sora', sans-serif; }
        .page-hero {
            background-image:
                linear-gradient(135deg, rgba(2,15,50,0.92) 0%, rgba(0,70,140,0.80) 60%, rgba(0,160,210,0.50) 100%),
                url('https://putriduyungwaterboom.com/wp-content/uploads/2021/04/Kolam-Anak-Putri-Duyung-Waterboom-Depok-5.jpeg');
            background-size: cover; background-position: center 40%;
        }
        .glass { background:rgba(255,255,255,0.10); backdrop-filter:blur(16px); -webkit-backdrop-filter:blur(16px); border:1px solid rgba(255,255,255,0.18); }
        .btn-primary { background:linear-gradient(135deg,#0ea5e9 0%,#0369a1 100%); transition:all 0.3s cubic-bezier(.4,0,.2,1); }
        .btn-primary:hover { transform:translateY(-2px); box-shadow:0 14px 36px rgba(14,165,233,0.45); }
        .nav-link { position:relative; transition:color 0.2s; }
        .nav-link:hover { color:#38bdf8; }
        .nav-link::after { content:''; position:absolute; bottom:-3px; left:0; width:0; height:2px; background:#38bdf8; border-radius:2px; transition:width 0.25s ease; }
        .nav-link:hover::after,.nav-link.active::after { width:100%; }
        .badge-pulse { animation:pulse 2s cubic-bezier(.4,0,.6,1) infinite; }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.5} }
        #mobile-menu { max-height:0; overflow:hidden; transition:max-height 0.4s cubic-bezier(.4,0,.2,1),opacity 0.3s ease; opacity:0; }
        #mobile-menu.open { max-height:400px; opacity:1; }
        .bar { display:block; width:20px; height:2px; background:white; border-radius:2px; transition:all 0.3s cubic-bezier(.4,0,.2,1); }
        #hamburger.open .bar:nth-child(1) { transform:translateY(7px) rotate(45deg); }
        #hamburger.open .bar:nth-child(2) { opacity:0; transform:scaleX(0); }
        #hamburger.open .bar:nth-child(3) { transform:translateY(-7px) rotate(-45deg); }
        .ticket-card { transition:all 0.25s ease; border:2px solid transparent; cursor:pointer; }
        .ticket-card:hover { border-color:#0ea5e9; box-shadow:0 8px 30px rgba(14,165,233,0.15); }
        .ticket-card.selected { border-color:#0ea5e9; background:#f0f9ff; box-shadow:0 8px 30px rgba(14,165,233,0.2); }
        .ticket-card.selected .check-icon { display:flex; }
        .check-icon { display:none; }
        .step-line { height:2px; background:#e5e7eb; flex:1; }
        .step-line.done { background:#0ea5e9; }
        input:focus,select:focus { outline:none; ring:2px; border-color:#0ea5e9; box-shadow:0 0 0 3px rgba(14,165,233,0.15); }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 overflow-x-hidden">

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
                    <div class="text-sky-300 text-[10px] font-medium tracking-widest uppercase">Sawangan · Depok</div>
                </div>
            </a>
            <div class="hidden md:flex items-center gap-7">
                <a href="/#tentang" class="nav-link text-white/80 hover:text-white text-sm font-medium">Tentang</a>
                <a href="/#wahana"  class="nav-link text-white/80 hover:text-white text-sm font-medium">Wahana</a>
                <a href="/tiket"    class="nav-link active text-sky-300 text-sm font-semibold">Tiket</a>
                <a href="/galeri"   class="nav-link text-white/80 hover:text-white text-sm font-medium">Galeri</a>
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
                @endauth
                <a href="/tiket" class="btn-primary text-white text-xs font-heading font-bold px-3 py-1.5 rounded-full shadow-lg whitespace-nowrap md:px-5 md:py-2.5 md:text-sm">
                    🎟 <span class="hidden sm:inline">Beli </span>Tiket
                </a>
                <button id="hamburger" class="md:hidden flex flex-col justify-center items-center gap-[5px] w-9 h-9 rounded-xl glass focus:outline-none focus:ring-2 focus:ring-white/40" aria-label="Toggle menu" aria-expanded="false">
                    <span class="bar"></span><span class="bar"></span><span class="bar"></span>
                </button>
            </div>
        </div>
        <div id="mobile-menu">
            <div class="pb-5 flex flex-col gap-1">
                <a href="/#tentang" class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all">Tentang</a>
                <a href="/#wahana"  class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all">Wahana</a>
                <a href="/tiket"    class="mobile-link text-sky-300 font-semibold bg-white/10 text-sm px-4 py-3 rounded-xl transition-all">Tiket</a>
                <a href="/galeri"   class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all">Galeri</a>
                <a href="/#kontak"  class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all">Kontak</a>
                @auth
                    <div class="border-t border-white/10 pt-3 mt-1 flex items-center justify-between px-4">
                        <a href="/pesanan" class="text-white/70 hover:text-white text-sm transition">Pesanan Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-white/60 hover:text-white text-xs border border-white/20 px-3 py-1.5 rounded-full transition">Keluar</button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- PAGE HERO -->
<section class="page-hero pt-32 pb-16 relative overflow-hidden">
    <div class="absolute top-20 right-10 w-72 h-72 bg-sky-400/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 left-10 w-64 h-64 bg-blue-700/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-5 relative text-center text-white">
        <div class="inline-flex items-center gap-2 glass rounded-full px-4 py-2 mb-5">
            <span class="w-2 h-2 bg-green-400 rounded-full badge-pulse"></span>
            <span class="text-white/90 text-xs font-medium">Buka Setiap Hari · 08.00 – 17.00 WIB</span>
        </div>
        <h1 class="font-heading font-extrabold text-4xl lg:text-5xl mb-3">Pesan Tiket Online</h1>
        <p class="text-white/70 text-base max-w-md mx-auto">Pilih tanggal, sesi, dan jumlah tiket. Bayar mudah, langsung masuk.</p>
        <div class="flex items-center justify-center gap-2 mt-5 text-sm text-white/50">
            <a href="/" class="hover:text-white transition-colors">Beranda</a>
            <span>/</span>
            <span class="text-white/80">Pesan Tiket</span>
        </div>
    </div>
    <div style="line-height:0" class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 60L80 50C160 40 320 20 480 15C640 10 800 20 960 25C1120 30 1280 30 1360 30L1440 30V60H0Z" fill="#f9fafb"/>
        </svg>
    </div>
</section>

<!-- BOOKING FORM -->
<section class="py-12 bg-gray-50">
    <div class="max-w-5xl mx-auto px-5">

        <!-- Steps -->
        <div class="flex items-center gap-2 mb-10 max-w-sm mx-auto">
            <div class="flex flex-col items-center gap-1">
                <div class="w-8 h-8 rounded-full bg-sky-500 text-white flex items-center justify-center text-xs font-bold" id="step-dot-1">1</div>
                <span class="text-[10px] text-sky-600 font-semibold">Pilih Tiket</span>
            </div>
            <div class="step-line mb-5" id="line-1"></div>
            <div class="flex flex-col items-center gap-1">
                <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center text-xs font-bold" id="step-dot-2">2</div>
                <span class="text-[10px] text-gray-400 font-semibold" id="step-label-2">Data Pemesan</span>
            </div>
            <div class="step-line mb-5" id="line-2"></div>
            <div class="flex flex-col items-center gap-1">
                <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center text-xs font-bold" id="step-dot-3">3</div>
                <span class="text-[10px] text-gray-400 font-semibold" id="step-label-3">Konfirmasi</span>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8 items-start">

            <!-- LEFT: Form Steps -->
            <div class="lg:col-span-2 space-y-6">

                <!-- STEP 1: Pilih Tiket -->
                <div id="step-1">
                    <!-- Tanggal & Sesi -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-6">
                        <h2 class="font-heading font-bold text-gray-900 text-lg mb-5">Pilih Tanggal & Sesi</h2>
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Tanggal Kunjungan</label>
                                <input type="date" id="tgl" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 bg-gray-50 focus:border-sky-400 transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Sesi</label>
                                <select id="sesi" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 bg-gray-50 focus:border-sky-400 transition appearance-none">
                                    <option value="">Pilih Sesi</option>
                                    <option value="1">Sesi 1 — 08.00 – 11.00 WIB</option>
                                    <option value="2">Sesi 2 — 11.00 – 14.00 WIB</option>
                                    <option value="3">Sesi 3 — 14.00 – 17.00 WIB</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Pilih Jenis Tiket -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-6">
                        <h2 class="font-heading font-bold text-gray-900 text-lg mb-5">Jenis Tiket</h2>
                        @php
                        $jenis = [
                            ['id'=>'weekday','label'=>'Weekday','sub'=>'Senin – Jumat','harga'=>25000,'emoji'=>'☀️','desc'=>'Berlaku hari kerja, tidak termasuk hari libur nasional'],
                            ['id'=>'weekend','label'=>'Weekend','sub'=>'Sabtu, Minggu & Libur','harga'=>35000,'emoji'=>'🎉','desc'=>'Berlaku akhir pekan dan hari libur nasional'],
                        ];
                        @endphp
                        <div class="grid sm:grid-cols-2 gap-4" id="ticket-type-group">
                            @foreach($jenis as $j)
                            <div class="ticket-card rounded-2xl p-5 bg-white border-2 border-gray-100 relative"
                                 data-type="{{ $j['id'] }}" data-price="{{ $j['harga'] }}"
                                 onclick="selectType(this)">
                                <div class="check-icon absolute top-3 right-3 w-6 h-6 rounded-full bg-sky-500 items-center justify-center">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div class="text-2xl mb-2">{{ $j['emoji'] }}</div>
                                <div class="font-heading font-bold text-gray-900 text-base">{{ $j['label'] }}</div>
                                <div class="text-gray-400 text-xs mb-3">{{ $j['sub'] }}</div>
                                <div class="font-heading font-bold text-sky-600 text-xl">Rp {{ number_format($j['harga'],0,',','.') }}</div>
                                <div class="text-gray-400 text-[11px] mt-1">/ orang</div>
                                <p class="text-gray-400 text-xs mt-3 leading-relaxed">{{ $j['desc'] }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Jumlah Tiket -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-6">
                        <h2 class="font-heading font-bold text-gray-900 text-lg mb-5">Jumlah Pengunjung</h2>
                        <div class="grid sm:grid-cols-2 gap-6">
                            @php
                            $kategori = [
                                ['id'=>'dewasa','label'=>'Dewasa','sub'=>'Usia 13 tahun ke atas'],
                                ['id'=>'anak','label'=>'Anak-anak','sub'=>'Usia 3 – 12 tahun'],
                            ];
                            @endphp
                            @foreach($kategori as $k)
                            <div>
                                <div class="text-sm font-semibold text-gray-700 mb-0.5">{{ $k['label'] }}</div>
                                <div class="text-xs text-gray-400 mb-3">{{ $k['sub'] }}</div>
                                <div class="flex items-center gap-3">
                                    <button type="button" onclick="changeQty('{{ $k['id'] }}',-1)"
                                        class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-sky-100 text-gray-700 font-bold text-xl transition-colors flex items-center justify-center select-none">−</button>
                                    <span id="qty-{{ $k['id'] }}" class="font-heading font-bold text-xl text-gray-900 w-8 text-center">0</span>
                                    <button type="button" onclick="changeQty('{{ $k['id'] }}',1)"
                                        class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-sky-100 text-gray-700 font-bold text-xl transition-colors flex items-center justify-center select-none">+</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <button onclick="goStep(2)" class="btn-primary w-full text-white font-heading font-bold py-4 rounded-2xl text-base shadow-lg">
                        Lanjut ke Data Pemesan →
                    </button>
                </div>

                <!-- STEP 2: Data Pemesan -->
                <div id="step-2" class="hidden">
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-6">
                        <h2 class="font-heading font-bold text-gray-900 text-lg mb-5">Data Pemesan</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Nama Lengkap</label>
                                <input type="text" id="nama" placeholder="Masukkan nama lengkap" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 bg-gray-50 focus:border-sky-400 transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Nomor WhatsApp</label>
                                <div class="flex">
                                    <span class="flex items-center px-3 bg-gray-100 border border-r-0 border-gray-200 rounded-l-xl text-sm text-gray-500">+62</span>
                                    <input type="tel" id="wa" placeholder="8xx xxxx xxxx" class="flex-1 border border-gray-200 rounded-r-xl px-4 py-3 text-sm text-gray-800 bg-gray-50 focus:border-sky-400 transition">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Email (opsional)</label>
                                <input type="email" id="email" placeholder="email@contoh.com" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 bg-gray-50 focus:border-sky-400 transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Catatan (opsional)</label>
                                <textarea id="catatan" rows="3" placeholder="Misal: ada anggota yang butuh kursi roda, dll." class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 bg-gray-50 focus:border-sky-400 transition resize-none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <button onclick="goStep(1)" class="flex-1 border-2 border-gray-200 text-gray-600 font-heading font-bold py-4 rounded-2xl text-base hover:border-sky-300 transition">
                            ← Kembali
                        </button>
                        <button onclick="goStep(3)" class="flex-[2] btn-primary text-white font-heading font-bold py-4 rounded-2xl text-base shadow-lg">
                            Lanjut ke Konfirmasi →
                        </button>
                    </div>
                </div>

                <!-- STEP 3: Konfirmasi -->
                <div id="step-3" class="hidden">
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-6">
                        <h2 class="font-heading font-bold text-gray-900 text-lg mb-5">Ringkasan Pesanan</h2>
                        <div class="space-y-3 text-sm" id="summary-content"></div>
                        <div class="border-t border-gray-100 mt-5 pt-5">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-700">Total Pembayaran</span>
                                <span class="font-heading font-bold text-2xl text-sky-600" id="summary-total">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-6">
                        <h2 class="font-heading font-bold text-gray-900 text-lg mb-4">Metode Pembayaran</h2>
                        <div class="grid sm:grid-cols-2 gap-4" id="payment-method-group">
                            <label id="pm-cash-card"
                                class="flex items-start gap-4 border-2 border-sky-400 bg-sky-50 rounded-2xl p-4 cursor-pointer transition-all"
                                onclick="selectPayment('cash')">
                                <input type="radio" name="payment_method_ui" value="cash" checked class="mt-1 accent-sky-500">
                                <div>
                                    <div class="font-heading font-bold text-gray-900 text-sm">💵 Bayar di Tempat</div>
                                    <div class="text-gray-400 text-xs mt-1">Bayar tunai di kasir saat tiba di lokasi. Kamu akan mendapat kode pesanan.</div>
                                </div>
                            </label>
                            <label id="pm-online-card"
                                class="flex items-start gap-4 border-2 border-gray-100 bg-white rounded-2xl p-4 cursor-pointer transition-all"
                                onclick="selectPayment('online')">
                                <input type="radio" name="payment_method_ui" value="online" class="mt-1 accent-sky-500">
                                <div>
                                    <div class="font-heading font-bold text-gray-900 text-sm">💳 Bayar Online</div>
                                    <div class="text-gray-400 text-xs mt-1">Simulasi pembayaran online. Tiket + QR code akan digenerate setelah bayar.</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div id="info-cash" class="bg-amber-50 border border-amber-200 rounded-2xl p-4 mb-6 text-sm text-amber-700">
                        ⚠️ Pembayaran dilakukan di kasir saat tiba di lokasi. Tunjukkan kode pesanan kepada petugas.
                    </div>
                    <div id="info-online" class="hidden bg-sky-50 border border-sky-200 rounded-2xl p-4 mb-6 text-sm text-sky-700">
                        💳 Setelah konfirmasi, kamu akan diarahkan ke halaman pesanan untuk menyelesaikan pembayaran dan mendapatkan QR tiket.
                    </div>

                    <div class="flex gap-3">
                        <button onclick="goStep(2)" class="flex-1 border-2 border-gray-200 text-gray-600 font-heading font-bold py-4 rounded-2xl text-base hover:border-sky-300 transition">
                            ← Kembali
                        </button>
                        <button onclick="submitOrder()" class="flex-[2] btn-primary text-white font-heading font-bold py-4 rounded-2xl text-base shadow-lg">
                            🎟 Konfirmasi Pesanan
                        </button>
                    </div>
                </div>

                <!-- STEP 4: Sukses -->
                <div id="step-4" class="hidden text-center">
                    <div class="bg-white rounded-2xl p-10 shadow-sm border border-gray-100">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-5">
                            <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <h2 class="font-heading font-bold text-2xl text-gray-900 mb-2">Pesanan Dikonfirmasi!</h2>
                        <p class="text-gray-500 text-sm mb-2">Nomor Pesanan</p>
                        <div class="font-heading font-bold text-3xl text-sky-600 mb-5" id="order-number"></div>
                        <div class="bg-gray-50 rounded-xl p-4 text-sm text-gray-600 mb-6 text-left space-y-2" id="success-detail"></div>
                        <p class="text-gray-400 text-xs mb-6">Tunjukkan nomor pesanan ini kepada petugas di pintu masuk. Pembayaran dilakukan di kasir.</p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <button onclick="window.print()" class="border-2 border-sky-200 text-sky-600 font-heading font-bold px-6 py-3 rounded-xl text-sm hover:bg-sky-50 transition">
                                🖨️ Cetak / Simpan
                            </button>
                            <a href="/" class="btn-primary text-white font-heading font-bold px-6 py-3 rounded-xl text-sm shadow-md inline-block">
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT: Order Summary Sidebar -->
            <div class="lg:col-span-1 self-start sticky top-24" id="sidebar">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="font-heading font-bold text-gray-900 text-base mb-4">Ringkasan</h3>
                    <div class="space-y-3 text-sm text-gray-600" id="sidebar-content">
                        <p class="text-gray-400 text-xs">Belum ada pilihan tiket.</p>
                    </div>
                    <div class="border-t border-gray-100 mt-4 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-semibold text-gray-700">Total</span>
                            <span class="font-heading font-bold text-lg text-sky-600" id="sidebar-total">Rp 0</span>
                        </div>
                    </div>
                    <div class="mt-5 pt-4 border-t border-gray-100 space-y-2 text-xs text-gray-400">
                        <div class="flex items-center gap-2"><span>📍</span> Jl. Bungsan No. 50, Sawangan, Depok</div>
                        <div class="flex items-center gap-2"><span>🕗</span> Buka 08.00 – 17.00 WIB</div>
                        <div class="flex items-center gap-2"><span>📞</span> Bayar di kasir saat tiba</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-gray-950 text-white py-10 mt-8">
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
            <a href="/galeri" class="text-gray-400 hover:text-sky-400 transition-colors">Galeri</a>
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

    const hamburger  = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobile-menu');
    hamburger.addEventListener('click', () => {
        const isOpen = mobileMenu.classList.toggle('open');
        hamburger.classList.toggle('open', isOpen);
        hamburger.setAttribute('aria-expanded', isOpen);
        updateNavbar();
    });
    document.querySelectorAll('.mobile-link').forEach(l => {
        l.addEventListener('click', () => { mobileMenu.classList.remove('open'); hamburger.classList.remove('open'); updateNavbar(); });
    });

    // ── State ──────────────────────────────────────
    let state = { type: null, price: 0, dewasa: 0, anak: 0 };

    function selectType(el) {
        document.querySelectorAll('.ticket-card').forEach(c => c.classList.remove('selected'));
        el.classList.add('selected');
        state.type  = el.dataset.type;
        state.price = parseInt(el.dataset.price);
        updateSidebar();
    }

    function changeQty(cat, dir) {
        state[cat] = Math.max(0, state[cat] + dir);
        document.getElementById('qty-' + cat).textContent = state[cat];
        updateSidebar();
    }

    function fmt(n) { return 'Rp ' + n.toLocaleString('id-ID'); }

    function updateSidebar() {
        const total = (state.dewasa + state.anak) * state.price;
        const tgl   = document.getElementById('tgl').value;
        const sesi  = document.getElementById('sesi');
        const sesiTxt = sesi.options[sesi.selectedIndex]?.text || '—';
        let html = '';
        if (tgl)         html += `<div class="flex justify-between"><span>Tanggal</span><span class="font-medium text-gray-800">${new Date(tgl).toLocaleDateString('id-ID',{day:'numeric',month:'long',year:'numeric'})}</span></div>`;
        if (state.type)  html += `<div class="flex justify-between"><span>Jenis</span><span class="font-medium text-gray-800 capitalize">${state.type} — ${fmt(state.price)}/org</span></div>`;
        if (sesi.value)  html += `<div class="flex justify-between"><span>Sesi</span><span class="font-medium text-gray-800">${sesiTxt.split('—')[1]?.trim() || sesiTxt}</span></div>`;
        if (state.dewasa) html += `<div class="flex justify-between"><span>Dewasa × ${state.dewasa}</span><span class="font-medium text-gray-800">${fmt(state.dewasa * state.price)}</span></div>`;
        if (state.anak)   html += `<div class="flex justify-between"><span>Anak × ${state.anak}</span><span class="font-medium text-gray-800">${fmt(state.anak * state.price)}</span></div>`;
        if (!html) html = '<p class="text-gray-400 text-xs">Belum ada pilihan tiket.</p>';
        document.getElementById('sidebar-content').innerHTML = html;
        document.getElementById('sidebar-total').textContent = fmt(total);
    }

    document.getElementById('tgl').addEventListener('change', function () {
        if (this.value) {
            // 0=Sun,1=Mon,...,5=Fri,6=Sat — pakai UTC biar tidak kena timezone shift
            const day = new Date(this.value + 'T00:00:00').getDay();
            const isWeekend = day === 0 || day === 6;
            const targetType = isWeekend ? 'weekend' : 'weekday';
            const card = document.querySelector(`.ticket-card[data-type="${targetType}"]`);
            if (card) selectType(card);
        }
        updateSidebar();
    });
    document.getElementById('sesi').addEventListener('change', updateSidebar);

    // Set min date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('tgl').min = today;

    // ── Step navigation ────────────────────────────
    function goStep(n) {
        // Validate step 1
        if (n === 2) {
            const tgl  = document.getElementById('tgl').value;
            const sesi = document.getElementById('sesi').value;
            if (!tgl)        { alert('Pilih tanggal kunjungan terlebih dahulu.'); return; }
            if (!sesi)       { alert('Pilih sesi kunjungan terlebih dahulu.'); return; }
            if (!state.type) { alert('Pilih jenis tiket terlebih dahulu.'); return; }
            if (state.dewasa + state.anak < 1) { alert('Tambahkan minimal 1 tiket.'); return; }
        }
        // Validate step 2
        if (n === 3) {
            const nama = document.getElementById('nama').value.trim();
            const wa   = document.getElementById('wa').value.trim();
            if (!nama) { alert('Masukkan nama lengkap pemesan.'); return; }
            if (!wa)   { alert('Masukkan nomor WhatsApp.'); return; }
            buildSummary();
        }

        [1,2,3,4].forEach(i => document.getElementById('step-' + i)?.classList.add('hidden'));
        document.getElementById('step-' + n)?.classList.remove('hidden');

        // Update step dots
        [1,2,3].forEach(i => {
            const dot   = document.getElementById('step-dot-' + i);
            const label = document.getElementById('step-label-' + i);
            if (i < n) {
                dot.className = 'w-8 h-8 rounded-full bg-sky-500 text-white flex items-center justify-center text-xs font-bold';
                dot.innerHTML = '✓';
            } else if (i === n) {
                dot.className = 'w-8 h-8 rounded-full bg-sky-500 text-white flex items-center justify-center text-xs font-bold';
                dot.textContent = i;
            } else {
                dot.className = 'w-8 h-8 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center text-xs font-bold';
                dot.textContent = i;
            }
            if (label) label.className = i <= n ? 'text-[10px] text-sky-600 font-semibold' : 'text-[10px] text-gray-400 font-semibold';
        });
        document.getElementById('line-1').className = 'step-line mb-5' + (n > 1 ? ' done' : '');
        document.getElementById('line-2').className = 'step-line mb-5' + (n > 2 ? ' done' : '');

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function buildSummary() {
        const tgl   = document.getElementById('tgl').value;
        const sesi  = document.getElementById('sesi');
        const sesiTxt = sesi.options[sesi.selectedIndex]?.text || '';
        const nama  = document.getElementById('nama').value.trim();
        const wa    = document.getElementById('wa').value.trim();
        const total = (state.dewasa + state.anak) * state.price;
        const tglFmt = new Date(tgl).toLocaleDateString('id-ID',{weekday:'long',day:'numeric',month:'long',year:'numeric'});

        const rows = [
            ['Nama Pemesan', nama],
            ['WhatsApp', '+62' + wa],
            ['Tanggal', tglFmt],
            ['Sesi', sesiTxt],
            ['Jenis Tiket', state.type.charAt(0).toUpperCase() + state.type.slice(1) + ' — ' + fmt(state.price) + '/orang'],
            state.dewasa ? ['Dewasa', state.dewasa + ' tiket × ' + fmt(state.price) + ' = ' + fmt(state.dewasa * state.price)] : null,
            state.anak   ? ['Anak-anak', state.anak + ' tiket × ' + fmt(state.price) + ' = ' + fmt(state.anak * state.price)] : null,
        ].filter(Boolean);

        document.getElementById('summary-content').innerHTML = rows.map(([k,v]) =>
            `<div class="flex justify-between gap-4"><span class="text-gray-400">${k}</span><span class="font-medium text-gray-800 text-right">${v}</span></div>`
        ).join('');
        document.getElementById('summary-total').textContent = fmt(total);
    }

    // ── Payment method selection ───────────────────
    let selectedPayment = 'cash';

    function selectPayment(method) {
        selectedPayment = method;
        const cashCard   = document.getElementById('pm-cash-card');
        const onlineCard = document.getElementById('pm-online-card');
        const infoCash   = document.getElementById('info-cash');
        const infoOnline = document.getElementById('info-online');

        if (method === 'cash') {
            cashCard.className   = 'flex items-start gap-4 border-2 border-sky-400 bg-sky-50 rounded-2xl p-4 cursor-pointer transition-all';
            onlineCard.className = 'flex items-start gap-4 border-2 border-gray-100 bg-white rounded-2xl p-4 cursor-pointer transition-all';
            infoCash.classList.remove('hidden');
            infoOnline.classList.add('hidden');
        } else {
            onlineCard.className = 'flex items-start gap-4 border-2 border-sky-400 bg-sky-50 rounded-2xl p-4 cursor-pointer transition-all';
            cashCard.className   = 'flex items-start gap-4 border-2 border-gray-100 bg-white rounded-2xl p-4 cursor-pointer transition-all';
            infoOnline.classList.remove('hidden');
            infoCash.classList.add('hidden');
        }
    }

    function submitOrder() {
        const tgl   = document.getElementById('tgl').value;
        const sesi  = document.getElementById('sesi').value;
        const nama  = document.getElementById('nama').value.trim();
        const wa    = document.getElementById('wa').value.trim();
        const email = document.getElementById('email').value.trim();
        const catatan = document.getElementById('catatan').value.trim();

        // Build and submit a real form to the backend
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/tiket';

        const fields = {
            '_token':         '{{ csrf_token() }}',
            'visit_date':     tgl,
            'session':        sesi,
            'ticket_type':    state.type,
            'qty_adult':      state.dewasa,
            'qty_child':      state.anak,
            'name':           nama,
            'phone':          wa,
            'email':          email,
            'notes':          catatan,
            'payment_method': selectedPayment,
        };

        Object.entries(fields).forEach(([k, v]) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = k;
            input.value = v ?? '';
            form.appendChild(input);
        });

        document.body.appendChild(form);
        form.submit();
    }
</script>
</body>
</html>
