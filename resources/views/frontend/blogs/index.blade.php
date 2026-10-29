
@extends('frontend.layouts.app')

@section('title', 'Beauty Blog | KUTZ Salon')

@section('content')

<x-frontend.page-hero
    eyebrow="OUR BEAUTY BLOG"
    title="Beauty Insights & Inspiration"
    description="Discover beauty tips, haircare advice, makeup trends and expert salon insights."
    :image="$blogs->first()?->featured_image ? asset('storage/'.$blogs->first()->featured_image) : null"
    cta="Read Our Articles"
    href="#latest-posts"
/>

<section id="latest-posts" class="scroll-mt-24 px-4 py-16 sm:px-6 lg:py-20">
    <div class="mx-auto max-w-7xl">

        <div class="flex flex-wrap justify-center gap-3">
            <a href="{{ route('blogs.index') }}"
               class="rounded-full border px-5 py-2.5 text-sm font-semibold {{ !request('category') ? 'border-brand bg-brand text-white' : 'border-rose-200 bg-white text-slate-700' }}">
                All Posts
            </a>

            @foreach($categories as $category)
                <a href="{{ route('blogs.index', ['category' => $category->slug]) }}"
                   class="rounded-full border px-5 py-2.5 text-sm font-semibold transition {{ request('category') === $category->slug ? 'border-brand bg-brand text-white' : 'border-rose-200 bg-white text-slate-700 hover:border-brand hover:text-brand' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        <div class="mt-10 text-center">
            <p class="text-xs font-bold uppercase tracking-widest text-brand">OUR LATEST POSTS</p>
            <h2 class="mt-3 font-heading text-3xl font-bold sm:text-4xl">
                Beauty Insights & <span class="text-brand">Inspiration</span>
            </h2>
        </div>

        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($blogs as $blog)
                <article class="group flex flex-col overflow-hidden rounded-2xl border border-rose-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

                    <a href="{{ route('blogs.show', $blog->slug) }}"
                       class="relative block aspect-[16/10] overflow-hidden bg-brand-light">
                        @if($blog->featured_image)
                            <img src="{{ asset('storage/'.$blog->featured_image) }}"
                                 alt="{{ $blog->title }}"
                                 loading="lazy"
                                 class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        @endif

                        <span class="absolute left-4 top-4 rounded-lg bg-brand px-3 py-1 text-xs font-bold text-white">
                            {{ $blog->category?->name ?? 'Beauty' }}
                        </span>
                    </a>

                    <div class="flex flex-1 flex-col p-6">
                        <p class="text-xs text-slate-500">
                            {{ $blog->published_at?->format('d M Y') }}
                            @if($blog->author_name)
                                · {{ $blog->author_name }}
                            @endif
                        </p>

                        <h3 class="mt-3 line-clamp-2 min-h-[56px] font-heading text-lg font-bold leading-7 text-slate-950">
                            <a href="{{ route('blogs.show', $blog->slug) }}" class="hover:text-brand">
                                {{ $blog->title }}
                            </a>
                        </h3>

                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-500">
                            {{ $blog->excerpt }}
                        </p>

                        <a href="{{ route('blogs.show', $blog->slug) }}"
                           class="mt-auto inline-flex w-fit items-center gap-2 pt-5 text-sm font-bold text-brand">
                            Read More →
                        </a>
                    </div>
                </article>
            @empty
                <p class="col-span-full rounded-2xl bg-brand-light p-10 text-center text-slate-600">
                    New beauty articles coming soon.
                </p>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $blogs->links() }}
        </div>
    </div>
</section>

@endsection
