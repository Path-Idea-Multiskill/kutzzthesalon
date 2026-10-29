
@extends('admin.layouts.app')

@section('title', 'Add Service | Kutz Salon')

@section('content')

<div class="mx-auto w-full max-w-5xl min-w-0 space-y-6">

    <div>
        <h1 class="font-heading text-xl font-bold sm:text-2xl">
            Add New Service
        </h1>
        <p class="mt-1 text-sm text-slate-500">
            Add a new salon service with price, image and details.
        </p>
    </div>

    <form method="POST"
          action="{{ route('admin.services.store') }}"
          enctype="multipart/form-data"
          class="rounded-2xl border border-slate-200 bg-white
                 p-4 shadow-sm sm:p-6">

        @csrf

        @include('admin.services.partials.form')

    </form>

</div>

@endsection
