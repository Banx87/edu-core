<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoSection;
use App\Traits\Fileupload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class VideoSectionController extends Controller
{
    use Fileupload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $video = VideoSection::first();
        return view('admin.sections.video-section.index', compact('video'));
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
        $validatedData = $request->validate([
            'video_url' => 'nullable|string',
            'description' => 'nullable|string|max:1000',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('background_image')) {
            $request->validate([
                'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            ], [
                'background_image.image' => 'The file must be an image.',
                'background_image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
                'background_image.max' => 'The image may not be greater than 3MB.',
            ]);
            $image = $this->uploadFile($request->file('background_image'));
            if (!empty($request->old_image) && file_exists(public_path($request->old_image))) {
                $this->deleteFile($request->old_image);
            }
            $validatedData['background_image'] = $image;
        }

        VideoSection::updateOrCreate(
            ['id' => $id],
            $validatedData
        );

        notyf()->success('Video Section updated successfully.');
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
