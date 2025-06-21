<section class="blog_4 mt_110 xs_mt_90 pt_120 xs_pt_100 pb_120 xs_pb_100">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 wow fadeInLeft">
                <div class="wsus__section_heading heading_left mb_50">
                    <h5>Latest blogs</h5>
                    <h2>Our Latest News Feed.</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row blog_4_slider">
        @forelse ($blogs as $blog)
            <div class="col-xl-6 wow fadeInUp">
                <div class="wsus__single_blog_4">
                    <a href="{{ route('blog.show', $blog->slug) }}" class="wsus__single_blog_4_img">
                        <img src="{{ asset($blog->image) }}" alt="Blog" class="img-fluid">
                        <span class="date">{{ date('M d, Y', strtotime($blog->created_at)) }}</span>
                    </a>
                    <div class="wsus__single_blog_4_text w-100">
                        <ul>
                            <li>
                                <span><img
                                        src="{{ $blog->author->image ? asset($blog->author->image) : asset('default_files/avatar.png') }}"
                                        alt="User" class="img-fluid"></span>
                                By {{ $blog->author->name }}
                            </li>
                            <li>
                                <span><img src="{{ asset('frontend/assets/images/comment_icon_black.png') }}"
                                        alt="Comment" class="img-fluid"></span>
                                {{ $blog->comments()->count() }} Comments
                            </li>
                        </ul>
                        <a href="{{ route('blog.show', $blog->slug) }}"
                            class="title">{{ Str::limit(strip_tags(html_entity_decode($blog->title)), 50) }}</a>
                        <p>{{ Str::limit(strip_tags(html_entity_decode($blog->content)), 150) }}</p>
                        <a href="{{ route('blog.show', $blog->slug) }}" class="common_btn">Read More <i
                                class="far fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        @empty
            <div>No Blogs Found</div>
        @endforelse
    </div>
</section>
