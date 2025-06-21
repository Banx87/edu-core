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
                                <h5>Order: #{{ $order->invoice_id }}</h5>
                                <p>Manage your orders.</p>
                            </div>
                        </div>
                        <div class="card card-lg" style="border: none;">
                            <div class="card-body boirder-0">
                                <div class="row">
                                    <div class="col-6">
                                        <p class="h3">Company</p>
                                        <address>
                                            {{ config('settings.site_title') }}<br>
                                            {{ config('settings.phone') }}<br>
                                            {{ config('settings.location') }}<br>
                                        </address>
                                    </div>
                                    <div class="col-6 text-end">
                                        <p class="h3">Client</p>
                                        <address>
                                            {{ $order->customer->name }}<br>
                                            {{-- Street Address<br> --}}
                                            {{-- State, City<br> --}}
                                            {{-- Region, Postal Code<br> --}}
                                            {{ $order->customer->email }}
                                        </address>
                                    </div>
                                    <div class="col-12 my-5 justify-content-between d-flex">
                                        <h4>Invoice #{{ $order->invoice_id }}</h4>
                                        <h6>Transaction ID: {{ $order->transaction_id }}</h6>
                                    </div>
                                </div>
                                <table class="table table-transparent table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 1%"></th>
                                            <th>Product</th>
                                            <th class="text-center" style="width: 1%">Qnt</th>
                                            <th class="text-end" style="width: 2%; min-width: 170px;">Amount</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $currency = strtoupper($order->currency);
                                        $currencySymbol = $currencySymbols[$currency] ?? '';
                                    @endphp
                                    <tbody class="align-middle">
                                        @foreach ($order->orderItems as $item)
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>
                                                    <p class="strong mb-1">{{ $item->course->title }}</p>
                                                    <div class="text-secondary">By {{ $item->course->instructor->name }}
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-end">{{ $item->price }} {{ $currency }}</td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td colspan="3" class="strong text-end py-4">Subtotal</td>
                                            <td class="text-end py-4">{{ $order->total_amount }} {{ $currency }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="strong text-end py-4">Paid Amount</td>
                                            <td class="text-end py-4"><b>{{ $order->paid_amount }}
                                                    {{ $order->currency }}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p class="text-secondary text-center mt-5">We appreciate your business and look forward
                                    to serving
                                    you again!</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
