@extends('layouts.app')
@section('title', 'Edit Asset – Pixel Smashers')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-5 sm:px-10">
    <a href="/seller/dashboard" class="inline-block mb-6 text-sm text-[var(--muted)] no-underline hover:text-[var(--accent-light)] transition-colors">← Back to Dashboard</a>

    <div class="font-pixel text-base text-[var(--text)] mb-2">EDIT <span class="text-[var(--accent-light)]">ASSET</span></div>
    <div class="text-[15px] text-[var(--muted)] mb-8">Update your pixel art listing</div>

    <div class="bg-[var(--card)] pixel-border p-8">
        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 rounded-md py-3 px-4 mb-6 text-sm text-red-400">
                @foreach($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/seller/edit/{{ $product->id }}">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Asset Title</label>
                <input type="text" name="title" value="{{ old('title', $product->title) }}" required class="w-full py-3 px-4 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--text)] text-[15px] focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm">
            </div>

            <div class="mb-5">
                <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Description</label>
                <textarea name="description" class="w-full py-3 px-4 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--text)] text-[15px] focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm resize-y min-h-[120px]">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                <div>
                    <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Category</label>
                    <select name="category" required class="w-full py-3 px-4 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--text)] text-[15px] focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm">
                        <option value="tileset" {{ $product->category == 'tileset' ? 'selected' : '' }}>🗺️ Tileset</option>
                        <option value="character" {{ $product->category == 'character' ? 'selected' : '' }}>🧍 Character</option>
                        <option value="background" {{ $product->category == 'background' ? 'selected' : '' }}>🖼️ Background</option>
                        <option value="effect" {{ $product->category == 'effect' ? 'selected' : '' }}>✨ Effect</option>
                        <option value="ui" {{ $product->category == 'ui' ? 'selected' : '' }}>🎮 UI Pack</option>
                        <option value="icon" {{ $product->category == 'icon' ? 'selected' : '' }}>🎵 Icons</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Price (USD)</label>
                    <input type="number" name="price" min="0" step="0.01" value="{{ old('price', $product->price) }}" class="w-full py-3 px-4 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--text)] text-[15px] focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm">
                </div>
            </div>

            <div class="mb-8">
                <div class="flex items-center gap-3">
                    <label class="relative inline-block w-11 h-6 cursor-pointer">
                        <input type="checkbox" name="is_free" class="sr-only peer" {{ $product->is_free ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-[var(--border)] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[var(--accent)]"></div>
                    </label>
                    <span class="text-sm font-semibold text-[var(--text)]">This asset is FREE</span>
                </div>
            </div>

            <button type="submit" class="btn-pixel w-full !text-sm">💾 UPDATE ASSET</button>
        </form>
    </div>
</div>
@endsection