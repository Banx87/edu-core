@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Featured Instructor</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="" enctype="multipart/form-data">
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

                                <div class="col-md-6 mb-3">
                                    <label for="title_one" class="form-label">Title</label>
                                    <input type="text" class="form-control" value="" id="title" name="title">
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <div class="col-md-9 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea type="text" class="form-control editor" id="description" name="description" rows="4">{!! old('description', 'jekke') !!}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>

                                <div class="col-md-8 mb-3">
                                    <label for="button_text" class="form-label">Button Text</label>
                                    <input type="text" class="form-control" value="" id="button_text"
                                        name="button_text">
                                    <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                                </div>

                                <div class="col-md-4 d-flex justify-content-center align-items-center mb-3">
                                    <x-image-preview src=""
                                        style="max-width:200px; overflow-y: visible; background-color:#9b9b9b"
                                        label="" />
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="button_url" class="form-label">Button Url</label>
                                    <input type="text" class="form-control" value="" id="button_url"
                                        name="button_url">
                                    <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
                                </div>

                                <div class="col-md-6">
                                    <label for="instructor" class="form-label">Select Instructor</label>
                                    <select name="instructor" class="select2 form-select">
                                        <option value="">Select</option>
                                        <option value=""></option>
                                    </select>
                                    <x-input-error :messages="$errors->get('instructor')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="image" class="form-label">Instructors Image</label>
                                    <input type="file" class="form-control" id="image" name="image" value="">
                                    <input type="hidden" name="old_image_one" value="">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>

                                <div class="col-md-12">
                                    <label for="courses" class="form-label">Select courses</label>
                                    <select name="courses" class="select2 form-select form-control" multiple>
                                        <option value="">Select</option>
                                        <option value="">Course 1</option>
                                        <option value="">Course 2</option>
                                        <option value="">Course 3</option>
                                        <option value="">Course 4</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('courses')" class="mt-2" />
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
