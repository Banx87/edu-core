<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseChapterLesson;
use App\Models\Enrollment;
use App\Models\WatchHistory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

        $lessonCount = CourseChapterLesson::where('course_id', $course->id)->count();
        $watchedLastTime = WatchHistory::where(['user_id' => Auth::user()->id, 'course_id' => $course->id,])->orderBy('updated_at', 'desc')->first();
        $watchedLessonIds = WatchHistory::where(['user_id' => Auth::user()->id, 'course_id' => $course->id, 'is_completed' => 1])->pluck('lesson_id')->toArray();

        return view('frontend.student-dashboard.my-courses.player-index', compact(['course', 'watchedLastTime', 'watchedLessonIds', 'lessonCount']));
    }

    function getLessonContent(Request $request)
    {
        $lesson = CourseChapterLesson::where([
            'course_id' => $request->course_id,
            'chapter_id' => $request->chapter_id,
            'id' => $request->lesson_id
        ])->first();

        return response()->json($lesson);
    }

    function updateWatchHistory(Request $request)
    {
        WatchHistory::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'lesson_id' => $request->lesson_id,
            ],
            [
                'course_id' => $request->course_id,
                'chapter_id' => $request->chapter_id,
                // 'is_completed' => $request->is_completed,
                'updated_at' => now()
            ]
        );
    }

    function updateLessonCompletion(Request $request): Response
    {
        $watchedLesson = WatchHistory::where(['user_id' => Auth::user()->id, 'lesson_id' => $request->lesson_id])->first();
        WatchHistory::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'lesson_id' => $request->lesson_id,
            ],
            [
                'course_id' => $request->course_id,
                'chapter_id' => $request->chapter_id,
                'is_completed' => $watchedLesson->is_completed == 1 ? 0 : 1,
            ]
        );

        return response(['status' => 'success', 'message' => 'Lesson completion status updated successfully'], 200);
    }
}
