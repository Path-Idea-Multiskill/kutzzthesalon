
@extends('frontend.layouts.app')

@section('title', 'KUTZ Salon | Hair, Beauty & Styling')

@section('meta_description',
    'Discover professional hair, beauty, styling and salon services at KUTZ Salon.'
)

@section('content')

{{-- HERO SECTION --}}
<section class="bg-brand-light px-4 py-16 sm:px-6 lg:py-24">
    <div class="mx-auto max-w-7xl">
        <div class="max-w-3xl">

            <p class="text-sm font-bold uppercase tracking-widest text-brand">
                Welcome to KUTZ Salon
            </p>

            <h1 class="mt-5 font-heading text-4xl font-bold leading-tight text-slate-950 sm:text-5xl lg:text-6xl">
                Your Style.
                <span class="text-brand">Our Passion.</span>
            </h1>

            <p class="mt-6 max-w-xl text-base leading-8 text-slate-600">
                Discover premium hair, beauty and styling experiences
                designed around you.
            </p>

            <a href="#services"
               class="mt-8 inline-flex min-h-12 items-center justify-center rounded-xl bg-brand px-7 py-3 text-sm font-semibold text-white transition hover:bg-brand-dark">
                Explore Our Services
            </a>

        </div>
    </div>
</section>

{{-- SERVICES --}}
<section id="services" class="px-4 py-16 sm:px-6 lg:py-20">
    <div class="mx-auto max-w-7xl">

        <p class="text-sm font-bold uppercase tracking-widest text-brand">
            Our Expertise
        </p>

        <h2 class="mt-3 font-heading text-3xl font-bold text-slate-950">
            Featured Salon Services
        </h2>

        <div class="mt-9 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @forelse($services as $service)
                <article class="min-w-0 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="flex aspect-[4/3] items-center justify-center bg-brand-light">
                        @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}"
                                 alt="{{ $service->name }}"
                                 loading="lazy"
                                 class="h-full w-full object-cover">
                        @else
                            <span class="font-heading text-lg font-semibold text-brand">
                                KUTZ SALON
                            </span>
                        @endif
                    </div>

                    <div class="p-5">
                        <h3 class="font-heading text-lg font-bold text-slate-900">
                            {{ $service->name }}
                        </h3>

                        <p class="mt-2 line-clamp-3 text-sm leading-6 text-slate-600">
                            {{ $service->short_description }}
                        </p>

                        <div class="mt-5 flex flex-wrap items-center justify-between gap-3">
                            <span class="font-bold text-brand">
                                ₹{{ number_format($service->price, 0) }}
                            </span>

                            <span class="text-xs text-slate-500">
                                {{ $service->duration_minutes }} min
                            </span>
                        </div>
                    </div>
                </article>
            @empty
                <p class="col-span-full rounded-2xl bg-slate-50 p-8 text-center text-slate-500">
                    Services will be available soon.
                </p>
            @endforelse

        </div>
    </div>
</section>

{{-- ABOUT --}}
<section class="bg-slate-50 px-4 py-16 sm:px-6 lg:py-20">
    <div class="mx-auto max-w-7xl">
        <div class="max-w-3xl">
            <p class="text-sm font-bold uppercase tracking-widest text-brand">
                About Us
            </p>

            <h2 class="mt-3 font-heading text-3xl font-bold text-slate-950">
                Beauty, Confidence & Care
            </h2>

            <p class="mt-5 text-base leading-8 text-slate-600">
                At KUTZ Salon, we bring together professional styling,
                personalized beauty services and a welcoming salon experience.
            </p>
        </div>
    </div>
</section>

{{-- GALLERY --}}
<section class="px-4 py-16 sm:px-6 lg:py-20">
    <div class="mx-auto max-w-7xl">
        <h2 class="font-heading text-3xl font-bold text-slate-950">
            Our Gallery
        </h2>

        <div class="mt-8 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
            @forelse($galleryImages as $image)
                <div class="aspect-square overflow-hidden rounded-2xl bg-slate-100">
                    @if($image->image)
                        <img src="{{ asset('storage/' . $image->image) }}"
                             alt="{{ $image->title ?? 'KUTZ Salon Gallery' }}"
                             loading="lazy"
                             class="h-full w-full object-cover transition duration-500 hover:scale-105">
                    @endif
                </div>
            @empty
                <p class="col-span-full text-sm text-slate-500">
                    Gallery images coming soon.
                </p>
            @endforelse
        </div>
    </div>
</section>

{{-- ACADEMY --}}
<section class="bg-brand-light px-4 py-16 sm:px-6 lg:py-20">
    <div class="mx-auto max-w-7xl">
        <h2 class="font-heading text-3xl font-bold text-slate-950">
            KUTZ Academy
        </h2>

        <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($courses as $course)
                <article class="rounded-2xl border border-red-100 bg-white p-6">
                    <h3 class="font-heading text-xl font-bold text-slate-900">
                        {{ $course->title }}
                    </h3>

                    <p class="mt-3 line-clamp-3 text-sm leading-7 text-slate-600">
                        {{ $course->short_description }}
                    </p>

                    <p class="mt-5 font-bold text-brand">
                        ₹{{ number_format($course->fees, 0) }}
                    </p>
                </article>
            @empty
                <p class="col-span-full text-sm text-slate-500">
                    Academy courses coming soon.
                </p>
            @endforelse
        </div>
    </div>
</section>

{{-- BLOGS --}}
<section class="px-4 py-16 sm:px-6 lg:py-20">
    <div class="mx-auto max-w-7xl">
        <h2 class="font-heading text-3xl font-bold text-slate-950">
            Latest Beauty Insights
        </h2>

        <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($blogs as $blog)
                <article class="rounded-2xl border border-slate-200 p-6">
                    <h3 class="font-heading text-lg font-bold text-slate-900">
                        {{ $blog->title }}
                    </h3>

                    <p class="mt-3 line-clamp-3 text-sm leading-7 text-slate-600">
                        {{ $blog->excerpt }}
                    </p>

                    <p class="mt-5 text-xs text-slate-500">
                        {{ $blog->published_at?->format('d M Y') }}
                    </p>
                </article>
            @empty
                <p class="col-span-full text-sm text-slate-500">
                    New articles coming soon.
                </p>
            @endforelse
        </div>
    </div>
</section>

{{-- CONTACT & BRANCHES --}}
<section id="contact" class="bg-slate-950 px-4 py-16 text-white sm:px-6 lg:py-20">
    <div class="mx-auto max-w-7xl">
        <h2 class="font-heading text-3xl font-bold">
            Visit KUTZ Salon
        </h2>

        <div class="mt-8 grid grid-cols-1 gap-5 md:grid-cols-3">
            @forelse($branches as $branch)
                <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                    <h3 class="font-semibold text-white">
                        {{ $branch->name }}
                    </h3>

                    <p class="mt-3 text-sm leading-7 text-slate-300">
                        {{ $branch->address }}
                    </p>

                    <p class="mt-3 text-sm text-slate-300">
                        {{ $branch->phone }}
                    </p>
                </div>
            @empty
                <p class="text-sm text-slate-400">
                    Branch details coming soon.
                </p>
            @endforelse
        </div>
    </div>
</section>

@endsection
