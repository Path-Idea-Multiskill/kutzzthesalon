
<section id="videos" class="bg-brand-light px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
    <div class="mx-auto max-w-7xl">

        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-[0.25em] text-brand">
                Our Work
            </p>
            <h2 class="mt-3 font-heading text-3xl font-bold text-slate-950 sm:text-4xl">
                See Our Work
            </h2>
            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-600">
                Explore beautiful moments, transformations and creative styling from our salon.
            </p>
        </div>

        <div class="mt-9 flex snap-x snap-mandatory gap-4 overflow-x-auto pb-5">

            @forelse($galleryImages->take(6) as $image)
                @php
                    $imagePath = $image->image ?? $image->image_path ?? $image->file_path ?? null;
                    $imageTitle = $image->title ?? 'KUTZ Salon Work';
                @endphp

                <article class="group w-48 shrink-0 snap-start overflow-hidden rounded-2xl bg-white shadow-sm sm:w-60 lg:w-64">
                    <div class="relative aspect-[3/4] overflow-hidden bg-rose-100">
                        @if($imagePath)
                            <img
                                src="{{ asset('storage/' . ltrim($imagePath, '/')) }}"
                                alt="{{ $imageTitle }}"
                                loading="lazy"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                            >
                        @else
                            <div class="flex h-full items-center justify-center text-brand">
                                KUTZ Salon
                            </div>
                        @endif

                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent p-4 pt-14">
                            <h3 class="line-clamp-2 text-sm font-bold text-white">
                                {{ $imageTitle }}
                            </h3>
                        </div>
                    </div>
                </article>
            @empty
                <p class="w-full rounded-2xl bg-white p-10 text-center text-sm text-slate-500">
                    Our latest work will appear here soon.
                </p>
            @endforelse

        </div>
    </div>
</section>
