<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\FeaturedInstructor;
use App\Models\User;
use App\Traits\Fileupload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FeaturedInstructorController extends Controller
{
    use Fileupload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $instructors = User::where('role', 'instructor')->where('approve_status', 'approved')->get();
        $featuredInstructor = FeaturedInstructor::first();
        $selectedCourses = json_decode($featuredInstructor?->featured_courses);
        $selectedInstructorCourses = Course::select(['id', 'title'])->where('instructor_id', $featuredInstructor?->instructor_id)->get();
        return view('admin.sections.featured-instructor.index', compact('instructors', 'featuredInstructor', 'selectedCourses', 'selectedInstructorCourses'));
    }

    function getInstructorCourses(string $id): Response
    {
        $courses = Course::select(['id', 'title'])->where('instructor_id', $id)->where('is_approved', 'approved')->where('status', 'active')->get();
        return response(['courses' => $courses]);
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
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructor_id' => 'required|exists:users,id',
            'button_text' => 'required|string|max:100',
            'button_url' => 'required|url',
            'featured_courses' => 'required|array|min:1',
            'featured_courses.*' => 'required|exists:courses,id',
            'instructor_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3000',
        ], [
            'instructor_image.image' => 'The file must be an image.',
            'instructor_image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'instructor_image.max' => 'The image may not be greater than 3MB.',

        ]);

        $validatedData['featured_courses'] = json_encode($validatedData['featured_courses']);

        if ($request->hasFile('instructor_image')) {
            $image = $this->uploadFile($request->file('instructor_image'));
            if (!empty($request->old_image) && file_exists(public_path($request->old_image))) {
                $this->deleteFile($request->old_image);
            }
            $validatedData['instructor_image'] = $image;
        }

        FeaturedInstructor::updateOrCreate(['id' => 1], $validatedData);

        notyf()->success('Featured Instructor updated successfully.');
        return redirect()->back();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
