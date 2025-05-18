@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Withdrawal details</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.withdraw-request.index') }}" class="btn btn-primary">
                                <i class="ti ti-arrow-left space"></i>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <tbody>
                                    {{-- <td>{{ $withdrawal->instructor }}</td> --}}
                                    <tr>
                                        <td>Instructor</td>
                                        <td>
                                            <div>{{ $withdrawal->instructor->name }}</div>
                                            {{ $withdrawal->instructor->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Current Wallet Balance</td>
                                        <td>
                                            {{ config('settings.currency_icon') }}
                                            {{ $withdrawal->instructor->wallet }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Payout Amount</td>
                                        <td>
                                            {{ config('settings.currency_icon') }}
                                            {{ $withdrawal->amount }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Payout Status</td>
                                        <td>
                                            @if ($withdrawal->status == 'pending')
                                                <span class="badge bg-warning text-yellow-fg">Pending</span>
                                            @elseif($withdrawal->status == 'approved')
                                                <span class="badge bg-success text-green-fg">Approved</span>
                                            @elseif($withdrawal->status == 'rejected')
                                                <span class="badge bg-danger text-red-fg">Rejected</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Action</td>
                                        <td>
                                            <div class="alert alert-danger">Once updated, the status cannot be changed
                                                again.
                                            </div>
                                            <form
                                                action="{{ route('admin.withdraw-request.status.update', $withdrawal->id) }}"
                                                method="POST">
                                                @csrf
                                                <select name="status" id="status" class="form-select disabled"
                                                    {{ $withdrawal->status != 'pending' ? 'disabled' : '' }}>"> <option
                                                        value="">Select Status</option>
                                                    <option value="approved" @selected($withdrawal->status == 'approved')>Approved</option>
                                                    <option value="pending" @selected($withdrawal->status == 'pending')>Pending</option>
                                                    <option value="rejected" @selected($withdrawal->status == 'rejected')>Rejected</option>
                                                </select>
                                                <div class="d-flex">
                                                    <button type="submit" class="common_btn mt-3 mr-5">Update</button>
                                                    <div class="w-100">
                                                        <x-input-error :messages="$errors->get('status')" class="m-3" />
                                                    </div>
                                                </div>
                                            </form>

                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    {{-- {{ $withdrawalRequests->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
