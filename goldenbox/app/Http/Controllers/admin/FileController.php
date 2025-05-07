<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    
public function clearTempFolder()
{
    $folderPath = storage_path('app/private/temp');

    if (!File::exists($folderPath)) {
        return response()->json(['message' => 'Thư mục không tồn tại'], 404);
    }

    $files = File::files($folderPath);
    
    foreach ($files as $file) {
        File::delete($file);
    }

    return response()->json(['message' => 'Đã xóa toàn bộ file trong thư mục temp']);
}
public function uploadImage(Request $request)
{
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        // Lưu file vào storage/app/temp
        $path = $file->storeAs('temp', $filename);
        
        return response()->json(['filename' => $path]);
    }
}    
public function deleteImage(Request $request)
        {
            $filename = $request->input('filename');
            $path = 'temp/' . $filename; // 
            if (Storage::exists($path)) {
                Storage::delete($path);
                return response()->json(['message' => 'Ảnh đã được xóa.']);
            }
            return response()->json(['message' => 'Ảnh không tồn tại.'], 404);
        }
}
