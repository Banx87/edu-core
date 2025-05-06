<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CourseChapter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseContentController
{
    function createChapterModal(string $id): String
    {
        return view('frontend.instructor-dashboard.course.partials.course-chapter-modal', compact('id'))->render();
    }

    function storeChapter(Request $request, string $courseId): RedirectResponse
    {
        // dd([$request->all(), $courseId]);
        $request->validate([
            'title' => 'required|max:255',
            // 'course_id' => 'required|integer' //Pois kunnes keksin missä vika
        ]);

        $chapter = new CourseChapter();
        $chapter->title = $request->title;
        $chapter->course_id = $courseId;
        $chapter->instructor_id = Auth::user()->id;
        $chapter->order = CourseChapter::where('course_id', $courseId)->count() + 1;
        $chapter->save();

        return redirect()->back();
    }
}
