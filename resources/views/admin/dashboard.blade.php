@extends('admin.layouts.master')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        Combo layout
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="row row-cards">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                                                    <path d="M12 3v3m0 12v3" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                <b>{{ config('settings.currency_icon') }}{{ $todaysEarnings }}</b>
                                            </div>
                                            <div class="text-secondary">
                                                Today's Sales: <b>{{ $todaysSales }}</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                                                    <path d="M12 3v3m0 12v3" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                <b>{{ config('settings.currency_icon') }}{{ $thisWeekEarnings }}</b>
                                            </div>
                                            <div class="text-secondary">
                                                This Week's Sales: <b>{{ $thisWeekSales }}</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar">
                                                <i class="ti ti-currency-dollar"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                <b>{{ config('settings.currency_icon') }}{{ $thisMonthEarnings }}</b>
                                            </div>
                                            <div class="text-secondary">
                                                This Month's Sales: <b>{{ $thisMonthSales }}</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar">
                                                <i class="ti ti-currency-dollar"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                <b>{{ config('settings.currency_icon') }}{{ $thisYearEarnings }}</b>
                                            </div>
                                            <div class="text-secondary">
                                                This Year's Sales: <b>{{ $thisYearSales }}</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar">
                                                <i class="ti ti-shopping-cart"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                <b>{{ config('settings.currency_icon') }}{{ $totalSalesEarnings }}</b>
                                            </div>
                                            <div class="text-secondary">
                                                Total Sales: <b>{{ $totalSales }}</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-warning text-white avatar">
                                                <i class="ti ti-certificate-2"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="text-secondary">
                                                Pending Courses <b>{{ $pendingCourses }}</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-danger text-white avatar">
                                                <i class="ti ti-certificate-2-off"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="text-secondary">
                                                Rejected Courses: <b>{{ $rejectedCourses }}</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar">
                                                <i class="ti ti-certificate"></i>
                                            </span>
                                        </div>
                                        <div class="col">

                                            <div class="text-secondary">
                                                Total Courses: <b>{{ $totalCourses }}</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-cards mt-1">
                <div class="col-xl-6 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Monthly Order Summary</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">
                                This chart displays the total order amount and the number of orders placed each month.
                            </p>
                            <canvas id="orderChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Recent Courses</h3>
                            </div>
                            <div class="card-table table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Course Name</th>
                                            <th>Instructor</th>
                                            {{-- <th>Students Enrolled</th> --}}
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentCourses as $course)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.courses.edit', $course->id) }}"
                                                        class="ms-1"
                                                        aria-label="Open website"><!-- Download SVG icon from http://tabler.io/icons/icon/link -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="icon icon-1"
                                                            data-darkreader-inline-stroke=""
                                                            style="--darkreader-inline-stroke: currentColor;">
                                                            <path d="M9 15l6 -6"></path>
                                                            <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464">
                                                            </path>
                                                            <path
                                                                d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463">
                                                            </path>
                                                        </svg> {{ Str::limit($course->title, 40) }}</a>
                                                </td>
                                                <td class="text-secondary">{{ $course->instructor->name }}</td>
                                                {{-- <td class="text-secondary text-center">
                                                    {{ $course->enrollments()->count() }}</td> --}}
                                                <td class="text-secondary">
                                                    @if ($course->is_approved == 'approved')
                                                        <span class="badge bg-lime text-lime-fg">Approved</span>
                                                    @elseif($course->is_approved == 'pending')
                                                        <span class="badge bg-warning text-warning-fg">Pending</span>
                                                    @elseif($course->is_approved == 'rejected')
                                                        <span class="badge bg-pink text-red-fg">Rejected</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Recent Blogs</h3>
                            </div>
                            <div class="card-table table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            {{-- <th>Instructor</th> --}}
                                            {{-- <th>Students Enrolled</th> --}}
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentBlogs as $blog)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="ms-1"
                                                        aria-label="Open website"><!-- Download SVG icon from http://tabler.io/icons/icon/link -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="icon icon-1"
                                                            data-darkreader-inline-stroke=""
                                                            style="--darkreader-inline-stroke: currentColor;">
                                                            <path d="M9 15l6 -6"></path>
                                                            <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464">
                                                            </path>
                                                            <path
                                                                d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463">
                                                            </path>
                                                        </svg> {{ Str::limit($blog->title, 50) }}</a>
                                                </td>
                                                {{-- <td class="text-secondary">{{ $course->instructor->name }}</td> --}}
                                                {{-- <td class="text-secondary text-center">
                                                    {{ $course->enrollments()->count() }}</td> --}}
                                                <td class="text-secondary">
                                                    @if ($blog->status == 1)
                                                        <span class="badge bg-lime text-lime-fg">Active</span>
                                                    @elseif($blog->status == 0)
                                                        <span class="badge bg-pink text-red-fg">Inactive</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Recent Orders</h3>
                            </div>
                            <div class="card-table table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Order amount</th>
                                            <th>Course Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentOrders as $order)
                                            <tr>
                                                <td>
                                                    <a
                                                        href="{{ route('admin.orders.show', $order->id) }}">{{ $order->invoice_id }}</a>
                                                </td>
                                                <td>{{ $order->total_amount }} {{ $order->currency }}</td>
                                                <td>
                                                    {{ $order->customer->name }}
                                                    <br />
                                                    <small>
                                                        {{ $order->customer->email }}
                                                    </small>
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
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('orderChart').getContext('2d');
        const orderChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                        label: 'Order Amount ({{ config('settings.currency_icon') }})',
                        data: @json($monthlyOrderSums),
                        fill: true,
                        backgroundColor: 'rgba(0, 84, 166, 0.7)',
                        borderColor: 'rgba(0, 84, 166, 1)',
                        borderWidth: 2,
                        tension: 0.1,
                        yAxisID: 'y',
                    },
                    {
                        label: 'OrderCount',
                        data: @json($monthlyOrderCounts),
                        fill: false,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2,
                        tension: 0.1,
                        type: 'line',
                        yAxisID: 'y1',
                    }
                ]
            },
            options: {
                responsive: true,
                maintainsAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Order Amount ({{ config('settings.currency_icon') }})',
                        },
                        position: 'left'
                    },
                    y1: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Order Count',
                        },
                        position: 'right',
                        grid: {
                            drawOnChartArea: false, // only want the grid lines for one axis to show up
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                return Number.isInteger(value) ? value : null;
                            }
                        }
                    },
                }
            }
        });
    </script>
@endpush
