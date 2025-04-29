<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Fileupload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    use Fileupload;


    function index(): View
    {
        return view('frontend.student-dashboard.index');
    }

    function becomeInstructor(): View
    {
        if (Auth::user()->role === 'instructor') abort(403, 'You are already an instructor.');
        return view('frontend.student-dashboard.become-instructor.index');
    }

    function becomeInstructorUpdate(Request $request, User $user): RedirectResponse
    {
        $request->validate(['document' => ['required', 'max:12000', 'mimes:pdf,doc,docx,jpg,png']]);
        $filePath = $this->uploadFile($request->file('document'));
        $user->update([
            'approve_status' => 'pending',
            'document' => $filePath,
        ]);


        return redirect()->route('student.dashboard')->with('success', 'Your request to become an instructor has been submitted successfully.');
    }
}
