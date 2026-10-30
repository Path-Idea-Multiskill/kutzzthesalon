
@extends('frontend.layouts.app')

@section('title', ($service->meta_title ?: $service->name . ' | KUTZ Salon'))

@section('meta_description', $service->meta_description ?: ($service->short_description ?: 'Explore professional beauty and salon services at KUTZ Salon.'))

@section('content')

@php
    $categoryName = $service->category?->name ?? 'Beauty Services';

    $description = trim($service->description ?? '');

    $paragraphs = collect(
        preg_split('/\R{2,}/', $description)
    )->filter(fn ($p) => trim($p) !== '');

    $servicePoints = collect(
        preg_split('/\R/', $description)
    )->map(fn ($line) => trim($line, " \t\n\r\0\x0B-•"))
     ->filter()
     ->take(8);
@endphp

{{-- =========================================================
    KUTZ SALON — SERVICE DETAIL PAGE
    All frontend price displays removed
    Existing design and layout preserved
========================================================= --}}

{{-- HERO --}}
<section class="relative isolate overflow-hidden bg-brand-light">

    <div class="pointer-events-none absolute -left-24 top-12 h-80 w-80 rounded-full bg-rose-200/60 blur-3xl"></div>
    <div class="pointer-events-none absolute -right-20 bottom-0 h-96 w-96 rounded-full bg-rose-200/60 blur-3xl"></div>

    <div class="relative mx-auto grid max-w-7xl items-center gap-8 px-4 py-12 sm:px-6 lg:min-h-[520px] lg:grid-cols-2 lg:gap-12 lg:px-8 lg:py-16">

        {{-- LEFT CONTENT --}}
        <div class="relative z-10">

            {{-- BREADCRUMB --}}
            <nav aria-label="Breadcrumb" class="mb-8 flex flex-wrap items-center gap-2 text-xs text-slate-500">

                <a href="{{ route('home') }}" class="hover:text-brand">
                    Home
                </a>

                <span>›</span>

                <a href="{{ route('services.index') }}" class="hover:text-brand">
                    Services
                </a>

                <span>›</span>

                <span class="font-semibold text-brand">
                    {{ $service->name }}
                </span>

            </nav>

            {{-- CATEGORY --}}
            <span class="inline-flex rounded-full border border-rose-200 bg-white/70 px-4 py-2 text-xs font-bold uppercase tracking-wider text-brand">
                {{ $categoryName }}
            </span>

            {{-- SERVICE TITLE --}}
            <h1 class="mt-6 max-w-xl font-heading text-4xl font-bold leading-tight tracking-tight text-slate-950 sm:text-5xl lg:text-6xl">
                {{ $service->name }}
            </h1>

            {{-- SHORT DESCRIPTION --}}
            <p class="mt-6 max-w-lg text-sm leading-8 text-slate-600 sm:text-base">
                {{ $service->short_description ?: 'Experience personalized salon care and professional styling at KUTZ Salon.' }}
            </p>

            {{-- SERVICE DURATION
                 Price box removed.
                 Duration styling preserved.
            --}}
            <div class="mt-7 flex flex-wrap gap-3">

                @if($service->duration_minutes)

                    <div class="rounded-xl border border-rose-100 bg-white/80 px-5 py-3 shadow-sm">

                        <p class="text-xs text-slate-500">
                            Duration
                        </p>

                        <p class="mt-1 text-xl font-bold text-slate-900">
                            {{ $service->duration_minutes }} min
                        </p>

                    </div>

                @endif

            </div>

            {{-- BOOK APPOINTMENT --}}
            <a
                href="{{ route('home') }}#contact"
                class="mt-8 inline-flex min-h-12 items-center justify-center gap-3 rounded-full bg-brand px-7 py-3 text-sm font-bold text-white shadow-lg shadow-rose-500/20 transition hover:bg-brand-dark"
            >
                Book Your Appointment
                <span aria-hidden="true">→</span>
            </a>

        </div>

        {{-- RIGHT HERO IMAGE --}}
        <div class="relative">

            <div class="absolute inset-5 rounded-full bg-rose-200/60 blur-3xl"></div>

            <div class="relative aspect-[5/4] overflow-hidden rounded-[2rem] border-4 border-white/80 bg-white shadow-2xl sm:aspect-[6/5]">

                @if($service->image)

                    <img
                        src="{{ asset('storage/' . ltrim($service->image, '/')) }}"
                        alt="{{ $service->name }}"
                        fetchpriority="high"
                        class="h-full w-full object-cover"
                    >

                @else

                    <div class="flex h-full items-center justify-center bg-rose-100 font-heading text-3xl font-bold text-brand">
                        KUTZ SALON
                    </div>

                @endif

            </div>

            {{-- IMAGE DECORATIVE LABEL --}}
            <div class="absolute -bottom-4 right-4 rounded-2xl border border-white bg-white/95 px-5 py-4 shadow-xl sm:right-8">

                <p class="font-heading text-lg font-bold italic text-brand">
                    Feel Beautiful
                </p>

                <p class="mt-1 text-xs text-slate-500">
                    Be Confident. Be You.
                </p>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    SERVICE HIGHLIGHTS
