
@extends('frontend.layouts.app')

@section('title', $blog->meta_title ?: $blog->title.' | KUTZZ Salon')

@section('meta_description', $blog->meta_description ?: $blog->excerpt)

@section('content')

<x-frontend.page-hero
    :eyebrow="$blog->category?->name ?? 'BEAUTY BLOG'"
    :title="$blog->title"
    :description="$blog->excerpt ?? ''"
    :image="$blog->featured_image ? asset('storage/'.$blog->featured_image) : null"
    cta="All Blog Posts"
    :href="route('blogs.index')"
/>

<section class="px-4 py-14 sm:px-6 lg:py-20">
    <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-[minmax(0,1fr)_320px]">

        <article class="min-w-0">
            <div class="mb-6 flex flex-wrap items-center gap-4 text-sm text-slate-500">
                @if($blog->published_at)
                    <span>📅 {{ $blog->published_at->format('d M Y') }}</span>
                @endif

                <span>✍ {{ $blog->author_name ?: 'KUTZZ Salon' }}</span>
            </div>

            @if($blog->featured_image)
                <img src="{{ asset('storage/'.$blog->featured_image) }}"
                     alt="{{ $blog->title }}"
                     class="w-full rounded-[1.5rem] object-cover shadow-sm">
            @endif

            <h2 class="mt-8 font-heading text-3xl font-bold leading-tight text-slate-950">
                {{ $blog->title }}
            </h2>

            <div class="mt-7 whitespace-pre-line break-words text-base leading-9 text-slate-700">
                {{ $blog->content }}
            </div>

            <div class="mt-10 border-t border-rose-100 pt-6">
                <a href="{{ route('blogs.index') }}"
                   class="inline-flex rounded-xl bg-brand px-6 py-3 text-sm font-bold text-white hover:bg-brand-dark">
                    ← Back to All Blogs
                </a>
            </div>
        </article>

        <aside>
            <div class="sticky top-24 rounded-[1.5rem] border border-rose-100 bg-white p-6 shadow-sm">
                <h3 class="font-heading text-xl font-bold text-slate-950">
                    Related Posts
                </h3>

                <div class="mt-5 space-y-5">
                    @forelse($relatedBlogs as $related)
                        <a href="{{ route('blogs.show', $related->slug) }}"
                           class="group flex items-start gap-3 border-b border-slate-100 pb-4 last:border-0">

                            @if($related->featured_image)
                                <img src="{{ asset('storage/'.$related->featured_image) }}"
                                     alt="{{ $related->title }}"
                                     loading="lazy"
                                     class="h-20 w-20 shrink-0 rounded-xl object-cover">
                            @endif

                            <div class="min-w-0">
                                <p class="line-clamp-3 text-sm font-bold leading-5 group-hover:text-brand">
                                    {{ $related->title }}
                                </p>
                                <p class="mt-2 text-xs text-slate-500">
                                    {{ $related->published_at?->format('d M Y') }}
                                </p>
                            </div>
                        </a>
                    @empty
                        <p class="text-sm text-slate-500">More articles coming soon.</p>
                    @endforelse
                </div>

                <div class="mt-6 rounded-2xl bg-brand-light p-5">
                    <h4 class="font-heading text-lg font-bold">Visit KUTZZ Salon</h4>
                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        Discover personalized beauty and hair services.
                    </p>
                    <a href="{{ route('services.index') }}"
                       class="mt-4 inline-flex text-sm font-bold text-brand">
                        Explore Services →
                    </a>
                </div>
            </div>
        </aside>

    </div>
</section>

@include('frontend.components.appointment-cta')

@endsection
