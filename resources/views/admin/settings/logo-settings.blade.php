@extends('admin.settings.layout')

@section('settings_content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <div class="card-body">
            <form action="{{ route('admin.settings.logo.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2 class="card-title mt-4">Logo & Favicon Settings</h2>
                <div class="row g-3">
                    <div class="col-md-12 d-flex align-items-center m-0">
                        <div class="col-md-3">
                            <x-image-preview src="{{ asset(config('settings.site_logo')) }}"
                                style="margin-bottom: 0 !important; padding: 1rem; padding-left: 0;" />
                        </div>
                        <div class="col-md-8">
                            <x-input-file-block class="form-control" name="site_logo" label="Site Logo" />
                        </div>
                    </div>
                    <div class="col-md-12 d-flex align-items-center m-0">
                        <div class="col-md-3">
                            <x-image-preview src="{{ asset(config('settings.site_favicon')) }}" />
                        </div>
                        <div class="col-md-8">
                            <x-input-file-block class="form-control" name="site_favicon" label="Favicon" />
                        </div>
                    </div>
                    <div class="col-md-12 d-flex align-items-center m-0">
                        <div class="col-md-3">
                            <x-image-preview src="{{ asset(config('settings.site_footer_logo')) }}" />
                        </div>
                        <div class="col-md-8">
                            <x-input-file-block class="form-control" name="site_footer_logo" label="Footer Logo" />
                        </div>
                    </div>
                    <div class="col-md-12 d-flex align-items-center m-0">
                        <div class="col-md-3">
                            <x-image-preview src="{{ asset(config('settings.site_breadcrumb')) }}" />
                        </div>
                        <div class="col-md-8">
                            <x-input-file-block class="form-control" name="site_breadcrumb" label="Breadcrumb" />
                        </div>
                    </div>
                </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list">
                <button type="submit" class="common_btn"> Save Logo Settings </button>
            </div>
        </div>
        </form>
    </div>
@endsection
