@extends('frontend.layouts.app')

@section('title', 'Contact Us | KUTZ Salon')

@section('content')

    <!-- <x-frontend.page-hero
                eyebrow="GET IN TOUCH"
                title="Looking to Get Beautified?"
                description="Have a question about salon services, academy courses or appointments? Our team would love to hear from you."
                :image="$branches->first()?->image ? asset('storage/'.$branches->first()->image) : null"
                cta="Send a Message"
                href="#contact-form"
            /> -->


    {{-- =========================================================
    KUTZ SALON — CONTACT PAGE HERO

    Desktop / Laptop / Tablet: location/loc1.png
    Mobile: location/loc2.png

    Desktop: Left text overlay
    Mobile: Bottom text overlay
    No CTA button
    Responsive from 320px
    ========================================================= --}}

    <section id="contact-hero" class="relative isolate w-full overflow-hidden bg-[#FFF2F4]"
        aria-labelledby="contact-hero-heading">

        {{-- RESPONSIVE BACKGROUND IMAGES --}}
        <div class="absolute inset-0 -z-20">

            <picture class="block h-full w-full">

                {{-- MOBILE IMAGE --}}
                <source media="(max-width: 767px)" srcset="{{ asset('assets/images/location/loc2.png') }}">

                {{-- DESKTOP / LAPTOP / TABLET IMAGE --}}
                <img src="{{ asset('assets/images/location/loc1.png') }}" alt="KUTZZ Salon contact and beauty experience"
                    fetchpriority="high" decoding="async" class="block h-full w-full object-cover object-center">

            </picture>

        </div>


        {{-- DESKTOP LEFT GRADIENT --}}
        <div class="pointer-events-none absolute inset-0 -z-10
                           hidden bg-gradient-to-r
                           from-[#FFF2F4]/90
                           via-[#FFF2F4]/55
                           to-transparent
                           md:block" aria-hidden="true"></div>


        {{-- MOBILE BOTTOM GRADIENT --}}
        <div class="pointer-events-none absolute inset-0 -z-10
                           bg-gradient-to-t
                           from-[#FFF2F4]/95
                           via-[#FFF2F4]/50
                           to-transparent
                           md:hidden" aria-hidden="true"></div>


        {{-- HERO CONTENT CONTAINER --}}
        <div class="relative mx-auto flex
                           min-h-[560px] w-full max-w-7xl
                           items-end px-5 pb-12 pt-12

                           min-[375px]:min-h-[610px]
                           min-[375px]:pb-14

                           sm:min-h-[680px]
                           sm:px-8 sm:pb-16

                           md:min-h-[430px]
                           md:items-center
                           md:px-8 md:py-16

                           lg:min-h-[540px]
                           lg:px-10 lg:py-20

                           xl:min-h-[620px]">

            {{-- TEXT OVERLAY --}}
            <div class="relative z-10
                               w-full max-w-[580px]
                               text-center md:text-left">

                {{-- EYEBROW --}}
                <div class="mb-5 flex items-center
                                   justify-center gap-3
                                   md:justify-start">

                    <span class="h-px w-7 bg-brand"></span>

                    <p class="text-[10px] font-bold
                                       uppercase tracking-[0.24em]
                                       text-brand sm:text-xs">
                        GET IN TOUCH
                    </p>

                    <span class="h-px w-7 bg-brand"></span>

                </div>


                {{-- MAIN HEADING --}}
                <h1 id="contact-hero-heading" class="font-heading
                                   text-[34px] font-bold
                                   leading-[1.15]
                                   tracking-tight text-[#171717]

                                   min-[375px]:text-[40px]
                                   sm:text-[49px]
                                   md:text-[44px]
                                   lg:text-[58px]
                                   xl:text-[66px]">
                    Looking to Get

                    <span class="mt-1 block font-serif
                                       text-[40px] font-normal
                                       italic leading-[1.12]
                                       text-brand

                                       min-[375px]:text-[47px]
                                       sm:text-[59px]
                                       md:text-[54px]
                                       lg:text-[70px]
                                       xl:text-[78px]">
                        Beautified?
                    </span>

                </h1>


                {{-- DESCRIPTION --}}
                <p class="mx-auto mt-5 max-w-[470px]
                                   text-[13px] leading-7
                                   text-slate-700

                                   sm:mt-6 sm:text-base
                                   sm:leading-8

                                   md:mx-0">
                    Have a question about salon services,
                    academy courses or appointments?
                    Our team would love to hear from you.
                </p>

                {{-- NO HERO BUTTON --}}

            </div>

        </div>

    </section>


    <section id="contact-form" class="scroll-mt-24 bg-[#FBEFF1] px-4 py-16 sm:px-6 lg:py-20">
        <div class="mx-auto max-w-7xl">

            <div class="grid gap-6 lg:grid-cols-2">

                {{-- CONTACT FORM --}}
                <div class="rounded-[1.5rem] border border-rose-100 bg-white p-6 shadow-sm sm:p-9">
                    <p class="text-xs font-bold uppercase tracking-widest text-brand">
                        CONTACT KUTZZ SALON
                    </p>

                    <h2 class="mt-3 font-heading text-3xl font-bold">
                        Send Us a Message
                    </h2>

                    <p class="mt-3 text-sm leading-7 text-slate-500">
                        Fill out the form and our team will get back to you.
                    </p>

                    @if(session('success'))
                        <div role="status"
                            class="mt-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div role="alert" class="mt-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                            <p class="font-bold">Please correct the following:</p>
                            <ul class="mt-2 list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="mt-7 space-y-5">
                        @csrf

                        <div class="hidden" aria-hidden="true">
                            <label for="website">Website</label>
                            <input id="website" type="text" name="website" tabindex="-1" autocomplete="off">
                        </div>

                        <div>
                            <label for="name" class="mb-2 block text-sm font-semibold">
                                Your Name *
                            </label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required maxlength="255"
                                autocomplete="name" placeholder="Enter your full name"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-brand focus:ring-2 focus:ring-rose-100">
                        </div>

                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label for="phone" class="mb-2 block text-sm font-semibold">
                                    Mobile Number *
                                </label>
                                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" required maxlength="20"
                                    autocomplete="tel" placeholder="Mobile number"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-brand focus:ring-2 focus:ring-rose-100">
                            </div>

                            <div>
                                <label for="email" class="mb-2 block text-sm font-semibold">
                                    Email Address
                                </label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" maxlength="255"
                                    autocomplete="email" placeholder="Email address"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-brand focus:ring-2 focus:ring-rose-100">
                            </div>
                        </div>

                        <div>
                            <label for="type" class="mb-2 block text-sm font-semibold">
                                Enquiry Type *
                            </label>
                            <select id="type" name="type" required
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-brand focus:ring-2 focus:ring-rose-100">
                                @foreach([
                                        'general' => 'General Enquiry',
                                        'service' => 'Salon Service',
                                        'academy' => 'Academy Course',
                                        'bridal' => 'Bridal Makeup',
                                        'other' => 'Other'
                                    ] as $value => $label)
                                    <option value="{{ $value }}" @selected(old('type') === $value)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="message" class="mb-2 block text-sm font-semibold">
                                Your Message *
                            </label>
                            <textarea id="message" name="message" rows="5" maxlength="5000" required
                                placeholder="How can we help you?"
                                class="w-full resize-y rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-brand focus:ring-2 focus:ring-rose-100">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit"
                            class="inline-flex min-h-12 w-full items-center justify-center rounded-xl bg-brand px-7 py-3 text-sm font-bold text-white transition hover:bg-brand-dark sm:w-auto">
                            Send Message →
                        </button>
                    </form>
                </div>

                {{-- CONTACT INFORMATION --}}
                <div class="space-y-6">

                    <div class="rounded-[1.5rem] border border-rose-100 bg-white p-6 shadow-sm sm:p-9">
                        <p class="text-xs font-bold uppercase tracking-widest text-brand">
                            VISIT OUR SALON
                        </p>

                        <h2 class="mt-3 font-heading text-3xl font-bold">
                            Contact Information
                        </h2>

                        @forelse($branches as $branch)
                            <div class="mt-6 border-b border-slate-100 pb-6 last:border-0 last:pb-0">
                                <h3 class="font-heading text-lg font-bold text-slate-950">
                                    {{ $branch->name }}
                                </h3>

                                <p class="mt-2 text-sm leading-7 text-slate-600">
                                    {{ $branch->address }},
                                    {{ $branch->city }},
                                    {{ $branch->state }}
                                    {{ $branch->pincode }}
                                </p>

                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $branch->phone) }}"
                                    class="mt-3 inline-flex text-sm font-bold text-brand">
                                    ☎ {{ $branch->phone }}
                                </a>

                                @if($branch->email)
                                    <p class="mt-2 break-all text-sm text-slate-600">
                                        {{ $branch->email }}
                                    </p>
                                @endif

                                @if($branch->opening_time && $branch->closing_time)
                                    <p class="mt-2 text-sm text-slate-600">
                                        Hours: {{ substr($branch->opening_time, 0, 5) }}
                                        – {{ substr($branch->closing_time, 0, 5) }}
                                    </p>
                                @endif

                                @if($branch->google_maps_url)
                                    <a href="{{ $branch->google_maps_url }}" target="_blank" rel="noopener noreferrer"
                                        class="mt-3 inline-flex rounded-lg bg-brand-light px-4 py-2 text-xs font-bold text-brand">
                                        Open in Google Maps →
                                    </a>
                                @endif
                            </div>
                        @empty
                            <p class="mt-5 text-sm text-slate-500">
                                Contact information will be updated soon.
                            </p>
                        @endforelse
                    </div>

                    <div class="rounded-[1.5rem] bg-gradient-to-br from-[#A60820] to-[#D60927] p-8 text-white">
                        <h3 class="font-heading text-2xl font-bold">
                            Your Beauty Journey Starts Here
                        </h3>

                        <p class="mt-3 text-sm leading-7 text-rose-50">
                            Get in touch for salon services, bridal beauty and professional academy training.
                        </p>
                    </div>

                </div>
            </div>

            {{-- BRANCH LOCATIONS --}}

        </div>
    </section>


    {{-- =========================================================
    KUTZ SALON — GOOGLE MAP LOCATION SECTION
    Location: Durg, Chhattisgarh
    Fully Responsive: Mobile / Tablet / Desktop
    ========================================================= --}}

    <section id="salon-location" class="bg-white px-4 py-16 sm:px-6 lg:py-20" aria-labelledby="location-heading">

        <div class="mx-auto max-w-7xl">

            {{-- SECTION HEADING --}}
            <div class="mx-auto max-w-2xl text-center">

                <p class="text-xs font-bold uppercase tracking-[0.22em] text-brand">
                    FIND OUR SALON
                </p>

                <h2 id="location-heading" class="mt-3 font-heading text-3xl font-bold text-slate-950 sm:text-4xl">
                    Visit Our
                    <span class="text-brand">Durg Branch</span>
                </h2>

                <p class="mt-4 text-sm leading-7 text-slate-600 sm:text-base">
                    Your beauty destination is just a visit away.
                    Find us easily using the map below.
                </p>

            </div>


            {{-- MAP + LOCATION DETAILS --}}
            <div class="mt-10 grid overflow-hidden rounded-[1.5rem]
                       border border-rose-100 bg-white shadow-lg
                       lg:grid-cols-[minmax(0,1.65fr)_minmax(300px,1fr)]">

                {{-- GOOGLE MAP EMBED --}}
                <div class="relative h-[300px] min-w-0
                           bg-slate-100
                           sm:h-[400px]
                           lg:h-[460px]">

                    <iframe title="Google Maps — KUTZZ Salon Durg Branch"
                        src="https://www.google.com/maps?q=1st%20Floor%2C%20Shanti%20Fitness%20Building%2C%20Station%20Road%2C%20New%20Deepak%20Nagar%2C%20Durg%2C%20Chhattisgarh%20491001&output=embed"
                        width="100%" height="100%" style="border:0;" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" allowfullscreen
                        class="absolute inset-0 h-full w-full"></iframe>

                </div>


                {{-- ADDRESS INFORMATION --}}
                <div class="flex min-w-0 flex-col justify-center
                           bg-[#FFF7F8] p-6
                           sm:p-8 lg:p-10">

                    {{-- LOCATION ICON --}}
                    <div class="flex h-14 w-14 items-center justify-center
                               rounded-2xl bg-[#FFE3E8] text-brand">

                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                            aria-hidden="true">
                            <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z" />
                            <circle cx="12" cy="10" r="2.5" />
                        </svg>

                    </div>


                    {{-- BRANCH NAME --}}
                    <h3 class="mt-6 font-heading text-2xl font-bold text-slate-950">
                        KUTZZ Salon — Durg
                    </h3>

                    <p class="mt-2 text-xs font-bold uppercase tracking-widest text-brand">
                        Our Salon Location
                    </p>


                    {{-- ADDRESS --}}
                    <address class="mt-5 text-sm not-italic leading-8 text-slate-600">
                        1st Floor, Shanti Fitness Building,<br>
                        Station Road, opp. Gurudwara Road,<br>
                        above Domino’s, New Deepak Nagar,<br>
                        Durg, Chhattisgarh — 491001
                    </address>


                    {{-- DIVIDER --}}
                    <div class="my-6 h-px w-full bg-rose-200"></div>


                    
                    


                    {{-- GOOGLE MAPS DIRECTIONS BUTTON --}}
                    <a href="https://www.google.com/maps/search/?api=1&amp;query=1st%20Floor%2C%20Shanti%20Fitness%20Building%2C%20Station%20Road%2C%20opp.%20Gurudwara%20Road%2C%20above%20Domino%27s%2C%20New%20Deepak%20Nagar%2C%20Durg%2C%20Chhattisgarh%20491001"
                        target="_blank" rel="noopener noreferrer" class="mt-8 inline-flex min-h-12 w-full
                               items-center justify-center gap-2
                               rounded-xl bg-brand px-6 py-3
                               text-center text-sm font-bold text-white
                               transition duration-300 hover:bg-brand-dark">
                        Get Directions

                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            aria-hidden="true">
                            <path d="M7 17 17 7" />
                            <path d="M7 7h10v10" />
                        </svg>

                    </a>

                </div>

            </div>

        </div>

    </section>


@endsection