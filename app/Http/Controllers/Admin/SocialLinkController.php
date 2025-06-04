<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use App\Traits\Fileupload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    use Fileupload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $socialLinks = SocialLink::first();
        return view('admin.social-link.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.social-link.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'url' => 'required|url',
            'status' => 'boolean',
            'icon' => 'nullable|regex:/^ti ti(-[a-zA-Z0-9_-]+)*$/'
        ], [
            'icon.regex' => 'The icon must be a valid icon name. (ti ti-*)',
            'status.boolean' => 'The status field must be a boolean.',
            'url.required' => 'The url field is required.'
        ]);

        if ($request->icon === null && !$request->hasFile('image')) {
            notyf()->error('Either icon or image is required.');
            return back();
        }

        $social = new SocialLink();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $this->uploadFile($image);
            $social->icon = $imagePath;
        }

        if ($request->image_type == 1) {
            $social->icon = $request->icon;
        }
        $social->url = $request->url;
        $social->status = $request->has('status') ? 1 : 0;
        $social->save();

        notyf()->success('Social link created successfully.');
        return to_route('admin.social-links.index');
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
