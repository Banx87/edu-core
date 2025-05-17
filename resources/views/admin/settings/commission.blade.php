@extends('admin.settings.layout')

@section('settings_content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <div class="card-body">
            <form action="{{ route('admin.commission-settings.update') }}" method="POST">
                @csrf
                <h2 class="card-title mt-4">Commission Settings</h2>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="form-label">Instructor Commission Rate Per Sale (%)</div>
                        <input type="text" class="form-control" value="{{ config('settings.commission_rate') }}"
                            name="commission_rate" placeholder="Enter commission rate" />
                        <x-input-error :messages="$errors->get('commission_rate')" class="mt-2" />
                    </div>
                </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list">
                <button type="submit" href="#" class="common_btn"> Submit </button>
            </div>
        </div>
        </form>
    </div>
@endsection
