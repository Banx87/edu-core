<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\ContactSetting;
use App\Models\Enrollment;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    function index(): View
    {
        $contactCards = Contact::where('status', 1)->get();
        $contactSettings = ContactSetting::first();

        return view('frontend.pages.contact', compact('contactCards', 'contactSettings'));
    }

    function sendMail(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'contact_message' => 'required|string|max:255',
        ]);

        Mail::to(config('settings.receiver_email'))->send(new ContactMail($request->name, $request->email, $request->subject, $request->contact_message));

        if (config('mail_queue.is_queue')) {
            Mail::to(config('settings.receiver_email'))->queue(new ContactMail($request->name, $request->email, $request->subject, $request->contact_message));
        } else {
            Mail::to(config('settings.receiver_email'))->send(new ContactMail($request->name, $request->email, $request->subject, $request->contact_message));
        }

        notyf()->success('Message sent successfully.');
        return redirect()->back();
    }

    function storeReview(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'required|string|max:1000',
            'course' => 'required|integer',
        ]);

        $userId = Auth::user()->id;
        $courseId = $request->course;

        $checkPurchase = Enrollment::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->exists();

        if (!$checkPurchase) {
            notyf()->error('You have not purchased this course.');
            return redirect()->back();
        }

        Review::updateOrCreate(
            [
                'user_id' => $userId,
                'course_id' => $courseId,
            ],
            [
                'rating' => $validatedData['rating'],
                'review' => $validatedData['review'],
                'status' => 0
            ]
        );

        notyf()->success('Review submitted/updated successfully.');
        return redirect()->back();
    }
}
