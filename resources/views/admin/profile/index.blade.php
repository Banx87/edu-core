@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Profile Update</h3>

                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $admin->name) }}" placeholder="Enter Name">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email"
                                        value="{{ old('email', $admin->email) }}" placeholder="Enter email">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="bio" class="form-label">Bio</label>
                                    <textarea name="bio" id="" cols="15" rows="6" placeholder="">{!! old('bio', $admin->bio) !!}</textarea>
                                    <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <x-input-file-block name="image" label="Profile Image"
                                    placeholder="Image"></x-input-file-block>
                                @if ($admin->image != null)
                                    <x-image-preview :src="asset($admin->image)" label="Selected image"
                                        class="mb-3"></x-image-preview>
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                @endif
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary mt-3">
                                    <i class="ti ti-device-floppy space"></i>
                                    Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Password Update</h3>

                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.password.update') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" class="form-control" name="current_password"
                                        placeholder="Enter Current Password">
                                    <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="password" class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Enter New Password">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            placeholder="Confirm New Password">
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary mt-3">
                                    <i class="ti ti-device-floppy space"></i>
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
