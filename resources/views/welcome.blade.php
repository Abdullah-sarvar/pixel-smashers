@extends('layouts.app')

@section('title', 'Pixel Smashers – Pixel Art Marketplace')

@section('content')

<div class="relative min-h-[90vh] flex items-center justify-center text-center px-5 pt-24 pb-16 z-10">
    <div class="absolute w-[600px] h-[600px] bg-[radial-gradient(circle,rgba(var(--accent),0.15)_0%,transparent_70%)] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
    <div>
        <div class="inline-block px-4 py-1.5 bg-[var(--accent)]/15 border border-[var(--accent)]/40 rounded-full text-xs font-semibold text-[var(--accent-light)] tracking-widest uppercase mb-6">🎮 #1 Pixel Art Marketplace</div>
        <h1 class="font-pixel text-clamp-hero leading-relaxed text-[var(--text)] mb-2">BUY & SELL<br><span class="text-[var(--gold)]">PIXEL ART</span><br>ASSETS</h1>
        <p class="text-lg text-[var(--muted)] max-w-lg mx-auto mt-4 mb-10 leading-relaxed">Discover thousands of tilesets, sprites, animations, and UI packs made by talented pixel artists worldwide.</p>
        <div class="flex gap-4 justify-center flex-wrap">
            <a href="/marketplace" class="btn-pixel !px-8 !py-4 !text-sm">Browse Assets</a>
            @guest
                <a href="/register" class="btn-pixel btn-pixel-ghost !px-8 !py-4 !text-sm">Start Selling</a>
            @endguest
            @auth
                @if(Auth::user()->role == 'seller')
                    <a href="/seller/upload" class="btn-pixel btn-pixel-ghost !px-8 !py-4 !text-sm">+ Upload Asset</a>
                @endif
            @endauth
        </div>
        <div class="flex gap-12 justify-center mt-16">
            <div class="text-center"><span class="font-pixel text-xl text-[var(--gold)] block mb-1.5">2.4K+</span><span class="text-sm text-[var(--muted)] tracking-widest uppercase">Assets</span></div>
            <div class="text-center"><span class="font-pixel text-xl text-[var(--gold)] block mb-1.5">840+</span><span class="text-sm text-[var(--muted)] tracking-widest uppercase">Artists</span></div>
            <div class="text-center"><span class="font-pixel text-xl text-[var(--gold)] block mb-1.5">12K+</span><span class="text-sm text-[var(--muted)] tracking-widest uppercase">Buyers</span></div>
        </div>
    </div>
</div>

<section class="relative z-10 py-20 px-10 max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-10">
        <h2 class="font-pixel text-base text-[var(--text)]">FEATURED <span class="text-[var(--accent-light)]">ASSETS</span></h2>
        <a href="/marketplace" class="text-[var(--accent-light)] no-underline font-semibold text-sm hover:underline">View All →</a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
        <!-- Product 1 -->
        <a href="/marketplace" class="block bg-[var(--card)] pixel-border hover:border-[var(--accent)] hover:-translate-y-1 transition-transform no-underline text-inherit">
            <div class="w-full h-44 flex items-center justify-center text-6xl relative overflow-hidden bg-gradient-to-br from-[#1a1a2e] to-[#16213e]">
                🏰
                <span class="absolute top-2.5 right-2.5 px-2.5 py-1 rounded text-[11px] font-bold tracking-widest uppercase bg-red-500/20 text-red-400 border border-red-500/30">HOT</span>
            </div>
            <div class="p-4">
                <div class="text-[11px] font-semibold text-[var(--accent-light)] tracking-widest uppercase mb-1.5">Tileset</div>
                <div class="text-base font-bold text-[var(--text)] mb-2">Medieval Castle Pack</div>
                <div class="flex items-center justify-between mt-3 pt-3 border-t border-[var(--border)]">
                    <span class="font-pixel text-[13px] text-[var(--gold)]">$12.00</span>
                    <span class="text-[var(--gold)] text-xs">★★★★★</span>
                </div>
            </div>
        </a>
        <!-- Product 2 -->
        <a href="/marketplace" class="block bg-[var(--card)] pixel-border hover:border-[var(--accent)] hover:-translate-y-1 transition-transform no-underline text-inherit">
            <div class="w-full h-44 flex items-center justify-center text-6xl relative overflow-hidden bg-gradient-to-br from-[#0f2027] to-[#203a43]">
                🧙
                <span class="absolute top-2.5 right-2.5 px-2.5 py-1 rounded text-[11px] font-bold tracking-widest uppercase bg-amber-500/20 text-amber-500 border border-amber-500/30">PAID</span>
            </div>
            <div class="p-4">
                <div class="text-[11px] font-semibold text-[var(--accent-light)] tracking-widest uppercase mb-1.5">Character Sprite</div>
                <div class="text-base font-bold text-[var(--text)] mb-2">Wizard Animation Set</div>
                <div class="flex items-center justify-between mt-3 pt-3 border-t border-[var(--border)]">
                    <span class="font-pixel text-[13px] text-[var(--gold)]">$8.00</span>
                    <span class="text-[var(--gold)] text-xs">★★★★☆</span>
                </div>
            </div>
        </a>
        <!-- Product 3 -->
        <a href="/marketplace" class="block bg-[var(--card)] pixel-border hover:border-[var(--accent)] hover:-translate-y-1 transition-transform no-underline text-inherit">
            <div class="w-full h-44 flex items-center justify-center text-6xl relative overflow-hidden bg-gradient-to-br from-[#134e5e] to-[#71b280]">
                🌿
                <span class="absolute top-2.5 right-2.5 px-2.5 py-1 rounded text-[11px] font-bold tracking-widest uppercase bg-emerald-500/20 text-[var(--green)] border border-emerald-500/30">FREE</span>
            </div>
            <div class="p-4">
                <div class="text-[11px] font-semibold text-[var(--accent-light)] tracking-widest uppercase mb-1.5">Background</div>
                <div class="text-base font-bold text-[var(--text)] mb-2">Forest Environment</div>
                <div class="flex items-center justify-between mt-3 pt-3 border-t border-[var(--border)]">
                    <span class="font-pixel text-[13px] text-[var(--green)]">FREE</span>
                    <span class="text-[var(--gold)] text-xs">★★★★★</span>
                </div>
            </div>
        </a>
        <!-- Product 4 -->
        <a href="/marketplace" class="block bg-[var(--card)] pixel-border hover:border-[var(--accent)] hover:-translate-y-1 transition-transform no-underline text-inherit">
            <div class="w-full h-44 flex items-center justify-center text-6xl relative overflow-hidden bg-gradient-to-br from-[#1a0533] to-[#3d0066]">
                ⚔️
                <span class="absolute top-2.5 right-2.5 px-2.5 py-1 rounded text-[11px] font-bold tracking-widest uppercase bg-amber-500/20 text-amber-500 border border-amber-500/30">PAID</span>
            </div>
            <div class="p-4">
                <div class="text-[11px] font-semibold text-[var(--accent-light)] tracking-widest uppercase mb-1.5">UI Pack</div>
                <div class="text-base font-bold text-[var(--text)] mb-2">RPG Interface Kit</div>
                <div class="flex items-center justify-between mt-3 pt-3 border-t border-[var(--border)]">
                    <span class="font-pixel text-[13px] text-[var(--gold)]">$15.00</span>
                    <span class="text-[var(--gold)] text-xs">★★★★☆</span>
                </div>
            </div>
        </a>
    </div>
