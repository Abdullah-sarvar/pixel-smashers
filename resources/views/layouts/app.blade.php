<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pixel Smashers')</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        :root {
            --bg:#0a0a0f; --card:#12121a; --border:#2a2a3a;
            --purple:#7c3aed; --purple-light:#a78bfa;
            --gold:#f59e0b; --green:#10b981;
            --text:#e2e8f0; --muted:#64748b; --error:#f87171;
        }
        body { background:var(--bg); color:var(--text); font-family:'Rajdhani',sans-serif; }

        
        nav {
            position:sticky; top:0; z-index:100;
            display:flex; align-items:center; justify-content:space-between;
            padding:0 40px; height:64px;
            background:rgba(10,10,15,0.97);
            border-bottom:1px solid var(--border);
        }
        .logo { font-family:'Press Start 2P',monospace; font-size:12px; color:var(--purple-light); text-decoration:none; }
        .logo span { color:var(--gold); }
        .nav-links { display:flex; gap:28px; list-style:none; }
        .nav-links a { color:var(--muted); text-decoration:none; font-weight:600; font-size:14px; text-transform:uppercase; letter-spacing:1px; transition:color 0.2s; }
        .nav-links a:hover { color:var(--purple-light); }
        .nav-right { display:flex; gap:10px; align-items:center; }
        .btn-ghost { padding:8px 18px; border:1px solid var(--border); background:transparent; color:var(--text); border-radius:4px; font-family:'Rajdhani',sans-serif; font-weight:600; font-size:14px; text-decoration:none; cursor:pointer; transition:border-color 0.2s; }
        .btn-ghost:hover { border-color:var(--purple); color:var(--purple-light); }
        .btn-purple { padding:8px 18px; background:var(--purple); color:white; border:none; border-radius:4px; font-family:'Rajdhani',sans-serif; font-weight:700; font-size:14px; text-decoration:none; cursor:pointer; }
        .btn-purple:hover { background:#6d28d9; }
        .user-name { color:var(--purple-light); font-weight:600; font-size:14px; }

        footer { border-top:1px solid var(--border); padding:28px 40px; display:flex; align-items:center; justify-content:space-between; margin-top:60px; }
        .footer-logo { font-family:'Press Start 2P',monospace; font-size:10px; color:var(--purple-light); }
        .footer-logo span { color:var(--gold); }
        .footer-copy { font-size:12px; color:var(--muted); }

        @yield('styles')
    </style>
</head>
<body>


<nav>
    <a href="/" class="logo">PIXEL<span>SMASHERS</span></a>

    <ul class="nav-links">
        <li><a href="/marketplace">Browse</a></li>
        <li><a href="/marketplace?type=free">Free Assets</a></li>
        <li><a href="/marketplace?category=tileset">Tilesets</a></li>
        <li><a href="/marketplace?category=character">Characters</a></li>
    </ul>

    <div class="nav-right">
        @auth
    <span class="user-name">👋 {{ Auth::user()->name }}</span>
    <a href="/cart" class="btn-ghost">🛒 Cart</a>
    <a href="/orders" class="btn-ghost">📦 Orders</a>

    @if(Auth::user()->role == 'seller')
        <a href="/seller/dashboard" class="btn-ghost">My Dashboard</a>
        <a href="/seller/upload" class="btn-purple">+ Upload</a>
    @endif

    @if(Auth::user()->role == 'buyer')
        <a href="/marketplace" class="btn-ghost">Browse</a>
    @endif

    @if(Auth::user()->role == 'admin')
        <a href="/admin/dashboard" class="btn-purple">Admin Panel</a>
    @endif

    <form method="POST" action="/logout" style="display:inline;">
        @csrf
        <button type="submit" class="btn-ghost">Logout</button>
    </form>
@else
    <a href="/login" class="btn-ghost">Login</a>
    <a href="/register" class="btn-purple">Sign Up</a>
@endauth
    </div>
</nav>


@yield('content')

<!-- FOOTER -->
<footer>
    <div class="footer-logo">PIXEL<span>SMASHERS</span></div>
    <div class="footer-copy">© 2026 Pixel Smashers. All rights reserved.</div>
</footer>

</body>
</html>