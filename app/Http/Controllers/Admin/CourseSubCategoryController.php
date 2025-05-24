<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseSubCategoryStoreRequest;
use App\Http\Requests\Admin\CourseSubCategoryUpdateRequest;
use App\Models\CourseCategory;
use App\Traits\Fileupload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CourseSubCategoryController extends Controller
{
    use Fileupload;

    /**
     * Display a listing of the resource.
     */
    public function index(CourseCategory $course_category)
    {
        $sub_categories = CourseCategory::where('parent_id', $course_category->id)->paginate(10);
        return view('admin.course.course-sub-category.index', compact('course_category', 'sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CourseCategory $course_category)
    {
        return view('admin.course.course-sub-category.create', compact('course_category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseSubCategoryStoreRequest $request, CourseCategory $course_category)
    {
        $category = new CourseCategory();

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
            $category->image = $imagePath;
        }
        $category->parent_id = $course_category->id;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->icon = $request->icon;
        $category->set_trending = $request->set_trending ?? 0;
        $category->status = $request->status ?? 0;
        $category->save();

        return to_route('admin.course-sub-categories.index', $course_category->id)->with('success', 'Sub Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseCategory $course_category, CourseCategory $course_sub_category)
    {
        return view('admin.course.course-sub-category.edit', compact('course_category', 'course_sub_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseSubCategoryUpdateRequest $request, CourseCategory $course_category, CourseCategory $course_sub_category)
    {
        $category = $course_sub_category;

        // Handle the image upload
        if ($request->hasFile('image')) {
            if ($category->image) {
                // Delete the old image
                $this->deleteFile($category->image);
            }
            $imagePath = $this->uploadFile($request->file('image'));
            $category->image = $imagePath;
        }
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->icon = $request->icon;
        $category->set_trending = $request->set_trending ?? 0;
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success('Sub Category updated successfully.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseCategory $course_category, CourseCategory $course_sub_category)
    {
        try {
            $this->deleteFile($course_sub_category->image);
            $course_sub_category->delete();
            redirect()->route('admin.course-categories.index')->with('success', 'Course Category deleted successfully.');

            return response()->json(['success' => 'Course Category deleted successfully.']);
        } catch (Exception $e) {
            logger()->error('Error deleting course Category: ' . $e->getMessage());
            redirect()->route('admin.course-categories.index')->with('error', 'Course Category cannot be deleted.');

            return response()->json(['error' => 'Course Category cannot be deleted.']);
        }
    }
}
