
@extends('frontend.layouts.app')

@section('title', 'Contact Us | KUTZ Salon')

@section('content')

<x-frontend.page-hero
    eyebrow="GET IN TOUCH"
    title="Looking to Get Beautified?"
    description="Have a question about salon services, academy courses or appointments? Our team would love to hear from you."
    :image="$branches->first()?->image ? asset('storage/'.$branches->first()->image) : null"
    cta="Send a Message"
    href="#contact-form"
/>

<section id="contact-form" class="scroll-mt-24 bg-[#FFF7F8] px-4 py-16 sm:px-6 lg:py-20">
    <div class="mx-auto max-w-7xl">

        <div class="grid gap-6 lg:grid-cols-2">

            {{-- CONTACT FORM --}}
            <div class="rounded-[1.5rem] border border-rose-100 bg-white p-6 shadow-sm sm:p-9">
                <p class="text-xs font-bold uppercase tracking-widest text-brand">
                    CONTACT KUTZ SALON
                </p>

                <h2 class="mt-3 font-heading text-3xl font-bold">
                    Send Us a Message
                </h2>

                <p class="mt-3 text-sm leading-7 text-slate-500">
                    Fill out the form and our team will get back to you.
                </p>

                @if(session('success'))
                    <div role="status" class="mt-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800">
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

                <form action="{{ route('contact.submit') }}"
                      method="POST"
                      class="mt-7 space-y-5">
                    @csrf

                    <div class="hidden" aria-hidden="true">
                        <label for="website">Website</label>
                        <input id="website" type="text" name="website"
                               tabindex="-1" autocomplete="off">
                    </div>

                    <div>
                        <label for="name" class="mb-2 block text-sm font-semibold">
                            Your Name *
                        </label>
                        <input id="name"
                               type="text"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               maxlength="255"
                               autocomplete="name"
                               placeholder="Enter your full name"
                               class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-brand focus:ring-2 focus:ring-rose-100">
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="phone" class="mb-2 block text-sm font-semibold">
                                Mobile Number *
                            </label>
                            <input id="phone"
                                   type="tel"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   required
                                   maxlength="20"
                                   autocomplete="tel"
                                   placeholder="Mobile number"
                                   class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-brand focus:ring-2 focus:ring-rose-100">
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold">
                                Email Address
                            </label>
                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   maxlength="255"
                                   autocomplete="email"
                                   placeholder="Email address"
                                   class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-brand focus:ring-2 focus:ring-rose-100">
                        </div>
                    </div>

                    <div>
                        <label for="type" class="mb-2 block text-sm font-semibold">
                            Enquiry Type *
                        </label>
                        <select id="type"
                                name="type"
                                required
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
                        <textarea id="message"
                                  name="message"
                                  rows="5"
                                  maxlength="5000"
                                  required
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
                                <a href="{{ $branch->google_maps_url }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
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
        <div class="mt-14">
            <h2 class="font-heading text-3xl font-bold">
                Our Salon <span class="text-brand">Locations</span>
            </h2>

            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($branches as $branch)
                    <article class="overflow-hidden rounded-2xl border border-rose-100 bg-white shadow-sm">

                        @if($branch->image)
                            <img src="{{ asset('storage/'.$branch->image) }}"
                                 alt="{{ $branch->name }}"
                                 loading="lazy"
                                 class="aspect-[16/10] w-full object-cover">
                        @endif

                        <div class="p-6">
                            <h3 class="font-heading text-lg font-bold">
                                {{ $branch->name }}
                            </h3>

                            <p class="mt-2 text-sm font-semibold text-brand">
                                {{ $branch->city }}
                            </p>

                            <p class="mt-3 text-sm leading-7 text-slate-600">
                                {{ $branch->address }}
                            </p>

                            @if($branch->google_maps_url)
                                <a href="{{ $branch->google_maps_url }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="mt-5 inline-flex text-sm font-bold text-brand">
                                    Get Directions →
                                </a>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