========================================================= --}}

<section class="relative z-10 px-4 py-8 sm:px-6 lg:-mt-7 lg:px-8 lg:py-0">

    @php
        $highlights = [
            [
                'icon' => '✦',
                'title' => 'Professional Care',
                'text' => 'Thoughtful service'
            ],
            [
                'icon' => '♡',
                'title' => 'Personalized',
                'text' => 'Tailored experience'
            ],
            [
                'icon' => '✿',
                'title' => 'Beauty Expertise',
                'text' => 'Professional styling'
            ],
            [
                'icon' => '★',
                'title' => 'Quality Focus',
                'text' => 'Care and comfort'
            ],
        ];
    @endphp

    <div class="mx-auto grid max-w-6xl grid-cols-2 gap-3 rounded-3xl border border-rose-100 bg-white p-4 shadow-xl shadow-slate-900/5 sm:p-6 lg:grid-cols-4">

        @foreach($highlights as $item)

            <div class="flex items-center gap-3 p-2">

                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-brand-light text-xl text-brand">
                    {{ $item['icon'] }}
                </span>

                <div>

                    <p class="text-sm font-bold text-slate-900">
                        {{ $item['title'] }}
                    </p>

                    <p class="mt-1 text-xs text-slate-500">
                        {{ $item['text'] }}
                    </p>

                </div>

            </div>

        @endforeach

    </div>

</section>


{{-- =========================================================
    MAIN SERVICE CONTENT
========================================================= --}}

<section class="px-4 py-16 sm:px-6 lg:px-8 lg:py-24">

    <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-[minmax(0,1fr)_320px] lg:gap-12">

        {{-- LEFT MAIN CONTENT --}}
        <div class="min-w-0">

            <p class="text-xs font-bold uppercase tracking-[0.2em] text-brand">
                Discover the Experience
            </p>

            <h2 class="mt-3 font-heading text-3xl font-bold text-slate-950 sm:text-4xl">
                About {{ $service->name }}
            </h2>

            {{-- FULL DESCRIPTION --}}
            @if($description !== '')

                <div class="mt-6 space-y-5">

                    @foreach($paragraphs as $paragraph)

                        <p class="whitespace-pre-line text-sm leading-8 text-slate-600 sm:text-base">
                            {{ trim($paragraph) }}
                        </p>

                    @endforeach

                </div>

            @else

                <p class="mt-6 text-sm leading-8 text-slate-600 sm:text-base">
                    {{ $service->short_description ?: 'Contact our team to learn more about this salon service.' }}
                </p>

            @endif


            {{-- TREATMENT INFORMATION --}}
            <div class="mt-12 rounded-3xl border border-rose-100 bg-rose-50/60 p-5 sm:p-8">

                <h3 class="font-heading text-2xl font-bold text-slate-950">
                    Treatment Information
                </h3>

                <p class="mt-3 text-sm leading-7 text-slate-600">
                    Our team can explain the process, product suitability and aftercare for your selected treatment.
                </p>

                <div class="mt-6 grid gap-4 sm:grid-cols-2">

                    @foreach([
                        'Personal Consultation',
                        'Professional Application',
                        'Care & Comfort',
                        'Aftercare Guidance'
                    ] as $item)

                        <div class="flex items-center gap-3 rounded-xl border border-white bg-white p-4 shadow-sm">

                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-brand-light font-bold text-brand">
                                ✓
                            </span>

                            <span class="text-sm font-semibold text-slate-800">
                                {{ $item }}
                            </span>

                        </div>

                    @endforeach

                </div>

            </div>


            {{-- ADDITIONAL SERVICE DETAILS --}}
            @if($servicePoints->count())

                <div class="mt-12">

                    <h3 class="font-heading text-2xl font-bold text-slate-950">
                        More About This Service
                    </h3>

                    <div class="mt-6 grid gap-3 sm:grid-cols-2">

                        @foreach($servicePoints as $point)

                            <div class="flex items-start gap-3 rounded-xl border border-slate-100 bg-white p-4">

                                <span class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-brand-light text-brand">
                                    ✓
                                </span>

                                <span class="text-sm leading-6 text-slate-600">
                                    {{ $point }}
                                </span>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif

        </div>


        {{-- =================================================
            RIGHT STICKY BOOKING CARD
            Price row removed
        ================================================= --}}

        <aside class="min-w-0">

            <div class="rounded-3xl border border-rose-100 bg-white p-6 shadow-xl shadow-slate-900/5 lg:sticky lg:top-24">

                <p class="text-xs font-bold uppercase tracking-widest text-brand">
                    Service Details
                </p>

                <h3 class="mt-3 font-heading text-xl font-bold text-slate-950">
                    {{ $service->name }}
                </h3>

                {{-- SERVICE INFORMATION --}}
                <div class="mt-6 space-y-4 border-y border-slate-100 py-5">

                    {{-- CATEGORY --}}
                    <div class="flex justify-between gap-4 text-sm">

                        <span class="text-slate-500">
                            Category
                        </span>

                        <span class="text-right font-semibold text-slate-900">
                            {{ $categoryName }}
                        </span>

                    </div>

                    {{-- DURATION --}}
                    <div class="flex justify-between gap-4 text-sm">

                        <span class="text-slate-500">
                            Duration
                        </span>

                        <span class="font-semibold text-slate-900">
                            {{ $service->duration_minutes ? $service->duration_minutes . ' min' : 'On enquiry' }}
                        </span>

                    </div>

                </div>

                {{-- BOOKING BUTTON --}}
                <a
                    href="{{ route('home') }}#contact"
                    class="mt-6 flex min-h-12 items-center justify-center rounded-xl bg-brand px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-dark"
                >
                    Enquire / Book Now →
                </a>

                {{-- SUPPORTING TEXT --}}
                <p class="mt-4 text-center text-xs leading-5 text-slate-500">
                    Contact our team for service availability, consultation and appointment details.
                </p>

            </div>

        </aside>

    </div>

