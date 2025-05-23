<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Traits\Fileupload;


class FeatureController extends Controller
{

    use Fileupload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $feature = Feature::first();
        return view('admin.sections.feature.index', compact('feature'));
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
    public function update(Request $request): RedirectResponse
    {
        $data = [
            'title_one' => $request->title_one,
            'title_two' => $request->title_two,
            'title_three' => $request->title_three,
            'text_one' => $request->text_one,
            'text_two' => $request->text_two,
            'text_three' => $request->text_three
        ];

        foreach (array_keys($request->all()) as $key) {
            if (in_array($key, ['image_one', 'image_two', 'image_three']) && $request->hasFile($key)) {
                $this->deleteFile('old_' . $key);
                $image = $this->uploadFile($request->file($key));
                $data[$key] = $image;
            }
        }

        Feature::updateOrCreate(
            ['id' => 1],
            $data
        );

        notyf()->success('Feature Data Updated Successfully');

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
