@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Contact Card</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.contact.index') }}" class="btn btn-cyan">Cancel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.contact.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="icon" class="form-label">Icon</label>
                                <input type="file" class="form-control" name="icon" />
                                <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <label for="line_two" class="form-label">Line one</label>
                                <input type="text" class="form-control" name="line_one" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <label for="line_two" class="form-label">Line two</label>
                                <input type="text" class="form-control" name="line_two" />
                                <x-input-error :messages="$errors->get('line_two')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="1">Active</option>
                                    <option value="0"> Inactive</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>

                            <div class="">
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
