{{-- ==========================================================
KUTZ SALON — DYNAMIC INSTAGRAM REELS CAROUSEL

Data source: videos table
Platform: Instagram only
Status: Active only

UI:
- Full-width responsive carousel
- Infinite auto-scrolling
- Thumbnail hover effects
- Instagram Reel popup
- Desktop: Video left, caption right
- Mobile: Video top, caption bottom
========================================================== --}}

@php
    $instagramUsername = 'kutzzthesalonandacademy';

    $instagramProfile =
        'https://www.instagram.com/kutzzthesalonandacademy/';

    $instagramReelsUrl =
        'https://www.instagram.com/kutzzthesalonandacademy/reels/';

    /*
     * Data comes from AppServiceProvider View Composer.
     * Keep only active Instagram records as a safety filter.
     */
    $instagramReels = collect($instagramReels ?? [])
        ->filter(
            fn($reel) =>
                $reel->platform === 'instagram'
                && $reel->is_active
        )
        ->values();

    $reelCount = $instagramReels->count();

    /*
     * Minimum two sets are used for seamless scrolling.
     * With fewer reels, repeat the original set to fill
     * the carousel while retaining the same real records.
     */
    $reelCopies = $reelCount > 0
        ? max(2, (int) ceil(6 / $reelCount))
        : 0;

    $displayReels = collect();

    if ($reelCount > 0) {
        for ($copy = 0; $copy < $reelCopies; $copy++) {
            foreach ($instagramReels as $reel) {
                $displayReels->push($reel);
            }
        }
    }

    $displayCount = $displayReels->count();

    /*
     * One full duplicated set is the animation distance.
     * We animate by half the rendered track width.
     */
    $carouselReels = $displayReels->concat($displayReels);

    $reelsForJavascript = $instagramReels->map(function ($reel) {
        return [
            'id' => $reel->id,
            'title' => $reel->title,
            'thumbnail' => asset('storage/' . $reel->thumbnail),
            'embed_url' => $reel->embed_url,
            'date' => $reel->created_at
                ? $reel->created_at->format('d F Y')
                : '',
            'caption' => $reel->title,
            'post_url' => $reel->video_url,
        ];
    })->values();
@endphp


