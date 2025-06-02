@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Top Bar</h3>
                        <div class="card-actions"></div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.top-bar.store') }}">
                            @csrf
                            <div class="row">
                                <h4 class="card-title">Basic Information</h4>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Enter your email address"
                                        value="{{ old('email', $topBar?->email) }}" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Enter your phone number" value="{{ old('phone', $topBar?->phone) }}">
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3 mb-4">
                                    <label for="offer_name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="offer_name" name="offer_name"
                                        placeholder="Enter the name of the offer"
                                        value="{{ old('offer_name', $topBar?->offer_name) }}">
                                    <x-input-error :messages="$errors->get('offer_name')" class="mt-2" />
                                </div>
                                <hr class="mt-3">
                                <h4 class="card-title">Offer</h4>
                                <div class="col-md-6 mb-3">
                                    <label for="offer_short_description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="offer_short_description"
                                        name="offer_short_description" placeholder="Enter a short description of the offer"
                                        value="{{ old('offer_short_description', $topBar?->offer_short_description) }}">
                                    <x-input-error :messages="$errors->get('offer_short_description')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="offer_code" class="form-label">Offer Code</label>
                                    <input type="text" class="form-control" id="offer_code" name="offer_code"
                                        placeholder="Enter the URL for the button"
                                        value="{{ old('offer_code', $topBar?->offer_code) }}">
                                    <x-input-error :messages="$errors->get('offer_code')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="offer_button_text" class="form-label">Button Text</label>
                                    <input type="text" class="form-control" id="offer_button_text"
                                        name="offer_button_text" placeholder="Enter the text for the button"
                                        value="{{ old('offer_button_text', $topBar?->offer_button_text) }}">
                                    <x-input-error :messages="$errors->get('offer_button_text')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="offer_url" class="form-label">Button Url</label>
                                    <input type="url" class="form-control" id="offer_url" name="offer_url"
                                        placeholder="Enter the URL for the button"
                                        value="{{ old('offer_url', $topBar?->offer_url) }}">
                                    <x-input-error :messages="$errors->get('offer_url')" class="mt-2" />
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary mt-3">
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
