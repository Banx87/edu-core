@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Feature Page</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.feature.update', 1) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary mb-3">
                                        <i class="ti ti-device-floppy space"></i>
                                        Save
                                    </button>
                                </div>

                                <hr class="mt-2">

                                <h3>1st Feature</h3>

                                <div class="col-md-12">
                                    <input type="hidden" name="old_image_one"
                                        value="{{ old('image_one', $feature?->image_one) }}">
                                </div>
                                <div class="col-md-12">
                                    <x-image-preview src="{{ old('image_one', $feature?->image_one) }}"
                                        style="max-width:75px; background-color:#9b9b9b" label="" />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="image_one" class="form-label">Image One</label>
                                    <input type="file" class="form-control" id="image_one" name="image_one"
                                        value="{{ old('image_one', $feature?->image_one) }}">
                                    <x-input-error :messages="$errors->get('image_one')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="title_one" class="form-label">Title One</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('title_one', $feature?->title_one) }}" id="title_one"
                                        name="title_one">
                                    <x-input-error :messages="$errors->get('title_one')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="text_one" class="form-label">Text One</label>
                                    <input type="text_one" class="form-control" id="text_one"
                                        value="{{ old('text_one', $feature?->text_one) }}" name="text_one">
                                    <x-input-error :messages="$errors->get('text_one')" class="mt-2" />
                                </div>

                                <hr class="mt-3">

                                <h3>2nd Feature</h3>

                                <div class="col-md-12">
                                    <input type="hidden" name="old_image_two"
                                        value="{{ old('image_two', $feature?->image_two) }}">
                                </div>
                                <div class="col-md-12">
                                    <x-image-preview src="{{ old('image_two', $feature?->image_two) }}"
                                        style="max-width:75px; background-color:#9b9b9b" label="" />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="image_two" class="form-label">Image Two</label>
                                    <input type="file" class="form-control" id="image_two" name="image_two">
                                    <x-input-error :messages="$errors->get('image_two')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="title_two" class="form-label">Title Two</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('title_two', $feature?->title_two) }}" id="title_two"
                                        name="title_two">
                                    <x-input-error :messages="$errors->get('title_two')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="text_two" class="form-label">Text Two</label>
                                    <input type="text_two" class="form-control" id="text_two"
                                        value="{{ old('text_two', $feature?->text_two) }}" name="text_two">
                                    <x-input-error :messages="$errors->get('text_two')" class="mt-2" />
                                </div>

                                <hr class="mt-3">

                                <h3>3rd Feature</h3>

                                <div class="col-md-12">
                                    <input type="hidden" name="old_image_three" value="{{ old('image_three') }}">
                                </div>
                                <div class="col-md-12">
                                    <x-image-preview src="{{ old('image_three', $feature?->image_three) }}"
                                        style="max-width:75px; background-color:#9b9b9b" label=""
                                        value="{{ old('image_three', $feature?->image_three) }}" />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="image_three" class="form-label">Image Three</label>
                                    <input type="file" class="form-control" id="image_three" name="image_three"
                                        value="{{ old('image_three', $feature?->image_three) }}">
                                    <x-input-error :messages="$errors->get('image_three')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="title_three" class="form-label">Title Three</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('title_three', $feature?->title_three) }}" id="title_three"
                                        name="title_three">
                                    <x-input-error :messages="$errors->get('title_three')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="text_three" class="form-label">Text Three</label>
                                    <input type="text_three" class="form-control" id="text_three"
                                        value="{{ old('text_three', $feature?->text_three) }}" name="text_three">
                                    <x-input-error :messages="$errors->get('text_three')" class="mt-2" />
                                </div>

                                <hr class="mt-3">

                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary mt-3">
                                        <i class="ti ti-device-floppy space"></i>
                                        Save
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
