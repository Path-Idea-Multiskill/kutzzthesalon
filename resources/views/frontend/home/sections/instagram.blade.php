
<section id="instagram" class="bg-rose-50/50 px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
    <div class="mx-auto max-w-7xl">
        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-[0.25em] text-brand">
                Our Instagram
            </p>
            <h2 class="mt-3 font-heading text-3xl font-bold text-slate-950 sm:text-4xl">
                Follow Us on Instagram
            </h2>
        </div>

        <div class="mt-9 flex snap-x snap-mandatory gap-3 overflow-x-auto pb-5">
            @forelse($galleryImages->take(8) as $image)
                @php
                    $photo = $image->image ?? $image->image_path ?? $image->file_path ?? null;
                @endphp

                <div class="group relative aspect-square w-40 shrink-0 snap-start overflow-hidden rounded-2xl bg-white shadow-sm sm:w-52 lg:w-56">
                    @if($photo)
                        <img
                            src="{{ asset('storage/' . ltrim($photo, '/')) }}"
                            alt="{{ $image->title ?? 'KUTZZ Salon Beauty Work' }}"
                            loading="lazy"
                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                        >
                    @else
                        <div class="flex h-full items-center justify-center text-brand">
                            KUTZZ Salon
                        </div>
                    @endif

                    <span class="absolute right-3 top-3 rounded-lg bg-white/90 px-2 py-1 text-xs font-bold text-brand">
                        KUTZZ
                    </span>
                </div>
            @empty
                <p class="w-full rounded-xl bg-white p-8 text-center text-sm text-slate-500">
                    New beauty moments coming soon.
                </p>
            @endforelse
        </div>

        {{-- Replace with verified official Instagram profile URL --}}
        <p class="mt-4 text-center text-sm text-slate-500">
            Discover more salon transformations on our social channels.
        </p>
    </div>
</section>
