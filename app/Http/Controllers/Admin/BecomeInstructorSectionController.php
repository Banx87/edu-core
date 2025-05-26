<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BecomeInstructorSection;
use App\Traits\Fileupload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BecomeInstructorSectionController extends Controller
{
    use Fileupload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $becomeInstructor = BecomeInstructorSection::first();
        return view('admin.sections.become-instructor.index', compact('becomeInstructor'));
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
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            ], [
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
                'image.max' => 'The image may not be greater than 3MB.',
            ]);
            $image = $this->uploadFile($request->file('image'));
            if (!empty($request->old_image) && file_exists(public_path($request->old_image))) {
                $this->deleteFile($request->old_image);
            }
            $validatedData['image'] = $image;
        }

        BecomeInstructorSection::updateOrCreate(
            ['id' => $id],
            $validatedData
        );

        notyf()->success('Become Instructor Section updated successfully.');
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
