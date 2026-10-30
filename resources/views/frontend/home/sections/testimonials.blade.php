{{-- ==========================================================
KUTZ SALON — DIRECTOR & CLIENT TESTIMONIALS
Theme: Red / White / Soft Rose / Light Gray
Responsive: 320px to Large Desktop
All testimonial content is DEMO data
========================================================== --}}

@php
    $founderSlides = [
        [
            'name' => 'Our Creative Director',
            'role' => 'Salon & Academy',
            'portrait' => 'https://i.pravatar.cc/500?img=47',
            'background' => 'https://images.pexels.com/photos/3993449/pexels-photo-3993449.jpeg?auto=compress&cs=tinysrgb&w=1400',
            'message' => 'At KUTZ Salon, we believe beauty is personal. Every client deserves thoughtful care, professional styling and a welcoming experience that helps them feel confident and beautiful.',
        ],
        [
            'name' => 'Our Beauty Experts',
            'role' => 'Professional Styling Team',
            'portrait' => 'https://i.pravatar.cc/500?img=44',
            'background' => 'https://images.pexels.com/photos/3993456/pexels-photo-3993456.jpeg?auto=compress&cs=tinysrgb&w=1400',
            'message' => 'Our passion lies in combining creativity with personalized attention. From everyday hair care to bridal beauty, we aim to make every salon visit memorable.',
        ],
    ];

    // Demo testimonials — replace with real, approved reviews.
    $testimonials = [
        [
            'name' => 'Priyanka Rathore',
            'date' => '12 January 2026',
            'image' => 47,
            'rating' => 5,
            'review' => 'A wonderful salon experience. The team listened carefully to my styling preferences and helped me choose a look that felt comfortable and elegant.',
        ],
        [
            'name' => 'Ananya Sharma',
            'date' => '24 February 2026',
            'image' => 44,
            'rating' => 5,
            'review' => 'I really liked the welcoming atmosphere and the attention to detail. My haircut looked beautiful and was easy to manage afterward.',
        ],
        [
            'name' => 'Ritika Verma',
            'date' => '18 March 2026',
            'image' => 45,
            'rating' => 5,
            'review' => 'The bridal makeup consultation was very helpful. The artist understood the look I wanted and explained the process clearly.',
        ],
        [
            'name' => 'Sneha Gupta',
            'date' => '09 April 2026',
            'image' => 48,
            'rating' => 5,
            'review' => 'Such a relaxing facial session. The salon was neat, the staff were friendly and the entire appointment felt comfortable.',
        ],
        [
            'name' => 'Neha Singh',
            'date' => '21 May 2026',
            'image' => 49,
            'rating' => 5,
            'review' => 'Loved the professional approach to hair styling. They suggested a style that worked well with my hair texture.',
        ],
        [
            'name' => 'Pooja Mishra',
            'date' => '03 June 2026',
            'image' => 50,
            'rating' => 5,
            'review' => 'A pleasant experience from consultation to finishing. I appreciated the care and patience throughout my appointment.',
        ],
        [
            'name' => 'Aditi Jain',
            'date' => '17 June 2026',
            'image' => 51,
            'rating' => 5,
            'review' => 'The party makeup looked elegant and suited my outfit beautifully. I also received useful tips for maintaining the look.',
        ],
        [
            'name' => 'Simran Kaur',
            'date' => '02 July 2026',
            'image' => 52,
            'rating' => 5,
            'review' => 'Very happy with my hair spa session. The team explained the treatment and made the visit relaxing.',
        ],
        [
            'name' => 'Kavya Patel',
            'date' => '16 July 2026',
            'image' => 53,
            'rating' => 5,
            'review' => 'Beautiful nail art and a comfortable salon environment. The design was finished neatly and matched what I requested.',
        ],
        [
            'name' => 'Meera Joshi',
            'date' => '28 July 2026',
            'image' => 54,
            'rating' => 5,
            'review' => 'I appreciated how the stylist discussed my preferences before starting. The final haircut felt fresh and natural.',
        ],
        [
            'name' => 'Nidhi Agarwal',
            'date' => '08 August 2026',
            'image' => 55,
            'rating' => 5,
            'review' => 'The staff were attentive and the service was well organized. I enjoyed the calm atmosphere and personalized care.',
        ],
        [
            'name' => 'Sakshi Soni',
            'date' => '20 August 2026',
            'image' => 56,
            'rating' => 5,
            'review' => 'My makeup artist was patient and understood my preference for a soft, natural finish. A lovely experience overall.',
        ],
        [
            'name' => 'Riya Tiwari',
            'date' => '05 September 2026',
            'image' => 57,
            'rating' => 5,
            'review' => 'I liked the consultation and the clear explanation of the products used. The styling result was exactly what I had hoped for.',
        ],
        [
            'name' => 'Divya Sahu',
            'date' => '14 September 2026',
            'image' => 58,
            'rating' => 5,
            'review' => 'The salon team made my special occasion preparation easy and enjoyable. Everyone was helpful and professional.',
        ],
        [
            'name' => 'Tanvi Kapoor',
            'date' => '01 October 2026',
            'image' => 59,
            'rating' => 5,
            'review' => 'A very comfortable visit with careful attention to my hair care needs. I would love to explore more treatments.',
        ],
        [
            'name' => 'Shreya Dubey',
            'date' => '18 October 2026',
            'image' => 60,
            'rating' => 5,
            'review' => 'Great communication and thoughtful styling suggestions. I left feeling confident and happy with my new look.',
        ],
    ];
