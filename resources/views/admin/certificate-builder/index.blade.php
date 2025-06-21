@extends('admin.layouts.master')

@section('content')
    <style>
        .builder {
            overflow: scroll !important;
        }
    </style>
    <div class="page-body">
        <div class="container-xl">
            <h1 class="no-print">Certificate Builder</h1>
            <div class="row">
                <div class="col-md-4 no-print">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Content</h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <h4 class="alert-heading">Default Variables</h4>
                                <div class="alert-info">[student_name], [course_name], [date], [platform_name],
                                    [instructor_name]</div>
                            </div>
                            <form action="{{ route('admin.certificate-builder.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" placeholder="Enter Certificate Title"
                                        name="title" value="{{ old('title', $certificate?->title) }}" />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="sub_title" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" placeholder="Enter Certificate Subtitle"
                                        name="subtitle" value="{{ old('sub_title', $certificate?->sub_title) }}" />
                                    <x-input-error :messages="$errors->get('sub_title')" class="mt-2" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control editor" placeholder="Enter Certificate Description" name="description" rows="6">{{ old('description', $certificate?->description) }}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                                <div class="form-group mb-3">
                                    @if (!empty($certificate?->background))
                                        <x-image-preview src="{{ asset($certificate?->background) }}" label="" />
                                    @endif
                                    <label for="background" class="form-label">Background</label>
                                    <input type="file" name="background" class="form-control">
                                    <x-input-error :messages="$errors->get('background')" class="mt-2" />
                                </div>
                                <div class="form-group mb-3">
                                    @if (!empty($certificate?->signature))
                                        <x-image-preview src="{{ asset($certificate?->signature) }}" label="" />
                                    @endif
                                    <label for="signature" class="form-label">Signature</label>
                                    <input type="file" name="signature" class="form-control">
                                    <x-input-error :messages="$errors->get('signature')" class="mt-2" />
                                </div>
                                <div class="form-group mt-3">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 builder">
                    <div class="card certificate-builder">
                        <div class="card-header no-print">
                            <h3 class="card-title">Builder</h3>
                        </div>
                        <div class="card-body certificate-builder">
                            <div id="certificate_body"
                                style="background-image: url({{ asset($certificate?->background) }});">
                                <div id="cert_title" class="draggable_item">{{ $certificate?->title }}</div>
                                <div id="cert_subtitle" class="draggable_item">{{ $certificate?->subtitle }}</div>
                                <div id="cert_description" class="draggable_item">{{ $certificate?->description }}
                                </div>
                                <div id="cert_signature" class="draggable_item">
                                    @if (!empty($certificate?->signature))
                                        <img src="{{ asset($certificate?->signature) }}" alt="Signature" id="signature_img"
                                            style="width: 200px; height: auto; object-fit: cover;">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
