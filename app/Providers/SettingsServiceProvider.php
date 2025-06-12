<?php

namespace App\Providers;

use App\Service\SettingsService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SettingsService::class, function () {
            return new SettingsService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $settings = $this->app->make(SettingsService::class);
        $settings->setGlobalSettings();

        // set Mail config
        Config::set(['mail.mailers.smtp' => [
            'transport' => config('settings.mail_mailer'),
            'host' => config('settings.mail_host'),
            'port' => config('settings.mail_port'),
            'username' => config('settings.mail_username'),
            'password' => config('settings.mail_password'),
            'encryption' => config('settings.mail_encryption'),
        ]]);

        Config::set(['mail.queue.mailers.smtp' => [
            'mail_queue.is_queue' => config('settings.mail_queue'),
        ]]);

        Config::set('mail.from', [
            'address' => config('settings.sender_email'),
            'name' => config('settings.site_title'),
        ]);
    }
}
