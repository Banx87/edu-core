@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Latest Courses</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.latest-courses-section.update', 1) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary mb-3">
                                        <i class="ti ti-device-floppy space"></i>
                                        Save
                                    </button>
                                </div>

                                <hr class="mt-2">

                                <p>Select the categories that are shown in the latest categories section of the home page
                                </p>

                                <div class="col-md-6 d-flex align-items-baseline">
                                    <label class="form-label" for="category_1"
                                        style="min-width: fit-content; margin-right: .5rem;">Category 1:</label>
                                    <select class="select2 form-select" name="category_1">
                                        <option value="">Please Select</option>
                                        @foreach ($categories as $category)
                                            @if ($category->subCategories->isNotEmpty())
                                                <optgroup label="{{ $category->name }}">
                                                    @foreach ($category->subCategories as $subCategory)
                                                        <option @selected($latestCourseSection->category_one == $subCategory->id) value="{{ $subCategory->id }}">
                                                            {{ $subCategory->name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endif
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category_1')" class="mt-2" />
                                </div>

                                <hr class="m-3">

                                <div class="col-md-6 d-flex align-items-baseline">
                                    <label class="form-label" for="category_2"
                                        style="min-width: fit-content; margin-right: .5rem;">Category 2:</label>
                                    <select class="select2 form-select" name="category_2">
                                        <option value="">Please Select</option>
                                        @foreach ($categories as $category)
                                            @if ($category->subCategories->isNotEmpty())
                                                <optgroup label="{{ $category->name }}">
                                                    @foreach ($category->subCategories as $subCategory)
                                                        <option @selected($latestCourseSection->category_two == $subCategory->id) value="{{ $subCategory->id }}">
                                                            {{ $subCategory->name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endif
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category_2')" class="mt-2" />
                                </div>

                                <hr class="m-3">

                                <div class="col-md-6 d-flex align-items-baseline">
                                    <label class="form-label" for="category_3"
                                        style="min-width: fit-content; margin-right: .5rem;">Category 3:</label>
                                    <select class="select2 form-select" name="category_3">
                                        <option value="">Please Select</option>
                                        @foreach ($categories as $category)
                                            @if ($category->subCategories->isNotEmpty())
                                                <optgroup label="{{ $category->name }}">
                                                    @foreach ($category->subCategories as $subCategory)
                                                        <option @selected($latestCourseSection->category_three == $subCategory->id) value="{{ $subCategory->id }}">
                                                            {{ $subCategory->name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endif
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category_3')" class="mt-2" />
                                </div>

                                <hr class="m-3">

                                <div class="col-md-6 d-flex align-items-baseline">
                                    <label class="form-label" for="category_4"
                                        style="min-width: fit-content; margin-right: .5rem;">Category 4:</label>
                                    <select class="select2 form-select" name="category_4">
                                        <option value="">Please Select</option>
                                        @foreach ($categories as $category)
                                            @if ($category->subCategories->isNotEmpty())
                                                <optgroup label="{{ $category->name }}">
                                                    @foreach ($category->subCategories as $subCategory)
                                                        <option @selected($latestCourseSection->category_four == $subCategory->id)
                                                            value="{{ $subCategory->id }}">
                                                            {{ $subCategory->name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endif
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category_4')" class="mt-2" />
                                </div>

                                <hr class="m-3">

                                <div class="col-md-6 d-flex align-items-baseline">
                                    <label class="form-label" for="category_5"
                                        style="min-width: fit-content; margin-right: .5rem;">Category 5:</label>
                                    <select class="select2 form-select" name="category_5">
                                        <option value="">Please Select</option>
                                        @foreach ($categories as $category)
                                            @if ($category->subCategories->isNotEmpty())
                                                <optgroup label="{{ $category->name }}">
                                                    @foreach ($category->subCategories as $subCategory)
                                                        <option @selected($latestCourseSection->category_five == $subCategory->id)
                                                            value="{{ $subCategory->id }}">
                                                            {{ $subCategory->name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endif
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category_5')" class="mt-2" />
                                </div>

                                <hr class="mt-5">

                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy space"></i>
                                        Save
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
