<?php

namespace App\Http\Controllers\Backend\Concerns;

use Illuminate\Http\Request;

// requires $mediaUploader on using controller
trait HandlesImageUploads
{
    // prefers temp upload, falls back to direct file
    // $uuid: the owning record's uuid (existing or pre-generated for a new
    // record) so the file lands at "{directory}/{uuid}/{filename}".
    protected function applyImage(Request $request, array &$data, string $field, string $directory, $model = null, ?string $uuid = null): void
    {
        $altText = $data[$field . '_alt'] ?? null;
        $oldPath = $model?->{$field};
        $tempPath = $request->input($field . '_temp');
        $uuid ??= $model?->uuid;

        if (!empty($tempPath)) {
            $promoted = $this->mediaUploader->promoteTemp($tempPath, $directory, $oldPath, $altText, $uuid);

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
                $altText,
                $uuid
            );
        }
    }
}
