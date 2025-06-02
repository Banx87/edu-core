<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TopBar;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TopBarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $topBar = TopBar::first();
        return view('admin.top-bar.index', compact('topBar'));
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
        $validatedData = $request->validate([
            'email' => 'nullable|email:max:255',
            'phone' => 'nullable',
            'offer_name' => 'string|nullable|max:255',
            'offer_short_description' => 'string|nullable|max:255',
            'offer_button_text' => 'string|nullable|max:255',
            'offer_url' => 'url|nullable',
            'offer_code' => 'string|nullable|max:255',
        ]);

        TopBar::updateOrCreate(['id' => 1], $validatedData);

        notyf()->success('Top Bar updated successfully.');
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
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
