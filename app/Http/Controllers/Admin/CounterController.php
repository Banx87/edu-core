<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $counters = Counter::first();
        return view('admin.sections.counter-section.index', compact('counters'));
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
            'title_one' => 'nullable|string',
            'title_two' => 'nullable|string',
            'title_three' => 'nullable|string',
            'title_four' => 'nullable|string',
            'counter_one' => 'nullable|numeric',
            'counter_two' => 'nullable|numeric',
            'counter_three' => 'nullable|numeric',
            'counter_four' => 'nullable|numeric',
        ]);

        Counter::updateOrCreate(['id' => 1], $validatedData);

        notyf()->success('Counter updated successfully.');
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