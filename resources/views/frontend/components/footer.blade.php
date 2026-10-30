
{{-- =========================================================
    KUTZ SALON — PREMIUM RESPONSIVE FOOTER
    Laravel Blade + Tailwind CSS

    Desktop: 4 columns
    Tablet: 2 columns
    Mobile: 1 column (320px supported)

    Theme:
    Brand Red: #D60927
    Dark Red: #A60820
    Light Pink: #FFF2F4
========================================================= --}}

@php
    /*
    |--------------------------------------------------------------------------
    | Footer Navigation
    |--------------------------------------------------------------------------
    | Routes are checked before generating links.
    | Update route names if your project uses different names.
    */

    $footerMenus = [
        ['label' => 'Home', 'route' => 'home', 'url' => '/'],
        ['label' => 'About Us', 'route' => 'about', 'url' => '/about'],
        ['label' => 'Services', 'route' => 'services.index', 'url' => '/services'],
        ['label' => 'Gallery', 'route' => 'gallery.index', 'url' => '/gallery'],
        ['label' => 'Academy', 'route' => 'academy.index', 'url' => '/academy'],
        ['label' => 'Blogs', 'route' => 'blogs.index', 'url' => '/blogs'],
        ['label' => 'Contact Us', 'route' => 'contact', 'url' => '/contact'],
    ];

    $footerBranches = [
        [
            'name' => 'KUTZ Salon — Durg',
            'address' => '1st Floor, Shanti Fitness Building, Station Road, opp. Gurudwara Road, above Domino’s, New Deepak Nagar, Durg, Chhattisgarh 491001',
            'map' => 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode('1st Floor Shanti Fitness Building Station Road New Deepak Nagar Durg Chhattisgarh 491001'),
        ],
        [
            'name' => 'KUTZ Salon — Bhilai',
            'address' => '71/3, Nehru Nagar East, Vidya Vihar Colony, Bhilai, Nehru Nagar, Chhattisgarh 490020',
            'map' => 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode('71/3 Nehru Nagar East Vidya Vihar Colony Bhilai Chhattisgarh 490020'),
        ],
    ];

    $footerPhones = [
        ['display' => '76469 45027', 'number' => '+917646945027'],
        ['display' => '88717 30637', 'number' => '+918871730637'],
    ];
@endphp

