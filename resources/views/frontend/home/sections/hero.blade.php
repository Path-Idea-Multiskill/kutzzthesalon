
<section class="relative isolate overflow-hidden bg-brand-light">
    <div class="pointer-events-none absolute -left-24 top-0 h-80 w-80 rounded-full bg-rose-200/50 blur-3xl"></div>
    <div class="pointer-events-none absolute right-0 top-0 h-96 w-96 rounded-full bg-white/70 blur-3xl"></div>

    <div class="relative mx-auto grid max-w-7xl items-center gap-8 px-4 py-12 sm:px-6 lg:min-h-[570px] lg:grid-cols-2 lg:gap-12 lg:px-8 lg:py-16">

        <div class="relative z-10">
            <p class="text-xs font-bold uppercase tracking-[0.25em] text-brand sm:text-sm">
                Welcome to KUTZ The Salon
            </p>

            <h1 class="mt-5 max-w-xl font-heading text-4xl font-bold leading-tight text-slate-950 sm:text-5xl lg:text-6xl">
                Elevate Your
                <span class="block text-brand italic">
                    Everyday Look
                </span>
            </h1>

            <p class="mt-6 max-w-lg text-sm leading-7 text-slate-600 sm:text-base">
                Experience premium hair, beauty, bridal and skincare services tailored to your individual style.
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                <a href="#contact"
                   class="inline-flex min-h-12 items-center justify-center rounded-xl bg-brand px-6 py-3 text-sm font-bold text-white shadow-lg shadow-red-500/15 transition hover:bg-brand-dark">
                    Book Appointment
                    <span class="ml-2" aria-hidden="true">→</span>
                </a>

                <a href="#services"
                   class="inline-flex min-h-12 items-center justify-center rounded-xl border border-rose-200 bg-white px-6 py-3 text-sm font-semibold text-slate-800 transition hover:border-brand hover:text-brand">
                    Explore Services
                </a>
            </div>
        </div>

        <div class="relative mx-auto w-full max-w-xl">
            <div class="absolute inset-5 rounded-full bg-rose-200/60 blur-3xl"></div>

            <div class="relative aspect-[5/4] overflow-hidden rounded-[2rem] border border-white/70 bg-white/40 shadow-xl sm:aspect-[6/5]">
                <img
                    src="{{ asset('assets/images/home/hero-bride.png') }}"
                    alt="KUTZ Salon bridal beauty experience"
                    class="h-full w-full object-cover object-top"
                    fetchpriority="high"
                    onerror="this.style.display='none'"
                >
            </div>

            <div class="absolute bottom-4 right-4 rounded-2xl border border-white/80 bg-white/90 px-5 py-4 shadow-lg backdrop-blur-md sm:bottom-8 sm:right-8">
                <p class="font-heading text-lg font-bold italic text-brand">
                    Be Beautiful.
                </p>
                <p class="text-xs text-slate-500">
                    Be Confident. Be You.
                </p>
            </div>
        </div>

    </div>
</section>
