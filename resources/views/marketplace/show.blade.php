@extends('layouts.app')
@section('title', $product->title . ' – Pixel Smashers')
@section('styles')
<style>
    .container { max-width:1100px; margin:0 auto; padding:40px; }
    .back-link { display:inline-block; margin-bottom:24px; color:var(--muted); text-decoration:none; font-size:14px; }
    .back-link:hover { color:var(--purple-light); }
    .product-layout { display:grid; grid-template-columns:1fr 360px; gap:32px; align-items:start; }
    .product-preview { background:var(--card); border:1px solid var(--border); border-radius:12px; overflow:hidden; }
    .preview-img { width:100%; height:380px; display:flex; align-items:center; justify-content:center; font-size:100px; background:linear-gradient(135deg,#1a1a2e,#16213e); }
    .preview-img img { width:100%; height:100%; object-fit:cover; }
    .product-info { padding:24px; }
    .product-cat { font-size:12px; font-weight:600; color:var(--purple-light); letter-spacing:2px; text-transform:uppercase; margin-bottom:8px; }
    .product-title { font-family:'Press Start 2P',monospace; font-size:16px; color:white; line-height:1.6; margin-bottom:12px; }
    .product-seller { font-size:14px; color:var(--muted); margin-bottom:16px; }
    .product-seller span { color:var(--purple-light); font-weight:600; }
    .product-desc { font-size:15px; color:var(--text); line-height:1.7; }
    .buy-card { background:var(--card); border:1px solid var(--border); border-radius:12px; padding:24px; position:sticky; top:80px; }
    .buy-price { font-family:'Press Start 2P',monospace; font-size:22px; color:var(--gold); margin-bottom:6px; }
    .buy-price.free { color:var(--green); }
    .buy-type { font-size:13px; color:var(--muted); margin-bottom:20px; }
    .btn-buy { width:100%; padding:14px; background:var(--purple); color:white; border:none; border-radius:6px; font-family:'Rajdhani',sans-serif; font-weight:700; font-size:16px; letter-spacing:2px; cursor:pointer; text-transform:uppercase; transition:background 0.2s; margin-bottom:10px; text-decoration:none; display:block; text-align:center; }
    .btn-buy:hover { background:#6d28d9; }
    .btn-buy.free-btn { background:var(--green); }
    .btn-buy.free-btn:hover { background:#059669; }
    .buy-meta { border-top:1px solid var(--border); padding-top:16px; margin-top:16px; }
    .meta-row { display:flex; justify-content:space-between; align-items:center; margin-bottom:10px; font-size:14px; }
    .meta-label { color:var(--muted); }
    .meta-value { color:white; font-weight:600; }
    .seller-card { background:var(--card); border:1px solid var(--border); border-radius:12px; padding:20px; margin-top:16px; }
    .seller-card-title { font-family:'Press Start 2P',monospace; font-size:10px; color:var(--muted); margin-bottom:12px; }
    .seller-name { font-size:16px; font-weight:700; color:white; margin-bottom:4px; }
    .seller-role { font-size:12px; color:var(--purple-light); }
    .success-box { background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.3); border-radius:6px; padding:12px 16px; margin-bottom:16px; font-size:14px; color:var(--green); text-align:center; }

    /* REVIEWS */
    .reviews-section { margin-top:40px; }
    .reviews-title { font-family:'Press Start 2P',monospace; font-size:13px; color:white; margin-bottom:20px; }
    .reviews-title span { color:var(--purple-light); }
    .review-form { background:var(--card); border:1px solid var(--border); border-radius:8px; padding:20px; margin-bottom:24px; }
    .stars-input { display:flex; gap:8px; margin-bottom:12px; }
    .stars-input input { display:none; }
    .stars-input label { font-size:28px; cursor:pointer; color:var(--border); transition:color 0.2s; }
    .stars-input input:checked ~ label,
    .stars-input label:hover,
    .stars-input label:hover ~ label { color:var(--gold); }
    .stars-input { flex-direction:row-reverse; justify-content:flex-end; }
    .review-textarea { width:100%; padding:12px; background:#0d0d14; border:1px solid var(--border); border-radius:6px; color:var(--text); font-family:'Rajdhani',sans-serif; font-size:14px; outline:none; resize:vertical; min-height:80px; margin-bottom:12px; }
    .review-textarea:focus { border-color:var(--purple); }
    .btn-review { padding:10px 24px; background:var(--purple); color:white; border:none; border-radius:6px; font-family:'Rajdhani',sans-serif; font-weight:700; font-size:14px; cursor:pointer; letter-spacing:1px; }
    .review-card { background:var(--card); border:1px solid var(--border); border-radius:8px; padding:16px; margin-bottom:12px; }
    .review-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:8px; }
    .review-user { font-weight:700; color:white; font-size:14px; }
    .review-stars { color:var(--gold); font-size:14px; }
    .review-date { font-size:12px; color:var(--muted); }
    .review-comment { font-size:14px; color:var(--text); line-height:1.6; }
    .no-reviews { text-align:center; padding:30px; color:var(--muted); font-size:14px; }
</style>
@endsection

@section('content')
<div class="container">
    <a href="/marketplace" class="back-link">← Back to Marketplace</a>

    <div class="product-layout">
        <!-- LEFT -->
        <div>
            <div class="product-preview">
                <div class="preview-img">
                    @if($product->preview_image)
                        <img src="{{ asset('storage/'.$product->preview_image) }}" alt="{{ $product->title }}">
                    @else
                        🎮
                    @endif
                </div>
                <div class="product-info">
                    <div class="product-cat">{{ ucfirst($product->category) }}</div>
                    <div class="product-title">{{ $product->title }}</div>
                    <div class="product-seller">by <span>{{ $product->seller->name }}</span></div>
                    <div class="product-desc">{{ $product->description }}</div>
                </div>
            </div>

            <!-- REVIEWS -->
            <div class="reviews-section">
                <div class="reviews-title">CUSTOMER <span>REVIEWS</span></div>

                @auth
                <div class="review-form">
                    @if(session('success'))
                        <div class="success-box">✅ {{ session('success') }}</div>
                    @endif
                    <form method="POST" action="/review/{{ $product->id }}">
                        @csrf
                        <div class="stars-input">
                            <input type="radio" name="rating" id="s5" value="5"><label for="s5">★</label>
                            <input type="radio" name="rating" id="s4" value="4"><label for="s4">★</label>
                            <input type="radio" name="rating" id="s3" value="3"><label for="s3">★</label>
                            <input type="radio" name="rating" id="s2" value="2"><label for="s2">★</label>
                            <input type="radio" name="rating" id="s1" value="1"><label for="s1">★</label>
                        </div>
                        <textarea name="comment" class="review-textarea" placeholder="Write your review..."></textarea>
                        <button type="submit" class="btn-review">Submit Review</button>
                    </form>
                </div>
                @endauth

                @if($product->reviews->count() > 0)
                    @foreach($product->reviews as $review)
                    <div class="review-card">
                        <div class="review-header">
                            <div>
                                <div class="review-user">{{ $review->user->name }}</div>
                                <div class="review-stars">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5-$review->rating) }}</div>
                            </div>
                            <div class="review-date">{{ $review->created_at->format('M d, Y') }}</div>
                        </div>
                        @if($review->comment)
                            <div class="review-comment">{{ $review->comment }}</div>
                        @endif
                    </div>
                    @endforeach
                @else
                    <div class="no-reviews">No reviews yet — be the first to review!</div>
                @endif
            </div>
        </div>

        <!-- RIGHT -->
        <div>
            <div class="buy-card">
                @if(session('success'))
                    <div class="success-box">✅ {{ session('success') }}</div>
                @endif

                <div class="buy-price {{ $product->is_free ? 'free' : '' }}">
                    {{ $product->is_free ? 'FREE' : '$'.number_format($product->price, 2) }}
                </div>
                <div class="buy-type">{{ $product->is_free ? 'Free Download' : 'One-time purchase' }}</div>

                @auth
                    @if($product->is_free)
                        @if($product->file_path)
                            <a href="{{ asset('storage/'.$product->file_path) }}" class="btn-buy free-btn" download>⬇️ DOWNLOAD FREE</a>
                        @else
                            <span class="btn-buy free-btn" style="opacity:0.5;cursor:default;">⬇️ NO FILE YET</span>
                        @endif
                    @else
                        <form method="POST" action="/cart/add/{{ $product->id }}">
                            @csrf
                            <button type="submit" class="btn-buy">🛒 ADD TO CART</button>
                        </form>
                        <a href="/cart" style="display:block;text-align:center;color:var(--purple-light);font-size:14px;margin-top:8px;">View Cart →</a>
                    @endif
                @else
                    <a href="/login" class="btn-buy">🔐 LOGIN TO PURCHASE</a>
                @endauth

                <div class="buy-meta">
                    <div class="meta-row"><span class="meta-label">Category</span><span class="meta-value">{{ ucfirst($product->category) }}</span></div>
                    <div class="meta-row"><span class="meta-label">Type</span><span class="meta-value">{{ $product->is_free ? 'Free' : 'Paid' }}</span></div>
                    <div class="meta-row"><span class="meta-label">Downloads</span><span class="meta-value">{{ $product->downloads }}</span></div>
                    <div class="meta-row"><span class="meta-label">Rating</span><span class="meta-value">{{ $product->rating > 0 ? number_format($product->rating,1).'/5' : 'No ratings' }}</span></div>
                    <div class="meta-row"><span class="meta-label">Added</span><span class="meta-value">{{ $product->created_at->format('M d, Y') }}</span></div>
                </div>
            </div>

            <div class="seller-card">
                <div class="seller-card-title">SELLER</div>
                <div class="seller-name">{{ $product->seller->name }}</div>
                <div class="seller-role">🎨 Pixel Artist</div>
            </div>
        </div>
    </div>
</div>
@endsection