@extends('frontend.layouts.master')



@section('content')
    <section class="wsus__breadcrumb" style="background: url({{ asset(config('settings.site_breadcrumb')) }});">
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
                                                    @if ($enrolledCourse->course == null)
                                                        {{-- I guess this is necessary for now, because of data deleted straight from the database. --}}
                                                        {{-- User still has a relationship with a course that is no longer there and caused a null pointer crash. --}}
                                                        {{-- This might not be necessary when the database is full of correct data. --}}
                                                        @continue
                                                    @endif
                                                    @php
                                                        $watchedLessonCount = App\Models\WatchHistory::where([
                                                            'user_id' => Auth::user()->id,
                                                            'course_id' => $enrolledCourse->course->id,
                                                            'is_completed' => 1,
                                                        ])->count();
                                                        $lessonCount = $enrolledCourse->course->lessons->count();

                                                    @endphp
                                                    <tr>
                                                        <td class="image">
                                                            <div class="image_category">
                                                                <img src="{{ asset($enrolledCourse->course?->thumbnail) }}"
                                                                    alt="img" class="img-fluid w-100">
                                                            </div>
                                                        </td>
                                                        <td class="details">
                                                            <p class="rating d-flex align-items-center">
                                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                                <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                                                <i class="far fa-star" aria-hidden="true"></i>
                                                                <span
                                                                    style="margin-left: .2rem; margin-right: 1rem;">(5.0)</span>

                                                                @if ($watchedLessonCount > 0)
                                                                    @php
                                                                        $progress = round(
                                                                            ($watchedLessonCount / $lessonCount) * 100,
                                                                        );
                                                                    @endphp
                                                                @else
                                                                    @if ($watchedLessonCount == $lessonCount && $lessonCount > 0)
                                                                        @php
                                                                            $progress = 100;
                                                                        @endphp
                                                                    @else
                                                                        @php
                                                                            $progress = 0;
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                                <span class="progress progress-sm"
                                                                    style="height: 10px; width: 100%;">
                                                                    <span class="progress-bar" role="progressbar"
                                                                        style="width: {{ $progress }}%; height: 10px;"
                                                                        aria-valuenow="{{ $progress }}"
                                                                        aria-valuemin="0" aria-valuemax="100">
                                                                    </span>
                                                                </span>
                                                            </p>

                                                            <a class="title"
                                                                href="{{ route('student.course-player.index', $enrolledCourse->course->slug) }}">{{ $enrolledCourse->course->title }}</a>
                                                            <div class="text-muted">By
                                                                {{ $enrolledCourse->course->instructor->name }}
                                                            </div>


                                                            @if ($lessonCount == $watchedLessonCount && $lessonCount > 0)
                                                                {{-- <span class="badge bg-success ">Completed</span> --}}
                                                                <a href="{{ route('student.certificate.download', $enrolledCourse->course->id) }}"
                                                                    target="_blank" class="btn btn-success btn-sm"
                                                                    style="display: inline-flex;">
                                                                    <i class="ti ti-certificate"
                                                                        style="margin-right: .3rem"></i>
                                                                    Get Certificate
                                                                </a>
                                                            @endif

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
