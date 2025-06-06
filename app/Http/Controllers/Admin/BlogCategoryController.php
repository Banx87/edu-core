<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = BlogCategory::paginate(15);
        return view('admin.blog.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.blog.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:blog_categories,name',
            'status' => 'boolean',
        ]);

        $category = new BlogCategory();
        $category->name = $request->title;
        $category->slug = Str::slug($request->title);
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success('Blog Category created successfully.');
        return to_route('admin.blog-categories.index');
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
        $category = BlogCategory::findOrFail($id);
        return view('admin.blog.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'title' => 'nullable|string|max:255|unique:blog_categories,name,' . $id,
            'status' => 'boolean',
        ]);

        $category = BlogCategory::findOrFail($id);
        $category->name = $request->title;
        $category->slug = Str::slug($request->title);
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success('Blog Updated created successfully.');
        return to_route('admin.blog-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = BlogCategory::findOrFail($id);
            $category->delete();
            notyf()->success('Blog Category deleted successfully.');
            return response(['message' => 'Deleted sucesfully!!'], 200);
        } catch (Exception $e) {
            logger('Blog Category Edit Error >> ' . $e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}