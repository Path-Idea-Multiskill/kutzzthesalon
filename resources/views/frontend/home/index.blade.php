@extends('frontend.layouts.app')

@section('title', 'KUTZ Salon | Premium Beauty & Hair Services')

@section('meta_description', 'Explore professional hair styling, bridal makeup, skincare, salon services and academy courses at KUTZ Salon.')

@section('content')

    @include('frontend.home.sections.hero')

    @include('frontend.home.sections.statistics')

    @include('frontend.home.sections.services')

    @include('frontend.home.sections.videos')

    @include('frontend.home.sections.gallery')

    <!-- @include('frontend.home.sections.instagram') -->


    @include('frontend.home.sections.experience')

    @include('frontend.home.sections.instagram-reels')

    @include('frontend.home.sections.testimonials')

    @include('frontend.home.sections.blogs')

    <!-- @include('frontend.home.sections.academy') -->

    <!-- @include('frontend.home.sections.branches') -->

@endsection