<section class="wsus__quality_courses mt_120 xs_mt_100">
    <div class="row quality_course_slider">
        <div class="quality_course_slider_item"
            style="background: url({{ asset('frontend/assets/images/quality_courses_bg.jpg') }}));">
            <div class="col-12">
                <div class="row align-items-center">
                    <div class="col-xxl-5 col-xl-4 col-md-6 col-lg-7 wow fadeInLeft">
                        <div class="wsus__quality_courses_text">
                            <div class="wsus__section_heading heading_left mb_30">
                                <h5>100% QUALITY COURSES</h5>
                                <h2>{{ $featuredInstructors->title }}</h2>
                            </div>
                            {!! $featuredInstructors->description !!}
                            <a class="common_btn"
                                href={{ $featuredInstructors->button_url }}>{{ $featuredInstructors->button_text }} <i
                                    class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-md-6 col-lg-6 d-none d-xl-block wow fadeInUp">
                        <div class="wsus__quality_courses_img">
                            <img src="{{ asset('frontend/assets/images/quality_courses_img.png') }}"
                                alt="Quality Courses" class="img-fluid w-100">
                        </div>
                    </div>

                    <x-course-card-slider-wrapper>
                        @foreach ($featuredInstructorCourses as $course)
                            <x-course-card-slider :thumbnail="$course->thumbnail" :title="$course->title" :duration="$course->duration"
                                :url="route('courses.show', $course->slug)" :instructor="$course->instructor" :price="$course->price" :discount="$course->discount"
                                :lessons="$course->lessons()->count()" :students="$course->enrollments->count()" :rating="$course->reviews()->avg('rating')" :id="$course->id" />
                        @endforeach
                    </x-course-card-slider-wrapper>
                </div>
            </div>
        </div>
    </div>
</section>
