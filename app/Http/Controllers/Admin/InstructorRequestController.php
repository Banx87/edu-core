<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InstructorRequestApprovedMail;
use App\Mail\InstructorRequestRejectedMail;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InstructorRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $instructorsRequest = User::where('approve_status', 'pending')->orWhere('approve_status', 'rejected')->get();
        return view('admin.instructor-request.index', compact('instructorsRequest'));
    }

    function downloadDoc(User $user)
    {
        return response()->download(public_path($user->document));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $instructor_request): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
        ]);
        $instructor_request->approve_status = $request->status;
        $request->status === 'approved' ? $instructor_request->role = 'instructor' : "student";
        $instructor_request->save();
        self::sendEmailNotification($request->status, $instructor_request);

        return redirect()->back();
    }

    public static function sendEmailNotification($status, $instructor_request): void
    {
        switch ($status) {
            case 'approved':
                if (config('mail_queue.is_queue')) {
                    Mail::to($instructor_request->email)->queue(new InstructorRequestApprovedMail());
                } else {
                    Mail::to($instructor_request->email)->send(new InstructorRequestApprovedMail());
                }
                break;
            case 'rejected':
                if (config('mail_queue.is_queue')) {
                    Mail::to($instructor_request->email)->queue(new InstructorRequestRejectedMail());
                } else {
                    Mail::to($instructor_request->email)->send(new InstructorRequestRejectedMail());
                }
                break;
            default:
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
