@extends('frontend.layouts.master')

@section('content')
    <section class="wsus__breadcrumb" style="background: url({{ asset(config('settings.site_breadcrumb')) }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Student Dashboard</h1>
                            <ul>
                                <li><a href={{ url('/') }}">Home</a></li>
                                <li>Student Dashboard</li>
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

                <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__dashboard_content wsus__dashboard_content_border_top mt-0">
                        <div class="wsus__dashboard_content_top d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Update Your Information</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                            <div class="wsus__dashboard_profile_delete">
                                <a href="#" class="common_btn">Delete Profile</a>
                            </div>
                        </div>



                        <form method="POST" action="{{ route('student.profile.update') }}"
                            class="wsus__dashboard_profile_update" enctype="multipart/form-data">
                            @csrf
                            <div class="wsus__dashboard_profile wsus__dashboard_profile_avatar px-0">
                                <div class="img">
                                    <img src="{{ asset(auth()->user()->image) }}" alt="profile" class="img-fluid w-100">
                                    <label for="profile_photo">
                                        <img src="{{ asset('frontend/assets/images/dash_camera.png') }}" alt="camera"
                                            class="img-fluid w-100">
                                    </label>
                                    <input type="file" id="profile_photo" name="avatar" hidden="">
                                </div>
                                <div class="text">
                                    <h6>Your avatar</h6>
                                    <p>PNG or JPG no bigger than 400px wide and tall.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Full name</label>
                                        <input type="text" placeholder="Enter your name" name="name"
                                            value="{{ auth()->user()->name }}">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Headline</label>
                                        <input type="text" placeholder="Enter your headline" name="headline"
                                            value="{{ auth()->user()->headline }}">
                                        <x-input-error :messages="$errors->get('headline')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Email</label>
                                        <input type="text" placeholder="Enter your email" name="email"
                                            value="{{ auth()->user()->email }}">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Gender</label>
                                        <select class="form-control" type="text" placeholder="Enter your email"
                                            name="gender">
                                            <option @selected(auth()->user()->gender === 'male') value="male">Male</option>
                                            <option @selected(auth()->user()->gender === 'female') value="female">Female</option>
                                            <option @selected(auth()->user()->gender === 'other') value="other">Other</option>
                                            <option @selected(auth()->user()->gender === 'none') value="none">Don't want to say</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>About Me</label>
                                        <textarea rows="7" placeholder="Tell us about yourself" name="about">{{ auth()->user()->about }}</textarea>
                                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_btn">
                                        <button type="submit" class="common_btn">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- PASSWORD --}}
                    <div class="wsus__dashboard_content wsus__dashboard_content_border_top">
                        <div class="wsus__dashboard_content_top  d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Update Your Password.</h5>
                                {{-- <p>Update your social media information.</p> --}}
                            </div>
                        </div>
                        <form method="POST" action="{{ route('student.profile.update-password') }}"
                            class="wsus__dashboard_profile_update">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <input type="password" placeholder="Your current password" name="current_password">
                                        <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <input type="password" placeholder="New Password" name="password">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <input type="password" placeholder="Confirm Password"
                                            name="password_confirmation">
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_btn">
                                        <button type="submit" class="common_btn">Update Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- SOCIAL --}}
                    <div class="wsus__dashboard_content wsus__dashboard_content_border_top">
                        <div class="wsus__dashboard_content_top  d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Update Your Social</h5>
                                <p>Update your social media information.</p>
                            </div>

                        </div>
                        <form method="POST" action="{{ route('student.profile.update-social') }}"
                            class="wsus__dashboard_profile_update">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <input type="text" placeholder="Facebook" name="facebook"
                                            value="{{ auth()->user()->facebook }}">
                                        <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <input type="text" placeholder="X" name="x"
                                            value="{{ auth()->user()->x }}">
                                        <x-input-error :messages="$errors->get('x')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <input type="text" placeholder="LinkedIn" name="linkedin"
                                            value="{{ auth()->user()->linkedin }}">
                                        <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <input type="text" placeholder="Website" name="website"
                                            value="{{ auth()->user()->website }}">
                                        <x-input-error :messages="$errors->get('website')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <input type="text" placeholder="GitHub" name="github"
                                            value="{{ auth()->user()->github }}">
                                        <x-input-error :messages="$errors->get('github')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_btn">
                                        <button type="submit" class="common_btn">Update Social Links</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
