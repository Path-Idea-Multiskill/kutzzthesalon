<!-- 
@php
    

    $baseVideos = [
        ['file' => 'insta1.mp4', 'title' => 'Salon Highlights'],
        ['file' => 'insta2.mp4', 'title' => 'Bridal Looks'],
        ['file' => 'insta3.mp4', 'title' => 'Beauty Transformations'],
        ['file' => 'insta4.mp4', 'title' => 'Makeup Artistry'],
        ['file' => 'insta5.mp4', 'title' => 'Hair Styling'],
        ['file' => 'insta6.mp4', 'title' => 'Glamour Moments'],
        ['file' => 'insta7.mp4', 'title' => 'KUTZ Beauty Stories'],
    ];

    $videoCards = [];

    for ($repeat = 0; $repeat < 4; $repeat++) {
        foreach ($baseVideos as $video) {
            $videoCards[] = [
                'src' => asset('assets/video/' . $video['file']),
                'title' => $video['title'],
            ];
        }
    }
@endphp -->

<section id="videos" class="relative overflow-hidden bg-brand-light py-14 sm:py-16 lg:py-20"
    aria-labelledby="kutzVideosHeading">
    <div class="mx-auto max-w-7xl">

        {{-- SECTION HEADING --}}
        <div class="px-4 text-center sm:px-6 lg:px-8">

            <p class="text-xs font-bold uppercase tracking-[0.25em] text-brand">
                — OUR WORK —
            </p>

            <h2 id="kutzVideosHeading"
                class="mt-3 font-heading text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl lg:text-[42px]">
                See Our <span class="text-brand">Work</span>
            </h2>

            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base">
                Explore beautiful moments, stunning transformations
                and creative styling from KUTZ Salon.
            </p>

        </div>

        {{-- CAROUSEL HEADER --}}
        <div class="mt-9 flex items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">

            <div>
                <h3 class="font-heading text-base font-bold text-slate-950 sm:text-lg">
                    Beauty in Motion
                </h3>

                <p class="mt-1 text-xs text-slate-500">
                    Explore our video highlights
                </p>
            </div>

            {{-- DESKTOP/TABLET NAVIGATION --}}
            <div class="hidden items-center gap-2 sm:flex">

                <button type="button" id="kutzVideoPrev" aria-label="Scroll videos left" aria-controls="kutzVideoTrack"
                    class="flex h-11 w-11 items-center justify-center rounded-full border border-rose-200 bg-white text-slate-700 shadow-sm transition hover:border-brand hover:text-brand disabled:cursor-not-allowed disabled:opacity-35">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6" />
                    </svg>
                </button>

                <button type="button" id="kutzVideoNext" aria-label="Scroll videos right" aria-controls="kutzVideoTrack"
                    class="flex h-11 w-11 items-center justify-center rounded-full bg-brand text-white shadow-md transition hover:bg-brand-dark disabled:cursor-not-allowed disabled:opacity-35">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </button>

            </div>

        </div>

        {{-- VIDEO CAROUSEL --}}
        <!-- <div
            id="kutzVideoTrack"
            class="kutz-video-track mt-5 flex snap-x snap-mandatory gap-3 overflow-x-auto overscroll-x-contain px-4 pb-5 sm:gap-4 sm:px-6 lg:gap-5 lg:px-8"
            aria-label="KUTZ Salon video carousel"
            tabindex="0"
        >

            @foreach($videoCards as $index => $video)

                <button
                    type="button"
                    data-kutz-video-card
                    data-video-index="{{ $index }}"
                    aria-label="Play {{ $video['title'] }} video {{ $index + 1 }}"
                    class="kutz-video-card group relative block w-[43vw] min-w-[43vw] max-w-[210px] shrink-0 snap-start overflow-hidden rounded-2xl bg-slate-900 text-left shadow-sm transition-[box-shadow,transform] duration-300 hover:-translate-y-1 hover:shadow-xl focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand sm:w-[220px] sm:min-w-[220px] sm:max-w-none lg:w-[245px] lg:min-w-[245px]"
                >

                    <div class="relative aspect-[9/16] overflow-hidden">

                        
                        <video
                            class="kutz-video-preview pointer-events-none absolute inset-0 h-full w-full object-cover"
                            preload="none"
                            muted
                            playsinline
                            disablepictureinpicture
                            aria-hidden="true"
                            data-video-src="{{ $video['src'] }}"
                        ></video>

                        
                        <div
                            class="pointer-events-none absolute inset-0 -z-10 bg-gradient-to-br from-rose-300 via-rose-500 to-slate-900"
                        ></div>

                        
                        <div
                            class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/75 via-black/5 to-black/10"
                        ></div>

                        
                        <span
                            class="absolute left-3 top-3 inline-flex items-center gap-1.5 rounded-full border border-white/30 bg-black/30 px-2.5 py-1 text-[10px] font-semibold text-white backdrop-blur-md"
                        >
                            <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>
                            REEL
                        </span>

                        
                        <span
                            class="absolute left-1/2 top-1/2 flex h-14 w-14 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full border-2 border-white bg-black/25 text-white shadow-lg backdrop-blur-sm transition duration-300 group-hover:scale-110 group-hover:bg-brand sm:h-16 sm:w-16"
                            aria-hidden="true"
                        >
                            <svg
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                class="ml-1"
                            >
                                <path d="M8 5.5v13l10-6.5z"/>
                            </svg>
                        </span>

                        
                        <div class="absolute inset-x-0 bottom-0 p-3 sm:p-4">

                            <p class="mb-1 text-[10px] font-semibold uppercase tracking-[0.16em] text-rose-200">
                                KUTZ THE SALON
                            </p>

                            <h3 class="line-clamp-2 font-heading text-sm font-bold leading-5 text-white sm:text-base">
                                {{ $video['title'] }}
                            </h3>

                            <p class="mt-1 text-[11px] text-white/75">
                                Tap to watch
                            </p>

                        </div>

                    </div>

                </button>

            @endforeach

        </div> -->


        {{-- VIDEO CAROUSEL --}}
        <div id="kutzVideoTrack"
            class="kutz-video-track mt-5 flex snap-x snap-mandatory gap-3 overflow-x-auto overscroll-x-contain px-4 pb-5 sm:gap-4 sm:px-6 lg:gap-5 lg:px-8"
            aria-label="KUTZ Salon video carousel" tabindex="0">

            @forelse(($videos ?? collect()) as $index => $video)

                <button type="button" data-kutz-video-card data-video-index="{{ $index }}"
                    data-video-url="{{ $video->embed_url }}" data-video-platform="{{ $video->platform }}"
                    data-video-title="{{ $video->title }}" aria-label="Play {{ $video->title }}"
                    class="kutz-video-card group relative block w-[43vw] min-w-[43vw] max-w-[210px] shrink-0 snap-start overflow-hidden rounded-2xl bg-slate-900 text-left shadow-sm transition-[box-shadow,transform] duration-300 hover:-translate-y-1 hover:shadow-xl focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand sm:w-[220px] sm:min-w-[220px] sm:max-w-none lg:w-[245px] lg:min-w-[245px]">

                    <div class="relative aspect-[9/16] overflow-hidden">

                        {{-- DYNAMIC THUMBNAIL --}}
                        <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}" loading="lazy"
                            decoding="async"
                            class="pointer-events-none absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105">

                        {{-- FALLBACK BACKGROUND --}}
                        <div
                            class="pointer-events-none absolute inset-0 -z-10 bg-gradient-to-br from-rose-300 via-rose-500 to-slate-900">
                        </div>

                        {{-- SUBTLE DARK OVERLAY --}}
                        <div
                            class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/75 via-black/5 to-black/10">
                        </div>

                        {{-- VIDEO LABEL --}}
                        <span
                            class="absolute left-3 top-3 inline-flex items-center gap-1.5 rounded-full border border-white/30 bg-black/30 px-2.5 py-1 text-[10px] font-semibold text-white backdrop-blur-md">
                            <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>
                            REEL
                        </span>

                        {{-- PLAY ICON --}}
                        <span
                            class="absolute left-1/2 top-1/2 flex h-14 w-14 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full border-2 border-white bg-black/25 text-white shadow-lg backdrop-blur-sm transition duration-300 group-hover:scale-110 group-hover:bg-brand sm:h-16 sm:w-16"
                            aria-hidden="true">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="ml-1">
                                <path d="M8 5.5v13l10-6.5z" />
                            </svg>
                        </span>

                        {{-- BOTTOM CONTENT --}}
                        <div class="absolute inset-x-0 bottom-0 p-3 sm:p-4">

                            <p class="mb-1 text-[10px] font-semibold uppercase tracking-[0.16em] text-rose-200">
                                KUTZ THE SALON
                            </p>

                            <h3 class="line-clamp-2 font-heading text-sm font-bold leading-5 text-white sm:text-base">
                                {{ $video->title }}
                            </h3>

                            <p class="mt-1 text-[11px] text-white/75">
                                Tap to watch
                            </p>

                        </div>

                    </div>

                </button>

            @empty

                <div class="w-full py-12 text-center">
                    <p class="text-sm font-medium text-slate-500">
                        New video highlights coming soon.
                    </p>
                </div>

            @endforelse

        </div>


        {{-- MOBILE SWIPE HINT --}}
        <!-- <div class="mt-1 flex items-center justify-center gap-2 text-xs text-slate-500 sm:hidden">
            <span aria-hidden="true">←</span>
            Swipe to explore
            <span aria-hidden="true">→</span>
        </div> -->

    </div>
