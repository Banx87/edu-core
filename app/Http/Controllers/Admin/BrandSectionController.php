<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\Fileupload;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BrandSectionController extends Controller
{

    use Fileupload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $brands = Brand::all();
        return view('admin.sections.brand-section.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.sections.brand-section.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'image' => 'required|image|max:3000',
            'url' => 'required|url',
            'status' => 'required|boolean'
        ]);

        $imagePath = $this->uploadFile($request->file('image'));

        $brand = new Brand();
        $brand->url = $request->url;
        $brand->status = $request->status;
        $brand->image = $imagePath;

        $brand->save();

        notyf()->success('Brand created successfully.');
        return redirect()->route('admin.brand-section.index');
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
    public function edit(Brand $brand_section): View
    {

        $brand = $brand_section;
        return view('admin.sections.brand-section.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'image' => 'nullable|image|max:3000',
            'url' => 'required|url',
            'status' => 'required|boolean'
        ]);

        $brand = Brand::findOrFail($id);
        if (!$brand) {
            notyf()->error('Brand not found.');
            return redirect()->route('admin.brand-section.index');
        }

        if ($request->hasFile('image')) {
            if (!empty($request->old_image) && file_exists(public_path($request->old_image))) {
                $this->deleteFile($request->old_image);
            }
            $imagePath = $this->uploadFile($request->file('image'));
            $brand->image = $imagePath;
        }

        $brand->url = $request->url;
        $brand->status = $request->status;

        $brand->save();

        notyf()->success('Brand Updated Successfully.');
        return redirect()->route('admin.brand-section.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand_section)
    {
        try {
            $brand_section->delete();
            if (file_exists(public_path($brand_section->image))) {
                $this->deleteFile($brand_section->image);
            }
            redirect()->route('admin.brand-section.index')->with('success', 'Brand deleted successfully.');
            return response()->json(['success' => 'Brand deleted successfully.']);
        } catch (Exception $e) {
            logger()->error('Error deleting Brand: ' . $e->getMessage());
            redirect()->route('admin.brand-section.index')->with('error', 'Brand cannot be deleted.');

            return response()->json(['error' => 'Brand cannot be deleted.']);
        }
    }
}
