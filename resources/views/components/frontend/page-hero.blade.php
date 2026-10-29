
@props([
    'eyebrow' => 'KUTZ THE SALON',
    'title' => 'Discover Your Beauty',
    'description' => '',
    'image' => null,
    'cta' => null,
    'href' => null,
])

<section
    {{ $attributes->class([
        'relative isolate overflow-hidden bg-[#FFF7F8]'
    ]) }}
>
    {{-- Background Decorations --}}
    <div
        class="pointer-events-none absolute -left-24 top-10 h-64 w-64 rounded-full bg-rose-200/40 blur-3xl"
        aria-hidden="true"
    ></div>

    <div
        class="pointer-events-none absolute -right-24 bottom-0 h-80 w-80 rounded-full bg-rose-100/70 blur-3xl"
        aria-hidden="true"
    ></div>

    <div
        class="relative mx-auto grid w-full max-w-7xl items-center gap-10 px-4 py-12 sm:px-6 sm:py-16 lg:min-h-[460px] lg:grid-cols-2 lg:gap-16 lg:px-8 lg:py-20"
    >

        {{-- LEFT CONTENT --}}
        <div class="relative z-10 min-w-0">

            <div
                class="inline-flex max-w-full items-center gap-2 rounded-full border border-rose-200 bg-white/80 px-4 py-2 shadow-sm"
            >
                <span
                    class="h-2 w-2 shrink-0 rounded-full bg-brand"
                ></span>

                <span
                    class="break-words text-[10px] font-bold uppercase tracking-[0.15em] text-brand sm:text-xs"
                >
                    {{ $eyebrow }}
                </span>
            </div>

            {{-- Main Heading --}}
            <h1
                class="mt-6 break-words font-heading text-3xl font-extrabold leading-tight tracking-tight text-slate-950 sm:text-4xl lg:text-5xl xl:text-[3.4rem]"
            >
                {{ $title }}
            </h1>

            {{-- Description --}}
            @if(filled($description))
                <p
                    class="mt-5 max-w-xl text-sm leading-7 text-slate-600 sm:text-base sm:leading-8"
                >
                    {{ $description }}
                </p>
            @endif

            {{-- CTA Button --}}
            @if(filled($cta) && filled($href))
                <div class="mt-8 flex flex-wrap items-center gap-4">

                    <a
                        href="{{ $href }}"
                        class="inline-flex min-h-12 items-center justify-center gap-3 rounded-xl bg-brand px-7 py-3 text-sm font-bold text-white shadow-lg shadow-rose-900/10 transition duration-300 hover:-translate-y-0.5 hover:bg-brand-dark hover:shadow-xl"
                    >
                        <span>{{ $cta }}</span>

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="18"
                            height="18"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M5 12h14"></path>
                            <path d="m12 5 7 7-7 7"></path>
                        </svg>
                    </a>

                </div>
            @endif

            {{-- Bottom Accent --}}
            <div class="mt-9 flex items-center gap-3">
                <span class="h-1 w-12 rounded-full bg-brand"></span>
                <span class="h-1 w-5 rounded-full bg-rose-200"></span>
                <span class="h-1 w-3 rounded-full bg-rose-100"></span>
            </div>

        </div>

        {{-- RIGHT IMAGE --}}
        <div class="relative min-w-0">

            <div
                class="pointer-events-none absolute -right-3 -top-3 h-28 w-28 rounded-full border border-brand/20 sm:-right-6 sm:-top-6"
                aria-hidden="true"
            ></div>

            <div
                class="pointer-events-none absolute -bottom-4 -left-4 h-32 w-32 rounded-full bg-brand/10 blur-xl"
                aria-hidden="true"
            ></div>

            <div
                class="relative overflow-hidden rounded-[1.5rem] border-4 border-white bg-brand-light shadow-2xl shadow-rose-900/10 sm:rounded-[2rem]"
            >

                @if(filled($image))

                    <img
                        src="{{ $image }}"
                        alt="{{ $title }}"
                        class="aspect-[5/4] w-full object-cover sm:aspect-[6/5] lg:aspect-[5/4]"
                        loading="eager"
                        fetchpriority="high"
                    >

                @else

                    {{-- Fallback if no image exists --}}
                    <div
                        class="flex aspect-[5/4] flex-col items-center justify-center bg-gradient-to-br from-[#FFF2F4] via-[#FFE4E9] to-[#F8BAC5] px-6 text-center"
                    >

                        <span
                            class="font-heading text-5xl font-extrabold tracking-tight text-brand sm:text-6xl"
                        >
                            KUTZ
                        </span>

                        <span
                            class="mt-2 text-xs font-semibold uppercase tracking-[0.35em] text-brand-dark"
                        >
                            THE SALON
                        </span>

                        <span
                            class="mt-5 h-px w-24 bg-brand/30"
                        ></span>

                        <p
                            class="mt-4 text-sm font-medium text-slate-600"
                        >
                            Beauty • Style • Confidence
                        </p>

                    </div>

                @endif

            </div>

            {{-- Floating Label --}}
            <div
                class="absolute -bottom-3 right-3 rounded-xl border border-white/80 bg-white/95 px-4 py-3 shadow-lg backdrop-blur-md sm:-bottom-5 sm:right-5 sm:px-5"
            >
                <p class="text-xs font-bold text-brand sm:text-sm">
                    KUTZ THE SALON
                </p>

                <p class="mt-1 text-[10px] text-slate-500 sm:text-xs">
                    Your Beauty, Our Passion
                </p>
            </div>

        </div>

    </div>
</section>
