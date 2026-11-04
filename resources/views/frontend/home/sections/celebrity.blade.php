
{{-- =========================================================
    KUTZZ SALON — CELEBRITY MAKEOVER SHOWCASE
    Light Pink Theme | Modern Responsive UI
    Dynamic Laravel Videos
    Only Celebrity = Yes and Active videos
========================================================= --}}

@php
    $celebrityItems = $celebrityVideos ?? collect();
@endphp

@if($celebrityItems->isNotEmpty())

<section
    id="kutz-celebrity"
    class="relative overflow-hidden bg-brand-light py-14 sm:py-16 lg:py-20"
    aria-labelledby="kutzCelebrityHeading"
>

    <div class="relative mx-auto max-w-7xl">

        {{-- SECTION HEADING --}}
        <div class="px-4 text-center sm:px-6 lg:px-8">

            <p class="text-xs font-bold uppercase tracking-[0.25em] text-brand">
                — CELEBRITY DIARIES —
            </p>

            <h2
                id="kutzCelebrityHeading"
                class="mt-3 font-heading text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl lg:text-[42px]"
            >
                Celebrity
                <span class="text-brand">
                    Makeovers
                </span>
            </h2>

            <p
                class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base"
            >
                Discover celebrity beauty looks, stunning transformations
                and memorable makeover moments by KUTZZ Salon & Academy.
            </p>

        </div>

        {{-- CAROUSEL HEADER --}}
        <div
            class="mt-9 flex items-center justify-between gap-4 px-4 sm:px-6 lg:px-8"
        >

            <div class="min-w-0">

                <h3
                    class="font-heading text-base font-bold text-slate-950 sm:text-lg"
                >
                    Our Celebrity Work
                </h3>

                <p class="mt-1 text-xs text-slate-500">
                    Explore our celebrity makeover highlights
                </p>

            </div>

            {{-- NAVIGATION BUTTONS --}}
            <div class="hidden shrink-0 items-center gap-2 sm:flex">

                <button
                    type="button"
                    id="kutzCelebrityPrev"
                    aria-label="Previous celebrity videos"
                    aria-controls="kutzCelebrityTrack"
                    class="flex h-11 w-11 items-center justify-center rounded-full border border-rose-200 bg-white text-slate-700 shadow-sm transition hover:border-brand hover:text-brand disabled:cursor-not-allowed disabled:opacity-35"
                >
                    <svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                </button>

                <button
                    type="button"
                    id="kutzCelebrityNext"
                    aria-label="Next celebrity videos"
                    aria-controls="kutzCelebrityTrack"
                    class="flex h-11 w-11 items-center justify-center rounded-full bg-brand text-white shadow-md transition hover:bg-brand-dark disabled:cursor-not-allowed disabled:opacity-35"
                >
                    <svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </button>

            </div>

        </div>

        {{-- CELEBRITY VIDEO CAROUSEL --}}
        <div
            id="kutzCelebrityTrack"
            class="kutz-celebrity-track mt-5 flex snap-x snap-mandatory gap-3 overflow-x-auto overscroll-x-contain px-4 pb-5 sm:gap-4 sm:px-6 lg:gap-5 lg:px-8"
            aria-label="Celebrity makeover videos"
            tabindex="0"
        >

            @foreach($celebrityItems as $video)

                <button
                    type="button"
                    data-celebrity-card
                    data-embed-url="{{ $video->embed_url }}"
                    data-platform="{{ $video->platform }}"
                    aria-label="Play celebrity makeover video: {{ $video->title }}"
                    class="kutz-celebrity-card group relative block w-[43vw] min-w-[43vw] max-w-[210px] shrink-0 snap-start overflow-hidden rounded-2xl border border-rose-100 bg-white text-left shadow-sm transition-[box-shadow,transform] duration-300 hover:-translate-y-1 hover:border-rose-300 hover:shadow-xl focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand sm:w-[220px] sm:min-w-[220px] sm:max-w-none lg:w-[245px] lg:min-w-[245px]"
                >

                    <div class="relative aspect-[9/16] overflow-hidden">

                        {{-- DYNAMIC THUMBNAIL --}}
                        <img
                            src="{{ asset('storage/' . $video->thumbnail) }}"
                            alt="{{ $video->title }}"
                            loading="lazy"
                            decoding="async"
                            class="pointer-events-none absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105"
                        >

                        {{-- FALLBACK BACKGROUND --}}
                        <div
                            class="pointer-events-none absolute inset-0 -z-10 bg-gradient-to-br from-rose-200 via-rose-400 to-rose-600"
                        ></div>

                        {{-- THUMBNAIL OVERLAY --}}
                        <div
                            class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/75 via-black/5 to-black/10"
                        ></div>

                        {{-- CELEBRITY LABEL --}}
                        <span
                            class="absolute left-3 top-3 inline-flex items-center gap-1.5 rounded-full border border-white/30 bg-white/90 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-brand shadow-sm backdrop-blur-md"
                        >
                            <svg
                                width="12"
                                height="12"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                aria-hidden="true"
                            >
                                <path d="m12 2 2.9 6.2 6.8.9-5 4.8 1.2 6.8L12 17.5l-5.9 3.2 1.2-6.8-5-4.8 6.8-.9L12 2z"/>
                            </svg>

                            Celebrity
                        </span>

                        {{-- PLAY ICON --}}
                        <span
                            class="absolute left-1/2 top-1/2 flex h-14 w-14 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full border-2 border-white bg-white/25 text-white shadow-lg backdrop-blur-sm transition duration-300 group-hover:scale-110 group-hover:bg-brand sm:h-16 sm:w-16"
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

                        {{-- BOTTOM CONTENT --}}
                        <div class="absolute inset-x-0 bottom-0 p-3 sm:p-4">

                            <p
                                class="mb-1 text-[10px] font-semibold uppercase tracking-[0.16em] text-rose-200"
                            >
                                KUTZZ THE SALON
                            </p>

                            <h4
                                class="line-clamp-2 font-heading text-sm font-bold leading-5 text-white sm:text-base"
                            >
                                {{ $video->title }}
                            </h4>

                            <p class="mt-1 text-[11px] text-white/75">
                                Tap to watch
                            </p>

                        </div>

                    </div>

                </button>

            @endforeach

        </div>

        {{-- MOBILE SWIPE HINT --}}
        <div
            class="mt-1 flex items-center justify-center gap-2 text-xs text-slate-500 sm:hidden"
        >
            <span aria-hidden="true">←</span>
            Swipe to explore
            <span aria-hidden="true">→</span>
        </div>

    </div>

