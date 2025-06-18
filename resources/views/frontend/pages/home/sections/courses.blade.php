@php
    $categories = [
        'categoryOne' => App\Models\CourseCategory::where('id', $latestCourses?->category_one)->first(),
        'categoryTwo' => App\Models\CourseCategory::where('id', $latestCourses?->category_two)->first(),
        'categoryThree' => App\Models\CourseCategory::where('id', $latestCourses?->category_three)->first(),
        'categoryFour' => App\Models\CourseCategory::where('id', $latestCourses?->category_four)->first(),
        'categoryFive' => App\Models\CourseCategory::where('id', $latestCourses?->category_five)->first(),
    ];

@endphp

<section class="wsus__courses_3 pt_120 xs_pt_100 mt_120 xs_mt_90 pb_120 xs_pb_100">
    <div class="container">

        <div class="row">
            <div class="col-xl-6 m-auto wow fadeInUp">
                <div class="wsus__section_heading mb_45">
                    <h5>Featured Courses</h5>
                    <h2>Latest Bundle Courses.</h2>
                </div>
            </div>
        </div>

        <div class="row wow fadeInUp">
            <div class="col-xxl-6 col-xl-8 m-auto">
                <div class="wsus__filter_area mb_15">
                    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                        @foreach ($categories as $index => $category)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $index == 'categoryOne' ? ' active' : '' }}"
                                    id="pills-{{ $category?->id }}-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-{{ $category?->id }}" type="button" role="tab"
                                    aria-controls="pills-{{ $category?->id }}"
                                    aria-selected="{{ $index == 'categoryOne' ? 'true' : 'false' }}">{{ $category?->name }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content" id="pills-tabContent">
            @foreach ($categories as $categoryCourse => $course)
                <div class="tab-pane fade {{ $categoryCourse == 'categoryOne' ? 'show active' : '' }}"
                    id="pills-{{ $course?->id }}" role="tabpanel" aria-labelledby="pills-{{ $course?->id }}-tab"
                    tabindex="0">
                    <div class="row">
                        @if ($course)
                            @foreach ($course->courses()->latest()->take(8)->get() as $course)
                                <x-course-card variant="compact" :thumbnail="$course->thumbnail" :title="$course->title" :duration="$course->duration"
                                    :url="route('courses.show', $course->slug)" :instructor="$course->instructor" :price="$course->price" :discount="$course->discount"
                                    :lessons="$course->lessons()->count()" :students="$course->enrollments->count()" :rating="$course->reviews()->avg('rating')" :id="$course->id" />
                            @endforeach
                        @endif
                    </div>
                    <div class="row mt_60 wow fadeInUp">
                        <div class="col-12 text-center">
                            <a class="common_btn" href="#">Browse More Courses <i
                                    class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</section>
