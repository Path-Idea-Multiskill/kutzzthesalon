@extends('admin.layouts.app')

@section('title', 'Dashboard | Kutzz Salon')

@section('content')

    <div class="space-y-6">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Dashboard Overview
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage your salon website from one place.
            </p>
        </div>

        @php
            $cards = [
                [
                    'title' => 'Total Services',
                    'value' => $stats['services'],
                    'route' => 'admin.services.index',
                ],
                [
                    'title' => 'Total Blogs',
                    'value' => $stats['blogs'],
                    'route' => 'admin.blogs.index',
                ],
                [
                    'title' => 'Appointments',
                    'value' => $stats['appointments'],
                    'route' => 'admin.appointments.index',
                ],
                [
                    'title' => 'New Enquiries',
                    'value' => $stats['enquiries'],
                    'route' => 'admin.enquiries.index',
                ],
                [
                    'title' => 'Academy Courses',
                    'value' => $stats['courses'],
                    'route' => 'admin.academy-courses.index',
                ],
                [
                    'title' => 'Gallery Images',
                    'value' => $stats['gallery'],
                    'route' => 'admin.gallery-images.index',
                ],
                [
                    'title' => 'Branches',
                    'value' => $stats['branches'],
                    'route' => 'admin.branches.index',
                ],
                [
                    'title' => 'CMS Pages',
                    'value' => $stats['pages'],
                    'route' => 'admin.pages.index',
                ],
            ];
        @endphp

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            @foreach($cards as $card)
                <a href="{{ route($card['route']) }}" class="group rounded-2xl border border-slate-200
                              bg-white p-5 shadow-sm transition
                              hover:-translate-y-1 hover:border-red-200
                              hover:shadow-lg">

                    <p class="text-sm font-medium text-slate-500">
                        {{ $card['title'] }}
                    </p>

                    <div class="mt-4 text-3xl font-bold text-slate-900">
                        {{ number_format($card['value']) }}
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-xs text-slate-400">
                            Live database count
                        </span>

                        <span class="text-sm font-semibold text-brand
                                         group-hover:translate-x-1 transition">
                            View →
                        </span>
                    </div>

                </a>
            @endforeach

        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <p class="text-sm text-slate-500">Today's Appointments</p>
                <p class="mt-3 text-3xl font-bold text-slate-900">
                    {{ $stats['today_appointments'] }}
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <p class="text-sm text-slate-500">Pending Appointments</p>
                <p class="mt-3 text-3xl font-bold text-amber-600">
                    {{ $stats['pending_appointments'] }}
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <p class="text-sm text-slate-500">Published Blogs</p>
                <p class="mt-3 text-3xl font-bold text-emerald-600">
                    {{ $stats['published_blogs'] }}
                </p>
            </div>

        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

            <div class="min-w-0 rounded-2xl border border-slate-200 bg-white p-5">
                <div class="mb-5 flex items-center justify-between gap-3">
                    <h2 class="font-bold text-slate-900">
                        Recent Appointments
                    </h2>

                    <a href="{{ route('admin.appointments.index') }}" class="text-sm font-semibold text-brand">
                        View All
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($recentAppointments as $appointment)
                        <div class="flex flex-wrap items-center justify-between
                                        gap-3 rounded-xl bg-slate-50 p-3">

                            <div class="min-w-0">
                                <p class="break-words text-sm font-semibold text-slate-900">
                                    {{ $appointment->customer_name }}
                                </p>

                                <p class="text-xs text-slate-500">
                                    {{ $appointment->service?->name ?? 'Service unavailable' }}
                                </p>
                            </div>

                            <div class="text-left sm:text-right">
                                <p class="text-xs font-medium text-slate-700">
                                    {{ $appointment->appointment_at?->format('d M Y, h:i A') }}
                                </p>

                                <p class="mt-1 text-xs capitalize text-brand">
                                    {{ str_replace('_', ' ', $appointment->status) }}
                                </p>
                            </div>

                        </div>
                    @empty
                        <p class="py-8 text-center text-sm text-slate-400">
                            No appointments available.
                        </p>
                    @endforelse
                </div>
            </div>

            <div class="min-w-0 rounded-2xl border border-slate-200 bg-white p-5">
                <div class="mb-5 flex items-center justify-between gap-3">
                    <h2 class="font-bold text-slate-900">
                        Recent Enquiries
                    </h2>

                    <a href="{{ route('admin.enquiries.index') }}" class="text-sm font-semibold text-brand">
                        View All
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($recentEnquiries as $enquiry)
                        <div class="flex flex-wrap items-center justify-between
                                        gap-3 rounded-xl bg-slate-50 p-3">

                            <div class="min-w-0">
                                <p class="break-words text-sm font-semibold text-slate-900">
                                    {{ $enquiry->name }}
                                </p>

                                <p class="text-xs text-slate-500">
                                    {{ $enquiry->phone }}
                                </p>
                            </div>

                            <div class="text-left sm:text-right">
                                <p class="text-xs text-slate-500">
                                    {{ $enquiry->created_at?->format('d M Y') }}
                                </p>

                                <p class="mt-1 text-xs capitalize text-brand">
                                    {{ str_replace('_', ' ', $enquiry->status) }}
                                </p>
                            </div>

                        </div>
                    @empty
                        <p class="py-8 text-center text-sm text-slate-400">
                            No enquiries available.
                        </p>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

@endsection