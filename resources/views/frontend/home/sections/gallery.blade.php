@php
    $galleryItems = [
        [
            'image' => 'x5.png',
            'title' => 'Signature Bridal Look',
            'category' => 'Bridal Beauty',
        ],
        [
            'image' => 'x6.png',
            'title' => 'Tanya Sharma - Celebrity Glamour & Beauty',
            'category' => 'Actress Styling',
        ],
        [
            'image' => 'x9.png',
            'title' => 'Sana Khan - Celebrity Glam Look',
            'category' => 'Model & Actress Styling',
        ],
        [
            'image' => 'x10.png',
            'title' => 'Shilpa Shinde - Celebrity Makeup Glam',
            'category' => 'Celebrity Makeup & Styling',
        ],
    ];
@endphp

<section id="gallery" aria-labelledby="kutzGalleryTitle"
    class="relative overflow-hidden bg-white px-4 py-16 sm:px-6 sm:py-20 lg:px-8 lg:py-24">
    <div class="mx-auto w-full max-w-7xl">

        {{-- SECTION HEADING --}}
        <div class="mx-auto max-w-3xl text-center">

            <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-brand sm:text-xs">
                — OUR GALLERY —
            </p>

            <h2 id="kutzGalleryTitle"
                class="mt-4 font-heading text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl lg:text-5xl">
                Beauty Through
                <span class="font-serif font-normal italic text-brand">
                    Our Lens
                </span>
            </h2>

            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base">
                Discover beautiful transformations, creative styling
                and unforgettable beauty moments at KUTZZ The Salon.
            </p>

        </div>

        {{-- STAGGERED GALLERY GRID --}}
        <div class="mt-10 grid grid-cols-2 items-start gap-3
                   sm:mt-14 sm:gap-5
                   lg:mt-16 lg:grid-cols-4 lg:gap-6">

            @foreach($galleryItems as $index => $item)

                @php
                    $imageUrl = asset(
                        'assets/images/gallery/' . $item['image']
                    );

                    $offsetClass = match ($index) {
                        0 => 'lg:translate-y-0',
                        1 => 'lg:translate-y-14',
                        2 => 'lg:translate-y-0',
                        3 => 'lg:translate-y-14',
                    };
                @endphp

                {{-- NON-CLICKABLE IMAGE CARD --}}
                <figure class="group relative w-full overflow-hidden
                                       rounded-2xl bg-rose-50 shadow-sm
                                       transition-shadow duration-500
                                       hover:shadow-xl hover:shadow-rose-900/10
                                       sm:rounded-[24px]
                                       {{ $offsetClass }}">

                    <div class="relative aspect-[3/4] w-full overflow-hidden
                                           sm:aspect-[4/5] lg:aspect-[3/4]">

                        {{-- IMAGE --}}
                        <img src="{{ $imageUrl }}" alt="{{ $item['title'] }}" loading="lazy" decoding="async" class="h-full w-full object-cover object-center
                                               transition-transform duration-700
                                               ease-out group-hover:scale-105">

                        {{-- BOTTOM GRADIENT --}}
                        <div class="pointer-events-none absolute inset-0
                                               bg-gradient-to-t
                                               from-black/70 via-black/10
                                               to-transparent
                                               opacity-65 transition-opacity
                                               duration-300
                                               group-hover:opacity-90"></div>

                        {{-- BOTTOM CAPTION --}}
                        <figcaption class="absolute inset-x-0 bottom-0
                                               p-3 sm:p-5">

                            <p class="text-[9px] font-bold uppercase
                                                   tracking-[0.13em] text-rose-200
                                                   sm:text-[10px]">
                                {{ $item['category'] }}
                            </p>

                            <h3 class="mt-1 line-clamp-2
                                                   font-heading text-xs
                                                   font-bold leading-snug text-white
                                                   sm:text-base lg:text-lg">
                                {{ $item['title'] }}
                            </h3>

                        </figcaption>

                    </div>

                </figure>

            @endforeach

        </div>

        {{-- VIEW ALL GALLERY BUTTON --}}
        @if(\Illuminate\Support\Facades\Route::has('gallery.index'))

            <div class="mt-10 text-center sm:mt-12 lg:mt-24">

                <a href="{{ route('gallery.index') }}" class="group inline-flex min-h-12
                                       items-center justify-center gap-3
                                       rounded-xl bg-brand px-8 py-3
                                       text-xs font-bold uppercase
                                       tracking-[0.06em] text-white
                                       shadow-lg shadow-red-600/15
                                       transition duration-300
                                       hover:-translate-y-0.5
                                       hover:bg-brand-dark
                                       hover:shadow-xl
                                       sm:text-sm">
                    EXPLORE FULL GALLERY

                    <span class="text-lg leading-none
                                           transition-transform duration-300
                                           group-hover:translate-x-1" aria-hidden="true">
                        →
                    </span>

                </a>

            </div>

        @endif

    </div>
</section>



