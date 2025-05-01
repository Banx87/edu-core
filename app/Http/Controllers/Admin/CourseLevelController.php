<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseLevels;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $levels = CourseLevels::paginate(10);
        return view('admin.course.course-levels.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.course-levels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:course_levels,name',
        ]);

        $language = new CourseLevels();
        $language->name = $request->name;
        $language->slug = Str::slug($request->name);
        $language->save();

        // notyf()->success('Course Language created successfully.');

        return redirect()->route('admin.course-levels.index')->with('success', 'Course Language created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseLevels $course_level)
    {
        return view('admin.course.course-levels.edit', compact('course_level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseLevels $course_level): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:course_levels,name,' . $course_level->id,
        ]);

        $course_level->name = $request->name;
        $course_level->slug = Str::slug($request->name);
        $course_level->save();

        return redirect()->route('admin.course-levels.index')->with('success', 'Course Language updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseLevels $course_level)
    {
        try {
            $course_level->delete();
            redirect()->route('admin.course-levels.index')->with('success', 'Course Level deleted successfully.');

            return response()->json(['success' => 'Course Level deleted successfully.']);
        } catch (\Exception $e) {
            logger()->error('Error deleting course level: ' . $e->getMessage());
            redirect()->route('admin.course-levels.index')->with('error', 'Course Level cannot be deleted.');

            return response()->json(['error' => 'Course Level cannot be deleted.']);
        }
    }
}
