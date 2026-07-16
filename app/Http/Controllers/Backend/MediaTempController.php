<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

// Temp upload, promoted on form save
class MediaTempController extends Controller
{
    public function __construct(private MediaUploader $mediaUploader)
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:8192',
        ]);

        try {
            $result = $this->mediaUploader->storeTemp($request->file('image'));

            return response()->json([
                'success' => true,
                'temp_path' => $result['path'],
                'url' => $result['url'],
            ]);
        } catch (\Throwable $e) {
            Log::error('Temp image upload failed: ' . $e->getMessage(), ['exception' => $e]);

            return response()->json([
                'success' => false,
                'message' => 'Image upload failed. Please try again.',
            ], 500);
        }
    }
}