{{-- ==========================================
FULLSCREEN IMAGE LIGHTBOX
=========================================== --}}
<div id="kutzGalleryLightbox" class="fixed inset-0 z-[9999] hidden items-center
           justify-center bg-black/95 p-4" role="dialog" aria-modal="true" aria-label="Gallery image viewer"
    aria-hidden="true" tabindex="-1">
    {{-- CLOSE --}}
    <button id="kutzGalleryClose" type="button" aria-label="Close gallery" class="absolute right-4 top-4 z-20
               flex h-11 w-11 items-center
               justify-center rounded-full
               bg-white/15 text-white
               transition hover:bg-white/25">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round">
            <path d="M18 6 6 18M6 6l12 12" />
        </svg>
    </button>

    {{-- PREVIOUS --}}
    <button id="kutzGalleryPrev" type="button" aria-label="Previous photograph" class="absolute left-2 top-1/2 z-20
               flex h-10 w-10 -translate-y-1/2
               items-center justify-center rounded-full
               bg-white/15 text-white
               transition hover:bg-white/25
               sm:left-6 sm:h-12 sm:w-12">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="m15 18-6-6 6-6" />
        </svg>
    </button>

    {{-- ACTIVE IMAGE --}}
    <div class="mx-auto w-full max-w-5xl px-10 text-center sm:px-16">

        <img id="kutzGalleryActiveImage" alt="" class="mx-auto max-h-[75dvh] max-w-full
                   rounded-lg object-contain">

        <p id="kutzGalleryActiveTitle" class="mt-4 font-heading text-sm
                   font-semibold text-white sm:text-base"></p>

        <p id="kutzGalleryCounter" class="mt-1 text-xs text-white/60"></p>

    </div>

    {{-- NEXT --}}
    <button id="kutzGalleryNext" type="button" aria-label="Next photograph" class="absolute right-2 top-1/2 z-20
               flex h-10 w-10 -translate-y-1/2
               items-center justify-center rounded-full
               bg-white/15 text-white
               transition hover:bg-white/25
               sm:right-6 sm:h-12 sm:w-12">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="m9 18 6-6-6-6" />
        </svg>
    </button>

</div>


{{-- ==========================================
LIGHTBOX JAVASCRIPT
=========================================== --}}
<script>
    (function () {

        function initKutzGallery() {

            const lightbox = document.getElementById(
                'kutzGalleryLightbox'
            );

            if (!lightbox || lightbox.dataset.initialized === 'true') {
                return;
            }

            lightbox.dataset.initialized = 'true';

            const cards = Array.from(
                document.querySelectorAll('.kutz-gallery-card')
            );

            const image = document.getElementById(
                'kutzGalleryActiveImage'
            );

            const title = document.getElementById(
                'kutzGalleryActiveTitle'
            );

            const counter = document.getElementById(
                'kutzGalleryCounter'
            );

            const close = document.getElementById(
                'kutzGalleryClose'
            );

            const prev = document.getElementById(
                'kutzGalleryPrev'
            );

            const next = document.getElementById(
                'kutzGalleryNext'
            );

            if (!cards.length) return;

            let current = 0;
            let previousFocus = null;
            let previousOverflow = '';

            function show(index) {

                current = (index + cards.length) % cards.length;

                const card = cards[current];

                image.src = card.dataset.galleryImage;
                image.alt = card.dataset.galleryTitle;

                title.textContent = card.dataset.galleryTitle;

                counter.textContent =
                    (current + 1) + ' / ' + cards.length;

            }

            function open(index) {

                previousFocus = document.activeElement;
                previousOverflow = document.body.style.overflow;

                show(index);

                lightbox.classList.remove('hidden');
                lightbox.classList.add('flex');

                lightbox.setAttribute('aria-hidden', 'false');

                document.body.style.overflow = 'hidden';

                close.focus();

            }

            function hide() {

                lightbox.classList.add('hidden');
                lightbox.classList.remove('flex');

                lightbox.setAttribute('aria-hidden', 'true');

                document.body.style.overflow = previousOverflow;

                image.removeAttribute('src');

                if (previousFocus &&
                    typeof previousFocus.focus === 'function') {
                    previousFocus.focus();
                }

            }

            cards.forEach(function (card, index) {

                card.addEventListener('click', function () {
                    open(index);
                });

            });

            close.addEventListener('click', hide);

            prev.addEventListener('click', function () {
                show(current - 1);
            });

            next.addEventListener('click', function () {
                show(current + 1);
            });

            lightbox.addEventListener('click', function (event) {

                if (event.target === lightbox) {
                    hide();
                }

            });

            document.addEventListener('keydown', function (event) {

                if (lightbox.classList.contains('hidden')) {
                    return;
                }

                if (event.key === 'Escape') {
                    hide();
                }

                if (event.key === 'ArrowLeft') {
                    show(current - 1);
                }

                if (event.key === 'ArrowRight') {
                    show(current + 1);
                }

                if (event.key === 'Tab') {

                    const focusable = [close, prev, next];

                    const first = focusable[0];
                    const last = focusable[focusable.length - 1];

                    if (
                        event.shiftKey &&
                        document.activeElement === first
                    ) {
                        event.preventDefault();
                        last.focus();
                    } else if (
                        !event.shiftKey &&
                        document.activeElement === last
                    ) {
                        event.preventDefault();
                        first.focus();
                    }

                }

            });

        }

        if (document.readyState === 'loading') {
            document.addEventListener(
                'DOMContentLoaded',
                initKutzGallery
            );
        } else {
            initKutzGallery();
        }

    })();
</script>