<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait Fileupload
{
    public function uploadFile(UploadedFile $file, string $directory = 'uploads'): string
    {
        $filename = 'educore_' . time() . '_' . uniqid() . '_' . $file->getClientOriginalExtension();

        // move the file to storage
        $file->move(public_path($directory), $filename);
        return '/' . $directory . '/' . $filename;
    }
}
