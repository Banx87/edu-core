@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Testimonial</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.testimonial-section.index') }}" class="btn btn-cyan">Cancel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.testimonial-section.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Name" value="{{ old('name') }}">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb3">
                                    <label for="image" class="form-label">User Image</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        value="{{ old('image') }}">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter Title" value="{{ old('title') }}">
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input type="file" class="form-control" id="logo" name="logo"
                                        value="{{ old('logo') }}">
                                    <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="review" class="form-label">Review</label>
                                    <textarea name="review" id="review" cols="30" rows="5" class="form-control" maxlength="1000">{{ old('review') }}</textarea>
                                    <x-input-error :messages="$errors->get('review')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="rating" class="form-label">Rating</label>
                                    <select class="select2 form-select form-control" name="rating">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <option value="{{ $i }}" @selected(old('rating') == $i)>
                                                {{ $i }}</option>
                                        @endfor
                                    </select>
                                    <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                                </div>
                            </div>

                            <hr class="m3">

                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy space"></i>
                                Create
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
