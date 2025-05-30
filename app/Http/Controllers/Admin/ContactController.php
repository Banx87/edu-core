<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Traits\Fileupload;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use Fileupload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $contactCards = Contact::all();
        return view('admin.contact.index', compact('contactCards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|image|max:3000',
            'title' => 'required|string|max:255',
            'line_one' => 'required|string|max:255',
            'line_two' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $icon = $this->uploadFile($request->file('icon'));

        $contact = new Contact();
        $contact->icon = $icon;
        $contact->title = $request->title;
        $contact->line_one = $request->line_one;
        $contact->line_two = $request->line_two;
        $contact->status = $request->status;
        $contact->save();

        notyf()->success('Contact created successfully.');

        return redirect()->route('admin.contact.index');
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
    public function edit(Contact $contact): View
    {
        return view('admin.contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => 'nullable|image|max:3000',
            'title' => 'required|string|max:255',
            'line_one' => 'nullable|string|max:255',
            'line_two' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        $contact = Contact::findOrFail($id);

        if ($request->hasFile('icon')) {
            if (!empty($request->old_icon) && file_exists(public_path($request->old_icon))) {
                $this->deleteFile($request->old_icon);
            }
            $iconPath = $this->uploadFile($request->file('icon'));
            $contact->icon = $iconPath;
        }

        $contact->title = $request->title;
        $contact->line_one = $request->line_one;
        $contact->line_two = $request->line_two;
        $contact->status = $request->status;

        $contact->save();

        notyf()->success('Contact card Updated Successfully.');
        return redirect()->route('admin.contact.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        try {
            $contact->delete();
            if (file_exists(public_path($contact->icon))) {
                $this->deleteFile($contact->icon);
            }
            redirect()->route('admin.contact.index')->with('success', 'Contact deleted successfully.');
            return response()->json(['success' => 'Contact deleted successfully.']);
        } catch (Exception $e) {
            logger()->error('Error deleting Contact: ' . $e->getMessage());
            redirect()->route('admin.contact.index')->with('error', 'Contact cannot be deleted.');

            return response()->json(['error' => 'Contact cannot be deleted.']);
        }
    }
}