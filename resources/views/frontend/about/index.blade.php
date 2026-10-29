
@extends('frontend.layouts.app')

@section('title', 'About Us | KUTZ The Salon')

@section('meta_description', 'Discover the story, expertise and beauty experience of KUTZ The Salon.')

@section('content')

<x-frontend.page-hero
    eyebrow="ABOUT KUTZ SALON"
    title="Where Beauty Meets Confidence"
    description="At KUTZ Salon, beauty is more than a look. We combine professional styling, personalized care and a welcoming experience."
    :image="$galleryImages->first()?->image ? asset('storage/'.$galleryImages->first()->image) : null"
    cta="Explore Our Services"
    :href="route('services.index')"
/>

<section class="px-4 py-16 sm:px-6 lg:py-24">
    <div class="mx-auto grid max-w-7xl items-center gap-10 lg:grid-cols-2 lg:gap-16">

        <div class="overflow-hidden rounded-[2rem] bg-brand-light">
            @if($galleryImages->first()?->image)
                <img src="{{ asset('storage/'.$galleryImages->first()->image) }}"
                     alt="KUTZ Salon"
                     class="aspect-[5/4] w-full object-cover">
            @else
                <div class="flex aspect-[5/4] items-center justify-center font-heading text-3xl font-bold text-brand">
                    KUTZ SALON
                </div>
            @endif
        </div>

        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-brand">OUR STORY</p>
            <h2 class="mt-4 font-heading text-3xl font-bold text-slate-950 sm:text-4xl">
                About <span class="text-brand">KUTZ The Salon</span>
            </h2>

            <p class="mt-6 text-base leading-8 text-slate-600">
                KUTZ Salon is dedicated to helping every client feel confident
                through thoughtful beauty and hair care. Our approach combines
                personalized consultation, professional techniques and attention
                to detail.
            </p>

            <p class="mt-4 text-base leading-8 text-slate-600">
                Whether you are preparing for a special occasion or refreshing
                your everyday style, our goal is to create a comfortable,
                welcoming and memorable salon experience.
            </p>

            <a href="{{ route('services.index') }}"
               class="mt-7 inline-flex rounded-xl bg-brand px-7 py-3 text-sm font-bold text-white hover:bg-brand-dark">
                Discover Our Services →
            </a>
        </div>
    </div>
</section>

<section class="bg-[#FFF7F8] px-4 py-16 sm:px-6">
    <div class="mx-auto max-w-7xl">
        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-widest text-brand">WHY CHOOSE US</p>
            <h2 class="mt-3 font-heading text-3xl font-bold text-slate-950">
                What Makes Us <span class="text-brand">Different?</span>
            </h2>
        </div>

        @php
            $benefits = [
                ['icon' => '✦', 'title' => 'Professional Team', 'text' => 'Dedicated beauty and styling professionals.'],
                ['icon' => '♡', 'title' => 'Personalized Care', 'text' => 'Services tailored to your preferences.'],
                ['icon' => '✧', 'title' => 'Beauty Expertise', 'text' => 'Hair, makeup, skincare and styling.'],
                ['icon' => '★', 'title' => 'Premium Experience', 'text' => 'Comfortable and welcoming salon ambience.'],
            ];
        @endphp

        <div class="mt-9 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($benefits as $benefit)
                <article class="rounded-2xl border border-rose-100 bg-white p-7 text-center shadow-sm">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-brand-light text-2xl text-brand">
                        {{ $benefit['icon'] }}
                    </div>
                    <h3 class="mt-5 font-heading text-lg font-bold">{{ $benefit['title'] }}</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-500">{{ $benefit['text'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="px-4 py-16 sm:px-6">
    <div class="mx-auto max-w-7xl">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-brand">OUR AMBIENCE</p>
                <h2 class="mt-3 font-heading text-3xl font-bold">A Glimpse of Our Salon</h2>
            </div>
            <a href="{{ route('gallery.index') }}" class="text-sm font-bold text-brand">
                View Gallery →
            </a>
        </div>

        <div class="mt-8 grid grid-cols-2 gap-4 md:grid-cols-3">
            @forelse($galleryImages as $image)
                <a href="{{ route('gallery.index') }}"
                   class="group overflow-hidden rounded-2xl bg-rose-50">
                    <img src="{{ asset('storage/'.$image->image) }}"
                         alt="{{ $image->title ?? 'KUTZ Gallery' }}"
                         loading="lazy"
                         class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105">
                </a>
            @empty
                <p class="col-span-full text-slate-500">Salon gallery images coming soon.</p>
            @endforelse
        </div>

        <p class="mt-6 text-sm text-slate-500">
            Currently serving through {{ $branches->count() }} active salon {{ $branches->count() === 1 ? 'location' : 'locations' }}.
        </p>
    </div>
</section>

@include('frontend.components.appointment-cta')

@endsection
