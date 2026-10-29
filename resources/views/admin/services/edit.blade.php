
@extends('admin.layouts.app')

@section('title', 'Edit Service | Kutz Salon')

@section('content')

<div class="mx-auto w-full max-w-5xl min-w-0 space-y-6">

    <div>
        <h1 class="font-heading text-xl font-bold sm:text-2xl">
            Edit Service
        </h1>
        <p class="mt-1 text-sm text-slate-500">
            Update service information.
        </p>
    </div>

    <form method="POST"
          action="{{ route('admin.services.update', $service) }}"
          enctype="multipart/form-data"
          class="rounded-2xl border border-slate-200 bg-white
                 p-4 shadow-sm sm:p-6">

        @csrf
        @method('PUT')

        @include('admin.services.partials.form')

    </form>

</div>

@endsection
