@extends('layouts.app')

@section('title', 'Pixel Smashers – Pixel Art Marketplace')

@section('content')

{{-- HERO SECTION --}}
<div class="relative min-h-[92vh] flex items-center justify-center text-center px-5 pt-24 pb-16 overflow-hidden">

    {{-- Animated background grid --}}
    <div class="absolute inset-0 z-0" style="background-image: linear-gradient(rgba(124,58,237,0.07) 1px, transparent 1px), linear-gradient(90deg, rgba(124,58,237,0.07) 1px, transparent 1px); background-size: 40px 40px;"></div>

    {{-- Glow orbs --}}
    <div class="absolute top-1/4 left-1/4 w-96 h-96 rounded-full pointer-events-none z-0" style="background: radial-gradient(circle, rgba(124,58,237,0.18) 0%, transparent 70%); filter: blur(40px);"></div>
    <div class="absolute bottom-1/4 right-1/4 w-80 h-80 rounded-full pointer-events-none z-0" style="background: radial-gradient(circle, rgba(245,158,11,0.12) 0%, transparent 70%); filter: blur(40px);"></div>

    <div class="relative z-10">
        {{-- Badge --}}
        <div class="inline-block px-5 py-2 mb-8 rounded-full text-xs font-semibold tracking-widest uppercase" style="background: rgba(124,58,237,0.15); border: 1px solid rgba(167,139,250,0.4); color: #a78bfa;">
            🎮 #1 Pixel Art Marketplace
        </div>

        {{-- Main Heading --}}
        <h1 class="font-pixel leading-relaxed mb-4" style="font-size: clamp(1.4rem, 4vw, 2.8rem); color: #f1f5f9;">
            BUY & SELL<br>
            <span style="background: linear-gradient(135deg, #a78bfa, #7c3aed, #f59e0b); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">PIXEL ART</span><br>
            ASSETS
        </h1>

        <p class="text-lg max-w-xl mx-auto mt-6 mb-10 leading-relaxed" style="color: #94a3b8;">
            Discover thousands of tilesets, sprites, animations, and UI packs made by talented pixel artists worldwide.
        </p>

        {{-- CTA Buttons --}}
        <div class="flex gap-4 justify-center flex-wrap mb-16">
            <a href="/marketplace" class="btn-pixel !px-8 !py-4 !text-sm" style="background: linear-gradient(135deg, #7c3aed, #6d28d9); box-shadow: 0 0 20px rgba(124,58,237,0.4), inset -4px -4px 0 0 rgba(0,0,0,0.2), inset 4px 4px 0 0 rgba(255,255,255,0.15);">
                ✦ Browse Assets
            </a>
            @guest
                <a href="/register" class="btn-pixel btn-pixel-ghost !px-8 !py-4 !text-sm" style="border-color: rgba(167,139,250,0.5); color: #a78bfa;">
                    Start Selling →
                </a>
            @endguest
            @auth
                @if(Auth::user()->role == 'seller')
                    <a href="/seller/upload" class="btn-pixel btn-pixel-ghost !px-8 !py-4 !text-sm">+ Upload Asset</a>
                @endif
            @endauth
        </div>

        {{-- Stats --}}
        <div class="flex gap-16 justify-center">
            <div class="text-center">
                <span class="font-pixel block mb-1" style="font-size: 1.3rem; background: linear-gradient(135deg, #f59e0b, #fbbf24); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">2.4K+</span>
                <span class="text-xs tracking-widest uppercase" style="color: #64748b;">Assets</span>
            </div>
            <div class="text-center">
                <span class="font-pixel block mb-1" style="font-size: 1.3rem; background: linear-gradient(135deg, #f59e0b, #fbbf24); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">840+</span>
                <span class="text-xs tracking-widest uppercase" style="color: #64748b;">Artists</span>
            </div>
            <div class="text-center">
                <span class="font-pixel block mb-1" style="font-size: 1.3rem; background: linear-gradient(135deg, #f59e0b, #fbbf24); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">12K+</span>
                <span class="text-xs tracking-widest uppercase" style="color: #64748b;">Buyers</span>
            </div>
        </div>
    </div>
</div>

