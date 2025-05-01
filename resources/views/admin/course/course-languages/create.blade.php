@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Language</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.course-languages.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.course-languages.store') }}">
                            @csrf
                            <label for="name" class="form-label">Language Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Language Name" required>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />

                            <div class="">
                                <button type="submit" href="{{ route('admin.course-languages.create') }}"
                                    class="btn btn-primary mt-3">
                                    <i class="ti ti-device-floppy space"></i>
                                    Add Language
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
