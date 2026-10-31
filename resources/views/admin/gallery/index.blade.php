
@extends('admin.layouts.app')

@section('title', 'Gallery Management | Kutzz Salon')

@section('content')
@php
    $totalImages = \App\Models\GalleryImage::count();
    $activeImages = \App\Models\GalleryImage::where('is_active', true)->count();
    $totalCategories = \App\Models\GalleryCategory::count();
@endphp

<div class="mx-auto w-full max-w-7xl min-w-0 space-y-6 pb-8">

    {{-- Page Heading --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="min-w-0">
            <p class="mb-1 text-xs font-bold uppercase tracking-[0.18em] text-brand">
                Media Library
            </p>
            <h1 class="font-heading text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Gallery Management
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Organize, upload and manage your salon portfolio.
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.gallery-categories.index') }}"
               class="inline-flex min-h-11 items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                Manage Categories
            </a>

            <button type="button" id="toggleGalleryUpload"
                    aria-expanded="false"
                    aria-controls="galleryUploadPanel"
                    class="inline-flex min-h-11 items-center justify-center gap-2 rounded-xl bg-brand px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-brand-dark">
                <span class="text-lg leading-none">+</span>
                Upload Images
            </button>
        </div>
    </div>

    @if(session('success'))
        <div role="status" class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div role="alert" class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <p class="mb-2 font-semibold">Please fix these errors:</p>
            <ul class="list-inside list-disc space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Total Photos</p>
            <p class="mt-3 font-heading text-3xl font-bold text-slate-900">{{ $totalImages }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Active Photos</p>
            <p class="mt-3 font-heading text-3xl font-bold text-emerald-600">{{ $activeImages }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Categories</p>
            <p class="mt-3 font-heading text-3xl font-bold text-brand">{{ $totalCategories }}</p>
        </div>
    </div>

    {{-- Collapsible Upload Panel --}}
    <section id="galleryUploadPanel"
             class="{{ $errors->any() ? '' : 'hidden' }} rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6">

        <div class="mb-5 flex items-start justify-between gap-3">
            <div>
                <h2 class="font-heading text-lg font-bold text-slate-900">Upload New Photos</h2>
                <p class="mt-1 text-sm text-slate-500">Upload up to 10 photos in one batch.</p>
            </div>
            <button type="button" id="closeGalleryUpload"
                    class="rounded-lg p-2 text-slate-500 hover:bg-slate-100"
                    aria-label="Close upload panel">✕</button>
        </div>

        <form action="{{ route('admin.gallery-images.store') }}"
              method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="gallery_category_id" class="mb-2 block text-sm font-semibold text-slate-700">
                        Category *
                    </label>
                    <select id="gallery_category_id" name="gallery_category_id" required
                            class="min-h-11 w-full min-w-0 rounded-xl border border-slate-200 bg-white px-3 text-sm focus:border-brand focus:outline-none">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('gallery_category_id') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="gallery_title" class="mb-2 block text-sm font-semibold text-slate-700">
                        Image Title
                    </label>
                    <input id="gallery_title" name="title" maxlength="255"
                           value="{{ old('title') }}"
                           placeholder="e.g. Premium Bridal Makeup"
                           class="min-h-11 w-full min-w-0 rounded-xl border border-slate-200 px-3 text-sm focus:border-brand focus:outline-none">
                </div>

                <div>
                    <label for="gallery_alt" class="mb-2 block text-sm font-semibold text-slate-700">
                        Alt Text
                    </label>
                    <input id="gallery_alt" name="alt_text" maxlength="255"
                           value="{{ old('alt_text') }}"
                           placeholder="Describe the photograph"
                           class="min-h-11 w-full min-w-0 rounded-xl border border-slate-200 px-3 text-sm focus:border-brand focus:outline-none">
                </div>

                <div>
                    <label for="gallery_order" class="mb-2 block text-sm font-semibold text-slate-700">
                        Sort Order
                    </label>
                    <input id="gallery_order" name="sort_order" type="number" min="0" required
                           value="{{ old('sort_order', 0) }}"
                           class="min-h-11 w-full min-w-0 rounded-xl border border-slate-200 px-3 text-sm focus:border-brand focus:outline-none">
                </div>

                <div>
                    <label for="gallery_status" class="mb-2 block text-sm font-semibold text-slate-700">
                        Visibility
                    </label>
                    <select id="gallery_status" name="is_active"
                            class="min-h-11 w-full min-w-0 rounded-xl border border-slate-200 px-3 text-sm">
                        <option value="1" @selected(old('is_active', '1') == '1')>Active</option>
                        <option value="0" @selected(old('is_active') == '0')>Inactive</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="galleryFiles"
                       class="flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 px-4 py-9 text-center transition hover:border-brand hover:bg-brand-light">
                    <span class="mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-2xl shadow-sm">📷</span>
                    <span class="font-semibold text-slate-800">Click to choose gallery photos</span>
                    <span class="mt-1 text-xs text-slate-500">JPG, PNG, WebP • Up to 10 images • 2 MB each</span>
                    <span id="galleryFileCount" class="mt-3 text-xs font-semibold text-brand">No images selected</span>
                </label>

                <input id="galleryFiles" name="images[]" type="file"
                       accept=".jpg,.jpeg,.png,.webp"
                       multiple required class="sr-only">
            </div>

            <div id="galleryUploadPreview"
                 class="grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-5"></div>

            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                <button type="button" id="cancelGalleryUpload"
                        class="min-h-11 rounded-xl border border-slate-200 px-5 text-sm font-semibold text-slate-700">
                    Cancel
                </button>
                <button type="submit"
                        class="min-h-11 rounded-xl bg-brand px-6 text-sm font-semibold text-white transition hover:bg-brand-dark">
                    Upload Photos
                </button>
            </div>
        </form>
    </section>

    {{-- Gallery Heading --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-heading text-lg font-bold text-slate-900 sm:text-xl">All Gallery Photos</h2>
            <p class="mt-1 text-xs text-slate-500">{{ $images->total() }} photos in your library</p>
        </div>
        <span class="text-xs font-medium text-slate-500">Showing {{ $images->count() }} on this page</span>
    </div>

    {{-- Gallery Grid --}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
        @forelse($images as $image)
            <article class="group min-w-0 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
                <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
                    <img src="{{ asset('storage/' . $image->image) }}"
                         alt="{{ $image->alt_text ?: ($image->title ?: 'Salon gallery') }}"
                         class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                         loading="lazy">

                    <span class="absolute left-3 top-3 rounded-full px-3 py-1 text-[11px] font-bold shadow-sm
                        {{ $image->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-white text-slate-600' }}">
                        {{ $image->is_active ? '● Active' : '● Inactive' }}
                    </span>
                </div>

                <div class="space-y-4 p-4">
                    <div class="min-w-0">
                        <h3 class="truncate font-heading text-sm font-bold text-slate-900"
                            title="{{ $image->title }}">
                            {{ $image->title ?: 'Untitled Photo' }}
                        </h3>
                        <p class="mt-1 text-xs text-slate-500">
                            {{ $image->category?->name ?: 'Uncategorized' }}
                            <span class="mx-1">·</span>
                            Order {{ $image->sort_order }}
                        </p>
                    </div>

                    <div class="flex gap-2">
                        <button type="button"
                                data-gallery-edit="{{ $image->id }}"
                                aria-expanded="false"
                                aria-controls="gallery-edit-{{ $image->id }}"
                                class="min-h-10 flex-1 rounded-xl border border-slate-200 bg-white px-3 text-xs font-semibold text-slate-700 transition hover:bg-slate-50">
                            Edit Details
                        </button>

                        <form method="POST"
                              action="{{ route('admin.gallery-images.destroy', $image) }}"
                              onsubmit="return confirm('Permanently delete this image?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="min-h-10 rounded-xl border border-red-100 bg-red-50 px-3 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                Delete
                            </button>
                        </form>
                    </div>

                    {{-- Hidden until Edit Details is clicked --}}
                    <form id="gallery-edit-{{ $image->id }}"
                          method="POST"
                          action="{{ route('admin.gallery-images.update', $image) }}"
                          class="hidden space-y-3 border-t border-slate-100 pt-4">
                        @csrf
                        @method('PUT')

                        <label class="block text-xs font-semibold text-slate-600">
                            Category
                            <select name="gallery_category_id" required
                                    class="mt-1 min-h-10 w-full rounded-lg border border-slate-200 bg-white px-3 text-sm">
                                @foreach(\App\Models\GalleryCategory::orderBy('sort_order')->get() as $category)
                                    <option value="{{ $category->id }}"
                                        @selected($image->gallery_category_id == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>

                        <label class="block text-xs font-semibold text-slate-600">
                            Title
                            <input name="title" maxlength="255" value="{{ $image->title }}"
                                   class="mt-1 min-h-10 w-full rounded-lg border border-slate-200 px-3 text-sm">
                        </label>

                        <label class="block text-xs font-semibold text-slate-600">
                            Alt Text
                            <input name="alt_text" maxlength="255" value="{{ $image->alt_text }}"
                                   class="mt-1 min-h-10 w-full rounded-lg border border-slate-200 px-3 text-sm">
                        </label>

                        <div class="grid grid-cols-2 gap-2">
                            <label class="block text-xs font-semibold text-slate-600">
                                Sort Order
                                <input name="sort_order" type="number" min="0" required
                                       value="{{ $image->sort_order }}"
                                       class="mt-1 min-h-10 w-full min-w-0 rounded-lg border border-slate-200 px-3 text-sm">
                            </label>

                            <label class="block text-xs font-semibold text-slate-600">
                                Status
                                <select name="is_active"
                                        class="mt-1 min-h-10 w-full min-w-0 rounded-lg border border-slate-200 px-2 text-sm">
                                    <option value="1" @selected($image->is_active)>Active</option>
                                    <option value="0" @selected(!$image->is_active)>Inactive</option>
                                </select>
                            </label>
                        </div>

                        <button type="submit"
                                class="min-h-10 w-full rounded-xl bg-brand px-4 text-sm font-semibold text-white">
                            Save Changes
                        </button>
                    </form>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white px-5 py-16 text-center">
                <p class="text-4xl">📷</p>
                <h3 class="mt-4 font-heading text-lg font-bold text-slate-900">No gallery photos yet</h3>
                <p class="mt-2 text-sm text-slate-500">Start by uploading your salon portfolio images.</p>
            </div>
        @endforelse
    </div>

    <div class="pt-2">
        {{ $images->links() }}
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const panel = document.getElementById('galleryUploadPanel');
    const toggle = document.getElementById('toggleGalleryUpload');
    const close = document.getElementById('closeGalleryUpload');
    const cancel = document.getElementById('cancelGalleryUpload');
    const fileInput = document.getElementById('galleryFiles');
    const preview = document.getElementById('galleryUploadPreview');
    const count = document.getElementById('galleryFileCount');

    function setUploadOpen(open) {
        panel.classList.toggle('hidden', !open);
        toggle.setAttribute('aria-expanded', String(open));
        if (open) panel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    toggle.addEventListener('click', () => {
        setUploadOpen(panel.classList.contains('hidden'));
    });

    close.addEventListener('click', () => setUploadOpen(false));
    cancel.addEventListener('click', () => setUploadOpen(false));

    fileInput.addEventListener('change', function () {
        preview.replaceChildren();

        const files = Array.from(this.files || []);
        count.textContent = files.length
            ? files.length + ' image(s) selected'
            : 'No images selected';

        if (files.length > 10) {
            alert('Maximum 10 images allowed.');
            this.value = '';
            count.textContent = 'No images selected';
            return;
        }

        files.forEach(file => {
            if (!file.type.startsWith('image/')) return;

            const url = URL.createObjectURL(file);
            const img = document.createElement('img');

            img.src = url;
            img.alt = file.name;
            img.className = 'aspect-square w-full rounded-xl object-cover border border-slate-200';
            img.onload = () => URL.revokeObjectURL(url);

            preview.appendChild(img);
        });
    });

    document.querySelectorAll('[data-gallery-edit]').forEach(button => {
        button.addEventListener('click', function () {
            const form = document.getElementById(
                'gallery-edit-' + this.dataset.galleryEdit
            );
            const open = form.classList.contains('hidden');

            form.classList.toggle('hidden', !open);
            this.setAttribute('aria-expanded', String(open));
            this.textContent = open ? 'Close Editor' : 'Edit Details';
        });
    });

    if (!panel.classList.contains('hidden')) {
        toggle.setAttribute('aria-expanded', 'true');
    }
});
</script>
@endsection
