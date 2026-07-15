<?php

namespace App\Services;

use App\Models\Media;
use App\Models\MediaRelation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

/**
 * Single place for image uploads: a flat single-column image (uploadSingle,
 * e.g. Blog::featured_image) or a polymorphic gallery attached to any model
 * via the existing Media/MediaRelation tables (uploadMultiple).
 */
class MediaUploader
{
    protected string $disk = 'public';

    /**
     * Store one image and optionally generate named sizes as sibling files
     * (e.g. "blogs/{uuid}.jpg" + "blogs/{uuid}_thumb.jpg"). Returns the
     * original's relative path for storing in a flat model column.
     *
     * @param  array<string, array{0:int,1:int}>  $sizes  e.g. ['thumb' => [300, 300]]
     * @param  ?string  $desiredName  Admin-supplied name (typically the alt
     *                                text) to slugify into the filename;
     *                                falls back to a UUID when empty.
     */
    public function uploadSingle(UploadedFile $file, string $directory, ?string $oldPath = null, array $sizes = [], ?string $desiredName = null): string
    {
        $directory = trim($directory, '/');
        $extension = $file->getClientOriginalExtension() ?: 'jpg';
        $filename = $this->resolveFilename($desiredName, $extension, $directory);
        $path = $file->storeAs($directory, $filename, $this->disk);

        $this->generateSizes($path, $sizes);

        if ($oldPath) {
            $this->deleteSingle($oldPath);
        }

        return $path;
    }

    /**
     * Store an upload (typically a cropped blob from the browser) under a
     * short-lived "temp/" location, ahead of the final form save. Returns
     * the relative path (to promote later) and a browser-usable URL (for
     * the crop preview).
     */
    public function storeTemp(UploadedFile $file): array
    {
        $extension = $file->getClientOriginalExtension() ?: 'jpg';
        $filename = Str::uuid() . '.' . $extension;
        $path = $file->storeAs('temp', $filename, $this->disk);

        return [
            'path' => $path,
            'url' => Storage::disk($this->disk)->url($path),
        ];
    }

    /**
     * Move a previously stored temp upload into its final directory,
     * deleting the superseded file (if any). Returns null (leaving the
     * caller to keep whatever it already had) if the temp path is empty
     * or the file has since been cleaned up.
     */
    public function promoteTemp(?string $tempPath, string $directory, ?string $oldPath = null, ?string $desiredName = null): ?string
    {
        if (empty($tempPath) || ! Storage::disk($this->disk)->exists($tempPath)) {
            return null;
        }

        $directory = trim($directory, '/');
        $extension = pathinfo($tempPath, PATHINFO_EXTENSION) ?: 'jpg';
        $filename = $this->resolveFilename($desiredName, $extension, $directory);
        $path = $directory . '/' . $filename;

        Storage::disk($this->disk)->copy($tempPath, $path);
        Storage::disk($this->disk)->delete($tempPath);

        if ($oldPath) {
            $this->deleteSingle($oldPath);
        }

        return $path;
    }

    /**
     * When the admin supplied a name (typically the image's alt text),
     * slugify it into the stored filename instead of a random UUID —
     * falling back to a UUID when no name was given, or when the slugified
     * name collides with an existing file after a few short-suffix retries.
     */
    protected function resolveFilename(?string $desiredName, string $extension, string $directory): string
    {
        $slug = trim((string) $desiredName) !== '' ? Str::slug($desiredName) : '';

        if ($slug === '') {
            return Str::uuid() . '.' . $extension;
        }

        $candidate = "{$slug}.{$extension}";

        for ($attempt = 0; $attempt < 5; $attempt++) {
            if (! Storage::disk($this->disk)->exists(trim($directory . '/' . $candidate, '/'))) {
                return $candidate;
            }

            $candidate = "{$slug}-" . Str::random(5) . ".{$extension}";
        }

        return Str::uuid() . '.' . $extension;
    }

    /**
     * Delete a flat single-column image and any of its generated size
     * siblings (files matching "{name}_{size}.{ext}" next to it).
     */
    public function deleteSingle(?string $path): void
    {
        if (empty($path) || ! Storage::disk($this->disk)->exists($path)) {
            return;
        }

        Storage::disk($this->disk)->delete($path);

        $directory = pathinfo($path, PATHINFO_DIRNAME);
        $basename = pathinfo($path, PATHINFO_FILENAME);

        foreach (Storage::disk($this->disk)->files($directory === '.' ? '' : $directory) as $file) {
            if (Str::startsWith(pathinfo($file, PATHINFO_FILENAME), $basename . '_')) {
                Storage::disk($this->disk)->delete($file);
            }
        }
    }

