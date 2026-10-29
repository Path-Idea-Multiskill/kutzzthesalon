
@extends('admin.layouts.app')

@section('title', 'Service Categories | Kutz Salon')

@section('content')

<div class="mx-auto w-full max-w-7xl min-w-0 space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row
                sm:items-center sm:justify-between">

        <div>
            <h2 class="font-heading text-xl font-bold
                       text-slate-900 sm:text-2xl">
                Service Categories
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Manage your salon service categories.
            </p>
        </div>

        <a href="{{ route('admin.service-categories.create') }}"
           class="inline-flex min-h-11 items-center
                  justify-center rounded-xl bg-brand
                  px-5 py-3 text-sm font-semibold text-white
                  hover:bg-brand-dark">
            + Add Category
        </a>

    </div>

    @if(session('success'))
        <div role="status"
             class="rounded-xl border border-green-200
                    bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border
                border-slate-200 bg-white shadow-sm">

        <!-- Mobile Cards -->
        <div class="divide-y divide-slate-100 md:hidden">

            @forelse($categories as $category)
                <div class="space-y-3 p-4">

                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <h3 class="break-words font-semibold text-slate-900">
                                {{ $category->name }}
                            </h3>
                            <p class="break-all text-xs text-slate-500">
                                {{ $category->slug }}
                            </p>
                        </div>

                        <span class="shrink-0 rounded-full px-2 py-1 text-xs
                                     {{ $category->is_active
                                        ? 'bg-green-50 text-green-700'
                                        : 'bg-slate-100 text-slate-600' }}">
                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    <p class="text-sm text-slate-500">
                        Sort Order: {{ $category->sort_order }}
                    </p>

                    <div class="flex flex-wrap items-center gap-2">

                        <a href="{{ route('admin.service-categories.edit', $category) }}"
                           class="rounded-lg border border-slate-300
                                  px-4 py-2 text-sm font-medium">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.service-categories.destroy', $category) }}"
                              onsubmit="return confirm('Delete this category?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="rounded-lg bg-red-50
                                           px-4 py-2 text-sm font-medium
                                           text-red-700">
                                Delete
                            </button>
                        </form>

                    </div>
                </div>
            @empty
                <p class="p-6 text-center text-sm text-slate-500">
                    No categories found.
                </p>
            @endforelse

        </div>

        <!-- Tablet/Desktop Table -->
        <div class="hidden overflow-x-auto md:block">
            <table class="w-full min-w-[650px] text-left text-sm">

                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-5 py-4">Category</th>
                        <th class="px-5 py-4">Slug</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Order</th>
                        <th class="px-5 py-4 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($categories as $category)
                        <tr>
                            <td class="px-5 py-4 font-medium">
                                {{ $category->name }}
                            </td>

                            <td class="px-5 py-4 text-slate-500">
                                {{ $category->slug }}
                            </td>

                            <td class="px-5 py-4">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </td>

                            <td class="px-5 py-4">
                                {{ $category->sort_order }}
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.service-categories.edit', $category) }}"
                                       class="font-semibold text-brand">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="{{ route('admin.service-categories.destroy', $category) }}"
                                          onsubmit="return confirm('Delete this category?')">
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
                            <td colspan="5"
                                class="px-5 py-10 text-center text-slate-500">
                                No categories found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

    <div>
        {{ $categories->links() }}
    </div>

</div>

@endsection
