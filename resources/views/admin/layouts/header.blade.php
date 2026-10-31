<header class="sticky top-0 z-30
               border-b border-slate-200
               bg-white/90 backdrop-blur-xl">

    <div class="flex min-h-16 items-center
                justify-between gap-2
                px-3 sm:px-6 lg:px-8">

        <!-- LEFT SIDE -->
        <div class="flex min-w-0 items-center gap-2 sm:gap-3">

            <!-- Mobile Hamburger -->
            <button type="button" id="menuToggle" aria-label="Open navigation menu" aria-controls="adminSidebar"
                aria-expanded="false" class="flex h-11 w-11 shrink-0
                       items-center justify-center
                       rounded-xl border border-slate-200
                       bg-white text-brand
                       hover:bg-brand-light
                       lg:hidden">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round">

                    <path d="M4 6h16" />
                    <path d="M4 12h16" />
                    <path d="M4 18h16" />

                </svg>

            </button>

            <!-- Header Title: Hidden on Mobile, Visible on Tablet & Desktop -->
            <div class="hidden min-w-0 sm:block">

                <h1 class="truncate font-heading
               text-sm font-semibold
               text-slate-900
               sm:text-lg">
                    Admin Dashboard
                </h1>

                <p class="hidden text-xs text-slate-500 sm:block">
                    Kutzz Salon Management
                </p>

            </div>

        </div>

        <!-- RIGHT SIDE -->
        <!-- <div class="flex shrink-0 items-center gap-2 sm:gap-3">

           
            <div class="hidden h-10 w-10 items-center
                        justify-center rounded-full
                        bg-brand-light font-bold
                        text-brand sm:flex">
                K
            </div>

            
            <form method="POST"
                  action="{{ route('admin.logout') }}">

                @csrf

                <button
                    type="submit"
                    title="Logout"
                    aria-label="Logout"
                    class="inline-flex min-h-11 items-center
                           justify-center gap-2 rounded-xl
                           border border-red-200 bg-red-50
                           px-3 py-2 text-sm font-semibold
                           text-brand transition-colors
                           hover:bg-red-100 sm:px-4">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         width="18" height="18"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round">

                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>

                    </svg>

                    <span class="hidden min-[375px]:inline">
                        Logout
                    </span>

                </button>
            </form>

        </div> -->


        <!-- RIGHT SIDE -->
        <div class="flex shrink-0 items-center gap-2 sm:gap-3">

            {{-- MOBILE & TABLET: COMPANY LOGO --}}
            <a href="{{ route('admin.dashboard') }}" class="flex h-11 w-[100px] shrink-0 items-center
               justify-end overflow-hidden
               sm:w-[125px] lg:hidden" aria-label="KUTZZ Salon Admin Dashboard">
                <img src="{{ asset('assets/images/kutz-logo.png') }}" alt="KUTZZ The Salon Logo"
                    class="block max-h-11 w-full object-contain object-right" loading="eager" decoding="async">
            </a>

            {{-- DESKTOP ONLY: ADMIN PROFILE ICON --}}
            <div class="hidden h-10 w-10 items-center
               justify-center rounded-full
               bg-brand-light font-bold
               text-brand lg:flex">
                K
            </div>

            {{-- DESKTOP ONLY: LOGOUT BUTTON --}}
            <form method="POST" action="{{ route('admin.logout') }}" class="hidden lg:block">
                @csrf

                <button type="submit" title="Logout" aria-label="Logout" class="inline-flex min-h-11 items-center
                   justify-center gap-2 rounded-xl
                   border border-red-200 bg-red-50
                   px-3 py-2 text-sm font-semibold
                   text-brand transition-colors
                   hover:bg-red-100 sm:px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        aria-hidden="true">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>

                    <span>Logout</span>
                </button>
            </form>

        </div>


    </div>

</header>