@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Site Settings</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.course-levels.index') }}" class="btn btn-cyan">Cancel</a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="card">
                            <div class="row g-0">
                                @include('admin.settings.sidebar')
                                @yield('settings_content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
