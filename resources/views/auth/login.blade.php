@extends('layouts.app')

@section('title', 'Login – Pixel Smashers')

@section('content')
<div class="flex-1 flex items-center justify-center py-20 px-5 bg-[radial-gradient(ellipse_at_center,rgba(var(--accent),0.1)_0%,transparent_70%)] relative z-10">
    <div class="bg-[var(--card)] border border-[var(--border)] rounded-xl p-10 w-full max-w-md pixel-border relative">
        <h1 class="font-pixel text-sm text-[var(--text)] mb-2 text-center">WELCOME BACK</h1>
        <p class="text-sm text-[var(--muted)] text-center mb-8">Login to your account</p>

        {{-- Success message (e.g. after logout or password reset) --}}
        @if(session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-md py-3 px-4 mb-5 text-sm text-[var(--green)]">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation errors --}}
        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 rounded-md py-3 px-4 mb-5 text-sm text-red-400">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            {{-- Email --}}
            <div class="mb-5">
                <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">
                    Email Address
                </label>
                <input
                    type="email"
                    name="email"
                    placeholder="you@example.com"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    class="w-full py-3 px-4 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--text)] text-[15px] focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm"
                >
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required
                    autocomplete="current-password"
                    class="w-full py-3 px-4 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--text)] text-[15px] focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm"
                >
            </div>

            {{-- Remember Me + Forgot Password row --}}
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                        class="w-4 h-4 accent-[var(--accent)] rounded"
                    >
                    <span class="text-xs text-[var(--muted)]">Remember me</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-xs text-[var(--accent-light)] hover:underline font-semibold">
                    Forgot password?
                </a>
            </div>

            <button type="submit" class="btn-pixel w-full !text-sm">LOGIN</button>
        </form>

        <div class="text-center mt-6 text-sm text-[var(--muted)]">
            Don't have an account?
            <a href="/register" class="text-[var(--accent-light)] no-underline font-semibold hover:underline">Sign Up</a>
        </div>
    </div>
</div>
@endsection