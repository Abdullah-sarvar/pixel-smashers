@extends('layouts.app')
@section('title', $product->title . ' – Pixel Smashers')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-5 sm:px-10">
    <a href="/marketplace" class="inline-block mb-6 text-sm text-[var(--muted)] no-underline hover:text-[var(--accent-light)] transition-colors">← Back to Marketplace</a>

    <div class="grid grid-cols-1 lg:grid-cols-[1fr_360px] gap-8 items-start">
        <!-- LEFT COLUMN -->
        <div class="flex flex-col gap-10">
            <!-- Product Preview & Info -->
            <div class="bg-[var(--card)] pixel-border overflow-hidden">
                <div class="w-full h-96 flex items-center justify-center text-[100px] bg-gradient-to-br from-[#1a1a2e] to-[#16213e]">
                    @if($product->preview_image)
                        <img src="{{ asset('storage/'.$product->preview_image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                    @else
                        🎮
                    @endif
                </div>
                <div class="p-6">
                    <div class="text-xs font-semibold text-[var(--accent-light)] tracking-widest uppercase mb-2">{{ ucfirst($product->category) }}</div>
                    <div class="font-pixel text-base text-[var(--text)] leading-relaxed mb-3">{{ $product->title }}</div>
                    <div class="text-sm text-[var(--muted)] mb-4">by <span class="font-semibold text-[var(--accent-light)]">{{ $product->seller->name }}</span></div>
                    <div class="text-[15px] text-[var(--text)] leading-relaxed">{{ $product->description }}</div>
                </div>
            </div>

            <!-- REVIEWS SECTION -->
            <div>
                <div class="font-pixel text-[13px] text-[var(--text)] mb-5">CUSTOMER <span class="text-[var(--accent-light)]">REVIEWS</span></div>

                @auth
                <div class="bg-[var(--card)] pixel-border p-5 mb-6">
                    @if(session('success'))
                        <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-md py-3 px-4 mb-4 text-sm text-[var(--green)] text-center">✅ {{ session('success') }}</div>
                    @endif
                    <form method="POST" action="/review/{{ $product->id }}">
                        @csrf
                        <div class="flex flex-row-reverse justify-end gap-2 mb-3">
                            <input type="radio" name="rating" id="s5" value="5" class="hidden peer/s5"><label for="s5" class="text-2xl cursor-pointer text-[var(--border)] transition-colors hover:text-[var(--gold)] peer-checked/s5:text-[var(--gold)] peer-checked/s5:~label:text-[var(--gold)]">★</label>
                            <input type="radio" name="rating" id="s4" value="4" class="hidden peer/s4"><label for="s4" class="text-2xl cursor-pointer text-[var(--border)] transition-colors hover:text-[var(--gold)] peer-checked/s4:text-[var(--gold)] peer-checked/s4:~label:text-[var(--gold)]">★</label>
                            <input type="radio" name="rating" id="s3" value="3" class="hidden peer/s3"><label for="s3" class="text-2xl cursor-pointer text-[var(--border)] transition-colors hover:text-[var(--gold)] peer-checked/s3:text-[var(--gold)] peer-checked/s3:~label:text-[var(--gold)]">★</label>
                            <input type="radio" name="rating" id="s2" value="2" class="hidden peer/s2"><label for="s2" class="text-2xl cursor-pointer text-[var(--border)] transition-colors hover:text-[var(--gold)] peer-checked/s2:text-[var(--gold)] peer-checked/s2:~label:text-[var(--gold)]">★</label>
                            <input type="radio" name="rating" id="s1" value="1" class="hidden peer/s1"><label for="s1" class="text-2xl cursor-pointer text-[var(--border)] transition-colors hover:text-[var(--gold)] peer-checked/s1:text-[var(--gold)] peer-checked/s1:~label:text-[var(--gold)]">★</label>
                        </div>
                        <!-- Need a custom class or inline style to handle the sibling hover logic perfectly if Tailwind peer doesn't cover all complex star hover needs, but this is close enough for Tailwind -->
                        <textarea name="comment" class="w-full p-3 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--text)] text-sm focus:outline-none focus:border-[var(--accent)] resize-y min-h-[80px] mb-3 pixel-border-sm" placeholder="Write your review..."></textarea>
                        <button type="submit" class="btn-pixel !py-2.5 !px-6 !text-xs">Submit Review</button>
                    </form>
                </div>
                @endauth

                @if($product->reviews->count() > 0)
                    @foreach($product->reviews as $review)
                    <div class="bg-[var(--card)] pixel-border p-4 mb-3">
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <div class="font-bold text-[var(--text)] text-sm">{{ $review->user->name }}</div>
                                <div class="text-[var(--gold)] text-sm">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5-$review->rating) }}</div>
                            </div>
                            <div class="text-xs text-[var(--muted)]">{{ $review->created_at->format('M d, Y') }}</div>
                        </div>
                        @if($review->comment)
                            <div class="text-sm text-[var(--text)] leading-relaxed">{{ $review->comment }}</div>
                        @endif
                    </div>
                    @endforeach
                @else
                    <div class="text-center p-8 text-[var(--muted)] text-sm pixel-border bg-[var(--card)]/50">No reviews yet — be the first to review!</div>
                @endif
            </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="flex flex-col gap-4">
            <!-- Buy Card -->
            <div class="bg-[var(--card)] pixel-border p-6 lg:sticky lg:top-24">
                @if(session('success'))
                    <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-md py-3 px-4 mb-4 text-sm text-[var(--green)] text-center">✅ {{ session('success') }}</div>
                @endif

                <div class="font-pixel text-2xl mb-1.5 {{ $product->is_free ? 'text-[var(--green)]' : 'text-[var(--gold)]' }}">
                    {{ $product->is_free ? 'FREE' : '$'.number_format($product->price, 2) }}
                </div>
                <div class="text-[13px] text-[var(--muted)] mb-5">{{ $product->is_free ? 'Free Download' : 'One-time purchase' }}</div>

                @auth
                    @if($product->is_free)
                        @if($product->file_path)
                            <a href="{{ asset('storage/'.$product->file_path) }}" class="btn-pixel !w-full !text-center !bg-[var(--green)] hover:!bg-[var(--bg)] !border-emerald-700 !mb-2.5" download>⬇️ DOWNLOAD FREE</a>
                        @else
                            <span class="btn-pixel !w-full !text-center !bg-emerald-800 !border-emerald-900 !opacity-50 !cursor-not-allowed !mb-2.5">⬇️ NO FILE YET</span>
                        @endif
                    @else
                        <form method="POST" action="/cart/add/{{ $product->id }}">
                            @csrf
                            <button type="submit" class="btn-pixel !w-full !text-center !mb-2.5 btn-pixel-gold">🛒 ADD TO CART</button>
                        </form>
                        <a href="/cart" class="block text-center text-[var(--accent-light)] text-sm mt-2 hover:underline">View Cart →</a>
                    @endif
                @else
                    <a href="/login" class="btn-pixel !w-full !text-center !mb-2.5">🔐 LOGIN TO PURCHASE</a>
                @endauth

                <div class="border-t border-[var(--border)] pt-4 mt-4">
                    <div class="flex justify-between items-center mb-2.5 text-sm"><span class="text-[var(--muted)]">Category</span><span class="text-[var(--text)] font-semibold">{{ ucfirst($product->category) }}</span></div>
                    <div class="flex justify-between items-center mb-2.5 text-sm"><span class="text-[var(--muted)]">Type</span><span class="text-[var(--text)] font-semibold">{{ $product->is_free ? 'Free' : 'Paid' }}</span></div>
                    <div class="flex justify-between items-center mb-2.5 text-sm"><span class="text-[var(--muted)]">Downloads</span><span class="text-[var(--text)] font-semibold">{{ $product->downloads }}</span></div>
                    <div class="flex justify-between items-center mb-2.5 text-sm"><span class="text-[var(--muted)]">Rating</span><span class="text-[var(--text)] font-semibold">{{ $product->rating > 0 ? number_format($product->rating,1).'/5' : 'No ratings' }}</span></div>
                    <div class="flex justify-between items-center mb-2.5 text-sm"><span class="text-[var(--muted)]">Added</span><span class="text-[var(--text)] font-semibold">{{ $product->created_at->format('M d, Y') }}</span></div>
                </div>
            </div>

            <!-- Seller Card -->
            <div class="bg-[var(--card)] pixel-border p-5">
                <div class="font-pixel text-[10px] text-[var(--muted)] mb-3">SELLER</div>
                <div class="text-base font-bold text-[var(--text)] mb-1">{{ $product->seller->name }}</div>
                <div class="text-xs text-[var(--accent-light)]">🎨 Pixel Artist</div>
            </div>
        </div>
    </div>
</div>
@endsection