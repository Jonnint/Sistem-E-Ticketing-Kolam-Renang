<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar — Putri Duyung Waterboom</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1,h2,h3,.font-heading { font-family: 'Sora', sans-serif; }
        .auth-bg {
            background-image:
                linear-gradient(135deg, rgba(2,15,50,0.93) 0%, rgba(0,70,140,0.82) 60%, rgba(0,160,210,0.55) 100%),
                url('https://putriduyungwaterboom.com/wp-content/uploads/2021/04/Kolam-Anak-Putri-Duyung-Waterboom-Depok-5.jpeg');
            background-size: cover; background-position: center;
        }
        .btn-primary { background:linear-gradient(135deg,#0ea5e9 0%,#0369a1 100%); transition:all 0.3s cubic-bezier(.4,0,.2,1); }
        .btn-primary:hover { transform:translateY(-2px); box-shadow:0 14px 36px rgba(14,165,233,0.45); }
        input:focus { outline:none; border-color:#0ea5e9; box-shadow:0 0 0 3px rgba(14,165,233,0.15); }
    </style>
</head>
<body class="auth-bg min-h-screen flex items-center justify-center px-4 py-12">

<div class="w-full max-w-md">
    <!-- Logo -->
    <a href="/" class="flex items-center justify-center gap-3 mb-8">
        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-sky-400 to-blue-700 flex items-center justify-center shadow-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
            </svg>
        </div>
        <div class="leading-tight">
            <div class="font-heading font-bold text-white text-base">Putri Duyung Waterboom</div>
            <div class="text-sky-300 text-[10px] font-medium tracking-widest uppercase">Sawangan · Depok</div>
        </div>
    </a>

    <!-- Card -->
    <div class="bg-white rounded-3xl shadow-2xl p-8">
        <h1 class="font-heading font-bold text-2xl text-gray-900 mb-1">Buat Akun Baru</h1>
        <p class="text-gray-400 text-sm mb-7">Daftar gratis dan mulai pesan tiket online.</p>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 bg-gray-50 transition @error('name') border-red-400 @enderror"
                    placeholder="Nama lengkap kamu">
                @error('name')
                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 bg-gray-50 transition @error('email') border-red-400 @enderror"
                    placeholder="email@contoh.com">
                @error('email')
                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Password</label>
                <input type="password" name="password" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 bg-gray-50 transition @error('password') border-red-400 @enderror"
                    placeholder="Minimal 8 karakter">
                @error('password')
                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 bg-gray-50 transition"
                    placeholder="Ulangi password">
            </div>

            <button type="submit" class="btn-primary w-full text-white font-heading font-bold py-3.5 rounded-xl text-sm shadow-lg">
                Daftar Sekarang →
            </button>
        </form>

        <p class="text-center text-sm text-gray-400 mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-sky-500 font-semibold hover:text-sky-600 transition">Masuk di sini</a>
        </p>
    </div>

    <p class="text-center text-white/40 text-xs mt-6">
        <a href="/" class="hover:text-white/70 transition">← Kembali ke Beranda</a>
    </p>
</div>

</body>
</html>
