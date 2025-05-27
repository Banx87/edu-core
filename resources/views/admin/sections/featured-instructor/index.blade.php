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
                        <form method="POST" action="{{ route('admin.featured-instructor-section.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary mb-3">
                                        <i class="ti ti-device-floppy space"></i>
                                        Save
                                    </button>
                                </div>

                                <hr class="mt-2">

                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('title', $featuredInstructor?->title) }}" id="title"
                                        name="title">
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <div class="col-md-8 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea type="text" class="form-control editor" id="description" name="description" rows="4">{{ old('description', $featuredInstructor?->description) }}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>

                                <div class="col-md-4 d-flex justify-content-center mb-3">
                                    <x-image-preview
                                        src="{{ old('instructor_image', $featuredInstructor?->instructor_image) }}"
                                        style="max-width:200px; overflow-y: visible; background-color:#ffffff; object-fit: contain !important; border: 1px solid var(--borderColor); border-radius: 6px;"
                                        label="Image Preview" class="form-control" />
                                </div>

                                <div class="col-md-6">
                                    <label for="instructor_id" class="form-label ">Select Instructor</label>
                                    <select name="instructor_id" class="select2 form-select selected_instructor">
                                        <option value="">Select</option>
                                        @foreach ($instructors as $instructor)
                                            <option value="{{ $instructor->id }}"
                                                {{ $instructor->id == old('instructor_id', $featuredInstructor?->instructor_id) ? 'selected' : '' }}>
                                                {{ $instructor->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('instructor')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="instructor_image" class="form-label">Instructors Image</label>
                                    <input type="file" class="form-control" id="instructor_image" name="instructor_image"
                                        value="{{ old('instructor_image', $featuredInstructor?->instructor_image) }}">
                                    <x-input-error :messages="$errors->get('instructor_image')" class="mt-2" />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="featured_courses" class="form-label">Select courses</label>
                                    <select name="featured_courses[]" id="instructor_courses"
                                        class="select2 form-select form-control" multiple>
                                        @foreach ($selectedInstructorCourses as $course)
                                            <option value="{{ $course->id }}" @selected(in_array($course->id, $selectedCourses ?? []))>
                                                {{ $course->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('featured_courses')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="button_text" class="form-label">Button Text</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('button_text', $featuredInstructor?->button_text) }}"
                                        id="button_text" name="button_text">
                                    <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="button_url" class="form-label">Button Url</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('button_url', $featuredInstructor?->button_url) }}" id="button_url"
                                        name="button_url">
                                    <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
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
