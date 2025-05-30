@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Counter</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.counter-section.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="title_one" class="form-label">Title One</label>
                                    <input type="text" class="form-control" name="title_one"
                                        value="{{ old('title_one', $counters?->title_one) }}">
                                    <x-input-error :messages="$errors->get('title_one')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="counter_one" class="form-label">Counter One</label>
                                    <input type="text" class="form-control" name="counter_one"
                                        value="{{ old('counter_one', $counters?->counter_one) }}">
                                    <x-input-error :messages="$errors->get('counter_one')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="title_two" class="form-label">Title Two</label>
                                    <input type="text" class="form-control" name="title_two"
                                        value="{{ old('title_two', $counters?->title_two) }}">
                                    <x-input-error :messages="$errors->get('title_two')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="counter_two" class="form-label">Counter Two</label>
                                    <input type="text" class="form-control" name="counter_two"
                                        value="{{ old('counter_two', $counters?->counter_two) }}">
                                    <x-input-error :messages="$errors->get('counter_two')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="title_three" class="form-label">Title Three</label>
                                    <input type="text" class="form-control" name="title_three"
                                        value="{{ old('title_three', $counters?->title_three) }}">
                                    <x-input-error :messages="$errors->get('title_three')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="counter_three" class="form-label">Counter Three</label>
                                    <input type="text" class="form-control" name="counter_three"
                                        value="{{ old('counter_three', $counters?->counter_three) }}">
                                    <x-input-error :messages="$errors->get('counter_three')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="title_four" class="form-label">Title Four</label>
                                    <input type="text" class="form-control" name="title_four"
                                        value="{{ old('title_four', $counters?->title_four) }}">
                                    <x-input-error :messages="$errors->get('title_four')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="counter_four" class="form-label">Counter Four</label>
                                    <input type="text" class="form-control" name="counter_four"
                                        value="{{ old('counter_four', $counters?->counter_four) }}">
                                    <x-input-error :messages="$errors->get('counter_four')" class="mt-2" />
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary mt-3">
                                <i class="ti ti-device-floppy space"></i>
                                Save
                            </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
