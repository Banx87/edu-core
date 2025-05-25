@php
    $categories = [
        'categoryOne' => App\Models\CourseCategory::where('id', $latestCourses->category_one)->first(),
        'categoryTwo' => App\Models\CourseCategory::where('id', $latestCourses->category_two)->first(),
        'categoryThree' => App\Models\CourseCategory::where('id', $latestCourses->category_three)->first(),
        'categoryFour' => App\Models\CourseCategory::where('id', $latestCourses->category_four)->first(),
        'categoryFive' => App\Models\CourseCategory::where('id', $latestCourses->category_five)->first(),
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
                                    id="pills-{{ $category->id }}-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-{{ $category->id }}" type="button" role="tab"
                                    aria-controls="pills-{{ $category->id }}"
                                    aria-selected="{{ $index == 'categoryOne' ? 'true' : 'false' }}">{{ $category->name }}
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
                    id="pills-{{ $course->id }}" role="tabpanel" aria-labelledby="pills-{{ $course->id }}-tab"
                    tabindex="0">
                    <div class="row">
                        {{-- {{ $course->courses()->take(8) }} --}}
                        {{-- @foreach ($course->courses() as $item) --}}
                        @foreach ($course->courses()->latest()->take(8)->get() as $course)
                            <div class="col-xl-3 col-md-6 col-lg-4">
                                <div class="wsus__single_courses_3">
                                    <div class="wsus__single_courses_3_img">
                                        <img src="{{ asset($course->thumbnail) }}" alt="{{ $course->title }}"
                                            class="img-fluid">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}"
                                                        alt="Love" class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}"
                                                        alt="Compare" class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}"
                                                        alt="Cart" class="img-fluid">
                                                </a>
                                            </li>
                                        </ul>
                                        <span class="time"><i class="far fa-clock"></i> 15 Hours</span>
                                    </div>
                                    <div class="wsus__single_courses_text_3">
                                        <div class="rating_area">
                                            <!-- <a href="#" class="category">Design</a> -->
                                            <p class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <span>(4.8 Rating)</span>
                                            </p>
                                        </div>

                                        <a class="title"
                                            href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                                        <ul>
                                            <li>24 Lessons</li>
                                            <li>38 Student</li>
                                        </ul>
                                        <a class="author" href="#">
                                            <div class="img">
                                                <img src={{ asset($course->instructor->image) }} alt="Author"
                                                    class="img-fluid">
                                            </div>
                                            <h4>{{ $course->instructor->name }}</h4>
                                        </a>
                                    </div>
                                    <div class="wsus__single_courses_3_footer">
                                        <a class="common_btn add_to_cart" href="javascript:;"
                                            data-course-id={{ $course->id }}>Enroll <i
                                                class="far fa-arrow-right"></i></a>
                                        @if ($course->discount > 0)
                                            <p><del>${{ $course->price }}</del> ${{ $course->discount }}</p>
                                        @else
                                            <p>${{ $course->price }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- <div class="col-xl-3 col-md-6 col-lg-4">
                        <div class="wsus__single_courses_3">
                            <div class="wsus__single_courses_3_img">
                                <img src="{{ asset('frontend/assets/images/courses_3_img_2.jpg') }}" alt="Courses"
                                    class="img-fluid">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}"
                                                alt="Love" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}"
                                                alt="Compare" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}"
                                                alt="Cart" class="img-fluid">
                                        </a>
                                    </li>
                                </ul>
                                <span class="time"><i class="far fa-clock"></i> 24 Hours</span>
                            </div>
                            <div class="wsus__single_courses_text_3">
                                <div class="rating_area">
                                    <!-- <a href="#" class="category">Business</a> -->
                                    <p class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span>(4.9 Rating)</span>
                                    </p>
                                </div>

                                <a class="title" href="#">50 Tips For Designing an Exceptional
                                    Online Learning Progress.</a>
                                <ul>
                                    <li>32 Lessons</li>
                                    <li>48 Student</li>
                                </ul>
                                <a class="author" href="#">
                                    <div class="img">
                                        <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}"
                                            alt="Author" class="img-fluid">
                                    </div>
                                    <h4>Hugh Millie-Yate</h4>
                                </a>
                            </div>
                            <div class="wsus__single_courses_3_footer">
                                <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                <p>$239.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-4">
                        <div class="wsus__single_courses_3">
                            <div class="wsus__single_courses_3_img">
                                <img src="{{ asset('frontend/assets/images/courses_3_img_3.jpg') }}" alt="Courses"
                                    class="img-fluid">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}"
                                                alt="Love" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}"
                                                alt="Compare" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}"
                                                alt="Cart" class="img-fluid">
                                        </a>
                                    </li>
                                </ul>
                                <span class="time"><i class="far fa-clock"></i> 17 Hours</span>
                            </div>
                            <div class="wsus__single_courses_text_3">
                                <div class="rating_area">
                                    <!-- <a href="#" class="category">Marketing</a> -->
                                    <p class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span>(4.8 Rating)</span>
                                    </p>
                                </div>

                                <a class="title" href="#">Holistic Internet-Based Instruction
                                    Mastery Program.</a>
                                <ul>
                                    <li>37 Lessons</li>
                                    <li>56 Student</li>
                                </ul>
                                <a class="author" href="#">
                                    <div class="img">
                                        <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}"
                                            alt="Author" class="img-fluid">
                                    </div>
                                    <h4>Dominic L. Ement</h4>
                                </a>
                            </div>
                            <div class="wsus__single_courses_3_footer">
                                <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                <p>$199.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-4">
                        <div class="wsus__single_courses_3">
                            <div class="wsus__single_courses_3_img">
                                <img src="{{ asset('frontend/assets/images/courses_3_img_4.jpg') }}" alt="Courses"
                                    class="img-fluid">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}"
                                                alt="Love" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}"
                                                alt="Compare" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}"
                                                alt="Cart" class="img-fluid">
                                        </a>
                                    </li>
                                </ul>
                                <span class="time"><i class="far fa-clock"></i> 15 Hours</span>
                            </div>
                            <div class="wsus__single_courses_text_3">
                                <div class="rating_area">
                                    <!-- <a href="#" class="category">Design</a> -->
                                    <p class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span>(4.8 Rating)</span>
                                    </p>
                                </div>

                                <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                <ul>
                                    <li>24 Lessons</li>
                                    <li>38 Student</li>
                                </ul>
                                <a class="author" href="#">
                                    <div class="img">
                                        <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}"
                                            alt="Author" class="img-fluid">
                                    </div>
                                    <h4>Hermann P. Schnitzel</h4>
                                </a>
                            </div>
                            <div class="wsus__single_courses_3_footer">
                                <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                <p><del>$254</del> $156.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-4">
                        <div class="wsus__single_courses_3">
                            <div class="wsus__single_courses_3_img">
                                <img src="{{ asset('frontend/assets/images/courses_3_img_9.jpg') }}" alt="Courses"
                                    class="img-fluid">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}"
                                                alt="Love" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}"
                                                alt="Compare" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}"
                                                alt="Cart" class="img-fluid">
                                        </a>
                                    </li>
                                </ul>
                                <span class="time"><i class="far fa-clock"></i> 15 Hours</span>
                            </div>
                            <div class="wsus__single_courses_text_3">
                                <div class="rating_area">
                                    <!-- <a href="#" class="category">Design</a> -->
                                    <p class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span>(4.8 Rating)</span>
                                    </p>
                                </div>

                                <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                <ul>
                                    <li>24 Lessons</li>
                                    <li>38 Student</li>
                                </ul>
                                <a class="author" href="#">
                                    <div class="img">
                                        <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}"
                                            alt="Author" class="img-fluid">
                                    </div>
                                    <h4>Hermann P. Schnitzel</h4>
                                </a>
                            </div>
                            <div class="wsus__single_courses_3_footer">
                                <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                <p><del>$254</del> $156.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-4">
                        <div class="wsus__single_courses_3">
                            <div class="wsus__single_courses_3_img">
                                <img src="{{ asset('frontend/assets/images/courses_3_img_6.jpg') }}" alt="Courses"
                                    class="img-fluid">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}"
                                                alt="Love" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}"
                                                alt="Compare" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}"
                                                alt="Cart" class="img-fluid">
                                        </a>
                                    </li>
                                </ul>
                                <span class="time"><i class="far fa-clock"></i> 24 Hours</span>
                            </div>
                            <div class="wsus__single_courses_text_3">
                                <div class="rating_area">
                                    <!-- <a href="#" class="category">Business</a> -->
                                    <p class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span>(4.9 Rating)</span>
                                    </p>
                                </div>

                                <a class="title" href="#">50 Tips For Designing an Exceptional
                                    Online Learning Progress.</a>
                                <ul>
                                    <li>32 Lessons</li>
                                    <li>48 Student</li>
                                </ul>
                                <a class="author" href="#">
                                    <div class="img">
                                        <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}"
                                            alt="Author" class="img-fluid">
                                    </div>
                                    <h4>Hugh Millie-Yate</h4>
                                </a>
                            </div>
                            <div class="wsus__single_courses_3_footer">
                                <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                <p>$239.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-4">
                        <div class="wsus__single_courses_3">
                            <div class="wsus__single_courses_3_img">
                                <img src="{{ asset('frontend/assets/images/courses_3_img_7.jpg') }}" alt="Courses"
                                    class="img-fluid">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}"
                                                alt="Love" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}"
                                                alt="Compare" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}"
                                                alt="Cart" class="img-fluid">
                                        </a>
                                    </li>
                                </ul>
                                <span class="time"><i class="far fa-clock"></i> 17 Hours</span>
                            </div>
                            <div class="wsus__single_courses_text_3">
                                <div class="rating_area">
                                    <!-- <a href="#" class="category">Marketing</a> -->
                                    <p class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span>(4.8 Rating)</span>
                                    </p>
                                </div>

                                <a class="title" href="#">Holistic Internet-Based Instruction
                                    Mastery Program.</a>
                                <ul>
                                    <li>37 Lessons</li>
                                    <li>56 Student</li>
                                </ul>
                                <a class="author" href="#">
                                    <div class="img">
                                        <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}"
                                            alt="Author" class="img-fluid">
                                    </div>
                                    <h4>Dominic L. Ement</h4>
                                </a>
                            </div>
                            <div class="wsus__single_courses_3_footer">
                                <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                <p>$199.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-4">
                        <div class="wsus__single_courses_3">
                            <div class="wsus__single_courses_3_img">
                                <img src="{{ asset('frontend/assets/images/courses_3_img_8.jpg') }}" alt="Courses"
                                    class="img-fluid">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}"
                                                alt="Love" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}"
                                                alt="Compare" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}"
                                                alt="Cart" class="img-fluid">
                                        </a>
                                    </li>
                                </ul>
                                <span class="time"><i class="far fa-clock"></i> 15 Hours</span>
                            </div>
                            <div class="wsus__single_courses_text_3">
                                <div class="rating_area">
                                    <!-- <a href="#" class="category">Design</a> -->
                                    <p class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span>(4.8 Rating)</span>
                                    </p>
                                </div>

                                <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                <ul>
                                    <li>24 Lessons</li>
                                    <li>38 Student</li>
                                </ul>
                                <a class="author" href="#">
                                    <div class="img">
                                        <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}"
                                            alt="Author" class="img-fluid">
                                    </div>
                                    <h4>Hermann P. Schnitzel</h4>
                                </a>
                            </div>
                            <div class="wsus__single_courses_3_footer">
                                <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                <p><del>$254</del> $156.00</p>
                            </div>
                        </div>
                    </div> --}}
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
