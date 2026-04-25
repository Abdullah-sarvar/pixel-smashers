<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel – Pixel Smashers</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        :root { --bg:#0a0a0f; --card:#12121a; --border:#2a2a3a; --purple:#7c3aed; --purple-light:#a78bfa; --gold:#f59e0b; --green:#10b981; --text:#e2e8f0; --muted:#64748b; --error:#f87171; }
        body { background:var(--bg); color:var(--text); font-family:'Rajdhani',sans-serif; }
        nav { position:sticky; top:0; z-index:100; display:flex; align-items:center; justify-content:space-between; padding:0 40px; height:64px; background:rgba(10,10,15,0.97); border-bottom:1px solid var(--border); }
        .logo { font-family:'Press Start 2P',monospace; font-size:12px; color:var(--purple-light); text-decoration:none; }
        .logo span { color:var(--gold); }
        .nav-btns { display:flex; gap:10px; align-items:center; }
        .btn-ghost { padding:8px 18px; border:1px solid var(--border); background:transparent; color:var(--text); border-radius:4px; font-family:'Rajdhani',sans-serif; font-weight:600; font-size:14px; text-decoration:none; cursor:pointer; }
        .container { max-width:1100px; margin:0 auto; padding:40px; }
        .page-title { font-family:'Press Start 2P',monospace; font-size:16px; color:white; margin-bottom:32px; }
        .page-title span { color:var(--purple-light); }
        .success-box { background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.3); border-radius:6px; padding:12px 16px; margin-bottom:24px; font-size:14px; color:var(--green); }
        .stats-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:32px; }
        .stat-card { background:var(--card); border:1px solid var(--border); border-radius:8px; padding:20px; }
        .stat-label { font-size:12px; color:var(--muted); letter-spacing:1px; text-transform:uppercase; margin-bottom:8px; }
        .stat-value { font-family:'Press Start 2P',monospace; font-size:20px; color:var(--gold); }
        .section-title { font-family:'Press Start 2P',monospace; font-size:11px; color:white; margin-bottom:16px; }
        .table-wrap { background:var(--card); border:1px solid var(--border); border-radius:8px; overflow:hidden; margin-bottom:32px; }
        .table-header { padding:16px 20px; border-bottom:1px solid var(--border); }
        table { width:100%; border-collapse:collapse; }
        th { padding:12px 16px; text-align:left; font-size:11px; font-weight:600; color:var(--muted); letter-spacing:1px; text-transform:uppercase; border-bottom:1px solid var(--border); }
        td { padding:12px 16px; font-size:14px; border-bottom:1px solid var(--border); }
        tr:last-child td { border-bottom:none; }
        tr:hover td { background:rgba(124,58,237,0.05); }
        .badge-buyer { background:rgba(124,58,237,0.2); color:var(--purple-light); border:1px solid rgba(124,58,237,0.3); padding:3px 8px; border-radius:4px; font-size:11px; font-weight:700; }
        .badge-seller { background:rgba(245,158,11,0.2); color:var(--gold); border:1px solid rgba(245,158,11,0.3); padding:3px 8px; border-radius:4px; font-size:11px; font-weight:700; }
        .badge-free { background:rgba(16,185,129,0.2); color:var(--green); border:1px solid rgba(16,185,129,0.3); padding:3px 8px; border-radius:4px; font-size:11px; }
        .badge-paid { background:rgba(245,158,11,0.2); color:var(--gold); border:1px solid rgba(245,158,11,0.3); padding:3px 8px; border-radius:4px; font-size:11px; }
        .btn-delete { padding:6px 14px; background:rgba(248,113,113,0.1); color:var(--error); border:1px solid rgba(248,113,113,0.3); border-radius:4px; font-size:13px; font-weight:600; cursor:pointer; font-family:'Rajdhani',sans-serif; }
        footer { border-top:1px solid var(--border); padding:24px 40px; display:flex; align-items:center; justify-content:space-between; margin-top:40px; }
        .footer-logo { font-family:'Press Start 2P',monospace; font-size:10px; color:var(--purple-light); }
        .footer-logo span { color:var(--gold); }
        .footer-copy { font-size:12px; color:var(--muted); }
    </style>
</head>
<body>
<nav>
    <a href="/" class="logo">PIXEL<span>SMASHERS</span></a>
    <div class="nav-btns">
        <a href="/marketplace" class="btn-ghost">Marketplace</a>
        <form method="POST" action="/logout" style="display:inline;">
            @csrf
            <button type="submit" class="btn-ghost">Logout</button>
        </form>
    </div>
</nav>
<div class="container">
    <div class="page-title">ADMIN <span>PANEL</span></div>

    @if(session('success'))
        <div class="success-box">✅ {{ session('success') }}</div>
    @endif

    <!-- STATS -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Users</div>
            <div class="stat-value">{{ $users->count() }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Products</div>
            <div class="stat-value">{{ $products->count() }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Sellers</div>
            <div class="stat-value">{{ $users->where('role','seller')->count() }}</div>
        </div>
    </div>

    <!-- USERS TABLE -->
    <div class="table-wrap">
        <div class="table-header">
            <div class="section-title">ALL USERS</div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td style="color:var(--muted);">{{ $user->id }}</td>
                    <td style="color:white;font-weight:600;">{{ $user->name }}</td>
                    <td style="color:var(--muted);">{{ $user->email }}</td>
                    <td>
                        @if($user->role == 'seller')
                            <span class="badge-seller">SELLER</span>
                        @else
                            <span class="badge-buyer">BUYER</span>
                        @endif
                    </td>
                    <td style="color:var(--muted);">{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                        <form method="POST" action="/admin/user/{{ $user->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Delete this user?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- PRODUCTS TABLE -->
    <div class="table-wrap">
        <div class="table-header">
            <div class="section-title">ALL PRODUCTS</div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Seller</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td style="color:var(--muted);">{{ $product->id }}</td>
                    <td style="color:white;font-weight:600;">{{ $product->title }}</td>
                    <td style="color:var(--purple-light);">{{ $product->seller->name }}</td>
                    <td style="color:var(--muted);">{{ ucfirst($product->category) }}</td>
                    <td style="color:var(--gold);">{{ $product->is_free ? 'Free' : '$'.$product->price }}</td>
                    <td>
                        @if($product->is_free)
                            <span class="badge-free">FREE</span>
                        @else
                            <span class="badge-paid">PAID</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="/admin/product/{{ $product->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<footer>
    <div class="footer-logo">PIXEL<span>SMASHERS</span></div>
    <div class="footer-copy">© 2026 Pixel Smashers</div>
</footer>
</body>
</html>