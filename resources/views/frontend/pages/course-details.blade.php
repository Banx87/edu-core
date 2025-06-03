@extends('frontend.layouts.master')

@push('meta_tags')
    <meta property="og:title" content="{{ $course->title ?? '' }}">
    <meta property="og:description" content="{{ $course->seo_description ?? '' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset($course->thumbnail ?? '') }}">
    <meta property="og:type" content="Course">
@endpush

@section('content')
    <section class="wsus__breadcrumb course_details_breadcrumb"
        style="background: url({{ asset('frontend/assets/images/breadcrumb_bg.jpg') }})">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <p class="rating">
                                @php $avgRating = $course->reviews()->avg('rating') ?? 0; @endphp
                                @for ($i = 1; $i <= $avgRating; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                <span>({{ $course->reviews->count() ?? 0 }} Reviews)</span>
                            </p>
                            <h1>{{ $course->title ?? '' }}</h1>
                            <ul class="list">
                                <li>
                                    <span>
                                        <img src="{{ asset($course->instructor->image ?? 'frontend/assets/images/default-user.png') }}"
                                            alt="{{ $course->instructor->name ?? 'Instructor' }}" class="img-fluid">
                                    </span>
                                    By {{ $course->instructor->name ?? 'N/A' }}
                                </li>
                                <li>
                                    <span>
                                        <img src="{{ asset('frontend/assets/images/globe_icon_blue.png') }}" alt="Globe"
                                            class="img-fluid">
                                    </span>
                                    {{ $course->category->name ?? 'N/A' }}
                                </li>
                                <li>
                                    <span>
                                        <img src="{{ asset('frontend/assets/images/calendar_blue.png') }}" alt="Calendar"
                                            class="img-fluid">
                                    </span>
                                    Last updated
                                    {{ $course->updated_at ? date('F Y', strtotime($course->updated_at)) : '' }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wsus__courses_details pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInLeft">
                    <div class="wsus__courses_details_area mt_40">

                        <ul class="nav nav-pills mb_40" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">Overview</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false">Curriculum</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false">Instructor</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-disabled-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-disabled2" type="button" role="tab"
                                    aria-controls="pills-disabled2" aria-selected="false">Review</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab" tabindex="0">
                                <div class="wsus__courses_overview box_area">
                                    <h3>Course Description</h3>
                                    <p>{!! $course->description ?? '' !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab" tabindex="0">
                                <div class="wsus__courses_curriculum box_area">
                                    <h3>Course Curriculum</h3>
                                    <div class="accordion" id="curriculumList">
                                        @foreach ($course->chapters ?? [] as $courseChapter)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-{{ $courseChapter->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse-{{ $courseChapter->id }}">
                                                        {{ $courseChapter->title ?? '' }}
                                                    </button>
                                                </h2>
                                                <div id="collapse-{{ $courseChapter->id }}"
                                                    class="accordion-collapse collapse" data-bs-parent="#curriculumList">
                                                    <div class="accordion-body">
                                                        <ul>
                                                            @forelse ($courseChapter->lessons ?? [] as $lesson)
                                                                <li
                                                                    class="{{ ($lesson->is_preview ?? 0) == 1 ? 'active' : '' }}">
                                                                    <p>{{ $lesson->title ?? '' }}</p>
                                                                    @if (($lesson->is_preview ?? 0) == 1)
                                                                        <a href="{{ $lesson->file_path ?? '#' }}"
                                                                            data-autoplay="true" data-vbtype="video"
                                                                            class="right_text venobox vbox-item">{{ ($lesson->is_preview ?? 0) == 1 ? 'Preview' : (isset($lesson->duration) ? minutesToTime($lesson->duration) : '') }}
                                                                        </a>
                                                                    @else
                                                                        <span
                                                                            class="right_text">{{ isset($lesson->duration) ? minutesToTime($lesson->duration) : '' }}</span>
                                                                    @endif
                                                                </li>
                                                            @empty
                                                                <li>
                                                                    <p>No lessons found</p>
                                                                </li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab" tabindex="0">
                                <div class="wsus__courses_instructor box_area">
                                    <h3>Instructor Details</h3>
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="wsus__courses_instructor_img">
                                                <img src="{{ asset($course->instructor->image ?? 'frontend/assets/images/default-user.png') }}"
                                                    alt="Instructor" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-6">
                                            <div class="wsus__courses_instructor_text">
                                                <h4>{{ $course->instructor->name ?? '' }}</h4>
                                                <p class="designation">{{ $course->instructor->headline ?? '' }}</p>
                                                <ul class="list">
                                                    <li><i class="fas fa-star"></i> <b>74,537 Reviews</b></li>
                                                    <li><strong>4.7 Rating</strong></li>
                                                    <li>
                                                        <span><img
                                                                src="{{ asset('frontend/assets/images/book_icon.png') }}"
                                                                alt="book" class="img-fluid"></span>
                                                        {{ $course->instructor && method_exists($course->instructor, 'courses') ? $course->instructor->courses()->count() : 0 }}
                                                        Courses
                                                    </li>
                                                    <li>
                                                        <span><img
                                                                src="{{ asset('frontend/assets/images/user_icon_gray.png') }}"
                                                                alt="user" class="img-fluid"></span>
                                                        32 Students
                                                    </li>
                                                </ul>
                                                <ul class="badge d-flex flex-wrap">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Exclusive Author">
                                                        <img src="{{ asset('frontend/assets/images/badge_1.png') }}"
                                                            alt="Badge" class="img-fluid">
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Top Earning"><img
                                                            src="{{ asset('frontend/assets/images/badge_2.png') }}"
                                                            alt="Badge" class="img-fluid"></li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Trending"><img
                                                            src="{{ asset('frontend/assets/images/badge_3.png') }}"
                                                            alt="Badge" class="img-fluid"></li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="2 Years of Membership"><img
                                                            src="{{ asset('frontend/assets/images/badge_4.png') }}"
                                                            alt="Badge" class="img-fluid">
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Collector Lavel 1">
                                                        <img src="{{ asset('frontend/assets/images/badge_5.png') }}"
                                                            alt="Badge" class="img-fluid">
                                                    </li>
                                                </ul>
                                                <p class="description">
                                                    {{ $course->instructor->bio ?? '' }}
                                                </p>
                                                <ul class="link d-flex flex-wrap">
                                                    @if (!empty($course->instructor->facebook))
                                                        <li><a href="{{ $course->instructor->facebook }}"><i
                                                                    class="ti ti-brand-facebook"></i></a></li>
                                                    @endif
                                                    @if (!empty($course->instructor->x))
                                                        <li><a href="{{ $course->instructor->x }}"><i
                                                                    class="ti ti-brand-x"></i></a></li>
                                                    @endif
                                                    @if (!empty($course->instructor->linkedin))
                                                        <li><a href="{{ $course->instructor->linkedin }}"><i
                                                                    class="ti ti-brand-linkedin"></i></a></li>
                                                    @endif
                                                    @if (!empty($course->instructor->github))
                                                        <li><a href="{{ $course->instructor->github }}"><i
                                                                    class="ti ti-brand-github"></i></a></li>
                                                    @endif
                                                    @if (!empty($course->instructor->website))
                                                        <li><a href="{{ $course->instructor->website }}"><i
                                                                    class="ti ti-world-www"></i></a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @php
                                $fiveStarReviews = $course->reviews()->where('rating', 5)->count() ?? 0;
                                $fourStarReviews = $course->reviews()->where('rating', 4)->count() ?? 0;
                                $threeStarReviews = $course->reviews()->where('rating', 3)->count() ?? 0;
                                $twoStarReviews = $course->reviews()->where('rating', 2)->count() ?? 0;
                                $oneStarReviews = $course->reviews()->where('rating', 1)->count() ?? 0;
                            @endphp
                            <div class="tab-pane fade" id="pills-disabled2" role="tabpanel"
                                aria-labelledby="pills-disabled-tab2" tabindex="0">
                                <div class="wsus__courses_review box_area">
                                    <h3>Customer Reviews</h3>
                                    <div class="row align-items-center mb_50">
                                        <div class="col-xl-4 col-md-6">
                                            <div class="total_review">
                                                <h2>{{ number_format($course->reviews()->avg('rating') ?? 0, 2) }}</h2>
                                                <p>
                                                    @php $avgRating = $course->reviews()->avg('rating') ?? 0; @endphp
                                                    @for ($i = 1; $i <= $avgRating; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                                </p>
                                                <h4>{{ $course->reviews()->count() ?? 0 }} Reviews</h4>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-md-6">
                                            <div class="review_bar">
                                                <div class="review_bar_single">
                                                    <p>5 <i class="fas fa-star"></i></p>
                                                    <div id="bar5" class="barfiller">
                                                        <div class="tipWrap">
                                                            <span class="tip"></span>
                                                        </div>
                                                        <span class="fill bar5"
                                                            data-count="{{ $fiveStarReviews }}"></span>
                                                    </div>
                                                    <span class="qnty">{{ $fiveStarReviews }}</span>
                                                </div>
                                                <div class="review_bar_single">
                                                    <p>4 <i class="fas fa-star"></i></p>
                                                    <div id="bar4" class="barfiller">
                                                        <div class="tipWrap">
                                                            <span class="tip"></span>
                                                        </div>

                                                        <span class="fill bar4"
                                                            data-count="{{ $fourStarReviews }}"></span>
                                                    </div>
                                                    <span class="qnty">{{ $fourStarReviews }}</span>
                                                </div>
                                                <div class="review_bar_single">
                                                    <p>3 <i class="fas fa-star"></i></p>
                                                    <div id="bar3" class="barfiller">
                                                        <div class="tipWrap">
                                                            <span class="tip"></span>
                                                        </div>

                                                        <span class="fill bar3"
                                                            data-count="{{ $threeStarReviews }}"></span>
                                                    </div>
                                                    <span class="qnty">{{ $threeStarReviews }}</span>
                                                </div>
                                                <div class="review_bar_single">
                                                    <p>2 <i class="fas fa-star"></i></p>
                                                    <div id="bar2" class="barfiller">
                                                        <div class="tipWrap">
                                                            <span class="tip"></span>
                                                        </div>
                                                        <span class="fill bar2"
                                                            data-count="{{ $twoStarReviews }}"></span>
                                                    </div>
                                                    <span class="qnty">{{ $twoStarReviews }}</span>
                                                </div>
                                                <div class="review_bar_single">
                                                    <p>1 <i class="fas fa-star"></i></p>
                                                    <div id="bar1" class="barfiller">
                                                        <div class="tipWrap">
                                                            <span class="tip"></span>
                                                        </div>
                                                        <span class="fill bar1"
                                                            data-count="{{ $oneStarReviews }}"></span>
                                                    </div>
                                                    <span class="qnty">{{ $oneStarReviews }}</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <h3>Reviews</h3>
                                    @foreach ($reviews as $review)
                                        <div class="wsus__course_single_reviews">
                                            <div class="wsus__single_review_img">
                                                <img src="{{ asset($review->user->image ?? 'frontend/assets/images/default-user.png') }}"
                                                    alt="{{ $review->user->name ?? 'User' }}" class="img-fluid">
                                            </div>
                                            <div class="wsus__single_review_text" style="width: 100%">
                                                <h4>{{ $review->user->name ?? '' }}</h4>
                                                <h6>
                                                    {{ $review->created_at ? $review->created_at->diffForHumans() : '' }}
                                                    <span class="">
                                                        @for ($i = 1; $i <= ($review->rating ?? 0); $i++)
                                                            <i class="fas fa-star"></i>
                                                        @endfor
                                                    </span>
                                                </h6>
                                                <p>{!! $review->review ?? '' !!}</p>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="pagination">{{ $reviews->links() ?? '' }}</div>

                                </div>
                                @auth
                                    <div class="wsus__courses_review_input box_area mt_40">
                                        <h3>Write a Review</h3>
                                        <p class="short_text">Your email address will not be published. Required fields are
                                            marked *</p>
                                        <div class="select_rating d-flex flex-wrap">Your Rating:
                                            <ul id="starRating" data-stars="5"></ul>
                                        </div>

                                        <form action="{{ route('review.store') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <input type="hidden" id="rating" name="rating" value="">
                                                <input type="hidden" id="course" name="course"
                                                    value="{{ $course->id ?? '' }}">
                                                <div class="col-xl-12">
                                                    <textarea rows="7" name="review" placeholder="Review (max.1000 characters)"></textarea>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <button type="submit" class="common_btn">Submit Review</button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <div class="wsus__courses_review_input box_area mt_40" style="padding: 2rem;">
                                            <div class="alert alert-warning text-center" style="margin: 0;" role="alert">
                                                Please <a href="{{ route('login') }}">login</a> to write a review!
                                            </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8 wow fadeInRight">
                        <div class="wsus__courses_sidebar">
                            <div class="wsus__courses_sidebar_video">
                                <img src="{{ asset($course->thumbnail ?? 'frontend/assets/images/default-course.png') }}"
                                    alt="Video" class="img-fluid">
                                @if (!empty($course->preview_video_source))
                                    <a class="play_btn venobox vbox-item" data-autoplay="true" data-vbtype="video"
                                        href="{{ asset($course->preview_video_source) }}">
                                        <img src="{{ asset('frontend/assets/images/play_icon_white.png') }}"
                                            alt="Play" class="img-fluid">
                                    </a>
                                @endif
                            </div>
                            <h3 class="wsus__courses_sidebar_price">
                                Price:
                                @if (($course->discount ?? 0) > 0)
                                    <del>${{ $course->price ?? 0 }}</del> ${{ $course->discount ?? 0 }}
                                @elseif (($course->price ?? 0) == 0)
                                    Free
                                @else
                                    {{ $course->price ?? 0 }}{{ config('settings.currency_icon') }}
                                @endif
                            </h3>
                            <div class="wsus__courses_sidebar_list_info">
                                <ul>
                                    <li>
                                        <p>
                                            <span><img src="{{ asset('frontend/assets/images/clock_icon_black.png') }}"
                                                    alt="clock" class="img-fluid"></span>
                                            Course Duration
                                        </p>
                                        {{ isset($course->duration) ? minutesToTime($course->duration) : '' }}
                                    </li>
                                    <li>
                                        <p>
                                            <span><img src="{{ asset('frontend/assets/images/network_icon_black.png') }}"
                                                    alt="network" class="img-fluid"></span>
                                            Skill Level
                                        </p>
                                        {{ $course->level->name ?? '' }}
                                    </li>
                                    <li>
                                        <p>
                                            <span><img src="{{ asset('frontend/assets/images/user_icon_black_2.png') }}"
                                                    alt="User" class="img-fluid"></span>
                                            Student Enrolled
                                        </p>
                                        47
                                    </li>
                                    <li>
                                        <p>
                                            <span><img src="{{ asset('frontend/assets/images/language_icon_black.png') }}"
                                                    alt="Language" class="img-fluid"></span>
                                            Language
                                        </p>
                                        {{ $course->language->name ?? '' }}
                                    </li>
                                </ul>
                                <a class="common_btn" href="#">Enroll The Course <i
                                        class="far fa-arrow-right"></i></a>
                            </div>
                            <div class="wsus__courses_sidebar_share_btn d-flex flex-wrap justify-content-between">
                                <a href="#" class="common_btn"><i class="far fa-heart"></i> Add to Wishlist</a>
                            </div>
                            <div class="wsus__courses_sidebar_share_area">
                                <span>Share:</span>
                                <ul>
                                    <li class="ez-facebook"><a href="#"><i class="ti ti-brand-facebook"
                                                style="line-height: 1.5; font-size: 24px;"></i></a>
                                    </li>
                                    <li class="ez-linkedin"><a href="#"><i class="ti ti-brand-linkedin"
                                                style="line-height: 1.5; font-size: 24px;"></i></a>
                                    </li>
                                    <li class="ez-x"><a href="#"><i class="ti ti-brand-x"
                                                style="line-height: 1.5; font-size: 24px;"></i></a></li>
                                    <li class="ez-reddit"><a href="#"><i class="ti ti-brand-reddit"
                                                style="line-height: 1.5; font-size: 24px;"></i></a></li>
                                </ul>
                            </div>
                            <div class="wsus__courses_sidebar_info">
                                <h3>This Course Includes</h3>
                                <ul>
                                    <li>
                                        <span><img src="{{ asset('frontend/assets/images/video_icon_black.png') }}"
                                                alt="video" class="img-fluid"></span>
                                        {{ isset($course->duration) ? minutesToTime($course->duration) : '' }} of Video
                                        Lectures
                                    </li>
                                    <li>
                                        <span><img
                                                src="{{ asset('frontend/assets/images/file_download_icon_black.png') }}"
                                                alt="download" class="img-fluid"></span>
                                        {{ $course->downloadable_resources ?? 0 }} Downloadable Resources File
                                    </li>
                                    @if (($course->certificate ?? 0) == 1)
                                        <li>
                                            <span><img
                                                    src="{{ asset('frontend/assets/images/certificate_icon_black.png') }}"
                                                    alt="Certificate" class="img-fluid"></span>
                                            Certificate of Completion
                                        </li>
                                    @endif
                                    <li>
                                        <span><img src="{{ asset('frontend/assets/images/life_time_icon.png') }}"
                                                alt="Certificate" class="img-fluid"></span>
                                        Course Lifetime Access
                                    </li>
                                </ul>

                            </div>
                            <div class="wsus__courses_sidebar_instructor">
                                <div class="image_area d-flex flex-wrap align-items-center">
                                    <div class="img">
                                        <img src="{{ asset($course->instructor->image ?? 'frontend/assets/images/default-user.png') }}"
                                            alt="Instructor" class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <h3>{{ $course->instructor->name ?? '' }}</h3>
                                        <p><span>Instructor</span> Level 2</p>
                                    </div>
                                </div>
                                <ul class="d-flex flex-wrap">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Exclusive Author">
                                        <img src="{{ asset('frontend/assets/images/badge_1.png') }}" alt="Badge"
                                            class="img-fluid">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Top Earning"><img
                                            src="{{ asset('frontend/assets/images/badge_2.png') }}" alt="Badge"
                                            class="img-fluid"></li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Trending"><img
                                            src="{{ asset('frontend/assets/images/badge_3.png') }}" alt="Badge"
                                            class="img-fluid"></li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="2 Years of Membership">
                                        <img src="{{ asset('frontend/assets/images/badge_4.png') }}" alt="Badge"
                                            class="img-fluid">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Collector Lavel 1">
                                        <img src="{{ asset('frontend/assets/images/badge_5.png') }}" alt="Badge"
                                            class="img-fluid">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/shakilahmed0369/ez-share/dist/ez-share.min.js"></script>

    <script>
        $(function() {
            $('#starRating li').on('click', function() {
                let starRating = $('#starRating').find('.star.active').length;
                $('#rating').val(starRating);
            })
        })
    </script>
@endpush
