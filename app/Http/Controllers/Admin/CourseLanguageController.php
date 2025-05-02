<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseLanguage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $languages = CourseLanguage::paginate(10);
        return view('admin.course.course-languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.course-languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:course_languages,name',
        ]);

        $language = new CourseLanguage();
        $language->name = $request->name;
        $language->slug = Str::slug($request->name);
        $language->save();

        // notyf()->success('Course Language created successfully.');

        return redirect()->route('admin.course-languages.index')->with('success', 'Course Language created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseLanguage $course_language): View
    {
        return view('admin.course.course-languages.edit', compact('course_language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseLanguage $course_language): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:course_languages,name,' . $course_language->id,
        ]);

        $course_language->name = $request->name;
        $course_language->slug = Str::slug($request->name);
        $course_language->save();

        return redirect()->route('admin.course-languages.index')->with('success', 'Course Language updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseLanguage $course_language)
    {
        try {
            $course_language->delete();
            redirect()->route('admin.course-languages.index')->with('success', 'Course Language deleted successfully.');

            return response()->json(['success' => 'Course Language deleted successfully.']);
        } catch (\Exception $e) {
            logger()->error('Error deleting course language: ' . $e->getMessage());
            redirect()->route('admin.course-languages.index')->with('error', 'Course Language cannot be deleted.');

            return response()->json(['error' => 'Course Language cannot be deleted.']);
        }
    }
}
