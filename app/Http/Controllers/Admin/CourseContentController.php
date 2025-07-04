<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseChapter;
use App\Models\CourseChapterLesson;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseContentController
{
    function createChapterModal(string $id): String
    {
        return view('admin.course.course-module.partials.course-chapter-modal', compact('id'))->render();
    }

    function storeChapter(Request $request, string $courseId): RedirectResponse
    {
        // dd([$request->all(), $courseId]);
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $course = Course::findOrFail($courseId);

        $chapter = new CourseChapter();
        $chapter->title = $request->title;
        $chapter->course_id = $courseId;
        $chapter->instructor_id = $course->instructor_id;
        $chapter->order = CourseChapter::where('course_id', $courseId)->count() + 1;
        $chapter->save();

        notyf()->success('Chapter Created Successfully!');

        return redirect()->back();
    }

    function createLesson(Request $request): String
    {
        $courseId = $request->course_id;
        $chapterId = $request->chapter_id;
        return view('admin.course.course-module.partials.chapter-lesson-modal', compact('courseId', 'chapterId'))->render();
    }

    function storeLesson(Request $request): RedirectResponse
    {

        $rules = [
            'title' => 'required|string|max:255',
            'source' => 'required|string',
            'file_type' => 'required|in:video,audio,pdf,docx,file',
            'duration' => 'required',
            'is_preview' => 'nullable|boolean',
            'is_downloadable' => 'nullable|boolean',
            'description' => 'required',
        ];

        if ($request->filled('file')) {
            $rules['file'] = ['required'];
        } else {
            $rules['url'] = ['required'];
        }
        $request->validate($rules);

        $lesson = new CourseChapterLesson();
        $lesson->title = $request->title;
        $lesson->slug = Str::slug($request->title);
        $lesson->storage = $request->source;
        $lesson->file_path = $request->filled('file') ? $request->file : $request->url;
        $lesson->file_type = $request->file_type;
        $lesson->duration = $request->duration;
        $lesson->is_preview = $request->filled('is_preview') ? 1 : 0;
        $lesson->downloadable = $request->filled('is_downloadable') ? 1 : 0;
        $lesson->description = $request->description;
        $lesson->order = CourseChapterLesson::where('chapter_id', $request->chapter_id)->count() + 1;

        $lesson->instructor_id = Auth::user()->id;
        $lesson->course_id = $request->course_id;
        $lesson->chapter_id = $request->chapter_id;

        $lesson->save();

        notyf()->success('Lesson created Succesfully!');

        return redirect()->back();
    }

    function editChapterModal(string $id, Request $request): String
    {
        $editMode = true;
        $chapter = CourseChapter::where('id', $id)->firstOrFail();
        return view('admin.course.course-module.partials.course-chapter-modal', compact('chapter', 'editMode'))->render();
    }

    function updateChapterModal(string $id, Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $chapter = CourseChapter::findOrFail($id);
        $chapter->title = $request->title;
        $chapter->save();

        notyf()->success('Chapter Title Updated Successfully!');
        return redirect()->back();
    }

    function destroyChapter(string $id): Response
    {

        // Delete chapter
        $chapter = CourseChapter::findOrFail($id);
        $chapter->delete;

        try {
            $chapter = CourseChapter::findOrFail($id);
            $chapter->delete();
            notyf()->success('Chapter deleted succesfully');
            // redirect()->route('admin.course-languages.index')->with('success', 'Course Language deleted successfully.');

            return response(['message' => 'Chapter deleted successfully!'], 200);
        } catch (\Exception $e) {
            logger()->error('Error deleting chapter: ' . $e->getMessage());
            // redirect()->route('admin.course-languages.index')->with('error', 'Course Language cannot be deleted.');

            return response(['message' => 'Something went wrong!'], 500);
        }
    }

    function editLesson(Request $request): String
    {
        $editMode = true;
        $lessonId = $request->lesson_id;
        $courseId = $request->course_id;
        $chapterId = $request->chapter_id;
        $lesson = CourseChapterLesson::where([
            'id' => $lessonId,
            'chapter_id' => $chapterId,
            'course_id' => $courseId,
            'instructor_id' => Auth::user()->id
        ])->first();

        return view('admin.course.course-module.partials.chapter-lesson-modal', compact('courseId', 'chapterId', 'lesson', 'editMode'))->render();
    }

    function updateLesson(Request $request, string $id): RedirectResponse
    {
        $rules = [
            'title' => 'required|string|max:255',
            'source' => 'required|string',
            'file_type' => 'required|in:video,audio,pdf,docx,file',
            'duration' => 'required',
            'is_preview' => 'nullable|boolean',
            'is_downloadable' => 'nullable|boolean',
            'description' => 'required',
        ];

        if ($request->filled('file')) {
            $rules['file'] = ['required'];
        } else {
            $rules['url'] = ['required'];
        }
        $request->validate($rules);

        $lesson = CourseChapterLesson::findOrFail($id);
        $lesson->title = $request->title;
        $lesson->slug = Str::slug($request->title);
        $lesson->storage = $request->source;
        $lesson->file_path = $request->filled('file') ? $request->file : $request->url;
        $lesson->file_type = $request->file_type;
        $lesson->duration = $request->duration;
        $lesson->is_preview = $request->filled('is_preview') ? 1 : 0;
        $lesson->downloadable = $request->filled('is_downloadable') ? 1 : 0;
        $lesson->description = $request->description;

        $lesson->save();
        notyf()->success('Lesson Updated Succesfully!');

        return redirect()->back();
    }

    function destroyLesson(string $id): Response
    {
        dd($id);
        try {
            $lesson = CourseChapterLesson::findOrFail($id);
            $lesson->delete();
            notyf()->success('Lesson deleted succesfully');
            // redirect()->route('admin.course-languages.index')->with('success', 'Course Language deleted successfully.');

            return response(['message' => 'Lesson deleted successfully!'], 200);
        } catch (\Exception $e) {
            logger()->error('Error deleting lesson: ' . $e->getMessage());
            // redirect()->route('admin.course-languages.index')->with('error', 'Course Language cannot be deleted.');

            return response(['message' => 'Something went wrong!'], 500);
        }
    }

    // Sort Chapter Lessons
    function sortChapterLessons(Request $request, string $id)
    {
        $newOrdering = $request->order_ids;

        foreach ($newOrdering as $order => $itemId) {
            $lesson = CourseChapterLesson::where(['chapter_id' => $id, 'id' => $itemId])->first();
            $lesson->order = $order + 1;
            $lesson->save();
        }

        return response(['status' => 'success', 'message' => 'Order Updated Succesfully']);
    }

    // return sort chapter list
    function sortChapters(string $id): String
    {
        $chapters = CourseChapter::where('course_id', $id)->orderBy('order')->get();

        return view('admin.course.course-module.partials.course-chapter-sort-modal', compact('chapters'))->render();
    }

    function updateSortChapter(Request $request, string $id)
    {
        $newOrdering = $request->order_ids;

        foreach ($newOrdering as $order => $itemId) {
            $chapter = CourseChapter::where(['course_id' => $id, 'id' => $itemId])->first();
            $chapter->order = $order + 1;
            $chapter->save();
        }

        return response(['status' => 'success', 'message' => 'Order Updated Succesfully']);
    }
}
