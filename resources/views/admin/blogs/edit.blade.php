
@extends('admin.layouts.app')

@section('title', 'Edit Blog | Kutz Salon')

@section('content')
<div class="mx-auto w-full max-w-5xl min-w-0 space-y-6 pb-8">
    <div>
        <p class="mb-1 text-xs font-bold uppercase tracking-widest text-brand">Content Management</p>
        <h1 class="font-heading text-2xl font-bold sm:text-3xl">Edit Blog</h1>
        <p class="mt-1 text-sm text-slate-500">Update your article and SEO information.</p>
    </div>

    @if($errors->any())
        <div class="rounded-xl bg-red-50 p-4 text-sm text-red-700">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.blogs.update', $blog) }}"
          enctype="multipart/form-data"
          class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-7">
        @csrf
        @method('PUT')
        @include('admin.blogs.partials.form')
    </form>
</div>
@endsection
