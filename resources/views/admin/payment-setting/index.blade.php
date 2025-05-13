@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Level</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.course-levels.index') }}" class="btn btn-cyan">Cancel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs">
                                    <li class="nav-item">
                                        <a href="#paypal-settings" class="nav-link active" data-bs-toggle="tab">
                                            <i class="ti ti-brand-paypal space"></i>
                                            Paypal Settings
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tabs-profile-ex5" class="nav-link" data-bs-toggle="tab">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tabs-activity-ex5" class="nav-link" data-bs-toggle="tab">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                                <path d="M3 12h4l3 8l4 -16l3 8h4" />
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="paypal-settings">
                                        <form action="{{ route('admin.paypal-settings.update') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label for="paypal_mode" class="form-label">Paypal Mode</label>
                                                    <select name="paypal_mode" id="paypal_mode" class="form-select">
                                                        <option value="sandbox">Sandbox</option>
                                                        <option value="live">Live</option>
                                                    </select>
                                                    <x-input-error :messages="$errors->get('paypal_mode')" class="mt-2" />
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="currency" class="form-label">Currency</label>
                                                    <select name="paypal_currency" id="paypal_currency"
                                                        class="form-control form-select select2">
                                                        @foreach (config('gateway_currencies.paypal_currencies') as $currency => $value)
                                                            <option value="{{ $value['code'] }}">{{ $value['name'] }} -
                                                                ({{ $value['code'] }})
                                                                - {{ $value['symbol'] }}
                                                            </option>)
                                                        @endforeach
                                                    </select>
                                                    <x-input-error :messages="$errors->get('paypal_currency')" class="mt-2" />
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="rate" class="form-label">Rate (USD)</label>
                                                    <input type="text" id="paypal_rate" name="paypal_rate"
                                                        class="form-control">
                                                    <x-input-error :messages="$errors->get('paypal_rate')" class="mt-2"
                                                        placeholder="Enter PayPal Rate" />
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label for="client_id" class="form-label">Client ID</label>
                                                    <input type="text" id="client_id" name="paypal_client_id"
                                                        class="form-control" placeholder="Enter PayPal Client ID">
                                                    <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label for="client_secret" class="form-label">Client Secret</label>
                                                    <input type="text" id="client_secret" name="paypal_client_secret"
                                                        class="form-control" placeholder="Enter PayPal Client Secret">
                                                    <x-input-error :messages="$errors->get('paypal_client_secret')" class="mt-2" />
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label for="app_id" class="form-label">App ID</label>
                                                    <input type="text" id="app_id" name="paypal_app_id"
                                                        class="form-control" placeholder="Enter PayPal App ID">
                                                    <x-input-error :messages="$errors->get('paypal_app_id')" class="mt-2" />
                                                </div>
                                            </div>
                                            <button type='submit' class="common_btn mt-5">Save Changes</button>
                                        </form>
                                    </div>

                                    <div class="tab-pane" id="tabs-profile-ex5">
                                        <h4>Profile tab</h4>
                                        <div>
                                            Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique
                                            enim at diam, sem nunc
                                            amet, pellentesque id egestas velit sed
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-activity-ex5">
                                        <h4>Activity tab</h4>
                                        <div>
                                            Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus
                                            amet, facilisi sit
                                            mauris accumsan nibh habitant senectus
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
