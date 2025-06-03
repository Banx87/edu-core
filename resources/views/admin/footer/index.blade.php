@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Footer Contents</h3>
                        <div class="card-actions"></div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.footer.store') }}">
                            @csrf
                            <div class="row">
                                <h4 class="card-title">Footer Information</h4>
                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder="" value="{{ old('description', $footer?->description) }}">
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder=""
                                        value="{{ old('email', $footer?->email) }}" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder=""
                                        value="{{ old('phone', $footer?->phone) }}">
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="copyright" class="form-label">Copyright</label>
                                    <input type="text" class="form-control" id="copyright" name="copyright"
                                        placeholder="" value="{{ old('copyright', $footer?->copyright) }}">
                                    <x-input-error :messages="$errors->get('copyright')" class="mt-2" />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder=""
                                        value="{{ old('address', $footer?->address) }}">
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
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
