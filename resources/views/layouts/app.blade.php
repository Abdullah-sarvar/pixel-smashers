<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pixel Smashers')</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script>
        // Check for saved theme or default to dark
        const currentTheme = localStorage.getItem('theme') || 'dark';
        if (currentTheme === 'light') {
            document.documentElement.classList.add('light');
        }

        function toggleTheme() {
            const isLight = document.documentElement.classList.toggle('light');
            localStorage.setItem('theme', isLight ? 'light' : 'dark');
        }
    </script>
</head>
<body>


<nav class="sticky top-0 z-100 flex items-center justify-between px-10 h-16 bg-[var(--bg)] border-b border-[var(--border)]">
    <a href="/" class="text-pixel text-[12px] text-[var(--accent-light)] no-underline">PIXEL<span class="text-[var(--gold)]">SMASHERS</span></a>

    <ul class="flex gap-7 list-none m-0 p-0">
        <li><a href="/marketplace" class="text-[var(--muted)] no-underline font-bold text-sm uppercase tracking-widest hover:text-[var(--accent-light)] transition-colors">Browse</a></li>
        <li><a href="/marketplace?type=free" class="text-[var(--muted)] no-underline font-bold text-sm uppercase tracking-widest hover:text-[var(--accent-light)] transition-colors">Free Assets</a></li>
        <li><a href="/marketplace?category=tileset" class="text-[var(--muted)] no-underline font-bold text-sm uppercase tracking-widest hover:text-[var(--accent-light)] transition-colors">Tilesets</a></li>
        <li><a href="/marketplace?category=character" class="text-[var(--muted)] no-underline font-bold text-sm uppercase tracking-widest hover:text-[var(--accent-light)] transition-colors">Characters</a></li>
    </ul>

   <div class="flex gap-2.5 items-center">
    <button onclick="toggleTheme()" class="btn-pixel btn-pixel-ghost !px-3 !py-1 mr-4" title="Toggle Light/Dark Mode">🌓</button>
    @auth
        <span class="text-[var(--accent-light)] font-semibold text-sm">👋 {{ Auth::user()->name }}</span>
        <a href="/cart" class="btn-pixel btn-pixel-ghost">🛒 Cart</a>
        <a href="/orders" class="btn-pixel btn-pixel-ghost">📦 Orders</a>

        @if(Auth::user()->role == 'seller')
            <a href="/seller/dashboard" class="btn-pixel btn-pixel-ghost">My Dashboard</a>
            <a href="/seller/upload" class="btn-pixel">+ Upload</a>
        @endif

        @if(Auth::user()->role == 'admin')
            <a href="/admin/dashboard" class="btn-pixel">Admin Panel</a>
        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-pixel btn-pixel-ghost">Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="btn-pixel btn-pixel-ghost">Login</a>
        <a href="{{ route('register') }}" class="btn-pixel">Sign Up</a>
    @endauth
</div>
</nav>


@yield('content')

<!-- FOOTER -->
<footer class="border-t border-[var(--border)] px-10 py-7 flex items-center justify-between mt-16 bg-[var(--card)]">
    <div class="text-pixel text-[10px] text-[var(--accent-light)]">PIXEL<span class="text-[var(--gold)]">SMASHERS</span></div>
    <div class="text-xs text-[var(--muted)]">© 2026 Pixel Smashers. All rights reserved.</div>
</footer>

</body>
</html>