@extends('frontend.layouts.app')

@section('title', 'Beauty Blog | KUTZZ Salon')

@section('content')

    {{-- =========================================================
    KUTZZ SALON — BEAUTY BLOG PAGE

    Hero:
    Desktop / Laptop / Tablet: blog/b1.png
    Mobile: blog/b2.png

    Desktop: Left text overlay
    Mobile: Bottom text overlay
    No hero button

    Remaining blog listing UI unchanged
    ========================================================= --}}


    {{-- =========================================================
    SECTION 1 — FULL WIDTH RESPONSIVE BLOG HERO
    ========================================================= --}}

    <section id="blog-hero" class="relative isolate w-full overflow-hidden bg-[#FFF2F4]"
        aria-labelledby="blog-hero-heading">

        {{-- RESPONSIVE HERO BACKGROUND --}}
        <div class="absolute inset-0 -z-20">

            <picture class="block h-full w-full">

                {{-- MOBILE IMAGE --}}
                <source media="(max-width: 767px)" srcset="{{ asset('assets/images/blog/b2.png') }}">

                {{-- DESKTOP / LAPTOP / TABLET IMAGE --}}
                <img src="{{ asset('assets/images/blog/b1.png') }}"
                    alt="KUTZZ Salon beauty blog, hairstyling and makeup inspiration" fetchpriority="high" decoding="async"
                    class="block h-full w-full object-cover object-center">

            </picture>

        </div>


        {{-- DESKTOP LEFT GRADIENT --}}
        <div class="pointer-events-none absolute inset-0 -z-10
                   hidden
                   bg-gradient-to-r
                   from-[#FFF2F4]/90
                   via-[#FFF2F4]/55
                   to-transparent
                   md:block" aria-hidden="true"></div>


        {{-- MOBILE BOTTOM GRADIENT --}}
        <div class="pointer-events-none absolute inset-0 -z-10
                   bg-gradient-to-t
                   from-[#FFF2F4]/95
                   via-[#FFF2F4]/50
                   to-transparent
                   md:hidden" aria-hidden="true"></div>


        {{-- HERO CONTENT CONTAINER --}}
        <div class="relative mx-auto flex
                   min-h-[560px] w-full max-w-7xl
                   items-end
                   px-5 pb-12 pt-12

                   min-[375px]:min-h-[610px]
                   min-[375px]:pb-14

                   sm:min-h-[680px]
                   sm:px-8 sm:pb-16

                   md:min-h-[430px]
                   md:items-center
                   md:px-8 md:py-16

                   lg:min-h-[540px]
                   lg:px-10 lg:py-20

                   xl:min-h-[620px]">

            {{-- TEXT OVERLAY --}}
            <div class="relative z-10
                       w-full max-w-[570px]
                       text-center md:text-left">

                {{-- EYEBROW --}}
                <div class="mb-5 flex items-center
                           justify-center gap-3
                           md:justify-start">

                    <span class="h-px w-7 bg-brand"></span>

                    <p class="text-[10px] font-bold
                               uppercase tracking-[0.24em]
                               text-brand sm:text-xs">
                        OUR BEAUTY BLOG
                    </p>

                    <span class="h-px w-7 bg-brand"></span>

                </div>


                {{-- MAIN HEADING --}}
                <h1 id="blog-hero-heading" class="font-heading
                           text-[34px] font-bold
                           leading-[1.15]
                           tracking-tight text-[#171717]

                           min-[375px]:text-[40px]
                           sm:text-[49px]
                           md:text-[45px]
                           lg:text-[59px]
                           xl:text-[66px]">
                    Beauty Insights

                    <span class="mt-1 block font-serif
                               text-[39px] font-normal
                               italic leading-[1.12]
                               text-brand

                               min-[375px]:text-[46px]
                               sm:text-[58px]
                               md:text-[54px]
                               lg:text-[69px]
                               xl:text-[76px]">
                        & Inspiration
                    </span>

                </h1>


                {{-- DESCRIPTION --}}
                <p class="mx-auto mt-5 max-w-[450px]
                           text-[13px] leading-7
                           text-slate-700

                           sm:mt-6 sm:text-base
                           sm:leading-8

                           md:mx-0">
                    Discover beauty tips, haircare advice,
                    makeup trends and expert salon insights.
                </p>

                {{-- NO HERO BUTTON --}}

            </div>

        </div>

    </section>



    {{-- =========================================================
    SECTION 2 — BLOG CATEGORY FILTERS + POSTS
    ORIGINAL UI PRESERVED
    ========================================================= --}}

    <section id="latest-posts" class="scroll-mt-24 px-4 py-16 sm:px-6 lg:py-20">

        <div class="mx-auto max-w-7xl">

            {{-- CATEGORY FILTERS --}}
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


            {{-- BLOG SECTION HEADING --}}
            <div class="mt-10 text-center">

                <p class="text-xs font-bold uppercase tracking-widest text-brand">
                    OUR LATEST POSTS
                </p>

                <h2 class="mt-3 font-heading text-3xl font-bold sm:text-4xl">
                    Beauty Insights & <span class="text-brand">Inspiration</span>
                </h2>

            </div>


            {{-- BLOG CARDS GRID --}}
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                @forelse($blogs as $blog)

                    <article
                        class="group flex flex-col overflow-hidden rounded-2xl border border-rose-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

                        {{-- BLOG IMAGE --}}
                        <a href="{{ route('blogs.show', $blog->slug) }}"
                            class="relative block aspect-[16/10] overflow-hidden bg-brand-light">

                            @if($blog->featured_image)

                                <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" loading="lazy"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105">

                            @endif

                            {{-- BLOG CATEGORY BADGE --}}
                            <span class="absolute left-4 top-4 rounded-lg bg-brand px-3 py-1 text-xs font-bold text-white">
                                {{ $blog->category?->name ?? 'Beauty' }}
                            </span>

                        </a>


                        {{-- BLOG CONTENT --}}
                        <div class="flex flex-1 flex-col p-6">

                            {{-- PUBLISHED DATE + AUTHOR --}}
                            <p class="text-xs text-slate-500">

                                {{ $blog->published_at?->format('d M Y') }}

                                @if($blog->author_name)
                                    · {{ $blog->author_name }}
                                @endif

                            </p>


                            {{-- BLOG TITLE --}}
                            <h3 class="mt-3 line-clamp-2 min-h-[56px] font-heading text-lg font-bold leading-7 text-slate-950">

                                <a href="{{ route('blogs.show', $blog->slug) }}" class="hover:text-brand">
                                    {{ $blog->title }}
                                </a>

                            </h3>


                            {{-- BLOG EXCERPT --}}
                            <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-500">
                                {{ $blog->excerpt }}
                            </p>


                            {{-- READ MORE --}}
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


            {{-- PAGINATION --}}
            <div class="mt-10">
                {{ $blogs->links() }}
            </div>

        </div>

    </section>

@endsection