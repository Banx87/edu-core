@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update Category</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.course-categories.index') }}" class="btn btn-pink">
                                <i class="ti ti-arrow-left space"></i>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.course-categories.update', $course_category->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                    <x-input-block name="name" label="Category Name" placeholder="New Category Name"
                                        :value="$course_category->name"></x-input-block>
                                </div>
                                <div class="col-md-6">
                                    <x-input-block name="icon" placeholder="Enter Icon Class Name" :value="$course_category->icon">
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
                                <div class="col-md-12 d-flex" style="">
                                    <div class="col-md-6">
                                        <x-input-file-block name="image" :value="$course_category->image"></x-input-file-block>
                                        <div class="col-md-6 d-flex justify-content-between">
                                            <x-input-toggle-block name="set_trending" label="Set Trending" description=""
                                                :checked="$course_category->set_trending == 1" />
                                            <x-input-toggle-block name="status" label="Status" description=""
                                                :checked="$course_category->status == 1" />
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="padding-left: 10px;">
                                        <x-image-preview :src="asset($course_category->image)" label="Selected image" class="mb-3"
                                            style="max-width:200px; border: 2px solid rgb(255, 255, 255);"></x-image-preview>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <button href="{{ route('admin.course-categories.index') }}" class="btn btn-primary mt-3">
                                    <i class="ti ti-device-floppy space"></i>
                                    Update Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
