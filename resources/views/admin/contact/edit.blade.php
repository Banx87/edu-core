@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update Contact Card</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.contact.index') }}" class="btn btn-cyan">Cancel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.contact.update', $contact->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-md-1">
                                    <x-image-preview src="{{ old('icon', $contact?->icon) }}"
                                        style="max-width:75px; background-color:#9b9b9b" label="" />
                                </div>
                                <div class="col-md-7">
                                    <label for="icon" class="form-label">Icon</label>
                                    <input type="file" class="form-control" name="icon"
                                        value="{{ old('icon', $contact->icon) }}" />
                                    <input type="hidden" class="form-control" name="old_icon"
                                        value="{{ old('icon', $contact->icon) }}" />
                                    <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                                </div>

                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title"
                                        value="{{ old('title', $contact->title) }}" />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <div class="mb-3">
                                    <label for="line_two" class="form-label">Line one</label>
                                    <input type="text" class="form-control" name="line_one"
                                        value="{{ old('line_one', $contact->line_one) }}" class="mt-2" />
                                </div>

                                <div class="mb-3">
                                    <label for="line_two" class="form-label">Line two</label>
                                    <input type="text" class="form-control" name="line_two"
                                        value="{{ old('line_two', $contact->line_two) }}" />
                                    <x-input-error :messages="$errors->get('line_two')" class="mt-2" />
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="1" @selected(old('status', $contact->status) == 1)>Active</option>
                                        <option value="0" @selected(old('status', $contact->status) == 0)> Inactive</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>
                            </div>

                            <div class="">
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
