@php
    /*
    |--------------------------------------------------------------------------
    | Frontend Navigation
    |--------------------------------------------------------------------------
    */
    $navigation = [
        ['Home', 'home'],
        ['About Us', 'about'],
        ['Services', 'services.index'],
        ['Gallery', 'gallery.index'],
        ['Academy', 'academy.index'],
        ['Blogs', 'blogs.index'],
        ['Contact', 'contact'],
    ];

    /*
    |--------------------------------------------------------------------------
    | Dynamic Logo
    |--------------------------------------------------------------------------
    | Site Settings se uploaded logo show hoga.
    | Agar logo available nahi hai, fallback KUTZ text show hoga.
    */

    // $headerLogo = $siteSettings->logo ?? null;
    $logoUrl = asset('assets/images/kutz-logo.png');

    // $logoUrl = null;

    // if (!empty($headerLogo)) {
    //     if (\Illuminate\Support\Str::startsWith($headerLogo, ['http://', 'https://'])) {
    //         $logoUrl = $headerLogo;
    //     } else {
    //         $logoPath = preg_replace(
    //             '#^(storage/|public/)#',
    //             '',
    //             ltrim($headerLogo, '/')
    //         );

    //         $logoUrl = asset('storage/' . $logoPath);
    //     }
    // }

    /*
    |--------------------------------------------------------------------------
    | Active Navigation
    |--------------------------------------------------------------------------
    */
    $isActive = function (string $routeName): bool {
        if (request()->routeIs($routeName)) {
            return true;
        }

        return match ($routeName) {
            'services.index' => request()->routeIs('services.show'),
            'blogs.index' => request()->routeIs('blogs.show'),
            'gallery.index' => request()->routeIs('gallery.*'),
            'academy.index' => request()->routeIs('academy.*'),
            default => false,
        };
    };
@endphp

<header id="frontendHeader" class="sticky top-0 z-40 w-full border-b border-slate-100 bg-white/95 backdrop-blur-xl">
    {{-- DESKTOP HEADER --}}
    <div
        class="mx-auto flex min-h-20 w-full max-w-7xl items-center justify-between gap-3 px-4 sm:px-6 lg:gap-5 lg:px-8">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="flex min-w-0 shrink-0 items-center" aria-label="KUTZ Salon Home">

            <img src="{{ asset('assets/images/kutz-logo.png') }}" alt="KUTZ The Salon Logo"
                class="block h-auto w-[115px] max-w-full object-contain sm:w-[135px] lg:w-[150px]" loading="eager"
                decoding="async">

        </a>

        {{-- DESKTOP NAVIGATION --}}
        <nav aria-label="Main navigation" class="hidden min-w-0 items-center justify-center gap-4 lg:flex xl:gap-6">

            @foreach($navigation as [$label, $routeName])

                @if(Route::has($routeName))
                    @php
                        $active = $isActive($routeName);
                    @endphp

                    <a href="{{ route($routeName) }}" @if($active) aria-current="page" @endif class="relative whitespace-nowrap py-2 text-[13px] font-semibold transition-colors duration-200 xl:text-sm
                                {{ $active
                    ? 'text-brand'
                    : 'text-slate-500 hover:text-brand' }}">
                        {{ $label }}

                        @if($active)
                            <span class="absolute bottom-0 left-0 h-0.5 w-full rounded-full bg-brand"></span>
                        @endif
                    </a>
                @endif

            @endforeach

        </nav>

        {{-- RIGHT ACTIONS --}}
        <div class="flex shrink-0 items-center gap-2 sm:gap-3">

            <a href="{{ route('services.index') }}"
                class="hidden min-h-11 items-center justify-center whitespace-nowrap rounded-xl bg-brand px-4 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 hover:bg-brand-dark hover:shadow-md sm:inline-flex lg:px-5">
                Explore Services
            </a>

            {{-- MOBILE MENU BUTTON --}}
            <button type="button" id="frontendMenuToggle" aria-label="Open navigation menu"
                aria-controls="frontendMobileMenu" aria-expanded="false"
                class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-800 transition hover:border-brand hover:bg-brand-light hover:text-brand lg:hidden">
                <svg id="frontendMenuOpenIcon" xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" aria-hidden="true">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>

                <svg id="frontendMenuCloseIcon" xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="hidden" aria-hidden="true">
                    <path d="M18 6 6 18M6 6l12 12" />
                </svg>
            </button>

        </div>
    </div>

    {{-- MOBILE NAVIGATION --}}
    <nav id="frontendMobileMenu" aria-label="Mobile navigation"
        class="hidden max-h-[calc(100dvh-5rem)] overflow-y-auto border-t border-slate-100 bg-white px-4 py-4 shadow-lg sm:px-6 lg:hidden">

        <div class="mx-auto flex max-w-7xl flex-col gap-1">

            @foreach($navigation as [$label, $routeName])

                @if(Route::has($routeName))
                    @php
                        $active = $isActive($routeName);
                    @endphp

                    <a href="{{ route($routeName) }}" @if($active) aria-current="page" @endif class="flex min-h-12 items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold transition-colors
                                {{ $active
                    ? 'bg-brand-light text-brand'
                    : 'text-slate-700 hover:bg-brand-light hover:text-brand' }}">
                        <span>{{ $label }}</span>

                        @if($active)
                            <span class="h-2 w-2 rounded-full bg-brand" aria-hidden="true"></span>
                        @endif
                    </a>
                @endif

            @endforeach

            {{-- MOBILE CTA --}}
            <a href="{{ route('services.index') }}"
                class="mt-3 flex min-h-12 items-center justify-center rounded-xl bg-brand px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-dark">
                Explore Our Services
                <span class="ml-2" aria-hidden="true">→</span>
            </a>

        </div>
    </nav>
</header>

<script>
    (function () {
        function initFrontendMenu() {
            const toggle = document.getElementById('frontendMenuToggle');
            const menu = document.getElementById('frontendMobileMenu');
            const openIcon = document.getElementById('frontendMenuOpenIcon');
            const closeIcon = document.getElementById('frontendMenuCloseIcon');

            if (!toggle || !menu || toggle.dataset.initialized === 'true') {
                return;
            }

            toggle.dataset.initialized = 'true';

            function setMenuState(open) {
                menu.classList.toggle('hidden', !open);
                openIcon?.classList.toggle('hidden', open);
                closeIcon?.classList.toggle('hidden', !open);

                toggle.setAttribute('aria-expanded', String(open));
                toggle.setAttribute(
                    'aria-label',
                    open ? 'Close navigation menu' : 'Open navigation menu'
                );
            }

            toggle.addEventListener('click', function () {
                const isOpen = toggle.getAttribute('aria-expanded') === 'true';
                setMenuState(!isOpen);
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    setMenuState(false);
                }
            });

            document.addEventListener('click', function (event) {
                if (!toggle.contains(event.target) &&
                    !menu.contains(event.target)) {
                    setMenuState(false);
                }
            });

            menu.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () {
                    setMenuState(false);
                });
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth >= 1024) {
                    setMenuState(false);
                }
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initFrontendMenu);
        } else {
            initFrontendMenu();
        }
    })();
</script>