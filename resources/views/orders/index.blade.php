@extends('layouts.app')
@section('title', 'My Orders – Pixel Smashers')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-5 sm:px-10">
    <div class="font-pixel text-base text-[var(--text)] mb-8">MY <span class="text-[var(--accent-light)]">ORDERS</span></div>

    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-md py-3 px-4 mb-6 text-sm text-[var(--green)]">✅ {{ session('success') }}</div>
    @endif

    @if($orders->count() > 0)
        @foreach($orders as $order)
        <div class="bg-[var(--card)] pixel-border overflow-hidden mb-6">
            <!-- Order Header -->
            <div class="flex flex-wrap items-center justify-between gap-4 p-4 border-b border-[var(--border)] bg-[var(--bg)]/50">
                <div class="font-pixel text-[10px] text-[var(--accent-light)] tracking-widest">ORDER #{{ $order->id }}</div>
                <div class="text-[13px] text-[var(--muted)]">{{ $order->created_at->format('M d, Y') }}</div>
                <div class="font-pixel text-[13px] text-[var(--gold)]">${{ number_format($order->total_price, 2) }}</div>
                <span class="px-2 py-1 bg-emerald-500/20 text-[var(--green)] border border-emerald-500/30 rounded text-[11px] font-bold tracking-widest uppercase">{{ $order->status }}</span>
            </div>

            <!-- Order Items -->
            <div class="flex flex-col">
                @foreach($order->items as $item)
                <div class="flex items-center gap-4 p-4 border-b border-[var(--border)] last:border-b-0">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#1a1a2e] to-[#16213e] rounded-md flex items-center justify-center text-[24px] shrink-0 overflow-hidden border border-[var(--border)]">
                        @if($item->product->preview_image)
                            <img src="{{ asset('storage/'.$item->product->preview_image) }}" alt="" class="w-full h-full object-cover">
                        @else
                            🎮
                        @endif
                    </div>
                    <div class="text-[15px] font-bold text-[var(--text)] flex-1 min-w-0 truncate">{{ $item->product->title }}</div>
                    <div class="font-pixel text-[11px] text-[var(--gold)] shrink-0 px-4">${{ number_format($item->price, 2) }}</div>
                    @if($item->product->file_path)
                        <a href="{{ asset('storage/'.$item->product->file_path) }}" class="shrink-0 px-3 py-1.5 bg-emerald-500/10 text-[var(--green)] border border-emerald-500/30 rounded font-semibold text-xs hover:bg-emerald-500/20 transition-colors no-underline" download>⬇️ Download</a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    @else
    <div class="text-center py-16 px-5 pixel-border bg-[var(--card)]/50">
        <div class="text-5xl mb-4">📦</div>
        <div class="font-pixel text-xs text-[var(--text)] mb-2 tracking-widest">NO ORDERS YET</div>
        <div class="text-sm text-[var(--muted)] mb-6">Browse marketplace and purchase some assets!</div>
        <a href="/marketplace" class="btn-pixel inline-block !py-2.5 !px-6">Browse Assets</a>
    </div>
    @endif
</div>
@endsection