<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Chapter</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="{{ route('instructor.course-content.store-lesson') }}" method="POST">
            @csrf
            <input type="hidden" name="course_id" value="{{ $courseId }}">
            <input type="hidden" name="chapter_id" value="{{ $chapterId }}">
            <div class="row">
                <div class="col-md-12 form-group mb-3 add_course_basic_info_input">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" value="{{ @$lesson?->title }}" class="form-control"
                            required />
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="form-group mb-3">
                        <label for="#">Source</label>
                        <select class="form-control add_course_basic_info_input preview_video_storage" name="source"
                            required>
                            <option value="">Please Select</option>
                            @foreach (config('course.video_sources') as $source => $name)
                                <option @selected(@$lesson?->storage == $source) value="{{ $source }}">{{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="add_course_basic_info_input file_source">
                        <label for="#">Path</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="common_btn">
                                    <i class="fa fa-picture-o"></i> Choose File
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control source_input" type="text" name="file"
                                value="{{ @$lesson?->file_path }}" />
                        </div>
                    </div>
                    <div class="add_course_basic_info_input input_source d-none">
                        <label for="#">Path</label>
                        <input type="text" name="url" class="source_input" value="{{ @$lesson?->file_path }}" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="#">File Type</label>
                        <select class="form-control select_js add_course_basic_info_input" name="file_type" required>
                            <option value="">Please Select</option>
                            @foreach (config('course.file_types') as $source => $name)
                                <option @selected(@$lesson?->file_type == $source) value="{{ $source }}">{{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 add_course_basic_info_input">
                        <label for="duration">Duration</label>
                        <input type="text" name="duration" value="{{ @$lesson?->duration }}" required>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="add_course_more_info_checkbox">
                    <div class="form-check">
                        <input @checked(@$lesson->is_preview === 1) class="form-check-input" type="checkbox" name="is_preview"
                            value="1" id="is_preview" />
                        <label class="form-check-label" for="preview">Is Preview:</label>
                    </div>
                    <div class="form-check">
                        <input @checked(@$lesson->downloadable === 1) class="form-check-input" type="checkbox" name="downloadable"
                            value="1" id="downloadable" />
                        <label class="form-check-label" for="downloadable">Is Downloadable:</label>
                    </div>

                </div>
            </div>
            <div class="col-md-12 form-group">
                <label for="" class="mb-2">Description</label>
                <textarea name="description" class="add_course_basic_info_input" style="height: 250px;" required>{!! @$lesson->description !!}</textarea>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="submit" class="common_btn">Create</button>
            </div>
        </form>
    </div>
</div>

<script>
    $('#lfm').filemanager('file');
</script>
