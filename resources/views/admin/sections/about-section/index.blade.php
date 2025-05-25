@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">About Us</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.about-section.update', 1) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary mb-3">
                                        <i class="ti ti-device-floppy space"></i>
                                        Save
                                    </button>
                                </div>
                                <h3>Main section</h3>

                                <div class="col-md-12">
                                    <input type="hidden" name="old_image" value="{{ old('image', $about?->image) }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" value="{{ old('title', $about?->title) }}"
                                        id="title" name="title">
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="rounded_text" class="form-label">Rounded Text</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('rounded_text', $about?->rounded_text) }}" id="rounded_text"
                                        name="rounded_text">
                                    <x-input-error :messages="$errors->get('rounded_text')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="image" class="form-label">Title Image</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        value="{{ old('image', $about?->image) }}">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />

                                    <div class="mt-3">
                                        <x-image-preview src="{{ asset($about?->image) }}"
                                            style="max-width:75px; background-color:#9b9b9b;" label="current Image" />
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea type="text" class="form-control" id="description" name="description" rows="6">{!! old('description', $about?->description) !!}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>

                                <hr class="mt-3">

                                <h3>Banner Section</h3>

                                <div class="col-md-12">
                                    <input type="hidden" name="old_banner_image"
                                        value="{{ old('banner_image', $about?->banner_image) }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="banner_title" class="form-label">Banner Title</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('banner_title', $about?->banner_title) }}" id="banner_title"
                                        name="banner_title">
                                    <x-input-error :messages="$errors->get('banner_title')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="banner_text" class="form-label">Banner Text</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('banner_text', $about?->banner_text) }}" id="banner_text"
                                        name="banner_text" />
                                    <x-input-error :messages="$errors->get('banner_text')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="banner_image" class="form-label">Banner Image</label>
                                    <input type="file" class="form-control" id="banner_image" name="banner_image"
                                        value="{{ old('banner_image', $about?->banner_image) }}">
                                    <x-input-error :messages="$errors->get('banner_image')" class="mt-2" />
                                </div>
                                <div class="col-md-12">
                                    <x-image-preview src="{{ asset($about?->banner_image) }}"
                                        style="max-width:75px; background-color:#c5c5c5" label="Current Image" />
                                </div>

                                <hr class="mt-3">



                                <h3>Button Section</h3>
                                <div class="col-md-6 mb-3">
                                    <label for="button_text" class="form-label">Button Text</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('button_text', $about?->button_text) }}" id="button_text"
                                        name="button_text">
                                    <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="button_url" class="form-label">Button Url</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('button_url', $about?->button_url) }}" id="button_url"
                                        name="button_url" />
                                    <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
                                </div>

                                <hr class="mt-3">



                                <h3>Video Section</h3>

                                <div class="col-md-12">
                                    <input type="hidden" name="old_video_image"
                                        value="{{ old('video_image', $about?->video_image) }}">
                                </div>

                                <div class="col-md-6 mb-3">

                                    <label for="video_image" class="form-label">Video Image</label>
                                    <input type="file" class="form-control" id="video_image" name="video_image"
                                        value="{{ old('video_image', $about?->video_image) }}">
                                    <x-input-error :messages="$errors->get('video_image')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="video_url" class="form-label">Video Url</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('video_url', $about?->video_url) }}" id="video_url"
                                        name="video_url" />
                                    <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
                                </div>

                                <div class="col-md-12">
                                    <x-image-preview src="{{ asset($about?->video_image) }}"
                                        style="max-width:75px; background-color:#9b9b9b" label="Current Image" />
                                </div>

                                <hr class="mt-3">

                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">
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
