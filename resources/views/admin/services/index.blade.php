
@extends('admin.layouts.app')

@section('title', 'Services | Kutz Salon')

@section('content')

<div class="mx-auto w-full max-w-7xl min-w-0 space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row
                sm:items-center sm:justify-between">

        <div>
            <h1 class="font-heading text-xl font-bold sm:text-2xl">
                Services Management
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Manage salon services, pricing and images.
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.service-categories.index') }}"
               class="inline-flex min-h-11 items-center justify-center
                      rounded-xl border border-slate-300 px-4 py-2
                      text-sm font-semibold">
                Categories
            </a>

            <a href="{{ route('admin.services.create') }}"
               class="inline-flex min-h-11 items-center justify-center
                      rounded-xl bg-brand px-4 py-2
                      text-sm font-semibold text-white">
                + Add Service
            </a>
        </div>

    </div>

    @if(session('success'))
        <div role="status"
             class="rounded-xl bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mobile / Tablet Cards -->
    <div class="grid grid-cols-1 gap-4 lg:hidden">

        @forelse($services as $service)
            <article class="min-w-0 rounded-2xl border border-slate-200
                            bg-white p-4 shadow-sm">

                <div class="flex gap-4">

                    @if($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}"
                             alt="{{ $service->name }}"
                             class="h-20 w-20 shrink-0 rounded-xl object-cover">
                    @else
                        <div class="flex h-20 w-20 shrink-0 items-center
                                    justify-center rounded-xl bg-brand-light
                                    text-xs text-brand">
                            No Image
                        </div>
                    @endif

                    <div class="min-w-0 flex-1">
                        <h2 class="break-words font-semibold">
                            {{ $service->name }}
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            {{ $service->category?->name }}
                        </p>

                        <p class="mt-2 text-sm font-semibold text-brand">
                            {{ $service->price !== null
                                ? '₹' . number_format((float) $service->price, 2)
                                : 'Price on request' }}
                        </p>
                    </div>

                </div>

                <div class="mt-4 flex flex-wrap items-center justify-between gap-3">

                    <span class="rounded-full px-3 py-1 text-xs
                        {{ $service->is_active
                            ? 'bg-green-50 text-green-700'
                            : 'bg-slate-100 text-slate-600' }}">
                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                    </span>

                    <div class="flex gap-3">

                        <a href="{{ route('admin.services.edit', $service) }}"
                           class="text-sm font-semibold text-brand">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.services.destroy', $service) }}"
                              onsubmit="return confirm('Delete this service?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="text-sm font-semibold text-red-600">
                                Delete
                            </button>
                        </form>

                    </div>
                </div>

            </article>
        @empty
            <div class="rounded-2xl border bg-white p-8 text-center
                        text-sm text-slate-500">
                No services found.
            </div>
        @endforelse

    </div>

    <!-- Desktop Table -->
    <div class="hidden overflow-x-auto rounded-2xl border
                border-slate-200 bg-white shadow-sm lg:block">

        <table class="w-full min-w-[800px] text-left text-sm">

            <thead class="bg-slate-50 text-slate-600">
                <tr>
                    <th class="px-5 py-4">Service</th>
                    <th class="px-5 py-4">Category</th>
                    <th class="px-5 py-4">Price</th>
                    <th class="px-5 py-4">Duration</th>
                    <th class="px-5 py-4">Status</th>
                    <th class="px-5 py-4 text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                @forelse($services as $service)
                    <tr>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">

                                @if($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}"
                                         alt="{{ $service->name }}"
                                         class="h-12 w-12 rounded-lg object-cover">
                                @endif

                                <span class="font-semibold">
                                    {{ $service->name }}
                                </span>
                            </div>
                        </td>

                        <td class="px-5 py-4">
                            {{ $service->category?->name }}
                        </td>

                        <td class="px-5 py-4">
                            {{ $service->price !== null
                                ? '₹' . number_format((float) $service->price, 2)
                                : 'On request' }}
                        </td>

                        <td class="px-5 py-4">
                            {{ $service->duration_minutes
                                ? $service->duration_minutes . ' min'
                                : '—' }}
                        </td>

                        <td class="px-5 py-4">
                            {{ $service->is_active ? 'Active' : 'Inactive' }}
                        </td>

                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-3">

                                <a href="{{ route('admin.services.edit', $service) }}"
                                   class="font-semibold text-brand">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.services.destroy', $service) }}"
                                      onsubmit="return confirm('Delete this service?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="font-semibold text-red-600">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6"
                            class="px-5 py-10 text-center text-slate-500">
                            No services found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div>
        {{ $services->links() }}
    </div>

</div>

@endsection
