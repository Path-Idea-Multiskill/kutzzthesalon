
@extends('admin.layouts.app')

@section('content')
<div class="mx-auto max-w-7xl space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-brand">
                MEDIA MANAGEMENT
            </p>
            <h1 class="mt-2 font-heading text-2xl font-bold text-slate-900">
                Video Management
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Manage YouTube and Instagram videos.
            </p>
        </div>

        <a href="{{ route('admin.videos.create') }}"
           class="inline-flex min-h-11 items-center justify-center rounded-xl bg-brand px-5 py-3 text-sm font-bold text-white hover:bg-brand-dark">
            + Add New Video
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">
        @forelse($videos as $video)
            <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="relative aspect-video bg-slate-100">
                    <img
                        src="{{ asset('storage/'.$video->thumbnail) }}"
                        alt="{{ $video->title }}"
                        class="h-full w-full object-cover"
                        loading="lazy"
                    >

                    <span class="absolute left-3 top-3 rounded-lg bg-white/95 px-3 py-1 text-xs font-bold text-slate-800">
                        {{ ucfirst($video->platform) }}
                    </span>

                    <span class="absolute right-3 top-3 rounded-lg px-3 py-1 text-xs font-bold {{ $video->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $video->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>

                <div class="space-y-4 p-5">
                    <h2 class="line-clamp-2 font-heading text-base font-bold text-slate-900">
                        {{ $video->title }}
                    </h2>

                    <div class="flex items-center justify-between text-xs text-slate-500">
                        <span>Display Order: {{ $video->sort_order }}</span>
                        <a href="{{ $video->video_url }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="font-semibold text-brand">
                            Open Video
                        </a>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('admin.videos.edit', $video) }}"
                           class="flex min-h-11 flex-1 items-center justify-center rounded-xl bg-slate-900 px-4 text-sm font-bold text-white">
                            Edit
                        </a>

                        <form
                            method="POST"
                            action="{{ route('admin.videos.destroy', $video) }}"
                            onsubmit="return confirm('Delete this video?')"
                            class="flex-1"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="min-h-11 w-full rounded-xl border border-red-200 bg-red-50 px-4 text-sm font-bold text-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center sm:col-span-2 xl:col-span-3">
                <p class="font-semibold text-slate-800">No videos added yet.</p>
                <p class="mt-2 text-sm text-slate-500">
                    Add your first YouTube or Instagram video.
                </p>
            </div>
        @endforelse
    </div>

    <div>{{ $videos->links() }}</div>
</div>
@endsection
