<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseCategoryStoreRequest;
use App\Http\Requests\Admin\CourseCategoryUpdateRequest;
use App\Models\CourseCategory;
use App\Traits\Fileupload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseCategoryController extends Controller
{
    use Fileupload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = CourseCategory::whereNull('parent_id')->paginate(10);
        return view('admin.course.course-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.course-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseCategoryStoreRequest $request): RedirectResponse
    {
        $imagePath = $this->uploadFile($request->file('image'));

        $category = new CourseCategory();

        $category->image = $imagePath;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->icon = $request->icon;
        $category->show_at_trending = $request->show_at_trending ?? 0;
        $category->status = $request->status ?? 0;
        $category->save();

        return to_route('admin.course-categories.index')->with('success', 'Course Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseCategory $course_category): View
    {
        return view('admin.course.course-category.edit', compact('course_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseCategoryUpdateRequest $request, CourseCategory $course_category): RedirectResponse
    {

        // Handle the image upload
        $category = $course_category;
        if ($request->hasFile('image')) {
            if ($category->image) {
                $this->deleteFile($category->image);
            }
            $imagePath = $this->uploadFile($request->file('image'));
            $category->image = $imagePath;
        }

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->icon = $request->icon;
        $category->show_at_trending = $request->show_at_trending ?? 0;
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success('Course Category updated successfully.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseCategory $course_category)
    {

        // Check does this main category have any subcategories
        if (CourseCategory::where('parent_id', $course_category->id)->exists()) {
            redirect()->route('admin.course-categories.index')->with('error', 'Cannot delete a Main category, while it contains subcategories!');
            return response()->json(['error' => 'Cannot delete a Main category, while it contains subcategories!'], 422);
        }

        try {
            $this->deleteFile($course_category->image);
            $course_category->delete();
            redirect()->route('admin.course-categories.index')->with('success', 'Course Category deleted successfully.');

            return response()->json(['success' => 'Course Category deleted successfully.']);
        } catch (\Exception $e) {
            logger()->error('Error deleting course Category: ' . $e->getMessage());
            redirect()->route('admin.course-categories.index')->with('error', 'Course Category cannot be deleted.');

            return response()->json(['error' => 'Course Category cannot be deleted.']);
        }
    }
}
