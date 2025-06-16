@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Orders</h3>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Currency</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        @php
                                            $currency = strtoupper($order->currency);
                                            $currencySymbol = $currencySymbols[$currency] ?? '';
                                        @endphp

                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                <div>{{ $order->customer->name }}</div>
                                                <small>{{ $order->customer->email }}</small>
                                            </td>
                                            <td>
                                                {{ $order->total_amount }}
                                                {{ $currencySymbol }}
                                            </td>
                                            <td>
                                                {{ $order->paid_amount }}
                                                {{ $currencySymbol }}
                                            </td>
                                            <td>
                                                {{ strtoupper($order->currency) }}
                                            </td>
                                            <td>
                                                @if ($order->status == 'pending')
                                                    <span class="badge bg-yellow text-yellow-fg">
                                                        {{ $order->status }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-green text-green-fg">{{ $order->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                    class="btn-sm btn-primary"><i class="ti ti-eye"></i></a>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No orders found.</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
