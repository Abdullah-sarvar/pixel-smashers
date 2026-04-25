<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace – Pixel Smashers</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        :root {
            --bg:#0a0a0f; --card:#12121a; --border:#2a2a3a;
            --purple:#7c3aed; --purple-light:#a78bfa;
            --gold:#f59e0b; --green:#10b981;
            --text:#e2e8f0; --muted:#64748b;
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
        .nav-links a { color:var(--muted); text-decoration:none; font-weight:600; font-size:14px; text-transform:uppercase; letter-spacing:1px; }
        .nav-links a:hover { color:var(--purple-light); }
        .nav-btns { display:flex; gap:10px; align-items:center; }
        .btn-ghost { padding:8px 18px; border:1px solid var(--border); background:transparent; color:var(--text); border-radius:4px; font-family:'Rajdhani',sans-serif; font-weight:600; font-size:14px; text-decoration:none; cursor:pointer; }
        .btn-purple { padding:8px 18px; background:var(--purple); color:white; border:none; border-radius:4px; font-family:'Rajdhani',sans-serif; font-weight:700; font-size:14px; text-decoration:none; cursor:pointer; }

        /* PAGE HEADER */
        .page-header {
            background:linear-gradient(135deg, rgba(124,58,237,0.15), transparent);
            border-bottom:1px solid var(--border);
            padding:40px;
        }
        .page-title { font-family:'Press Start 2P',monospace; font-size:18px; color:white; margin-bottom:8px; }
        .page-title span { color:var(--purple-light); }
        .page-sub { color:var(--muted); font-size:15px; }

        /* LAYOUT */
        .layout { display:grid; grid-template-columns:240px 1fr; gap:0; min-height:calc(100vh - 130px); }

        /* SIDEBAR */
        .sidebar { border-right:1px solid var(--border); padding:24px; }
        .filter-title { font-family:'Press Start 2P',monospace; font-size:10px; color:var(--purple-light); margin-bottom:16px; letter-spacing:1px; }
        .filter-group { margin-bottom:24px; }
        .filter-label { font-size:12px; font-weight:600; color:var(--muted); letter-spacing:1px; text-transform:uppercase; margin-bottom:10px; display:block; }
        .filter-options { display:flex; flex-direction:column; gap:6px; }
        .filter-options a {
            padding:8px 12px; border-radius:4px; font-size:14px; font-weight:600;
            color:var(--muted); text-decoration:none; transition:all 0.2s;
            border:1px solid transparent;
        }
        .filter-options a:hover, .filter-options a.active {
            color:var(--purple-light); background:rgba(124,58,237,0.1);
            border-color:rgba(124,58,237,0.3);
        }

        /* MAIN CONTENT */
        .main { padding:24px 32px; }

        /* SEARCH BAR */
        .search-bar {
            display:flex; gap:12px; margin-bottom:24px;
        }
        .search-input {
            flex:1; padding:12px 16px;
            background:var(--card); border:1px solid var(--border);
            border-radius:6px; color:var(--text);
            font-family:'Rajdhani',sans-serif; font-size:15px;
            outline:none; transition:border-color 0.2s;
        }
        .search-input:focus { border-color:var(--purple); }
        .search-input::placeholder { color:var(--muted); }
        .search-btn {
            padding:12px 24px; background:var(--purple); color:white;
            border:none; border-radius:6px; font-family:'Rajdhani',sans-serif;
            font-weight:700; font-size:14px; cursor:pointer; letter-spacing:1px;
        }

        /* SORT */
        .sort-bar {
            display:flex; align-items:center; justify-content:space-between;
            margin-bottom:20px;
        }
        .results-count { font-size:14px; color:var(--muted); }
        .sort-select {
            padding:8px 12px; background:var(--card); border:1px solid var(--border);
            border-radius:4px; color:var(--text);
            font-family:'Rajdhani',sans-serif; font-size:14px; outline:none;
        }

        /* PRODUCT GRID */
        .grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:20px; }
        .card { background:var(--card); border:1px solid var(--border); border-radius:8px; overflow:hidden; text-decoration:none; color:inherit; display:block; transition:border-color 0.2s, transform 0.2s; }
        .card:hover { border-color:var(--purple); transform:translateY(-4px); }
        .card-img { width:100%; height:165px; display:flex; align-items:center; justify-content:center; font-size:54px; position:relative; background:linear-gradient(135deg,#1a1a2e,#16213e); }
        .card-img img { width:100%; height:100%; object-fit:cover; }
        .badge { position:absolute; top:8px; right:8px; padding:4px 8px; border-radius:4px; font-size:10px; font-weight:700; letter-spacing:1px; text-transform:uppercase; }
        .badge-hot { background:rgba(239,68,68,0.2); color:#f87171; border:1px solid rgba(239,68,68,0.3); }
        .badge-free { background:rgba(16,185,129,0.2); color:var(--green); border:1px solid rgba(16,185,129,0.3); }
        .badge-paid { background:rgba(245,158,11,0.2); color:var(--gold); border:1px solid rgba(245,158,11,0.3); }
        .card-body { padding:14px; }
        .card-cat { font-size:11px; font-weight:600; color:var(--purple-light); letter-spacing:2px; text-transform:uppercase; margin-bottom:4px; }
        .card-name { font-size:15px; font-weight:700; color:white; margin-bottom:8px; }
        .card-seller { font-size:12px; color:var(--muted); margin-bottom:8px; }
        .card-foot { display:flex; align-items:center; justify-content:space-between; padding-top:10px; border-top:1px solid var(--border); }
        .price { font-family:'Press Start 2P',monospace; font-size:11px; color:var(--gold); }
        .price-free { font-family:'Press Start 2P',monospace; font-size:11px; color:var(--green); }

        /* EMPTY STATE */
        .empty { text-align:center; padding:80px 20px; }
        .empty-icon { font-size:64px; margin-bottom:16px; }
        .empty-title { font-family:'Press Start 2P',monospace; font-size:14px; color:white; margin-bottom:8px; }
        .empty-sub { color:var(--muted); font-size:15px; }

        /* PAGINATION */
        .pagination { display:flex; gap:8px; justify-content:center; margin-top:32px; }
        .pagination a, .pagination span {
            padding:8px 14px; border-radius:4px; font-size:14px; font-weight:600;
            text-decoration:none; border:1px solid var(--border);
            color:var(--muted); background:var(--card);
        }
        .pagination a:hover { border-color:var(--purple); color:var(--purple-light); }
        .pagination .active { background:var(--purple); color:white; border-color:var(--purple); }

        footer { border-top:1px solid var(--border); padding:24px 40px; display:flex; align-items:center; justify-content:space-between; }
        .footer-logo { font-family:'Press Start 2P',monospace; font-size:10px; color:var(--purple-light); }
        .footer-logo span { color:var(--gold); }
        .footer-copy { font-size:12px; color:var(--muted); }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav>
    <a href="/" class="logo">PIXEL<span>SMASHERS</span></a>
    <ul class="nav-links">
        <li><a href="/marketplace" style="color:var(--purple-light)">Browse</a></li>
        <li><a href="#">Categories</a></li>
        <li><a href="#">Sellers</a></li>
    </ul>
    <div class="nav-btns">
        @auth
            <span style="color:var(--purple-light);font-weight:600;font-size:14px;">👋 {{ Auth::user()->name }}</span>
            @if(Auth::user()->role == 'seller')
                <a href="/seller/dashboard" class="btn-ghost">Dashboard</a>
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

<!-- PAGE HEADER -->
<div class="page-header">
    <div class="page-title">BROWSE <span>ASSETS</span></div>
    <div class="page-sub">Discover {{ $products->total() }} pixel art assets</div>
</div>

<!-- LAYOUT -->
<div class="layout">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="filter-title">FILTERS</div>

        <div class="filter-group">
            <span class="filter-label">Category</span>
            <div class="filter-options">
                <a href="/marketplace" class="{{ !request('category') ? 'active' : '' }}">All Categories</a>
                <a href="/marketplace?category=tileset" class="{{ request('category') == 'tileset' ? 'active' : '' }}">🗺️ Tilesets</a>
                <a href="/marketplace?category=character" class="{{ request('category') == 'character' ? 'active' : '' }}">🧍 Characters</a>
                <a href="/marketplace?category=background" class="{{ request('category') == 'background' ? 'active' : '' }}">🖼️ Backgrounds</a>
                <a href="/marketplace?category=effect" class="{{ request('category') == 'effect' ? 'active' : '' }}">✨ Effects</a>
                <a href="/marketplace?category=ui" class="{{ request('category') == 'ui' ? 'active' : '' }}">🎮 UI Packs</a>
                <a href="/marketplace?category=icon" class="{{ request('category') == 'icon' ? 'active' : '' }}">🎵 Icons</a>
            </div>
        </div>

        <div class="filter-group">
            <span class="filter-label">Type</span>
            <div class="filter-options">
                <a href="/marketplace" class="{{ !request('type') ? 'active' : '' }}">All</a>
                <a href="/marketplace?type=free" class="{{ request('type') == 'free' ? 'active' : '' }}">🆓 Free</a>
                <a href="/marketplace?type=paid" class="{{ request('type') == 'paid' ? 'active' : '' }}">💰 Paid</a>
            </div>
        </div>
    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- SEARCH -->
        <form method="GET" action="/marketplace" class="search-bar">
            <input type="text" name="search" class="search-input" placeholder="Search assets..." value="{{ request('search') }}">
            <button type="submit" class="search-btn">SEARCH</button>
        </form>

        <!-- SORT -->
        <div class="sort-bar">
            <span class="results-count">{{ $products->total() }} assets found</span>
            <form method="GET" action="/marketplace">
                <select name="sort" class="sort-select" onchange="this.form.submit()">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Top Rated</option>
                </select>
            </form>
        </div>

        <!-- PRODUCTS -->
        @if($products->count() > 0)
            <div class="grid">
                @foreach($products as $product)
                <a href="/product/{{ $product->id }}" class="card">
                    <div class="card-img">
                        @if($product->preview_image)
                            <img src="{{ asset('storage/' . $product->preview_image) }}" alt="{{ $product->title }}">
                        @else
                            🎮
                        @endif
                        <span class="badge {{ $product->is_free ? 'badge-free' : 'badge-paid' }}">
                            {{ $product->is_free ? 'FREE' : 'PAID' }}
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="card-cat">{{ ucfirst($product->category) }}</div>
                        <div class="card-name">{{ $product->title }}</div>
                        <div class="card-seller">by {{ $product->seller->name }}</div>
                        <div class="card-foot">
                            @if($product->is_free)
                                <span class="price-free">FREE</span>
                            @else
                                <span class="price">${{ number_format($product->price, 2) }}</span>
                            @endif
                            <span style="color:var(--muted);font-size:12px;">⬇️ {{ $product->downloads }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- PAGINATION -->
            <div class="pagination">
                {{ $products->links() }}
            </div>

        @else
            <div class="empty">
                <div class="empty-icon">🎮</div>
                <div class="empty-title">NO ASSETS FOUND</div>
                <div class="empty-sub">Try different filters or search terms</div>
            </div>
        @endif
    </div>
</div>

<footer>
    <div class="footer-logo">PIXEL<span>SMASHERS</span></div>
    <div class="footer-copy">© 2026 Pixel Smashers. All rights reserved.</div>
</footer>

</body>
</html>