<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLanguage;
use App\Models\CourseLevels;
use Illuminate\Http\Request;

class CoursePageController extends Controller
{
    function index(): View
    {
        $courses = Course::where('is_approved', 'approved')
            ->where('status', 'active')
            ->paginate(12);

        $categories = CourseCategory::where('status', 1)->whereNull('parent_id')->orderBy('name')->get();
        $course_levels = CourseLevels::all();
        $course_languages = CourseLanguage::orderBy('name')->get();
        return view('frontend.pages.course-page', compact('courses', 'categories', 'course_levels', 'course_languages'));
    }

    function show(string $slug): View
    {
        $course = Course::where('slug', $slug)
            ->where('is_approved', 'approved')
            ->where('status', 'active')
            ->firstOrFail();
        return view('frontend.pages.course-details', compact('course'));
    }
}
