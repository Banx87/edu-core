<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

trait Fileupload
{
    public function uploadFile(UploadedFile $file, string $directory = 'uploads'): string
    {
        $filename = 'educore_' . time() . '_' . uniqid() . '_.' . $file->getClientOriginalExtension();

        // move the file to storage
        $file->move(public_path($directory), $filename);
        return '/' . $directory . '/' . $filename;
    }

    public function deleteFile(string $filePath): bool
    {
        if (File::exists(public_path($filePath))) {
            File::delete(public_path($filePath));
            return true;
        }
        return false;
    }
}