
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
    | Logo
    |--------------------------------------------------------------------------
    */
    $logoUrl = asset('assets/images/kutz-logo.png');

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

{{-- ============================================================
    KUTZZ SALON — PREMIUM DARK HEADER
    Theme: Charcoal Black + White + Brand Red
    Responsive: 320px / Mobile / Tablet / Desktop
============================================================ --}}

<header
    id="frontendHeader"
    class="sticky top-0 z-40 w-full
           border-b border-white/10
           bg-black
           shadow-[0_8px_30px_rgba(0,0,0,0.16)]
           backdrop-blur-xl"
>

    {{-- MAIN HEADER --}}
    <div
        class="mx-auto flex min-h-20 w-full max-w-7xl
               items-center justify-between gap-3
               px-4 sm:px-6 lg:gap-5 lg:px-8"
    >

        {{-- LOGO --}}
        <a
            href="{{ route('home') }}"
            class="flex min-w-0 shrink-0 items-center"
            aria-label="Kutzz The Salon Home"
        >
            <img
                src="{{ $logoUrl }}"
                alt="Kutzz The Salon Logo"
                class="block h-auto w-[115px] max-w-full
                       object-contain
                       sm:w-[135px] lg:w-[150px]"
                loading="eager"
                decoding="async"
            >
        </a>


        {{-- DESKTOP NAVIGATION --}}
        <nav
            aria-label="Main navigation"
            class="hidden min-w-0 items-center
                   justify-center gap-4
                   lg:flex xl:gap-6"
        >

            @foreach($navigation as [$label, $routeName])

                @if(Route::has($routeName))

                    @php
                        $active = $isActive($routeName);
                    @endphp

                    <a
                        href="{{ route($routeName) }}"
                        @if($active) aria-current="page" @endif
                        class="group relative whitespace-nowrap
                               py-2 text-[13px] font-semibold
                               tracking-[0.01em]
                               transition-colors duration-200
                               xl:text-sm
                               {{ $active
                                   ? 'text-white'
                                   : 'text-[#E5E7EB] hover:text-white' }}"
                    >

                        {{ $label }}

                        {{-- ACTIVE / HOVER UNDERLINE --}}
                        <span
                            class="absolute bottom-0 left-0
                                   h-[2px] rounded-full
                                   bg-[#D60927]
                                   transition-all duration-300
                                   {{ $active
                                       ? 'w-full'
                                       : 'w-0 group-hover:w-full' }}"
                        ></span>

                    </a>

                @endif

            @endforeach

        </nav>


        {{-- RIGHT ACTIONS --}}
        <div
            class="flex shrink-0 items-center
                   gap-2 sm:gap-3"
        >

            {{-- DESKTOP CTA --}}
            @if(Route::has('services.index'))
                <a
                    href="{{ route('services.index') }}"
                    class="hidden min-h-11 items-center
                           justify-center whitespace-nowrap
                           rounded-xl bg-[#D60927]
                           px-4 py-3 text-sm font-semibold
                           text-white
                           shadow-[0_5px_18px_rgba(214,9,39,0.22)]
                           transition duration-200
                           hover:-translate-y-0.5
                           hover:bg-[#A60820]
                           hover:shadow-[0_8px_24px_rgba(214,9,39,0.30)]
                           focus-visible:outline-2
                           focus-visible:outline-offset-2
                           focus-visible:outline-white
                           sm:inline-flex lg:px-5"
                >
                    Explore Services
                </a>
            @endif


            {{-- MOBILE MENU BUTTON --}}
            <button
                type="button"
                id="frontendMenuToggle"
                aria-label="Open navigation menu"
                aria-controls="frontendMobileMenu"
                aria-expanded="false"
                class="inline-flex h-11 w-11
                       shrink-0 items-center justify-center
                       rounded-xl border border-white/20
                       bg-white/10 text-white
                       transition duration-200
                       hover:border-[#D60927]
                       hover:bg-[#D60927]/20
                       focus-visible:outline-2
                       focus-visible:outline-offset-2
                       focus-visible:outline-white
                       lg:hidden"
            >

                {{-- HAMBURGER ICON --}}
                <svg
                    id="frontendMenuOpenIcon"
                    xmlns="http://www.w3.org/2000/svg"
                    width="23"
                    height="23"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                {{-- CLOSE ICON --}}
                <svg
                    id="frontendMenuCloseIcon"
                    xmlns="http://www.w3.org/2000/svg"
                    width="23"
                    height="23"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="hidden"
                    aria-hidden="true"
                >
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>

            </button>

        </div>

    </div>


    {{-- MOBILE / TABLET NAVIGATION --}}
    <nav
        id="frontendMobileMenu"
        aria-label="Mobile navigation"
        class="hidden max-h-[calc(100dvh-5rem)]
               overflow-y-auto
               border-t border-white/10
               bg-[#18191D]
               px-4 py-4
               shadow-[0_18px_35px_rgba(0,0,0,0.25)]
               sm:px-6 lg:hidden"
    >

        <div
            class="mx-auto flex max-w-7xl
                   flex-col gap-1"
        >

            @foreach($navigation as [$label, $routeName])

                @if(Route::has($routeName))

                    @php
                        $active = $isActive($routeName);
                    @endphp

                    <a
                        href="{{ route($routeName) }}"
                        @if($active) aria-current="page" @endif
                        class="flex min-h-12 items-center
                               justify-between rounded-xl
                               px-4 py-3 text-sm font-semibold
                               transition-colors duration-200
                               {{ $active
                                   ? 'border-l-[3px] border-[#D60927] bg-[#D60927]/15 text-white'
                                   : 'border-l-[3px] border-transparent text-[#E5E7EB] hover:bg-white/10 hover:text-white' }}"
                    >

                        <span>{{ $label }}</span>

                        @if($active)
                            <span
                                class="h-2 w-2 rounded-full
                                       bg-[#D60927]"
                                aria-hidden="true"
                            ></span>
                        @endif

                    </a>

                @endif

            @endforeach


            {{-- MOBILE CTA --}}
            @if(Route::has('services.index'))
                <a
                    href="{{ route('services.index') }}"
                    class="mt-3 flex min-h-12
                           items-center justify-center
                           rounded-xl bg-[#D60927]
                           px-5 py-3
                           text-sm font-bold text-white
                           transition duration-200
                           hover:bg-[#A60820]"
                >
                    Explore Our Services
                    <span class="ml-2" aria-hidden="true">→</span>
                </a>
            @endif

        </div>

    </nav>

    {{-- SUBTLE BRAND ACCENT LINE --}}
    <div
        class="h-[2px] w-full
               bg-gradient-to-r
               from-transparent
               via-[#D60927]/70
               to-transparent"
        aria-hidden="true"
    ></div>

</header>


{{-- ============================================================
    MOBILE NAVIGATION JAVASCRIPT
    Existing functionality preserved
============================================================ --}}

<script>
(function () {

    function initFrontendMenu() {

        const toggle = document.getElementById(
            'frontendMenuToggle'
        );

        const menu = document.getElementById(
            'frontendMobileMenu'
        );

        const openIcon = document.getElementById(
            'frontendMenuOpenIcon'
        );

        const closeIcon = document.getElementById(
            'frontendMenuCloseIcon'
        );

        if (
            !toggle ||
            !menu ||
            toggle.dataset.initialized === 'true'
        ) {
            return;
        }

        toggle.dataset.initialized = 'true';

        function setMenuState(open) {

            menu.classList.toggle('hidden', !open);

            openIcon?.classList.toggle(
                'hidden',
                open
            );

            closeIcon?.classList.toggle(
                'hidden',
                !open
            );

            toggle.setAttribute(
                'aria-expanded',
                String(open)
            );

            toggle.setAttribute(
                'aria-label',
                open
                    ? 'Close navigation menu'
                    : 'Open navigation menu'
            );
        }

        // Toggle mobile menu
        toggle.addEventListener(
            'click',
            function () {

                const isOpen =
                    toggle.getAttribute('aria-expanded')
                    === 'true';

                setMenuState(!isOpen);
            }
        );

        // Close with Escape
        document.addEventListener(
            'keydown',
            function (event) {

                if (event.key === 'Escape') {
                    setMenuState(false);
                }
            }
        );

        // Close on outside click
        document.addEventListener(
            'click',
            function (event) {

                if (
                    !toggle.contains(event.target) &&
                    !menu.contains(event.target)
                ) {
                    setMenuState(false);
                }
            }
        );

        // Close when a menu link is clicked
        menu.querySelectorAll('a').forEach(
            function (link) {

                link.addEventListener(
                    'click',
                    function () {
                        setMenuState(false);
                    }
                );
            }
        );

        // Close on desktop breakpoint
        window.addEventListener(
            'resize',
            function () {

                if (window.innerWidth >= 1024) {
                    setMenuState(false);
                }
            }
        );
    }

    if (document.readyState === 'loading') {

        document.addEventListener(
            'DOMContentLoaded',
            initFrontendMenu
        );

    } else {

        initFrontendMenu();
    }

})();
</script>
