<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PaymentSettingController extends Controller
{
    function index(): View
    {
        return view('admin.payment-setting.index');
    }

    function paypalSettings(Request $request): RedirectResponse
    {

        $validatedData = $request->validate([
            'paypal_mode' => 'required|in:live,sandbox',
            'paypal_currency' => 'required',
            'paypal_rate' => 'required|numeric',
            'paypal_client_id' => 'required',
            'paypal_client_secret' => 'required',
            'paypal_app_id' => 'required',
        ]);

        foreach ($validatedData as $key => $value) {
            PaymentSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Cache::forget('gatewaySettings');

        notyf()->success('PayPal settings updated successfully.');
        return redirect()->back();
    }

    function stripeSettings(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'stripe_status' => 'required|in:active,inactive',
            'stripe_currency' => 'required',
            'stripe_rate' => 'required|numeric',
            'stripe_publishable_key' => 'required',
            'stripe_secret' => 'required',
        ]);

        foreach ($validatedData as $key => $value) {
            PaymentSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Cache::forget('gatewaySettings');

        notyf()->success('Stripe settings updated successfully.');
        return redirect()->back();
    }
}