</section>


{{-- =========================================================
    CELEBRITY VIDEO MODAL
    Only selected video, no custom metadata
========================================================= --}}

<div
    id="kutzCelebrityModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/95 p-3 sm:p-6"
    role="dialog"
    aria-modal="true"
    aria-label="Celebrity video player"
    aria-hidden="true"
    tabindex="-1"
>

    {{-- CLOSE BUTTON --}}
    <button
        type="button"
        id="kutzCelebrityClose"
        aria-label="Close celebrity video"
        class="absolute right-3 top-3 z-30 flex h-11 w-11 items-center justify-center rounded-full border border-white/25 bg-white/15 text-white backdrop-blur-md transition hover:bg-brand sm:right-6 sm:top-6"
    >
        <svg
            width="22"
            height="22"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            aria-hidden="true"
        >
            <path d="M18 6 6 18M6 6l12 12"/>
        </svg>
    </button>

    {{-- VIDEO PLAYER ONLY --}}
    <div
        class="flex h-full w-full items-center justify-center pt-12 pb-4 sm:pt-4"
    >

        <iframe
            id="kutzCelebrityPlayer"
            class="hidden aspect-[9/16] max-h-full w-auto max-w-full rounded-xl border-0 bg-black"
            style="height: min(78dvh, 760px); width: min(100%, 428px);"
            title="Celebrity makeover video"
            allow="autoplay; encrypted-media; picture-in-picture; fullscreen"
            allowfullscreen
            referrerpolicy="strict-origin-when-cross-origin"
        ></iframe>

    </div>

</div>


{{-- =========================================================
    CELEBRITY SECTION CSS
========================================================= --}}

<style>
    .kutz-celebrity-track {
        scrollbar-width: none;
        -ms-overflow-style: none;
        scroll-behavior: smooth;
        touch-action: pan-x pan-y;
        cursor: grab;
        user-select: none;
        -webkit-user-select: none;
    }

    .kutz-celebrity-track::-webkit-scrollbar {
        display: none;
        width: 0;
        height: 0;
    }

    .kutz-celebrity-track.is-dragging {
        cursor: grabbing;
        scroll-behavior: auto;
        scroll-snap-type: none;
    }

    .kutz-celebrity-track.is-dragging * {
        pointer-events: none;
    }

    body.kutz-celebrity-modal-open {
        overflow: hidden;
    }

    @media (prefers-reduced-motion: reduce) {
        .kutz-celebrity-track {
            scroll-behavior: auto;
        }
    }
</style>


{{-- =========================================================
    CELEBRITY CAROUSEL + VIDEO POPUP JAVASCRIPT
========================================================= --}}

