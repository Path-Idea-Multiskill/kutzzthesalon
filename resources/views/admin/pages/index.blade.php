
@extends('admin.layouts.app')

@section('title', 'Pages | Kutz Salon')

@section('content')
<div class="mx-auto max-w-7xl space-y-6 pb-8">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-brand">
                Website CMS
            </p>
            <h1 class="mt-2 font-heading text-3xl font-bold text-slate-900">
                Website Pages
            </h1>
            <p class="mt-2 text-sm text-slate-500">
                Manage static pages and publishing settings.
            </p>
        </div>

        <a href="{{ route('admin.pages.create') }}"
           class="inline-flex items-center justify-center rounded-xl bg-brand px-5 py-3 text-sm font-semibold text-white hover:bg-brand-dark">
            + Add New Page
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 p-5">
            <h2 class="font-bold text-slate-900">
                All Pages ({{ $pages->total() }})
            </h2>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse($pages as $page)
                <div class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="min-w-0">
                        <h3 class="font-semibold text-slate-900">
                            {{ $page->title }}
                        </h3>

                        <p class="mt-1 break-all text-xs text-slate-500">
                            /{{ $page->slug }}
                        </p>

                        <div class="mt-3 flex flex-wrap gap-2">
                            <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $page->is_published ? 'bg-green-50 text-green-700' : 'bg-amber-50 text-amber-700' }}">
                                {{ $page->is_published ? 'Published' : 'Draft' }}
                            </span>

                            @if($page->show_in_footer)
                                <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                                    Footer
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.pages.edit', $page) }}"
                           class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700">
                            Edit
                        </a>

                        <form action="{{ route('admin.pages.destroy', $page) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this page permanently?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="rounded-xl bg-red-50 px-4 py-2 text-sm font-semibold text-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <p class="text-3xl">📄</p>
                    <h3 class="mt-3 font-bold text-slate-900">
                        No Pages Created
                    </h3>
                    <p class="mt-2 text-sm text-slate-500">
                        Create your first website page.
                    </p>
                </div>
            @endforelse
        </div>
    </div>

    {{ $pages->links() }}
</div>
@endsection