<section id="kutz-instagram-reels" class="w-full overflow-hidden bg-white py-12 sm:py-16 lg:py-20"
    aria-label="KUTZ Salon Instagram reels" style="
        --kutz-reel-count: {{ $displayCount }};
        --kutz-reel-duration: {{ max(30, $displayCount * 7) }}s;
    ">

    {{-- ======================================================
    HEADING — EXISTING UI
    ====================================================== --}}

    <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">

        <p class="text-xs font-bold uppercase tracking-[0.25em] text-brand">
            FOLLOW OUR JOURNEY
        </p>

        <h2 class="mt-3 font-heading text-3xl font-bold text-[#171717] sm:text-4xl">
            Catch Us On <span class="text-brand">Instagram</span>
        </h2>

        <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base">
            Explore hair transformations, beauty moments, styling inspiration
            and behind-the-scenes stories from KUTZZ Salon.
        </p>

    </div>


    {{-- ======================================================
    FULL WIDTH INSTAGRAM REEL CAROUSEL
    ====================================================== --}}

    @if($instagramReels->isNotEmpty())

        <div id="kutzInstaViewport" class="relative mt-9 w-full overflow-hidden sm:mt-11">

            {{-- Left fade --}}
            <div class="pointer-events-none absolute inset-y-0 left-0 z-10
                                       w-5 bg-gradient-to-r from-white to-transparent
                                       sm:w-12"></div>

            {{-- Right fade --}}
            <div class="pointer-events-none absolute inset-y-0 right-0 z-10
                                       w-5 bg-gradient-to-l from-white to-transparent
                                       sm:w-12"></div>


            <div id="kutzInstaTrack" class="kutz-insta-track flex w-max items-stretch gap-3 px-3
                                       sm:gap-4 sm:px-4">

                @foreach($carouselReels as $reel)

                    <button type="button" data-insta-reel data-reel-id="{{ $reel->id }}"
                        aria-label="Open Instagram reel: {{ $reel->title }}" class="kutz-insta-card group relative block shrink-0
                                                               overflow-hidden rounded-xl bg-slate-100
                                                               text-left shadow-sm
                                                               transition-shadow duration-300
                                                               hover:shadow-xl
                                                               focus-visible:outline-2
                                                               focus-visible:outline-offset-2
                                                               focus-visible:outline-brand">

                        {{-- DYNAMIC ADMIN THUMBNAIL --}}
                        <img src="{{ asset('storage/' . $reel->thumbnail) }}" alt="{{ $reel->title }}" loading="lazy"
                            decoding="async" class="h-full w-full object-cover
                                                                   transition-transform duration-500
                                                                   group-hover:scale-105">


                        {{-- Dark gradient --}}
                        <span class="pointer-events-none absolute inset-0
                                                                   bg-gradient-to-t from-black/40
                                                                   via-transparent to-black/10"></span>


                        {{-- Reel icon --}}
                        <span class="absolute right-3 top-3 text-white drop-shadow" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="3" />

                                <path d="M3 9h18M9 3l4 6M16 3l4 6" />

                                <path d="m10 12 5 3-5 3z" fill="currentColor" stroke="none" />
                            </svg>
                        </span>


                        {{-- Hover play icon --}}
                        <span class="pointer-events-none absolute inset-0
                                                                   flex items-center justify-center
                                                                   opacity-0 transition-opacity duration-300
                                                                   group-hover:opacity-100">
                            <span class="flex h-14 w-14 items-center justify-center
                                                                       rounded-full bg-white/90 text-brand
                                                                       shadow-xl backdrop-blur">
                                <svg width="23" height="23" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="m8 5 11 7-11 7V5z" />
                                </svg>
                            </span>
                        </span>

                    </button>

                @endforeach

            </div>

        </div>

    @else

        {{-- EMPTY STATE --}}
        <div class="mx-auto mt-9 max-w-7xl px-4 text-center sm:px-6">
            <div class="rounded-2xl border border-dashed border-slate-200
                                       bg-slate-50 px-5 py-12">
                <p class="text-sm font-medium text-slate-500">
                    New Instagram reels coming soon.
                </p>
            </div>
        </div>

    @endif


    {{-- ======================================================
    INSTAGRAM CTA — EXISTING UI
    ====================================================== --}}

    <div class="mt-8 flex justify-center px-4">

        <a href="{{ $instagramReelsUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex min-h-12 items-center justify-center gap-3
                   rounded-xl bg-brand px-7 py-3
                   text-xs font-bold uppercase tracking-[0.07em]
                   text-white shadow-lg shadow-red-500/15
                   transition duration-300 hover:-translate-y-0.5
                   hover:bg-brand-dark sm:text-sm">

            <svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="2" y="2" width="20" height="20" rx="5" />
                <circle cx="12" cy="12" r="4" />
                <circle cx="18" cy="6" r="1" fill="currentColor" stroke="none" />
            </svg>

            CATCH US ON INSTAGRAM

        </a>

    </div>


    {{-- ======================================================
    INSTAGRAM REEL MODAL

    Desktop: Video Left, Caption Right
    Mobile: Video Top, Caption Bottom
    ====================================================== --}}

    <div id="kutzInstaModal" class="fixed inset-0 z-[9999] hidden
               items-center justify-center bg-black/80
               p-3 sm:p-5" role="dialog" aria-modal="true" aria-labelledby="kutzInstaModalTitle" aria-hidden="true">

        {{-- Close button --}}
        <button id="kutzInstaClose" type="button" aria-label="Close reel popup" class="absolute right-3 top-3 z-30
                   flex h-11 w-11 items-center justify-center
                   rounded-full bg-white text-[#171717]
                   shadow-lg transition hover:bg-rose-50
                   sm:right-6 sm:top-6">
            <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" aria-hidden="true">
                <path d="M18 6 6 18M6 6l12 12" />
            </svg>
        </button>


        {{-- MODAL CONTAINER --}}
        <!-- <div
            id="kutzInstaModalPanel"
            class="flex max-h-[92dvh] w-full max-w-[980px]
                   flex-col overflow-hidden rounded-2xl bg-white
                   shadow-2xl
                   md:h-[580px] md:flex-row"
        > -->

        <div id="kutzInstaModalPanel" class="flex h-[92dvh] max-h-[92dvh] w-full max-w-[980px]
           flex-col overflow-hidden rounded-2xl bg-white
           shadow-2xl
           md:h-[650px] md:flex-row">

            {{-- LEFT VIDEO --}}
            <div class="relative flex h-[66%] min-h-0
           shrink-0 items-center justify-center
           overflow-hidden bg-black
           sm:h-[70%]
           md:h-full md:w-[58%]">

                {{-- DYNAMIC INSTAGRAM EMBED --}}
                <!-- <iframe id="kutzInstaVideo" class="h-full w-full border-0 bg-black" title="KUTZ Salon Instagram reel"
                    loading="lazy" allow="autoplay; encrypted-media; picture-in-picture; fullscreen" allowfullscreen
                    referrerpolicy="strict-origin-when-cross-origin"></iframe> -->

                <iframe id="kutzInstaVideo" class="h-full w-full border-0 bg-black" title="KUTZ Salon Instagram reel"
                    loading="lazy" allow="autoplay; encrypted-media; picture-in-picture; fullscreen" allowfullscreen
                    referrerpolicy="strict-origin-when-cross-origin"></iframe>


                {{-- Video fallback message --}}
                <div id="kutzInstaVideoMessage" class="pointer-events-none absolute bottom-4 left-4
                           right-4 hidden rounded-lg bg-black/70
                           px-4 py-2 text-center text-xs text-white">
                    If this reel cannot be played here,
                    use View on Instagram.
                </div>

            </div>


            {{-- RIGHT POST DETAILS --}}
            <div class="flex min-h-0 flex-1 flex-col overflow-hidden bg-white">

                {{-- Account header --}}
                <div class="flex shrink-0 items-center gap-2
           border-b border-slate-100 px-3 py-2
           sm:gap-3 sm:px-5 sm:py-3">

                    <!-- <div class="flex h-10 w-10 shrink-0 items-center
                               justify-center rounded-full
                               bg-[#FFF2F4] font-heading
                               text-lg font-bold text-brand">
                        K
                    </div> -->

                    <div class="min-w-0 flex-1">

                        <h3 id="kutzInstaModalTitle" class="truncate text-sm font-bold
                                   text-[#171717]">
                            {{ $instagramUsername }}
                        </h3>

                        <p id="kutzInstaDate" class="mt-0.5 text-xs text-slate-500"></p>

                    </div>

                    <a href="{{ $instagramProfile }}" target="_blank" rel="noopener noreferrer" class="shrink-0 rounded-lg bg-[#1877F2]
                               px-4 py-2 text-xs font-bold
                               text-white transition
                               hover:bg-[#0866D5]">
                        Follow
                    </a>

                </div>


                {{-- Caption --}}
                <div class="min-h-0 flex-1 overflow-y-auto
                           px-4 py-5 sm:px-5">

                    <p id="kutzInstaCaption" class="whitespace-pre-line break-words
                               text-sm leading-7 text-slate-700"></p>

                </div>


                {{-- Footer --}}
                <div class="flex shrink-0 items-center
                           justify-between gap-3
                           border-t border-slate-100
                           px-4 py-4 sm:px-5">

                    <span class="text-xs text-slate-400">
                        KUTZZ Salon & Academy
                    </span>

                    <a id="kutzInstaPostLink" href="{{ $instagramReelsUrl }}" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-2
                               text-xs font-semibold text-brand
                               hover:underline">
                        View on Instagram
                        <span aria-hidden="true">↗</span>
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ==========================================================
CSS — FULL WIDTH INFINITE REELS

Original card sizes, aspect ratio and styling preserved.
Animation width calculated dynamically from record count.
========================================================== --}}

<style>
    #kutz-instagram-reels {
        --kutz-reel-width: calc((100vw - 84px) / 6);
        --kutz-reel-gap: 12px;
    }

    .kutz-insta-card {
        width: var(--kutz-reel-width);
        aspect-ratio: 9 / 12;
    }

    .kutz-insta-track {
        --set-width: calc(var(--kutz-reel-count) * (var(--kutz-reel-width) + var(--kutz-reel-gap)));

        animation: kutzReelsMarquee var(--kutz-reel-duration) linear infinite;

        will-change: transform;
    }

    #kutzInstaViewport:hover .kutz-insta-track,
    #kutzInstaViewport:focus-within .kutz-insta-track,
    .kutz-insta-track.is-paused {
        animation-play-state: paused;
    }

    @keyframes kutzReelsMarquee {
        from {
            transform: translateX(0);
        }

        to {
            transform: translateX(calc(-1 * var(--set-width)));
        }
    }

    @media (min-width: 640px) {
        #kutz-instagram-reels {
            --kutz-reel-gap: 16px;
        }
    }

    @media (min-width: 1280px) {
        #kutz-instagram-reels {
            --kutz-reel-width: calc((100vw - 112px) / 6);
        }
    }

    @media (min-width: 768px) and (max-width: 1279px) {
        #kutz-instagram-reels {
            --kutz-reel-width: 235px;
        }
    }

    @media (min-width: 480px) and (max-width: 767px) {
        #kutz-instagram-reels {
            --kutz-reel-width: 190px;
        }
    }

    @media (max-width: 479px) {
        #kutz-instagram-reels {
            --kutz-reel-width: 155px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .kutz-insta-track {
            animation: none;
        }

        #kutzInstaViewport {
            overflow-x: auto;
        }
    }