    /**
     * Upload one or more images into the polymorphic gallery (Media +
     * MediaRelation), attached to any model. Returns the created Media rows.
     *
     * @param  UploadedFile[]  $files
     * @param  array<string, array{0:int,1:int}>  $sizes
     * @return Collection<int, Media>
     */
    public function uploadMultiple(array $files, Model $model, string $collection, string $directory, array $sizes = []): Collection
    {
        $directory = trim($directory, '/');
        $userId = Auth::guard('admin')->id() ?? Auth::guard('web')->id();

        $nextOrder = MediaRelation::where('model_type', get_class($model))
            ->where('model_id', $model->getKey())
            ->where('collection', $collection)
            ->max('display_order');

        $hasPrimary = MediaRelation::where('model_type', get_class($model))
            ->where('model_id', $model->getKey())
            ->where('collection', $collection)
            ->where('is_primary', true)
            ->exists();

        $created = collect();

        foreach ($files as $file) {
            if (! $file instanceof UploadedFile) {
                continue;
            }

            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = Str::uuid() . '.' . $extension;
            $path = $file->storeAs($directory, $filename, $this->disk);

            $conversions = $this->generateSizes($path, $sizes);
            [$width, $height] = $this->dimensions($path);

            $media = Media::create([
                'model_type' => get_class($model),
                'model_id' => $model->getKey(),
                'collection' => $collection,
                'name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'file_name' => $filename,
                'mime_type' => $file->getMimeType(),
                'disk' => $this->disk,
                'path' => $path,
                'size' => $file->getSize(),
                'width' => $width,
                'height' => $height,
                'is_active' => true,
                'display_order' => ++$nextOrder,
                'conversions' => $conversions,
                'uploaded_by' => $userId,
            ]);

            MediaRelation::create([
                'media_id' => $media->id,
                'model_type' => get_class($model),
                'model_id' => $model->getKey(),
                'collection' => $collection,
                'is_primary' => ! $hasPrimary,
                'is_active' => true,
                'display_order' => $nextOrder,
                'linked_by' => $userId,
            ]);

            $hasPrimary = true;
            $created->push($media);
        }

        return $created;
    }

    public function deleteMedia(Media $media): void
    {
        $this->deleteSingle($media->path);

        $media->relations()->delete();
        $media->delete();
    }

    /**
     * Resolve the URL for a stored path, optionally requesting a named
     * size. Falls back to the original if the size wasn't generated (or
     * doesn't exist), then to a placeholder if nothing exists at all.
     */
    public function url(?string $path, ?string $size = null, string $fallback = 'assets/front/img/default-img.png'): string
    {
        if (empty($path)) {
            return asset($fallback);
        }

        if ($size) {
            $sizedPath = $this->sizedPath($path, $size);

            if (Storage::disk($this->disk)->exists($sizedPath)) {
                return asset('storage/' . $sizedPath);
            }
        }

        if (Storage::disk($this->disk)->exists($path)) {
            return asset('storage/' . $path);
        }

        return asset($fallback);
    }

    /**
     * @param  array<string, array{0:int,1:int}>  $sizes
     * @return array<string, string>  size key => relative path
     */
    protected function generateSizes(string $originalPath, array $sizes): array
    {
        if (empty($sizes)) {
            return [];
        }

        $conversions = [];

        try {
            $fullPath = Storage::disk($this->disk)->path($originalPath);
            $image = Image::read($fullPath);

            foreach ($sizes as $key => [$width, $height]) {
                $sizedPath = $this->sizedPath($originalPath, $key);
                $sizedFullPath = Storage::disk($this->disk)->path($sizedPath);

                (clone $image)->cover($width, $height)->save($sizedFullPath);

                $conversions[$key] = $sizedPath;
            }
        } catch (\Throwable) {
            // Not a readable image (or GD failure) — original stays, sizes just skipped.
            return $conversions;
        }

        return $conversions;
    }

    protected function sizedPath(string $path, string $size): string
    {
        $directory = pathinfo($path, PATHINFO_DIRNAME);
        $basename = pathinfo($path, PATHINFO_FILENAME);
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $prefix = $directory === '.' ? '' : $directory . '/';

        return "{$prefix}{$basename}_{$size}.{$extension}";
    }

    /**
     * @return array{0: ?int, 1: ?int}
     */
    protected function dimensions(string $path): array
    {
        try {
            $image = Image::read(Storage::disk($this->disk)->path($path));

            return [$image->width(), $image->height()];
        } catch (\Throwable) {
            return [null, null];
        }
    }
}
