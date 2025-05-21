<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CertificateBuilderUpdateRequest;
use App\Models\CertificateBuilder;
use App\Traits\Fileupload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CertificateBuilderController extends Controller
{
    use Fileupload;

    function index(): View
    {
        $certificate = CertificateBuilder::first();
        return view('admin.certificate-builder.index', compact('certificate'));
    }

    function update(CertificateBuilderUpdateRequest $request): RedirectResponse
    {
        $data =  [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
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
}
