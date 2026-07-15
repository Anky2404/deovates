<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Backs the global crop-and-upload widget (see public/assets/js/image-cropper.js):
 * the browser crops an image client-side, then immediately uploads the result
 * here so it survives as a real file even if the form isn't saved yet. The
 * returned temp path is promoted to permanent storage by whichever controller
 * ultimately saves the form (see MediaUploader::promoteTemp).
 */
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
