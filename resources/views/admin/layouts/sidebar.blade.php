<!-- <aside id="adminSidebar" aria-label="Admin navigation" class="fixed inset-y-0 left-0 z-50
           flex h-dvh w-[min(280px,85vw)] flex-col
           -translate-x-full
           border-r border-slate-200
           bg-white/95 shadow-2xl backdrop-blur-xl
           transition-transform duration-300 ease-in-out
           lg:sticky lg:top-0 lg:z-30 lg:h-screen
           lg:w-64 lg:shrink-0 lg:translate-x-0
           lg:shadow-none"> -->

<aside id="adminSidebar" aria-label="Admin navigation" class="fixed inset-y-0 left-0 z-50
           flex h-dvh w-[min(280px,85vw)] flex-col
           -translate-x-full
           border-r border-white/10
           bg-black text-white
           shadow-2xl
           transition-transform duration-300 ease-in-out
           lg:sticky lg:top-0 lg:z-30 lg:h-screen
           lg:w-64 lg:shrink-0 lg:translate-x-0
           lg:shadow-none">

    <!-- Logo and Close Button -->
    <!-- <div class="flex items-center justify-between
                border-b border-slate-100 px-5 py-5">

        

        <img src="{{ asset('assets/images/kutz-logo.png') }}" alt="KUTZZ The Salon Logo"
            class="block h-auto w-[115px] max-w-full object-contain sm:w-[135px] lg:w-[150px]" loading="eager"
            decoding="async">


       
        <button type="button" id="closeSidebar" aria-label="Close navigation menu" class="flex h-10 w-10 items-center
                   justify-center rounded-xl
                   bg-brand-light text-brand
                   lg:hidden">

            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18" />
                <path d="m6 6 12 12" />
            </svg>

        </button>
    </div> -->
    {{-- LOGO SECTION --}}
    <div class="flex items-center justify-between
            gap-3 border-b border-white/10
            bg-black px-5 py-5">

        <img src="{{ asset('assets/images/kutz-logo.png') }}" alt="KUTZZ The Salon Logo" class="block h-auto w-[110px] max-w-full
               object-contain
               sm:w-[125px] lg:w-[140px]" loading="eager" decoding="async">

        {{-- MOBILE CLOSE BUTTON --}}
        <button type="button" id="closeSidebar" aria-label="Close navigation menu" class="flex h-10 w-10 shrink-0
               items-center justify-center
               rounded-xl border border-white/20
               bg-white/10 text-white
               transition duration-200
               hover:border-[#D60927]
               hover:bg-[#D60927]
               lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                aria-hidden="true">
                <path d="M18 6 6 18" />
                <path d="m6 6 12 12" />
            </svg>
        </button>

    </div>
    <!-- Menu Items -->
    <!-- <nav class="flex-1 space-y-1 overflow-y-auto
                px-3 py-5">

        @php
            $menu = [
                ['Dashboard', 'admin.dashboard'],
                //['Pages', 'admin.pages.index'],
                ['Services', 'admin.services.index'],
                ['Gallery', 'admin.gallery-images.index'],
                ['Videos', 'admin.videos.index'],
                ['Academy', 'admin.academy-courses.index'],
                ['Blogs', 'admin.blogs.index'],
                ['Appointments', 'admin.appointments.index'],
                ['Enquiries', 'admin.enquiries.index'],
                ['Branches', 'admin.branches.index'],
                ['Settings', 'admin.settings.index'],
            ];
        @endphp

        @foreach($menu as [$label, $routeName])

            @if($routeName)
                <a href="{{ route($routeName) }}" class="flex min-h-11 items-center
                                                                                                                          rounded-xl px-4 py-3
                                                                                                                          text-sm font-medium
                                                                                                                          transition-colors
                                                                                                                          {{ request()->routeIs($routeName)
                    ? 'bg-brand text-white shadow-sm'
                    : 'text-slate-600 hover:bg-brand-light hover:text-brand' }}">

                    {{ $label }}

                </a>
            @else
                <span
                    class="flex min-h-11 items-center
                                                                                                                             rounded-xl px-4 py-3
                                                                                                                             text-sm text-slate-400">

                    {{ $label }}

                </span>
            @endif

        @endforeach

    </nav> -->

    {{-- SIDEBAR MENU --}}
    <nav class="flex-1 space-y-1 overflow-y-auto
            px-3 py-5">

        @php
            $menu = [
                ['Dashboard', 'admin.dashboard'],
                // ['Pages', 'admin.pages.index'],
                ['Services', 'admin.services.index'],
                ['Gallery', 'admin.gallery-images.index'],
                ['Videos', 'admin.videos.index'],
                ['Academy', 'admin.academy-courses.index'],
                ['Blogs', 'admin.blogs.index'],
                ['Appointments', 'admin.appointments.index'],
                ['Enquiries', 'admin.enquiries.index'],
                ['Branches', 'admin.branches.index'],
                ['Settings', 'admin.settings.index'],
            ];
        @endphp

        @foreach($menu as [$label, $routeName])

            @if($routeName)

                <a href="{{ route($routeName) }}" @if(request()->routeIs($routeName)) aria-current="page" @endif
                    class="group flex min-h-11 items-center
                                       gap-3 rounded-xl
                                       border-l-[3px] px-4 py-3
                                       text-sm font-medium
                                       transition-all duration-200
                                       {{ request()->routeIs($routeName)
                    ? 'border-[#D60927] bg-[#D60927] text-white shadow-[0_4px_16px_rgba(214,9,39,0.25)]'
                    : 'border-transparent text-[#E5E7EB] hover:border-[#D60927] hover:bg-white/10 hover:text-white' }}">
                    <span class="h-1.5 w-1.5 shrink-0 rounded-full
                                           {{ request()->routeIs($routeName)
                    ? 'bg-white'
                    : 'bg-[#D60927] group-hover:bg-[#FF6579]' }}" aria-hidden="true"></span>

                    <span>{{ $label }}</span>
                </a>

            @else

                <span class="flex min-h-11 items-center
                                       rounded-xl px-4 py-3
                                       text-sm text-gray-500">
                    {{ $label }}
                </span>

            @endif

        @endforeach

    </nav>

    <!-- Sidebar Footer -->
    <!-- <div class="border-t border-slate-100 p-4">
        <div class="rounded-xl bg-brand-light p-3">
            <p class="text-sm font-semibold text-brand">
                Kutz Salon
            </p>
            <p class="text-xs text-slate-500">
                Admin Management Panel
            </p>
        </div>
    </div> -->


    <!-- SIDEBAR FOOTER -->
    <!-- <div class="mt-auto shrink-0 border-t border-slate-100 p-4">

        
        <form method="POST" action="{{ route('admin.logout') }}" class="mb-3 lg:hidden">
            @csrf

            <button type="submit" class="flex min-h-12 w-full items-center
                   justify-center gap-3
                   rounded-xl border border-red-200
                   bg-red-50 px-4 py-3
                   text-sm font-bold text-brand
                   transition-colors duration-200
                   hover:bg-red-100
                   active:bg-red-200" aria-label="Logout from admin panel">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    aria-hidden="true">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>

                <span>Logout</span>
            </button>
        </form>

        
        <div class="rounded-xl bg-brand-light p-3">

            <p class="text-sm font-semibold text-brand">
                Kutzz Salon
            </p>

            <p class="text-xs text-slate-500">
                Admin Management Panel
            </p>

        </div>

    </div> -->

    {{-- SIDEBAR FOOTER --}}
    <div class="mt-auto shrink-0
            border-t border-white/10 p-4">

        {{-- MOBILE & TABLET LOGOUT --}}
        <form method="POST" action="{{ route('admin.logout') }}" class="mb-3 lg:hidden">
            @csrf

            <button type="submit" aria-label="Logout from admin panel" class="flex min-h-12 w-full
                   items-center justify-center gap-3
                   rounded-xl border border-[#D60927]
                   bg-[#D60927] px-4 py-3
                   text-sm font-bold text-white
                   transition duration-200
                   hover:bg-[#A60820]">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    aria-hidden="true">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>

                <span>Logout</span>
            </button>
        </form>

        {{-- BRAND INFORMATION --}}
        <div class="rounded-xl border border-[#D60927]/25
               bg-[#D60927]/10 p-3">
            <p class="text-sm font-semibold text-white">
                Kutzz Salon
            </p>

            <p class="mt-1 text-xs text-[#FF8798]">
                Admin Management Panel
            </p>
        </div>

    </div>

</aside>