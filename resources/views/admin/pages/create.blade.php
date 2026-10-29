
@extends('admin.layouts.app')

@section('title', 'Create Page | Kutz Salon')

@section('content')
<div class="mx-auto max-w-7xl space-y-6 pb-8">

    <div>
        <p class="text-xs font-bold uppercase tracking-widest text-brand">
            Website CMS
        </p>
        <h1 class="mt-2 font-heading text-3xl font-bold text-slate-900">
            Create New Page
        </h1>
        <p class="mt-2 text-sm text-slate-500">
            Add and manage content for your salon website.
        </p>
    </div>

    @if($errors->any())
        <div class="rounded-xl bg-red-50 p-4 text-sm text-red-700">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.pages.store') }}"
          method="POST"
          class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">
        @csrf

        @include('admin.pages.partials.form')
    </form>
</div>
@endsection
