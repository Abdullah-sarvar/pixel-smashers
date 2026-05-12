@extends('layouts.app')

@section('title', 'Forgot Password – Pixel Smashers')

@section('content')
<div class="flex-1 flex items-center justify-center py-20 px-5 bg-[radial-gradient(ellipse_at_center,rgba(var(--accent),0.1)_0%,transparent_70%)] relative z-10">
    <div class="bg-[var(--card)] border border-[var(--border)] rounded-xl p-10 w-full max-w-md pixel-border relative">
        <h1 class="font-pixel text-sm text-[var(--text)] mb-2 text-center">FORGOT PASSWORD</h1>
        <p class="text-sm text-[var(--muted)] text-center mb-8">
            Enter your email and we'll send you a reset link.
        </p>

        {{-- Status message (same for found / not-found to prevent enumeration) --}}
        @if(session('status'))
            <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-md py-3 px-4 mb-5 text-sm text-[var(--green)]">
                {{ session('status') }}
            </div>
        @endif

        {{-- Errors --}}
        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 rounded-md py-3 px-4 mb-5 text-sm text-red-400">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-6">
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

            <button type="submit" class="btn-pixel w-full !text-sm">SEND RESET LINK</button>
        </form>

        <div class="text-center mt-6 text-sm text-[var(--muted)]">
            Remembered it?
            <a href="{{ route('login') }}" class="text-[var(--accent-light)] no-underline font-semibold hover:underline">Back to Login</a>
        </div>
    </div>
</div>
@endsection