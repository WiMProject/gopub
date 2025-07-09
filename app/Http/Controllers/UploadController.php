<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            try {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
                
                return redirect()->back()->with('success', 'File uploaded successfully to: uploads/' . $filename);
            } catch (\Exception $e) {
                \Log::error('Upload error: ' . $e->getMessage());
                \Log::error('Upload error trace: ' . $e->getTraceAsString());
                
                return redirect()->back()->with('error', 'File upload failed: ' . $e->getMessage());
            }
        }
        
        return redirect()->back()->with('error', 'No file uploaded');
    }
}