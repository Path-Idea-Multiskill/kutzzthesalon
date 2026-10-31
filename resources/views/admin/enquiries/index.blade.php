
@extends('admin.layouts.app')

@section('title', 'Enquiries | Kutzz Salon')

@section('content')
@php
    $statusColors = [
        'new' => 'bg-blue-50 text-blue-700',
        'contacted' => 'bg-purple-50 text-purple-700',
        'follow_up' => 'bg-amber-50 text-amber-700',
        'converted' => 'bg-emerald-50 text-emerald-700',
        'closed' => 'bg-slate-100 text-slate-600',
    ];
@endphp

<div class="mx-auto w-full max-w-7xl min-w-0 space-y-6 pb-8">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="mb-1 text-xs font-bold uppercase tracking-widest text-brand">
                Lead Management
            </p>
            <h1 class="font-heading text-2xl font-bold text-slate-900 sm:text-3xl">
                Enquiries
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Manage salon leads, customer enquiries and follow-ups.
            </p>
        </div>

        <a href="{{ route('admin.enquiries.create') }}"
           class="inline-flex min-h-11 items-center justify-center rounded-xl bg-brand px-5 text-sm font-semibold text-white">
            + New Enquiry
        </a>
    </div>

    @if(session('success'))
        <div role="status" class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-3 lg:grid-cols-4">
        @foreach([
            ['Total Enquiries', $stats['total']],
            ['New Enquiries', $stats['new']],
            ['Follow-Ups', $stats['follow_up']],
            ['Converted', $stats['converted']],
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
          action="{{ route('admin.enquiries.index') }}"
          class="grid grid-cols-1 gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:grid-cols-2 xl:grid-cols-4">

        <input name="search" value="{{ request('search') }}"
               placeholder="Search name, phone or email"
               class="min-h-11 min-w-0 rounded-xl border border-slate-200 px-3 text-sm">

        <select name="type"
                class="min-h-11 min-w-0 rounded-xl border border-slate-200 px-3 text-sm">
            <option value="">All Types</option>
            @foreach(['general','service','academy','bridal','other'] as $type)
                <option value="{{ $type }}" @selected(request('type') === $type)>
                    {{ ucfirst($type) }}
                </option>
            @endforeach
        </select>

        <select name="status"
                class="min-h-11 min-w-0 rounded-xl border border-slate-200 px-3 text-sm">
            <option value="">All Statuses</option>
            @foreach(['new','contacted','follow_up','converted','closed'] as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>
                    {{ ucwords(str_replace('_', ' ', $status)) }}
                </option>
            @endforeach
        </select>

        <div class="flex gap-2">
            <button type="submit"
                    class="min-h-11 flex-1 rounded-xl bg-brand px-4 text-sm font-semibold text-white">
                Filter
            </button>
            <a href="{{ route('admin.enquiries.index') }}"
               class="inline-flex min-h-11 items-center rounded-xl border border-slate-200 px-4 text-sm font-semibold">
                Reset
            </a>
        </div>
    </form>

    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 p-5">
            <h2 class="font-heading text-lg font-bold">Customer Enquiries</h2>
            <p class="mt-1 text-xs text-slate-500">
                {{ $enquiries->total() }} matching records
            </p>
        </div>

        <div class="hidden overflow-x-auto lg:block">
            <table class="w-full min-w-[850px] text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-5 py-4">Customer</th>
                        <th class="px-5 py-4">Type</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Follow-Up</th>
                        <th class="px-5 py-4 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @foreach($enquiries as $enquiry)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-4">
                                <p class="font-semibold">{{ $enquiry->name }}</p>
                                <p class="mt-1 text-xs text-slate-500">{{ $enquiry->phone }}</p>
                            </td>

                            <td class="px-5 py-4">
                                {{ ucfirst($enquiry->type) }}
                            </td>

                            <td class="px-5 py-4">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $statusColors[$enquiry->status] ?? 'bg-slate-100' }}">
                                    {{ ucwords(str_replace('_', ' ', $enquiry->status)) }}
                                </span>
                            </td>

                            <td class="px-5 py-4 text-xs">
                                {{ $enquiry->follow_up_at?->format('d M Y, h:i A') ?? 'Not scheduled' }}
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.enquiries.edit', $enquiry) }}"
                                       class="rounded-lg border border-slate-200 px-4 py-2 text-xs font-semibold">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="{{ route('admin.enquiries.destroy', $enquiry) }}"
                                          onsubmit="return confirm('Delete this enquiry?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-lg bg-red-50 px-4 py-2 text-xs font-semibold text-red-600">
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

        <div class="grid grid-cols-1 gap-3 p-4 sm:grid-cols-2 lg:hidden">
            @foreach($enquiries as $enquiry)
                <article class="rounded-xl border border-slate-200 p-4">
                    <div class="flex flex-wrap justify-between gap-2">
                        <h3 class="font-semibold">{{ $enquiry->name }}</h3>
                        <span class="rounded-full px-2 py-1 text-xs font-semibold {{ $statusColors[$enquiry->status] ?? 'bg-slate-100' }}">
                            {{ ucwords(str_replace('_', ' ', $enquiry->status)) }}
                        </span>
                    </div>

                    <p class="mt-2 text-sm text-slate-500">{{ $enquiry->phone }}</p>
                    <p class="mt-1 text-xs text-slate-500">
                        {{ ucfirst($enquiry->type) }}
                    </p>
                    <p class="mt-3 text-xs text-slate-500">
                        Follow-up:
                        {{ $enquiry->follow_up_at?->format('d M Y, h:i A') ?? 'Not scheduled' }}
                    </p>

                    <div class="mt-4 flex gap-2 border-t border-slate-100 pt-4">
                        <a href="{{ route('admin.enquiries.edit', $enquiry) }}"
                           class="inline-flex min-h-10 flex-1 items-center justify-center rounded-lg border border-slate-200 text-sm font-semibold">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.enquiries.destroy', $enquiry) }}"
                              onsubmit="return confirm('Delete this enquiry?')">
                            @csrf
                            @method('DELETE')
                            <button class="min-h-10 rounded-lg bg-red-50 px-4 text-sm font-semibold text-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                </article>
            @endforeach
        </div>

        @if($enquiries->isEmpty())
            <div class="p-12 text-center">
                <h3 class="font-heading font-bold">No enquiries found</h3>
                <p class="mt-2 text-sm text-slate-500">
                    Create an enquiry or change your filters.
                </p>
            </div>
        @endif
    </section>

    {{ $enquiries->links() }}
</div>
@endsection
