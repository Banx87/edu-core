@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Social Link</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.social-links.index') }}" class="btn btn-pink">
                                <i class="ti ti-arrow-left space"></i>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.social-links.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <x-input-block name="url" label="Link Url" placeholder="Link Url"></x-input-block>
                                    <x-input-error :messages="$errors->get('url')" class="" />

                                </div>


                                <div class="col-md-12">
                                    <x-input-toggle-block name="image_type" label="Use Icon or Image" description=""
                                        class="image_style">
                                    </x-input-toggle-block>
                                </div>

                                <div class="col-md-6 d-none icon_input">
                                    <x-input-block name="icon" placeholder="Enter Icon Class Name">
                                        <div style="margin-left: 5px;">
                                            <x-slot name="hint">
                                                <small class="hint" style="margin: 10px;">
                                                    You can get icon class names from
                                                    <a href="https://tabler.io/icons"
                                                        target="_blank">https://tabler.io/icons
                                                    </a>
                                                </small>
                                            </x-slot>
                                        </div>
                                    </x-input-block>
                                </div>

                                <div class="col-md-12 image_select">
                                    <x-input-file-block name="image"></x-input-file-block>
                                </div>

                                <div class="col-md-12">
                                    <x-input-toggle-block name="status" label="Status" description="">
                                    </x-input-toggle-block>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary mt-3">
                                    <i class="ti ti-device-floppy space"></i>
                                    Create Social Link
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
