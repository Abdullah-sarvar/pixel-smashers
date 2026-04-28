@extends('layouts.app')

@section('title', 'Register – Pixel Smashers')

@section('content')
<div class="flex-1 flex items-center justify-center py-20 px-5 bg-[radial-gradient(ellipse_at_center,rgba(var(--accent),0.1)_0%,transparent_70%)] relative z-10">
    <div class="bg-[var(--card)] border border-[var(--border)] rounded-xl p-10 w-full max-w-[440px] pixel-border relative">
        <h1 class="font-pixel text-sm text-[var(--text)] mb-2 text-center">CREATE ACCOUNT</h1>
        <p class="text-sm text-[var(--muted)] text-center mb-8">Join the Pixel Smashers community</p>

        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 rounded-md py-3 px-4 mb-5 text-sm text-red-400">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf

            <div class="mb-4">
                <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Full Name</label>
                <input type="text" name="name" placeholder="Your name" value="{{ old('name') }}" required class="w-full py-3 px-4 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--text)] text-[15px] focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm">
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Email Address</label>
                <input type="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required class="w-full py-3 px-4 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--text)] text-[15px] focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm">
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Password</label>
                <input type="password" name="password" placeholder="Min 6 characters" required class="w-full py-3 px-4 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--text)] text-[15px] focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm">
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Repeat password" required class="w-full py-3 px-4 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--text)] text-[15px] focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm">
            </div>

            <div class="mb-6">
                <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">I want to join as</label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="role" value="buyer" checked class="peer sr-only">
                        <div class="flex flex-col items-center justify-center gap-2 p-4 bg-[var(--bg)] border border-[var(--border)] rounded-lg peer-checked:border-[var(--accent)] peer-checked:bg-[var(--accent)]/10 transition-colors pixel-border-sm text-center">
                            <span class="text-3xl">🛒</span>
                            <span class="text-sm font-bold text-[var(--text)]">Buyer</span>
                            <span class="text-[11px] text-[var(--muted)]">Buy & download assets</span>
                        </div>
                    </label>
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="role" value="seller" class="peer sr-only">
                        <div class="flex flex-col items-center justify-center gap-2 p-4 bg-[var(--bg)] border border-[var(--border)] rounded-lg peer-checked:border-[var(--accent)] peer-checked:bg-[var(--accent)]/10 transition-colors pixel-border-sm text-center">
                            <span class="text-3xl">🎨</span>
                            <span class="text-sm font-bold text-[var(--text)]">Seller</span>
                            <span class="text-[11px] text-[var(--muted)]">Sell your pixel art</span>
                        </div>
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-pixel w-full !text-sm">CREATE ACCOUNT</button>
        </form>

        <div class="text-center mt-6 text-sm text-[var(--muted)]">
            Already have an account? <a href="/login" class="text-[var(--accent-light)] no-underline font-semibold hover:underline">Login</a>
        </div>
    </div>
</div>
@endsection