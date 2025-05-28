@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Testimonial</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.testimonial-section.index') }}" class="btn btn-cyan">Cancel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.testimonial-section.update', $testimonial->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Name" value="{{ old('name', $testimonial->user_name) }}">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div class="col-md-5 mb3">
                                    <label for="user_image" class="form-label">User Image</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        value="{{ old('user_image', $testimonial->user_image) }}">
                                    <x-input-error :messages="$errors->get('user_image')" class="mt-2" />
                                    <input type="hidden" name="old_image" value="{{ $testimonial->image }}">

                                </div>

                                <div class="col-md-1 mb-3">
                                    <x-image-preview src="{{ old('user_image', $testimonial?->user_image) }}"
                                        style="max-width:75px; background-color:#9b9b9b" label="" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter Title" value="{{ old('title', $testimonial->user_title) }}">
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <div class="col-md-5 mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input type="file" class="form-control" id="logo" name="logo"
                                        value="{{ old('logo', $testimonial->logo) }}">
                                    <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                                    <input type="hidden" name="old_logo" value="{{ $testimonial->logo }}">
                                </div>

                                <div class="col-md-1 d-flex align-items-center">
                                    <x-image-preview style="margin: 0 !important; padding-top: 1rem;"
                                        src="{{ old('logo', $testimonial?->logo) }}" label="" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="review" class="form-label">Review <small>(max 1000
                                            characters)</small></label>
                                    <textarea name="review" id="review" cols="30" rows="6" class="form-control" maxlength="1000">{{ old('review', $testimonial->review) }}</textarea>
                                    <x-input-error :messages="$errors->get('review')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="rating" class="form-label">Rating</label>
                                    <select class="select2 form-select form-control" name="rating">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <option value="{{ $i }}" @selected(old('rating', $testimonial->rating) == $i)>
                                                {{ $i }}</option>
                                        @endfor
                                    </select>
                                    <x-input-error :messages="$errors->get('rating')" class="mt-2" />
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
