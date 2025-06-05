@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Footer Link</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.footer-column-one.index') }}" class="btn btn-pink">
                                <i class="ti ti-arrow-left space"></i>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.footer-column-one.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <x-input-block name="title" label="Title" placeholder="Enter Title"></x-input-block>
                                </div>

                                <div class="col-md-12">
                                    <x-input-block name="url" label="Link Url" placeholder="Enter Url"></x-input-block>
                                </div>

                                <div class="col-md-12">
                                    <x-input-toggle-block name="status" label="Status" description="" :checked="old('status')">
                                    </x-input-toggle-block>
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
