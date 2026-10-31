
@extends('admin.layouts.app')

@section('title', 'Blogs Management | Kutzz Salon')

@section('content')
@php
    $totalBlogs = \App\Models\Blog::count();
    $publishedBlogs = \App\Models\Blog::where('is_published', true)->count();
    $draftBlogs = \App\Models\Blog::where('is_published', false)->count();
@endphp

<div class="mx-auto w-full max-w-7xl min-w-0 space-y-6 pb-8">

    {{-- PAGE HEADER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="mb-1 text-xs font-bold uppercase tracking-[0.18em] text-brand">
                CONTENT MANAGEMENT
            </p>

            <h1 class="font-heading text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Blogs Management
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Create, organize and publish your salon articles.
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.blog-categories.index') }}"
               class="inline-flex min-h-11 items-center justify-center rounded-xl border border-slate-200 bg-white px-5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                Categories
            </a>

            <a href="{{ route('admin.blogs.create') }}"
               class="inline-flex min-h-11 items-center justify-center rounded-xl bg-brand px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-brand-dark">
                + Add New Blog
            </a>
        </div>
    </div>

    @if(session('success'))
        <div role="status" class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- STATS --}}
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                Total Articles
            </p>
            <p class="mt-3 font-heading text-3xl font-bold text-slate-900">
                {{ $totalBlogs }}
            </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                Published
            </p>
            <p class="mt-3 font-heading text-3xl font-bold text-emerald-600">
                {{ $publishedBlogs }}
            </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                Draft Articles
            </p>
            <p class="mt-3 font-heading text-3xl font-bold text-amber-600">
                {{ $draftBlogs }}
            </p>
        </div>
    </div>

    {{-- SECTION HEADER --}}
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <h2 class="font-heading text-lg font-bold text-slate-900">
                All Articles
            </h2>
            <p class="mt-1 text-xs text-slate-500">
                {{ $blogs->total() }} articles in your library
            </p>
        </div>

        <span class="text-xs font-medium text-slate-500">
            Showing {{ $blogs->count() }} articles
        </span>
    </div>

    {{-- BLOG GRID --}}
    <div class="grid grid-cols-1 items-stretch gap-5 sm:grid-cols-2 xl:grid-cols-3">

        @forelse($blogs as $blog)

            <article class="group flex h-full min-w-0 flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                {{-- BLOG IMAGE --}}
                <div class="relative aspect-[16/10] shrink-0 overflow-hidden bg-slate-100">

                    @if($blog->featured_image)
                        <img
                            src="{{ asset('storage/' . $blog->featured_image) }}"
                            alt="{{ $blog->title }}"
                            loading="lazy"
                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    @else
                        <div class="flex h-full items-center justify-center text-sm text-slate-400">
                            No Featured Image
                        </div>
                    @endif

                    {{-- PUBLISH BADGE --}}
                    <span class="absolute left-3 top-3 rounded-full px-3 py-1 text-[11px] font-bold shadow-sm
                        {{ $blog->is_published
                            ? 'bg-emerald-50 text-emerald-700'
                            : 'bg-amber-50 text-amber-700' }}">
                        {{ $blog->is_published ? '● Published' : '● Draft' }}
                    </span>

                    @if($blog->is_featured)
                        <span class="absolute right-3 top-3 rounded-full bg-white px-3 py-1 text-[11px] font-bold text-brand shadow-sm">
                            ★ Featured
                        </span>
                    @endif
                </div>

                {{-- CARD BODY --}}
                <div class="flex min-h-0 flex-1 flex-col p-5">

                    {{-- CATEGORY --}}
                    <div class="mb-3">
                        <span class="inline-flex max-w-full rounded-full bg-brand-light px-3 py-1 text-[11px] font-bold text-brand">
                            <span class="truncate">
                                {{ $blog->category?->name ?: 'Uncategorized' }}
                            </span>
                        </span>
                    </div>

                    {{-- FIXED TWO-LINE TITLE SPACE --}}
                    <h3 class="mb-3 line-clamp-2 h-[44px] overflow-hidden font-heading text-[15px] font-bold leading-[22px] text-slate-900"
                        title="{{ $blog->title }}">
                        {{ $blog->title }}
                    </h3>

                    {{-- FIXED DESCRIPTION SPACE --}}
                    <p class="mb-4 line-clamp-2 h-[40px] overflow-hidden text-[13px] leading-5 text-slate-500">
                        {{ $blog->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($blog->content), 150) }}
                    </p>

                    {{-- AUTHOR --}}
                    <div class="flex min-w-0 items-center gap-2 text-xs text-slate-500">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-brand-light text-xs font-bold text-brand">
                            K
                        </div>

                        <div class="min-w-0">
                            <p class="truncate font-semibold text-slate-700">
                                {{ $blog->author_name ?: 'Kutzz Salon Team' }}
                            </p>
                            <p class="mt-0.5 text-[11px] text-slate-400">
                                {{ ($blog->published_at ?? $blog->created_at)->format('d M Y') }}
                            </p>
                        </div>
                    </div>

                    {{-- PUSH ACTIONS TO BOTTOM --}}
                    <div class="mt-auto pt-5">

                        <div class="mb-4 border-t border-slate-100"></div>

                        <div class="flex gap-2">

                            <a href="{{ route('admin.blogs.edit', $blog) }}"
                               class="inline-flex min-h-11 flex-1 items-center justify-center rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:border-brand hover:text-brand">
                                Edit Article
                            </a>

                            <form method="POST"
                                  action="{{ route('admin.blogs.destroy', $blog) }}"
                                  onsubmit="return confirm('Are you sure you want to delete this blog?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="min-h-11 rounded-xl border border-red-100 bg-red-50 px-4 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
            </article>

        @empty

            <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white px-5 py-16 text-center">
                <div class="mb-4 text-4xl">📝</div>
                <h3 class="font-heading text-lg font-bold text-slate-900">
                    No Articles Yet
                </h3>
                <p class="mt-2 text-sm text-slate-500">
                    Start publishing beauty tips and salon updates.
                </p>

                <a href="{{ route('admin.blogs.create') }}"
                   class="mt-5 inline-flex min-h-11 items-center rounded-xl bg-brand px-6 text-sm font-semibold text-white">
                    Create First Blog
                </a>
            </div>

        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="pt-3">
        {{ $blogs->links() }}
    </div>

</div>
@endsection
