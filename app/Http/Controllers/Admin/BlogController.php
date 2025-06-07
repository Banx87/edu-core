<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogCreateRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Traits\Fileupload;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    use Fileupload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $blogs = Blog::with('category')
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = BlogCategory::all();
        return view('admin.blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCreateRequest $request): RedirectResponse
    {

        $blog_image = $this->uploadFile($request->file('blog_image'));

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->content = $request->content;
        $blog->blog_category_id = $request->category;
        $blog->user_id = adminUser()->id;
        $blog->status = $request->status ?? 0;
        $blog->image = $blog_image;
        $blog->save();

        notyf()->success('Blog created successfully');
        return to_route('admin.blogs.index');
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
    public function edit(string $id): View
    {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::all();
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $blog = Blog::findOrFail($id);

        if ($request->hasFile('blog_image')) {
            $image = $this->uploadFile($request->file('blog_image'));
            $this->deleteFile(($request->old_image));
            $blog->image = $image;
        };

        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->status = $request->status ?? 0;
        $blog->content = $request->content;
        $blog->blog_category_id = $request->category;
        $blog->save();

        notyf()->success('Blog updated successfully');
        return to_route('admin.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            $blog = Blog::findOrFail($id);
            $this->deleteFile($blog->image);
            $blog->delete();
            notyf()->success('Blog deleted successfully.');
            return response(['message' => 'Deleted sucesfully!!'], 200);
        } catch (Exception $e) {
            logger('Blog Delete Error >> ' . $e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
