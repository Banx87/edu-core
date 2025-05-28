<section class="wsus__testimonial pt_120 xs_pt_80">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 m-auto wow fadeInUp">
                <div class="wsus__section_heading mb_40">
                    <h5>Testimonial</h5>
                    <h2>Comments From Our Learners</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row testimonial_slider">
        @foreach ($testimonials as $testimonial)
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_testimonial" style="min-height: 460px !important;">
                    <p class="rating">
                        @for ($i = $testimonial->rating; $i > 0; $i--)
                            <i class="fas fa-star"></i>
                        @endfor
                    </p>
                    <p class="description" style="min-height: 210px !important;">{{ $testimonial->review }}</p>
                    <div class="testimonial_logo">
                        <img src="{{ asset($testimonial->logo) }}" alt="Testimonial" class="img-fluid">
                    </div>
                    <div class="wsus__testimonial_footer">
                        <div class="img">
                            <img src="{{ asset($testimonial->user_image) }}" alt="user" class="img-fluid">
                        </div>
                        <h3>
                            {{ $testimonial->user_name }}
                            <span>{{ $testimonial->user_title }}</span>
                        </h3>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</section>
