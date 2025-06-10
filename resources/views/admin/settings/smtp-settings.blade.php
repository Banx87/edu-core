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
                    <div class="col-md-6">
                        <div class="form-label">Mail Username</div>
                        <input type="text" class="form-control" value="{{ config('settings.mail_username') }}"
                            name="mail_username">
                        <x-input-error :messages="$errors->get('mail_username')" class="mt-2" />
                    </div>
                    <div class="col-md-6">
                        <div class="form-label">Mail Password</div>
                        <input type="text" class="form-control" value="{{ config('settings.mail_password') }}"
                            name="mail_password">
                        <x-input-error :messages="$errors->get('mail_password')" class="mt-2" />
                    </div>
                    <div class="col-md-6">
                        <div class="form-label">Mailer</div>
                        <input type="text" class="form-control" value="{{ config('settings.mail_mailer') }}"
                            name="mail_mailer">
                        <x-input-error :messages="$errors->get('mail_mailer')" class="mt-2" />
                    </div>
                    <div class="col-md-6">
                        <div class="form-label">Mail Host</div>
                        <input type="text" class="form-control" value="{{ config('settings.mail_host') }}"
                            name="mail_host">
                        <x-input-error :messages="$errors->get('mail_host')" class="mt-2" />
                    </div>
                    <div class="col-md-6">
                        <div class="form-label">Mail Port</div>
                        <input type="text" class="form-control" value="{{ config('settings.mail_port') }}"
                            name="mail_port">
                        <x-input-error :messages="$errors->get('mail_port')" class="mt-2" />
                    </div>

                    <div class="col-md-6">
                        <div class="form-label">Encryption</div>
                        <input type="text" class="form-control" value="{{ config('settings.mail_encryption') }}"
                            name="mail_encryption">
                        <x-input-error :messages="$errors->get('mail_encryption')" class="mt-2" />
                    </div>
                    <div class="col-md-6">
                        <div class="form-label">Mail Queue</div>
                        <select name="mail_queue" class="form-select">
                            <option value="on" @selected(config('settings.mail_queue') == 'on')>On</option>
                            <option value="off" @selected(config('settings.mail_queue') == 'off')>Off</option>
                        </select>
                        <x-input-error :messages="$errors->get('mail_queue')" class="mt-2" />
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
