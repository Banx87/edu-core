@extends('frontend.layouts.master')

@section('content')
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">

                @include('frontend.instructor-dashboard.sidebar')

                <div class="col-xl-9 col-md-8 wow fadeInRight">
                    <div class="wsus__dashboard_content m-0 wsus__dashboard_content_border_top">
                        <div class="wsus__dashboard_content_top">
                            <div class="wsus__dashboard_heading relative">
                                <h5>Courses</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                                <a class="common_btn" href="{{ route('instructor.courses.create') }}">+ add course</a>
                            </div>
                        </div>

                        {{-- <form action="#" class="wsus__dash_course_searchbox">
                            <div class="input">
                                <input type="text" placeholder="Search our Courses">
                                <button><i class="far fa-search"></i></button>
                            </div>
                            <div class="selector">
                                <select class="select_js">
                                    <option value="">Choose</option>
                                    <option value="">Choose 1</option>
                                    <option value="">Choose 2</option>
                                </select>
                            </div>
                        </form> --}}

                        <div class="wsus__dash_course_table">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th class="image">
                                                        COURSES
                                                    </th>
                                                    <th class="details">

                                                    </th>
                                                    <th class="sale">
                                                        STUDENTS
                                                    </th>
                                                    <th class="status">
                                                        STATUS
                                                    </th>
                                                    <th class="action">
                                                        ACTION
                                                    </th>
                                                </tr>
                                                @foreach ($courses as $course)
                                                    <tr>
                                                        <td class="image">
                                                            <div class="image_category">
                                                                <img src="{{ asset($course->thumbnail) }}" alt="img"
                                                                    class="img-fluid w-100">
                                                            </div>
                                                        </td>
                                                        <td class="details">
                                                            <p class="rating">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $course->reviews()->avg('rating'))
                                                                        <i class="ti ti-star-filled"
                                                                            style="font-size: 17px"></i>
                                                                    @else
                                                                        <i class="ti ti-star" style="font-size: 17px"></i>
                                                                    @endif
                                                                @endfor
                                                                @if ($course->reviews()->avg('rating') > 0)
                                                                    <span>({{ number_format($course->reviews()->avg('rating'), 1) }}
                                                                        Rating)</span>
                                                                @else
                                                                    <span>No Reviews Yet</span>
                                                                @endif
                                                            </p>

                                                            <a class="title" href="#">{{ $course->title }}</a>

                                                        </td>
                                                        <td class="sale">
                                                            <p>{{ $course->enrollments()->count() }}</p>
                                                        </td>
                                                        <td class="status">
                                                            <p class="active">{{ $course->status }}</p>
                                                        </td>
                                                        <td class="action">
                                                            <a class="edit"
                                                                href="{{ route('instructor.courses.edit', ['id' => $course->id, 'step' => '1']) }} "><i
                                                                    class="far fa-edit"></i></a>
                                                            <a class="del" href="#"><i
                                                                    class="fas fa-trash-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach

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