<script>
(function () {

    function initCelebrityShowcase() {

        const track = document.getElementById('kutzCelebrityTrack');
        const modal = document.getElementById('kutzCelebrityModal');
        const player = document.getElementById('kutzCelebrityPlayer');

        const closeButton = document.getElementById('kutzCelebrityClose');
        const prevButton = document.getElementById('kutzCelebrityPrev');
        const nextButton = document.getElementById('kutzCelebrityNext');

        if (!track || !modal || !player || !closeButton) return;

        if (track.dataset.initialized === 'true') return;
        track.dataset.initialized = 'true';

        const cards = Array.from(
            track.querySelectorAll('[data-celebrity-card]')
        );

        let lastFocusedElement = null;

        // CAROUSEL SCROLL AMOUNT
        function getScrollAmount() {
            const card = cards[0];

            if (!card) return 240;

            const gap = parseFloat(
                window.getComputedStyle(track).columnGap
            ) || 0;

            return card.getBoundingClientRect().width + gap;
        }

        // UPDATE NAVIGATION BUTTONS
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

        prevButton?.addEventListener('click', function () {
            track.scrollBy({
                left: -getScrollAmount(),
                behavior: 'smooth'
            });
        });

        nextButton?.addEventListener('click', function () {
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

        window.addEventListener('resize', updateButtons);
        updateButtons();

        // MOUSE DRAG SUPPORT
        let pointerDown = false;
        let dragMoved = false;
        let suppressClick = false;
        let startX = 0;
        let startScrollLeft = 0;

        track.addEventListener('pointerdown', function (event) {
            if (
                event.pointerType !== 'mouse' ||
                event.button !== 0
            ) return;

            pointerDown = true;
            dragMoved = false;

            startX = event.clientX;
            startScrollLeft = track.scrollLeft;
        });

        window.addEventListener('pointermove', function (event) {
            if (!pointerDown) return;

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
            if (!pointerDown) return;

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

        // VALIDATE EMBED URL
        function getSafeEmbedUrl(card) {

            const platform = card.dataset.platform;
            const rawUrl = card.dataset.embedUrl;

            try {
                const url = new URL(rawUrl);

                const allowedHosts = {
                    youtube: 'www.youtube-nocookie.com',
                    instagram: 'www.instagram.com'
                };

                if (
                    url.protocol !== 'https:' ||
                    url.hostname !== allowedHosts[platform]
                ) {
                    return null;
                }

                if (platform === 'youtube') {
                    if (
                        !/^\/embed\/[A-Za-z0-9_-]{11}$/.test(url.pathname)
                    ) {
                        return null;
                    }

                    url.searchParams.set('autoplay', '1');
                    url.searchParams.set('rel', '0');
                }

                if (platform === 'instagram') {
                    if (
                        !/^\/(reel|p)\/[A-Za-z0-9_-]+\/embed\/$/.test(url.pathname)
                    ) {
                        return null;
                    }
                }

                return url.toString();

            } catch (error) {
                return null;
            }
        }

        // OPEN VIDEO POPUP
        function openVideo(card) {

            const embedUrl = getSafeEmbedUrl(card);

            if (!embedUrl) return;

            lastFocusedElement = document.activeElement;

            player.src = embedUrl;
            player.classList.remove('hidden');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modal.setAttribute('aria-hidden', 'false');

            document.body.classList.add(
                'kutz-celebrity-modal-open'
            );

            closeButton.focus();
        }

        // CLOSE VIDEO POPUP
        function closeVideo() {

            if (modal.classList.contains('hidden')) return;

            player.removeAttribute('src');
            player.classList.add('hidden');

            modal.classList.add('hidden');
            modal.classList.remove('flex');
            modal.setAttribute('aria-hidden', 'true');

            document.body.classList.remove(
                'kutz-celebrity-modal-open'
            );

            if (
                lastFocusedElement &&
                typeof lastFocusedElement.focus === 'function'
            ) {
                lastFocusedElement.focus();
            }
        }

        // THUMBNAIL CLICK
        cards.forEach(function (card) {

            card.addEventListener('click', function (event) {

                if (suppressClick) {
                    event.preventDefault();
                    return;
                }

                openVideo(card);
            });

        });

        // CLOSE BUTTON
        closeButton.addEventListener('click', closeVideo);

        // OUTSIDE CLICK
        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeVideo();
            }
        });

        // KEYBOARD SUPPORT
        document.addEventListener('keydown', function (event) {

            if (modal.classList.contains('hidden')) return;

            if (event.key === 'Escape') {
                closeVideo();
            }

            if (event.key === 'Tab') {

                const focusable = Array.from(
                    modal.querySelectorAll(
                        'button:not([disabled]), iframe'
                    )
                ).filter(function (element) {
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

        // STOP VIDEO WHEN TAB IS HIDDEN
        document.addEventListener(
            'visibilitychange',
            function () {
                if (document.hidden) {
                    closeVideo();
                }
            }
        );
    }

    if (document.readyState === 'loading') {
        document.addEventListener(
            'DOMContentLoaded',
            initCelebrityShowcase
        );
    } else {
        initCelebrityShowcase();
    }

})();
</script>

@endif
