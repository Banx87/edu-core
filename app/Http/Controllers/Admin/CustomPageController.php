<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomPageStoreRequest;
use App\Http\Requests\Admin\CustomPageUpdateRequest;
use App\Models\CustomPage;
use Exception;
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
        $customPages = CustomPage::paginate(15);
        return view('admin.custom-page.index', compact('customPages'));
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
        $page->show_at_nav = $request->show_at_nav ?? 0;
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
    public function edit(string $id): View
    {
        $custom_page = CustomPage::findOrFail($id);
        return view('admin.custom-page.edit', compact('custom_page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomPageUpdateRequest $request, string $id)
    {
        $custom_page = CustomPage::findOrFail($id);

        $custom_page->title = $request->title;
        $custom_page->slug = Str::slug($request->title);
        $custom_page->description = $request->description;
        $custom_page->seo_title = $request->seo_title;
        $custom_page->seo_description = $request->seo_description;
        $custom_page->status = $request->status ?? 0;
        $custom_page->show_at_nav = $request->show_at_nav ?? 0;
        $custom_page->save();

        notyf()->success('Page Updated successfully.');
        return to_route('admin.custom-page.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $custom_page = CustomPage::findOrFail($id);
            $custom_page->delete();

            notyf()->success("Custom Page: {$custom_page->title} deleted successfully.");
            return response()->json(['success' => "Custom Page: {$custom_page->title} deleted successfully."]);
        } catch (Exception $e) {
            logger()->error("Error deleting Custom Page: {$e->getMessage()}");
            notyf()->error($e->getMessage());
            return response()->json(['error' => "Custom Page cannot be deleted."]);
        }
    }
}
