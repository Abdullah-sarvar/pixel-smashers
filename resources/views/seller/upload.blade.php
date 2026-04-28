@extends('layouts.app')
@section('title', 'Upload Asset – Pixel Smashers')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-5 sm:px-10">
    <a href="/seller/dashboard" class="inline-block mb-6 text-sm text-[var(--muted)] no-underline hover:text-[var(--accent-light)] transition-colors">← Back to Dashboard</a>

    <div class="font-pixel text-base text-[var(--text)] mb-2">UPLOAD <span class="text-[var(--accent-light)]">ASSET</span></div>
    <div class="text-[15px] text-[var(--muted)] mb-8">Share your pixel art with the world</div>

    <div class="bg-[var(--card)] pixel-border p-8">
        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 rounded-md py-3 px-4 mb-6 text-sm text-red-400">
                @foreach($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/seller/upload" enctype="multipart/form-data">
            @csrf

            <div class="mb-5">
                <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Asset Title</label>
                <input type="text" name="title" placeholder="e.g. Medieval Castle Tileset" value="{{ old('title') }}" required class="w-full py-3 px-4 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--text)] text-[15px] focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm">
            </div>

            <div class="mb-5">
                <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Description</label>
                <textarea name="description" placeholder="Describe your asset — what's included, resolution, etc." class="w-full py-3 px-4 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--text)] text-[15px] focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm resize-y min-h-[120px]">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                <div>
                    <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Category</label>
                    <select name="category" required class="w-full py-3 px-4 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--text)] text-[15px] focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm">
                        <option value="">Select category...</option>
                        <option value="tileset" {{ old('category') == 'tileset' ? 'selected' : '' }}>🗺️ Tileset</option>
                        <option value="character" {{ old('category') == 'character' ? 'selected' : '' }}>🧍 Character</option>
                        <option value="background" {{ old('category') == 'background' ? 'selected' : '' }}>🖼️ Background</option>
                        <option value="effect" {{ old('category') == 'effect' ? 'selected' : '' }}>✨ Effect</option>
                        <option value="ui" {{ old('category') == 'ui' ? 'selected' : '' }}>🎮 UI Pack</option>
                        <option value="icon" {{ old('category') == 'icon' ? 'selected' : '' }}>🎵 Icons</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Price (USD)</label>
                    <input type="number" name="price" placeholder="0.00" min="0" step="0.01" value="{{ old('price', '0') }}" class="w-full py-3 px-4 bg-[var(--bg)] border border-[var(--border)] rounded-md text-[var(--text)] text-[15px] focus:outline-none focus:border-[var(--accent)] transition-colors pixel-border-sm">
                </div>
            </div>

            <div class="mb-6">
                <div class="flex items-center gap-3">
                    <label class="relative inline-block w-11 h-6 cursor-pointer">
                        <input type="checkbox" name="is_free" class="sr-only peer" {{ old('is_free') ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-[var(--border)] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[var(--accent)]"></div>
                    </label>
                    <span class="text-sm font-semibold text-[var(--text)]">This asset is FREE</span>
                </div>
            </div>

            <div class="mb-5">
                <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Preview Image</label>
                <div class="border-2 border-dashed border-[var(--border)] rounded-md p-6 text-center cursor-pointer transition-colors hover:border-[var(--accent)]" onclick="document.getElementById('preview_input').click()">
                    <input type="file" id="preview_input" name="preview_image" accept="image/*" class="hidden">
                    <div class="text-3xl mb-2">🖼️</div>
                    <div class="text-sm text-[var(--muted)]"><span class="text-[var(--accent-light)] font-semibold">Click to upload</span> preview image (PNG, JPG)</div>
                </div>
            </div>

            <div class="mb-8">
                <label class="block text-xs font-semibold text-[var(--muted)] tracking-widest uppercase mb-2">Asset File</label>
                <div class="border-2 border-dashed border-[var(--border)] rounded-md p-6 text-center cursor-pointer transition-colors hover:border-[var(--accent)]" onclick="document.getElementById('file_input').click()">
                    <input type="file" id="file_input" name="file" class="hidden">
                    <div class="text-3xl mb-2">📦</div>
                    <div class="text-sm text-[var(--muted)]"><span class="text-[var(--accent-light)] font-semibold">Click to upload</span> asset file (ZIP, PNG, etc.)</div>
                </div>
            </div>

            <button type="submit" class="btn-pixel w-full !text-sm">🚀 PUBLISH ASSET</button>
        </form>
    </div>
</div>
@endsection