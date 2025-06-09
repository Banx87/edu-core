@php
    $footer = App\Models\Footer::first();
    $social_links = App\Models\SocialLink::where('status', 1)->get();
    $footerOne = App\Models\FooterColumnOne::where('status', 1)->get();
    $footerTwo = App\Models\FooterColumnTwo::where('status', 1)->get();
@endphp
<footer class="footer_3" style="background: url(frontend/assets/images/footer_3_bg.jpg);">
    <div class="footer_3_overlay pt_120 xs_pt_100">
        <div class="wsus__footer_bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 wow fadeInUp">
                        <div class="wsus__footer_3_logo_area">
                            <a class="logo" href="index.html">
                                <img src="{{ asset(config('settings.site_footer_logo')) }}" alt="EduCore"
                                    class="img-fluid">
                            </a>
                            <p>{{ $footer->description }}</p>
                            <h2>Follow Us On</h2>
                            <ul class="d-flex flex-wrap">
                                @foreach ($social_links as $social_link)
                                    <li>
                                        <a href="{{ $social_link->url }}" target="_blank"
                                            style="display: flex; justify-content: center; align-items: center;">
                                            @if (preg_match('/\.(png|jpg|jpeg|gif|bmp|svg)$/i', $social_link->icon))
                                                <img src="{{ asset($social_link->icon) }}"
                                                    alt="{{ $social_link->name }}"
                                                    style="width: 24px !important; height: 24px !important">
                                            @else
                                                <i class="{{ $social_link->icon }}"></i>
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-md-3 wow fadeInUp">
                        <div class="wsus__footer_link">
                            <h2>Courses</h2>
                            <ul>
                                @foreach ($footerOne as $footerLink)
                                    <li><a href="{{ $footerLink->url }}">{{ $footerLink->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-md-3 wow fadeInUp">
                        <div class="wsus__footer_link">
                            <h2>Programs</h2>
                            <ul>
                                @foreach ($footerTwo as $footerLink)
                                    <li><a href="{{ $footerLink->url }}">{{ $footerLink->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp">
                        <div class="wsus__footer_3_subscribe">
                            <h3>Subscribe Our Newsletter</h3>
                            <form action="#">
                                <input type="text" name="newsletter_email" placeholder="Enter Your Email">
                                <button type="submit" class="common_btn">Subscribe</button>
                            </form>
                            <ul>
                                <li>
                                    <div class="icon">
                                        <img src="{{ asset('frontend/assets/images/mail_icon_white.png') }}"
                                            alt="Email" class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <h4>Email us:</h4>
                                        <a href="mailto: {{ $footer->email }}">{{ $footer->email }}</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <img src="{{ asset('frontend/assets/images/call_icon_white.png') }}"
                                            alt="Call" class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <h4>Call us:</h4>
                                        <a href="callto: {{ $footer->phone }}">{{ $footer->phone }}</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <img src="{{ asset('frontend/assets/images/location_icon_white.png') }}"
                                            alt="Address" class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <h4>Address:</h4>
                                        <p>{{ $footer->address }}</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wsus__footer_copyright_area mt_140 xs_mt_100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wsus__footer_copyright_text">
                            <p>{{ $footer->copyright }}</p>
                            <ul>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Term of Service</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
