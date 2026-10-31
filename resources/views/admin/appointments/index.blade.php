
@extends('admin.layouts.app')

@section('title', 'Appointments | Kutzz Salon')

@section('content')
@php
    $statusColors = [
        'pending' => 'bg-amber-50 text-amber-700',
        'confirmed' => 'bg-blue-50 text-blue-700',
        'completed' => 'bg-emerald-50 text-emerald-700',
        'cancelled' => 'bg-red-50 text-red-700',
        'no_show' => 'bg-slate-100 text-slate-600',
    ];
@endphp

<div class="mx-auto w-full max-w-7xl min-w-0 space-y-6 pb-8">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="mb-1 text-xs font-bold uppercase tracking-widest text-brand">
                Salon Bookings
            </p>
            <h1 class="font-heading text-2xl font-bold text-slate-900 sm:text-3xl">
                Appointments
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Manage bookings, schedules and customer appointments.
            </p>
        </div>

        <a href="{{ route('admin.appointments.create') }}"
           class="inline-flex min-h-11 items-center justify-center rounded-xl bg-brand px-5 text-sm font-semibold text-white shadow-sm hover:bg-brand-dark">
            + New Appointment
        </a>
    </div>

    @if(session('success'))
        <div role="status" class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-3 lg:grid-cols-4">
        @foreach([
            ['Total Bookings', $stats['total']],
            ["Today's Bookings", $stats['today']],
            ['Pending', $stats['pending']],
            ['Confirmed', $stats['confirmed']],
        ] as $stat)
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                <p class="text-xs font-semibold text-slate-500">{{ $stat[0] }}</p>
                <p class="mt-3 font-heading text-2xl font-bold text-slate-900 sm:text-3xl">
                    {{ $stat[1] }}
                </p>
            </div>
        @endforeach
    </div>

    <form method="GET"
          action="{{ route('admin.appointments.index') }}"
          class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:flex-row sm:items-end">

        <div class="min-w-0 flex-1">
            <label for="filter_date" class="mb-2 block text-xs font-semibold text-slate-600">
                Appointment Date
            </label>
            <input id="filter_date" name="date" type="date"
                   value="{{ request('date') }}"
                   class="min-h-11 w-full min-w-0 rounded-xl border border-slate-200 px-3 text-sm">
        </div>

        <div class="min-w-0 flex-1">
            <label for="filter_status" class="mb-2 block text-xs font-semibold text-slate-600">
                Booking Status
            </label>
            <select id="filter_status" name="status"
                    class="min-h-11 w-full min-w-0 rounded-xl border border-slate-200 px-3 text-sm">
                <option value="">All Statuses</option>
                @foreach(['pending','confirmed','completed','cancelled','no_show'] as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>
                        {{ ucwords(str_replace('_', ' ', $status)) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit"
                class="min-h-11 rounded-xl bg-brand px-6 text-sm font-semibold text-white">
            Apply Filter
        </button>

        <a href="{{ route('admin.appointments.index') }}"
           class="inline-flex min-h-11 items-center justify-center rounded-xl border border-slate-200 px-5 text-sm font-semibold text-slate-600">
            Reset
        </a>
    </form>

    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 p-5">
            <h2 class="font-heading text-lg font-bold text-slate-900">
                Booking Records
            </h2>
            <p class="mt-1 text-xs text-slate-500">
                {{ $appointments->total() }} matching appointments
            </p>
        </div>

        {{-- Desktop table --}}
        <div class="hidden overflow-x-auto lg:block">
            <table class="w-full min-w-[850px] text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-5 py-4">Customer</th>
                        <th class="px-5 py-4">Service</th>
                        <th class="px-5 py-4">Date & Time</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @foreach($appointments as $appointment)
                        <tr class="hover:bg-slate-50/70">
                            <td class="px-5 py-4">
                                <p class="font-semibold text-slate-900">
                                    {{ $appointment->customer_name }}
                                </p>
                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $appointment->customer_phone }}
                                </p>
                            </td>

                            <td class="px-5 py-4">
                                <p class="font-medium">{{ $appointment->service?->name }}</p>
                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $appointment->duration_minutes }} min
                                </p>
                            </td>

                            <td class="px-5 py-4">
                                {{ $appointment->appointment_at->format('d M Y') }}
                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $appointment->appointment_at->format('h:i A') }}
                                </p>
                            </td>

                            <td class="px-5 py-4">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $statusColors[$appointment->status] ?? 'bg-slate-100' }}">
                                    {{ ucwords(str_replace('_', ' ', $appointment->status)) }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.appointments.edit', $appointment) }}"
                                       class="rounded-lg border border-slate-200 px-4 py-2 text-xs font-semibold">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="{{ route('admin.appointments.destroy', $appointment) }}"
                                          onsubmit="return confirm('Delete this appointment?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="rounded-lg bg-red-50 px-4 py-2 text-xs font-semibold text-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Mobile and tablet cards --}}
        <div class="grid grid-cols-1 gap-3 p-4 sm:grid-cols-2 lg:hidden">
            @foreach($appointments as $appointment)
                <article class="min-w-0 rounded-xl border border-slate-200 p-4">
                    <div class="flex flex-wrap items-start justify-between gap-2">
                        <h3 class="font-semibold text-slate-900">
                            {{ $appointment->customer_name }}
                        </h3>
                        <span class="rounded-full px-2 py-1 text-xs font-semibold {{ $statusColors[$appointment->status] ?? 'bg-slate-100' }}">
                            {{ ucwords(str_replace('_', ' ', $appointment->status)) }}
                        </span>
                    </div>

                    <p class="mt-2 text-sm text-slate-600">
                        {{ $appointment->service?->name }}
                    </p>
                    <p class="mt-1 text-xs text-slate-500">
                        {{ $appointment->customer_phone }}
                    </p>
                    <p class="mt-3 text-sm font-medium text-slate-800">
                        {{ $appointment->appointment_at->format('d M Y, h:i A') }}
                    </p>

                    <div class="mt-4 flex gap-2 border-t border-slate-100 pt-4">
                        <a href="{{ route('admin.appointments.edit', $appointment) }}"
                           class="inline-flex min-h-10 flex-1 items-center justify-center rounded-lg border border-slate-200 text-sm font-semibold">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.appointments.destroy', $appointment) }}"
                              onsubmit="return confirm('Delete this appointment?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="min-h-10 rounded-lg bg-red-50 px-4 text-sm font-semibold text-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                </article>
            @endforeach
        </div>

        @if($appointments->isEmpty())
            <div class="p-12 text-center">
                <p class="text-3xl">📅</p>
                <h3 class="mt-3 font-heading font-bold text-slate-900">
                    No appointments found
                </h3>
                <p class="mt-2 text-sm text-slate-500">
                    Add a new booking or change your filters.
                </p>
            </div>
        @endif
    </section>

    {{ $appointments->links() }}
</div>
@endsection
