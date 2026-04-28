@extends('layouts.app')
@section('title', 'Admin Panel – Pixel Smashers')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-5 sm:px-10">

    <div class="font-pixel text-base text-[var(--text)] mb-8">ADMIN <span class="text-[var(--accent-light)]">PANEL</span></div>

    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-md py-3 px-4 mb-6 text-sm text-[var(--green)]">✅ {{ session('success') }}</div>
    @endif

    <!-- STATS -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="bg-[var(--card)] pixel-border p-5">
            <div class="text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Total Users</div>
            <div class="font-pixel text-xl text-[var(--gold)]">{{ $users->count() }}</div>
        </div>
        <div class="bg-[var(--card)] pixel-border p-5">
            <div class="text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Total Products</div>
            <div class="font-pixel text-xl text-[var(--gold)]">{{ $products->count() }}</div>
        </div>
        <div class="bg-[var(--card)] pixel-border p-5">
            <div class="text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Total Sellers</div>
            <div class="font-pixel text-xl text-[var(--gold)]">{{ $users->where('role','seller')->count() }}</div>
        </div>
    </div>

    <!-- USERS TABLE -->
    <div class="bg-[var(--card)] pixel-border overflow-hidden mb-8">
        <div class="px-5 py-4 border-b border-[var(--border)] bg-[var(--bg)]/50">
            <div class="font-pixel text-[11px] text-[var(--text)] tracking-widest">ALL USERS</div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[700px]">
                <thead>
                    <tr>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">#</th>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">Name</th>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">Email</th>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">Role</th>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">Joined</th>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">Action</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($users as $user)
                    <tr class="hover:bg-[var(--accent)]/5 transition-colors border-b border-[var(--border)] last:border-b-0">
                        <td class="p-4 text-[var(--muted)]">{{ $user->id }}</td>
                        <td class="p-4 font-semibold text-[var(--text)]">{{ $user->name }}</td>
                        <td class="p-4 text-[var(--muted)]">{{ $user->email }}</td>
                        <td class="p-4">
                            @if($user->role == 'seller')
                                <span class="px-2 py-1 bg-[var(--accent)]/20 text-[var(--accent-light)] border border-[var(--accent)]/30 rounded text-[10px] font-bold tracking-widest uppercase">SELLER</span>
                            @else
                                <span class="px-2 py-1 bg-[var(--muted)]/20 text-[var(--muted)] border border-[var(--muted)]/30 rounded text-[10px] font-bold tracking-widest uppercase">BUYER</span>
                            @endif
                        </td>
                        <td class="p-4 text-[var(--muted)]">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="p-4">
                            <form method="POST" action="/admin/user/{{ $user->id }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 bg-red-500/10 text-red-400 border border-red-500/30 rounded font-semibold text-xs hover:bg-red-500/20 transition-colors" onclick="return confirm('Delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- PRODUCTS TABLE -->
    <div class="bg-[var(--card)] pixel-border overflow-hidden">
        <div class="px-5 py-4 border-b border-[var(--border)] bg-[var(--bg)]/50">
            <div class="font-pixel text-[11px] text-[var(--text)] tracking-widest">ALL PRODUCTS</div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[700px]">
                <thead>
                    <tr>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">#</th>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">Title</th>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">Seller</th>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">Category</th>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">Price</th>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">Type</th>
                        <th class="p-4 text-[11px] font-semibold text-[var(--muted)] tracking-widest uppercase border-b border-[var(--border)]">Action</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($products as $product)
                    <tr class="hover:bg-[var(--accent)]/5 transition-colors border-b border-[var(--border)] last:border-b-0">
                        <td class="p-4 text-[var(--muted)]">{{ $product->id }}</td>
                        <td class="p-4 font-semibold text-[var(--text)]">{{ $product->title }}</td>
                        <td class="p-4 text-[var(--accent-light)]">{{ $product->seller->name }}</td>
                        <td class="p-4 text-[var(--muted)] uppercase text-[11px] tracking-widest">{{ ucfirst($product->category) }}</td>
                        <td class="p-4 font-pixel text-[11px] text-[var(--gold)]">{{ $product->is_free ? 'Free' : '$'.$product->price }}</td>
                        <td class="p-4">
                            @if($product->is_free)
                                <span class="px-2 py-1 bg-emerald-500/20 text-[var(--green)] border border-emerald-500/30 rounded text-[10px] font-bold tracking-widest uppercase">FREE</span>
                            @else
                                <span class="px-2 py-1 bg-amber-500/20 text-[var(--gold)] border border-amber-500/30 rounded text-[10px] font-bold tracking-widest uppercase">PAID</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <form method="POST" action="/admin/product/{{ $product->id }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 bg-red-500/10 text-red-400 border border-red-500/30 rounded font-semibold text-xs hover:bg-red-500/20 transition-colors" onclick="return confirm('Delete this product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection