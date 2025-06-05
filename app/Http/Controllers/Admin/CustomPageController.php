<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomPageStoreRequest;
use App\Models\CustomPage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.custom-page.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.custom-page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomPageStoreRequest $request)
    {
        $page = new CustomPage();

        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->description = $request->description;
        $page->seo_title = $request->seo_title;
        $page->seo_description = $request->seo_description;
        $page->status = $request->status ?? 0;
        $page->save();

        notyf()->success('Page created successfully.');
        return to_route('admin.custom-page.index');
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
