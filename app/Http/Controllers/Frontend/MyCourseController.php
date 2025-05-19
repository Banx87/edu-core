<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyCourseController extends Controller
{
    function index(): View
    {

        $enrolledCourses = Enrollment::with('course')->where('user_id', Auth::user()->id)->get();
        return view('frontend.student-dashboard.my-courses.index', compact('enrolledCourses'));
    }
}