</section>

<section class="relative z-10 py-20 px-10 max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-10">
        <h2 class="font-pixel text-base text-[var(--text)]">BROWSE <span class="text-[var(--accent-light)]">CATEGORIES</span></h2>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        <a href="/marketplace?category=tileset" class="block bg-[var(--card)] pixel-border p-6 text-center hover:border-[var(--accent)] hover:bg-[var(--accent)]/5 transition-colors no-underline text-inherit">
            <span class="block text-4xl mb-2.5">🗺️</span><div class="font-bold text-sm text-[var(--text)]">Tilesets</div><div class="text-xs text-[var(--muted)] mt-1">342 assets</div>
        </a>
        <a href="/marketplace?category=character" class="block bg-[var(--card)] pixel-border p-6 text-center hover:border-[var(--accent)] hover:bg-[var(--accent)]/5 transition-colors no-underline text-inherit">
            <span class="block text-4xl mb-2.5">🧍</span><div class="font-bold text-sm text-[var(--text)]">Characters</div><div class="text-xs text-[var(--muted)] mt-1">218 assets</div>
        </a>
        <a href="/marketplace?category=effect" class="block bg-[var(--card)] pixel-border p-6 text-center hover:border-[var(--accent)] hover:bg-[var(--accent)]/5 transition-colors no-underline text-inherit">
            <span class="block text-4xl mb-2.5">✨</span><div class="font-bold text-sm text-[var(--text)]">Effects</div><div class="text-xs text-[var(--muted)] mt-1">156 assets</div>
        </a>
        <a href="/marketplace?category=background" class="block bg-[var(--card)] pixel-border p-6 text-center hover:border-[var(--accent)] hover:bg-[var(--accent)]/5 transition-colors no-underline text-inherit">
            <span class="block text-4xl mb-2.5">🖼️</span><div class="font-bold text-sm text-[var(--text)]">Backgrounds</div><div class="text-xs text-[var(--muted)] mt-1">198 assets</div>
        </a>
        <a href="/marketplace?category=ui" class="block bg-[var(--card)] pixel-border p-6 text-center hover:border-[var(--accent)] hover:bg-[var(--accent)]/5 transition-colors no-underline text-inherit">
            <span class="block text-4xl mb-2.5">🎮</span><div class="font-bold text-sm text-[var(--text)]">UI Packs</div><div class="text-xs text-[var(--muted)] mt-1">124 assets</div>
        </a>
        <a href="/marketplace?category=icon" class="block bg-[var(--card)] pixel-border p-6 text-center hover:border-[var(--accent)] hover:bg-[var(--accent)]/5 transition-colors no-underline text-inherit">
            <span class="block text-4xl mb-2.5">🎵</span><div class="font-bold text-sm text-[var(--text)]">Icons</div><div class="text-xs text-[var(--muted)] mt-1">87 assets</div>
        </a>
    </div>
</section>

<div class="bg-gradient-to-br from-[var(--accent)]/20 to-purple-800/10 border border-[var(--accent)]/30 rounded-xl p-16 text-center mx-10 mb-20 relative z-10 overflow-hidden pixel-border">
    <h2 class="font-pixel text-xl sm:text-2xl text-[var(--text)] mb-4">ARE YOU A PIXEL ARTIST?</h2>
    <p class="text-[var(--muted)] text-base mb-8">Join hundreds of artists already selling their work on Pixel Smashers. Start earning today!</p>
    <a href="/register" class="btn-pixel !px-8 !py-4 !text-sm">Start Selling Free</a>
</div>

@endsection