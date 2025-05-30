<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ContactSettingController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $contactSettings = ContactSetting::first();
        return view('admin.contact.contact-setting.index', compact('contactSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|max:3000',
            'email' => 'nullable|email',
            'map_url' => 'nullable|url'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
            $validatedData['image'] = $imagePath;
        };

        ContactSetting::updateOrCreate(['id' => 1], $validatedData);

        notyf()->success('Settings Updated successfully.');
        return redirect()->back();
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