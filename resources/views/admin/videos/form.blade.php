
@extends('admin.layouts.app')

@section('content')
@php
    $editing = $video->exists;
@endphp

<div class="mx-auto max-w-3xl">

    <div class="mb-6">
        <a href="{{ route('admin.videos.index') }}"
           class="text-sm font-semibold text-brand">
            ← Back to Videos
        </a>

        <h1 class="mt-4 font-heading text-2xl font-bold text-slate-900">
            {{ $editing ? 'Edit Video' : 'Add New Video' }}
        </h1>
    </div>

    <form
        method="POST"
        action="{{ $editing ? route('admin.videos.update', $video) : route('admin.videos.store') }}"
        enctype="multipart/form-data"
        class="space-y-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8"
    >
        @csrf

        @if($editing)
            @method('PUT')
        @endif

        <div>
            <label for="title" class="mb-2 block text-sm font-semibold">
                Video Title *
            </label>

            <input
                id="title"
                type="text"
                name="title"
                value="{{ old('title', $video->title) }}"
                required
                maxlength="180"
                placeholder="Bridal Makeup Transformation"
                class="min-h-12 w-full rounded-xl border border-slate-300 px-4 outline-none focus:border-brand"
            >
            @error('title')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="platform" class="mb-2 block text-sm font-semibold">
                Video Platform *
            </label>

            <select
                id="platform"
                name="platform"
                required
                class="min-h-12 w-full rounded-xl border border-slate-300 px-4 focus:border-brand"
            >
                <option value="youtube" @selected(old('platform', $video->platform) === 'youtube')>
                    YouTube
                </option>
                <option value="instagram" @selected(old('platform', $video->platform) === 'instagram')>
                    Instagram
                </option>
            </select>
        </div>

        <div>
            <label for="video_url" class="mb-2 block text-sm font-semibold">
                YouTube / Instagram Video URL *
            </label>

            <input
                id="video_url"
                type="url"
                name="video_url"
                value="{{ old('video_url', $video->video_url) }}"
                required
                placeholder="https://www.youtube.com/shorts/..."
                class="min-h-12 w-full rounded-xl border border-slate-300 px-4 outline-none focus:border-brand"
            >

            <p class="mt-2 text-xs text-slate-500">
                Paste a public YouTube video, YouTube Shorts, Instagram Reel or Instagram Post link.
            </p>

            @error('video_url')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="thumbnail" class="mb-2 block text-sm font-semibold">
                Video Thumbnail {{ $editing ? '(optional)' : '*' }}
            </label>

            @if($editing && $video->thumbnail)
                <img
                    src="{{ asset('storage/'.$video->thumbnail) }}"
                    alt="Current thumbnail"
                    class="mb-3 h-44 w-32 rounded-xl object-cover"
                >
            @endif

            <input
                id="thumbnail"
                type="file"
                name="thumbnail"
                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                {{ $editing ? '' : 'required' }}
                class="block w-full rounded-xl border border-slate-300 p-3 text-sm"
            >

            <p class="mt-2 text-xs text-slate-500">
                Recommended: 1080 × 1920 px (9:16), JPG/PNG/WebP, maximum 3 MB.
            </p>

            @error('thumbnail')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div>
                <label for="sort_order" class="mb-2 block text-sm font-semibold">
                    Display Order
                </label>

                <input
                    id="sort_order"
                    type="number"
                    min="0"
                    name="sort_order"
                    value="{{ old('sort_order', $video->sort_order ?? 0) }}"
                    required
                    class="min-h-12 w-full rounded-xl border border-slate-300 px-4"
                >
            </div>

            <div>
                <label for="is_active" class="mb-2 block text-sm font-semibold">
                    Visibility
                </label>

                <select
                    id="is_active"
                    name="is_active"
                    class="min-h-12 w-full rounded-xl border border-slate-300 px-4"
                >
                    <option value="1" @selected((string) old('is_active', $video->is_active ?? 1) === '1')>
                        Active
                    </option>
                    <option value="0" @selected((string) old('is_active', $video->is_active ?? 1) === '0')>
                        Inactive
                    </option>
                </select>
            </div>
        </div>

        <div class="flex flex-col gap-3 border-t border-slate-100 pt-5 sm:flex-row">
            <button
                type="submit"
                class="min-h-12 rounded-xl bg-brand px-7 py-3 text-sm font-bold text-white hover:bg-brand-dark"
            >
                {{ $editing ? 'Update Video' : 'Save Video' }}
            </button>

            <a href="{{ route('admin.videos.index') }}"
               class="inline-flex min-h-12 items-center justify-center rounded-xl border border-slate-200 px-7 text-sm font-semibold text-slate-700">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
