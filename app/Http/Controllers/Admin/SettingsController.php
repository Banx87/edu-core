<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Contracts\Support\ValidatedData;
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
}