<footer class="w-full overflow-hidden bg-[#FFF7F9] text-[#171717]">

    {{-- =====================================================
        MAIN FOOTER
    ===================================================== --}}

    <div class="mx-auto max-w-7xl px-4 pb-12 pt-14 sm:px-6 sm:pt-16 lg:px-8 lg:pb-16 lg:pt-20">

        <div class="grid grid-cols-1 gap-x-8 gap-y-12 sm:grid-cols-2 lg:grid-cols-12 lg:gap-x-10">

            {{-- =================================================
                COLUMN 1 — BRAND INFORMATION
            ================================================= --}}

            <div class="min-w-0 lg:col-span-3">

                {{-- BRAND NAME --}}
                <a
                    href="{{ \Illuminate\Support\Facades\Route::has('home') ? route('home') : url('/') }}"
                    class="inline-flex flex-col"
                    aria-label="KUTZ Salon Home"
                >
                    <span class="font-heading text-[32px] font-extrabold leading-none tracking-tight text-[#171717]">
                        KUTZ<span class="text-brand">.</span>
                    </span>

                    <span class="mt-2 text-[10px] font-semibold uppercase tracking-[0.28em] text-brand">
                        THE SALON & ACADEMY
                    </span>
                </a>

                {{-- BRAND DESCRIPTION --}}
                <p class="mt-6 max-w-sm text-sm leading-8 text-slate-600">
                    Discover the art of beauty at KUTZ Salon.
                    From professional hairstyling and makeup
                    to personalized beauty treatments, we help
                    you look beautiful and feel confident.
                </p>

                {{-- SOCIAL MEDIA --}}
                <div class="mt-6 flex flex-wrap items-center gap-3">

                    {{-- INSTAGRAM --}}
                    <a
                        href="https://www.instagram.com/kutzzthesalonandacademy/"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="KUTZ Salon Instagram"
                        class="flex h-11 w-11 items-center justify-center rounded-full border border-rose-200 bg-white text-brand transition duration-300 hover:-translate-y-1 hover:border-brand hover:bg-brand hover:text-white"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="19" height="19"
                             viewBox="0 0 24 24"
                             fill="none" stroke="currentColor"
                             stroke-width="1.8"
                             stroke-linecap="round"
                             stroke-linejoin="round"
                             aria-hidden="true">
                            <rect x="2" y="2" width="20" height="20" rx="5"/>
                            <circle cx="12" cy="12" r="4"/>
                            <path d="M17.5 6.5h.01"/>
                        </svg>
                    </a>

                    {{-- WHATSAPP --}}
                    <a
                        href="https://wa.me/917646945027"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Chat with KUTZ Salon on WhatsApp"
                        class="flex h-11 w-11 items-center justify-center rounded-full border border-rose-200 bg-white text-brand transition duration-300 hover:-translate-y-1 hover:border-brand hover:bg-brand hover:text-white"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="19" height="19"
                             viewBox="0 0 24 24"
                             fill="none" stroke="currentColor"
                             stroke-width="1.8"
                             stroke-linecap="round"
                             stroke-linejoin="round"
                             aria-hidden="true">
                            <path d="M21 11.5a8.5 8.5 0 0 1-12.4 7.5L3 21l2-5.6A8.5 8.5 0 1 1 21 11.5Z"/>
                            <path d="M9 8.5c.5 2.5 2.5 4.5 5 5l1.5-1.5 2 1-1 2c-4.5 1-9.5-4-8.5-8.5l2-1 1 2L9 8.5Z"/>
                        </svg>
                    </a>

                </div>

            </div>


            {{-- =================================================
                COLUMN 2 — QUICK LINKS
            ================================================= --}}

            <div class="min-w-0 lg:col-span-2">

                <h3 class="font-heading text-lg font-bold text-[#171717]">
                    Quick Links
                </h3>

                <div class="mt-3 h-[3px] w-10 rounded-full bg-brand"></div>

                <ul class="mt-6 space-y-3.5">

                    @foreach($footerMenus as $menu)

                        @php
                            $footerUrl = \Illuminate\Support\Facades\Route::has($menu['route'])
                                ? route($menu['route'])
                                : url($menu['url']);
                        @endphp

                        <li>
                            <a
                                href="{{ $footerUrl }}"
                                class="group inline-flex items-center gap-2 text-sm text-slate-600 transition duration-200 hover:translate-x-1 hover:text-brand"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="14" height="14"
                                     viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor"
                                     stroke-width="2"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="shrink-0 text-brand"
                                     aria-hidden="true">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>

                                {{ $menu['label'] }}
                            </a>
                        </li>

                    @endforeach

                </ul>

            </div>


            {{-- =================================================
                COLUMN 3 — OUR BRANCHES
            ================================================= --}}

            <div class="min-w-0 lg:col-span-4">

                <h3 class="font-heading text-lg font-bold text-[#171717]">
                    Our Branches
                </h3>

                <div class="mt-3 h-[3px] w-10 rounded-full bg-brand"></div>

                <div class="mt-6 space-y-6">

                    @foreach($footerBranches as $branch)

                        <div class="flex min-w-0 items-start gap-3">

                            {{-- LOCATION ICON --}}
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#FFE5E9] text-brand">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="19" height="19"
                                     viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor"
                                     stroke-width="1.8"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     aria-hidden="true">
                                    <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>
                                    <circle cx="12" cy="10" r="2.5"/>
                                </svg>

                            </span>

                            <div class="min-w-0 flex-1">

                                <h4 class="text-sm font-bold text-slate-900">
                                    {{ $branch['name'] }}
                                </h4>

                                <p class="mt-2 break-words text-[13px] leading-6 text-slate-600">
                                    {{ $branch['address'] }}
                                </p>

                                <a
                                    href="{{ $branch['map'] }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="mt-2 inline-flex items-center gap-1 text-xs font-bold text-brand transition hover:text-brand-dark"
                                >
                                    View on Google Maps
                                    <span aria-hidden="true">↗</span>
                                </a>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>


            {{-- =================================================
                COLUMN 4 — CONTACT INFORMATION
            ================================================= --}}

            <div class="min-w-0 lg:col-span-3">

                <h3 class="font-heading text-lg font-bold text-[#171717]">
                    Get In Touch
                </h3>

                <div class="mt-3 h-[3px] w-10 rounded-full bg-brand"></div>

                <p class="mt-6 text-sm leading-7 text-slate-600">
                    Have a question or want to book an appointment?
                    Connect with our team.
                </p>


                {{-- PHONE NUMBERS --}}
                <div class="mt-6 flex items-start gap-3">

                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#FFE5E9] text-brand">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="19" height="19"
                             viewBox="0 0 24 24"
                             fill="none" stroke="currentColor"
                             stroke-width="1.8"
                             stroke-linecap="round"
                             stroke-linejoin="round"
                             aria-hidden="true">
                            <path d="M22 16.9v3a2 2 0 0 1-2.2 2A19.7 19.7 0 0 1 3.1 5.2 2 2 0 0 1 5.1 3h3a2 2 0 0 1 2 1.7l.5 3a2 2 0 0 1-.6 1.7L8.1 11a16 16 0 0 0 4.9 4.9l1.6-1.9a2 2 0 0 1 1.7-.6l3 .5a2 2 0 0 1 1.7 2Z"/>
                        </svg>

                    </span>

                    <div class="min-w-0">

                        <p class="text-sm font-bold text-slate-900">
                            Call Us
                        </p>

                        <div class="mt-2 flex flex-col gap-2">

                            @foreach($footerPhones as $phone)

                                <a
                                    href="tel:{{ $phone['number'] }}"
                                    class="text-sm text-slate-600 transition hover:text-brand"
                                >
                                    +91 {{ $phone['display'] }}
                                </a>

                            @endforeach

                        </div>

                    </div>

                </div>


                {{-- BOOK APPOINTMENT BUTTON --}}
                <a
                    href="{{ \Illuminate\Support\Facades\Route::has('contact') ? route('contact') : url('/contact') }}"
                    class="group mt-8 inline-flex min-h-12 w-full items-center justify-center gap-2 rounded-xl bg-brand px-5 py-3 text-center text-xs font-bold uppercase tracking-[0.06em] text-white shadow-md shadow-red-500/15 transition duration-300 hover:-translate-y-0.5 hover:bg-brand-dark hover:shadow-lg sm:w-auto"
                >
                    BOOK APPOINTMENT

                    <svg xmlns="http://www.w3.org/2000/svg"
                         width="17" height="17"
                         viewBox="0 0 24 24"
                         fill="none" stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         class="transition-transform group-hover:translate-x-1"
                         aria-hidden="true">
                        <path d="M5 12h14"/>
                        <path d="m12 5 7 7-7 7"/>
                    </svg>

                </a>

            </div>

        </div>

    </div>


    {{-- =====================================================
        BOTTOM FOOTER / COPYRIGHT
    ===================================================== --}}

    <div class="border-t border-rose-200/70 bg-[#FFF0F3]">

        <div
            class="mx-auto flex max-w-7xl
                   flex-col items-center justify-between
                   gap-3 px-4 py-5
                   text-center sm:px-6
                   md:flex-row md:text-left
                   lg:px-8"
        >

            <p class="text-xs leading-6 text-slate-600">
                © {{ date('Y') }} KUTZ The Salon & Academy.
                All Rights Reserved.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-2 text-xs text-slate-600">

                <a
                    href="{{ \Illuminate\Support\Facades\Route::has('home') ? route('home') : url('/') }}"
                    class="transition hover:text-brand"
                >
                    Home
                </a>

                <a
                    href="{{ \Illuminate\Support\Facades\Route::has('about') ? route('about') : url('/about') }}"
                    class="transition hover:text-brand"
                >
                    About Us
                </a>

                <a
                    href="{{ \Illuminate\Support\Facades\Route::has('contact') ? route('contact') : url('/contact') }}"
                    class="transition hover:text-brand"
                >
                    Contact
                </a>

            </div>

        </div>

    </div>

</footer>
