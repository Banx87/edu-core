@extends('admin.settings.layout')

@section('settings_content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <div class="card-body">
            <form action="{{ route('admin.general-settings.update') }}" method="POST">
                @csrf
                <h2 class="card-title mt-4">General Settings</h2>
                <div class="row g-3">
                    <div class="col-md-9">
                        <div class="form-label">Site Name</div>
                        <input type="text" class="form-control" value="{{ config('settings.site_title') }}"
                            name="site_title">
                        <x-input-error :messages="$errors->get('site_title')" class="mt-2" />
                    </div>
                    <div class="col-md-6">
                        <div class="form-label">Phone</div>
                        <input type="text" class="form-control" value="{{ config('settings.phone') }}" name="phone">
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                    <div class="col-md-6">
                        <div class="form-label">Location</div>
                        <input type="text" class="form-control" value="{{ config('settings.location') }}"
                            name="location">
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>
                    <div class="col-md-4">
                        <div class="form-label">Site Default Currency</div>
                        <select class="form-select select2" id="" name="currency">
                            <option value="">Select</option>
                            @foreach (config('gateway_currencies.all_currencies') as $key => $currency)
                                <option value="{{ old('currency', $currency['code']) }}" @selected(config('settings.currency') == $currency['code'])>
                                    {{ $currency['name'] }} ({{ $currency['code'] }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('currency')" class="mt-2" />
                    </div>
                    <div class="col-md-4">
                        <div class="form-label">Currency Icon</div>
                        <select class="form-select select2" id="" name="currency_icon">
                            <option value="">Select</option>
                            @foreach (config('gateway_currencies.all_currencies') as $key => $currency)
                                <option value="{{ old('currency', $currency['symbol']) }}" @selected(config('settings.currency_icon') == $currency['symbol'])>
                                    {{ $currency['symbol'] }}
                                    ({{ $currency['code'] }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('currency_icon')" class="mt-2" />
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
