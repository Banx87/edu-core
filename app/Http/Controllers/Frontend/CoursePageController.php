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
    function index(Request $request): View
    {

        // dd($request->all());
        $courses = Course::where('is_approved', 'approved')
            ->where('status', 'active')
            ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            })
            ->when($request->has('category') && $request->filled('category'), function ($query) use ($request) {
                $query->whereIn('category_id', $request->category);
            })
            ->when($request->has('level') && $request->filled('level'), function ($query) use ($request) {
                $query->whereIn('course_level_id', $request->level);
            })
            ->when($request->has('language') && $request->filled('language'), function ($query) use ($request) {
                $query->whereIn('course_language_id', $request->language);
            })
            ->when($request->has('from') && $request->has('to') && $request->filled('from') && $request->filled('to'), function ($query) use ($request) {
                $query->whereBetween('price', [$request->from, $request->to]);
            })
            ->when($request->filled('sort_by'), function ($query) use ($request) {
                switch ($request->sort_by) {
                    case 'price':
                        $query->orderBy('price', 'asc');
                        break;
                    case 'discount':
                        $query->orderByRaw('COALESCE(discount, price) asc');
                        break;
                    case 'recently_added':
                        $query->orderBy('created_at', 'desc');
                        break;
                    default:
                        $query->orderBy('id', 'asc');
                        break;
                }
            }, function ($query) {
                $query->orderBy('id', 'desc');
            })
            ->paginate(6);

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
