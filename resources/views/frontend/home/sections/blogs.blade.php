
<section id="blogs" class="bg-white px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
    <div class="mx-auto max-w-7xl">

        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-[0.25em] text-brand">
                Our Blogs
            </p>

            <h2 class="mt-3 font-heading text-3xl font-bold text-slate-950 sm:text-4xl">
                Latest Beauty Blogs
            </h2>

            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-600">
                Discover beauty trends, expert tips and professional advice from KUTZ Salon.
            </p>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @forelse($blogs as $blog)
                @php
                    $blogImage = $blog->featured_image ?? $blog->image ?? null;
                    $blogDescription = $blog->excerpt ?? $blog->short_description ?? '';
                @endphp

                <article class="group flex min-w-0 flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div class="aspect-[16/10] overflow-hidden bg-brand-light">
                        @if($blogImage)
                            <img
                                src="{{ asset('storage/' . ltrim($blogImage, '/')) }}"
                                alt="{{ $blog->title }}"
                                loading="lazy"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                            >
                        @else
                            <div class="flex h-full items-center justify-center font-heading text-xl font-bold text-brand">
                                KUTZ BEAUTY BLOG
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-1 flex-col p-5">
                        <p class="text-xs font-medium text-slate-500">
                            {{ $blog->published_at?->format('d M Y') ?? $blog->created_at?->format('d M Y') }}
                        </p>

                        <h3 class="mt-3 line-clamp-2 min-h-14 font-heading text-lg font-bold leading-7 text-slate-900">
                            {{ $blog->title }}
                        </h3>

                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-600">
                            {{ $blogDescription }}
                        </p>

                        <div class="mt-auto pt-6">
                            @if(\Illuminate\Support\Facades\Route::has('blogs.show'))
                                <a href="{{ route('blogs.show', $blog->slug) }}"
                                   class="inline-flex items-center rounded-lg bg-brand px-4 py-2 text-xs font-bold text-white transition hover:bg-brand-dark">
                                    Read More →
                                </a>
                            @else
                                <span class="text-xs font-semibold text-brand">
                                    Beauty Insights
                                </span>
                            @endif
                        </div>
                    </div>
                </article>
            @empty
                <p class="col-span-full rounded-2xl bg-slate-50 p-10 text-center text-sm text-slate-500">
                    Beauty blogs coming soon.
                </p>
            @endforelse

        </div>

        @if(\Illuminate\Support\Facades\Route::has('blogs.index'))
            <div class="mt-9 text-center">
                <a href="{{ route('blogs.index') }}"
                   class="inline-flex rounded-xl bg-brand px-7 py-3 text-sm font-bold text-white transition hover:bg-brand-dark">
                    See More Blogs →
                </a>
            </div>
        @endif

    </div>
</section>
