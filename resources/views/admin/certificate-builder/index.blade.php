@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <h1>Certificate Builder</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Content</h3>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.certificate-builder.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" placeholder="Enter Certificate Title"
                                        name="title" value="{{ old('title', $certificate->title) }}" />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="subtitle" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" placeholder="Enter Certificate Subtitle"
                                        name="subtitle" value="{{ old('subtitle', $certificate->subtitle) }}" />
                                    <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" placeholder="Enter Certificate Description" name="description">{{ old('description', $certificate->description) }}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                                <div class="form-group mb-3">
                                    @if ($certificate->background)
                                        <x-image-preview src="{{ asset($certificate->background) }}" label="" />
                                    @endif
                                    <label for="background" class="form-label">Background</label>
                                    <input type="file" name="background" class="form-control">
                                    <x-input-error :messages="$errors->get('background')" class="mt-2" />
                                </div>
                                <div class="form-group mb-3">
                                    @if ($certificate->signature)
                                        <x-image-preview src="{{ asset($certificate->signature) }}" label="" />
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
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Builder</h3>
                        </div>
                        <div class="card-body">
                            <div id="certificate-body"
                                style="background-image: url({{ asset($certificate->background) }});">
                                <div id="cert_title">{{ $certificate->title }}</div>
                                <div id="cert_subtitle">{{ $certificate->subtitle }}</div>
                                <div id="cert_description">{{ $certificate->description }}</div>
                                <div id="signature">
                                    <img src="{{ asset($certificate->signature) }}" alt="Signature" id="signature_img"
                                        style="width: 200px; height: auto; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
