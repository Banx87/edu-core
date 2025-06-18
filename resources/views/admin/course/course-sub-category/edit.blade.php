@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update Sub Category of ( {{ $course_category->name }} )</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.course-sub-categories.index', $course_category->id) }}"
                                class="btn btn-pink">
                                <i class="ti ti-arrow-left space"></i>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ route('admin.course-sub-categories.update', [
                                'course_category' => $course_category->id,
                                'course_sub_category' => $course_sub_category->id,
                            ]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                    <x-input-block name="name" label="Category Name" placeholder="New Category Name"
                                        :value="$course_sub_category->name"></x-input-block>
                                </div>
                                <div class="col-md-6">
                                    <x-input-block name="icon" placeholder="Enter Icon Class Name" :value="$course_sub_category->icon">
                                        <div style="margin-left: 5px;">
                                            <x-slot name="hint">
                                                <small class="hint" style="margin: 10px;">You can get icon class
                                                    names
                                                    from <a href="https://tabler.io/icons"
                                                        target="_blank">https://tabler.io/icons</a></small>
                                            </x-slot>
                                        </div>
                                    </x-input-block>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <x-input-toggle-block name="status" label="Status"
                                        description=""></x-input-toggle-block>
                                </div>
                                <div class="col-md-12 d-flex" style="">
                                    <div class="col-md-6">
                                        <x-input-file-block name="image"></x-input-file-block>
                                    </div>
                                    <div class="col-md-6" style="padding-left: 10px;">
                                        @if ($course_sub_category->image)
                                            <x-image-preview :src="asset($course_sub_category->image)" label="Current image" class="mb-3"
                                                style="max-width:200px; border: 2px solid rgb(255, 255, 255);"></x-image-preview>
                                        @else
                                            <div class="d-flex" style="padding-block: 35px; ">No Image Selected</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary mt-3">
                                    <i class="ti ti-device-floppy space"></i>
                                    Update Sub Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
