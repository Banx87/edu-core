@extends('frontend.layouts.master')

@section('content')
    <section class="wsus__breadcrumb" style="background: url({{ asset(config('settings.site_breadcrumb')) }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Instructor Dashboard</h1>
                            <ul>
                                <li><a href={{ url('/') }}">Home</a></li>
                                <li>Instructor Dashboard</li>
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

                @include('frontend.instructor-dashboard.sidebar')

                <div class="col-xl-9 col-md-8">

                    @if (auth()->user()->approve_status === 'pending')
                        <div class="alert-wrapper">
                            <symbol id="check-circle-fill" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </symbol>
                            <symbol id="info-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                            </symbol>
                            <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </symbol>
                            </svg>
                            <div class="alert alert-primary d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:"
                                    style="width: 1.5em; height: 1.5em;">
                                    <use xlink:href="#info-fill" />
                                </svg>
                                <div>
                                    Hi, {{ Auth::user()->name }}! Your instructor request is currently pending. We will
                                    send
                                    you an
                                    email, when it will be approved.
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (Auth::user()->role === 'instructor' && Auth::user()->approve_status === 'approved')
                        {{-- <div class="text-end mb-3">
                            <a href="{{ route('instructor.dashboard') }}" class="common_btn">Switch to Instructor Dashboard
                                View</a>
                        </div> --}}
                    @else
                        <div class="text-end">
                            <a href="{{ route('student.become-instructor') }}" class="common_btn">Become an
                                Instructor</a>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>PENDING COURSES</h6>
                                <h3>{{ $pendingCourses }}</h3>
                                <p>Courses pending approval</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>APPROVED COURSES</h6>
                                <h3>{{ $approvedCourses }}</h3>
                                <p>Courses approved</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>REJECTED COURSES</h6>
                                <h3>{{ $rejectedCourses }}</h3>
                                <p>Courses rejected</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>REVENUE</h6>
                                <h3>${{ number_format($monthlySalesEarnings, 2) }}</h3>
                                <p>Earning this month</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>STUDENT ENROLLMENTS</h6>
                                <h3>{{ $totalStudents }}</h3>
                                <p>Your total student count</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>TOTAL EARNINGS</h6>
                                <h3>${{ number_format($totalEarnings, 2) }}</h3>
                                <p>All earnings as an instructor</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12 wow fadeInRight mt-4"
                        style="visibility: visible; animation-name: fadeInRight;">
                        <div class="wsus__dashboard_content wsus__dashboard_content_border_top mt-0">

                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <th>Course Name</th>
                                    <th>Purchased By</th>
                                    <th>Price</th>
                                    <th>Commission</th>
                                    <th>Instructor Share</th>
                                </thead>
                                <tbody>
                                    @forelse ($orderItems as $orderItem)
                                        <tr>
                                            <td>{{ $orderItem->course->title }}</td>
                                            <td>{{ $orderItem->order->customer->name }}</td>
                                            <td>{{ $orderItem->price }}</td>
                                            <td>{{ $orderItem->commission ?? 0 }}%</td>
                                            <td>{{ calculateCommission($orderItem->price, $orderItem->commission) }}
                                                {{ $orderItem->order->currency }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No orders found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
