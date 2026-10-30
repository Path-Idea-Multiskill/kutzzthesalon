@extends('frontend.layouts.app')

@section('title', 'Our Services | KUTZ Salon')

@section('meta_description', 'Explore hair, beauty, makeup and salon services at KUTZ Salon.')

@section('content')

    {{-- =========================================================
    KUTZ SALON — SERVICES LISTING PAGE
    Price display removed
    Existing UI and responsive design preserved
    ========================================================= --}}

    {{-- PAGE HERO --}}
    <section class="bg-brand-light px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
        <div class="mx-auto max-w-7xl text-center">

            <nav aria-label="Breadcrumb" class="mb-5 text-xs text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-brand">Home</a>
                <span class="mx-2">›</span>
                <span class="font-semibold text-brand">Services</span>
            </nav>

            <p class="text-xs font-bold uppercase tracking-[0.2em] text-brand">
                Our Expertise
            </p>

            <h1 class="mt-3 font-heading text-4xl font-bold text-slate-950 sm:text-5xl">
                Explore Our <span class="text-brand">Services</span>
            </h1>

            <p class="mx-auto mt-5 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base">
                Discover professional salon treatments, beauty services and
                personalized styling experiences at KUTZ Salon.
            </p>

        </div>
    </section>

    {{-- SERVICES GRID --}}
    <section class="px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
        <div class="mx-auto max-w-7xl">

            <div class="grid grid-cols-2 gap-3 sm:gap-5 md:grid-cols-3 lg:grid-cols-4">

                @forelse($services as $service)

                    <a href="{{ route('services.show', $service->slug) }}"
                        class="group flex min-w-0 flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:border-rose-200 hover:shadow-xl">

                        {{-- SERVICE IMAGE --}}
                        <div class="aspect-[4/5] overflow-hidden bg-brand-light">

                            @if($service->image)
                                <img src="{{ asset('storage/' . ltrim($service->image, '/')) }}" alt="{{ $service->name }}"
                                    loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            @else
                                <div class="flex h-full items-center justify-center font-bold text-brand">
                                    KUTZ SALON
                                </div>
                            @endif

                        </div>

                        {{-- SERVICE CONTENT --}}
                        <div class="flex flex-1 flex-col p-4">

                            {{-- CATEGORY --}}
                            <p class="text-xs font-semibold text-brand">
                                {{ $service->category?->name ?? 'Salon Service' }}
                            </p>

                            {{-- SERVICE NAME --}}
                            <h2
                                class="mt-2 line-clamp-2 font-heading text-base font-bold text-slate-900 group-hover:text-brand">
                                {{ $service->name }}
                            </h2>

                            {{-- SHORT DESCRIPTION --}}
                            <p class="mt-3 line-clamp-2 text-xs leading-6 text-slate-500">
                                {{ $service->short_description }}
                            </p>

                            {{-- SERVICE INFORMATION
                            Price removed.
                            Original spacing preserved.
                            --}}
                            <div class="mt-auto flex flex-wrap items-center justify-between gap-2 pt-5">

                                {{-- DURATION --}}
                                @if($service->duration_minutes)
                                    <span class="text-xs text-slate-500">
                                        {{ $service->duration_minutes }} min
                                    </span>
                                @endif

                            </div>

                            {{-- SERVICE DETAILS LINK --}}
                            {{-- SERVICE DETAILS BUTTON --}}
                            <div class="mt-4 border-t border-slate-100 pt-4">

                                <span class="flex min-h-10 w-full items-center
                       justify-center gap-2
                       rounded-xl bg-brand
                       px-2 py-2.5
                       text-center text-[10px] font-bold
                       text-white shadow-sm
                       transition-all duration-300
                       group-hover:bg-brand-dark
                       group-hover:shadow-md
                       sm:min-h-11 sm:px-4
                       sm:text-xs">
                                    View Service Details

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="shrink-0 transition-transform duration-300 group-hover:translate-x-1"
                                        aria-hidden="true">
                                        <path d="M5 12h14" />
                                        <path d="m12 5 7 7-7 7" />
                                    </svg>
                                </span>

                            </div>

                        </div>

                    </a>

                @empty

                    <p class="col-span-full rounded-2xl bg-slate-50 p-10 text-center text-slate-500">
                        No services are currently available.
                    </p>

                @endforelse

            </div>

            {{-- PAGINATION --}}
            <div class="mt-10">
                {{ $services->links() }}
            </div>

        </div>
    </section>

@endsection