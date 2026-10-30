{{-- =========================================================
KUTZ SALON — THE EXPERIENCE
Full Width Image + Academy Section
Responsive: Mobile / Tablet / Laptop / Desktop
========================================================= --}}

<section id="experience" class="w-full overflow-hidden bg-[#FFF2F4]">

    {{-- ==========================================
    PART 1: EXPERIENCE INTRODUCTION
    ========================================== --}}

    <div class="mx-auto max-w-7xl px-4
               pb-10 pt-14 text-center
               sm:px-6 sm:pb-12 sm:pt-16
               lg:px-8 lg:pb-14 lg:pt-20">

        <p class="text-[11px] font-bold uppercase
                   tracking-[0.28em] text-brand
                   sm:text-xs">
            WELCOME TO KUTZ SALON
        </p>

        <h2 class="mt-3 font-heading
                   text-3xl font-bold
                   tracking-tight text-slate-950
                   sm:text-4xl lg:text-[44px]">
            The <span class="text-brand">Experience</span>
        </h2>

        <div class="mx-auto mt-5 h-1 w-14
                   rounded-full bg-brand"></div>

        <p class="mx-auto mt-6 max-w-4xl
                   text-sm leading-7 text-slate-600
                   sm:text-base sm:leading-8">
            At KUTZ Salon, beauty is more than a service —
            it's an experience. We bring together professional
            hair styling, beauty treatments, bridal artistry
            and personalized care to help every client look
            beautiful and feel confident.
        </p>

    </div>


    {{-- ==========================================
    PART 2: FULL WIDTH EXPERIENCE IMAGE
    ========================================== --}}

    <div class="relative isolate w-full
           overflow-hidden bg-[#FFF2F4]">

        <div class="relative h-[260px] w-full
                   sm:h-[380px]
                   md:h-[460px]
                   lg:h-[560px]
                   xl:h-[650px]">

            <img src="{{ asset('assets/images/ex1.png') }}" alt="KUTZ Salon premium bridal beauty experience"
                loading="lazy" decoding="async" class="absolute inset-0 h-full w-full
                       object-cover object-center">

            {{-- Soft premium image overlay --}}
            <div class="pointer-events-none absolute inset-0
                       bg-gradient-to-r
                       from-[#FFF2F4]/20
                       via-white/5
                       to-[#FFF2F4]/20"></div>

        </div>

    </div>


    {{-- ==========================================
    PART 3: LEARN & EXPERIENCE
    ========================================== --}}

    <div class="relative bg-[#FFF2F4] px-4
           py-14 sm:px-6 sm:py-16
           lg:px-8 lg:py-20">

        <div class="mx-auto max-w-6xl text-center">

            <p class="text-[11px] font-bold
                       uppercase tracking-[0.25em]
                       text-brand sm:text-xs">
                KUTZ SALON & ACADEMY
            </p>

            <!-- <h2
                class="mt-4 font-heading
                       text-3xl font-bold
                       tracking-tight text-slate-950
                       sm:text-4xl lg:text-[42px]"
            >
                Learn <span class="text-brand">&</span>
                Experience
            </h2> -->

            {{-- Decorative divider --}}
            <!-- <div
                class="mx-auto mt-5 flex
                       items-center justify-center gap-3"
                aria-hidden="true"
            >
                <span class="h-px w-12 bg-rose-200"></span>

                <span class="text-xl text-brand">✦</span>

                <span class="h-px w-12 bg-rose-200"></span>
            </div> -->


            {{-- BRAND PRESENTATION --}}
            <div class="mt-8 sm:mt-10">

                <p class="font-heading text-3xl
                           font-extrabold tracking-tight
                           text-slate-950 sm:text-4xl">
                    KUTZ
                    <span class="text-brand">SALON</span>
                </p>

                <p class="mt-2 text-[11px] font-semibold
                           uppercase tracking-[0.32em]
                           text-slate-500 sm:text-xs">
                    BEAUTY · STYLE · ACADEMY
                </p>

            </div>


            {{-- DESCRIPTION --}}
            <div class="mx-auto mt-8 max-w-5xl
                       space-y-4 text-sm leading-7
                       text-slate-600
                       sm:mt-10 sm:text-base
                       sm:leading-8">

                <p>
                    If you are passionate about beauty, hair styling,
                    makeup and helping people feel confident,
                    KUTZ Salon & Academy offers an opportunity
                    to explore the creative world of professional
                    beauty and personal care.
                </p>

                <!-- <p>
                    Discover practical learning, professional
                    techniques and creative skills through our
                    beauty and styling courses. Whether you are
                    beginning your journey or looking to develop
                    your existing skills, explore a world of
                    beauty, creativity and possibilities.
                </p> -->

            </div>


            {{-- CTA BUTTON --}}
            <div class="mt-9 flex justify-center sm:mt-10">

                @if(\Illuminate\Support\Facades\Route::has('academy.index'))

                    <a href="{{ route('academy.index') }}" class="group inline-flex min-h-12
                                       items-center justify-center
                                       gap-3 rounded-xl bg-brand
                                       px-8 py-3.5
                                       text-xs font-bold uppercase
                                       tracking-[0.08em] text-white
                                       shadow-lg shadow-red-500/20
                                       transition duration-300
                                       hover:-translate-y-0.5
                                       hover:bg-brand-dark
                                       hover:shadow-xl
                                       focus-visible:outline-2
                                       focus-visible:outline-offset-2
                                       focus-visible:outline-brand
                                       sm:text-sm">
                        SEE COURSES

                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform
                                           group-hover:translate-x-1" aria-hidden="true">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg>

                    </a>

                @endif

            </div>

        </div>

    </div>

</section>