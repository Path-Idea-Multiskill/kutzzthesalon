
@extends('admin.layouts.app')

@section('title', 'Academy Management | Kutz Salon')

@section('content')
<div class="mx-auto w-full max-w-7xl min-w-0 space-y-6 pb-8">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="mb-1 text-xs font-bold uppercase tracking-widest text-brand">
                Training Programs
            </p>
            <h1 class="font-heading text-2xl font-bold sm:text-3xl">
                Academy Management
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Manage courses, fees, curriculum and visibility.
            </p>
        </div>

        <a href="{{ route('admin.academy-courses.create') }}"
           class="inline-flex min-h-11 items-center justify-center rounded-xl bg-brand px-5 text-sm font-semibold text-white hover:bg-brand-dark">
            + Add New Course
        </a>
    </div>

    @if(session('success'))
        <div role="status" class="rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">
        @forelse($courses as $course)
            <article class="min-w-0 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-lg">
                <div class="relative aspect-video bg-slate-100">
                    @if($course->image)
                        <img src="{{ asset('storage/' . $course->image) }}"
                             alt="{{ $course->title }}"
                             loading="lazy"
                             class="h-full w-full object-cover">
                    @else
                        <div class="flex h-full items-center justify-center text-sm text-slate-400">
                            No Cover Image
                        </div>
                    @endif

                    <span class="absolute left-3 top-3 rounded-full px-3 py-1 text-xs font-semibold
                        {{ $course->is_active ? 'bg-green-50 text-green-700' : 'bg-white text-slate-600' }}">
                        {{ $course->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>

                <div class="space-y-4 p-5">
                    <div>
                        <h2 class="font-heading text-base font-bold text-slate-900">
                            {{ $course->title }}
                        </h2>
                        <p class="mt-1 line-clamp-2 text-sm text-slate-500">
                            {{ $course->short_description ?: $course->subtitle }}
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-2 border-y border-slate-100 py-3">
                        <span class="text-sm font-bold text-brand">
                            {{ $course->fees !== null
                                ? '₹' . number_format((float) $course->fees, 2)
                                : 'Fees on request' }}
                        </span>

                        <span class="text-xs font-medium text-slate-500">
                            {{ $course->duration ?: 'Duration not set' }}
                        </span>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('admin.academy-courses.edit', $course) }}"
                           class="inline-flex min-h-10 flex-1 items-center justify-center rounded-xl border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Edit Course
                        </a>

                        <form method="POST"
                              action="{{ route('admin.academy-courses.destroy', $course) }}"
                              onsubmit="return confirm('Permanently delete this course?')">
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
                <h3 class="font-heading text-lg font-bold">No courses added yet</h3>
                <p class="mt-2 text-sm text-slate-500">
                    Create your first academy training course.
                </p>
            </div>
        @endforelse
    </div>

    {{ $courses->links() }}
</div>
@endsection
