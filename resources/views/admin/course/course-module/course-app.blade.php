@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create New Course</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-cyan">Cancel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dashboard_add_courses">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="" class="nav-link course-tab {{ request('step') == 1 ? 'active' : '' }}"
                                        data-step="1" type="button">Basic
                                        Infos</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="" class="nav-link course-tab {{ request('step') == 2 ? 'active' : '' }}"
                                        type="button" data-step="2">More
                                        Info</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="" class="nav-link course-tab {{ request('step') == 3 ? 'active' : '' }}"
                                        type="button" data-step="3">Course
                                        Content</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="" class="nav-link course-tab {{ request('step') == 4 ? 'active' : '' }}"
                                        type="button" data-step="4">Finish</a>
                                </li>
                            </ul>
                            @yield('tab_content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        $('#lfm').filemanager('file', {
            prefix: '/admin/laravel-filemanager'
        });
    </script>
@endpush
@push('header_scripts')
    @vite('resources/js/admin/course.js')
@endpush