</section>


{{-- =========================================================
    RELATED SERVICES
    Price removed from related service cards
========================================================= --}}

@if($relatedServices->isNotEmpty())

<section class="bg-brand-light px-4 py-16 sm:px-6 lg:px-8 lg:py-20">

    <div class="mx-auto max-w-7xl">

        {{-- HEADING --}}
        <div class="flex flex-wrap items-end justify-between gap-5">

            <div>

                <p class="text-xs font-bold uppercase tracking-widest text-brand">
                    Explore More
                </p>

                <h2 class="mt-3 font-heading text-3xl font-bold text-slate-950">
                    Related Services
                </h2>

            </div>

            <a
                href="{{ route('services.index') }}"
                class="text-sm font-bold text-brand hover:underline"
            >
                View All Services →
            </a>

        </div>


        {{-- RELATED SERVICE CARDS --}}
        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

            @foreach($relatedServices as $related)

                <a
                    href="{{ route('services.show', $related->slug) }}"
                    class="group overflow-hidden rounded-2xl bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl"
                >

                    {{-- RELATED SERVICE IMAGE --}}
                    <div class="aspect-[16/10] overflow-hidden bg-rose-100">

                        @if($related->image)

                            <img
                                src="{{ asset('storage/' . ltrim($related->image, '/')) }}"
                                alt="{{ $related->name }}"
                                loading="lazy"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                            >

                        @else

                            <div class="flex h-full items-center justify-center font-bold text-brand">
                                KUTZ Salon
                            </div>

                        @endif

                    </div>

                    {{-- RELATED SERVICE CONTENT --}}
                    <div class="p-5">

                        <h3 class="font-heading text-lg font-bold text-slate-900 group-hover:text-brand">
                            {{ $related->name }}
                        </h3>

                        <p class="mt-2 line-clamp-2 text-sm leading-6 text-slate-500">
                            {{ $related->short_description }}
                        </p>

                        {{-- PRICE REMOVED.
                             Existing View Details link retained.
                        --}}
                        {{-- CENTERED VIEW DETAILS BUTTON --}}
<div class="mt-5 flex items-center justify-center">

    <span
        class="inline-flex min-h-11 w-full
               items-center justify-center gap-2
               rounded-xl bg-brand
               px-5 py-3 text-center
               text-sm font-bold text-white
               shadow-sm transition-all duration-300
               group-hover:bg-brand-dark
               group-hover:shadow-lg"
    >
        View Details

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="17"
            height="17"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="transition-transform duration-300 group-hover:translate-x-1"
            aria-hidden="true"
        >
            <path d="M5 12h14"/>
            <path d="m12 5 7 7-7 7"/>
        </svg>

    </span>

</div>

                    </div>

                </a>

            @endforeach

        </div>

    </div>

</section>

@endif


{{-- =========================================================
    FINAL CTA
========================================================= --}}

<section class="px-4 py-12 sm:px-6 lg:px-8 lg:py-16">

    <div class="relative mx-auto max-w-7xl overflow-hidden rounded-3xl bg-gradient-to-r from-red-950 via-red-900 to-brand px-6 py-10 text-white sm:px-10 lg:px-14 lg:py-14">

        <div class="relative z-10 flex flex-col items-start justify-between gap-7 lg:flex-row lg:items-center">

            <div>

                <h2 class="max-w-2xl font-heading text-2xl font-bold sm:text-3xl">
                    Ready to Refresh Your Look?
                </h2>

                <p class="mt-3 max-w-xl text-sm leading-7 text-rose-100">
                    Connect with KUTZ Salon and explore a beauty experience tailored to you.
                </p>

            </div>

            <a
                href="{{ route('home') }}#contact"
                class="inline-flex min-h-12 shrink-0 items-center justify-center rounded-full bg-white px-7 py-3 text-sm font-bold text-brand transition hover:bg-rose-50"
            >
                Book Your Appointment →
            </a>

        </div>

        {{-- DECORATIVE ELEMENT --}}
        <div class="pointer-events-none absolute -right-20 -top-28 h-80 w-80 rounded-full border-[45px] border-white/5"></div>

    </div>

</section>

@endsection
