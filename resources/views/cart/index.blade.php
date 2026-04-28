@extends('layouts.app')
@section('title', 'Cart – Pixel Smashers')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-5 sm:px-10">
    <div class="font-pixel text-base text-[var(--text)] mb-8">MY <span class="text-[var(--accent-light)]">CART</span></div>

    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-md py-3 px-4 mb-5 text-sm text-[var(--green)]">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-500/10 border border-red-500/30 rounded-md py-3 px-4 mb-5 text-sm text-red-400">❌ {{ session('error') }}</div>
    @endif

    @if($cartItems->count() > 0)
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-6 items-start">
        
        <!-- Cart Items List -->
        <div class="bg-[var(--card)] pixel-border flex flex-col">
            @foreach($cartItems as $item)
            <div class="flex items-center gap-4 p-4 border-b border-[var(--border)] last:border-b-0">
                <div class="w-16 h-16 bg-gradient-to-br from-[var(--bg)] to-[#16213e] rounded-md flex items-center justify-center text-[28px] shrink-0 overflow-hidden border border-[var(--border)]">
                    @if($item->product->preview_image)
                        <img src="{{ asset('storage/'.$item->product->preview_image) }}" alt="" class="w-full h-full object-cover">
                    @else
                        🎮
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-base font-bold text-[var(--text)] mb-1 truncate">{{ $item->product->title }}</div>
                    <div class="text-xs text-[var(--accent-light)] uppercase tracking-widest">{{ ucfirst($item->product->category) }}</div>
                </div>
                <div class="font-pixel text-[13px] text-[var(--gold)] shrink-0">
                    {{ $item->product->is_free ? 'FREE' : '$'.number_format($item->product->price,2) }}
                </div>
                <form method="POST" action="/cart/remove/{{ $item->product_id }}" class="shrink-0 ml-2">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 bg-red-500/10 text-red-400 border border-red-500/30 rounded font-semibold text-xs hover:bg-red-500/20 transition-colors">Remove</button>
                </form>
            </div>
            @endforeach
        </div>

        <!-- Order Summary -->
        <div class="bg-[var(--card)] pixel-border p-6 lg:sticky lg:top-24">
            <div class="font-pixel text-[11px] text-[var(--text)] mb-5 tracking-widest">ORDER SUMMARY</div>
            <div class="flex justify-between mb-3 text-[15px]">
                <span class="text-[var(--muted)]">Items</span>
                <span class="text-[var(--text)] font-semibold">{{ $cartItems->count() }}</span>
            </div>
            <div class="flex justify-between pt-4 border-t border-[var(--border)] mt-2">
                <span class="font-bold text-base text-[var(--text)]">Total</span>
                <span class="font-pixel text-base text-[var(--gold)]">${{ number_format($total, 2) }}</span>
            </div>
            <form method="POST" action="/cart/checkout" class="mt-5">
                @csrf
                <button type="submit" class="btn-pixel !w-full !text-center btn-pixel-gold !py-3">🛒 CHECKOUT</button>
            </form>
        </div>
    </div>

    @else
    <div class="text-center py-16 px-5 pixel-border bg-[var(--card)]/50">
        <div class="text-5xl mb-4">🛒</div>
        <div class="font-pixel text-xs text-[var(--text)] mb-2 tracking-widest">CART IS EMPTY</div>
        <div class="text-sm text-[var(--muted)] mb-6">Browse marketplace and add some assets!</div>
        <a href="/marketplace" class="btn-pixel inline-block !py-2.5 !px-6">Browse Assets</a>
    </div>
    @endif
</div>
@endsection