</style>


{{-- ==========================================================
JAVASCRIPT — DYNAMIC INSTAGRAM REEL MODAL
========================================================== --}}

<script>
    (function () {

        function initKutzInstagramReels() {

            const section = document.getElementById(
                'kutz-instagram-reels'
            );

            if (!section || section.dataset.initialized === 'true') {
                return;
            }

            section.dataset.initialized = 'true';

            // Dynamic Instagram data from Laravel
            const reels = @json($reelsForJavascript);
            const reelsUrl = @json($instagramReelsUrl);

            const track = document.getElementById(
                'kutzInstaTrack'
            );

            const modal = document.getElementById(
                'kutzInstaModal'
            );

            const closeButton = document.getElementById(
                'kutzInstaClose'
            );

            const player = document.getElementById(
                'kutzInstaVideo'
            );

            const date = document.getElementById(
                'kutzInstaDate'
            );

            const caption = document.getElementById(
                'kutzInstaCaption'
            );

            const postLink = document.getElementById(
                'kutzInstaPostLink'
            );

            const videoMessage = document.getElementById(
                'kutzInstaVideoMessage'
            );

            if (!modal || !player) return;

            let lastFocusedElement = null;
            let previousBodyOverflow = '';

            function stopReel() {
                player.removeAttribute('src');
            }

            function openReel(id) {

                const reel = reels.find(function (item) {
                    return Number(item.id) === Number(id);
                });

                if (!reel) return;

                let embedUrl;

                try {
                    embedUrl = new URL(reel.embed_url);

                    if (
                        embedUrl.protocol !== 'https:' ||
                        embedUrl.hostname !== 'www.instagram.com'
                    ) {
                        return;
                    }
                } catch (error) {
                    return;
                }

                lastFocusedElement = document.activeElement;

                date.textContent = reel.date || '';
                caption.textContent = reel.caption || '';

                postLink.href = reel.post_url || reelsUrl;

                stopReel();

                videoMessage.classList.add('hidden');

                modal.classList.remove('hidden');
                modal.classList.add('flex');
                modal.setAttribute('aria-hidden', 'false');

                if (track) {
                    track.classList.add('is-paused');
                }

                previousBodyOverflow = document.body.style.overflow;
                document.body.style.overflow = 'hidden';

                player.title = reel.title || 'Instagram Reel';
                player.src = embedUrl.toString();

                closeButton?.focus();
            }

            function closeReel() {

                if (modal.classList.contains('hidden')) {
                    return;
                }

                stopReel();

                modal.classList.add('hidden');
                modal.classList.remove('flex');
                modal.setAttribute('aria-hidden', 'true');

                document.body.style.overflow =
                    previousBodyOverflow;

                if (track) {
                    track.classList.remove('is-paused');
                }

                if (lastFocusedElement) {
                    lastFocusedElement.focus({
                        preventScroll: true
                    });
                }
            }

            // Click on any duplicated carousel card
            track?.addEventListener('click', function (event) {

                const card = event.target.closest(
                    '[data-insta-reel]'
                );

                if (!card) return;

                openReel(card.dataset.reelId);
            });

            closeButton?.addEventListener(
                'click',
                closeReel
            );

            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeReel();
                }
            });

            // Keyboard navigation
            document.addEventListener('keydown', function (event) {

                if (modal.classList.contains('hidden')) {
                    return;
                }

                if (event.key === 'Escape') {
                    closeReel();
                    return;
                }

                if (event.key === 'Tab') {

                    const focusable = Array.from(
                        modal.querySelectorAll(
                            'button:not([disabled]), a[href], iframe'
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

            // Stop playback when browser tab is hidden
            document.addEventListener(
                'visibilitychange',
                function () {
                    if (document.hidden) {
                        closeReel();
                    }
                }
            );

        }

        if (document.readyState === 'loading') {
            document.addEventListener(
                'DOMContentLoaded',
                initKutzInstagramReels
            );
        } else {
            initKutzInstagramReels();
        }

    })();
</script>