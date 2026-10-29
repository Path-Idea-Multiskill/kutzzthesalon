
<section id="academy" class="bg-brand-light px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
    <div class="mx-auto max-w-7xl">

        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-[0.25em] text-brand">
                Learn With KUTZ
            </p>

            <h2 class="mt-3 font-heading text-3xl font-bold text-slate-950 sm:text-4xl">
                KUTZ Beauty Academy
            </h2>

            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-600">
                Build professional skills through our beauty, hair and makeup training courses.
            </p>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @forelse($courses as $course)
                @php
                    $courseImage = $course->image ?? $course->featured_image ?? null;
                @endphp

                <article class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

                    <div class="aspect-[16/10] overflow-hidden bg-rose-100">
                        @if($courseImage)
                            <img
                                src="{{ asset('storage/' . ltrim($courseImage, '/')) }}"
                                alt="{{ $course->title }}"
                                loading="lazy"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                            >
                        @else
                            <div class="flex h-full items-center justify-center font-heading text-xl font-bold text-brand">
                                KUTZ ACADEMY
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-1 flex-col p-5">
                        <h3 class="line-clamp-2 font-heading text-xl font-bold text-slate-900">
                            {{ $course->title }}
                        </h3>

                        <p class="mt-3 line-clamp-3 text-sm leading-7 text-slate-600">
                            {{ $course->short_description }}
                        </p>

                        <div class="mt-auto flex flex-wrap items-center justify-between gap-3 pt-6">
                            <span class="text-lg font-bold text-brand">
                                ₹{{ number_format((float) ($course->fees ?? 0), 0) }}
                            </span>

                            @if($course->duration)
                                <span class="text-xs text-slate-500">
                                    {{ $course->duration }}
                                </span>
                            @endif
                        </div>

                        @if(\Illuminate\Support\Facades\Route::has('academy.show'))
                            <a href="{{ route('academy.show', $course->slug) }}"
                               class="mt-5 inline-flex justify-center rounded-xl bg-brand px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-dark">
                                View Course →
                            </a>
                        @endif
                    </div>
                </article>
            @empty
                <p class="col-span-full rounded-2xl bg-white p-10 text-center text-sm text-slate-500">
                    Academy courses coming soon.
                </p>
            @endforelse

        </div>
    </div>
</section>
