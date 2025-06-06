@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Blog</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-pink">
                                <i class="ti ti-arrow-left space"></i>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.blogs.update', $blog->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <x-input-block name="title" label="Title" placeholder="Enter Blog Post Title"
                                        :value="old('title', $blog->title)"></x-input-block>
                                </div>

                                <div class="col-md-2 d-flex justify-content-center">
                                    <x-input-toggle-block name="status" label="Status" :checked="$blog->status == 1">
                                    </x-input-toggle-block>
                                </div>
                                <div class="col-md-8 mb-3 px-5">
                                    <div class="form-group"><label for="category" class="form-label">Category</label>
                                        <select name="category" class="form-select form-control">
                                            <option value="">Please Select</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ old($category->id, $category->id) }}"
                                                    @selected($blog->blog_category_id == $category->id)>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('category')" class="mt-2"></x-input-error>

                                    </div>
                                </div>

                                <div class="col-md-12 mb-3 d-flex align-items-center">
                                    <div class="col-md-2 d-flex justify-content-center"
                                        style="background-color: aliceblue; padding: .5rem;">
                                        <x-image-preview src="{{ asset(old('image', $blog?->image)) }}"
                                            style=" background-color:#9b9b9b" label="" />
                                    </div>
                                    <div class="col-md-8 mb-3 px-5">
                                        <x-input-file-block name="blog_image" label="Blog Image" />
                                        <input type="hidden" name="old_image" value="{{ $blog?->image }}">
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group"><label for="content" class="form-label">Blog Post
                                            Content</label>
                                        <textarea name="content" class="editor" style="height: calc(100vh - 600px)">{!! old('content', $blog->content) !!}</textarea>
                                        <x-input-error :messages="$errors->get('content')" class="mt-2"></x-input-error>
                                    </div>
                                </div>


                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary mt-3">
                                    <i class="ti ti-device-floppy space"></i>
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
