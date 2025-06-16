<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutUsSectionUpdateRequest;
use App\Models\AboutUsSection;
use App\Models\Blog;
use App\Models\Counter;
use App\Models\Testimonial;
use App\Traits\Fileupload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AboutUsSectionController extends Controller
{
    use Fileupload;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $about = AboutUsSection::first();
        $counter = Counter::first();
        $testimonials = Testimonial::all();
        $blogs = Blog::where('status', 1)->latest()->limit(6)->get();

        return view('admin.sections.about-section.index', compact('about', 'counter', 'testimonials', 'blogs'));
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
    public function update(AboutUsSectionUpdateRequest $request)
    {
        $id = 1;
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'rounded_text' => $request->rounded_text,
            'banner_title' => $request->banner_title,
            'banner_text' => $request->banner_text,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'video_url' => $request->video_url
        ];

        foreach (array_keys($request->all()) as $key) {
            if (in_array($key, ['banner_image', 'video_image', 'image']) && $request->hasFile($key)) {
                $this->deleteFile('old_' . $key);
                $image = $this->uploadFile($request->file($key));
                $data[$key] = $image;
            }
        }

        AboutUsSection::updateOrCreate(
            ['id' => $id],
            $data
        );

        notyf()->success('About Us Section Data Updated Successfully');

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