<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CertificateBuilderUpdateRequest;
use App\Models\CertificateBuilder;
use App\Models\CertificateBuilderItem;
use App\Traits\Fileupload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CertificateBuilderController extends Controller
{
    use Fileupload;

    function index(): View
    {
        $certificate = CertificateBuilder::first();
        $certificateItems = CertificateBuilderItem::all();
        return view('admin.certificate-builder.index', compact('certificate', 'certificateItems'));
    }

    function update(CertificateBuilderUpdateRequest $request): RedirectResponse
    {

        // dd($request->all());
        $data =  [
            'title' => $request->title,
            'sub_title' => $request->subtitle,
            'description' => $request->description,
        ];

        if ($request->hasFile('signature')) {
            $signature = $this->uploadFile($request->file('signature'));
            $data['signature'] = $signature;
        }

        if ($request->hasFile('background')) {
            $background = $this->uploadFile($request->file('background'));
            $data['background'] = $background;
        }

        CertificateBuilder::updateOrCreate(
            ['id' => 1],
            $data
        );

        notyf()
            ->position('right', 'top')
            ->background('#4CAF50')
            ->success('Certificate updated successfully.');

        return redirect()->back();
    }

    function itemPositionUpdate(Request $request): Response
    {
        $request->validate([
            'element_id' => 'required|in:cert_title,cert_subtitle,cert_description,cert_signature',
            'x_position' => 'required',
            'y_position' => 'required',
        ]);

        CertificateBuilderItem::updateOrCreate(
            ['element_id' => $request->element_id],
            ['x_position' => $request->x_position, 'y_position' => $request->y_position]
        );

        return response(['success' => true]);
    }
}
