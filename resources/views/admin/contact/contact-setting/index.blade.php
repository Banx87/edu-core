@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Contact Settings</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.contact-setting.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-1">
                                    <x-image-preview src="{{ asset(old('image', $contactSettings?->image)) }}"
                                        style="max-width:75px; background-color:#9b9b9b" label="" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        value="{{ old('image', $contactSettings?->image) }}">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter Email" value="{{ old('email', $contactSettings?->email) }}">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="map_url" class="form-label">Map Url</label>
                                    <input type="text" class="form-control" id="map_url" name="map_url"
                                        placeholder="Enter URL" value="{{ old('map_url', $contactSettings?->map_url) }}">
                                    <x-input-error :messages="$errors->get('map_url')" class="mt-2" />
                                </div>
                            </div>

                            <hr class="m3">

                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy space"></i>
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
