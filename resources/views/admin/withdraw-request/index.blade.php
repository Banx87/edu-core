@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Withdraw Requests</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Instructor</th>
                                        <th>Email</th>
                                        <th>Payout Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($withdrawalRequests as $withdrawalRequest)
                                        <tr>
                                            <td>
                                                {{ $withdrawalRequest->instructor->name }}
                                            </td>
                                            <td>
                                                {{ $withdrawalRequest->instructor->email }}
                                            </td>
                                            <td>
                                                {{ config('settings.currency_icon') }}
                                                {{ $withdrawalRequest->amount }}
                                            </td>
                                            <td>
                                                @if ($withdrawalRequest->status == 'pending')
                                                    <span class="badge bg-warning text-yellow-fg">Pending</span>
                                                @elseif($withdrawalRequest->status == 'approved')
                                                    <span class="badge bg-success text-green-fg">Approved</span>
                                                @elseif($withdrawalRequest->status == 'rejected')
                                                    <span class="badge bg-danger text-red-fg">Rejected</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.withdraw-request.show', $withdrawalRequest->id) }}"
                                                    class="btn-sm btn-primary"><i class="ti ti-eye"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No withdrawalRequestRequests found.</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    {{ $withdrawalRequests->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
