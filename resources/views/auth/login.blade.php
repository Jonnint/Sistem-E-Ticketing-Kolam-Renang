<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — Putri Duyung Waterboom</title>
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
        .glass { background:rgba(255,255,255,0.10); backdrop-filter:blur(16px); -webkit-backdrop-filter:blur(16px); border:1px solid rgba(255,255,255,0.18); }
        .btn-primary { background:linear-gradient(135deg,#0ea5e9 0%,#0369a1 100%); transition:all 0.3s cubic-bezier(.4,0,.2,1); }
        .btn-primary:hover { transform:translateY(-2px); box-shadow:0 14px 36px rgba(14,165,233,0.45); }
        input:focus { outline:none; border-color:#0ea5e9; box-shadow:0 0 0 3px rgba(14,165,233,0.15); }
        .pw-wrap { position:relative; }
        .pw-toggle { position:absolute; right:14px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#9ca3af; padding:0; display:flex; align-items:center; }
        .pw-toggle:hover { color:#0ea5e9; }
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
        <h1 class="font-heading font-bold text-2xl text-gray-900 mb-1">Masuk ke Akun</h1>
        <p class="text-gray-400 text-sm mb-7">Pesan tiket lebih mudah dengan akun kamu.</p>

        <!-- Session Status -->
        @if (session('status'))
            <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl px-4 py-3 mb-5">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 bg-gray-50 transition @error('email') border-red-400 @enderror"
                    placeholder="email@contoh.com">
                @error('email')
                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs text-sky-500 hover:text-sky-600 transition">Lupa password?</a>
                    @endif
                </div>
                <div class="pw-wrap">
                    <input type="password" name="password" id="pw-login" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 pr-11 text-sm text-gray-800 bg-gray-50 transition @error('password') border-red-400 @enderror"
                        placeholder="••••••••">
                    <button type="button" class="pw-toggle" onclick="togglePw('pw-login', this)" aria-label="Tampilkan password">
                        <svg id="pw-login-eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-gray-300 text-sky-500 focus:ring-sky-400">
                <label for="remember" class="text-sm text-gray-500">Ingat saya</label>
            </div>

            <button type="submit" class="btn-primary w-full text-white font-heading font-bold py-3.5 rounded-xl text-sm shadow-lg">
                Masuk →
            </button>
        </form>

        <p class="text-center text-sm text-gray-400 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-sky-500 font-semibold hover:text-sky-600 transition">Daftar sekarang</a>
        </p>
    </div>

    <p class="text-center text-white/40 text-xs mt-6">
        <a href="/" class="hover:text-white/70 transition">← Kembali ke Beranda</a>
    </p>
</div>

<script>
function togglePw(id, btn) {
    const input = document.getElementById(id);
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    btn.innerHTML = isHidden
        ? '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>'
        : '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>';
}
</script>
</body>
</html>
