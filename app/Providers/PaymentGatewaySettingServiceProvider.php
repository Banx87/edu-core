<?php

namespace App\Providers;

use App\Service\paymentGatewaySettingService;
use Illuminate\Support\ServiceProvider;

class PaymentGatewaySettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(paymentGatewaySettingService::class, function () {
            return new paymentGatewaySettingService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $paymentGatewaySettingService = $this->app->make(paymentGatewaySettingService::class);
        $paymentGatewaySettingService->setGlobalSettings();
    }
}
