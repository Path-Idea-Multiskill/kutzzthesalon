
@extends('admin.layouts.app')

@section('title', 'Gallery Categories | Kutzz Salon')

@section('content')
<div class="mx-auto w-full max-w-6xl min-w-0 space-y-6 pb-8">

    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="mb-1 text-xs font-bold uppercase tracking-widest text-brand">
                Gallery Organization
            </p>
            <h1 class="font-heading text-2xl font-bold text-slate-900 sm:text-3xl">
                Gallery Categories
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Organize your salon portfolio into categories.
            </p>
        </div>

        <a href="{{ route('admin.gallery-images.index') }}"
           class="inline-flex min-h-11 items-center justify-center rounded-xl border border-slate-200 bg-white px-5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
            Back to Gallery
        </a>
    </div>

    @if(session('success'))
        <div role="status" class="rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div role="alert" class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{-- Add Category --}}
    <section class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6">
        <div class="mb-5">
            <h2 class="font-heading text-lg font-bold text-slate-900">
                Add New Category
            </h2>
            <p class="mt-1 text-xs text-slate-500">
                Create categories for hair, makeup, nails and other portfolio photos.
            </p>
        </div>

        <form method="POST"
              action="{{ route('admin.gallery-categories.store') }}"
              class="grid grid-cols-1 items-end gap-4 md:grid-cols-12">
            @csrf

            <div class="md:col-span-5">
                <label for="new_category_name" class="mb-2 block text-sm font-semibold text-slate-700">
                    Category Name
                </label>
                <input id="new_category_name" name="name" required maxlength="255"
                       value="{{ old('name') }}"
                       placeholder="e.g. Hair Styling"
                       class="min-h-11 w-full min-w-0 rounded-xl border border-slate-200 px-4 text-sm focus:border-brand focus:outline-none">
            </div>

            <div class="md:col-span-2">
                <label for="new_category_order" class="mb-2 block text-sm font-semibold text-slate-700">
                    Sort Order
                </label>
                <input id="new_category_order" name="sort_order" type="number" min="0" required
                       value="{{ old('sort_order', 0) }}"
                       class="min-h-11 w-full min-w-0 rounded-xl border border-slate-200 px-4 text-sm">
            </div>

            <div class="md:col-span-2">
                <label for="new_category_status" class="mb-2 block text-sm font-semibold text-slate-700">
                    Status
                </label>
                <select id="new_category_status" name="is_active"
                        class="min-h-11 w-full min-w-0 rounded-xl border border-slate-200 bg-white px-3 text-sm">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <button type="submit"
                    class="min-h-11 rounded-xl bg-brand px-4 text-sm font-semibold text-white transition hover:bg-brand-dark md:col-span-3">
                + Add Category
            </button>
        </form>
    </section>

    {{-- Categories List --}}
    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 px-4 py-5 sm:px-6">
            <div>
                <h2 class="font-heading text-lg font-bold text-slate-900">
                    All Categories
                </h2>
                <p class="mt-1 text-xs text-slate-500">
                    {{ $categories->total() }} categories
                </p>
            </div>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse($categories as $category)
                <article class="p-4 transition hover:bg-slate-50/60 sm:px-6">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex min-w-0 items-center gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-brand-light font-heading text-lg font-bold text-brand">
                                {{ strtoupper(substr($category->name, 0, 1)) }}
                            </div>

                            <div class="min-w-0">
                                <h3 class="truncate font-heading text-sm font-bold text-slate-900">
                                    {{ $category->name }}
                                </h3>
                                <p class="mt-1 break-all text-xs text-slate-500">
                                    {{ $category->slug }}
                                </p>
                                <p class="mt-1 text-xs text-slate-400">
                                    {{ $category->images_count }} photos · Order {{ $category->sort_order }}
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center gap-2 sm:justify-end">
                            <span class="rounded-full px-3 py-1 text-xs font-semibold
                                {{ $category->is_active
                                    ? 'bg-emerald-50 text-emerald-700'
                                    : 'bg-slate-100 text-slate-600' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>

                            <button type="button"
                                    data-category-edit="{{ $category->id }}"
                                    aria-expanded="false"
                                    aria-controls="category-edit-{{ $category->id }}"
                                    class="min-h-10 rounded-xl border border-slate-200 px-4 text-xs font-semibold text-slate-700 hover:bg-white">
                                Edit
                            </button>

                            <form method="POST"
                                  action="{{ route('admin.gallery-categories.destroy', $category) }}"
                                  onsubmit="return confirm('Delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="min-h-10 rounded-xl border border-red-100 bg-red-50 px-4 text-xs font-semibold text-red-600 hover:bg-red-100">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Expandable Editor --}}
                    <form id="category-edit-{{ $category->id }}"
                          method="POST"
                          action="{{ route('admin.gallery-categories.update', $category) }}"
                          class="mt-5 hidden grid-cols-1 gap-3 rounded-xl border border-slate-100 bg-white p-4 sm:grid-cols-4">
                        @csrf
                        @method('PUT')

                        <div class="sm:col-span-2">
                            <label class="mb-1 block text-xs font-semibold text-slate-600">
                                Category Name
                            </label>
                            <input name="name" required maxlength="255"
                                   value="{{ $category->name }}"
                                   class="min-h-10 w-full min-w-0 rounded-lg border border-slate-200 px-3 text-sm">
                        </div>

                        <div>
                            <label class="mb-1 block text-xs font-semibold text-slate-600">
                                Sort Order
                            </label>
                            <input name="sort_order" type="number" min="0" required
                                   value="{{ $category->sort_order }}"
                                   class="min-h-10 w-full min-w-0 rounded-lg border border-slate-200 px-3 text-sm">
                        </div>

                        <div>
                            <label class="mb-1 block text-xs font-semibold text-slate-600">
                                Status
                            </label>
                            <select name="is_active"
                                    class="min-h-10 w-full min-w-0 rounded-lg border border-slate-200 bg-white px-3 text-sm">
                                <option value="1" @selected($category->is_active)>Active</option>
                                <option value="0" @selected(!$category->is_active)>Inactive</option>
                            </select>
                        </div>

                        <button type="submit"
                                class="min-h-10 rounded-lg bg-brand px-5 text-sm font-semibold text-white sm:col-span-4 sm:justify-self-end">
                            Save Changes
                        </button>
                    </form>
                </article>
            @empty
                <div class="p-12 text-center text-sm text-slate-500">
                    No gallery categories created yet.
                </div>
            @endforelse
        </div>
    </section>

    {{ $categories->links() }}
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-category-edit]').forEach(button => {
        button.addEventListener('click', function () {
            const form = document.getElementById(
                'category-edit-' + this.dataset.categoryEdit
            );

            const open = form.classList.contains('hidden');

            form.classList.toggle('hidden', !open);
            form.classList.toggle('grid', open);
            this.setAttribute('aria-expanded', String(open));
            this.textContent = open ? 'Close' : 'Edit';
        });
    });
});
</script>
@endsection
