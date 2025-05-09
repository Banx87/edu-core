@extends('frontend.instructor-dashboard.course.course-app');

@section('course_content')
    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
        <div class="dashboard_add_course_finish">
            <form action="#" class="more_info_form">
                @csrf
                <input type="hidden" name="id" value={{ @$course->id }}>
                <input type="hidden" name="current_step" value=4 />
                <div class="row">
                    <div class="col-xl-12">
                        <div class="add_course_more_info_input">
                            <label for="#">Message for Reviewer</label>
                            <textarea rows="7" placeholder="Message for Reviewer" name="message">{!! @$course?->message_for_reviewer !!}</textarea>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="add_course_more_info_input mb-0">
                            <label for="#">Status *</label>
                            <select class="select_2" name="status" required>
                                <option value="">Please Select</option>
                                @foreach (config('course.status') as $status => $name)
                                    <option @selected(@$course?->status == @$status) value="{{ @$status }}">{{ @$name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="common_btn mt_25">
                                save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
