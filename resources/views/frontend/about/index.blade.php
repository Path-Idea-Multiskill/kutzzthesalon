{{-- ============================================================
Kutzz THE SALON — ABOUT US PAGE
Laravel Blade + Tailwind CSS v4
Responsive: 320px / Mobile / Tablet / Laptop / Desktop
Theme: #D60927 / #A60820 / #FFF2F4 / White
============================================================ --}}

@extends('frontend.layouts.app')

@section('title', 'About Us | Kutzz The Salon')

@section('content')

    <main class="w-full overflow-x-clip bg-white text-[#171717]">

        {{-- ======================================================
        SECTION 1 — FULL WIDTH HERO
        Image: public/assets/images/about/about1.png
        ====================================================== --}}

        <section id="about-hero" class="relative isolate w-full overflow-hidden bg-[#FFF2F4]">

            {{-- FULL WIDTH BACKGROUND IMAGE --}}
            <div class="absolute inset-0 -z-20">

                <img src="{{ asset('assets/images/about/about1.png') }}" alt="Kutzz The Salon bridal beauty experience"
                    class="h-full w-full object-cover object-[67%_center]
                           sm:object-center" fetchpriority="high">

            </div>

            {{-- LEFT SIDE TEXT READABILITY OVERLAY --}}
            <div class="pointer-events-none absolute inset-0 -z-10
                       bg-gradient-to-r
                       from-[#FFF2F4]/95
                       via-[#FFF2F4]/85
                       to-transparent
                       sm:from-[#FFF2F4]/90
                       sm:via-[#FFF2F4]/55
                       lg:from-[#FFF2F4]/70
                       lg:via-[#FFF2F4]/15"></div>

            {{-- HERO CONTENT --}}
            <div class="relative mx-auto flex min-h-[570px]
                       w-full max-w-7xl items-end
                       px-5 pb-16 pt-12
                       sm:min-h-[510px] sm:items-center
                       sm:px-8 sm:py-20
                       lg:min-h-[570px] lg:px-10
                       xl:min-h-[620px]">

                <div class="w-full max-w-[560px]">

                    {{-- EYEBROW --}}
                    <div class="mb-5 flex items-center gap-3">

                        <span class="h-px w-8 bg-brand"></span>

                        <span class="text-[10px] font-bold uppercase
                                   tracking-[0.24em] text-brand
                                   sm:text-xs">
                            ABOUT US
                        </span>

                        <span class="h-px w-8 bg-brand"></span>

                    </div>

                    {{-- MAIN HEADING --}}
                    <h1 class="font-heading text-[37px] font-bold
                               leading-[1.12] tracking-tight
                               text-[#171717]
                               min-[375px]:text-[43px]
                               sm:text-[54px]
                               lg:text-[66px]
                               xl:text-[72px]">
                        Where Beauty

                        <span class="mt-1 block font-serif
                                   text-[43px] font-normal italic
                                   leading-[1.08] text-brand
                                   min-[375px]:text-[49px]
                                   sm:text-[62px]
                                   lg:text-[75px]
                                   xl:text-[80px]">
                            Meets Confidence
                        </span>

                    </h1>

                    {{-- DESCRIPTION --}}
                    <p class="mt-6 max-w-[430px]
                               text-sm leading-7 text-slate-700
                               sm:text-base sm:leading-8">
                        At Kutzz The Salon, we believe beauty is
                        not just a look, it's a feeling — and
                        everyone deserves to feel their best,
                        every single day.
                    </p>

                    {{-- CTA --}}
                    <div class="mt-8 flex flex-wrap gap-3">

                        <a href="{{ url('/contact') }}" class="group inline-flex min-h-12
                                   items-center justify-center
                                   gap-3 rounded-full
                                   bg-brand px-7 py-3
                                   text-xs font-bold uppercase
                                   tracking-[0.06em] text-white
                                   shadow-lg shadow-red-500/20
                                   transition duration-300
                                   hover:-translate-y-0.5
                                   hover:bg-brand-dark
                                   sm:text-sm">
                            BOOK APPOINTMENT

                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform
                                       group-hover:translate-x-1" aria-hidden="true">
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>

                        </a>

                    </div>

                </div>

            </div>

        </section>


        {{-- ======================================================
        SECTION 2 — FLOATING ACHIEVEMENT STATISTICS
        Sample figures — update with verified business data
        ====================================================== --}}

        <section class="relative z-10 mx-auto -mt-7
                   w-full max-w-6xl px-4
                   sm:-mt-9 sm:px-6 lg:px-8" aria-label="Kutzz Salon achievements">

            <div class="grid grid-cols-2 gap-0
                       overflow-hidden rounded-[22px]
                       border border-rose-100
                       bg-white/95
                       shadow-[0_14px_40px_rgba(214,9,39,0.10)]
                       backdrop-blur-md
                       lg:grid-cols-4">

                @php
                    $aboutStats = [
                        [
                            'value' => '30+',
                            'label' => 'Years of Experience',
                            'icon' => 'award',
                        ],
                        [
                            'value' => '10000+',
                            'label' => 'Happy Customers',
                            'icon' => 'user',
                        ],
                        [
                            'value' => '50+',
                            'label' => 'Expert Team',
                            'icon' => 'users',
                        ],
                        [
                            'value' => '100%',
                            'label' => 'Client Satisfaction',
                            'icon' => 'heart',
                        ],
                    ];
                @endphp

                @foreach($aboutStats as $stat)

                    <div class="flex min-w-0 items-center
                                   justify-center gap-3
                                   border-b border-rose-100
                                   px-3 py-5
                                   even:border-l
                                   lg:border-b-0
                                   lg:border-l
                                   lg:first:border-l-0
                                   sm:gap-4 sm:px-5 sm:py-6">

                        <div class="flex h-11 w-11 shrink-0
                                       items-center justify-center
                                       rounded-full bg-[#FFF2F4]
                                       text-brand
                                       sm:h-13 sm:w-13">

                            @if($stat['icon'] === 'award')
                                <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    aria-hidden="true">
                                    <circle cx="12" cy="8" r="5" />
                                    <path d="m8.2 12.7-1 8 4.8-2.5 4.8 2.5-1-8" />
                                </svg>
                            @elseif($stat['icon'] === 'user')
                                <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    aria-hidden="true">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M4 21v-2a8 8 0 0 1 16 0v2" />
                                </svg>
                            @elseif($stat['icon'] === 'users')
                                <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    aria-hidden="true">
                                    <circle cx="9" cy="8" r="3" />
                                    <path d="M3 20v-2a6 6 0 0 1 12 0v2" />
                                    <path d="M17 5a3 3 0 0 1 0 6M17 14a6 6 0 0 1 4 6" />
                                </svg>
                            @else
                                <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    aria-hidden="true">
                                    <path
                                        d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.8-8.6a5.5 5.5 0 0 0 0-7.8Z" />
                                </svg>
                            @endif

                        </div>

                        <div class="min-w-0">

                            <p class="font-heading text-xl
                                           font-extrabold text-[#171717]
                                           sm:text-2xl">
                                {{ $stat['value'] }}
                            </p>

                            <p class="mt-0.5 text-[10px]
                                           leading-4 text-slate-500
                                           sm:text-xs">
                                {{ $stat['label'] }}
                            </p>

                        </div>

                    </div>

                @endforeach

            </div>

        </section>


        {{-- ======================================================
        SECTION 3 — OUR STORY
        Image: about2.png
        ====================================================== --}}

        <section id="our-story" class="relative overflow-hidden bg-white
                   px-4 pb-16 pt-16
                   sm:px-6 sm:pb-20 sm:pt-20
                   lg:px-8 lg:py-24">

            <div class="relative z-10 mx-auto grid
                       max-w-7xl items-center
                       gap-9 lg:grid-cols-2
                       lg:gap-14 xl:gap-20">

                {{-- COMPANY IMAGE --}}
                <div class="relative overflow-hidden
                           rounded-[24px]
                           shadow-[0_18px_50px_rgba(0,0,0,0.09)]
                           sm:rounded-[30px]">

                    <img src="{{ asset('assets/images/about/secondImg.png') }}" alt="Kutzz The Salon interior and reception"
                        loading="lazy" decoding="async" class="aspect-[5/4] w-full
                               object-cover
                               sm:aspect-[6/4]
                               lg:aspect-[5/4]">

                </div>

                {{-- STORY CONTENT --}}
                <div class="min-w-0">

                    <p class="text-xs font-bold uppercase
                               tracking-[0.22em] text-brand">
                        — OUR STORY —
                    </p>

                    <h2 class="mt-3 font-heading text-3xl
                               font-bold leading-tight
                               tracking-tight
                               sm:text-4xl lg:text-[42px]">
                        About
                        <span class="text-brand">
                            Kutzz The Salon
                        </span>
                    </h2>

                    <p class="mt-6 text-sm leading-8
                               text-slate-600 sm:text-base">
                        Kutzz The Salon is dedicated to creating
                        beautiful and memorable experiences through
                        professional hair, beauty, makeup and
                        personal care services.
                    </p>

                    <p class="mt-4 text-sm leading-8
                               text-slate-600 sm:text-base">
                        Our approach brings together creativity,
                        professional techniques and individual
                        attention. Whether you're visiting us for
                        everyday grooming, a special celebration
                        or a complete style transformation,
                        our goal is to help you look and feel
                        your very best.
                    </p>

                    <p class="mt-4 text-sm leading-8
                               text-slate-600 sm:text-base">
                        We believe in thoughtful consultations,
                        quality service and a welcoming salon
                        environment where beauty meets confidence.
                    </p>

                    <a href="#our-journey" class="group mt-7 inline-flex
                               min-h-11 items-center
                               justify-center gap-3
                               rounded-full bg-brand
                               px-7 py-3 text-xs
                               font-bold uppercase
                               tracking-[0.06em] text-white
                               transition duration-300
                               hover:bg-brand-dark">
                        OUR JOURNEY

                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            aria-hidden="true" class="transition-transform
                                   group-hover:translate-x-1">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg>

                    </a>

                </div>

            </div>

        </section>


        {{-- ======================================================
        SECTION 4 — OUR DIRECTORS
        Images: about3.png and about4.png
        ====================================================== --}}

        <section id="our-directors" class="relative overflow-hidden
                   bg-[#FFF9FA] px-4
                   py-16 sm:px-6 sm:py-20
                   lg:px-8 lg:py-24">

            <div class="mx-auto max-w-6xl">

                {{-- SECTION HEADING --}}
                <div class="mx-auto max-w-2xl text-center">

                    <p class="text-xs font-bold uppercase
                               tracking-[0.22em] text-brand">
                        — OUR DIRECTORS —
                    </p>

                    <h2 class="mt-3 font-heading text-3xl
                               font-bold tracking-tight
                               sm:text-4xl">
                        Meet Our
                        <span class="text-brand">
                            Directors
                        </span>
                    </h2>

                    <p class="mx-auto mt-4 max-w-xl
                               text-sm leading-7
                               text-slate-600 sm:text-base">
                        Meet the people whose vision, passion
                        and dedication help shape the Kutzz
                        Salon experience.
                    </p>

                </div>


                {{-- DIRECTOR CARD 1 --}}
                <article class="relative mt-14 flex flex-col
                           items-center gap-6
                           rounded-[28px]
                           border border-rose-100
                           bg-gradient-to-r
                           from-[#FFE9ED] to-[#FFF4F6]
                           px-6 pb-8 pt-8
                           shadow-sm
                           sm:px-10
                           md:flex-row md:gap-9
                           md:py-9
                           lg:px-12">

                    {{-- PORTRAIT --}}
                    <!-- <div class="relative z-10 mx-auto
                               h-44 w-44 shrink-0
                               overflow-hidden rounded-full
                               border-[5px] border-white
                               bg-white shadow-lg
                               sm:h-48 sm:w-48
                               md:mx-0
                               lg:h-52 lg:w-52">

                        <img src="{{ asset('assets/images/about/about3.png') }}" alt="Meenakshi Tuteja — Director"
                            loading="lazy" decoding="async" class="h-full w-full object-cover">

                    </div> -->

                    {{-- CONTENT --}}
                    <div class="relative z-10 min-w-0
                               flex-1 text-center
                               md:text-left">

                        <h3 class="font-heading text-2xl
                                   font-bold text-[#171717]
                                   sm:text-[28px]">
                            Kutzz
                        </h3>

                        <!-- <p class="mt-1 text-sm font-semiboldsddssdsddfsdsf      
                                   text-brand">
                            Director
                        </p> -->

                        <p class="mt-4 text-sm leading-7
                                   text-slate-600 sm:text-base
                                   sm:leading-8">
                            My belief has always been that beauty
                            is about sharing confidence and
                            happiness. I value dedication,
                            creativity and client satisfaction,
                            and strive to make every experience
                            welcoming, thoughtful and memorable.
                        </p>

                        <p class="mt-4 text-sm leading-7
                                   text-slate-600 sm:text-base
                                   sm:leading-8">
                            We aim to create a warm and friendly
                            salon experience while offering
                            professional hair, beauty and
                            aesthetic services. Our team focuses
                            on technical skills, attentive care
                            and helping every client feel
                            comfortable and confident.
                        </p>

                    </div>

                    {{-- QUOTE DECORATION --}}
                    <span class="pointer-events-none absolute
                               right-6 top-4 font-serif
                               text-7xl leading-none
                               text-brand/20" aria-hidden="true">
                        “
                    </span>

                </article>


               

            </div>

        </section>


        {{-- ======================================================
        SECTION 5 — OUR JOURNEY IN NUMBERS
        Sample milestone figures
        ====================================================== --}}

        <section id="our-journey" class="bg-white px-4
                   py-16 sm:px-6 sm:py-20
                   lg:px-8">

            <div class="mx-auto max-w-7xl">

                <div class="text-center">

                    <p class="text-xs font-bold uppercase
                               tracking-[0.22em] text-brand">
                        — OUR MILESTONES —
                    </p>

                    <h2 class="mt-3 font-heading text-3xl
                               font-bold tracking-tight
                               sm:text-4xl">
                        Our Journey in
                        <span class="text-brand">
                            Numbers
                        </span>
                    </h2>

                </div>


                <div class="mt-10 grid grid-cols-2
                           gap-3 sm:gap-5
                           lg:grid-cols-4">

                    @php
                        $milestones = [
                            ['number' => '5', 'label' => 'Salons', 'symbol' => '⌂'],
                            ['number' => '1', 'label' => 'Academy', 'symbol' => '✦'],
                            ['number' => '200+', 'label' => 'Beauticians & Artists', 'symbol' => '✿'],
                            ['number' => '10000+', 'label' => 'Happy Clients', 'symbol' => '♥'],
                        ];
                    @endphp

                    @foreach($milestones as $milestone)

                        <div class="flex min-w-0 items-center
                                       justify-center gap-3
                                       rounded-[20px]
                                       border border-rose-100
                                       bg-[#FFF2F4]
                                       px-3 py-6
                                       sm:gap-4 sm:px-5">

                            <span class="flex h-11 w-11
                                           shrink-0 items-center
                                           justify-center rounded-full
                                           bg-white text-2xl
                                           font-bold text-brand
                                           sm:h-13 sm:w-13" aria-hidden="true">
                                {{ $milestone['symbol'] }}
                            </span>

                            <div class="min-w-0">

                                <p class="font-heading text-xl
                                               font-extrabold
                                               text-[#171717]
                                               sm:text-2xl">
                                    {{ $milestone['number'] }}
                                </p>

                                <p class="mt-1 text-[11px]
                                               leading-4
                                               text-slate-600
                                               sm:text-xs">
                                    {{ $milestone['label'] }}
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>


        {{-- ======================================================
        SECTION 6 — WHAT MAKES US DIFFERENT?
        ====================================================== --}}

        <section id="why-Kutz" class="relative overflow-hidden
                   bg-[#FFF7F9] px-4
                   py-16 sm:px-6 sm:py-20
                   lg:px-8 lg:py-24">

            <div class="relative z-10 mx-auto max-w-7xl">

                <div class="mx-auto max-w-3xl text-center">

                    <p class="text-xs font-bold uppercase
                               tracking-[0.22em] text-brand">
                        — WHY CHOOSE US —
                    </p>

                    <h2 class="mt-3 font-heading text-3xl
                               font-bold tracking-tight
                               sm:text-4xl">
                        What Makes Us
                        <span class="text-brand">
                            Different?
                        </span>
                    </h2>

                    <p class="mx-auto mt-4 max-w-2xl
                               text-sm leading-7
                               text-slate-600 sm:text-base">
                        We combine expertise, creativity
                        and care to give you an exceptional
                        beauty experience.
                    </p>

                </div>


                <div class="mt-10 grid grid-cols-1
                           gap-5 sm:grid-cols-2
                           lg:grid-cols-4">

                    @php
                        $features = [
                            [
                                'icon' => '◆',
                                'title' => 'Expert Team',
                                'description' => 'Skilled beauty professionals focused on quality styling and care.',
                            ],
                            [
                                'icon' => '✿',
                                'title' => 'Wide Range of Services',
                                'description' => 'Hair, beauty, makeup, skincare and salon services.',
                            ],
                            [
                                'icon' => '♥',
                                'title' => 'Personalized Care',
                                'description' => 'Thoughtful services tailored to your individual needs.',
                            ],
                            [
                                'icon' => '★',
                                'title' => 'Premium Experience',
                                'description' => 'A welcoming environment designed for comfort and care.',
                            ],
                        ];
                    @endphp

                    @foreach($features as $feature)

                        <article class="group flex min-h-[220px]
                                       flex-col items-center
                                       rounded-[22px]
                                       border border-rose-100
                                       bg-white px-6 py-8
                                       text-center
                                       shadow-[0_8px_30px_rgba(214,9,39,0.04)]
                                       transition duration-300
                                       hover:-translate-y-1
                                       hover:border-rose-200
                                       hover:shadow-[0_15px_35px_rgba(214,9,39,0.10)]">

                            <div class="flex h-16 w-16
                                           items-center justify-center
                                           rounded-full
                                           bg-[#FFF2F4]
                                           text-3xl text-brand
                                           transition duration-300
                                           group-hover:bg-brand
                                           group-hover:text-white" aria-hidden="true">
                                {{ $feature['icon'] }}
                            </div>

                            <h3 class="mt-5 font-heading
                                           text-base font-bold
                                           text-[#171717]">
                                {{ $feature['title'] }}
                            </h3>

                            <p class="mt-3 text-sm leading-6
                                           text-slate-600">
                                {{ $feature['description'] }}
                            </p>

                        </article>

                    @endforeach

                </div>

            </div>

        </section>


        {{-- ==========================================================
        SECTION 7 — BEAUTY JOURNEY CTA BANNER
        Image: public/assets/images/about/about6.png

        Desktop: Full-width banner with centered overlay text
        Mobile: Responsive image + readable content
        Theme: Kutzz Salon Red / Pink / White
        ========================================================== --}}

        <section id="about-beauty-journey" class="relative isolate w-full overflow-hidden
               bg-[#FFF2F4]" aria-labelledby="about-journey-heading">

            {{-- FULL WIDTH BACKGROUND IMAGE --}}
            <div class="absolute inset-0 -z-20">

                <img src="{{ asset('assets/images/about/about6.png') }}" alt="" loading="lazy" decoding="async" class="h-full w-full object-cover
                       object-center
                       max-sm:object-[34%_center]">

            </div>

            {{-- LIGHT OVERLAY FOR TEXT READABILITY --}}
            <div class="pointer-events-none absolute inset-0 -z-10
                   bg-gradient-to-r
                   from-[#FFF2F4]/10
                   via-[#FFF2F4]/45
                   to-[#FFF2F4]/10
                   max-sm:bg-[#FFF2F4]/55"></div>

            {{-- MAIN CONTENT --}}
            <div class="relative mx-auto flex min-h-[310px]
                   w-full max-w-7xl
                   items-center justify-center
                   px-5 py-12
                   sm:min-h-[340px]
                   sm:px-8 sm:py-14
                   lg:min-h-[390px]
                   lg:px-10 lg:py-16">

                {{-- TEXT CENTER AREA --}}
                <div class="relative z-10 mx-auto
                       w-full max-w-[620px]
                       text-center">

                    {{-- SMALL EYEBROW --}}
                    <p class="text-[10px] font-bold uppercase
                           tracking-[0.25em] text-[#171717]
                           sm:text-xs">
                        YOUR BEAUTY JOURNEY
                    </p>

                    {{-- MAIN HEADING --}}
                    <h2 id="about-journey-heading" class="mt-2 font-heading
                           text-[29px] font-bold
                           leading-[1.15]
                           tracking-tight text-[#171717]
                           min-[375px]:text-[34px]
                           sm:text-[42px]
                           lg:text-[50px]">
                        Your Beauty Journey

                        <span class="mt-1 block font-serif
                               text-[38px] font-normal
                               italic leading-[1.1]
                               text-brand
                               min-[375px]:text-[44px]
                               sm:text-[56px]
                               lg:text-[65px]">
                            Starts Here
                        </span>

                    </h2>

                    {{-- DESCRIPTION --}}
                    <p class="mx-auto mt-5 max-w-[460px]
                           text-xs leading-6
                           text-slate-700
                           sm:text-sm sm:leading-7">
                        Book a consultation with our experts and
                        experience the Kutzz difference.
                    </p>

                    {{-- CTA BUTTON --}}
                    <div class="mt-6 flex justify-center">

                        <a href="{{ url('/contact') }}" class="group inline-flex min-h-11
                               items-center justify-center
                               gap-3 rounded-full
                               bg-brand px-7 py-3
                               text-[11px] font-bold
                               uppercase tracking-[0.06em]
                               text-white
                               shadow-lg shadow-red-500/20
                               transition duration-300
                               hover:-translate-y-0.5
                               hover:bg-brand-dark
                               hover:shadow-xl
                               focus-visible:outline-2
                               focus-visible:outline-offset-2
                               focus-visible:outline-brand
                               sm:text-xs">
                            BOOK APPOINTMENT

                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                aria-hidden="true" class="transition-transform
                                   group-hover:translate-x-1">
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>

                        </a>

                    </div>

                </div>

            </div>

        </section>


    </main>

@endsection