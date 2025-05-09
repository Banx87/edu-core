@extends('frontend.instructor-dashboard.course.course-app');

@section('course_content')
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
        <div class="add_course_basic_info">
            <form method="POST" action="{{ route('instructor.courses.store-basic-info') }}"
                class="basic_info_update_form course-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $course->id }}">
                <input type="hidden" name="current_step" value="1">
                <input type="hidden" name="next_step" value ="2">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_input">
                            <label for="#">Title *</label>
                            <input type="text" placeholder="Title" name="title" value="{{ $course->title }}" />
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_input">
                            <label for="#">Seo description</label>
                            <input type="text" placeholder="Seo description" name="seo_description"
                                value="{{ $course->seo_description }}" />
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_input">
                            <label for="#">Thumbnail *</label>
                            <input type="file" name="thumbnail" value="fsdf" />
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="add_course_basic_info_input">
                            <label for="#">Preview Video Storage <b>(optional)</b></label>
                            <select class="select_js preview_video_storage" name="preview_video_storage">
                                <option value="">Please Select</option>
                                @foreach (config('course.video_sources') as $source => $name)
                                    <option @selected($course->preview_video_storage == $source) value="{{ $source }}">{{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div
                            class="add_course_basic_info_input file_source {{ $course->preview_video_storage === 'upload' ? '' : 'd-none' }}">
                            <label for="#">Path</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="common_btn">
                                        <i class="fa fa-picture-o"></i> Choose File
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control source_input" type="text" name="file"
                                    value={{ $course->preview_video_source }}>
                            </div>
                        </div>
                        <div
                            class="add_course_basic_info_input input_source {{ $course->preview_video_storage !== 'upload' ? '' : 'd-none' }}">
                            <label for="#">Path</label>
                            <input type="text" name="url" class="source_input"
                                value={{ $course->preview_video_source }} />
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="add_course_basic_info_input">
                            <label for="#">Price *</label>
                            <input type="text" placeholder="Price" name="price" value="{{ $course->price }}" />
                            <p>Put 0 for free</p>
                        </div>
                        <div class="add_course_basic_info_input">
                            <label for="#">Discount Price</label>
                            <input type="text" placeholder="Price" name="discount" value="{{ $course->discount }}" />
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div id="holder" style="margin-top:15px;max-height:100px;">
                            @if ($course->preview_video_storage === 'upload')
                                <img src="{{ asset($course->preview_video_source) }}" style="height: 5rem;">
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_input mb-0">
                            <label for="#">Description</label>
                            <textarea rows="8" placeholder="Description" name="description">{!! $course->description !!}</textarea>
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
@endpush
