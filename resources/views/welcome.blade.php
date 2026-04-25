@extends('layouts.app')

@section('title', 'Pixel Smashers – Pixel Art Marketplace')

@section('styles')
<style>
    body::before { content: ''; position: fixed; inset: 0; background-image: linear-gradient(rgba(124,58,237,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(124,58,237,0.03) 1px, transparent 1px); background-size: 32px 32px; pointer-events: none; z-index: 0; }
    .hero { position:relative; min-height:100vh; display:flex; align-items:center; justify-content:center; text-align:center; padding:100px 20px 60px; z-index:1; }
    .hero-glow { position:absolute; width:600px; height:600px; background:radial-gradient(circle, rgba(124,58,237,0.15) 0%, transparent 70%); top:50%; left:50%; transform:translate(-50%,-50%); pointer-events:none; }
    .hero-badge { display:inline-block; padding:6px 16px; background:rgba(124,58,237,0.15); border:1px solid rgba(124,58,237,0.4); border-radius:100px; font-size:12px; font-weight:600; color:var(--purple-light); letter-spacing:2px; text-transform:uppercase; margin-bottom:24px; }
    .hero h1 { font-family:'Press Start 2P',monospace; font-size:clamp(24px,4vw,48px); line-height:1.6; color:white; margin-bottom:8px; }
    .hero h1 span { color:var(--gold); }
    .hero-sub { font-size:18px; color:var(--muted); max-width:520px; margin:16px auto 40px; line-height:1.7; }
    .hero-actions { display:flex; gap:16px; justify-content:center; flex-wrap:wrap; }
    .btn-large { padding:14px 32px; font-size:15px; font-weight:700; letter-spacing:2px; border-radius:4px; text-decoration:none; cursor:pointer; transition:all 0.2s; display:inline-block; }
    .btn-large.primary { background:var(--purple); color:white; border:none; }
    .btn-large.primary:hover { background:#6d28d9; transform:translateY(-2px); }
    .btn-large.ghost { background:transparent; color:var(--text); border:1px solid var(--border); }
    .btn-large.ghost:hover { border-color:var(--purple); color:var(--purple-light); }
    .hero-stats { display:flex; gap:48px; justify-content:center; margin-top:64px; }
    .stat { text-align:center; }
    .stat-number { font-family:'Press Start 2P',monospace; font-size:20px; color:var(--gold); display:block; margin-bottom:6px; }
    .stat-label { font-size:13px; color:var(--muted); letter-spacing:1px; text-transform:uppercase; }
    section { position:relative; z-index:1; padding:80px 40px; max-width:1200px; margin:0 auto; }
    .section-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:40px; }
    .section-title { font-family:'Press Start 2P',monospace; font-size:16px; color:white; }
    .section-title span { color:var(--purple-light); }
    .view-all { color:var(--purple-light); text-decoration:none; font-weight:600; font-size:14px; }
    .products-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:20px; }
    .product-card { background:var(--card); border:1px solid var(--border); border-radius:8px; overflow:hidden; transition:border-color 0.2s,transform 0.2s; text-decoration:none; color:inherit; display:block; }
    .product-card:hover { border-color:var(--purple); transform:translateY(-4px); }
    .card-preview { width:100%; height:180px; display:flex; align-items:center; justify-content:center; font-size:64px; position:relative; overflow:hidden; }
    .card-badge { position:absolute; top:10px; right:10px; padding:4px 10px; border-radius:4px; font-size:11px; font-weight:700; letter-spacing:1px; text-transform:uppercase; }
    .badge-free { background:rgba(16,185,129,0.2); color:var(--green); border:1px solid rgba(16,185,129,0.3); }
    .badge-paid { background:rgba(245,158,11,0.2); color:var(--gold); border:1px solid rgba(245,158,11,0.3); }
    .badge-hot { background:rgba(239,68,68,0.2); color:#f87171; border:1px solid rgba(239,68,68,0.3); }
    .card-body { padding:16px; }
    .card-category { font-size:11px; font-weight:600; color:var(--purple-light); letter-spacing:2px; text-transform:uppercase; margin-bottom:6px; }
    .card-title { font-size:16px; font-weight:700; color:white; margin-bottom:8px; }
    .card-footer { display:flex; align-items:center; justify-content:space-between; margin-top:12px; padding-top:12px; border-top:1px solid var(--border); }
    .card-price { font-family:'Press Start 2P',monospace; font-size:13px; color:var(--gold); }
    .card-price.free { color:var(--green); }
    .stars { color:var(--gold); font-size:12px; }
    .categories-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(160px,1fr)); gap:16px; }
    .category-card { background:var(--card); border:1px solid var(--border); border-radius:8px; padding:24px 16px; text-align:center; transition:border-color 0.2s,background 0.2s; text-decoration:none; color:inherit; display:block; }
    .category-card:hover { border-color:var(--purple); background:rgba(124,58,237,0.08); }
    .category-icon { font-size:36px; margin-bottom:10px; display:block; }
    .category-name { font-weight:700; font-size:14px; color:white; }
    .category-count { font-size:12px; color:var(--muted); margin-top:4px; }
    .cta-banner { background:linear-gradient(135deg,rgba(124,58,237,0.2),rgba(109,40,217,0.1)); border:1px solid rgba(124,58,237,0.3); border-radius:12px; padding:60px 40px; text-align:center; margin:0 40px 80px; position:relative; z-index:1; overflow:hidden; }
    .cta-banner h2 { font-family:'Press Start 2P',monospace; font-size:clamp(14px,2.5vw,22px); color:white; margin-bottom:16px; }
    .cta-banner p { color:var(--muted); font-size:16px; margin-bottom:32px; }
