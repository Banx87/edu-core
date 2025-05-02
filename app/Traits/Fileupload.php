<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

trait Fileupload
{
    public function uploadFile(UploadedFile $file, string $directory = 'uploads'): string
    {
        try {
            $filename = 'educore_' . time() . '_' . uniqid() . '_.' . $file->getClientOriginalExtension();

            // move the file to storage
            $file->storeAs($directory, $filename, 'public');

            return '/' . $directory . '/' . $filename;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteFile(string $filePath): bool
    {
        $fullPath = public_path($filePath);
        if (File::exists($fullPath)) {
            if (File::delete($fullPath)) {
                return true;
            } elseif (unlink($fullPath)) {
                return true;
            }
        }
        return false;
    }
}
