<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\LatestCourseSection;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LatestCourseSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = CourseCategory::all();
        $latestCourseSection = LatestCourseSection::first();
        return view('admin.sections.latest-course.index', compact('categories', 'latestCourseSection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_1' => 'nullable|integer|exists:course_categories,id',
            'category_2' => 'nullable|integer|exists:course_categories,id',
            'category_3' => 'nullable|integer|exists:course_categories,id',
            'category_4' => 'nullable|integer|exists:course_categories,id',
            'category_5' => 'nullable|integer|exists:course_categories,id',
        ]);

        LatestCourseSection::updateOrCreate([
            'id' => 1,
        ], [
            'category_one' => $request->category_1,
            'category_two' => $request->category_2,
            'category_three' => $request->category_3,
            'category_four' => $request->category_4,
            'category_five' => $request->category_5
        ]);

        notyf()->success('Latest Course Section Updated Successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}