</section>


{{-- =====================================================
VIDEO VIEWER / LIGHTBOX
===================================================== --}}

<div id="kutzVideoModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/95 p-3 sm:p-6"
    role="dialog" aria-modal="true" aria-label="KUTZ Salon video player" aria-hidden="true" tabindex="-1">

    {{-- CLOSE --}}
    <button type="button" id="kutzVideoClose" aria-label="Close video player"
        class="absolute right-4 top-4 z-30 flex h-11 w-11 items-center justify-center rounded-full border border-white/20 bg-white/15 text-white backdrop-blur-md transition hover:bg-white/25 sm:right-8 sm:top-6">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round">
            <path d="M18 6 6 18M6 6l12 12" />
        </svg>
    </button>

    {{-- VIEWER BODY --}}
    <div class="relative flex h-full w-full max-w-5xl items-center justify-center gap-3">

        {{-- PREVIOUS VIDEO --}}
        <button type="button" id="kutzVideoModalPrev" aria-label="Previous video"
            class="hidden h-12 w-12 shrink-0 items-center justify-center rounded-full border border-white/20 bg-white/10 text-white transition hover:bg-white/20 sm:flex">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </button>

        {{-- VIDEO PLAYER CONTAINER --}}
        <div class="flex h-full min-w-0 flex-1 flex-col items-center justify-center">

            <div class="relative flex min-h-0 w-full flex-1 items-center justify-center">

                <!-- <video id="kutzActiveVideo"
                    class="block max-h-[78dvh] max-w-full rounded-xl bg-black object-contain sm:max-h-[82dvh]" controls
                    playsinline preload="none" controlslist="nodownload"></video> -->

                {{-- YOUTUBE / INSTAGRAM EMBED PLAYER --}}
                <iframe id="kutzActiveVideo"
                    class="hidden aspect-[9/16] w-full max-w-[420px] max-h-[78dvh] rounded-xl border-0 bg-black sm:max-h-[82dvh]"
                    title="KUTZ Salon video player" loading="lazy"
                    allow="autoplay; encrypted-media; picture-in-picture; fullscreen" allowfullscreen
                    referrerpolicy="strict-origin-when-cross-origin"></iframe>

            </div>

            {{-- VIDEO TITLE --}}
            <div class="w-full max-w-[420px] py-3 text-center">

                <h3 id="kutzActiveVideoTitle" class="font-heading text-sm font-bold text-white sm:text-base"></h3>

                <p id="kutzActiveVideoCounter" class="mt-1 text-xs text-white/55"></p>

            </div>

            {{-- MOBILE NAVIGATION --}}
            <div class="flex items-center justify-center gap-5 pb-2 sm:hidden">

                <button type="button" id="kutzVideoMobilePrev" aria-label="Previous video"
                    class="flex h-11 w-11 items-center justify-center rounded-full border border-white/25 bg-white/10 text-white">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6" />
                    </svg>
                </button>

                <span class="text-xs text-white/65">Browse videos</span>

                <button type="button" id="kutzVideoMobileNext" aria-label="Next video"
                    class="flex h-11 w-11 items-center justify-center rounded-full border border-white/25 bg-white/10 text-white">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </button>

            </div>

        </div>

        {{-- NEXT VIDEO --}}
        <button type="button" id="kutzVideoModalNext" aria-label="Next video"
            class="hidden h-12 w-12 shrink-0 items-center justify-center rounded-full border border-white/20 bg-white/10 text-white transition hover:bg-white/20 sm:flex">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
            </svg>
        </button>

    </div>

