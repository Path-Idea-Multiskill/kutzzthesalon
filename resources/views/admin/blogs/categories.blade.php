
@extends('admin.layouts.app')

@section('title', 'Blog Categories | Kutzz Salon')

@section('content')
<div class="mx-auto w-full max-w-6xl min-w-0 space-y-6 pb-8">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <p class="mb-1 text-xs font-bold uppercase tracking-[0.18em] text-brand">
                CONTENT ORGANIZATION
            </p>

            <h1 class="font-heading text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Blog Categories
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Organize and manage your article categories.
            </p>
        </div>

        <a href="{{ route('admin.blogs.index') }}"
           class="inline-flex min-h-11 items-center justify-center rounded-xl border border-slate-200 bg-white px-5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
            Back to Blogs
        </a>

    </div>

    {{-- ALERTS --}}
    @if(session('success'))
        <div role="status" class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-medium text-emerald-700">
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

    {{-- ADD CATEGORY --}}
    <section class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6">

        <div class="mb-5">
            <h2 class="font-heading text-lg font-bold text-slate-900">
                Add New Category
            </h2>
            <p class="mt-1 text-xs text-slate-500">
                Create a new topic for your salon articles.
            </p>
        </div>

        <form method="POST"
              action="{{ route('admin.blog-categories.store') }}"
              class="grid grid-cols-1 items-end gap-4 md:grid-cols-12">
            @csrf

            <div class="md:col-span-5">
                <label for="category_name" class="mb-2 block text-sm font-semibold text-slate-700">
                    Category Name
                </label>

                <input id="category_name" name="name" required maxlength="255"
                       value="{{ old('name') }}"
                       placeholder="e.g. Hair Care Tips"
                       class="min-h-11 w-full min-w-0 rounded-xl border border-slate-200 bg-white px-4 text-sm outline-none transition focus:border-brand focus:ring-2 focus:ring-red-100">
            </div>

            <div class="md:col-span-2">
                <label for="category_order" class="mb-2 block text-sm font-semibold text-slate-700">
                    Sort Order
                </label>

                <input id="category_order" name="sort_order" type="number" min="0" required
                       value="{{ old('sort_order', 0) }}"
                       class="min-h-11 w-full min-w-0 rounded-xl border border-slate-200 px-4 text-sm">
            </div>

            <div class="md:col-span-2">
                <label for="category_status" class="mb-2 block text-sm font-semibold text-slate-700">
                    Status
                </label>

                <select id="category_status" name="is_active"
                        class="min-h-11 w-full min-w-0 rounded-xl border border-slate-200 bg-white px-3 text-sm">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <button type="submit"
                    class="min-h-11 rounded-xl bg-brand px-5 text-sm font-semibold text-white transition hover:bg-brand-dark md:col-span-3">
                + Add Category
            </button>

        </form>
    </section>

    {{-- CATEGORIES LIST --}}
    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-4 py-5 sm:px-6">

            <div>
                <h2 class="font-heading text-lg font-bold text-slate-900">
                    All Categories
                </h2>
                <p class="mt-1 text-xs text-slate-500">
                    {{ $categories->total() }} categories created
                </p>
            </div>

            <span class="rounded-full bg-brand-light px-3 py-1 text-xs font-bold text-brand">
                {{ $categories->total() }} Total
            </span>

        </div>

        <div class="divide-y divide-slate-100">

            @forelse($categories as $category)

                <article class="p-4 transition hover:bg-slate-50/60 sm:px-6">

                    {{-- COMPACT CATEGORY ROW --}}
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div class="flex min-w-0 items-center gap-4">

                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-brand-light text-xl font-bold text-brand">
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
                                    {{ $category->blogs_count }}
                                    {{ $category->blogs_count == 1 ? 'article' : 'articles' }}
                                    · Order {{ $category->sort_order }}
                                </p>
                            </div>

                        </div>

                        <div class="flex flex-wrap items-center gap-2 sm:justify-end">

                            <span class="rounded-full px-3 py-1 text-xs font-semibold
                                {{ $category->is_active
                                    ? 'bg-emerald-50 text-emerald-700'
                                    : 'bg-slate-100 text-slate-600' }}">
                                {{ $category->is_active ? '● Active' : '● Inactive' }}
                            </span>

                            <button type="button"
                                    data-category-edit="{{ $category->id }}"
                                    aria-expanded="false"
                                    aria-controls="category-edit-{{ $category->id }}"
                                    class="min-h-10 rounded-xl border border-slate-200 bg-white px-4 text-xs font-semibold text-slate-700 transition hover:border-brand hover:text-brand">
                                Edit
                            </button>

                            <form method="POST"
                                  action="{{ route('admin.blog-categories.destroy', $category) }}"
                                  onsubmit="return confirm('Delete this category?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="min-h-10 rounded-xl border border-red-100 bg-red-50 px-4 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                    Delete
                                </button>
                            </form>

                        </div>

                    </div>

                    {{-- COLLAPSIBLE EDIT FORM --}}
                    <form id="category-edit-{{ $category->id }}"
                          method="POST"
                          action="{{ route('admin.blog-categories.update', $category) }}"
                          class="mt-5 hidden grid-cols-1 gap-4 rounded-xl border border-slate-200 bg-slate-50 p-4 sm:grid-cols-4">

                        @csrf
                        @method('PUT')

                        <div class="sm:col-span-2">
                            <label class="mb-2 block text-xs font-semibold text-slate-600">
                                Category Name
                            </label>

                            <input name="name" required maxlength="255"
                                   value="{{ $category->name }}"
                                   class="min-h-10 w-full min-w-0 rounded-lg border border-slate-200 bg-white px-3 text-sm">
                        </div>

                        <div>
                            <label class="mb-2 block text-xs font-semibold text-slate-600">
                                Sort Order
                            </label>

                            <input name="sort_order" type="number" min="0" required
                                   value="{{ $category->sort_order }}"
                                   class="min-h-10 w-full min-w-0 rounded-lg border border-slate-200 bg-white px-3 text-sm">
                        </div>

                        <div>
                            <label class="mb-2 block text-xs font-semibold text-slate-600">
                                Status
                            </label>

                            <select name="is_active"
                                    class="min-h-10 w-full min-w-0 rounded-lg border border-slate-200 bg-white px-3 text-sm">
                                <option value="1" @selected($category->is_active)>Active</option>
                                <option value="0" @selected(!$category->is_active)>Inactive</option>
                            </select>
                        </div>

                        <div class="sm:col-span-4 sm:flex sm:justify-end">
                            <button type="submit"
                                    class="min-h-10 w-full rounded-lg bg-brand px-6 text-sm font-semibold text-white transition hover:bg-brand-dark sm:w-auto">
                                Save Changes
                            </button>
                        </div>

                    </form>

                </article>

            @empty

                <div class="px-5 py-14 text-center">
                    <p class="text-3xl">📁</p>
                    <h3 class="mt-3 font-heading text-base font-bold text-slate-900">
                        No Categories Found
                    </h3>
                    <p class="mt-2 text-sm text-slate-500">
                        Create your first blog category above.
                    </p>
                </div>

            @endforelse

        </div>
    </section>

    <div>
        {{ $categories->links() }}
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('[data-category-edit]').forEach(button => {

        button.addEventListener('click', function () {

            const form = document.getElementById(
                'category-edit-' + this.dataset.categoryEdit
            );

            if (!form) return;

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
