@extends('layouts.app')
@section('title', 'Seller Dashboard – Pixel Smashers')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-5 sm:px-10">

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 gap-4">
        <div class="font-pixel text-base text-[var(--text)]">SELLER <span class="text-[var(--accent-light)]">DASHBOARD</span></div>
        <a href="/seller/upload" class="btn-pixel !py-2.5 !px-6">+ Upload Asset</a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-md py-3 px-4 mb-6 text-sm text-[var(--green)]">✅ {{ session('success') }}</div>
    @endif

    <!-- STATS -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="bg-[var(--card)] pixel-border p-5">
            <div class="text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Total Products</div>
            <div class="font-pixel text-xl text-[var(--gold)]">{{ $products->count() }}</div>
        </div>
        <div class="bg-[var(--card)] pixel-border p-5">
            <div class="text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Total Downloads</div>
            <div class="font-pixel text-xl text-[var(--gold)]">{{ $products->sum('downloads') }}</div>
        </div>
        <div class="bg-[var(--card)] pixel-border p-5">
            <div class="text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Free Assets</div>
            <div class="font-pixel text-xl text-[var(--gold)]">{{ $products->where('is_free', true)->count() }}</div>
        </div>
    </div>

    <!-- PRODUCTS TABLE -->
    <div class="bg-[var(--card)] pixel-border overflow-hidden">
        <div class="px-5 py-4 border-b border-[var(--border)] bg-[var(--bg)]/50">
            <div class="font-pixel text-[11px] text-[var(--text)] tracking-widest">MY PRODUCTS</div>
        </div>

        @if($products->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[700px]">
                <thead>
                    <tr>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">Title</th>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">Category</th>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">Price</th>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">Type</th>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">Downloads</th>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($products as $product)
                    <tr class="hover:bg-[var(--accent)]/5 transition-colors border-b border-[var(--border)] last:border-b-0">
                        <td class="p-4 font-semibold text-[var(--text)]">{{ $product->title }}</td>
                        <td class="p-4 text-[var(--accent-light)] uppercase tracking-widest text-[11px]">{{ ucfirst($product->category) }}</td>
                        <td class="p-4 font-pixel text-[11px] text-[var(--gold)]">{{ $product->is_free ? 'Free' : '$'.$product->price }}</td>
                        <td class="p-4">
                            @if($product->is_free)
                                <span class="px-2 py-1 bg-emerald-500/20 text-[var(--green)] border border-emerald-500/30 rounded text-[10px] font-bold tracking-widest uppercase">FREE</span>
                            @else
                                <span class="px-2 py-1 bg-amber-500/20 text-[var(--gold)] border border-amber-500/30 rounded text-[10px] font-bold tracking-widest uppercase">PAID</span>
                            @endif
                        </td>
                        <td class="p-4 text-[var(--muted)]">{{ $product->downloads }}</td>
                        <td class="p-4">
                            <div class="flex gap-2">
                                <a href="/seller/edit/{{ $product->id }}" class="px-3 py-1.5 bg-[var(--accent)]/10 text-[var(--accent-light)] border border-[var(--accent)]/30 rounded font-semibold text-xs hover:bg-[var(--accent)]/20 transition-colors no-underline">Edit</a>
                                <form method="POST" action="/seller/delete/{{ $product->id }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 bg-red-500/10 text-red-400 border border-red-500/30 rounded font-semibold text-xs hover:bg-red-500/20 transition-colors" onclick="return confirm('Delete this product?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-16 px-5">
            <div class="text-5xl mb-4">📦</div>
            <div class="font-pixel text-xs text-[var(--text)] mb-2 tracking-widest">NO PRODUCTS YET</div>
            <div class="text-sm text-[var(--muted)] mb-5">Upload your first pixel art asset!</div>
            <a href="/seller/upload" class="btn-pixel inline-block !py-2.5 !px-6">+ Upload Now</a>
        </div>
        @endif
    </div>
</div>
@endsection