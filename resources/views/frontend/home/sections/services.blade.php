
{{-- =====================================================
    KUTZ SALON — INFINITE SERVICES MARQUEE
    Laravel Blade + Tailwind CSS + Vanilla JavaScript
    Desktop / Tablet / Mobile Responsive
===================================================== --}}

<section
    id="services"
    class="scroll-mt-24 overflow-hidden bg-white py-14 sm:py-16 lg:py-20"
>
    {{-- SECTION HEADING --}}
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-3xl text-center">

            <p class="text-xs font-bold uppercase tracking-[0.25em] text-brand">
                — OUR SERVICES —
            </p>

            <h2 class="mt-4 font-heading text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl lg:text-[42px]">
                Beauty Services by
                <span class="text-brand">KUTZZ Salon</span>
            </h2>

            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base">
                Discover our professional beauty, hair, makeup and styling
                services, thoughtfully designed to make you look and feel your best.
            </p>

        </div>

    </div>

    @if($services->isNotEmpty())

        {{-- SLIDER HEADER --}}
        <!-- <div class="mx-auto mt-10 flex max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">

            <div>
                <h3 class="font-heading text-base font-bold text-slate-900">
                    Explore Our Treatments
                </h3>

                <p class="mt-1 text-xs text-slate-500">
                    {{ $services->count() }} services available
                </p>
            </div>

            <div class="flex items-center gap-2 text-xs font-medium text-slate-500">
                <span class="relative flex h-2 w-2">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-brand opacity-30"></span>
                    <span class="relative inline-flex h-2 w-2 rounded-full bg-brand"></span>
                </span>

                <span>Explore our collection</span>
            </div>

        </div> -->

        {{-- =================================================
            FULL-WIDTH INFINITE MARQUEE
            Two identical groups create a seamless loop.
        ================================================== --}}

        <div
            id="kutzServicesMarquee"
            class="kutz-marquee relative mt-6 w-full overflow-hidden"
            aria-label="Explore KUTZZ Salon services"
        >

            {{-- LEFT EDGE FADE --}}
            <div
                class="pointer-events-none absolute inset-y-0 left-0 z-20 w-10 bg-gradient-to-r from-white via-white/65 to-transparent sm:w-20 lg:w-32"
                aria-hidden="true"
            ></div>

            {{-- RIGHT EDGE FADE --}}
            <div
                class="pointer-events-none absolute inset-y-0 right-0 z-20 w-10 bg-gradient-to-l from-white via-white/65 to-transparent sm:w-20 lg:w-32"
                aria-hidden="true"
            ></div>

            {{-- ANIMATED TRACK --}}
            <div
                class="kutz-marquee-track flex w-max items-stretch"
                data-marquee-track
            >

                @for($copy = 0; $copy < 2; $copy++)

                    <div
                        class="kutz-marquee-group flex shrink-0 items-stretch"
                        data-marquee-group
                        @if($copy === 1)
                            aria-hidden="true"
                            inert
                        @endif
                    >

                        @foreach($services as $service)

                            <a
                                href="{{ route('services.show', $service->slug) }}"
                                aria-label="View {{ $service->name }} service details"
                                @if($copy === 1) tabindex="-1" @endif
                                class="kutz-service-card group flex shrink-0 flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition-[border-color,box-shadow] duration-300 hover:border-rose-200 hover:shadow-xl hover:shadow-rose-950/10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand"
                            >

                                {{-- IMAGE --}}
                                <div class="relative aspect-[16/10] overflow-hidden bg-brand-light">

                                    @if($service->image)

                                        <img
                                            src="{{ asset('storage/' . ltrim($service->image, '/')) }}"
                                            alt="{{ $service->name }}"
                                            loading="lazy"
                                            decoding="async"
                                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        >

                                    @else

                                        <div class="flex h-full items-center justify-center p-5 font-heading text-xl font-bold text-brand">
                                            KUTZZ SALON
                                        </div>

                                    @endif

                                    {{-- FEATURED BADGE --}}
                                    @if($service->is_featured)

                                        <span class="absolute left-3 top-3 rounded-full bg-brand px-3 py-1.5 text-[10px] font-bold text-white shadow-md">
                                            Featured
                                        </span>

                                    @endif

                                    {{-- IMAGE HOVER OVERLAY --}}
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/15 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>

                                </div>

                                {{-- CARD CONTENT --}}
                                <div class="flex flex-1 items-center gap-3 p-4 sm:p-5">

                                    <div class="min-w-0 flex-1">

                                        {{-- CATEGORY --}}
                                        <p class="truncate text-[10px] font-bold uppercase tracking-wider text-brand">
                                            {{ $service->category?->name ?? 'Salon Service' }}
                                        </p>

                                        {{-- TITLE --}}
                                        <h3 class="mt-2 line-clamp-2 min-h-[44px] font-heading text-base font-bold leading-[22px] text-slate-950 transition-colors duration-300 group-hover:text-brand sm:text-[17px]">
                                            {{ $service->name }}
                                        </h3>

                                        {{-- ONE-LINE DESCRIPTION --}}
                                        <p class="mt-2 truncate text-xs leading-5 text-slate-500 sm:text-[13px]">
                                            {{ $service->short_description }}
                                        </p>

                                    </div>

                                    {{-- RIGHT ARROW --}}
                                    <span
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-rose-100 bg-brand-light text-brand shadow-sm transition-all duration-300 group-hover:border-brand group-hover:bg-brand group-hover:text-white group-hover:shadow-md"
                                        aria-hidden="true"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="19"
                                            height="19"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="transition-transform duration-300 group-hover:translate-x-0.5"
                                        >
                                            <path d="M5 12h14" />
                                            <path d="m12 5 7 7-7 7" />
                                        </svg>
                                    </span>

                                </div>

                            </a>

                        @endforeach

                    </div>

                @endfor

            </div>

        </div>

        {{-- VIEW ALL SERVICES --}}
        <div class="mt-10 px-4 text-center sm:px-6">

            <a
                href="{{ route('services.index') }}"
                class="inline-flex min-h-12 items-center justify-center gap-3 rounded-xl bg-brand px-8 py-3 text-sm font-bold text-white shadow-lg shadow-rose-500/15 transition duration-300 hover:-translate-y-0.5 hover:bg-brand-dark hover:shadow-xl"
            >
                Explore All Services
                <span aria-hidden="true">→</span>
            </a>

        </div>

    @else

        {{-- EMPTY STATE --}}
        <div class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="rounded-2xl border border-dashed border-rose-200 bg-brand-light p-10 text-center">

                <h3 class="font-heading text-lg font-bold text-slate-900">
                    Services Coming Soon
                </h3>

                <p class="mt-2 text-sm text-slate-500">
                    Our latest beauty treatments will appear here.
                </p>

            </div>

        </div>

    @endif

