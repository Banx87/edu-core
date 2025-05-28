<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Traits\Fileupload;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    use Fileupload;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $testimonials = Testimonial::paginate(20);
        return view('admin.sections.testimonial.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.sections.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'review' => 'required|string|max:500',
                'rating' => 'required|numeric|min:1|max:5',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3000',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            ]
        );

        $imagePath = $this->uploadFile($request->file('image'));
        if ($request->hasFile('logo')) $logoPath = $this->uploadFile($request->file('logo'));

        $testimonial = new Testimonial();
        $testimonial->user_name = $request->name;
        $testimonial->user_title = $request->title;
        $testimonial->review = $request->review;
        $testimonial->rating = $request->rating;
        $testimonial->user_image = $imagePath;
        $testimonial->logo = $logoPath ?? null;
        $testimonial->save();

        notyf()->success('Testimonial created successfully.');
        return redirect()->route('admin.testimonial-section.index');
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
    public function edit(Testimonial $testimonial_section): View
    {
        $testimonial = $testimonial_section;
        return view('admin.sections.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'review' => 'required|string|max:1000',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        foreach (['image', 'logo'] as $fileType) {
            if ($request->hasFile($fileType)) {
                $request->validate([
                    $fileType => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3000',
                ]);

                // Delete the old picture from the server
                if (!empty($request->{"old_$fileType"}) && file_exists(public_path($request->{"old_$fileType"}))) {
                    $this->deleteFile($request->{"old_$fileType"});
                }
                // Upload the new picture
                $imagePath = $this->uploadFile($request->file($fileType));
                $validatedData[$fileType] = $imagePath;
            }
        }

        Testimonial::updateOrCreate(['id' => $id], $validatedData);

        notyf()->success('Testimonial updated successfully.');
        return redirect()->route('admin.testimonial-section.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial_section)
    {
        try {
            $testimonial_section->delete();
            if (file_exists(public_path($testimonial_section->user_image))) {
                $this->deleteFile($testimonial_section->user_image);
            }
            if (file_exists(public_path($testimonial_section->logo))) {
                $this->deleteFile($testimonial_section->logo);
            }
            redirect()->route('admin.testimonial-section.index')->with('success', 'Testimonial deleted successfully.');
            return response()->json(['success' => 'Testimonial deleted successfully.']);
        } catch (Exception $e) {
            logger()->error('Error deleting Testimonial: ' . $e->getMessage());
            redirect()->route('admin.testimonial-section.index')->with('error', 'Testimonial cannot be deleted.');

            return response()->json(['error' => 'Testimonial cannot be deleted.']);
        }
    }
}
