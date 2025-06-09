@extends('admin.settings.layout')

@section('settings_content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <div class="card-body">
            <form action="{{ route('admin.settings.commissions.update') }}" method="POST">
                @csrf
                <h2 class="card-title mt-4">Commission Settings</h2>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="form-label">Instructor Commission Rate Per Sale (%)</div>
                        <select name="commission_rate" class="form-select select2">
                            @for ($i = 0; $i <= 100; $i++)
                                <option value="{{ $i }}" @selected(config('settings.commission_rate') == $i || old('commission_rate') == $i)>
                                    {{ $i }}%</option>
                            @endfor
                        </select>
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
