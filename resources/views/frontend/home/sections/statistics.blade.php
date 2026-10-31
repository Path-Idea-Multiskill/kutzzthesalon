@php
    $highlights = [
        [
            'icon' => '✦',
            'title' => 'Expert Styling',
            'text' => 'Professional Beauty Care',
        ],
        [
            'icon' => '♡',
            'title' => 'Personalized',
            'text' => 'Services Designed For You',
        ],
        [
            'icon' => '✿',
            'title' => 'Beauty & Bridal',
            'text' => 'Complete Salon Solutions',
        ],
        [
            'icon' => '★',
            'title' => 'Quality Care',
            'text' => 'Comfortable Experience',
        ],
    ];
@endphp

<section aria-label="Why choose KUTZZ Salon" class="relative z-10 hidden bg-white px-4 py-8
    md:block md:px-6 md:py-10
    lg:px-8 lg:py-12">
    <div class="mx-auto w-full max-w-7xl">

        <div class="grid grid-cols-1 gap-3 rounded-3xl
            border border-rose-100 bg-white p-4
            shadow-[0_12px_40px_rgba(15,23,42,0.06)]
            sm:grid-cols-2 sm:gap-4 sm:p-6
            lg:grid-cols-4 lg:gap-0 lg:p-7">
            @foreach($highlights as $index => $item)

                <div class="flex min-w-0 items-center gap-4
                        rounded-2xl border border-rose-50
                        bg-[#FFFAFA] px-4 py-4
                        transition duration-300
                        hover:bg-brand-light
                        sm:px-5
                        lg:rounded-none lg:border-0
                        lg:border-r lg:border-rose-100
                        lg:bg-transparent lg:px-5
                        {{ $loop->last ? 'lg:border-r-0' : '' }}">

                    <div class="flex h-12 w-12 shrink-0
                            items-center justify-center
                            rounded-full bg-[#FFF0F2]
                            text-2xl font-bold text-brand
                            sm:h-14 sm:w-14" aria-hidden="true">
                        {{ $item['icon'] }}
                    </div>

                    <div class="min-w-0">

                        <h2 class="font-heading text-sm
                                font-bold leading-5 text-slate-950
                                sm:text-[15px]">
                            {{ $item['title'] }}
                        </h2>

                        <p class="mt-1 text-xs leading-5
                                text-slate-500 sm:text-[13px]">
                            {{ $item['text'] }}
                        </p>

                    </div>
                </div>

            @endforeach
        </div>

    </div>
</section>