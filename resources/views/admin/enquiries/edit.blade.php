
@extends('admin.layouts.app')

@section('title', 'Edit Enquiry | Kutzz Salon')

@section('content')
<div class="mx-auto w-full max-w-5xl min-w-0 space-y-6 pb-8">

    <div>
        <p class="mb-1 text-xs font-bold uppercase tracking-widest text-brand">
            Customer Enquiries
        </p>
        <h1 class="font-heading text-2xl font-bold sm:text-3xl">
            Edit Enquiry
        </h1>
        <p class="mt-1 text-sm text-slate-500">
            Update enquiry status and follow-up notes.
        </p>
    </div>

    @if($errors->any())
        <div role="alert" class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <ul class="list-inside list-disc space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.enquiries.update', $enquiry) }}"
          class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-7">
        @csrf
        @method('PUT')
        @include('admin.enquiries.partials.form')
    </form>
</div>
@endsection