</section>


{{-- =====================================================
    INFINITE MARQUEE CSS
===================================================== --}}

<style>
    .kutz-marquee {
        --kutz-card-width: 330px;
        --kutz-card-gap: 24px;
        --kutz-marquee-duration: 40s;
    }

    .kutz-marquee-track {
        animation: kutzMarqueeMove var(--kutz-marquee-duration) linear infinite;
        will-change: transform;
    }

    .kutz-marquee-group {
        gap: var(--kutz-card-gap);
        padding-right: var(--kutz-card-gap);
    }

    .kutz-service-card {
        width: var(--kutz-card-width);
        min-width: var(--kutz-card-width);
        max-width: var(--kutz-card-width);
    }

    /*
     * Both groups have exactly the same width.
     * Moving -50% brings the second group into
     * the exact position of the first group.
     */
    @keyframes kutzMarqueeMove {
        from {
            transform: translate3d(0, 0, 0);
        }

        to {
            transform: translate3d(-50%, 0, 0);
        }
    }

    /*
     * Pause on mouse hover or keyboard focus.
     * JS additionally handles touch interaction.
     */
    .kutz-marquee:hover .kutz-marquee-track,
    .kutz-marquee:focus-within .kutz-marquee-track,
    .kutz-marquee.is-paused .kutz-marquee-track {
        animation-play-state: paused;
    }

    /*
     * Tablet
     */
    @media (max-width: 1023px) {
        .kutz-marquee {
            --kutz-card-width: 290px;
            --kutz-card-gap: 18px;
        }
    }

    /*
     * Mobile
     */
    @media (max-width: 639px) {
        .kutz-marquee {
            --kutz-card-width: min(78vw, 290px);
            --kutz-card-gap: 14px;
        }

        .kutz-service-card {
            border-radius: 16px;
        }
    }

    /*
     * Very small phones, including 320px.
     */
    @media (max-width: 359px) {
        .kutz-marquee {
            --kutz-card-width: 252px;
            --kutz-card-gap: 12px;
        }
    }

    /*
     * Respect system accessibility settings.
     */
    @media (prefers-reduced-motion: reduce) {
        .kutz-marquee-track {
            animation: none !important;
            transform: none !important;
        }

        .kutz-marquee {
            overflow-x: auto;
            scrollbar-width: none;
        }

        .kutz-marquee::-webkit-scrollbar {
            display: none;
        }

        .kutz-marquee-group[aria-hidden="true"] {
            display: none;
        }
    }
</style>


{{-- =====================================================
    INFINITE MARQUEE JAVASCRIPT
    Speed is measured in pixels per second.
===================================================== --}}

<script>
(function () {

    function initKutzServicesMarquee() {

        const marquee = document.getElementById('kutzServicesMarquee');

        if (!marquee || marquee.dataset.initialized === 'true') {
            return;
        }

        const track = marquee.querySelector('[data-marquee-track]');
        const firstGroup = marquee.querySelector('[data-marquee-group]');

        if (!track || !firstGroup) {
            return;
        }

        marquee.dataset.initialized = 'true';

        // Change this value to adjust speed.
        // 100 means approximately 100 pixels move each second.
        const speed = 100;

        function updateMarqueeSpeed() {

            const groupWidth = firstGroup.getBoundingClientRect().width;

            if (groupWidth <= 0) {
                return;
            }

            const duration = groupWidth / speed;

            marquee.style.setProperty(
                '--kutz-marquee-duration',
                duration + 's'
            );
        }

        // Pause while the visitor holds a finger on the cards.
        marquee.addEventListener('touchstart', function () {
            marquee.classList.add('is-paused');
        }, { passive: true });

        marquee.addEventListener('touchend', function () {
            marquee.classList.remove('is-paused');
        }, { passive: true });

        marquee.addEventListener('touchcancel', function () {
            marquee.classList.remove('is-paused');
        }, { passive: true });

        // Recalculate on window resize.
        let resizeFrame = null;

        window.addEventListener('resize', function () {

            if (resizeFrame !== null) {
                cancelAnimationFrame(resizeFrame);
            }

            resizeFrame = requestAnimationFrame(function () {
                updateMarqueeSpeed();
                resizeFrame = null;
            });

        });

        // Keep duration correct if fonts or layout sizes change.
        if ('ResizeObserver' in window) {

            const observer = new ResizeObserver(function () {
                updateMarqueeSpeed();
            });

            observer.observe(firstGroup);

        }

        updateMarqueeSpeed();

    }

    if (document.readyState === 'loading') {

        document.addEventListener(
            'DOMContentLoaded',
            initKutzServicesMarquee
        );

    } else {

        initKutzServicesMarquee();

    }

})();
</script>
