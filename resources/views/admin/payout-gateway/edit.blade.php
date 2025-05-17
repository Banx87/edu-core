@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update Payout Gateway</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.payout-gateway.index') }}" class="btn btn-cyan">
                                <i class="ti ti-arrow-left space"></i>Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.payout-gateway.update', $payout_gateway->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 col-md-5">
                                <label for="gateway_name" class="form-label">Gateway Name</label>
                                <input type="text" class="form-control" id="name" name="gateway_name"
                                    value="{{ old('gateway_name', $payout_gateway->gateway_name) }}"
                                    placeholder="Enter Gateway Name" required>
                                <x-input-error :messages="$errors->get('gateway_name')" class="mt-2" />
                            </div>
                            <div class="mb3 col-md-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="1" @selected($payout_gateway->status == 1)>Active</option>
                                    <option value="0" @selected($payout_gateway->status == 0)>Inactive</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                            <div>
                                <button type="submit" class="common_btn mt-3">
                                    <i class="ti ti-device-floppy space"></i>
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
