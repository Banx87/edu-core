@extends('frontend.layouts.master')

@section('content')
    <section class="wsus__breadcrumb" style="background: url({{ asset('frontend/assets/images/breadcrumb_bg.jpg') }}));">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Our Courses</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Our Courses</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wsus__courses mt_120 xs_mt_100 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-8 order-2 order-lg-1 wow fadeInLeft">
                    <div class="wsus__sidebar">
                        <form action="{{ route('courses.index') }}">
                            <div class="row mb-3">
                                <button class="common_btn" type="submit">Search</button>
                            </div>
                            <div class="wsus__sidebar_search">
                                <input type="text" placeholder="Search Course" name="search"
                                    value="{{ request()?->search }}">
                                <button type="submit">
                                    <img src={{ asset('frontend/assets/images/search_icon.png') }} alt="Search"
                                        class="img-fluid">
                                </button>
                            </div>

                            <div class="wsus__sidebar_category">
                                <h3>Categories</h3>
                                <ul class="category_list">
                                    @foreach ($categories as $category)
                                        <li class="">{{ $category->name }}
                                            <div class="wsus__sidebar_sub_category">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $subCategory->id }}"
                                                            id="category-cb-{{ $subCategory->id }}" name="category[]"
                                                            @checked(is_array(request()->category)
                                                                    ? in_array($subCategory->id, request()?->category ?? [])
                                                                    : $subCategory->id == request()->category)>
                                                        <label class="form-check-label" style="width: 100%;"
                                                            for="category-cb-{{ $subCategory->id }}">
                                                            {{ $subCategory->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="wsus__sidebar_course_lavel">
                                <h3>Difficulty Level</h3>
                                @foreach ($course_levels as $level)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $level->id }}"
                                            @checked(in_array($level->id, request()?->level ?? [])) name="level[]" id="level-{{ $level->id }}">
                                        <label class="form-check-label" for="level-{{ $level->id }}">
                                            {{ $level->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            {{-- TODO: Rating Filter --}}
                            <div class="wsus__sidebar_course_lavel rating">
                                <h3>Rating</h3>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultr1">
                                    <label class="form-check-label" for="flexCheckDefaultr1">
                                        <i class="fas fa-star"></i> 5 star
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultr2">
                                    <label class="form-check-label" for="flexCheckDefaultr2">
                                        <i class="fas fa-star"></i> 4 star or above
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultr3">
                                    <label class="form-check-label" for="flexCheckDefaultr3">
                                        <i class="fas fa-star"></i> 3 star or above
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultr4">
                                    <label class="form-check-label" for="flexCheckDefaultr4">
                                        <i class="fas fa-star"></i> 2 star or above
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultr5">
                                    <label class="form-check-label" for="flexCheckDefaultr5">
                                        <i class="fas fa-star"></i> 1 star or above
                                    </label>
                                </div>
                            </div>

                            {{-- TODO : Duration Filter --}}
                            {{-- <div class="wsus__sidebar_course_lavel duration">
                                <h3>Duration</h3>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultd1">
                                    <label class="form-check-label" for="flexCheckDefaultd1">
                                        Less Than 24 Hours
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultd2">
                                    <label class="form-check-label" for="flexCheckDefaultd2">
                                        24 to 36 Hours
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultd3">
                                    <label class="form-check-label" for="flexCheckDefaultd3">
                                        36 to 72 Hours
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaultd4">
                                    <label class="form-check-label" for="flexCheckDefaultd4">
                                        Above 70 Hours
                                    </label>
                                </div>
                            </div> --}}

                            <div class="wsus__sidebar_course_lavel duration">
                                <h3>Language</h3>
                                <div class="row">
                                    @foreach ($course_languages as $language)
                                        <div class="form-check col-md-6">
                                            <input class="form-check-input" type="checkbox" value="{{ $language->id }}"
                                                @checked(in_array($language->id, request()?->language ?? [])) name="language[]"
                                                id="language-{{ $language->id }}">
                                            <label class="form-check-label" for="language-{{ $language->id }}">
                                                {{ $language->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="wsus__sidebar_rating">
                                <h3>Price Range</h3>
                                <div class="range_slider"></div>
                            </div>

                            <div class="row mt-5">
                                <button class="common_btn" type="submit">Search</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 order-lg-1">
                    <div class="wsus__page_courses_header wow fadeInUp">
                        <p>Showing <span>1-{{ $courses->count() }}</span> Of <span>{{ $courses->total() }}</span> Results
                        </p>

                        <form action="{{ route('courses.index') }}">
                            <p>Sort By</p>
                            <select class="select_js" name="sort_by" onchange="this.form.submit()">
                                <option @selected(request()->sort_by == '') value="">No Sorting</option>
                                <option @selected(request()->sort_by == 'price') value="price">Price</option>
                                <option @selected(request()->sort_by == 'discount') value="discount">Discount</option>
                                <option @selected(request()->sort_by == 'top_rated') value="top_rated">Top Rated</option>
                                <option @selected(request()->sort_by == 'popularity') value="popularity">Popularity</option>
                                <option @selected(request()->sort_by == 'recently_added') value="recently_added">Recent</option>
                            </select>
                        </form>
                    </div>
                    <div class="row">
                        @forelse ($courses as $course)
                            <div class="col-xl-4 col-md-6 wow fadeInUp">
                                <div class="wsus__single_courses_3">

                                    <div class="wsus__single_courses_3_img">
                                        <img src={{ asset($course->thumbnail) }} alt="Courses" class="img-fluid">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <img src={{ asset('frontend/assets/images/love_icon_black.png') }}
                                                        alt="Love" class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src={{ asset('frontend/assets/images/compare_icon_black.png') }}
                                                        alt="Compare" class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src={{ asset('frontend/assets/images/cart_icon_black_2.png') }}
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
                                            data-course-id={{ $course->id }}>Add to Cart <i
                                                class="far fa-arrow-right"></i></a>
                                        @if ($course->discount > 0)
                                            <p><del>${{ $course->price }}</del> ${{ $course->discount }}</p>
                                        @else
                                            <p>${{ $course->price }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No data found</p>
                        @endforelse
                    </div>
                    <div class="wsus__pagination mt_50 wow fadeInUp">
                        {{ $courses->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
