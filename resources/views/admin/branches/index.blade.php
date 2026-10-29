
@extends('admin.layouts.app')

@section('title', 'Branches Management | Kutz Salon')

@section('content')
<div class="mx-auto w-full max-w-7xl min-w-0 space-y-6 pb-8">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="mb-1 text-xs font-bold uppercase tracking-widest text-brand">
                Salon Locations
            </p>
            <h1 class="font-heading text-2xl font-bold text-slate-900 sm:text-3xl">
                Branches Management
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Manage your salon locations, working hours and contact details.
            </p>
        </div>

        <a href="{{ route('admin.branches.create') }}"
           class="inline-flex min-h-11 items-center justify-center rounded-xl bg-brand px-5 text-sm font-semibold text-white shadow-sm hover:bg-brand-dark">
            + Add New Branch
        </a>
    </div>

    @if(session('success'))
        <div role="status" class="rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">
        @forelse($branches as $branch)
            <article class="min-w-0 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-lg">

                <div class="relative aspect-video bg-slate-100">
                    @if($branch->image)
                        <img src="{{ asset('storage/' . $branch->image) }}"
                             alt="{{ $branch->name }}"
                             loading="lazy"
                             class="h-full w-full object-cover">
                    @else
                        <div class="flex h-full items-center justify-center text-4xl">
                            🏬
                        </div>
                    @endif

                    <div class="absolute left-3 top-3 flex flex-wrap gap-2">
                        @if($branch->is_primary)
                            <span class="rounded-full bg-brand px-3 py-1 text-xs font-semibold text-white">
                                Main Branch
                            </span>
                        @endif

                        <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold {{ $branch->is_active ? 'text-green-700' : 'text-slate-600' }}">
                            {{ $branch->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>

                <div class="space-y-4 p-5">
                    <div>
                        <h2 class="font-heading text-lg font-bold text-slate-900">
                            {{ $branch->name }}
                        </h2>

                        <p class="mt-1 text-sm font-medium text-brand">
                            {{ $branch->city }}{{ $branch->state ? ', ' . $branch->state : '' }}
                        </p>

                        <p class="mt-2 line-clamp-2 text-sm text-slate-500">
                            {{ $branch->address }}
                        </p>
                    </div>

                    <div class="space-y-2 border-y border-slate-100 py-4 text-sm text-slate-600">
                        <p>📞 {{ $branch->phone }}</p>

                        @if($branch->opening_time && $branch->closing_time)
                            <p>
                                🕒 {{ $branch->opening_time }} - {{ $branch->closing_time }}
                            </p>
                        @endif

                        @if($branch->working_days)
                            <p>📅 {{ $branch->working_days }}</p>
                        @endif
                    </div>

                    @if($branch->google_maps_url)
                        <a href="{{ $branch->google_maps_url }}"
                           target="_blank" rel="noopener noreferrer"
                           class="inline-flex text-sm font-semibold text-brand hover:underline">
                            View on Google Maps
                        </a>
                    @endif

                    <div class="flex gap-2 border-t border-slate-100 pt-4">
                        <a href="{{ route('admin.branches.edit', $branch) }}"
                           class="inline-flex min-h-10 flex-1 items-center justify-center rounded-xl border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Edit Branch
                        </a>

                        <form method="POST"
                              action="{{ route('admin.branches.destroy', $branch) }}"
                              onsubmit="return confirm('Delete this branch permanently?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="min-h-10 rounded-xl border border-red-100 bg-red-50 px-4 text-sm font-semibold text-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white px-5 py-16 text-center">
                <p class="text-4xl">🏬</p>
                <h3 class="mt-4 font-heading text-lg font-bold text-slate-900">
                    No salon branches added yet
                </h3>
                <p class="mt-2 text-sm text-slate-500">
                    Add your first salon location.
                </p>
            </div>
        @endforelse
    </div>

    {{ $branches->links() }}
</div>
@endsection
