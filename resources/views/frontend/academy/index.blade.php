
@extends('frontend.layouts.app')

@section('title', 'KUTZ Beauty Academy | Professional Courses')

@section('content')

<x-frontend.page-hero
    eyebrow="KUTZ BEAUTY ACADEMY"
    title="Learn. Create. Grow."
    description="Build practical skills in beauty, hair styling and makeup through our professional academy courses."
    :image="$courses->first()?->image ? asset('storage/'.$courses->first()->image) : null"
    cta="Explore Courses"
    href="#courses"
/>

<section id="courses" class="scroll-mt-24 px-4 py-16 sm:px-6 lg:py-20">
    <div class="mx-auto max-w-7xl">

        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-widest text-brand">PROFESSIONAL TRAINING</p>
            <h2 class="mt-3 font-heading text-3xl font-bold sm:text-4xl">
                Courses <span class="text-brand">Offered</span>
            </h2>
            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-500">
                Discover beauty education designed for aspiring professionals.
            </p>
        </div>

        <div class="mt-10 space-y-7">
            @forelse($courses as $course)
                <article class="grid overflow-hidden rounded-[1.5rem] border border-rose-100 bg-white shadow-sm lg:grid-cols-2">

                    <div class="bg-brand-light {{ $loop->even ? 'lg:order-2' : '' }}">
                        @if($course->image)
                            <img src="{{ asset('storage/'.$course->image) }}"
                                 alt="{{ $course->title }}"
                                 loading="lazy"
                                 class="h-full max-h-[400px] min-h-[240px] w-full object-cover">
                        @else
                            <div class="flex min-h-[280px] items-center justify-center font-heading text-2xl font-bold text-brand">
                                KUTZ ACADEMY
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col justify-center p-6 sm:p-9">
                        <p class="text-xs font-bold uppercase tracking-widest text-brand">
                            BEAUTY EDUCATION
                        </p>

                        <h3 class="mt-3 font-heading text-2xl font-bold text-slate-950">
                            {{ $course->title }}
                        </h3>

                        @if($course->subtitle)
                            <p class="mt-2 font-medium text-slate-600">{{ $course->subtitle }}</p>
                        @endif

                        <p class="mt-4 text-sm leading-7 text-slate-600">
                            {{ $course->short_description }}
                        </p>

                        <div class="mt-5 flex flex-wrap gap-3">
                            @if($course->duration)
                                <span class="rounded-full bg-brand-light px-4 py-2 text-xs font-bold text-brand">
                                    Duration: {{ $course->duration }}
                                </span>
                            @endif

                            @if(!is_null($course->fees))
                                <span class="rounded-full bg-slate-100 px-4 py-2 text-xs font-bold text-slate-700">
                                    Fees: ₹{{ number_format((float)$course->fees, 0) }}
                                </span>
                            @endif
                        </div>

                        @if($course->curriculum)
                            <details class="mt-6 rounded-xl border border-rose-100 bg-[#FFF9FA] p-4">
                                <summary class="cursor-pointer text-sm font-bold text-slate-900">
                                    View Course Curriculum
                                </summary>
                                <div class="mt-4 whitespace-pre-line text-sm leading-7 text-slate-600">
                                    {{ $course->curriculum }}
                                </div>
                            </details>
                        @endif

                        <a href="{{ route('contact') }}"
                           class="mt-6 inline-flex w-fit rounded-xl bg-brand px-6 py-3 text-sm font-bold text-white hover:bg-brand-dark">
                            Enquire About Course →
                        </a>
                    </div>

                </article>
            @empty
                <p class="rounded-2xl bg-brand-light p-10 text-center text-slate-600">
                    Academy courses coming soon.
                </p>
            @endforelse
        </div>
    </div>
</section>

<section class="bg-[#FFF7F8] px-4 py-16 sm:px-6">
    <div class="mx-auto max-w-7xl text-center">
        <h2 class="font-heading text-3xl font-bold">Our Learning Focus</h2>

        <div class="mt-9 grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-6">
            @foreach([
                'Professional Ethics',
                'Skin Consultation',
                'Hair Styling',
                'Makeup Techniques',
                'Practical Training',
                'Career Guidance'
            ] as $focus)
                <div class="rounded-2xl border border-rose-100 bg-white p-5 shadow-sm">
                    <span class="text-2xl text-brand">✦</span>
                    <p class="mt-3 text-sm font-semibold">{{ $focus }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

@include('frontend.components.appointment-cta')

@endsection