{{-- FEATURED ASSETS --}}
<section class="relative z-10 py-20 px-10 max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-10">
        <h2 class="font-pixel text-base" style="color: #f1f5f9;">FEATURED <span style="color: #a78bfa;">ASSETS</span></h2>
        <a href="/marketplace" class="font-semibold text-sm no-underline hover:underline" style="color: #a78bfa;">View All →</a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">

        {{-- Card 1 --}}
        <a href="/marketplace" class="block no-underline text-inherit rounded-lg overflow-hidden transition-all duration-200 hover:-translate-y-2" style="background: linear-gradient(145deg, #16162a, #1e1e35); border: 1px solid #2a2a3a; box-shadow: 0 4px 24px rgba(0,0,0,0.4);">
            <div class="w-full h-44 flex items-center justify-center text-6xl relative" style="background: linear-gradient(135deg, #1a1a2e, #16213e);">
                🏰
                <span class="absolute top-2.5 right-2.5 px-2.5 py-1 text-xs font-bold tracking-widest uppercase rounded" style="background: rgba(239,68,68,0.2); color: #f87171; border: 1px solid rgba(239,68,68,0.3);">🔥 HOT</span>
            </div>
            <div class="p-4">
                <div class="text-xs font-semibold tracking-widest uppercase mb-1.5" style="color: #a78bfa;">Tileset</div>
                <div class="text-base font-bold mb-2" style="color: #f1f5f9;">Medieval Castle Pack</div>
                <div class="flex items-center justify-between mt-3 pt-3" style="border-top: 1px solid #2a2a3a;">
                    <span class="font-pixel text-sm" style="color: #f59e0b;">$12.00</span>
                    <span class="text-xs" style="color: #f59e0b;">★★★★★</span>
                </div>
            </div>
        </a>

        {{-- Card 2 --}}
        <a href="/marketplace" class="block no-underline text-inherit rounded-lg overflow-hidden transition-all duration-200 hover:-translate-y-2" style="background: linear-gradient(145deg, #16162a, #1e1e35); border: 1px solid #2a2a3a; box-shadow: 0 4px 24px rgba(0,0,0,0.4);">
            <div class="w-full h-44 flex items-center justify-center text-6xl relative" style="background: linear-gradient(135deg, #0f2027, #203a43);">
                🧙
                <span class="absolute top-2.5 right-2.5 px-2.5 py-1 text-xs font-bold tracking-widest uppercase rounded" style="background: rgba(245,158,11,0.2); color: #fbbf24; border: 1px solid rgba(245,158,11,0.3);">PAID</span>
            </div>
            <div class="p-4">
                <div class="text-xs font-semibold tracking-widest uppercase mb-1.5" style="color: #a78bfa;">Character Sprite</div>
                <div class="text-base font-bold mb-2" style="color: #f1f5f9;">Wizard Animation Set</div>
                <div class="flex items-center justify-between mt-3 pt-3" style="border-top: 1px solid #2a2a3a;">
                    <span class="font-pixel text-sm" style="color: #f59e0b;">$8.00</span>
                    <span class="text-xs" style="color: #f59e0b;">★★★★☆</span>
                </div>
            </div>
        </a>

        {{-- Card 3 --}}
        <a href="/marketplace" class="block no-underline text-inherit rounded-lg overflow-hidden transition-all duration-200 hover:-translate-y-2" style="background: linear-gradient(145deg, #16162a, #1e1e35); border: 1px solid #2a2a3a; box-shadow: 0 4px 24px rgba(0,0,0,0.4);">
            <div class="w-full h-44 flex items-center justify-center text-6xl relative" style="background: linear-gradient(135deg, #134e5e, #71b280);">
                🌿
                <span class="absolute top-2.5 right-2.5 px-2.5 py-1 text-xs font-bold tracking-widest uppercase rounded" style="background: rgba(16,185,129,0.2); color: #34d399; border: 1px solid rgba(16,185,129,0.3);">FREE</span>
            </div>
            <div class="p-4">
                <div class="text-xs font-semibold tracking-widest uppercase mb-1.5" style="color: #a78bfa;">Background</div>
                <div class="text-base font-bold mb-2" style="color: #f1f5f9;">Forest Environment</div>
                <div class="flex items-center justify-between mt-3 pt-3" style="border-top: 1px solid #2a2a3a;">
                    <span class="font-pixel text-sm" style="color: #10b981;">FREE</span>
                    <span class="text-xs" style="color: #f59e0b;">★★★★★</span>
                </div>
            </div>
        </a>

        {{-- Card 4 --}}
        <a href="/marketplace" class="block no-underline text-inherit rounded-lg overflow-hidden transition-all duration-200 hover:-translate-y-2" style="background: linear-gradient(145deg, #16162a, #1e1e35); border: 1px solid #2a2a3a; box-shadow: 0 4px 24px rgba(0,0,0,0.4);">
            <div class="w-full h-44 flex items-center justify-center text-6xl relative" style="background: linear-gradient(135deg, #1a0533, #3d0066);">
                ⚔️
                <span class="absolute top-2.5 right-2.5 px-2.5 py-1 text-xs font-bold tracking-widest uppercase rounded" style="background: rgba(245,158,11,0.2); color: #fbbf24; border: 1px solid rgba(245,158,11,0.3);">PAID</span>
            </div>
            <div class="p-4">
                <div class="text-xs font-semibold tracking-widest uppercase mb-1.5" style="color: #a78bfa;">UI Pack</div>
                <div class="text-base font-bold mb-2" style="color: #f1f5f9;">RPG Interface Kit</div>
                <div class="flex items-center justify-between mt-3 pt-3" style="border-top: 1px solid #2a2a3a;">
                    <span class="font-pixel text-sm" style="color: #f59e0b;">$15.00</span>
                    <span class="text-xs" style="color: #f59e0b;">★★★★☆</span>
                </div>
            </div>
        </a>

    </div>
