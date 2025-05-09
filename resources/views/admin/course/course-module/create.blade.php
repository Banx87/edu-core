@extends('frontend.instructor-dashboard.course.course-app');

{{-- @section('course_content')
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
        <div class="add_course_basic_info">
            <form method="POST" action="{{ route('instructor.courses.store-basic-info') }}"
                class="basic_info_form course-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="current_step" value="1">
                <input type="hidden" name="next_step" value ="2">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_input">
                            <label for="#">Title *</label>
                            <input type="text" placeholder="Title" name="title" />
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_input">
                            <label for="#">Seo description</label>
                            <input type="text" placeholder="Seo description" name="seo_description" />
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_input">
                            <label for="#">Thumbnail *</label>
                            <input type="file" name="thumbnail" />
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="add_course_basic_info_input">
                            <label for="#">Preview Video Storage <b>(optional)</b></label>
                            <select class="select_js preview_video_storage" name="preview_video_storage">
                                <option value="">Please Select</option>
                                @foreach (config('course.video_sources') as $source => $name)
                                    <option value="{{ $source }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
         
                    <div class="col-xl-6">
                        <div class="add_course_basic_info_input file_source {{ $source == 'upload' ? '' : 'd-none' }}">
                            <label for="#">Path</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="common_btn">
                                        <i class="fa fa-picture-o"></i> Choose File
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control source_input" type="text" name="file"
                                    value={{ $source }}>
                            </div>
                        </div>
                        <div class="add_course_basic_info_input input_source {{ $source != 'upload' ? '' : 'd-none' }}">
                            <label for="#">Path</label>
                            <input type="text" name="url" class="source_input" />
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="add_course_basic_info_input">
                            <label for="#">Price *</label>
                            <input type="text" placeholder="Price" name="price" />
                            <p>Put 0 for free</p>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="add_course_basic_info_input">
                            <label for="#">Discount Price</label>
                            <input type="text" placeholder="Price" name="discount" />
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_input mb-0">
                            <label for="#">Description</label>
                            <textarea rows="8" placeholder="Description" name="description"></textarea>
                            <button type="submit" class="common_btn mt_20">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#lfm').filemanager('file');
    </script>
@endpush --}}

@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Course Create</h3>
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
                            <div class="tab-content" id="pills-tabContent">

                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab" tabindex="0">
                                    <div class="add_course_basic_info">
                                        <form method="POST" action="{{ route('instructor.courses.store-basic-info') }}"
                                            class="basic_info_form course-form" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="current_step" value="1">
                                            <input type="hidden" name="next_step" value ="2">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="add_course_basic_info_input">
                                                        <label for="#">Title *</label>
                                                        <input type="text" placeholder="Title" name="title" />
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="add_course_basic_info_input">
                                                        <label for="#">Seo description</label>
                                                        <input type="text" placeholder="Seo description"
                                                            name="seo_description" />
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="add_course_basic_info_input">
                                                        <label for="#">Thumbnail *</label>
                                                        <input type="file" name="thumbnail" />
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="add_course_basic_info_input">
                                                        <label for="#">Preview Video Storage
                                                            <b>(optional)</b></label>
                                                        <select class="form-control select_js preview_video_storage"
                                                            name="preview_video_storage">
                                                            <option value="">Please Select</option>
                                                            @foreach (config('course.video_sources') as $source => $name)
                                                                <option value="{{ $source }}">{{ $name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div
                                                        class="add_course_basic_info_input file_source {{ $source == 'upload' ? '' : 'd-none' }}">
                                                        <label for="#">Path</label>
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <a id="lfm" data-input="thumbnail"
                                                                    data-preview="holder" class="common_btn">
                                                                    <i class="fa fa-picture-o"></i> Choose File
                                                                </a>
                                                            </span>
                                                            <input id="thumbnail" class="form-control source_input"
                                                                type="text" name="file" value={{ $source }}>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="add_course_basic_info_input input_source {{ $source != 'upload' ? '' : 'd-none' }}">
                                                        <label for="#">Path</label>
                                                        <input type="text" name="url" class="source_input" />
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="add_course_basic_info_input">
                                                        <label for="#">Price *</label>
                                                        <input type="text" placeholder="Price" name="price" />
                                                        <p>Put 0 for free</p>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="add_course_basic_info_input">
                                                        <label for="#">Discount Price</label>
                                                        <input type="text" placeholder="Price" name="discount" />
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="add_course_basic_info_input mb-0">
                                                        <label for="#">Description</label>
                                                        <textarea rows="8" placeholder="Description" name="description"></textarea>
                                                        <button type="submit" class="common_btn mt_20">
                                                            Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#lfm').filemanager('file');
    </script>
@endpush
