@extends('frontend.layouts.master')

@push('meta_tags')
    <meta property="og:title" content="{{ $blog->title ?? '' }}">
    <meta property="og:description" content="{{ $blog->seo_description ?? '' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset($blog->image ?? '') }}">
    <meta property="og:type" content="Blog">
@endpush

@section('content')
    <section class="wsus__breadcrumb" style="background: url({{ asset(config('settings.site_breadcrumb')) }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Blog details</h1>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li>Blog details</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wsus__blog_details mt_120 xs_mt_100 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInLeft">
                    <div class="wsus__blog_details_area">
                        <div class="wsus__blog_details_thumb">
                            <img src="{{ asset($blog->image) }}" alt="Blog" class="img-fluid w-100">
                        </div>
                        <div class="wsus__blog_details_header">
                            <ul class="d-flex flex-wrap">
                                <li>
                                    <span class="author">
                                        <img src="{{ $blog->author->image ? asset($blog->author->image) : asset('default_files/avatar.png') }}"
                                            alt="user" class="img-fluid">
                                    </span>
                                    By {{ $blog->author->name }}
                                </li>
                                <li>
                                    <span>
                                        <img src="{{ asset('frontend/assets/images/calendar_gray.png') }}" alt="calendar"
                                            class="img-fluid">
                                    </span>
                                    {{ date('M d, Y', strtotime($blog->created_at)) }}
                                </li>
                                <li>
                                    <span>
                                        <img src="{{ asset('frontend/assets/images/bookmark_icon.png') }}" alt="bookmark"
                                            class="img-fluid">
                                    </span>
                                    {{ $blog->category->name }}
                                </li>
                                <li>
                                    <span>
                                        <img src="{{ asset('frontend/assets/images/comment_icon_gray.png') }}"
                                            alt="bookmark" class="img-fluid">
                                    </span>
                                    {{ $blog->comments()->count() }} Comments
                                </li>
                            </ul>
                            <h2>{{ $blog->title }}</h2>
                        </div>
                        <div class="wsus__blog_details_text">
                            {!! $blog->content !!}
                        </div>
                        <div class="wsus__blog_det_tags_share d-flex flex-wrap mt_50 justify-content-end">
                            {{-- <ul class="tags d-flex flex-wrap align-items-center">
                                <li><span>Tags:</span></li>
                                <li><a href="#">Course</a></li>
                                <li><a href="#">Education</a></li>
                                <li><a href="#">Learn</a></li>
                                <li><a href="#">Online</a></li>
                            </ul> --}}
                            <ul class="share d-flex flex-wrap align-items-center">
                                <li><span>share:</span></li>
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
                            <ul>
                            </ul>
                        </div>
                        <div class="wsus__blog_det_author">
                            <div class="img">
                                <img src="{{ $blog->author->image ? asset($blog->author->image) : asset('default_files/avatar.png') }}"
                                    alt="Author" class="img-fluid">
                            </div>
                            <div class="text">
                                <h3>{{ $blog->author->name }}</h3>
                                <h5>Digital Marketing</h5>
                                <p>Sed mi leo, accumsan vel ante at, viverra placerat nulla. Donec pharetra rutrum sed
                                    allium lectus fermentum enim Nam maximus.</p>
                                <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="wsus__blog_comment_area mt_75">
                            <h2>Comments</h2>
                            @foreach ($blog->comments()->orderBy('created_at', 'desc')->get() ?? [] as $comment)
                                <div class="wsus__blog_single_comment">
                                    <div class="img">
                                        <img src="{{ $comment->user->image ? asset($comment->user->image) : asset('default_files/avatar.png') }}"
                                            alt="Comments" class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <h4>{{ $comment->user->name }}</h4>
                                        <h6>{{ date('F j, Y \a\t g:i A', strtotime($comment->created_at)) }}</h6>
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @auth
                            <div class="wsus__blog_comment_input_area mt_75">
                                <h2>Post a Comment</h2>
                                <form action="{{ route('blog.comment.store', $blog->id) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <p>
                                                Hey, {{ auth()->user()->name }}
                                            </p>
                                            <p>
                                                Please leave a comment below.
                                            </p>
                                        </div>
                                        <div class="col-xl-12 mb-1">
                                            <textarea class="mt-0" rows="5" placeholder="Leave a comment" name="comment"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="common_btn">Post Comment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="alert alert-info mt-5">Please login to comment</div>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInRight">
                    <div class="wsus__blog_sidebar wsus__sidebar">
                        <form action="{{ route('blog.index') }}" method="get" class="wsus__sidebar_search">
                            <input type="text" name="search" placeholder="Search Here...">
                            <button type="submit">
                                <img src="{{ asset('frontend/assets/images/search_icon.png') }}" alt="Search"
                                    class="img-fluid">
                            </button>
                        </form>
                        <div class="wsus__sidebar_recent_post">
                            <h3>Recent Posts</h3>
                            <ul class="d-flex flex-wrap">
                                @forelse ($recentBlogs as $blog)
                                    <li>
                                        <a href="{{ route('blog.show', $blog->slug) }}" class="img">
                                            <img src="{{ $blog->image }}" alt="Image for blog {{ $blog->title }}"
                                                class="img-fluid">
                                        </a>
                                        <div class="text">
                                            <p>
                                                <span>
                                                    <img src="{{ asset('frontend/assets/images/calendar_blue.png') }}"
                                                        alt="Calendar" class="img-fluid">
                                                </span>
                                                {{ date('M d, Y', strtotime($blog->created_at)) }}
                                            </p>
                                            <a href="{{ route('blog.show', $blog->slug) }}"
                                                class="title">{{ $blog->title }}</a>
                                        </div>
                                    </li>
                                @empty
                                    <li>No blogs found</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="wsus__sidebar_blog_category">
                            <h3>Categories</h3>
                            <ul>
                                @foreach ($blogCategories as $category)
                                    <li>
                                        <a href="{{ route('blog.index', ['category' => $category->slug]) }}">{{ $category->name }}
                                            <span>({{ $category->blogs_count }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="wsus__sidebar_blog_tags">
                            <h3>Tags</h3>
                            <ul class="d-flex flex-wrap">
                                <li><a href="#">Course</a></li>
                                <li><a href="#">Education</a></li>
                                <li><a href="#">Learn</a></li>
                                <li><a href="#">Online</a></li>
                                <li><a href="#">eLearning</a></li>
                                <li><a href="#">LMS</a></li>
                                <li><a href="#">Development</a></li>
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
@endpush
