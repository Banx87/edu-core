@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Sub Category</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.course-sub-categories.index', $course_category->id) }}"
                                class="btn btn-pink">
                                <i class="ti ti-arrow-left space"></i>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.course-sub-categories.store', $course_category) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <x-input-block name="name" label="Category Name"
                                        placeholder="New Category Name"></x-input-block>
                                </div>
                                <div class="col-md-6">
                                    <x-input-block name="icon" placeholder="Enter Icon Class Name">
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
                                <div class="col-md-6">
                                    <x-input-file-block name="image"></x-input-file-block>
                                </div>
                                <div class="col-md-12">
                                    {{-- Line Break Div --}}
                                </div>

                                <div class="col-md-2">
                                    <x-input-toggle-block name="status" label="Status"
                                        description=""></x-input-toggle-block>
                                </div>

                            </div>
                            <div class="">
                                <button href="{{ route('admin.course-sub-categories.index', $course_category->id) }}"
                                    class="btn btn-primary mt-3">
                                    <i class="ti ti-device-floppy space"></i>
                                    Create Sub Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
