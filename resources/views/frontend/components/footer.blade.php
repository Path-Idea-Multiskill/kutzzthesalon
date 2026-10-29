
@php
    $footerPages = \App\Models\Page::query()
        ->where('is_published', true)
        ->where('show_in_footer', true)
        ->orderBy('sort_order')
        ->get();
@endphp

<footer class="border-t border-slate-200 bg-slate-950 text-white">

    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-4 py-14 sm:grid-cols-2 sm:px-6 lg:grid-cols-4 lg:px-8">

        <div>
            <h2 class="font-heading text-3xl font-extrabold text-white">
                KUTZ<span class="text-brand">.</span>
            </h2>

            <p class="mt-4 max-w-xs text-sm leading-7 text-slate-400">
                Premium salon experiences designed to help you look and feel your best.
            </p>
        </div>

        <div>
            <h3 class="font-heading text-base font-bold">Explore</h3>

            <div class="mt-5 flex flex-col gap-3">
                <a href="{{ route('home') }}"
                   class="text-sm text-slate-400 hover:text-white">
                    Home
                </a>

                <a href="{{ route('home') }}#services"
                   class="text-sm text-slate-400 hover:text-white">
                    Our Services
                </a>
            </div>
        </div>

        <div>
            <h3 class="font-heading text-base font-bold">
                Important Links
            </h3>

            <div class="mt-5 flex flex-col gap-3">
                @forelse($footerPages as $page)
                    <a href="{{ route('pages.show', $page->slug) }}"
                       class="text-sm text-slate-400 transition hover:text-white">
                        {{ $page->title }}
                    </a>
                @empty
                    <p class="text-sm text-slate-500">
                        No additional pages published yet.
                    </p>
                @endforelse
            </div>
        </div>

        <div>
            <h3 class="font-heading text-base font-bold">
                Contact Us
            </h3>

            <p class="mt-5 text-sm leading-7 text-slate-400">
                Visit KUTZ Salon for professional hair, beauty and grooming services.
            </p>

            <a href="{{ route('home') }}#contact"
               class="mt-4 inline-flex text-sm font-semibold text-white hover:text-brand">
                Get in Touch
            </a>
        </div>

    </div>

    <div class="border-t border-white/10 px-4 py-5 text-center text-xs text-slate-500">
        © {{ date('Y') }} KUTZ Salon. All rights reserved.
    </div>

</footer>
