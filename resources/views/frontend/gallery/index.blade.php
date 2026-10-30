
@extends('frontend.layouts.app')

@section('title', 'Beauty Gallery | KUTZ Salon')

@section('content')

{{-- =========================================================
    KUTZ SALON — GALLERY PAGE
    Desktop Hero: gal1.png
    Mobile Hero:  gal2.png

    Desktop: Full-width image with left text overlay
    Mobile: Girl upper side, text bottom overlay

    No hero button
    Gallery content unchanged
    Responsive: 320px / Mobile / Tablet / Desktop
========================================================= --}}


{{-- =========================================================
    SECTION 1 — FULL WIDTH RESPONSIVE GALLERY HERO
========================================================= --}}

<section
    id="gallery-hero"
    class="relative isolate w-full overflow-hidden bg-[#FFF2F4]"
    aria-labelledby="gallery-hero-heading"
>

    {{-- RESPONSIVE BACKGROUND IMAGES --}}
    <div class="absolute inset-0 -z-20">

        <picture>

            {{-- MOBILE IMAGE --}}
            <source
                media="(max-width: 767px)"
                srcset="{{ asset('assets/images/gallery/gal2.png') }}"
            >

            {{-- DESKTOP IMAGE --}}
            <img
                src="{{ asset('assets/images/gallery/gal1.png') }}"
                alt="KUTZ Salon beauty, makeup and hairstyling gallery"
                fetchpriority="high"
                decoding="async"
                class="h-full w-full object-cover object-center"
            >

        </picture>

    </div>


    {{-- DESKTOP: SOFT LEFT GRADIENT --}}
    <div
        class="pointer-events-none absolute inset-0 -z-10
               hidden
               bg-gradient-to-r
               from-[#FFF2F4]/90
               via-[#FFF2F4]/55
               to-transparent
               md:block"
        aria-hidden="true"
    ></div>


    {{-- MOBILE: BOTTOM GRADIENT FOR TEXT READABILITY --}}
    <div
        class="pointer-events-none absolute inset-0 -z-10
               bg-gradient-to-t
               from-[#FFF2F4]/95
               via-[#FFF2F4]/55
               to-transparent
               md:hidden"
        aria-hidden="true"
    ></div>


    {{-- HERO CONTENT CONTAINER --}}
    <div
        class="relative mx-auto flex
               min-h-[570px] w-full
               max-w-7xl
               items-end
               px-5 pb-11 pt-12

               min-[375px]:min-h-[620px]
               min-[375px]:pb-14

               sm:min-h-[680px]
               sm:px-8 sm:pb-16

               md:min-h-[440px]
               md:items-center
               md:px-8 md:py-16

               lg:min-h-[540px]
               lg:px-10 lg:py-20

               xl:min-h-[620px]"
    >

        {{-- TEXT OVERLAY --}}
        <div
            class="relative z-10
                   w-full max-w-[540px]
                   text-center
                   md:text-left"
        >

            {{-- EYEBROW --}}
            <div
                class="mb-4 flex items-center
                       justify-center gap-3
                       md:justify-start"
            >

                <span class="h-px w-7 bg-brand"></span>

                <p
                    class="text-[10px] font-bold
                           uppercase tracking-[0.24em]
                           text-brand
                           sm:text-xs"
                >
                    OUR BEAUTY GALLERY
                </p>

                <span class="h-px w-7 bg-brand"></span>

            </div>


            {{-- MAIN HEADING --}}
            <h1
                id="gallery-hero-heading"
                class="font-heading
                       text-[34px] font-bold
                       leading-[1.15]
                       tracking-tight text-[#171717]

                       min-[375px]:text-[39px]
                       sm:text-[48px]
                       md:text-[43px]
                       lg:text-[57px]
                       xl:text-[64px]"
            >
                Beauty, Creativity

                <span
                    class="mt-1 block font-serif
                           text-[39px] font-normal
                           italic leading-[1.12]
                           text-brand

                           min-[375px]:text-[46px]
                           sm:text-[58px]
                           md:text-[53px]
                           lg:text-[68px]
                           xl:text-[76px]"
                >
                    & Inspiration
                </span>

            </h1>


            {{-- DESCRIPTION --}}
            <p
                class="mx-auto mt-5 max-w-[440px]
                       text-[13px] leading-6
                       text-slate-700

                       sm:mt-6 sm:text-base
                       sm:leading-8

                       md:mx-0"
            >
                Explore our salon work, transformations,
                styling, makeup and memorable moments.
            </p>

            {{-- NO BUTTON IN HERO --}}

        </div>

    </div>

</section>



{{-- =========================================================
    SECTION 2 — GALLERY CATEGORIES + IMAGE GRID
    Existing code preserved
========================================================= --}}

<section
    id="gallery-grid"
    class="scroll-mt-24 px-4 py-16 sm:px-6 lg:py-20"
>

    <div class="mx-auto max-w-7xl">

        {{-- CATEGORY FILTERS --}}
        <div class="flex flex-wrap justify-center gap-3">

            <a
                href="{{ route('gallery.index') }}"
                class="rounded-full border px-5 py-2.5
                       text-sm font-semibold
                       {{ !request('category')
                            ? 'border-brand bg-brand text-white'
                            : 'border-rose-200 bg-white text-slate-700' }}"
            >
                All Photos
            </a>

            @foreach($categories as $category)

                <a
                    href="{{ route('gallery.index', ['category' => $category->slug]) }}"
                    class="rounded-full border px-5 py-2.5
                           text-sm font-semibold transition
                           {{ request('category') === $category->slug
                                ? 'border-brand bg-brand text-white'
                                : 'border-rose-200 bg-white text-slate-700 hover:border-brand hover:text-brand' }}"
                >
                    {{ $category->name }}
                </a>

            @endforeach

        </div>


        {{-- GALLERY IMAGE GRID --}}
        <div
            class="mt-10 columns-2 gap-3
                   sm:columns-3 sm:gap-4
                   lg:columns-4"
        >

            @forelse($images as $image)

                <a
                    href="{{ asset('storage/'.$image->image) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="group relative mb-3 block
                           break-inside-avoid
                           overflow-hidden
                           rounded-2xl bg-rose-50
                           sm:mb-4"
                >

                    <img
                        src="{{ asset('storage/'.$image->image) }}"
                        alt="{{ $image->title ?? 'KUTZ Salon Gallery' }}"
                        loading="lazy"
                        class="w-full object-cover
                               transition duration-500
                               group-hover:scale-105"
                    >

                    <div
                        class="absolute inset-x-0 bottom-0
                               bg-gradient-to-t
                               from-black/75 to-transparent
                               p-4 text-white
                               opacity-0 transition
                               group-hover:opacity-100"
                    >

                        <p
                            class="line-clamp-2
                                   text-sm font-semibold"
                        >
                            {{ $image->title ?: ($image->category?->name ?? 'KUTZ Salon') }}
                        </p>

                    </div>

                </a>

            @empty

                <p class="text-sm text-slate-500">
                    Gallery images coming soon.
                </p>

            @endforelse

        </div>


        {{-- PAGINATION --}}
        <div class="mt-10">
            {{ $images->links() }}
        </div>

    </div>

</section>


{{-- =========================================================
    SECTION 3 — APPOINTMENT CTA
    Existing component preserved
========================================================= --}}

@include('frontend.components.appointment-cta')

@endsection