</div>


{{-- =====================================================
CAROUSEL CSS
===================================================== --}}

<style>
    .kutz-video-track {
        scrollbar-width: none;
        -ms-overflow-style: none;
        scroll-behavior: smooth;
        touch-action: pan-x pan-y;
        cursor: grab;
        user-select: none;
        -webkit-user-select: none;
    }

    .kutz-video-track::-webkit-scrollbar {
        display: none;
        width: 0;
        height: 0;
    }

    .kutz-video-track.is-dragging {
        cursor: grabbing;
        scroll-behavior: auto;
        scroll-snap-type: none;
    }

    .kutz-video-track.is-dragging * {
        pointer-events: none;
    }

    .kutz-video-preview {
        background: linear-gradient(135deg,
                #f9cbd3 0%,
                #d60927 55%,
                #171717 100%);
    }

    body.kutz-video-modal-open {
        overflow: hidden;
    }

    @media (prefers-reduced-motion: reduce) {
        .kutz-video-track {
            scroll-behavior: auto;
        }
    }
</style>


{{-- =====================================================
VIDEO CAROUSEL + FULLSCREEN VIEWER JAVASCRIPT
===================================================== --}}

<!-- <script>
    (function () {

        function initKutzVideos() {

            const track = document.getElementById('kutzVideoTrack');
            const prevButton = document.getElementById('kutzVideoPrev');
            const nextButton = document.getElementById('kutzVideoNext');

            const modal = document.getElementById('kutzVideoModal');
            const closeButton = document.getElementById('kutzVideoClose');

            const player = document.getElementById('kutzActiveVideo');
            const videoTitle = document.getElementById('kutzActiveVideoTitle');
            const videoCounter = document.getElementById('kutzActiveVideoCounter');

            const modalPrev = document.getElementById('kutzVideoModalPrev');
            const modalNext = document.getElementById('kutzVideoModalNext');

            const mobilePrev = document.getElementById('kutzVideoMobilePrev');
            const mobileNext = document.getElementById('kutzVideoMobileNext');

            if (!track || !modal || !player) {
                return;
            }

            if (track.dataset.initialized === 'true') {
                return;
            }

            track.dataset.initialized = 'true';

            const cards = Array.from(
                track.querySelectorAll('[data-kutz-video-card]')
            );

            if (!cards.length) {
                return;
            }

            const videos = cards.map(function (card) {

                const preview = card.querySelector('video');

                return {
                    src: preview.dataset.videoSrc,
                    title: card.querySelector('h3').textContent.trim()
                };

            });

            let activeIndex = 0;
            let lastFocusedElement = null;

            /*
            |--------------------------------------------------------------------------
            | VIDEO THUMBNAILS
            |--------------------------------------------------------------------------
            | Load the first frame only for visible cards.
            | No video autoplay in the carousel.
            */

            function loadPreview(preview) {

                if (!preview || preview.dataset.loaded === 'true') {
                    return;
                }

                preview.dataset.loaded = 'true';
                preview.src = preview.dataset.videoSrc;
                preview.preload = 'metadata';

                preview.addEventListener('loadedmetadata', function () {

                    if (preview.duration && preview.duration > 0.1) {

                        try {
                            preview.currentTime = Math.min(
                                0.15,
                                preview.duration / 2
                            );
                        } catch (error) {
                            // Some videos cannot seek immediately.
                        }

                    }

                }, { once: true });

                preview.load();

            }

            if ('IntersectionObserver' in window) {

                const previewObserver = new IntersectionObserver(
                    function (entries, observer) {

                        entries.forEach(function (entry) {

                            if (!entry.isIntersecting) {
                                return;
                            }

                            loadPreview(entry.target);
                            observer.unobserve(entry.target);

                        });

                    },
                    {
                        root: track,
                        rootMargin: '0px 180px',
                        threshold: 0.01
                    }
                );

                track.querySelectorAll('.kutz-video-preview')
                    .forEach(function (preview) {
                        previewObserver.observe(preview);
                    });

            } else {

                track.querySelectorAll('.kutz-video-preview')
                    .forEach(loadPreview);

            }

            /*
            |--------------------------------------------------------------------------
            | CAROUSEL PREVIOUS / NEXT
            */

            function getScrollAmount() {

                const card = cards[0];

                if (!card) {
                    return 240;
                }

                const styles = window.getComputedStyle(track);
                const gap = parseFloat(styles.columnGap) || 0;

                return card.getBoundingClientRect().width + gap;

            }

            function updateButtons() {

                const maxScroll = Math.max(
                    0,
                    track.scrollWidth - track.clientWidth
                );

                if (prevButton) {
                    prevButton.disabled = track.scrollLeft <= 2;
                }

                if (nextButton) {
                    nextButton.disabled =
                        track.scrollLeft >= maxScroll - 2;
                }

            }

            if (prevButton) {

                prevButton.addEventListener('click', function () {

                    track.scrollBy({
                        left: -getScrollAmount(),
                        behavior: 'smooth'
                    });

                });

            }

            if (nextButton) {

                nextButton.addEventListener('click', function () {

                    track.scrollBy({
                        left: getScrollAmount(),
                        behavior: 'smooth'
                    });

                });

            }

            track.addEventListener(
                'scroll',
                updateButtons,
                { passive: true }
            );

            window.addEventListener('resize', updateButtons);

            updateButtons();

            /*
            |--------------------------------------------------------------------------
            | MOUSE DRAG TO SCROLL
            |--------------------------------------------------------------------------
            | Touch devices use native swipe scrolling.
            */

            let pointerDown = false;
            let startX = 0;
            let startScrollLeft = 0;
            let dragMoved = false;
            let suppressClick = false;

            track.addEventListener('pointerdown', function (event) {

                if (event.pointerType !== 'mouse' || event.button !== 0) {
                    return;
                }

                pointerDown = true;
                dragMoved = false;

                startX = event.clientX;
                startScrollLeft = track.scrollLeft;

            });

            window.addEventListener('pointermove', function (event) {

                if (!pointerDown) {
                    return;
                }

                const distance = event.clientX - startX;

                if (Math.abs(distance) > 6) {
                    dragMoved = true;
                    suppressClick = true;
                    track.classList.add('is-dragging');
                }

                if (dragMoved) {
                    track.scrollLeft = startScrollLeft - distance;
                }

            });

            function finishDrag() {

                if (!pointerDown) {
                    return;
                }

                pointerDown = false;
                track.classList.remove('is-dragging');

                if (dragMoved) {
                    window.setTimeout(function () {
                        suppressClick = false;
                    }, 100);
                }

            }

            window.addEventListener('pointerup', finishDrag);
            window.addEventListener('pointercancel', finishDrag);

            /*
            |--------------------------------------------------------------------------
            | VIDEO VIEWER
            */

            function showVideo(index) {

                activeIndex = (
                    index + videos.length
                ) % videos.length;

                const selected = videos[activeIndex];

                player.pause();
                player.removeAttribute('src');
                player.load();

                player.src = selected.src;
                player.load();

                videoTitle.textContent = selected.title;
                videoCounter.textContent =
                    (activeIndex + 1) + ' / ' + videos.length;

                const playPromise = player.play();

                if (playPromise && typeof playPromise.catch === 'function') {
                    playPromise.catch(function () {
                        // Browser may require the visitor to press Play.
                    });
                }

            }

            function openVideo(index) {

                lastFocusedElement = document.activeElement;

                modal.classList.remove('hidden');
                modal.classList.add('flex');
                modal.setAttribute('aria-hidden', 'false');

                document.body.classList.add('kutz-video-modal-open');

                showVideo(index);

                closeButton.focus();

            }

            function closeVideo() {

                if (modal.classList.contains('hidden')) {
                    return;
                }

                player.pause();
                player.removeAttribute('src');
                player.load();

                modal.classList.add('hidden');
                modal.classList.remove('flex');
                modal.setAttribute('aria-hidden', 'true');

                document.body.classList.remove('kutz-video-modal-open');

                if (lastFocusedElement &&
                    typeof lastFocusedElement.focus === 'function') {
                    lastFocusedElement.focus();
                }

            }

            cards.forEach(function (card, index) {

                card.addEventListener('click', function (event) {

                    if (suppressClick) {
                        event.preventDefault();
                        return;
                    }

                    openVideo(index);

                });

            });

            closeButton.addEventListener('click', closeVideo);

            modal.addEventListener('click', function (event) {

                if (event.target === modal) {
                    closeVideo();
                }

            });

            function previousVideo() {
                showVideo(activeIndex - 1);
            }

            function nextVideo() {
                showVideo(activeIndex + 1);
            }

            [modalPrev, mobilePrev].forEach(function (button) {

                if (button) {
                    button.addEventListener('click', previousVideo);
                }

            });

            [modalNext, mobileNext].forEach(function (button) {

                if (button) {
                    button.addEventListener('click', nextVideo);
                }

            });

            /*
            |--------------------------------------------------------------------------
            | KEYBOARD SUPPORT
            */

            document.addEventListener('keydown', function (event) {

                if (modal.classList.contains('hidden')) {
                    return;
                }

                if (event.key === 'Escape') {
                    closeVideo();
                }

                if (event.key === 'ArrowRight') {
                    nextVideo();
                }

                if (event.key === 'ArrowLeft') {
                    previousVideo();
                }

                if (event.key === 'Tab') {

                    const focusable = Array.from(
                        modal.querySelectorAll(
                            'button:not([disabled]), video[controls]'
                        )
                    ).filter(function (element) {
                        return element.getClientRects().length > 0;
                    });

                    if (!focusable.length) {
                        event.preventDefault();
                        return;
                    }

                    const first = focusable[0];
                    const last = focusable[focusable.length - 1];

                    if (event.shiftKey &&
                        document.activeElement === first) {
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

            /*
            |--------------------------------------------------------------------------
            | PAUSE VIDEO WHEN BROWSER TAB IS HIDDEN
            */

            document.addEventListener('visibilitychange', function () {

                if (document.hidden && !modal.classList.contains('hidden')) {
                    player.pause();
                }

            });

        }

        if (document.readyState === 'loading') {

            document.addEventListener(
                'DOMContentLoaded',
                initKutzVideos
            );

        } else {

            initKutzVideos();

        }

    })();
</script> -->



<script>
    (function () {
        function initKutzVideos() {

            const track = document.getElementById('kutzVideoTrack');
            const modal = document.getElementById('kutzVideoModal');
            const player = document.getElementById('kutzActiveVideo');

            if (!track || !modal || !player) return;
            if (track.dataset.initialized === 'true') return;

            track.dataset.initialized = 'true';

            const cards = Array.from(
                track.querySelectorAll('[data-kutz-video-card]')
            );

            const videos = cards.map(card => ({
                url: card.dataset.videoUrl,
                title: card.dataset.videoTitle,
                platform: card.dataset.videoPlatform
            }));

            const prevButton = document.getElementById('kutzVideoPrev');
            const nextButton = document.getElementById('kutzVideoNext');

            const closeButton = document.getElementById('kutzVideoClose');
            const modalPrev = document.getElementById('kutzVideoModalPrev');
            const modalNext = document.getElementById('kutzVideoModalNext');
            const mobilePrev = document.getElementById('kutzVideoMobilePrev');
            const mobileNext = document.getElementById('kutzVideoMobileNext');

            const title = document.getElementById('kutzActiveVideoTitle');
            const counter = document.getElementById('kutzActiveVideoCounter');

            let activeIndex = 0;
            let lastFocusedElement = null;

            // CAROUSEL SCROLL
            function scrollAmount() {
                const card = cards[0];
                if (!card) return 240;

                const gap = parseFloat(
                    window.getComputedStyle(track).columnGap
                ) || 0;

                return card.getBoundingClientRect().width + gap;
            }

            function updateScrollButtons() {
                const maxScroll = Math.max(
                    0,
                    track.scrollWidth - track.clientWidth
                );

                if (prevButton) {
                    prevButton.disabled = track.scrollLeft <= 2;
                }

                if (nextButton) {
                    nextButton.disabled =
                        track.scrollLeft >= maxScroll - 2;
                }
            }

            prevButton?.addEventListener('click', () => {
                track.scrollBy({
                    left: -scrollAmount(),
                    behavior: 'smooth'
                });
            });

            nextButton?.addEventListener('click', () => {
                track.scrollBy({
                    left: scrollAmount(),
                    behavior: 'smooth'
                });
            });

            track.addEventListener(
                'scroll',
                updateScrollButtons,
                { passive: true }
            );

            window.addEventListener('resize', updateScrollButtons);
            updateScrollButtons();

            // MOUSE DRAG SUPPORT
            let pointerDown = false;
            let dragMoved = false;
            let suppressClick = false;
            let startX = 0;
            let startScrollLeft = 0;

            track.addEventListener('pointerdown', event => {
                if (
                    event.pointerType !== 'mouse' ||
                    event.button !== 0
                ) return;

                pointerDown = true;
                dragMoved = false;
                startX = event.clientX;
                startScrollLeft = track.scrollLeft;
            });

            window.addEventListener('pointermove', event => {
                if (!pointerDown) return;

                const distance = event.clientX - startX;

                if (Math.abs(distance) > 6) {
                    dragMoved = true;
                    suppressClick = true;
                    track.classList.add('is-dragging');
                }

                if (dragMoved) {
                    track.scrollLeft =
                        startScrollLeft - distance;
                }
            });

            function finishDrag() {
                if (!pointerDown) return;

                pointerDown = false;
                track.classList.remove('is-dragging');

                if (dragMoved) {
                    window.setTimeout(() => {
                        suppressClick = false;
                    }, 100);
                }
            }

            window.addEventListener('pointerup', finishDrag);
            window.addEventListener('pointercancel', finishDrag);

            // STOP CURRENT VIDEO
            function stopVideo() {
                player.removeAttribute('src');
                player.classList.add('hidden');
            }

            // LOAD SELECTED VIDEO
            function showVideo(index) {
                if (!videos.length) return;

                activeIndex = (
                    index + videos.length
                ) % videos.length;

                const selected = videos[activeIndex];

                stopVideo();

                let embedUrl;

                try {
                    embedUrl = new URL(selected.url);

                    const allowedHosts = {
                        youtube: 'www.youtube-nocookie.com',
                        instagram: 'www.instagram.com'
                    };

                    if (
                        embedUrl.protocol !== 'https:' ||
                        embedUrl.hostname !==
                        allowedHosts[selected.platform]
                    ) {
                        return;
                    }
                } catch (error) {
                    return;
                }

                if (selected.platform === 'youtube') {
                    embedUrl.searchParams.set('autoplay', '1');
                    embedUrl.searchParams.set('rel', '0');
                }

                player.src = embedUrl.toString();
                player.title = selected.title;
                player.classList.remove('hidden');

                title.textContent = selected.title;
                counter.textContent =
                    (activeIndex + 1) + ' / ' + videos.length;
            }

            // OPEN MODAL
            function openVideo(index) {
                if (!videos.length) return;

                lastFocusedElement = document.activeElement;

                modal.classList.remove('hidden');
                modal.classList.add('flex');
                modal.setAttribute('aria-hidden', 'false');

                document.body.classList.add(
                    'kutz-video-modal-open'
                );

                showVideo(index);

                closeButton?.focus();
            }

            // CLOSE MODAL
            function closeVideo() {
                if (modal.classList.contains('hidden')) return;

                stopVideo();

                modal.classList.add('hidden');
                modal.classList.remove('flex');
                modal.setAttribute('aria-hidden', 'true');

                document.body.classList.remove(
                    'kutz-video-modal-open'
                );

                lastFocusedElement?.focus?.();
            }

            // CARD CLICK
            cards.forEach((card, index) => {
                card.addEventListener('click', event => {
                    if (suppressClick) {
                        event.preventDefault();
                        return;
                    }

                    openVideo(index);
                });
            });

            // CLOSE BUTTON
            closeButton?.addEventListener('click', closeVideo);

            // CLICK OUTSIDE TO CLOSE
            modal.addEventListener('click', event => {
                if (event.target === modal) {
                    closeVideo();
                }
            });

            // PREVIOUS / NEXT
            function previousVideo() {
                showVideo(activeIndex - 1);
            }

            function nextVideo() {
                showVideo(activeIndex + 1);
            }

            [modalPrev, mobilePrev].forEach(button => {
                button?.addEventListener('click', previousVideo);
            });

            [modalNext, mobileNext].forEach(button => {
                button?.addEventListener('click', nextVideo);
            });

            // KEYBOARD SUPPORT
            document.addEventListener('keydown', event => {
                if (modal.classList.contains('hidden')) return;

                if (event.key === 'Escape') {
                    closeVideo();
                }

                if (event.key === 'ArrowLeft') {
                    previousVideo();
                }

                if (event.key === 'ArrowRight') {
                    nextVideo();
                }

                if (event.key === 'Tab') {
                    const focusable = Array.from(
                        modal.querySelectorAll(
                            'button:not([disabled]), iframe'
                        )
                    ).filter(element => {
                        return element.getClientRects().length > 0;
                    });

                    if (!focusable.length) return;

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

            // CLOSE WHEN TAB BECOMES HIDDEN
            document.addEventListener(
                'visibilitychange',
                () => {
                    if (document.hidden) {
                        closeVideo();
                    }
                }
            );
        }

        if (document.readyState === 'loading') {
            document.addEventListener(
                'DOMContentLoaded',
                initKutzVideos
            );
        } else {
            initKutzVideos();
        }
    })();
</script>