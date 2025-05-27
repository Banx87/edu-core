@extends('frontend.layouts.master')
@section('content')
    @include('frontend.pages.home.sections.hero')

    @include('frontend.pages.home.sections.categories')

    @include('frontend.pages.home.sections.about')
    @include('frontend.pages.home.sections.courses')
    @include('frontend.pages.home.sections.offer')
    @include('frontend.pages.home.sections.become-instructor')
    @include('frontend.pages.home.sections.video')
    @include('frontend.pages.home.sections.brand')
    {{-- @include('frontend.pages.home.sections.featured-courses') --}}
    {{-- @include('frontend.pages.home.sections.testimonials') --}}
    {{-- @include('frontend.pages.home.sections.blog-carousel') --}}
@endsection
