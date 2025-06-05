<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterColumnTwo;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FooterColumnTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $columnTwo = FooterColumnTwo::all();
        return view('admin.footer.column-two.index', compact('columnTwo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.footer.column-two.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'status' => 'boolean',
        ]);

        $columnTwo = new FooterColumnTwo();
        $columnTwo->title = $request->title;
        $columnTwo->url = $request->url;
        $columnTwo->status = $request->status ? 1 : 0;
        $columnTwo->save();

        notyf()->success('New footer link created successfully.');

        return to_route('admin.footer-column-two.index');
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
        $column = FooterColumnTwo::findOrFail($id);
        return view('admin.footer.column-two.edit', compact('column'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'status' => 'boolean',
        ]);

        $columnOne = FooterColumnTwo::findOrFail($id);
        $columnOne->title = $request->title;
        $columnOne->url = $request->url;
        $columnOne->status = $request->status ? 1 : 0;
        $columnOne->save();

        notyf()->success('Updated successfully.');

        return to_route('admin.footer-column-two.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $column = FooterColumnTwo::findOrFail($id);
        try {
            $column->delete();

            notyf()->success('Footer Link deleted successfully.');
            return response()->json(['success' => 'Footer Link deleted successfully.']);
        } catch (Exception $e) {
            logger()->error('Error deleting Footer Link: ' . $e->getMessage());
            notyf()->error($e->getMessage());
            return response()->json(['error' => 'Footer Link cannot be deleted.']);
        }
    }
}
