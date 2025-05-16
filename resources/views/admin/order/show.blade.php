@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <!-- BEGIN PAGE HEADER -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">Invoice</h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <button type="button" class="btn btn-primary" onclick="javascript:printPageBody();">
                            <i class="ti ti-printer space"></i>
                            Print Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="card card-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p class="h3">Company</p>
                                <address>
                                    Street Address<br>
                                    State, City<br>
                                    Region, Postal Code<br>
                                    ltd@example.com
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
                            <div class="col-12 my-5">
                                <h1>Invoice #{{ $order->invoice_id }}</h1>
                            </div>
                        </div>
                        <table class="table table-transparent table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 1%"></th>
                                    <th>Product</th>
                                    <th class="text-center" style="width: 1%">Qnt</th>
                                    <th class="text-end" style="width: 2%">Amount</th>
                                </tr>
                            </thead>
                            @php
                                $currency = strtoupper($order->currency);
                                $currencySymbol = $currencySymbols[$currency] ?? '';
                            @endphp
                            <tbody>
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>
                                            <p class="strong mb-1">{{ $item->course->title }}</p>
                                            <div class="text-secondary">By {{ $item->course->instructor->name }}</div>
                                        </td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">{{ $currencySymbol }}{{ $item->price }}</td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="3" class="strong text-end">Subtotal</td>
                                    <td class="text-end">{{ $currencySymbol }}{{ $order->total_amount }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="strong text-end">Paid Amount</td>
                                    <td class="text-end">{{ $currencySymbol }}{{ $order->paid_amount }}
                                        {{ $order->currency }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="text-secondary text-center mt-5">We appreciate your business and look forward to serving
                            you again!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    // Don't print the header portion, just the Invoice
    function printPageBody() {
        var printContent = document.querySelector('.page-body').innerHTML;
        var originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>
