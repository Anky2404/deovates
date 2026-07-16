<?php

namespace App\Http\Controllers\Backend\Concerns;

use Illuminate\Http\Request;

// requires $mediaUploader on using controller
trait HandlesImageUploads
{
    // prefers temp upload, falls back to direct file
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
