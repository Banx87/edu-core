<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use App\Models\FooterColumnOne;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FooterColumnOneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $columnOne = FooterColumnOne::all();
        return view('admin.footer.column-one.index', compact('columnOne'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.footer.column-one.create');
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

        $columnOne = new FooterColumnOne();
        $columnOne->title = $request->title;
        $columnOne->url = $request->url;
        $columnOne->status = $request->status ? 1 : 0;
        $columnOne->save();

        notyf()->success('New footer link created successfully.');

        return to_route('admin.footer-column-one.index');
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
        $column = FooterColumnOne::findOrFail($id);
        return view('admin.footer.column-one.edit', compact('column'));
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

        $columnOne = FooterColumnOne::findOrFail($id);
        $columnOne->title = $request->title;
        $columnOne->url = $request->url;
        $columnOne->status = $request->status ? 1 : 0;
        $columnOne->save();

        notyf()->success('Updated successfully.');

        return to_route('admin.footer-column-one.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $column = FooterColumnOne::findOrFail($id);
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
