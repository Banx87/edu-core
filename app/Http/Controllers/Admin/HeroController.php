<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\HeroUpdateRequest;
use App\Models\Hero;
use App\Traits\Fileupload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    use FileUpload;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $hero = Hero::first();
        return view('admin.sections.hero.index', compact('hero'));
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
    public function update(HeroUpdateRequest $request, string $hero): RedirectResponse
    {
        $data = [
            'label' => $request->label,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'video_button_text' => $request->video_button_text,
            'video_button_url' => $request->video_button_url,
            'banner_item_title' => $request->banner_item_title,
            'banner_item_subtitle' => $request->banner_item_subtitle,
            'round_text' => $request->round_text
        ];

        if ($request->hasFile('image')) {

            $image = $this->uploadFile($request->file('image'));
            if (!empty($request->old_image) && file_exists(public_path($request->old_image))) {
                $this->deleteFile($request->old_image);
            }
            $data['image'] = $image;
        }

        $heroModel = Hero::find($hero);

        if ($heroModel) {
            $heroModel->update($data);
            notyf()->success('Hero Page Updated Successfully');
        } else {
            $data['id'] = $hero;
            Hero::create($data);
            notyf()->success('Hero Page Created Successfully');
        }

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
