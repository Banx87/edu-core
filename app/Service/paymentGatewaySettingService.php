<?php

namespace App\Service;

use App\Models\PaymentSetting;
use Illuminate\Support\Facades\Cache;

class paymentGatewaySettingService
{
    /**
     * Retrieve all payment gateway settings from the database and cache.
     * 
     * @return array Associative array of key-value pairs of payment gateway settings.
     *               Keys are the setting names, and values are their respective values.
     */
    function getSettings(): array
    {
        return Cache::rememberForever('gatewaySettings', function () {
            return PaymentSetting::pluck('value', 'key')->toArray(); //['KEY' => 'VALUE]
        });
    }

    /**
     * Set the payment gateway settings in the Laravel config
     * facade as 'gateway_settings'. This allows the settings to
     * be accessed globally in the application via the config()
     * helper function.
     */
    function setGlobalSettings()
    {
        $settings = $this->getSettings();
        config()->set('gateway_settings', $settings); // config('gateway_settings')
    }
}
