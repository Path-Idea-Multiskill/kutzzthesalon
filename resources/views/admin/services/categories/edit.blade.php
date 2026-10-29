
@extends('admin.layouts.app')

@section('title', 'Edit Service Category | Kutz Salon')

@section('content')

<div class="mx-auto w-full max-w-4xl min-w-0">

    <div class="mb-6">
        <h2 class="font-heading text-xl font-bold
                   text-slate-900 sm:text-2xl">
            Edit Service Category
        </h2>
    </div>

    <form method="POST"
          action="{{ route('admin.service-categories.update', $serviceCategory) }}"
          class="rounded-2xl border border-slate-200
                 bg-white p-4 shadow-sm sm:p-6">

        @csrf
        @method('PUT')

        @include('admin.services.categories._form')

    </form>

</div>

@endsection
