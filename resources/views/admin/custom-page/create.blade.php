@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create a New Custom Page</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.custom-page.index') }}" class="btn btn-pink">
                                <i class="ti ti-arrow-left space"></i>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.custom-page.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-1">
                                    <x-input-toggle-block name="status" label="Status" description="" :checked="old('status')">
                                    </x-input-toggle-block>
                                </div>
                                <div class="col-md-11">
                                    <x-input-block name="title" label="Title" placeholder="Enter Title"></x-input-block>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="description">Description</label>
                                        <textarea name="description" class="editor" id=""></textarea>
                                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <x-input-block name="seo_title" label="SEO Title"
                                        placeholder="Enter SEO Title"></x-input-block>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="description">SEO Description</label>
                                    <textarea name="seo_description" class="form-control"></textarea>
                                    <x-input-error :messages="$errors->get('seo_description')" class="mt-2" />
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary mt-3">
                                    <i class="ti ti-device-floppy space"></i>
                                    Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
