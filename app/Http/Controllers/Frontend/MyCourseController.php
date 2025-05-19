<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class MyCourseController extends Controller
{
    function index(): View
    {
        $enrolledCourses = Enrollment::with('course')->where('user_id', Auth::user()->id)->get();
        return view('frontend.student-dashboard.my-courses.index', compact('enrolledCourses'));
    }

    function playerIndex(string $slug): View
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        // Check if the user is enrolled in the course
        // If not, return 404
        if (!Enrollment::where('user_id', Auth::user()->id)->where('course_id', $course->id)->where('have_access', 1)->exists()) return (abort(404));
        return view('frontend.student-dashboard.my-courses.player-index', compact('course'));
    }
}
