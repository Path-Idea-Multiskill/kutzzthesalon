
@php
    /*
    |--------------------------------------------------------------------------
    | KUTZ Hero Carousel Images
    |--------------------------------------------------------------------------
    | Desktop: s1, s2, s3
    | Mobile:  s4, s5, s6
    */

    $heroSlides = [
        [
            'desktop' => asset('assets/images/home/s1.png'),
            'mobile'  => asset('assets/images/home/s4.png'),
        ],
        [
            'desktop' => asset('assets/images/home/s2.png'),
            'mobile'  => asset('assets/images/home/s5.png'),
        ],
        [
            'desktop' => asset('assets/images/home/s3.png'),
            'mobile'  => asset('assets/images/home/s6.png'),
        ],
    ];
@endphp

<section
    id="kutzHero"
    aria-label="KUTZ Salon Hero"
    aria-roledescription="carousel"
    class="relative isolate w-full overflow-hidden bg-[#FFF2F4]"
>

    {{-- ==========================================
         BACKGROUND IMAGE CAROUSEL
    ========================================== --}}

    <div
        class="pointer-events-none absolute inset-0 z-0"
        aria-hidden="true"
    >

        @foreach($heroSlides as $index => $slide)

            <div
                data-hero-slide
                class="absolute inset-0 transition-opacity
                       duration-500 ease-in-out
                       {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
            >

                <picture>

                    {{-- MOBILE IMAGE --}}
                    <source
                        media="(max-width: 767px)"
                        srcset="{{ $slide['mobile'] }}"
                    >

                    {{-- DESKTOP IMAGE --}}
                    <img
                        src="{{ $slide['desktop'] }}"
                        alt=""
                        class="block h-full w-full object-cover
                               object-center"
                        @if($index === 0)
                            loading="eager"
                            fetchpriority="high"
                        @else
                            loading="lazy"
                        @endif
                        decoding="async"
                    >

                </picture>

            </div>

        @endforeach

    </div>


    {{-- ==========================================
         DESKTOP BACKGROUND OVERLAY
         Mobile images already have text space
    ========================================== --}}

    <div
        class="pointer-events-none absolute inset-0 z-[1]
               hidden md:block
               bg-gradient-to-r
               from-[#FFF8F8]/90
               via-[#FFF8F8]/45
               to-transparent"
    ></div>


    {{-- ==========================================
         HERO MAIN CONTENT
    ========================================== --}}

    <div
        class="relative z-10 mx-auto flex w-full max-w-7xl

               min-h-[680px] flex-col justify-end
               px-4 pb-20 pt-8

               sm:min-h-[760px] sm:px-6 sm:pb-24

               md:min-h-[590px] md:flex-row
               md:items-center md:justify-start
               md:py-20

               lg:min-h-[650px] lg:px-8
               lg:py-24

               xl:min-h-[700px]"
    >

        <div
            class="w-full max-w-[620px]
                   text-center md:text-left"
        >

            {{-- WELCOME LABEL --}}
            <p
                class="mb-3 text-[10px] font-bold
                       uppercase tracking-[0.2em]
                       text-brand

                       sm:text-xs
                       md:mb-5 md:tracking-[0.28em]"
            >
                WELCOME TO KUTZ THE SALON
            </p>


            {{-- HERO HEADING --}}
            <h1
                class="font-heading
                       text-[clamp(2rem,8vw,3rem)]
                       font-bold leading-[1.12]
                       tracking-[-0.04em]
                       text-[#151724]

                       md:text-[clamp(3rem,5vw,5.4rem)]
                       md:leading-[1.08]"
            >

                Elevate Your

                <span
                    class="mt-1 block font-serif
                           font-normal italic
                           text-brand"
                >
                    Everyday Look
                </span>

            </h1>


            {{-- DESCRIPTION --}}
            <p
                class="mx-auto mt-4 max-w-[450px]
                       text-[13px] leading-6
                       text-slate-700

                       sm:text-sm sm:leading-7

                       md:mx-0 md:mt-7
                       md:text-base md:leading-8"
            >
                Experience premium hair, beauty, bridal and
                skincare services tailored to your individual style.
            </p>


            {{-- ======================================
                 HERO BUTTONS
            ====================================== --}}

            <div
                class="mt-6 flex flex-col
                       items-center justify-center gap-3

                       sm:mt-7

                       md:mt-9 md:flex-row
                       md:justify-start"
            >

                {{-- BOOK APPOINTMENT BUTTON --}}
                <a
                    href="{{ route('contact') }}"
                    class="inline-flex min-h-12
                           w-full max-w-[260px]
                           items-center justify-center
                           gap-3 rounded-xl

                           bg-brand px-6 py-3

                           text-xs font-bold
                           uppercase tracking-[0.06em]
                           text-white

                           shadow-lg shadow-red-600/20

                           transition duration-300
                           hover:-translate-y-0.5
                           hover:bg-brand-dark
                           hover:shadow-xl

                           md:w-auto md:max-w-none
                           md:text-sm"
                >

                    BOOK APPOINTMENT

                    <span
                        aria-hidden="true"
                        class="text-lg leading-none"
                    >
                        →
                    </span>

                </a>


                {{-- EXPLORE SERVICES: DESKTOP ONLY --}}
                <a
                    href="{{ route('services.index') }}"
                    class="hidden min-h-12
                           items-center justify-center

                           rounded-xl border
                           border-rose-200

                           bg-white/90 px-6 py-3

                           text-sm font-bold
                           uppercase tracking-[0.04em]
                           text-slate-900

                           shadow-sm backdrop-blur-sm

                           transition duration-300
                           hover:border-brand
                           hover:text-brand

                           md:inline-flex"
                >
                    EXPLORE SERVICES
                </a>

            </div>

        </div>

    </div>


    {{-- ==========================================
         CAROUSEL PAGINATION DOTS
    ========================================== --}}

    

</section>


{{-- ==========================================
     HERO CAROUSEL JAVASCRIPT
========================================== --}}

<script>
(function () {

    function initializeKutzHero() {

        const hero = document.getElementById('kutzHero');

        if (!hero || hero.dataset.initialized === 'true') {
            return;
        }

        hero.dataset.initialized = 'true';

        const slides = Array.from(
            hero.querySelectorAll('[data-hero-slide]')
        );

        

        if (slides.length < 2) {
            return;
        }

        let currentSlide = 0;
        let timer = null;

        // AUTO CHANGE EVERY 2 SECONDS
        const autoplayDelay = 2000;

        const reducedMotion = window.matchMedia(
            '(prefers-reduced-motion: reduce)'
        );


        function showSlide(index) {

            currentSlide =
                (index + slides.length) % slides.length;

            slides.forEach(function (slide, i) {

                const active = i === currentSlide;

                slide.classList.toggle(
                    'opacity-100',
                    active
                );

                slide.classList.toggle(
                    'opacity-0',
                    !active
                );

            });


            dots.forEach(function (dot, i) {

                const active = i === currentSlide;

                dot.classList.toggle(
                    'w-7',
                    active
                );

                dot.classList.toggle(
                    'bg-brand',
                    active
                );

                dot.classList.toggle(
                    'w-2',
                    !active
                );

                dot.classList.toggle(
                    'bg-slate-400/60',
                    !active
                );

                dot.setAttribute(
                    'aria-pressed',
                    String(active)
                );

            });

        }


        function stopAutoplay() {

            if (timer !== null) {

                clearInterval(timer);

                timer = null;

            }

        }


        function startAutoplay() {

            stopAutoplay();

            if (
                reducedMotion.matches ||
                document.hidden
            ) {
                return;
            }

            timer = setInterval(function () {

                showSlide(currentSlide + 1);

            }, autoplayDelay);

        }


        // DOT CLICK
        


        // PAUSE ON HOVER
        hero.addEventListener(
            'mouseenter',
            stopAutoplay
        );

        hero.addEventListener(
            'mouseleave',
            startAutoplay
        );


        // PAUSE ON KEYBOARD FOCUS
        hero.addEventListener(
            'focusin',
            stopAutoplay
        );

        hero.addEventListener(
            'focusout',
            function (event) {

                if (!hero.contains(event.relatedTarget)) {
                    startAutoplay();
                }

            }
        );


        // PAUSE WHEN TAB IS HIDDEN
        document.addEventListener(
            'visibilitychange',
            function () {

                if (document.hidden) {
                    stopAutoplay();
                } else {
                    startAutoplay();
                }

            }
        );


        // ACCESSIBILITY
        if (reducedMotion.addEventListener) {

            reducedMotion.addEventListener(
                'change',
                startAutoplay
            );

        }


        showSlide(0);

        startAutoplay();

    }


    if (document.readyState === 'loading') {

        document.addEventListener(
            'DOMContentLoaded',
            initializeKutzHero
        );

    } else {

        initializeKutzHero();

    }

})();
</script>
