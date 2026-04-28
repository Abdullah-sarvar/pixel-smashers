@extends('layouts.app')

@section('title', 'Marketplace – Pixel Smashers')

@section('content')

<!-- PAGE HEADER -->
<div class="bg-gradient-to-br from-[var(--accent)]/15 to-transparent border-b border-[var(--border)] p-10">
    <div class="font-pixel text-lg text-[var(--text)] mb-2">BROWSE <span class="text-[var(--accent-light)]">ASSETS</span></div>
    <div class="text-[var(--muted)] text-[15px]">Discover {{ $products->total() }} pixel art assets</div>
</div>

<!-- LAYOUT -->
<div class="grid grid-cols-[240px_1fr] gap-0 min-h-[calc(100vh-130px)]">

    <!-- SIDEBAR -->
    <div class="border-r border-[var(--border)] p-6">
        <div class="font-pixel text-[10px] text-[var(--accent-light)] mb-4 tracking-widest">FILTERS</div>

        <div class="mb-6">
            <span class="text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2.5 block">Category</span>
            <div class="flex flex-col gap-1.5">
                <a href="/marketplace" class="px-3 py-2 rounded-md text-sm font-semibold text-[var(--muted)] no-underline transition-all border border-transparent hover:text-[var(--accent-light)] hover:bg-[var(--accent)]/10 hover:border-[var(--accent)]/30 {{ !request('category') ? '!text-[var(--accent-light)] !bg-[var(--accent)]/10 !border-[var(--accent)]/30' : '' }}">All Categories</a>
                <a href="/marketplace?category=tileset" class="px-3 py-2 rounded-md text-sm font-semibold text-[var(--muted)] no-underline transition-all border border-transparent hover:text-[var(--accent-light)] hover:bg-[var(--accent)]/10 hover:border-[var(--accent)]/30 {{ request('category') == 'tileset' ? '!text-[var(--accent-light)] !bg-[var(--accent)]/10 !border-[var(--accent)]/30' : '' }}">🗺️ Tilesets</a>
                <a href="/marketplace?category=character" class="px-3 py-2 rounded-md text-sm font-semibold text-[var(--muted)] no-underline transition-all border border-transparent hover:text-[var(--accent-light)] hover:bg-[var(--accent)]/10 hover:border-[var(--accent)]/30 {{ request('category') == 'character' ? '!text-[var(--accent-light)] !bg-[var(--accent)]/10 !border-[var(--accent)]/30' : '' }}">🧍 Characters</a>
                <a href="/marketplace?category=background" class="px-3 py-2 rounded-md text-sm font-semibold text-[var(--muted)] no-underline transition-all border border-transparent hover:text-[var(--accent-light)] hover:bg-[var(--accent)]/10 hover:border-[var(--accent)]/30 {{ request('category') == 'background' ? '!text-[var(--accent-light)] !bg-[var(--accent)]/10 !border-[var(--accent)]/30' : '' }}">🖼️ Backgrounds</a>
                <a href="/marketplace?category=effect" class="px-3 py-2 rounded-md text-sm font-semibold text-[var(--muted)] no-underline transition-all border border-transparent hover:text-[var(--accent-light)] hover:bg-[var(--accent)]/10 hover:border-[var(--accent)]/30 {{ request('category') == 'effect' ? '!text-[var(--accent-light)] !bg-[var(--accent)]/10 !border-[var(--accent)]/30' : '' }}">✨ Effects</a>
                <a href="/marketplace?category=ui" class="px-3 py-2 rounded-md text-sm font-semibold text-[var(--muted)] no-underline transition-all border border-transparent hover:text-[var(--accent-light)] hover:bg-[var(--accent)]/10 hover:border-[var(--accent)]/30 {{ request('category') == 'ui' ? '!text-[var(--accent-light)] !bg-[var(--accent)]/10 !border-[var(--accent)]/30' : '' }}">🎮 UI Packs</a>
                <a href="/marketplace?category=icon" class="px-3 py-2 rounded-md text-sm font-semibold text-[var(--muted)] no-underline transition-all border border-transparent hover:text-[var(--accent-light)] hover:bg-[var(--accent)]/10 hover:border-[var(--accent)]/30 {{ request('category') == 'icon' ? '!text-[var(--accent-light)] !bg-[var(--accent)]/10 !border-[var(--accent)]/30' : '' }}">🎵 Icons</a>
            </div>
        </div>

        <div class="mb-6">
            <span class="text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2.5 block">Type</span>
            <div class="flex flex-col gap-1.5">
                <a href="/marketplace" class="px-3 py-2 rounded-md text-sm font-semibold text-[var(--muted)] no-underline transition-all border border-transparent hover:text-[var(--accent-light)] hover:bg-[var(--accent)]/10 hover:border-[var(--accent)]/30 {{ !request('type') ? '!text-[var(--accent-light)] !bg-[var(--accent)]/10 !border-[var(--accent)]/30' : '' }}">All</a>
                <a href="/marketplace?type=free" class="px-3 py-2 rounded-md text-sm font-semibold text-[var(--muted)] no-underline transition-all border border-transparent hover:text-[var(--accent-light)] hover:bg-[var(--accent)]/10 hover:border-[var(--accent)]/30 {{ request('type') == 'free' ? '!text-[var(--accent-light)] !bg-[var(--accent)]/10 !border-[var(--accent)]/30' : '' }}">🆓 Free</a>
                <a href="/marketplace?type=paid" class="px-3 py-2 rounded-md text-sm font-semibold text-[var(--muted)] no-underline transition-all border border-transparent hover:text-[var(--accent-light)] hover:bg-[var(--accent)]/10 hover:border-[var(--accent)]/30 {{ request('type') == 'paid' ? '!text-[var(--accent-light)] !bg-[var(--accent)]/10 !border-[var(--accent)]/30' : '' }}">💰 Paid</a>
            </div>
        </div>
    </div>

    <!-- MAIN -->
    <div class="p-6 sm:p-8">

        <!-- SEARCH -->
        <form method="GET" action="/marketplace" class="flex gap-3 mb-6">
            <input type="text" name="search" class="flex-1 py-3 px-4 bg-[var(--card)] border border-[var(--border)] rounded-md text-[var(--text)] text-[15px] focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm" placeholder="Search assets..." value="{{ request('search') }}">
            <button type="submit" class="btn-pixel !py-3 !px-6">SEARCH</button>
        </form>

        <!-- SORT -->
        <div class="flex items-center justify-between mb-5">
            <span class="text-sm text-[var(--muted)]">{{ $products->total() }} assets found</span>
            <form method="GET" action="/marketplace">
                <select name="sort" class="py-2 px-3 bg-[var(--card)] border border-[var(--border)] rounded-md text-[var(--text)] text-sm focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm" onchange="this.form.submit()">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Top Rated</option>
                </select>
            </form>
        </div>

        <!-- PRODUCTS -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                @foreach($products as $product)
                <a href="/product/{{ $product->id }}" class="block bg-[var(--card)] pixel-border hover:border-[var(--accent)] hover:-translate-y-1 transition-transform no-underline text-inherit">
                    <div class="w-full h-40 flex items-center justify-center text-[54px] relative bg-gradient-to-br from-[var(--bg)] to-[#16213e] overflow-hidden">
                        @if($product->preview_image)
                            <img src="{{ asset('storage/' . $product->preview_image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                        @else
                            🎮
                        @endif
                        <span class="absolute top-2 right-2 px-2 py-1 rounded text-[10px] font-bold tracking-widest uppercase {{ $product->is_free ? 'bg-emerald-500/20 text-[var(--green)] border border-emerald-500/30' : 'bg-amber-500/20 text-[var(--gold)] border border-amber-500/30' }}">
                            {{ $product->is_free ? 'FREE' : 'PAID' }}
                        </span>
                    </div>
                    <div class="p-3.5">
                        <div class="text-[11px] font-semibold text-[var(--accent-light)] tracking-widest uppercase mb-1">{{ ucfirst($product->category) }}</div>
                        <div class="text-[15px] font-bold text-[var(--text)] mb-2 truncate">{{ $product->title }}</div>
                        <div class="text-xs text-[var(--muted)] mb-2 truncate">by {{ $product->seller->name }}</div>
                        <div class="flex items-center justify-between pt-2.5 border-t border-[var(--border)]">
                            @if($product->is_free)
                                <span class="font-pixel text-[11px] text-[var(--green)]">FREE</span>
                            @else
                                <span class="font-pixel text-[11px] text-[var(--gold)]">${{ number_format($product->price, 2) }}</span>
                            @endif
                            <span class="text-[var(--muted)] text-xs">⬇️ {{ $product->downloads }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- PAGINATION -->
            <div class="mt-8 flex justify-center">
                {{ $products->links() }}
            </div>

        @else
            <div class="text-center py-20 px-5">
                <div class="text-6xl mb-4">🎮</div>
                <div class="font-pixel text-sm text-[var(--text)] mb-2">NO ASSETS FOUND</div>
                <div class="text-[15px] text-[var(--muted)]">Try different filters or search terms</div>
            </div>
        @endif
    </div>
</div>

@endsection