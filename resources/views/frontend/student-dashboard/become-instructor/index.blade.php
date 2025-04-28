@extends('frontend.layouts.master')

@section('content')
    <section class="wsus__breadcrumb" style="background: url(images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Become an instructor</h1>
                            <ul>
                                <li><a href={{ url('/') }}">Home</a></li>
                                <li>Become an instructor</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">

                @include('frontend.student-dashboard.sidebar')

                <div class="col-xl-9 col-md-8">

                    {{-- <div class="text-end">
                        <a href="" class="btn btn-primary">Become an Instructor</a>
                    </div> --}}
                    <div class="card">
                        <div class="card-header">Become an Instructor</div>
                        <div class="card-body">
                            <form action="POST">
                                <div class="form-group mb-3">
                                    <label for="">Document</label>
                                    <input type="file" name="document" id="">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
