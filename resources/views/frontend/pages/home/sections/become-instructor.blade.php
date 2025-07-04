<section class="wsus__become_instructor mt_120 xs_mt_100">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-xl-6 col-md-6 wow fadeInLeft">
                <div class="wsus__become_instructor_text">
                    <div class="wsus__section_heading heading_left mb_20">
                        <h5>Become An Instructor</h5>
                        <h2>{{ $becomeInstructor?->title }}</h2>
                    </div>
                    <p>{!! $becomeInstructor?->description !!}</p>
                    <a class="common_btn"
                        href="{{ $becomeInstructor?->button_url }}">{{ $becomeInstructor?->button_text }}
                        <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-xl-5 col-md-6 wow fadeInRight">
                <div class="wsus__become_instructor_img">
                    <img src="{{ asset($becomeInstructor?->image) }}" alt="Instructor" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </div>
</section>
