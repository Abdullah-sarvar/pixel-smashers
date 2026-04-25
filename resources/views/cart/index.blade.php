@extends('layouts.app')
@section('title', 'Cart – Pixel Smashers')
@section('styles')
<style>
    .container { max-width:1000px; margin:0 auto; padding:40px; }
    .page-title { font-family:'Press Start 2P',monospace; font-size:16px; color:white; margin-bottom:32px; }
    .page-title span { color:var(--purple-light); }
    .success-box { background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.3); border-radius:6px; padding:12px 16px; margin-bottom:20px; font-size:14px; color:var(--green); }
    .error-box { background:rgba(248,113,113,0.1); border:1px solid rgba(248,113,113,0.3); border-radius:6px; padding:12px 16px; margin-bottom:20px; font-size:14px; color:var(--error); }
    .cart-layout { display:grid; grid-template-columns:1fr 320px; gap:24px; align-items:start; }
    .cart-items { background:var(--card); border:1px solid var(--border); border-radius:8px; overflow:hidden; }
    .cart-item { display:flex; align-items:center; gap:16px; padding:16px 20px; border-bottom:1px solid var(--border); }
    .cart-item:last-child { border-bottom:none; }
    .item-img { width:64px; height:64px; background:linear-gradient(135deg,#1a1a2e,#16213e); border-radius:6px; display:flex; align-items:center; justify-content:center; font-size:28px; flex-shrink:0; overflow:hidden; }
    .item-img img { width:100%; height:100%; object-fit:cover; }
    .item-info { flex:1; }
    .item-name { font-size:16px; font-weight:700; color:white; margin-bottom:4px; }
    .item-cat { font-size:12px; color:var(--purple-light); text-transform:uppercase; letter-spacing:1px; }
    .item-price { font-family:'Press Start 2P',monospace; font-size:13px; color:var(--gold); }
    .btn-remove { padding:6px 14px; background:rgba(248,113,113,0.1); color:var(--error); border:1px solid rgba(248,113,113,0.3); border-radius:4px; font-size:13px; font-weight:600; cursor:pointer; font-family:'Rajdhani',sans-serif; }
    .summary-card { background:var(--card); border:1px solid var(--border); border-radius:8px; padding:24px; position:sticky; top:80px; }
    .summary-title { font-family:'Press Start 2P',monospace; font-size:11px; color:white; margin-bottom:20px; }
    .summary-row { display:flex; justify-content:space-between; margin-bottom:12px; font-size:15px; }
    .summary-label { color:var(--muted); }
    .summary-value { color:white; font-weight:600; }
    .summary-total { display:flex; justify-content:space-between; padding-top:16px; border-top:1px solid var(--border); margin-top:8px; }
    .total-label { font-weight:700; font-size:16px; color:white; }
    .total-value { font-family:'Press Start 2P',monospace; font-size:16px; color:var(--gold); }
    .btn-checkout { width:100%; padding:14px; background:var(--purple); color:white; border:none; border-radius:6px; font-family:'Rajdhani',sans-serif; font-weight:700; font-size:15px; letter-spacing:2px; cursor:pointer; margin-top:20px; text-transform:uppercase; }
    .btn-checkout:hover { background:#6d28d9; }
    .empty { text-align:center; padding:60px 20px; }
    .empty-icon { font-size:48px; margin-bottom:12px; }
    .empty-title { font-family:'Press Start 2P',monospace; font-size:12px; color:white; margin-bottom:8px; }
    .empty-sub { color:var(--muted); font-size:14px; margin-bottom:20px; }
    .btn-browse { padding:12px 28px; background:var(--purple); color:white; border:none; border-radius:6px; font-family:'Rajdhani',sans-serif; font-weight:700; font-size:14px; text-decoration:none; letter-spacing:1px; }
</style>
@endsection

@section('content')
<div class="container">
    <div class="page-title">MY <span>CART</span></div>

    @if(session('success'))
        <div class="success-box">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="error-box">❌ {{ session('error') }}</div>
    @endif

    @if($cartItems->count() > 0)
    <div class="cart-layout">
        <div class="cart-items">
            @foreach($cartItems as $item)
            <div class="cart-item">
                <div class="item-img">
                    @if($item->product->preview_image)
                        <img src="{{ asset('storage/'.$item->product->preview_image) }}" alt="">
                    @else
                        🎮
                    @endif
                </div>
                <div class="item-info">
                    <div class="item-name">{{ $item->product->title }}</div>
                    <div class="item-cat">{{ ucfirst($item->product->category) }}</div>
                </div>
                <div class="item-price">
                    {{ $item->product->is_free ? 'FREE' : '$'.number_format($item->product->price,2) }}
                </div>
                <form method="POST" action="/cart/remove/{{ $item->product_id }}">
                    @csrf
                    <button type="submit" class="btn-remove">Remove</button>
                </form>
            </div>
            @endforeach
        </div>

        <div class="summary-card">
            <div class="summary-title">ORDER SUMMARY</div>
            <div class="summary-row">
                <span class="summary-label">Items</span>
                <span class="summary-value">{{ $cartItems->count() }}</span>
            </div>
            <div class="summary-total">
                <span class="total-label">Total</span>
                <span class="total-value">${{ number_format($total, 2) }}</span>
            </div>
            <form method="POST" action="/cart/checkout">
                @csrf
                <button type="submit" class="btn-checkout">🛒 CHECKOUT</button>
            </form>
        </div>
    </div>

    @else
    <div class="empty">
        <div class="empty-icon">🛒</div>
        <div class="empty-title">CART IS EMPTY</div>
        <div class="empty-sub">Browse marketplace and add some assets!</div>
        <a href="/marketplace" class="btn-browse">Browse Assets</a>
    </div>
    @endif
</div>
@endsection