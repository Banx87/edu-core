@extends('frontend.layouts.master')
@push('header_scripts')
    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            padding-inline: 2rem;
        }

        h1,
        h2 {
            /* margin-bottom: 1rem; */
            padding-inline: 2rem;
            margin-bottom: 2rem;
        }

        h3,
        h4,
        h5,
        h6 {
            margin-bottom: 0.5rem;
        }

        p {
            margin-bottom: 1rem;
            padding-inline: 2rem;
            font-size: 1.1rem;
        }

        h2+p {
            margin-bottom: 2rem;
        }
    </style>
@endpush
@section('content')
    <section class="wsus__breadcrumb" style="background: url(images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>{{ $custom_page->title }}</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>{{ $custom_page->title }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wsus__contact_us mt_95 xs_mt_75 pb_120 xs_pb_100">
        <div class="container">

            <div class="wsus__contact_form_area mt_30 wow fadeInUp">
                {!! $custom_page->description !!}
            </div>
        </div>

    </section>
@endsection
