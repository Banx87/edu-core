@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Payout Gateway</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.payout-gateway.index') }}" class="btn btn-cyan">Cancel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.payout-gateway.store') }}">
                            @csrf
                            <div class="mb-3 col-md-6">
                                <label for="gateway_name" class="form-label">Gateway Name</label>
                                <input type="text" class="form-control" id="name" name="gateway_name"
                                    value="{{ old('gateway_name') }}" placeholder="Enter Gateway Name" required>
                                <x-input-error :messages="$errors->get('gateway_name')" class="mt-2" />
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                            <div class="mb-3 col-md-10">
                                <label for="hint" class="form-label">Hint Information</label>
                                <textarea name="hint" id="" cols="30" rows="10"
                                    placeholder="Give users information about what to write here.">{!! old('hint') !!}</textarea>
                                <x-input-error :messages="$errors->get('hint')" class="mt-2" />
                            </div>
                            <div>
                                <button href="{{ route('admin.course-levels.create') }}" class="btn btn-primary mt-3">
                                    <i class="ti ti-device-floppy space"></i>
                                    Add New
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
