
@extends('frontend.layouts.app')

@section('title', 'KUTZZ Beauty Academy | Professional Courses')

@section('content')

{{-- =========================================================
    KUTZZ SALON — BEAUTY ACADEMY
    Desktop / Tablet Hero: ad1.png
    Mobile Hero: ad2.png

    Fixes:
    1. Full width responsive hero without button
    2. Curriculum numbering
    3. No blank space under course images on desktop
    4. Existing dynamic courses and fees preserved
========================================================= --}}

<main class="w-full overflow-x-clip bg-white">

    {{-- =====================================================
        SECTION 1 — RESPONSIVE ACADEMY HERO
    ===================================================== --}}

    <section
        id="academy-hero"
        class="relative isolate w-full overflow-hidden bg-[#FFF2F4]"
        aria-labelledby="academy-hero-title"
    >

        {{-- RESPONSIVE HERO IMAGES --}}
        <div class="absolute inset-0 -z-20">

            <picture class="block h-full w-full">

                {{-- MOBILE: 0px - 767px --}}
                <source
                    media="(max-width: 767px)"
                    srcset="{{ asset('assets/images/acadmy/ad2.png') }}"
                >

                {{-- TABLET / LAPTOP / DESKTOP --}}
                <img
                    src="{{ asset('assets/images/acadmy/ad1.png') }}"
                    alt="KUTZ Beauty Academy professional beauty and makeup training"
                    fetchpriority="high"
                    decoding="async"
                    class="h-full w-full object-cover object-center"
                >

            </picture>

        </div>


        {{-- DESKTOP LEFT GRADIENT --}}
        <div
            class="pointer-events-none absolute inset-0 -z-10
                   hidden bg-gradient-to-r
                   from-[#FFF2F4]/95
                   via-[#FFF2F4]/65
                   to-transparent
                   md:block"
            aria-hidden="true"
        ></div>


        {{-- MOBILE BOTTOM GRADIENT --}}
        <div
            class="pointer-events-none absolute inset-0 -z-10
                   bg-gradient-to-t
                   from-[#FFF2F4]/95
                   via-[#FFF2F4]/45
                   to-transparent
                   md:hidden"
            aria-hidden="true"
        ></div>


        {{-- HERO CONTENT --}}
        <div
            class="relative mx-auto flex
                   min-h-[560px] w-full max-w-7xl
                   items-end px-5 pb-12 pt-12

                   min-[375px]:min-h-[610px]
                   sm:min-h-[680px] sm:px-8 sm:pb-16

                   md:min-h-[430px] md:items-center
                   md:px-8 md:py-16

                   lg:min-h-[540px] lg:px-10
                   lg:py-20

                   xl:min-h-[620px]"
        >

            <div
                class="relative z-10 w-full
                       max-w-[570px]
                       text-center md:text-left"
            >

                {{-- EYEBROW --}}
                <div
                    class="mb-5 flex items-center
                           justify-center gap-3
                           md:justify-start"
                >

                    <span class="h-px w-8 bg-brand"></span>

                    <p
                        class="text-[10px] font-bold
                               uppercase tracking-[0.24em]
                               text-brand sm:text-xs"
                    >
                        KUTZZ BEAUTY ACADEMY
                    </p>

                    <span class="h-px w-8 bg-brand"></span>

                </div>


                {{-- HEADING --}}
                <h1
                    id="academy-hero-title"
                    class="font-heading
                           text-[38px] font-bold
                           leading-[1.12] tracking-tight
                           text-[#171717]

                           min-[375px]:text-[44px]
                           sm:text-[56px]
                           md:text-[50px]
                           lg:text-[66px]
                           xl:text-[74px]"
                >
                    Learn. Create.

                    <span
                        class="mt-1 block font-serif
                               text-[49px] font-normal
                               italic leading-[1.08]
                               text-brand

                               min-[375px]:text-[56px]
                               sm:text-[72px]
                               md:text-[65px]
                               lg:text-[82px]"
                    >
                        Grow.
                    </span>

                </h1>


                {{-- DESCRIPTION --}}
                <p
                    class="mx-auto mt-6 max-w-[460px]
                           text-sm leading-7
                           text-slate-700

                           sm:text-base sm:leading-8
                           md:mx-0"
                >
                    Build practical skills in beauty,
                    hair styling and makeup through
                    our professional academy courses.
                </p>

                {{-- NO BUTTON IN HERO --}}

            </div>

        </div>

    </section>



    {{-- =====================================================
        SECTION 2 — PROFESSIONAL COURSES
    ===================================================== --}}

    <section
        id="courses"
        class="scroll-mt-24 px-4 py-16
               sm:px-6 lg:px-8 lg:py-20"
    >

        <div class="mx-auto max-w-7xl">

            {{-- SECTION HEADING --}}
            <div class="text-center">

                <p
                    class="text-xs font-bold uppercase
                           tracking-widest text-brand"
                >
                    PROFESSIONAL TRAINING
                </p>

                <h2
                    class="mt-3 font-heading
                           text-3xl font-bold
                           sm:text-4xl"
                >
                    Courses
                    <span class="text-brand">Offered</span>
                </h2>

                <p
                    class="mx-auto mt-4 max-w-2xl
                           text-sm leading-7 text-slate-500"
                >
                    Discover beauty education designed
                    for aspiring professionals.
                </p>

            </div>


            {{-- COURSE CARDS --}}
            <div class="mt-10 space-y-7">

                @forelse($courses as $course)

                    @php
                        /*
                         * Normalize curriculum into numbered list items.
                         * Handles:
                         * 1. Topic
                         * 2) Topic
                         * - Topic
                         * • Topic
                         * Plain line-by-line topics
                         *
                         * Original text remains in database.
                         */

                        $curriculumText = trim(
                            (string) ($course->curriculum ?? '')
                        );

                        $curriculumItems = collect(
                            preg_split('/\r\n|\r|\n/', $curriculumText)
                        )
                        ->map(function ($line) {
                            $line = trim($line);

                            // Remove existing numeric or bullet prefixes.
                            $line = preg_replace(
                                '/^(?:\d+[\.\)]\s*|[-•*]\s*)/u',
                                '',
                                $line
                            );

                            return trim($line);
                        })
                        ->filter(function ($line) {
                            return $line !== '';
                        })
                        ->values();
                    @endphp


                    {{-- MAIN CARD
                         items-start prevents image column
                         from stretching to curriculum height.
                    --}}
                    <article
                        class="grid min-w-0
                               items-start overflow-hidden
                               rounded-[1.5rem]
                               border border-rose-100
                               bg-white shadow-sm
                               lg:grid-cols-2"
                    >

                        {{-- =================================
                            COURSE IMAGE
                            Fixed independent image height
                        ================================= --}}

                        <div
                            class="relative min-w-0
                                   self-start overflow-hidden
                                   bg-brand-light
                                   {{ $loop->even ? 'lg:order-2' : '' }}"
                        >

                            @if($course->image)

                                <img
                                    src="{{ asset('storage/'.$course->image) }}"
                                    alt="{{ $course->title }}"
                                    loading="lazy"
                                    decoding="async"
                                    class="block h-[250px] w-full
                                           object-cover
                                           sm:h-[330px]
                                           md:h-[380px]
                                           lg:h-[400px]"
                                >

                            @else

                                <div
                                    class="flex h-[250px] w-full
                                           items-center justify-center
                                           bg-brand-light
                                           px-5 text-center
                                           font-heading text-2xl
                                           font-bold text-brand
                                           sm:h-[330px]
                                           md:h-[380px]
                                           lg:h-[400px]"
                                >
                                    KUTZZ ACADEMY
                                </div>

                            @endif

                        </div>


                        {{-- =================================
                            COURSE CONTENT
                            Independent height / no stretching
                        ================================= --}}

                        <div
                            class="flex min-w-0 flex-col
                                   items-start p-6
                                   sm:p-9
                                   lg:self-start"
                        >

                            {{-- EYEBROW --}}
                            <p
                                class="text-xs font-bold
                                       uppercase tracking-widest
                                       text-brand"
                            >
                                BEAUTY EDUCATION
                            </p>


                            {{-- TITLE --}}
                            <h3
                                class="mt-3 font-heading
                                       text-2xl font-bold
                                       text-slate-950
                                       sm:text-[28px]"
                            >
                                {{ $course->title }}
                            </h3>


                            {{-- SUBTITLE --}}
                            @if($course->subtitle)

                                <p
                                    class="mt-2 font-medium
                                           text-slate-600"
                                >
                                    {{ $course->subtitle }}
                                </p>

                            @endif


                            {{-- DESCRIPTION --}}
                            <p
                                class="mt-4 text-sm
                                       leading-7 text-slate-600"
                            >
                                {{ $course->short_description }}
                            </p>


                            {{-- DURATION + FEES --}}
                            <!-- <div class="mt-5 flex flex-wrap gap-3">

                                @if($course->duration)

                                    <span
                                        class="rounded-full
                                               bg-brand-light
                                               px-4 py-2
                                               text-xs font-bold
                                               text-brand"
                                    >
                                        Duration:
                                        {{ $course->duration }}
                                    </span>

                                @endif


                                @if(!is_null($course->fees))

                                    <span
                                        class="rounded-full
                                               bg-slate-100
                                               px-4 py-2
                                               text-xs font-bold
                                               text-slate-700"
                                    >
                                        Fees:
                                        ₹{{ number_format((float) $course->fees, 0) }}
                                    </span>

                                @endif

                            </div> -->


                            {{-- =================================
                                COURSE CURRICULUM
                                Numbered list fixed
                            ================================= --}}

                            @if($curriculumItems->isNotEmpty())

                                <details
                                    class="group mt-6
                                           w-full min-w-0
                                           rounded-xl border
                                           border-rose-100
                                           bg-[#FFF9FA]
                                           p-4 sm:p-5"
                                >

                                    <summary
                                        class="flex cursor-pointer
                                               list-none items-center
                                               justify-between gap-3
                                               text-sm font-bold
                                               text-slate-900
                                               [&::-webkit-details-marker]:hidden"
                                    >

                                        <span>
                                            View Course Curriculum
                                        </span>

                                        {{-- TOGGLE ICON --}}
                                        <span
                                            class="flex h-8 w-8
                                                   shrink-0 items-center
                                                   justify-center
                                                   rounded-full
                                                   bg-white text-brand
                                                   transition-transform
                                                   duration-300
                                                   group-open:rotate-180"
                                        >

                                            <svg
                                                width="17"
                                                height="17"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                aria-hidden="true"
                                            >
                                                <path d="m6 9 6 6 6-6"/>
                                            </svg>

                                        </span>

                                    </summary>


                                    {{-- NUMBERED CURRICULUM --}}
                                    <div
                                        class="mt-5 border-t
                                               border-rose-100 pt-5"
                                    >

                                        <ol
                                            class="list-decimal
                                                   space-y-3
                                                   pl-6
                                                   text-sm leading-7
                                                   text-slate-600
                                                   marker:font-bold
                                                   marker:text-brand"
                                        >

                                            @foreach($curriculumItems as $item)

                                                <li class="pl-1">
                                                    {{ $item }}
                                                </li>

                                            @endforeach

                                        </ol>

                                    </div>

                                </details>

                            @endif


                            {{-- ENQUIRY BUTTON --}}
                            <a
                                href="{{ route('contact') }}"
                                class="mt-6 inline-flex
                                       min-h-11 w-fit
                                       items-center justify-center
                                       gap-2 rounded-xl
                                       bg-brand px-6 py-3
                                       text-sm font-bold
                                       text-white
                                       transition duration-300
                                       hover:bg-brand-dark"
                            >
                                Enquire About Course

                                <span aria-hidden="true">
                                    →
                                </span>

                            </a>

                        </div>

                    </article>

                @empty

                    <p
                        class="rounded-2xl bg-brand-light
                               p-10 text-center text-slate-600"
                    >
                        Academy courses coming soon.
                    </p>

                @endforelse

            </div>

        </div>

    </section>



    {{-- =====================================================
        SECTION 3 — OUR LEARNING FOCUS
        Original content preserved
    ===================================================== --}}

    <section
        class="bg-[#FFF7F8]
               px-4 py-16
               sm:px-6"
    >

        <div class="mx-auto max-w-7xl text-center">

            <h2
                class="font-heading text-3xl
                       font-bold text-slate-950"
            >
                Our Learning Focus
            </h2>


            <div
                class="mt-9 grid grid-cols-2
                       gap-4 md:grid-cols-3
                       lg:grid-cols-6"
            >

                @foreach([
                    'Professional Ethics',
                    'Skin Consultation',
                    'Hair Styling',
                    'Makeup Techniques',
                    'Practical Training',
                    'Career Guidance'
                ] as $focus)

                    <div
                        class="rounded-2xl
                               border border-rose-100
                               bg-white p-5 shadow-sm"
                    >

                        <span
                            class="text-2xl text-brand"
                            aria-hidden="true"
                        >
                            ✦
                        </span>

                        <p
                            class="mt-3 text-sm
                                   font-semibold"
                        >
                            {{ $focus }}
                        </p>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    {{-- =====================================================
        SECTION 4 — APPOINTMENT CTA
        Existing component preserved
    ===================================================== --}}

    @include('frontend.components.appointment-cta')

</main>

@endsection
