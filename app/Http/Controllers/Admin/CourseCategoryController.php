<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseCategoryStoreRequest;
use App\Models\CourseCategory;
use App\Traits\Fileupload;
use Illuminate\Contracts\View\View;
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
        $categories = CourseCategory::paginate(10);
        return view('admin.course.course-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.course-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseCategoryStoreRequest $request)
    {

        $imagePath = $this->uploadFile($request->file('image'));

        $category = new CourseCategory();

        $category->image = $imagePath;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->icon = $request->icon;
        $category->set_trending = $request->set_trending ?? 0;
        $category->status = $request->status ?? 0;
        $category->save();

        // if ($request->hasFile('image')) {
        //     $imageName = time() . '.' . $request->image->extension();
        //     $request->image->move(public_path('images/course-category'), $imageName);
        //     $category->image = 'images/course-category/' . $imageName;
        // }

        // notyf()->success('Course Category created successfully.');
        return to_route('admin.course-categories.index')->with('success', 'Course Category created successfully.');
        // if ($category->save()) {
        // return redirect()->back()->with('success', 'Category created successfully');
        // } else {
        // return redirect()->back()->with('error', 'Failed to create category');
        // }
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
