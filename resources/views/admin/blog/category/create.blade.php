@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Blog Category</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-pink">
                                <i class="ti ti-arrow-left space"></i>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.blog-categories.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <x-input-block name="title" label="Name" placeholder="Enter Category Name"
                                        :value="old('title')"></x-input-block>

                                </div>

                                <div class="col-md-12">
                                    <x-input-toggle-block name="status" label="Status" description="" :checked="old('status', false)">
                                    </x-input-toggle-block>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary mt-3">
                                    <i class="ti ti-device-floppy space"></i>
                                    Create Blog Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
