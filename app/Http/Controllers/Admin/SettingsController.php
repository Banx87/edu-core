<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Traits\Fileupload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    use Fileupload;
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
            'sender_email' => 'required|email|max:255',
            'receiver_email' => 'required|email|max:255',
            'mail_mailer' => 'required|string|max:255',
            'mail_host' => 'required|string|max:255',
            'mail_port' => 'required|numeric',
            'mail_username' => 'required|string|max:255',
            'mail_password' => 'required|string|max:255',
            'mail_encryption' => 'required|string|max:255',
            'mail_queue' => 'required|string|in:on,off',
        ]);

        foreach ($validatedData as $key => $value) {
            Settings::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Cache::forget('settings');

        notyf()->success('SMTP Settings updated successfully.');
        return redirect()->back();
    }

    function logoSettingIndex(): View
    {
        return view('admin.settings.logo-settings');
    }

    function updateLogoSettings(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3000',
            'site_footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3000',
            'site_favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3000',
            'site_breadcrumb' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3000',
        ]);

        // Handle Image Upload
        foreach (['site_logo', 'site_footer_logo', 'site_favicon', 'site_breadcrumb'] as $imageKey) {
            if (isset($validatedData[$imageKey]) && $request->hasFile($imageKey)) {
                $image = $this->uploadFile($request->file($imageKey));
                $this->deleteFile(config("settings.{$imageKey}"));
                Settings::updateOrCreate(['key' => $imageKey], ['value' => $image]);
                unset($validatedData[$imageKey]);
            }
        }

        // Update other settings
        foreach ($validatedData as $key => $value) {
            Settings::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Cache::forget('settings');

        notyf()->success('Settings updated successfully.');
        return redirect()->back();
    }
}