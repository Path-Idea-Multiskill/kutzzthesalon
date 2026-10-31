
@extends('admin.layouts.app')

@section('title', 'Add Academy Course | Kutzz Salon')

@section('content')
<div class="mx-auto w-full max-w-5xl min-w-0 space-y-6 pb-8">

    <div>
        <p class="mb-1 text-xs font-bold uppercase tracking-widest text-brand">
            Academy Management
        </p>
        <h1 class="font-heading text-2xl font-bold sm:text-3xl">
            Add New Course
        </h1>
        <p class="mt-1 text-sm text-slate-500">
            Create a professional salon training course.
        </p>
    </div>

    @if($errors->any())
        <div role="alert" class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <ul class="list-inside list-disc">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.academy-courses.store') }}"
          enctype="multipart/form-data"
          class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-7">
        @csrf

        @include('admin.academy.partials.form')
    </form>
</div>
@endsection
