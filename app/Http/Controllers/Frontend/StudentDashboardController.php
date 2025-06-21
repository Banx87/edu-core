<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use App\Traits\Fileupload;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    use Fileupload;


    function index(): View
    {
        $userCourses = user()->enrollments()->count();
        $reviewCount = Review::where('user_id', user()->id)->count();
        $orderCount = Order::where('buyer_id', user()->id)->count();
        $orders = Order::where('buyer_id', user()->id)
            ->paginate(25);


        return view('frontend.student-dashboard.index', compact(
            'userCourses',
            'reviewCount',
            'orderCount',
            'orders'
        ));
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

    function review(): View
    {
        $reviews = Review::where('user_id', Auth::user()->id)->paginate(10);
        return view('frontend.student-dashboard.review.index', compact('reviews'));
    }

    function reviewDestroy(string $id)
    {
        try {
            $review = Review::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
            $review->delete();

            notyf()->success('Review deleted successfully.');

            return response(['message' => 'Review deleted successfully!'], 200);
        } catch (Exception $e) {
            logger()->error('Error deleting review: ' . $e->getMessage());

            notyf()->error('Something went wrong.');

            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
