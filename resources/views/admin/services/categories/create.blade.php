
@extends('admin.layouts.app')

@section('title', 'Add Service Category | Kutz Salon')

@section('content')

<div class="mx-auto w-full max-w-4xl min-w-0">

    <div class="mb-6">
        <h2 class="font-heading text-xl font-bold
                   text-slate-900 sm:text-2xl">
            Add Service Category
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Create a new salon service category.
        </p>
    </div>

    <form method="POST"
          action="{{ route('admin.service-categories.store') }}"
          class="rounded-2xl border border-slate-200
                 bg-white p-4 shadow-sm sm:p-6">

        @csrf

        @include('admin.services.categories._form')

    </form>

</div>

@endsection
