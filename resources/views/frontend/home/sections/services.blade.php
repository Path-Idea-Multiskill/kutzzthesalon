
{{-- ================================================
    KUTZ SALON - PREMIUM SERVICES SLIDER
    Dynamic Data + Hidden Scrollbar + Responsive UI
================================================ --}}

<section
    id="services"
    class="scroll-mt-24 overflow-hidden bg-white px-4 py-14 sm:px-6 lg:px-8 lg:py-20"
>
    <div class="mx-auto w-full max-w-[1440px]">

        {{-- SECTION HEADING --}}
        <div class="mx-auto max-w-3xl text-center">

            <p class="text-xs font-bold uppercase tracking-[0.25em] text-brand">
                — OUR SERVICES —
            </p>

            <h2 class="mt-4 font-heading text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl lg:text-[42px]">
                Beauty Services by
                <span class="text-brand">KUTZ Salon</span>
            </h2>

            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base">
                Discover our professional beauty, hair, makeup and styling
                services, thoughtfully designed to make you look and feel your best.
            </p>

        </div>

        @if($services->isNotEmpty())

            {{-- SLIDER HEADER --}}
            <div class="mt-10 flex items-center justify-between gap-4">

                <div>
                    <h3 class="font-heading text-sm font-bold text-slate-900 sm:text-base">
                        Explore Our Treatments
                    </h3>

                    <p class="mt-1 text-xs text-slate-500">
                        {{ $services->count() }} services available
                    </p>
                </div>

                {{-- SLIDER BUTTONS --}}
                <div class="flex shrink-0 items-center gap-2">

                    {{-- PREVIOUS --}}
                    <button
                        type="button"
                        id="servicesPrev"
                        aria-label="Previous services"
                        aria-controls="servicesTrack"
                        class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-700 transition hover:border-brand hover:text-brand disabled:cursor-not-allowed disabled:opacity-30 sm:h-11 sm:w-11"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="20"
                             height="20"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round"
                             stroke-linejoin="round">
                            <path d="m15 18-6-6 6-6"/>
                        </svg>
                    </button>

                    {{-- NEXT --}}
                    <button
                        type="button"
                        id="servicesNext"
                        aria-label="Next services"
                        aria-controls="servicesTrack"
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-brand text-white transition hover:bg-brand-dark disabled:cursor-not-allowed disabled:opacity-30 sm:h-11 sm:w-11"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="20"
                             height="20"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round"
                             stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6"/>
                        </svg>
                    </button>

                </div>
            </div>

            {{-- ====================================
                SERVICES SLIDER
                SCROLLBAR COMPLETELY HIDDEN
            ===================================== --}}
            <div
                id="servicesTrack"
                tabindex="0"
                aria-label="Salon services slider"
                class="kutz-services-track mt-6 flex snap-x snap-mandatory gap-4 overflow-x-auto overflow-y-hidden overscroll-x-contain scroll-smooth pb-2 sm:gap-5 lg:gap-6"
            >

                @foreach($services as $service)

                    <a
                        href="{{ route('services.show', $service->slug) }}"
                        aria-label="View details of {{ $service->name }}"
                        class="group flex w-[88%] min-w-0 shrink-0 snap-start flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition-all duration-300 hover:border-rose-200 hover:shadow-lg hover:shadow-rose-950/10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand sm:w-[calc((100%-1.25rem)/2)] lg:w-[calc((100%-3rem)/3)] xl:w-[calc((100%-4.5rem)/4)]"
                    >

                        {{-- SERVICE IMAGE --}}
                        <div class="relative aspect-[16/11] overflow-hidden bg-brand-light">

                            @if($service->image)

                                <img
                                    src="{{ asset('storage/' . ltrim($service->image, '/')) }}"
                                    alt="{{ $service->name }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                >

                            @else

                                <div class="flex h-full items-center justify-center p-5 font-heading text-xl font-bold text-brand">
                                    KUTZ SALON
                                </div>

                            @endif

                            {{-- FEATURED BADGE --}}
                            @if($service->is_featured)

                                <span class="absolute left-3 top-3 rounded-full bg-brand px-3 py-1.5 text-[10px] font-bold text-white shadow-md">
                                    Featured
                                </span>

                            @endif

                            {{-- IMAGE OVERLAY --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>

                            {{-- HOVER ARROW --}}
                            <span class="absolute bottom-3 right-3 flex h-9 w-9 translate-y-2 items-center justify-center rounded-full bg-white text-brand opacity-0 shadow-lg transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="18"
                                     height="18"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2"
                                     stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path d="M7 17 17 7"/>
                                    <path d="M7 7h10v10"/>
                                </svg>

                            </span>

                        </div>

                        {{-- SERVICE CONTENT --}}
                        <div class="flex flex-1 flex-col p-4 sm:p-5">

                            {{-- CATEGORY --}}
                            <p class="line-clamp-1 text-[10px] font-bold uppercase tracking-wider text-brand">
                                {{ $service->category?->name ?? 'Salon Service' }}
                            </p>

                            {{-- SERVICE TITLE --}}
                            <h3 class="mt-2 line-clamp-2 min-h-[48px] font-heading text-base font-bold leading-6 text-slate-950 transition-colors group-hover:text-brand sm:text-lg">
                                {{ $service->name }}
                            </h3>

                            {{-- SHORT DESCRIPTION --}}
                            <p class="mt-2 line-clamp-2 min-h-[44px] text-sm leading-[22px] text-slate-500">
                                {{ $service->short_description }}
                            </p>

                            {{-- VIEW DETAILS BUTTON --}}
                            <div class="mt-auto pt-4">

                                <div class="flex min-h-11 items-center justify-between rounded-xl bg-brand-light px-4 py-3 text-xs font-bold text-brand transition-colors duration-300 group-hover:bg-brand group-hover:text-white sm:text-sm">

                                    <span>
                                        View Service Details
                                    </span>

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="18"
                                         height="18"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="2"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="shrink-0 transition-transform duration-300 group-hover:translate-x-1">
                                        <path d="M5 12h14"/>
                                        <path d="m12 5 7 7-7 7"/>
                                    </svg>

                                </div>

                            </div>

                        </div>

                    </a>

                @endforeach

            </div>

            {{-- VIEW ALL SERVICES --}}
            <div class="mt-9 text-center">

                <a
                    href="{{ route('services.index') }}"
                    class="inline-flex min-h-12 items-center justify-center gap-3 rounded-xl bg-brand px-8 py-3 text-sm font-bold text-white shadow-lg shadow-rose-500/15 transition hover:bg-brand-dark"
                >
                    Explore All Services

                    <span aria-hidden="true">→</span>
                </a>

            </div>

        @else

            {{-- EMPTY STATE --}}
            <div class="mt-10 rounded-2xl border border-dashed border-rose-200 bg-brand-light p-10 text-center">

                <h3 class="font-heading text-lg font-bold text-slate-900">
                    Services Coming Soon
                </h3>

                <p class="mt-2 text-sm text-slate-500">
                    Our latest beauty treatments will appear here.
                </p>

            </div>

        @endif

    </div>
</section>

{{-- ================================================
    SLIDER CSS
    HIDE HORIZONTAL SCROLLBAR
================================================ --}}
<style>
    .kutz-services-track {
        scrollbar-width: none !important;
        -ms-overflow-style: none !important;
    }

    .kutz-services-track::-webkit-scrollbar {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
    }

    .kutz-services-track::-webkit-scrollbar-thumb {
        display: none !important;
    }
</style>

{{-- ================================================
    SLIDER JAVASCRIPT
    PREVIOUS / NEXT BUTTONS
================================================ --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const track = document.getElementById('servicesTrack');
    const prev = document.getElementById('servicesPrev');
    const next = document.getElementById('servicesNext');

    if (!track || !prev || !next) {
        return;
    }

    function getScrollAmount() {

        const card = track.querySelector('a');

        if (!card) {
            return 320;
        }

        const gap = parseFloat(
            window.getComputedStyle(track).gap
        ) || 0;

        return card.getBoundingClientRect().width + gap;
    }

    function updateButtons() {

        const maxScroll = Math.max(
            0,
            track.scrollWidth - track.clientWidth
        );

        prev.disabled = track.scrollLeft <= 2;

        next.disabled = track.scrollLeft >= maxScroll - 2;
    }

    prev.addEventListener('click', function () {

        track.scrollBy({
            left: -getScrollAmount(),
            behavior: 'smooth'
        });

    });

    next.addEventListener('click', function () {

        track.scrollBy({
            left: getScrollAmount(),
            behavior: 'smooth'
        });

    });

    track.addEventListener(
        'scroll',
        updateButtons,
        { passive: true }
    );

    window.addEventListener(
        'resize',
        updateButtons
    );

    updateButtons();

});
</script>
