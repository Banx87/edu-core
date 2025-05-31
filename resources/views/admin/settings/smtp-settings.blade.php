@extends('admin.settings.layout')

@section('settings_content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <div class="card-body">
            <form action="{{ route('admin.smtp-settings.update') }}" method="POST">
                @csrf
                <h2 class="card-title mt-4">SMTP Settings</h2>
                <p>Set your Email configuration here.</p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-label">Sender Email</div>
                        <input type="text" class="form-control" value="{{ config('settings.sender_email') }}"
                            name="sender_email">
                        <x-input-error :messages="$errors->get('sender_email')" class="mt-2" />
                    </div>

                    <div class="col-md-6">
                        <div class="form-label">Receiver Email</div>
                        <input type="text" class="form-control" value="{{ config('settings.receiver_email') }}"
                            name="receiver_email">
                        <x-input-error :messages="$errors->get('receiver_email')" class="mt-2" />
                    </div>
                </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list">
                <button type="submit" href="#" class="common_btn"> Submit </button>
            </div>
        </div>
        </form>
    </div>
@endsection
