
<section id="experience" class="overflow-hidden bg-white px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
    <div class="mx-auto max-w-7xl">

        <div class="mb-10 text-center">
            <p class="text-xs font-bold uppercase tracking-[0.25em] text-brand">
                The Experience
            </p>
            <h2 class="mt-3 font-heading text-3xl font-bold text-slate-950 sm:text-4xl">
                Learn & Experience
            </h2>
            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-600">
                Discover our passion for beauty, professional styling and personal care.
            </p>
        </div>

        <div class="grid items-center gap-8 overflow-hidden rounded-3xl bg-brand-light p-5 sm:p-8 lg:grid-cols-2 lg:gap-12 lg:p-12">

            <div class="aspect-[5/4] overflow-hidden rounded-3xl bg-white shadow-md">
                <img
                    src="{{ asset('assets/images/home/experience.webp') }}"
                    alt="KUTZ Salon beauty and styling experience"
                    loading="lazy"
                    class="h-full w-full object-cover"
                    onerror="this.style.display='none'"
                >
            </div>

            <div>
                <p class="text-sm font-bold uppercase tracking-widest text-brand">
                    Welcome to Our World
                </p>

                <h3 class="mt-4 font-heading text-3xl font-bold leading-tight text-slate-950 sm:text-4xl">
                    Where Beauty Meets Confidence
                </h3>

                <p class="mt-6 text-sm leading-8 text-slate-600 sm:text-base">
                    At KUTZ Salon, we believe every beauty experience should feel personal.
                    Our approach brings together professional techniques, creativity and
                    attentive service to help you discover your unique style.
                </p>

                <p class="mt-4 text-sm leading-8 text-slate-600 sm:text-base">
                    From everyday grooming to special occasions, our aim is to create
                    memorable experiences through quality care and thoughtful styling.
                </p>

                @if(\Illuminate\Support\Facades\Route::has('about'))
                    <a href="{{ route('about') }}"
                       class="mt-7 inline-flex rounded-xl bg-brand px-6 py-3 text-sm font-bold text-white transition hover:bg-brand-dark">
                        Know More About Us →
                    </a>
                @endif
            </div>

        </div>
    </div>
</section>
