@extends('frontend.layouts.master')
@section('content')
    <!--===========================
                    HERO 3 START
                ============================-->

    @include('frontend.pages.home.sections.hero')

    <!--===========================
                    HERO 3 END
                ============================-->


    <!--===========================
                    CATEGORY 4 START
                ============================-->

    @include('frontend.pages.home.sections.categories')

    <!--===========================
                    CATEGORY 4 END
                ============================-->

    <!--===========================
                    ABOUT 3 START
                ============================-->
    @include('frontend.pages.home.sections.about')
    <!--===========================
                    ABOUT 3 END
                ============================-->


    <!--===========================
                    COURSES 3 START
                    ============================-->
    {{-- @include('frontend.pages.home.sections.course') --}}
    <!--===========================
                    COURSES 3 END
                ============================-->


    <!--===========================
                    OFFER START
                ============================-->
    @include('frontend.pages.home.sections.offer')
    <!--===========================
                    OFFER END
                ============================-->


    <!--===========================
                    BECOME INSTRUCTOR START
                ============================-->
    @include('frontend.pages.home.sections.become-instructor')
    <!--===========================
                    BECOME INSTRUCTOR END
                ============================-->


    <!--===========================
                    VIDEO START
                ============================-->
    @include('frontend.pages.home.sections.video')
    <!--===========================
                    VIDEO END
                ============================-->


    <!--===========================
                    BRAND START
                ============================-->
    @include('frontend.pages.home.sections.brand')
    <!--===========================
                    BRAND END
                ============================-->


    <!--===========================
                    FEATURED COURSES START
                ============================-->
    @include('frontend.pages.home.sections.featured-courses')
    <!--===========================
                    FEATURED COURSES END
                ============================-->


    <!--===========================
                    TESTIMONIAL START
                ============================-->
    @include('frontend.pages.home.sections.testimonials')
    <!--===========================
                    TESTIMONIAL END
                ============================-->


    <!--===========================
                    BLOG-CAROUSEL 4 START
                ============================-->
    @include('frontend.pages.home.sections.blog-carousel')
    <!--===========================
                    BLOG-CAROUSEL 4 END
                ============================-->
@endsection
