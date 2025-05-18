<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\PasswordUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Http\Requests\Frontend\SocialUpdateRequest;
use App\Models\InstructorPayoutInformation;
use App\Models\PayoutGateway;
use App\Models\User;
use App\Traits\Fileupload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    use Fileupload;

    function index(): View
    {
        return view('frontend.student-dashboard.profile.index');
    }

    function instructorIndex(): View
    {
        $gateways = PayoutGateway::where('status', 1)->get();
        return view('frontend.instructor-dashboard.profile.index', compact('gateways'));
    }

    function profileUpdate(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = User::find(Auth::id());
        if ($request->hasFile('avatar')) {
            $avatarPath = $this->uploadFile($request->file('avatar'));
            $this->deleteFile($user->image);
            $user->image = $avatarPath;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->headline = $request->headline;
        $user->bio = $request->about;
        $user->gender = $request->gender;
        $user->save();

        notyf()->success('Profile updated successfully.');

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    function updatePassword(PasswordUpdateRequest $request): RedirectResponse
    {

        $user = Auth::user();
        if ($user instanceof \App\Models\User) {
            $user->password = bcrypt($request->password);
            $user->save();

            notyf()->success('Password updated successfully.');
            return redirect()->back()->with('success', 'Password updated successfully.');
        } else {
            notyf()->error('User not found.');
            return redirect()->back()->with('error', 'User not found.');
        }
    }

    function updateGatewayInfo(Request $request)
    {
        InstructorPayoutInformation::updateOrCreate(
            ['instructor_id' => Auth::user()->id],
            [
                'payout_gateway' => $request->gateway,
                'information' => $request->information
            ]
        );

        notyf()->success('Payout information updated successfully.');

        return redirect()->back();
    }

    function updateSocial(SocialUpdateRequest $request): RedirectResponse
    {
        $user = User::find(Auth::id());
        $user->facebook = $request->facebook;
        $user->x = $request->x;
        $user->linkedin = $request->linkedin;
        $user->website = $request->website;
        $user->github = $request->github;
        $user->save();

        notyf()->success('Updated successfully.');

        return redirect()->back()->with('success', 'Social links updated successfully.');
    }
}