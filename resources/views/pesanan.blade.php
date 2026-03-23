<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan Saya — Putri Duyung Waterboom</title>
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
        .status-pending         { background:#fef9c3; color:#854d0e; }
        .status-pending_cash    { background:#fef9c3; color:#854d0e; }
        .status-pending_payment { background:#dbeafe; color:#1e40af; }
        .status-paid            { background:#dcfce7; color:#166534; }
        .status-confirmed       { background:#dcfce7; color:#166534; }
        .status-cancelled       { background:#fee2e2; color:#991b1b; }
        .status-expired         { background:#f3f4f6; color:#6b7280; }
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
                <a href="/tiket"    class="nav-link text-white/80 hover:text-white text-sm font-medium">Tiket</a>
                <a href="/galeri"   class="nav-link text-white/80 hover:text-white text-sm font-medium">Galeri</a>
                <a href="/#kontak"  class="nav-link text-white/80 hover:text-white text-sm font-medium">Kontak</a>
            </div>
            <div class="flex items-center gap-2">
                <!-- User menu desktop -->
                <div class="hidden md:flex items-center gap-2">
                    <span class="text-white/70 text-sm">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white/60 hover:text-white text-xs border border-white/20 px-3 py-1.5 rounded-full transition">Keluar</button>
                    </form>
                </div>
                <a href="/tiket" class="btn-primary text-white text-xs font-heading font-bold px-3 py-1.5 rounded-full shadow-lg whitespace-nowrap md:px-5 md:py-2.5 md:text-sm">
                    🎟 <span class="hidden sm:inline">Beli </span>Tiket
                </a>
                <button id="hamburger" class="md:hidden flex flex-col justify-center items-center gap-[5px] w-9 h-9 rounded-xl glass focus:outline-none" aria-label="Toggle menu">
                    <span class="bar"></span><span class="bar"></span><span class="bar"></span>
                </button>
            </div>
        </div>
        <div id="mobile-menu">
            <div class="pb-5 flex flex-col gap-1">
                <a href="/#tentang" class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all">Tentang</a>
                <a href="/#wahana"  class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all">Wahana</a>
                <a href="/tiket"    class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all">Tiket</a>
                <a href="/galeri"   class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all">Galeri</a>
                <a href="/#kontak"  class="mobile-link text-white/85 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-3 rounded-xl transition-all">Kontak</a>
                <div class="border-t border-white/10 pt-3 mt-1 flex items-center justify-between px-4">
                    <span class="text-white/60 text-sm">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white/60 hover:text-white text-xs border border-white/20 px-3 py-1.5 rounded-full transition">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- PAGE HERO -->
<section class="page-hero pt-32 pb-16 relative overflow-hidden">
    <div class="absolute top-20 right-10 w-72 h-72 bg-sky-400/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-5 relative text-center text-white">
        <div class="inline-flex items-center gap-2 glass rounded-full px-4 py-2 mb-5">
            <span class="w-2 h-2 bg-green-400 rounded-full badge-pulse"></span>
            <span class="text-white/90 text-xs font-medium">Halo, {{ Auth::user()->name }}</span>
        </div>
        <h1 class="font-heading font-extrabold text-4xl lg:text-5xl mb-3">Pesanan Saya</h1>
        <p class="text-white/70 text-base max-w-md mx-auto">Riwayat dan status semua tiket yang kamu pesan.</p>
        <div class="flex items-center justify-center gap-2 mt-5 text-sm text-white/50">
            <a href="/" class="hover:text-white transition-colors">Beranda</a>
            <span>/</span>
            <span class="text-white/80">Pesanan Saya</span>
        </div>
    </div>
    <div style="line-height:0" class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 60L80 50C160 40 320 20 480 15C640 10 800 20 960 25C1120 30 1280 30 1360 30L1440 30V60H0Z" fill="#f9fafb"/>
        </svg>
    </div>
</section>

<!-- ORDERS -->
<section class="py-12 bg-gray-50 min-h-[50vh]">
    <div class="max-w-4xl mx-auto px-5">

        @if (session('success'))
        <div class="bg-green-50 border border-green-200 rounded-2xl px-5 py-4 mb-6 flex items-center gap-3">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div>
                <p class="text-green-800 font-semibold text-sm">Pesanan berhasil dibuat!</p>
                <p class="text-green-600 text-xs">Nomor pesanan: <span class="font-bold">{{ session('success') }}</span> — Tunjukkan ke petugas saat tiba.</p>
            </div>
        </div>
        @endif

        @if (session('paid'))
        <div class="bg-green-50 border border-green-200 rounded-2xl px-5 py-4 mb-6 flex items-center gap-3">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div>
                <p class="text-green-800 font-semibold text-sm">Pembayaran berhasil! QR tiket sudah digenerate.</p>
                <p class="text-green-600 text-xs">Nomor pesanan: <span class="font-bold">{{ session('paid') }}</span></p>
            </div>
        </div>
        @endif

        @if (session('cancelled'))
        <div class="bg-red-50 border border-red-200 rounded-2xl px-5 py-4 mb-6 text-sm text-red-700">
            Pesanan berhasil dibatalkan.
        </div>
        @endif

        @if (session('updated'))
        <div class="bg-sky-50 border border-sky-200 rounded-2xl px-5 py-4 mb-6 flex items-center gap-3">
            <div class="w-8 h-8 bg-sky-100 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div>
                <p class="text-sky-800 font-semibold text-sm">Pesanan berhasil diperbarui!</p>
                <p class="text-sky-600 text-xs">Nomor pesanan: <span class="font-bold">{{ session('updated') }}</span></p>
            </div>
        </div>
        @endif

        @if ($orders->isEmpty())
        <div class="text-center py-20">
            <div class="text-6xl mb-4">🎟</div>
            <h2 class="font-heading font-bold text-xl text-gray-900 mb-2">Belum ada pesanan</h2>
            <p class="text-gray-400 text-sm mb-6">Yuk pesan tiket pertamamu sekarang!</p>
            <a href="/tiket" class="btn-primary inline-block text-white font-heading font-bold px-8 py-3.5 rounded-full text-sm shadow-lg">
                Pesan Tiket Sekarang
            </a>
        </div>
        @else
        <div class="space-y-4">
            @foreach ($orders as $order)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <div>
                        <span class="font-heading font-bold text-gray-900 text-base">{{ $order->order_number }}</span>
                        <span class="ml-3 text-xs font-semibold px-2.5 py-1 rounded-full status-{{ $order->status }}">
                            @php
                                $statusLabel = match($order->status) {
                                    'pending_cash'    => 'Menunggu Bayar di Tempat',
                                    'pending_payment' => 'Menunggu Pembayaran Online',
                                    'paid'            => 'Lunas',
                                    'cancelled'       => 'Dibatalkan',
                                    'expired'         => 'Kedaluwarsa',
                                    default           => ucfirst($order->status),
                                };
                            @endphp
                            {{ $statusLabel }}
                        </span>
                    </div>
                    <span class="text-gray-400 text-xs">{{ $order->created_at->diffForHumans() }}</span>
                </div>
                <!-- Body -->
                <div class="px-6 py-5 grid sm:grid-cols-2 gap-4 text-sm">
                    <div class="space-y-2">
                        <div class="flex gap-2">
                            <span class="text-gray-400 w-28 flex-shrink-0">Tanggal</span>
                            <span class="font-medium text-gray-800">{{ $order->visit_date->translatedFormat('l, d F Y') }}</span>
                        </div>
                        <div class="flex gap-2">
                            <span class="text-gray-400 w-28 flex-shrink-0">Sesi</span>
                            <span class="font-medium text-gray-800">{{ $order->session_label }}</span>
                        </div>
                        <div class="flex gap-2">
                            <span class="text-gray-400 w-28 flex-shrink-0">Jenis Tiket</span>
                            <span class="font-medium text-gray-800 capitalize">{{ $order->ticket_type }}</span>
                        </div>
                        <div class="flex gap-2">
                            <span class="text-gray-400 w-28 flex-shrink-0">Pembayaran</span>
                            <span class="font-medium text-gray-800">
                                {{ $order->payment_method === 'cash' ? '💵 Bayar di Tempat' : '💳 Online' }}
                            </span>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex gap-2">
                            <span class="text-gray-400 w-28 flex-shrink-0">Dewasa</span>
                            <span class="font-medium text-gray-800">{{ $order->qty_adult }} tiket</span>
                        </div>
                        <div class="flex gap-2">
                            <span class="text-gray-400 w-28 flex-shrink-0">Anak-anak</span>
                            <span class="font-medium text-gray-800">{{ $order->qty_child }} tiket</span>
                        </div>
                        <div class="flex gap-2">
                            <span class="text-gray-400 w-28 flex-shrink-0">Total</span>
                            <span class="font-heading font-bold text-sky-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                {{-- QR Code untuk pesanan paid --}}
                @if ($order->status === 'paid' && $order->ticket)
                <div class="px-6 pb-5 flex flex-col sm:flex-row items-center gap-5 border-t border-gray-100 pt-5">
                    <div class="flex-shrink-0 text-center">
                        <img src="{{ $order->ticket->qr_code }}" alt="QR Tiket" class="w-36 h-36 rounded-xl border border-gray-200 shadow-sm">
                        <p class="text-xs text-gray-400 mt-2">Scan QR di pintu masuk</p>
                    </div>
                    <div class="text-sm space-y-1">
                        <p class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Kode Tiket</p>
                        <p class="font-heading font-bold text-xl text-gray-900 tracking-widest">{{ $order->ticket->code }}</p>
                        <p class="text-xs text-gray-400 mt-2">Status tiket:
                            <span class="font-semibold {{ $order->ticket->status === 'used' ? 'text-red-500' : 'text-green-600' }}">
                                {{ $order->ticket->status === 'used' ? 'Sudah Digunakan' : 'Belum Digunakan' }}
                            </span>
                        </p>
                        <a href="{{ route('ticket.download', $order) }}"
                           class="inline-flex items-center gap-2 mt-4 text-xs text-white bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 font-semibold px-4 py-2 rounded-lg transition shadow-sm">
                            ⬇️ Download Tiket PDF
                        </a>
                    </div>
                </div>
                @endif

                {{-- Info cash --}}
                @if ($order->status === 'pending_cash')
                <div class="px-6 pb-5">
                    <div class="bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 text-xs text-amber-700">
                        💵 Bayar di kasir saat tiba di lokasi. Tunjukkan nomor pesanan <span class="font-bold">{{ $order->order_number }}</span> kepada petugas.
                    </div>
                </div>
                @endif

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between flex-wrap gap-3">
                    <div class="text-xs text-gray-400">
                        Atas nama: <span class="font-medium text-gray-600">{{ $order->name }}</span>
                        · WA: <span class="font-medium text-gray-600">+62{{ $order->phone }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        @if ($order->status === 'pending_payment')
                        <form method="POST" action="{{ route('payment.pay', $order) }}"
                              onsubmit="return confirm('Konfirmasi pembayaran online untuk pesanan ini?')">
                            @csrf
                            <button type="submit"
                                class="text-xs text-white bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 font-semibold px-4 py-1.5 rounded-lg transition shadow-sm">
                                💳 Bayar Sekarang
                            </button>
                        </form>
                        @endif
                        @if (in_array($order->status, ['pending_cash', 'pending_payment']))
                        <button onclick="openEdit({{ $order }})"
                            class="text-xs text-sky-500 hover:text-sky-600 border border-sky-200 hover:border-sky-300 px-3 py-1.5 rounded-lg transition">
                            Edit
                        </button>
                        <form method="POST" action="/pesanan/{{ $order->id }}/cancel"
                              onsubmit="return confirm('Batalkan pesanan ini?')">
                            @csrf
                            <button type="submit" class="text-xs text-red-500 hover:text-red-600 border border-red-200 hover:border-red-300 px-3 py-1.5 rounded-lg transition">
                                Batalkan
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="/tiket" class="btn-primary inline-block text-white font-heading font-bold px-8 py-3.5 rounded-full text-sm shadow-lg">
                + Pesan Tiket Baru
            </a>
        </div>
        @endif

    </div>
</section>

<!-- EDIT MODAL -->
<div id="edit-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center px-4 py-8">
    <div class="absolute inset-0 bg-gray-950/60 backdrop-blur-sm" onclick="closeEdit()"></div>
    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
            <h2 class="font-heading font-bold text-gray-900 text-lg">Edit Pesanan</h2>
            <button onclick="closeEdit()" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition text-gray-500">✕</button>
        </div>

        <form id="edit-form" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Tanggal Kunjungan</label>
                    <input type="date" name="visit_date" id="edit-visit_date" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:border-sky-400 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Sesi</label>
                    <select name="session" id="edit-session" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:border-sky-400 transition appearance-none">
                        <option value="1">Sesi 1 — 08.00–11.00 WIB</option>
                        <option value="2">Sesi 2 — 11.00–14.00 WIB</option>
                        <option value="3">Sesi 3 — 14.00–17.00 WIB</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Jenis Tiket</label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="flex items-center gap-3 border-2 border-gray-100 rounded-xl px-4 py-3 cursor-pointer has-[:checked]:border-sky-400 has-[:checked]:bg-sky-50 transition">
                        <input type="radio" name="ticket_type" value="weekday" id="edit-weekday" class="accent-sky-500">
                        <div>
                            <div class="text-sm font-semibold text-gray-800">Weekday</div>
                            <div class="text-xs text-gray-400">Rp 25.000/orang</div>
                        </div>
                    </label>
                    <label class="flex items-center gap-3 border-2 border-gray-100 rounded-xl px-4 py-3 cursor-pointer has-[:checked]:border-sky-400 has-[:checked]:bg-sky-50 transition">
                        <input type="radio" name="ticket_type" value="weekend" id="edit-weekend" class="accent-sky-500">
                        <div>
                            <div class="text-sm font-semibold text-gray-800">Weekend</div>
                            <div class="text-xs text-gray-400">Rp 35.000/orang</div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Dewasa</label>
                    <input type="number" name="qty_adult" id="edit-qty_adult" min="0" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:border-sky-400 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Anak-anak</label>
                    <input type="number" name="qty_child" id="edit-qty_child" min="0" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:border-sky-400 transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Nama Pemesan</label>
                <input type="text" name="name" id="edit-name" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:border-sky-400 transition">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Nomor WhatsApp</label>
                <div class="flex">
                    <span class="flex items-center px-3 bg-gray-100 border border-r-0 border-gray-200 rounded-l-xl text-sm text-gray-500">+62</span>
                    <input type="tel" name="phone" id="edit-phone" required
                        class="flex-1 border border-gray-200 rounded-r-xl px-4 py-3 text-sm bg-gray-50 focus:border-sky-400 transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Email (opsional)</label>
                <input type="email" name="email" id="edit-email"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:border-sky-400 transition">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Catatan (opsional)</label>
                <textarea name="notes" id="edit-notes" rows="2"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:border-sky-400 transition resize-none"></textarea>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeEdit()"
                    class="flex-1 border-2 border-gray-200 text-gray-600 font-heading font-bold py-3 rounded-xl text-sm hover:border-gray-300 transition">
                    Batal
                </button>
                <button type="submit"
                    class="flex-[2] btn-primary text-white font-heading font-bold py-3 rounded-xl text-sm shadow-lg">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- FOOTER -->
<footer class="bg-gray-950 text-white py-10">
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
        <p class="text-gray-600 text-xs">© 2025 Putri Duyung Waterboom Depok</p>
    </div>
</footer>

<script>
    const today = new Date().toISOString().split('T')[0];

    function openEdit(order) {
        const form = document.getElementById('edit-form');
        form.action = '/pesanan/' + order.id;

        document.getElementById('edit-visit_date').value = order.visit_date;
        document.getElementById('edit-visit_date').min   = today;
        document.getElementById('edit-session').value    = order.session;
        document.getElementById('edit-qty_adult').value  = order.qty_adult;
        document.getElementById('edit-qty_child').value  = order.qty_child;
        document.getElementById('edit-name').value       = order.name;
        document.getElementById('edit-phone').value      = order.phone;
        document.getElementById('edit-email').value      = order.email ?? '';
        document.getElementById('edit-notes').value      = order.notes ?? '';

        // Set radio
        document.getElementById('edit-' + order.ticket_type).checked = true;

        document.getElementById('edit-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeEdit() {
        document.getElementById('edit-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeEdit();
    });

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
        updateNavbar();
    });
    document.querySelectorAll('.mobile-link').forEach(l => {
        l.addEventListener('click', () => { mobileMenu.classList.remove('open'); hamburger.classList.remove('open'); updateNavbar(); });
    });
</script>
</body>
</html>
