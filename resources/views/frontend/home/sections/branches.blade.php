
<section id="contact" class="bg-slate-950 px-4 py-16 text-white sm:px-6 lg:px-8 lg:py-20">
    <div class="mx-auto max-w-7xl">

        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-[0.25em] text-rose-400">
                Our Locations
            </p>

            <h2 class="mt-3 font-heading text-3xl font-bold sm:text-4xl">
                Visit KUTZZ Salon
            </h2>

            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-400">
                Discover our salon locations and contact your preferred branch.
            </p>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">

            @forelse($branches as $branch)
                @php
                    $branchName = $branch->name ?? $branch->branch_name ?? 'KUTZZ Salon';
                    $branchPhone = $branch->phone ?? $branch->phone_number ?? null;
                @endphp

                <article class="rounded-2xl border border-white/10 bg-white/5 p-6 transition hover:border-rose-400/50 hover:bg-white/10">

                    <span class="inline-flex rounded-full bg-brand/20 px-3 py-1 text-xs font-bold text-rose-300">
                        KUTZZ Branch
                    </span>

                    <h3 class="mt-5 font-heading text-xl font-bold">
                        {{ $branchName }}
                    </h3>

                    <p class="mt-3 text-sm leading-7 text-slate-300">
                        {{ $branch->address ?? '' }}
                        @if($branch->city)
                            <br>{{ $branch->city }}
                        @endif
                        @if($branch->state)
                            , {{ $branch->state }}
                        @endif
                        @if($branch->pin_code ?? $branch->pincode ?? null)
                            - {{ $branch->pin_code ?? $branch->pincode }}
                        @endif
                    </p>

                    @if($branchPhone)
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $branchPhone) }}"
                           class="mt-5 inline-flex text-sm font-semibold text-rose-300 transition hover:text-white">
                            Call: {{ $branchPhone }}
                        </a>
                    @endif

                    @if($branch->opening_time && $branch->closing_time)
                        <p class="mt-3 text-xs text-slate-400">
                            Timings: {{ substr($branch->opening_time, 0, 5) }}
                            –
                            {{ substr($branch->closing_time, 0, 5) }}
                        </p>
                    @endif
                </article>
            @empty
                <p class="col-span-full rounded-2xl border border-white/10 bg-white/5 p-10 text-center text-sm text-slate-400">
                    Branch information will be available soon.
                </p>
            @endforelse

        </div>
    </div>
</section>
