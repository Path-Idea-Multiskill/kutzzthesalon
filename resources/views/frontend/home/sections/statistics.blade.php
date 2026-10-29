
<section aria-label="Why choose KUTZ Salon" class="relative z-10 px-4 py-6 sm:px-6 lg:-mt-9 lg:px-8 lg:py-0">
    @php
        $highlights = [
            ['icon' => '✦', 'title' => 'Expert Styling', 'text' => 'Professional Beauty Care'],
            ['icon' => '♡', 'title' => 'Personalized', 'text' => 'Services For You'],
            ['icon' => '✿', 'title' => 'Beauty & Bridal', 'text' => 'Complete Salon Solutions'],
            ['icon' => '★', 'title' => 'Quality Care', 'text' => 'Comfortable Experience'],
        ];
    @endphp

    <div class="mx-auto grid max-w-6xl grid-cols-2 gap-3 rounded-3xl border border-rose-100 bg-white p-4 shadow-xl shadow-slate-900/5 sm:p-6 lg:grid-cols-4">
        @foreach($highlights as $item)
            <div class="flex min-w-0 items-center gap-3 rounded-2xl p-2 sm:p-3">
                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-brand-light text-xl text-brand">
                    {{ $item['icon'] }}
                </span>

                <div class="min-w-0">
                    <p class="text-sm font-bold text-slate-900">
                        {{ $item['title'] }}
                    </p>
                    <p class="mt-1 text-xs leading-5 text-slate-500">
                        {{ $item['text'] }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</section>
