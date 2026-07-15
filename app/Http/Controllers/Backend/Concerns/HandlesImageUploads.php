<?php

namespace App\Http\Controllers\Backend\Concerns;

use Illuminate\Http\Request;

/**
 * Shared single-image-field resolution for the crop-and-upload widget
 * (public/assets/js/image-cropper.js). Requires the using controller to
 * have a `MediaUploader $mediaUploader` property (all image-handling
 * Backend controllers already inject one).
 */
trait HandlesImageUploads
{
    /**
     * Resolve one image field: prefer a promoted temp upload (the normal
     * crop-widget path), falling back to a direct file (no-JS path).
     * Leaves $data untouched if neither is present, so an existing image
     * survives. If "{field}_alt" is present in $data (validated alt text),
     * it's slugified into the stored filename instead of a random UUID.
     */
    protected function applyImage(Request $request, array &$data, string $field, string $directory, $model = null): void
    {
        $altText = $data[$field . '_alt'] ?? null;
        $oldPath = $model?->{$field};
        $tempPath = $request->input($field . '_temp');

        if (!empty($tempPath)) {
            $promoted = $this->mediaUploader->promoteTemp($tempPath, $directory, $oldPath, $altText);

            if ($promoted) {
                $data[$field] = $promoted;
            }

            return;
        }

        if ($request->hasFile($field)) {
            $data[$field] = $this->mediaUploader->uploadSingle(
                $request->file($field),
                $directory,
                $oldPath,
                [],
                $altText
            );
        }
    }
}
