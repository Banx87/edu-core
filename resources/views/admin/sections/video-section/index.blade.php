@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Video Section</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.video-section.update', 1) }}"
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

                                <hr class="mt-2">

                                <div class="col-md-12">
                                    <input type="hidden" name="background_image"
                                        value="{{ old('background_image', $video?->background_image) }}">
                                </div>
                                <div class="col-md-12">
                                    <x-image-preview src="{{ old('background_image', $video?->background_image) }}"
                                        style="max-width:75px; background-color:#9b9b9b" label="" />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="background_image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="background_image" name="background_image"
                                        value="{{ old('background_image', $video?->background_image) }}">
                                    <x-input-error :messages="$errors->get('background_image')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="button_text" class="form-label">Button Text</label>
                                    <input type="text" class="form-control" id="button_text"
                                        value="{{ old('button_text', $video?->button_text) }}" name="button_text">
                                    <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="button_url" class="form-label">Button Url</label>
                                    <input type="text" class="form-control" id="button_url"
                                        value="{{ old('button_url', $video?->button_url) }}" name="button_url">
                                    <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="video_url" class="form-label">Video Url</label>
                                    <input type="text" class="form-control" id="video_url"
                                        value="{{ old('video_url', $video?->video_url) }}" name="video_url">
                                    <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
                                </div>

                                <div class="col-md-10 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control editor"
                                        value="{{ old('description', $video?->description) }}" id="description"
                                        name="description">
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
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
