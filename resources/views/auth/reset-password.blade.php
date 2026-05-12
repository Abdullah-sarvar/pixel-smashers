@extends('layouts.app')

@section('title', 'Reset Password – Pixel Smashers')

@section('content')
<div class="flex-1 flex items-center justify-center py-20 px-5 bg-[radial-gradient(ellipse_at_center,rgba(var(--accent),0.1)_0%,transparent_70%)] relative z-10">
    <div class="bg-[var(--card)] border border-[var(--border)] rounded-xl p-10 w-full max-w-md pixel-border relative">
        <h1 class="font-pixel text-sm text-[var(--text)] mb-2 text-center">RESET PASSWORD</h1>
        <p class="text-sm text-[var(--muted)] text-center mb-8">Choose a strong new password.</p>

        {{-- Errors --}}
        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 rounded-md py-3 px-4 mb-5 text-sm text-red-400">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            {{-- Hidden fields passed from the signed email link --}}
            <input type="hidden" name="token" value="{{ $token }}">

            {{-- Email (pre-filled, read-only) --}}
            <div class="mb-4">
                <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">
                    Email Address
                </label>
                <input
                    type="email"
                    name="email"
                    value="{{ $email ?? old('email') }}"
                    required
                    readonly
                    autocomplete="email"
                    class="w-full py-3 px-4 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--muted)] text-[15px] cursor-not-allowed opacity-70 pixel-border-sm"
                >
            </div>

            {{-- New Password --}}
            <div class="mb-4">
                <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">
                    New Password
                </label>
                <input
                    type="password"
                    name="password"
                    placeholder="Min 6 characters"
                    required
                    autocomplete="new-password"
                    class="w-full py-3 px-4 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--text)] text-[15px] focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm"
                >
            </div>

            {{-- Confirm Password --}}
            <div class="mb-6">
                <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">
                    Confirm New Password
                </label>
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Repeat new password"
                    required
                    autocomplete="new-password"
                    class="w-full py-3 px-4 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--text)] text-[15px] focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm"
                >
            </div>

            <button type="submit" class="btn-pixel w-full !text-sm">RESET PASSWORD</button>
        </form>
    </div>
</div>
@endsection