</style>
@endsection

@section('content')

<div class="hero">
    <div class="hero-glow"></div>
    <div>
        <div class="hero-badge">🎮 #1 Pixel Art Marketplace</div>
        <h1>BUY & SELL<br><span>PIXEL ART</span><br>ASSETS</h1>
        <p class="hero-sub">Discover thousands of tilesets, sprites, animations, and UI packs made by talented pixel artists worldwide.</p>
        <div class="hero-actions">
            <a href="/marketplace" class="btn-large primary">Browse Assets</a>
            @guest
                <a href="/register" class="btn-large ghost">Start Selling</a>
            @endguest
            @auth
                @if(Auth::user()->role == 'seller')
                    <a href="/seller/upload" class="btn-large ghost">+ Upload Asset</a>
                @endif
            @endauth
        </div>
        <div class="hero-stats">
            <div class="stat"><span class="stat-number">2.4K+</span><span class="stat-label">Assets</span></div>
            <div class="stat"><span class="stat-number">840+</span><span class="stat-label">Artists</span></div>
            <div class="stat"><span class="stat-number">12K+</span><span class="stat-label">Buyers</span></div>
        </div>
    </div>
</div>

<section>
    <div class="section-header">
        <h2 class="section-title">FEATURED <span>ASSETS</span></h2>
        <a href="/marketplace" class="view-all">View All →</a>
    </div>
    <div class="products-grid">
        <a href="/marketplace" class="product-card">
            <div class="card-preview" style="background:linear-gradient(135deg,#1a1a2e,#16213e);">🏰<span class="card-badge badge-hot">HOT</span></div>
            <div class="card-body"><div class="card-category">Tileset</div><div class="card-title">Medieval Castle Pack</div><div class="card-footer"><span class="card-price">$12.00</span><span class="stars">★★★★★</span></div></div>
        </a>
        <a href="/marketplace" class="product-card">
            <div class="card-preview" style="background:linear-gradient(135deg,#0f2027,#203a43);">🧙<span class="card-badge badge-paid">PAID</span></div>
            <div class="card-body"><div class="card-category">Character Sprite</div><div class="card-title">Wizard Animation Set</div><div class="card-footer"><span class="card-price">$8.00</span><span class="stars">★★★★☆</span></div></div>
        </a>
        <a href="/marketplace" class="product-card">
            <div class="card-preview" style="background:linear-gradient(135deg,#134e5e,#71b280);">🌿<span class="card-badge badge-free">FREE</span></div>
            <div class="card-body"><div class="card-category">Background</div><div class="card-title">Forest Environment</div><div class="card-footer"><span class="card-price free">FREE</span><span class="stars">★★★★★</span></div></div>
        </a>
        <a href="/marketplace" class="product-card">
            <div class="card-preview" style="background:linear-gradient(135deg,#1a0533,#3d0066);">⚔️<span class="card-badge badge-paid">PAID</span></div>
            <div class="card-body"><div class="card-category">UI Pack</div><div class="card-title">RPG Interface Kit</div><div class="card-footer"><span class="card-price">$15.00</span><span class="stars">★★★★☆</span></div></div>
        </a>
    </div>
</section>

<section>
    <div class="section-header">
        <h2 class="section-title">BROWSE <span>CATEGORIES</span></h2>
    </div>
    <div class="categories-grid">
        <a href="/marketplace?category=tileset" class="category-card"><span class="category-icon">🗺️</span><div class="category-name">Tilesets</div><div class="category-count">342 assets</div></a>
        <a href="/marketplace?category=character" class="category-card"><span class="category-icon">🧍</span><div class="category-name">Characters</div><div class="category-count">218 assets</div></a>
        <a href="/marketplace?category=effect" class="category-card"><span class="category-icon">✨</span><div class="category-name">Effects</div><div class="category-count">156 assets</div></a>
        <a href="/marketplace?category=background" class="category-card"><span class="category-icon">🖼️</span><div class="category-name">Backgrounds</div><div class="category-count">198 assets</div></a>
        <a href="/marketplace?category=ui" class="category-card"><span class="category-icon">🎮</span><div class="category-name">UI Packs</div><div class="category-count">124 assets</div></a>
        <a href="/marketplace?category=icon" class="category-card"><span class="category-icon">🎵</span><div class="category-name">Icons</div><div class="category-count">87 assets</div></a>
    </div>
</section>

<div class="cta-banner">
    <h2>ARE YOU A PIXEL ARTIST?</h2>
    <p>Join hundreds of artists already selling their work on Pixel Smashers. Start earning today!</p>
    <a href="/register" class="btn-large primary">Start Selling Free</a>
</div>

@endsection