</section>

{{-- CATEGORIES --}}
<section class="relative z-10 py-20 px-10 max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-10">
        <h2 class="font-pixel text-base" style="color: #f1f5f9;">BROWSE <span style="color: #a78bfa;">CATEGORIES</span></h2>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @foreach([
            ['href' => '/marketplace?category=tileset',    'emoji' => '🗺️', 'label' => 'Tilesets',    'count' => '342'],
            ['href' => '/marketplace?category=character',  'emoji' => '🧍', 'label' => 'Characters',  'count' => '218'],
            ['href' => '/marketplace?category=effect',     'emoji' => '✨', 'label' => 'Effects',     'count' => '156'],
            ['href' => '/marketplace?category=background', 'emoji' => '🖼️', 'label' => 'Backgrounds', 'count' => '198'],
            ['href' => '/marketplace?category=ui',         'emoji' => '🎮', 'label' => 'UI Packs',    'count' => '124'],
            ['href' => '/marketplace?category=icon',       'emoji' => '🎵', 'label' => 'Icons',       'count' => '87'],
        ] as $cat)
        <a href="{{ $cat['href'] }}" class="block p-6 text-center no-underline rounded-lg transition-all duration-200 hover:-translate-y-1" style="background: linear-gradient(145deg, #16162a, #1e1e35); border: 1px solid #2a2a3a; box-shadow: 0 4px 16px rgba(0,0,0,0.3);">
            <span class="block text-4xl mb-2.5">{{ $cat['emoji'] }}</span>
            <div class="font-bold text-sm mb-1" style="color: #f1f5f9;">{{ $cat['label'] }}</div>
            <div class="text-xs" style="color: #64748b;">{{ $cat['count'] }} assets</div>
        </a>
        @endforeach
    </div>
</section>

{{-- CTA BANNER --}}
<div class="relative mx-10 mb-20 rounded-2xl p-16 text-center overflow-hidden" style="background: linear-gradient(135deg, rgba(124,58,237,0.25), rgba(109,40,217,0.15), rgba(245,158,11,0.1)); border: 1px solid rgba(124,58,237,0.35); box-shadow: 0 0 60px rgba(124,58,237,0.15);">
    <div class="absolute inset-0 z-0" style="background-image: linear-gradient(rgba(124,58,237,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(124,58,237,0.05) 1px, transparent 1px); background-size: 30px 30px;"></div>
    <div class="relative z-10">
        <h2 class="font-pixel mb-4" style="font-size: clamp(1rem, 2.5vw, 1.5rem); color: #f1f5f9;">ARE YOU A PIXEL ARTIST?</h2>
        <p class="text-base mb-8 max-w-lg mx-auto" style="color: #94a3b8;">Join hundreds of artists already selling their work on Pixel Smashers. Start earning today!</p>
        <a href="/register" class="btn-pixel !px-8 !py-4 !text-sm" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: #000; box-shadow: 0 0 20px rgba(245,158,11,0.35);">
            🚀 Start Selling Free
        </a>
    </div>
</div>

@endsection