@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Brand Image</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.brand-section.index') }}" class="btn btn-cyan">Cancel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.brand-section.update', $brand->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6 mb-3">
                                <x-image-preview src="{{ old('image', $brand?->image) }}"
                                    style="max-width:75px; background-color:#9b9b9b" label="" />
                                <label for="image" class="form-label">Brand Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <input type="hidden" name="old_image" value="{{ old('image', $brand?->image) }}">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="url" class="form-label">Url</label>
                                <input type="text" class="form-control" id="url" name="url"
                                    placeholder="Enter URL" value="{{ old('url', $brand?->url) }}">
                                <x-input-error :messages="$errors->get('url')" class="mt-2" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="status"
                                    style="min-width: fit-content; margin-right: .5rem;">
                                    Status
                                </label>
                                <select class="select2 form-select" name="status">
                                    <option value="">Please Select</option>
                                    <option value="1" @selected($brand->status == 1)>Active</option>
                                    <option value="0" @selected($brand->status == 0)>Inactive</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
