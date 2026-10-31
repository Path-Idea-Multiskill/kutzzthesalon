<aside id="adminSidebar" aria-label="Admin navigation" class="fixed inset-y-0 left-0 z-50
           flex h-dvh w-[min(280px,85vw)] flex-col
           -translate-x-full
           border-r border-slate-200
           bg-white/95 shadow-2xl backdrop-blur-xl
           transition-transform duration-300 ease-in-out
           lg:sticky lg:top-0 lg:z-30 lg:h-screen
           lg:w-64 lg:shrink-0 lg:translate-x-0
           lg:shadow-none">

    <!-- Logo and Close Button -->
    <div class="flex items-center justify-between
                border-b border-slate-100 px-5 py-5">

        <!-- <div>
            <h2 class="font-heading text-2xl font-bold
                       text-brand">
                KUTZ
            </h2>

            <p class="text-xs text-slate-500">
                Salon Management
            </p>
        </div> -->

        <img src="{{ asset('assets/images/kutz-logo.png') }}" alt="KUTZ The Salon Logo"
            class="block h-auto w-[115px] max-w-full object-contain sm:w-[135px] lg:w-[150px]" loading="eager"
            decoding="async">


        <!-- Mobile Close -->
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
    </div>

    <!-- Menu Items -->
    <nav class="flex-1 space-y-1 overflow-y-auto
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
    <div class="mt-auto shrink-0 border-t border-slate-100 p-4">

        {{-- MOBILE & TABLET ONLY: LOGOUT --}}
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

        {{-- EXISTING SIDEBAR FOOTER --}}
        <div class="rounded-xl bg-brand-light p-3">

            <p class="text-sm font-semibold text-brand">
                Kutz Salon
            </p>

            <p class="text-xs text-slate-500">
                Admin Management Panel
            </p>

        </div>

    </div>


</aside>