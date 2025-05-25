@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Hero Page</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.hero.update', 1) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <h3>Title Section</h3>
                                <div class="col-md-6 mb-3">
                                    <label for="label" class="form-label">Label</label>
                                    <input type="text" class="form-control" value="{{ old('label', $hero?->label) }}"
                                        id="label" name="label">
                                    <x-input-error :messages="$errors->get('label')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title"
                                        value="{{ old('title', $hero?->title) }}" name="title">
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="subtitle" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" id="subtitle"
                                        value="{{ old('subtitle', $hero?->subtitle) }}" name="subtitle">
                                    <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                                </div>

                                <hr class="mt-3">

                                <h3>Button Section</h3>
                                <div class="col-md-6 mb-3">
                                    <label for="button_text" class="form-label">Button Text</label>
                                    <input type="text" class="form-control" id="button_text" name="button_text"
                                        value="{{ old('button_text', $hero?->button_text) }}">
                                    <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="button_url" class="form-label">Button Url</label>
                                    <input type="text" class="form-control" id="button_url" name="button_url"
                                        value="{{ old('button_url', $hero?->button_url) }}">
                                    <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
                                </div>

                                <hr class="mt-3">

                                <h3>Video Section</h3>
                                <div class="col-md-6 mb-3">
                                    <label for="video_button_text" class="form-label">Video Button Text</label>
                                    <input type="text" class="form-control" id="video_button_text"
                                        name="video_button_text"
                                        value="{{ old('video_button_text', $hero?->video_button_text) }}">
                                    <x-input-error :messages="$errors->get('video_button_text')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="video_button_url" class="form-label">Video Button Url</label>
                                    <input type="text" class="form-control" id="video_button_url" name="video_button_url"
                                        value="{{ old('video_button_url', $hero?->video_button_url) }}">
                                    <x-input-error :messages="$errors->get('video_button_url')" class="mt-2" />
                                </div>

                                <hr class='mt-3'>

                                <h3>Banner Section</h3>
                                <div class="col-md-6 mb-3">
                                    <label for="banner_item_title" class="form-label">Banner Item Title</label>
                                    <input type="text" class="form-control" id="banner_item_title"
                                        name="banner_item_title"
                                        value="{{ old('banner_item_title', $hero?->banner_item_title) }}">
                                    <x-input-error :messages="$errors->get('banner_item_title')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="banner_item_subtitle" class="form-label">Banner Item Subtitle</label>
                                    <input type="text" class="form-control" id="banner_item_subtitle"
                                        name="banner_item_subtitle"
                                        value="{{ old('banner_item_subtitle', $hero?->banner_item_subtitle) }}">
                                    <x-input-error :messages="$errors->get('banner_item_subtitle')" class="mt-2" />
                                </div>

                                <hr class="mt-3">

                                <div class="col-md-6 mb-3">
                                    <label for="round_text" class="form-label">Round Text</label>
                                    <input type="text" class="form-control" id="round_text" name="round_text"
                                        value="{{ old('round_text', $hero?->round_text) }}">
                                    <x-input-error :messages="$errors->get('round_text')" class="mt-2" />
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="image" class="form-label">Hero Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" name="old_image" value="{{ $hero?->image }}">
                                </div>
                                <div class="col-md-6">
                                    <x-image-preview src="{{ asset($hero?->image) }}"
                                        style="max-width:408px; border: 2px solid rgb(255, 255, 255);"
                                        label="Current Hero Image Preview" />
                                </div>

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
