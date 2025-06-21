@extends('frontend.layouts.master')

@section('content')
    <section class="wsus__breadcrumb" style="background: url({{ asset(config('settings.site_breadcrumb')) }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Student Dashboard</h1>
                            <ul>
                                <li><a href={{ url('/') }}">Home</a></li>
                                <li>Student Dashboard</li>
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

                <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__dashboard_content wsus__dashboard_content_border_top mt-0">
                        <div class="wsus__dashboard_content_top">
                            <div class="wsus__dashboard_heading relative">
                                <h5>Orders</h5>
                                <p>View your order history.</p>
                            </div>
                        </div>
                        <div class="wsus__dash_course_table">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th>No.</th>
                                    <th>Invoice</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td class="p-2 px-4">{{ $loop->iteration }}</td>
                                            <td class="p-2 px-4">{{ $order->invoice_id }}</td>
                                            <td class="p-2 px-4">{{ $order->paid_amount . ' ' . $order->currency }}</td>
                                            <td class="p-2 px-4">
                                                @if ($order->status === 'completed')
                                                    <span class="badge bg-success">Paid</span>
                                                @elseif ($order->status === 'unpaid')
                                                    <span class="badge bg-danger">Unpaid</span>
                                                @elseif ($order->status === 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif ($order->status === 'processing')
                                                    <span class="badge bg-info">Processing</span>
                                                @elseif ($order->status === 'refunded')
                                                    <span class="badge bg-secondary">Refunded</span>
                                                @elseif ($order->status === 'cancelled')
                                                    <span class="badge bg-dark">Cancelled</span>
                                                @endif
                                            </td>
                                            <td class="p-2 px-4">
                                                <a href="{{ route('student.orders.show', $order->id) }}"
                                                    class="btn btn-sm btn-primary">View</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No orders found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="wsus__pagination mt-50 wow fadeInUp">{{ $orders->withQueryString()->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
