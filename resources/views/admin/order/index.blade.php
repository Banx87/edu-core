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
                                        <th class="w-1"></th>
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
                                                {{-- <a href="{{ route('admin.course-orders.edit', $order->id) }}"
                                                    class="btn-sm btn-primary"><svg width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path
                                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                        <path d="M16 5l3 3" />
                                                    </svg></a>
                                                <a href="{{ route('admin.course-orders.destroy', $order->id) }}"
                                                    class="btn-sm text-danger delete-item"><svg width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg></a> --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No orders found.</td>
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
