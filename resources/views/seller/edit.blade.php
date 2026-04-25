<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Asset – Pixel Smashers</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        :root { --bg:#0a0a0f; --card:#12121a; --border:#2a2a3a; --purple:#7c3aed; --purple-light:#a78bfa; --gold:#f59e0b; --text:#e2e8f0; --muted:#64748b; --error:#f87171; }
        body { background:var(--bg); color:var(--text); font-family:'Rajdhani',sans-serif; }
        nav { position:sticky; top:0; z-index:100; display:flex; align-items:center; justify-content:space-between; padding:0 40px; height:64px; background:rgba(10,10,15,0.97); border-bottom:1px solid var(--border); }
        .logo { font-family:'Press Start 2P',monospace; font-size:12px; color:var(--purple-light); text-decoration:none; }
        .logo span { color:var(--gold); }
        .btn-ghost { padding:8px 18px; border:1px solid var(--border); background:transparent; color:var(--text); border-radius:4px; font-family:'Rajdhani',sans-serif; font-weight:600; font-size:14px; text-decoration:none; }
        .container { max-width:700px; margin:0 auto; padding:40px; }
        .page-title { font-family:'Press Start 2P',monospace; font-size:15px; color:white; margin-bottom:4px; }
        .page-title span { color:var(--purple-light); }
        .page-sub { color:var(--muted); font-size:14px; margin-bottom:32px; }
        .form-card { background:var(--card); border:1px solid var(--border); border-radius:12px; padding:32px; }
        .error-box { background:rgba(248,113,113,0.1); border:1px solid rgba(248,113,113,0.3); border-radius:6px; padding:12px 16px; margin-bottom:20px; font-size:13px; color:var(--error); }
        .form-group { margin-bottom:20px; }
        .form-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:20px; }
        label { display:block; font-size:12px; font-weight:600; color:var(--muted); letter-spacing:1px; text-transform:uppercase; margin-bottom:8px; }
        input[type="text"], input[type="number"], textarea, select { width:100%; padding:12px 16px; background:#0d0d14; border:1px solid var(--border); border-radius:6px; color:var(--text); font-family:'Rajdhani',sans-serif; font-size:15px; outline:none; transition:border-color 0.2s; }
        input:focus, textarea:focus, select:focus { border-color:var(--purple); }
        textarea { resize:vertical; min-height:100px; }
        select option { background:#12121a; }
        .toggle-group { display:flex; align-items:center; gap:12px; }
        .toggle { position:relative; width:44px; height:24px; }
        .toggle input { opacity:0; width:0; height:0; }
        .slider { position:absolute; inset:0; background:var(--border); border-radius:24px; cursor:pointer; transition:0.3s; }
        .slider:before { content:''; position:absolute; width:18px; height:18px; left:3px; bottom:3px; background:white; border-radius:50%; transition:0.3s; }
        input:checked + .slider { background:var(--purple); }
        input:checked + .slider:before { transform:translateX(20px); }
        .toggle-label { font-size:14px; font-weight:600; color:var(--text); }
        .btn-submit { width:100%; padding:14px; background:var(--purple); color:white; border:none; border-radius:6px; font-family:'Rajdhani',sans-serif; font-weight:700; font-size:15px; letter-spacing:2px; cursor:pointer; text-transform:uppercase; margin-top:8px; }
        .btn-submit:hover { background:#6d28d9; }
        .back-link { display:inline-block; margin-bottom:20px; color:var(--muted); text-decoration:none; font-size:14px; }
        footer { border-top:1px solid var(--border); padding:24px 40px; display:flex; align-items:center; justify-content:space-between; margin-top:40px; }
        .footer-logo { font-family:'Press Start 2P',monospace; font-size:10px; color:var(--purple-light); }
        .footer-logo span { color:var(--gold); }
        .footer-copy { font-size:12px; color:var(--muted); }
    </style>
</head>
<body>
<nav>
    <a href="/" class="logo">PIXEL<span>SMASHERS</span></a>
    <a href="/seller/dashboard" class="btn-ghost">← Dashboard</a>
</nav>
<div class="container">
    <a href="/seller/dashboard" class="back-link">← Back to Dashboard</a>
    <div class="page-title">EDIT <span>ASSET</span></div>
    <div class="page-sub">Update your pixel art listing</div>
    <div class="form-card">
        @if($errors->any())
            <div class="error-box">
                @foreach($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form method="POST" action="/seller/edit/{{ $product->id }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Asset Title</label>
                <input type="text" name="title" value="{{ old('title', $product->title) }}" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="form-row">
                <div>
                    <label>Category</label>
                    <select name="category" required>
                        <option value="tileset" {{ $product->category == 'tileset' ? 'selected' : '' }}>🗺️ Tileset</option>
                        <option value="character" {{ $product->category == 'character' ? 'selected' : '' }}>🧍 Character</option>
                        <option value="background" {{ $product->category == 'background' ? 'selected' : '' }}>🖼️ Background</option>
                        <option value="effect" {{ $product->category == 'effect' ? 'selected' : '' }}>✨ Effect</option>
                        <option value="ui" {{ $product->category == 'ui' ? 'selected' : '' }}>🎮 UI Pack</option>
                        <option value="icon" {{ $product->category == 'icon' ? 'selected' : '' }}>🎵 Icons</option>
                    </select>
                </div>
                <div>
                    <label>Price (USD)</label>
                    <input type="number" name="price" min="0" step="0.01" value="{{ old('price', $product->price) }}">
                </div>
            </div>
            <div class="form-group">
                <div class="toggle-group">
                    <label class="toggle">
                        <input type="checkbox" name="is_free" {{ $product->is_free ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                    <span class="toggle-label">This asset is FREE</span>
                </div>
            </div>
            <button type="submit" class="btn-submit">💾 UPDATE ASSET</button>
        </form>
    </div>
</div>
<footer>
    <div class="footer-logo">PIXEL<span>SMASHERS</span></div>
    <div class="footer-copy">© 2026 Pixel Smashers</div>
</footer>
</body>
</html>