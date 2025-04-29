<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\PasswordUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    function index(): View
    {
        return view('frontend.student-dashboard.profile.index');
    }

    function profileUpdate(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->headline = $request->headline;
        $user->bio = $request->about;
        $user->gender = $request->gender;
        $user->save();

        return Redirect::route('student.profile.index')->with('success', 'Profile updated successfully.');
    }

    function updatePassword(PasswordUpdateRequest $request): RedirectResponse
    {

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}