@endphp

<section id="client-testimonials" class="w-full min-w-0 overflow-hidden bg-[#F8F9FB]">

    {{-- ======================================================
    PART 1 — DIRECTOR CAROUSEL
    ====================================================== --}}

    <div id="kutzFounder" class="relative w-full overflow-hidden bg-[#FFF2F4]">

        @foreach($founderSlides as $index => $founder)

            <div data-founder-slide class="{{ $index === 0 ? '' : 'hidden' }}">

                <div class="relative mx-auto grid w-full
                               max-w-[1920px] grid-cols-1
                               lg:min-h-[390px]
                               lg:grid-cols-[58%_42%]">

                    {{-- LEFT CONTENT --}}
                    <div class="relative z-10 flex
                                   flex-col justify-center
                                   px-5 py-10
                                   sm:px-10 sm:py-12
                                   lg:px-12 lg:py-14
                                   xl:px-20">

                        <div class="grid items-center gap-7
                                       sm:grid-cols-[190px_minmax(0,1fr)]
                                       sm:gap-8
                                       lg:grid-cols-[210px_minmax(0,1fr)]
                                       xl:gap-10">

                            {{-- DIRECTOR PORTRAIT --}}
                            <div class="mx-auto h-48 w-48
                                           overflow-hidden rounded-full
                                           border-[5px] border-white
                                           bg-white shadow-lg
                                           shadow-rose-200/60
                                           sm:h-[190px] sm:w-[190px]
                                           lg:h-[210px] lg:w-[210px]">
                                <img src="{{ $founder['portrait'] }}" alt="Demo portrait — {{ $founder['name'] }}"
                                    loading="lazy" decoding="async" class="h-full w-full object-cover">
                            </div>

                            {{-- DIRECTOR MESSAGE --}}
                            <div class="min-w-0 text-center
                                           sm:text-left">

                                <div class="mb-4 inline-flex
                                               items-center gap-2">
                                    <span class="h-px w-7 bg-brand"></span>

                                    <span class="text-[11px] font-bold
                                                   uppercase
                                                   tracking-[0.2em]
                                                   text-brand">
                                        Our Story
                                    </span>
                                </div>

                                <p class="text-sm leading-7
                                               text-slate-600
                                               sm:text-[15px]
                                               sm:leading-8">
                                    {{ $founder['message'] }}
                                </p>

                                <h2 class="mt-6 font-heading
                                               text-2xl font-bold
                                               tracking-tight
                                               text-[#171717]
                                               sm:text-3xl">
                                    {{ $founder['name'] }}
                                </h2>

                                <p class="mt-1 text-sm
                                               font-semibold
                                               text-brand">
                                    {{ $founder['role'] }}
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- RIGHT IMAGE --}}
                    <div class="relative h-[240px]
                                   overflow-hidden
                                   sm:h-[320px]
                                   lg:h-auto lg:min-h-[390px]">

                        <img src="{{ $founder['background'] }}" alt="Beauty and salon styling" loading="lazy"
                            decoding="async" class="absolute inset-0
                                       h-full w-full object-cover
                                       object-center">

                        {{-- IMAGE FADE --}}
                        <div class="pointer-events-none
                                       absolute inset-0
                                       bg-gradient-to-t
                                       from-[#FFF2F4]/30
                                       via-transparent
                                       to-transparent
                                       lg:bg-gradient-to-r
                                       lg:from-[#FFF2F4]
                                       lg:via-[#FFF2F4]/25
                                       lg:to-transparent"></div>

                    </div>

                </div>

            </div>

        @endforeach


        {{-- ONLY RIGHT ARROW — NO COUNT, NO LEFT ARROW --}}
        <div class="relative z-20 flex
                   items-center justify-end
                   bg-[#FFF2F4]
                   px-5 py-3
                   sm:px-10 lg:px-16">

            <button type="button" id="kutzFounderNext" aria-label="Show next director slide" class="group inline-flex h-11 w-11
                       items-center justify-center
                       rounded-full bg-brand
                       text-white shadow-md
                       shadow-red-500/20
                       transition duration-300
                       hover:bg-brand-dark
                       hover:shadow-lg
                       focus-visible:outline-2
                       focus-visible:outline-offset-2
                       focus-visible:outline-brand">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    aria-hidden="true" class="transition-transform
                           group-hover:translate-x-0.5">
                    <path d="M5 12h14" />
                    <path d="m12 5 7 7-7 7" />
                </svg>
            </button>

        </div>

    </div>


    {{-- ======================================================
    PART 2 — CLIENT TESTIMONIALS
    ====================================================== --}}

    <div class="mx-auto w-full max-w-7xl
               px-4 py-14
               sm:px-6 sm:py-16
               lg:px-8 lg:py-20">

        {{-- HEADING --}}
        <div class="mx-auto max-w-3xl text-center">

            <p class="text-[11px] font-bold
                       uppercase tracking-[0.25em]
                       text-brand sm:text-xs">
                CLIENT STORIES
            </p>

            <h2 class="mt-3 font-heading
                       text-3xl font-bold
                       tracking-tight text-[#171717]
                       sm:text-4xl lg:text-[42px]">
                Trusted by
                <span class="text-brand">
                    Our Clients
                </span>
            </h2>

            <div class="mx-auto mt-5 h-1 w-14
                       rounded-full bg-brand"></div>

            <p class="mx-auto mt-5 max-w-2xl
                       text-sm leading-7
                       text-slate-600
                       sm:text-base sm:leading-8">
                Discover the kind of personalized beauty
                experiences we aim to create at KUTZ Salon.
            </p>

            <p class="mt-2 text-xs
                       text-slate-400">
                Preview content — sample testimonials
            </p>

        </div>


        {{-- SLIDER HEADER --}}
        <div class="mt-10 flex items-center
                   justify-between gap-3">

            <div class="min-w-0">

                <h3 class="font-heading text-base
                           font-bold text-[#171717]
                           sm:text-lg">
                    Client Experiences
                </h3>

                <p class="mt-1 text-xs
                           text-slate-500">
                    {{ count($testimonials) }} sample stories
                </p>

            </div>


            {{-- REVIEW PREVIOUS / NEXT --}}
            <div class="flex shrink-0 gap-2">

                <button id="kutzReviewPrev" type="button" aria-label="Previous testimonials"
                    aria-controls="kutzReviewTrack" class="flex h-10 w-10 items-center
                           justify-center rounded-full
                           border border-rose-200
                           bg-white text-brand
                           shadow-sm transition
                           hover:border-brand
                           hover:bg-[#FFF2F4]
                           disabled:cursor-not-allowed
                           disabled:opacity-30
                           sm:h-11 sm:w-11">
                    <span aria-hidden="true" class="text-lg">←</span>
                </button>

                <button id="kutzReviewNext" type="button" aria-label="Next testimonials" aria-controls="kutzReviewTrack"
                    class="flex h-10 w-10 items-center
                           justify-center rounded-full
                           bg-brand text-white
                           shadow-md shadow-red-500/15
                           transition
                           hover:bg-brand-dark
                           disabled:cursor-not-allowed
                           disabled:opacity-30
                           sm:h-11 sm:w-11">
                    <span aria-hidden="true" class="text-lg">→</span>
                </button>

            </div>

        </div>


        {{-- ==================================================
        REVIEW CAROUSEL — 16 CARDS
        ================================================== --}}

        <div id="kutzReviewTrack" tabindex="0" aria-label="Sample client testimonials" class="kutz-review-track
                   mt-6 flex snap-x
                   snap-mandatory gap-4
                   overflow-x-auto
                   overscroll-x-contain
                   pb-4
                   sm:gap-5
                   lg:gap-6">

            @foreach($testimonials as $review)

                    <article class="flex w-full min-w-0
                                   shrink-0 snap-start
                                   flex-col rounded-[22px]
                                   border border-rose-100
                                   bg-white p-5
                                   shadow-[0_10px_30px_rgba(214,9,39,0.045)]
                                   transition duration-300
                                   hover:border-rose-200
                                   hover:shadow-[0_16px_38px_rgba(214,9,39,0.09)]
                                   sm:w-[calc((100%-1.25rem)/2)]
                                   sm:p-6
                                   lg:w-[calc((100%-3rem)/3)]
                                   lg:p-7">

                        {{-- REVIEWER --}}
                        <div class="flex items-center gap-3">

                            <img src="https://i.pravatar.cc/150?img={{ $review['image'] }}" alt="Demo profile photo"
                                loading="lazy" decoding="async" class="h-12 w-12
                                           shrink-0 rounded-full
                                           border-2 border-rose-100
                                           object-cover">

                            <div class="min-w-0 flex-1">

                                <h4 class="truncate font-heading
                                               text-sm font-bold
                                               text-[#171717]">
                                    {{ $review['name'] }}
                                </h4>

                                <div class="mt-1 flex flex-wrap
                                               items-center gap-x-2
                                               gap-y-1">

                                    <span class="text-sm tracking-[0.06em]
                                                   text-amber-400" aria-label="{{ $review['rating'] }} out of 5 stars">
                                        {{ str_repeat('★', $review['rating']) }}
                                    </span>

                                    <span class="text-[11px]
                                                   text-slate-400">
                                        {{ $review['date'] }}
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- REVIEW DESCRIPTION --}}
                        <blockquote class="mt-5 min-h-[140px]
                                       text-sm leading-7
                                       text-slate-600">
                            “{{ $review['review'] }}”
                        </blockquote>


                        {{-- CARD FOOTER --}}
                        <!-- <div
                                class="mt-auto flex
                                       items-center gap-3
                                       border-t border-rose-100
                                       pt-5"
                            >

                                <span
                                    class="flex h-9 w-9
                                           items-center justify-center
                                           rounded-full
                                           bg-[#FFF2F4]
                                           font-heading text-sm
                                           font-bold text-brand"
                                    aria-hidden="true"
                                >
                                    K
                                </span>

                                <div>

                                    <p
                                        class="text-xs font-semibold
                                               text-[#171717]"
                                    >
                                        KUTZ Salon
                                    </p>

                                    <p
                                        class="text-[11px]
                                               text-slate-400"
                                    >
                                        Demo review
                                    </p>

                                </div>

                            </div> -->

                        {{-- ==========================================
                        TESTIMONIAL CARD FOOTER
                        Google Style Branding
                        ========================================== --}}

                        <div class="mt-auto flex items-center gap-2.5
                   border-t border-rose-100 pt-5">
                            {{-- Multicolor Google G Logo --}}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="h-9 w-9 shrink-0" role="img"
                                aria-label="Google">
                                <path fill="#EA4335"
                                    d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z" />
                                <path fill="#4285F4"
                                    d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.27 5.48-4.8 7.18l7.73 6C44.38 38.03 46.98 31.87 46.98 24.55z" />
                                <path fill="#FBBC05"
                                    d="M10.53 28.59A14.41 14.41 0 0 1 9.75 24c0-1.59.27-3.13.76-4.59l-7.98-6.2A23.9 23.9 0 0 0 0 24c0 3.87.93 7.51 2.56 10.78l7.97-6.19z" />
                                <path fill="#34A853"
                                    d="M24 48c6.48 0 11.93-2.13 15.91-5.8l-7.73-6c-2.15 1.45-4.92 2.3-8.18 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z" />
                            </svg>

                            {{-- Posted on Google Text --}}
                            <div class="flex flex-col leading-tight">

                                <span class="text-[10px] font-medium
                           text-[#171717]">
                                    Posted on
                                </span>

                                <span class="mt-0.5 text-[13px]
                           font-semibold text-[#4285F4]">
                                    Google
                                </span>

                            </div>
                        </div>


                    </article>

            @endforeach

        </div>


        {{-- SLIDER FOOTER --}}
        <div class="mt-5 flex flex-col
                   items-center justify-between
                   gap-3 text-center
                   sm:flex-row sm:text-left">

            <p class="text-xs text-slate-500">
                Swipe or use arrows to explore more stories.
            </p>

            <span id="kutzReviewProgress" class="text-xs font-bold
                       tracking-widest text-brand" aria-live="polite">
                01 / {{ str_pad(count($testimonials), 2, '0', STR_PAD_LEFT) }}
            </span>

        </div>

    </div>

</section>


{{-- ==========================================================
CSS — REVIEW SLIDER
========================================================== --}}

<style>
    .kutz-review-track {
        scrollbar-width: none;
        -ms-overflow-style: none;
        scroll-behavior: smooth;
        touch-action: pan-x pan-y;
    }

    .kutz-review-track::-webkit-scrollbar {
        display: none;
    }

    .kutz-review-track.is-dragging {
        cursor: grabbing;
        scroll-behavior: auto;
        scroll-snap-type: none;
        user-select: none;
    }

    @media (pointer: fine) {
        .kutz-review-track {
            cursor: grab;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .kutz-review-track {
            scroll-behavior: auto;
        }
    }
</style>


{{-- ==========================================================
JAVASCRIPT — DIRECTOR + TESTIMONIAL CAROUSELS
========================================================== --}}

<script>
    (function () {

        function initializeKutzTestimonials() {

            const section = document.getElementById(
                'client-testimonials'
            );

            if (!section || section.dataset.initialized === 'true') {
                return;
            }

            section.dataset.initialized = 'true';


            /* ==========================================
                DIRECTOR CAROUSEL
                Only next arrow, infinite looping
            ========================================== */

            const founder = document.getElementById(
                'kutzFounder'
            );

            if (founder) {

                const slides = Array.from(
                    founder.querySelectorAll(
                        '[data-founder-slide]'
                    )
                );

                const nextButton = document.getElementById(
                    'kutzFounderNext'
                );

                let activeIndex = 0;

                function showFounder(index) {

                    if (!slides.length) return;

                    activeIndex =
                        (index + slides.length) % slides.length;

                    slides.forEach(function (slide, i) {

                        slide.classList.toggle(
                            'hidden',
                            i !== activeIndex
                        );

                    });
                }

                if (nextButton) {

                    nextButton.addEventListener(
                        'click',
                        function () {
                            showFounder(activeIndex + 1);
                        }
                    );

                    nextButton.disabled = slides.length <= 1;
                }

                showFounder(0);
            }


            /* ==========================================
                TESTIMONIAL CAROUSEL
            ========================================== */

            const track = document.getElementById(
                'kutzReviewTrack'
            );

            const prev = document.getElementById(
                'kutzReviewPrev'
            );

            const next = document.getElementById(
                'kutzReviewNext'
            );

            const progress = document.getElementById(
                'kutzReviewProgress'
            );

            if (!track || !prev || !next) {
                return;
            }

            const cards = Array.from(
                track.querySelectorAll('article')
            );

            const reducedMotion = window.matchMedia(
                '(prefers-reduced-motion: reduce)'
            );

            function getStep() {

                const card = cards[0];

                if (!card) return 320;

                const gap = parseFloat(
                    window.getComputedStyle(track).gap
                ) || 0;

                return card.getBoundingClientRect().width + gap;
            }

            function updateControls() {

                const maxScroll = Math.max(
                    0,
                    track.scrollWidth - track.clientWidth
                );

                prev.disabled = track.scrollLeft <= 2;

                next.disabled =
                    track.scrollLeft >= maxScroll - 2;

                const current = Math.min(
                    cards.length,
                    Math.max(
                        1,
                        Math.round(
                            track.scrollLeft / getStep()
                        ) + 1
                    )
                );

                if (progress) {

                    progress.textContent =
                        String(current).padStart(2, '0') +
                        ' / ' +
                        String(cards.length).padStart(2, '0');
                }
            }

            function move(direction) {

                track.scrollBy({
                    left: direction * getStep(),
                    behavior: reducedMotion.matches
                        ? 'instant'
                        : 'smooth'
                });
            }

            prev.addEventListener('click', function () {
                move(-1);
            });

            next.addEventListener('click', function () {
                move(1);
            });

            track.addEventListener(
                'scroll',
                updateControls,
                { passive: true }
            );

            window.addEventListener(
                'resize',
                updateControls
            );


            /* ==========================================
                DESKTOP MOUSE DRAG
                Mobile uses native touch swipe
            ========================================== */

            let dragging = false;
            let startX = 0;
            let startScroll = 0;

            track.addEventListener(
                'pointerdown',
                function (event) {

                    if (
                        event.pointerType !== 'mouse' ||
                        event.button !== 0
                    ) {
                        return;
                    }

                    dragging = true;

                    startX = event.clientX;
                    startScroll = track.scrollLeft;

                    track.classList.add('is-dragging');
                }
            );

            window.addEventListener(
                'pointermove',
                function (event) {

                    if (!dragging) return;

                    track.scrollLeft =
                        startScroll -
                        (event.clientX - startX);
                }
            );

            function stopDragging() {

                if (!dragging) return;

                dragging = false;

                track.classList.remove(
                    'is-dragging'
                );

                updateControls();
            }

            window.addEventListener(
                'pointerup',
                stopDragging
            );

            window.addEventListener(
                'pointercancel',
                stopDragging
            );

            updateControls();
        }

        if (document.readyState === 'loading') {

            document.addEventListener(
                'DOMContentLoaded',
                initializeKutzTestimonials
            );

        } else {

            initializeKutzTestimonials();
        }

    })();
</script>