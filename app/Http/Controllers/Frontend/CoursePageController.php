<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLanguage;
use App\Models\CourseLevels;
use App\Models\Enrollment;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                if (is_array($request->category)) {
                    $query->whereIn('category_id', $request->category);
                } else {
                    $query->where('category_id', $request->category);
                }
            })
            ->when($request->filled('main_category'), function ($query) use ($request) {
                $query->whereHas('category', function ($query) use ($request) {
                    $query->whereHas('parentCategory', function ($query) use ($request) {
                        $query->where('slug', $request->main_category);
                    });
                });
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
        $course = Course::with('reviews')->where('slug', $slug)
            ->where('is_approved', 'approved')
            ->where('status', 'active')
            ->firstOrFail();

        $reviews = Review::where('course_id', $course->id)->where('status', 1)->orderBy('created_at', 'desc')->paginate(5);

        return view('frontend.pages.course-details', compact('course', 'reviews'));
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
