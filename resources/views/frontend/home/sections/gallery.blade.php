
<section id="gallery" class="bg-white px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
    <div class="mx-auto max-w-7xl">

        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-[0.25em] text-brand">
                Our Gallery
            </p>

            <h2 class="mt-3 font-heading text-3xl font-bold text-slate-950 sm:text-4xl">
                Explore Our Gallery
            </h2>

            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-600">
                A glimpse into the artistry, creativity and beautiful transformations at KUTZ Salon.
            </p>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-4 sm:grid-cols-3">
            @forelse($galleryImages->take(3) as $image)
                @php
                    $imagePath = $image->image ?? $image->image_path ?? $image->file_path ?? null;
                @endphp

                <figure class="group relative aspect-[4/5] overflow-hidden rounded-2xl bg-brand-light shadow-sm">
                    @if($imagePath)
                        <img
                            src="{{ asset('storage/' . ltrim($imagePath, '/')) }}"
                            alt="{{ $image->title ?? 'KUTZ Salon Gallery' }}"
                            loading="lazy"
                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                        >
                    @else
                        <div class="flex h-full items-center justify-center font-bold text-brand">
                            KUTZ Salon
                        </div>
                    @endif

                    @if($image->title)
                        <figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/75 to-transparent p-5 pt-16 text-sm font-semibold text-white">
                            {{ $image->title }}
                        </figcaption>
                    @endif
                </figure>
            @empty
                <p class="col-span-full rounded-2xl bg-slate-50 p-10 text-center text-sm text-slate-500">
                    Gallery photos coming soon.
                </p>
            @endforelse
        </div>

        <div class="mt-9 text-center">
            @if(\Illuminate\Support\Facades\Route::has('gallery.index'))
                <a href="{{ route('gallery.index') }}"
                   class="inline-flex min-h-12 items-center justify-center rounded-xl bg-brand px-7 py-3 text-sm font-semibold text-white transition hover:bg-brand-dark">
                    See More Photographs →
                </a>
            @endif
        </div>

    </div>
</section>
