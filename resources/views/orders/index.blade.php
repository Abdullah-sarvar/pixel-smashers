@extends('layouts.app')
@section('title', 'My Orders – Pixel Smashers')
@section('styles')
<style>
    .container { max-width:900px; margin:0 auto; padding:40px; }
    .page-title { font-family:'Press Start 2P',monospace; font-size:16px; color:white; margin-bottom:32px; }
    .page-title span { color:var(--purple-light); }
    .success-box { background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.3); border-radius:6px; padding:12px 16px; margin-bottom:20px; font-size:14px; color:var(--green); }
    .order-card { background:var(--card); border:1px solid var(--border); border-radius:8px; overflow:hidden; margin-bottom:20px; }
    .order-header { display:flex; align-items:center; justify-content:space-between; padding:16px 20px; border-bottom:1px solid var(--border); background:rgba(124,58,237,0.05); }
    .order-id { font-family:'Press Start 2P',monospace; font-size:10px; color:var(--purple-light); }
    .order-date { font-size:13px; color:var(--muted); }
    .order-total { font-family:'Press Start 2P',monospace; font-size:13px; color:var(--gold); }
    .order-status { padding:4px 10px; background:rgba(16,185,129,0.2); color:var(--green); border:1px solid rgba(16,185,129,0.3); border-radius:4px; font-size:11px; font-weight:700; text-transform:uppercase; }
    .order-item { display:flex; align-items:center; gap:14px; padding:14px 20px; border-bottom:1px solid var(--border); }
    .order-item:last-child { border-bottom:none; }
    .item-img { width:52px; height:52px; background:linear-gradient(135deg,#1a1a2e,#16213e); border-radius:6px; display:flex; align-items:center; justify-content:center; font-size:24px; flex-shrink:0; overflow:hidden; }
    .item-img img { width:100%; height:100%; object-fit:cover; }
    .item-name { font-size:15px; font-weight:700; color:white; flex:1; }
    .item-price { font-family:'Press Start 2P',monospace; font-size:11px; color:var(--gold); }
    .btn-download { padding:6px 14px; background:rgba(16,185,129,0.15); color:var(--green); border:1px solid rgba(16,185,129,0.3); border-radius:4px; font-size:13px; font-weight:600; text-decoration:none; }
    .empty { text-align:center; padding:60px 20px; }
    .empty-icon { font-size:48px; margin-bottom:12px; }
    .empty-title { font-family:'Press Start 2P',monospace; font-size:12px; color:white; margin-bottom:8px; }
    .empty-sub { color:var(--muted); font-size:14px; margin-bottom:20px; }
    .btn-browse { padding:12px 28px; background:var(--purple); color:white; border:none; border-radius:6px; font-family:'Rajdhani',sans-serif; font-weight:700; font-size:14px; text-decoration:none; }
</style>
@endsection

@section('content')
<div class="container">
    <div class="page-title">MY <span>ORDERS</span></div>

    @if(session('success'))
        <div class="success-box">✅ {{ session('success') }}</div>
    @endif

    @if($orders->count() > 0)
        @foreach($orders as $order)
        <div class="order-card">
            <div class="order-header">
                <div class="order-id">ORDER #{{ $order->id }}</div>
                <div class="order-date">{{ $order->created_at->format('M d, Y') }}</div>
                <div class="order-total">${{ number_format($order->total_price, 2) }}</div>
                <span class="order-status">{{ $order->status }}</span>
            </div>
            @foreach($order->items as $item)
            <div class="order-item">
                <div class="item-img">
                    @if($item->product->preview_image)
                        <img src="{{ asset('storage/'.$item->product->preview_image) }}" alt="">
                    @else
                        🎮
                    @endif
                </div>
                <div class="item-name">{{ $item->product->title }}</div>
                <div class="item-price">${{ number_format($item->price, 2) }}</div>
                @if($item->product->file_path)
                    <a href="{{ asset('storage/'.$item->product->file_path) }}" class="btn-download" download>⬇️ Download</a>
                @endif
            </div>
            @endforeach
        </div>
        @endforeach
    @else
    <div class="empty">
        <div class="empty-icon">📦</div>
        <div class="empty-title">NO ORDERS YET</div>
        <div class="empty-sub">Browse marketplace and purchase some assets!</div>
        <a href="/marketplace" class="btn-browse">Browse Assets</a>
    </div>
    @endif
</div>
@endsection