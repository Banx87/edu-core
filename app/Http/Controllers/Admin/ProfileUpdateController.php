<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\Fileupload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ProfileUpdateController extends Controller
{

    use Fileupload;

    function index(): View
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.index', compact('admin'));
    }

    function profileUpdate(Request $request): RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'bio' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3000',
        ]);

        $admin =   Auth::guard('admin')->user();

        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'));

            if (!empty($admin->image) && file_exists(public_path($admin->image))) {
                $this->deleteFile($admin->image);
            }
            $admin->image = $image;
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->bio = $request->bio;
        $admin->save();

        notyf()->success('Profile updated successfully.');

        return redirect()->back();
    }

    function passwordUpdate(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()],
            'confirmed',
            'password_confirmation' => 'required|same:password',
        ]);

        Auth::guard('admin')->user()->update([
            'password' => bcrypt($request->password),
        ]);

        notyf()->success('Password updated successfully.');

        return redirect()->back();
    }
}