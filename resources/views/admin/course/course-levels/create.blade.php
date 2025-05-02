@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Level</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.course-levels.index') }}" class="btn btn-cyan">Cancel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.course-levels.store') }}">
                            @csrf
                            <label for="name" class="form-label">Level Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Level"
                                required>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />

                            <div class="">
                                <button href="{{ route('admin.course-levels.create') }}" class="btn btn-primary mt-3">
                                    <i class="ti ti-device-floppy space"></i>
                                    Add Level
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
