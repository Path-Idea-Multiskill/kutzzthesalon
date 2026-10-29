
@extends('frontend.layouts.app')

@section('title', 'Beauty Gallery | KUTZ Salon')

@section('content')

<x-frontend.page-hero
    eyebrow="OUR BEAUTY GALLERY"
    title="Beauty, Creativity & Inspiration"
    description="Explore our salon work, transformations, styling, makeup and memorable moments."
    :image="$images->first()?->image ? asset('storage/'.$images->first()->image) : null"
    cta="Explore Gallery"
    href="#gallery-grid"
/>

<section id="gallery-grid" class="scroll-mt-24 px-4 py-16 sm:px-6 lg:py-20">
    <div class="mx-auto max-w-7xl">

        <div class="flex flex-wrap justify-center gap-3">
            <a href="{{ route('gallery.index') }}"
               class="rounded-full border px-5 py-2.5 text-sm font-semibold {{ !request('category') ? 'border-brand bg-brand text-white' : 'border-rose-200 bg-white text-slate-700' }}">
                All Photos
            </a>

            @foreach($categories as $category)
                <a href="{{ route('gallery.index', ['category' => $category->slug]) }}"
                   class="rounded-full border px-5 py-2.5 text-sm font-semibold transition {{ request('category') === $category->slug ? 'border-brand bg-brand text-white' : 'border-rose-200 bg-white text-slate-700 hover:border-brand hover:text-brand' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        <div class="mt-10 columns-2 gap-3 sm:columns-3 sm:gap-4 lg:columns-4">
            @forelse($images as $image)
                <a href="{{ asset('storage/'.$image->image) }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="group relative mb-3 block break-inside-avoid overflow-hidden rounded-2xl bg-rose-50 sm:mb-4">

                    <img src="{{ asset('storage/'.$image->image) }}"
                         alt="{{ $image->title ?? 'KUTZ Salon Gallery' }}"
                         loading="lazy"
                         class="w-full object-cover transition duration-500 group-hover:scale-105">

                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/75 to-transparent p-4 text-white opacity-0 transition group-hover:opacity-100">
                        <p class="line-clamp-2 text-sm font-semibold">
                            {{ $image->title ?: ($image->category?->name ?? 'KUTZ Salon') }}
                        </p>
                    </div>
                </a>
            @empty
                <p class="text-sm text-slate-500">Gallery images coming soon.</p>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $images->links() }}
        </div>

    </div>
</section>

@include('frontend.components.appointment-cta')

@endsection
