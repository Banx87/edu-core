@extends('frontend.layouts.master')

@section('content')
    <section class="wsus__breadcrumb" style="background: url(images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>My Courses</h1>
                            <ul>
                                <li><a href={{ url('/') }}">Home</a></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">

                @include('frontend.student-dashboard.sidebar')

                <div class="col-xl-9 col-md-8">

                    <div class="wsus__dashboard_content mt-0">
                        <div class="wsus__dashboard_content_top">
                            <div class="wsus__dashboard_heading relative">
                                <h5>My Courses</h5>
                                <p>
                                    View your enrolled courses and track your progress.
                                </p>
                            </div>
                        </div>


                        <div class="wsus__dash_course_table">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th class="image">COURSES</th>
                                                    <th class="details"></th>
                                                    <th class="action">ACTION</th>
                                                </tr>
                                                <tr>
                                                </tr>
                                                @forelse($enrolledCourses as $enrolledCourse)
                                                    <tr>
                                                        <td class="image">
                                                            <div class="image_category">
                                                                <img src="{{ asset($enrolledCourse->course?->thumbnail) }}"
                                                                    alt="img" class="img-fluid w-100">
                                                            </div>
                                                        </td>
                                                        <td class="details">
                                                            <p class="rating">
                                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                                <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                                                <i class="far fa-star" aria-hidden="true"></i>
                                                                <span>(5.0)</span>
                                                                <a href="{{ route('student.certificate.download', $enrolledCourse->course->id) }}"
                                                                    target="_blank" class="btn btn-success btn-sm m-2 mb-0"
                                                                    style="display: inline-flex;">
                                                                    <i class="ti ti-certificate"
                                                                        style="margin-right: .3rem"></i>
                                                                    Get Certificate
                                                                </a>
                                                            </p>
                                                            <a class="title"
                                                                href="{{ route('student.course-player.index', $enrolledCourse->course->slug) }}">{{ $enrolledCourse->course->title }}</a>
                                                            <div class="text-muted">By
                                                                {{ $enrolledCourse->course->instructor->name }}
                                                            </div>
                                                        </td>

                                                        <td class="" style="padding: 30px 0px">
                                                            <a href="{{ route('student.course-player.index', $enrolledCourse->course->slug) }}"
                                                                class="common_btn">Watch</a>
                                                            {{-- <div class="d-flex align-items-center"> --}}


                                                            {{-- </div> --}}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">
                                                            <p>No courses found.</p>
                                                        </td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
