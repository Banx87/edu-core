<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    function index()
    {
        return view('admin.settings.general-settings');
    }

    function updateGeneralSettings(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'site_title' => 'required|string',
            // 'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'nullable',
            // 'email' => 'nullable|email',
            'location' => 'nullable',
            'currency' => 'required',
            'currency_icon' => 'required',
        ]);

        foreach ($validatedData as $key => $value) {
            Settings::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Cache::forget('settings');

        notyf()->success('Settings updated successfully.');
        return redirect()->back();
    }

    function CommissionIndex(): View
    {
        return view('admin.settings.commission');
    }

    function updateCommission(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'commission_rate' => 'required|numeric',
            // 'instructor_commission' => 'required|numeric',
        ]);

        foreach ($validatedData as $key => $value) {
            Settings::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Cache::forget('settings');

        notyf()->success('Settings updated successfully.');
        return redirect()->back();
    }

    function smtpSetting(): View
    {
        return view('admin.settings.smtp-settings');
    }

    function updateSmtpSettings(Request $request): RedirectResponse
    {

        $validatedData = $request->validate([
            // 'smtp_host' => 'required',
            // 'smtp_port' => 'required',
            // 'smtp_username' => 'required',
            // 'smtp_password' => 'required',
            // 'smtp_encryption' => 'required',
            'sender_email' => 'required|email|max:255',
            'receiver_email' => 'required|email|max:255',
        ]);

        foreach ($validatedData as $key => $value) {
            Settings::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Cache::forget('settings');

        notyf()->success('SMTP Settings updated successfully.');
        return redirect()->back();
    }
}
