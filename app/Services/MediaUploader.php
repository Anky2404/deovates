<?php

namespace App\Services;

use App\Models\Media;
use App\Models\MediaRelation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
     * Store one image and optionally generate named sizes as sibling files.
     * When $uuid is given, the file lands at "{directory}/{uuid}/{filename}"
     * (e.g. "blogs/3f2a.../featured.jpg") — the app-wide convention so every
     * record's uploads live in their own folder. Returns the relative path
     * for storing in a flat model column.
     *
     * @param  array<string, array{0:int,1:int}>  $sizes  e.g. ['thumb' => [300, 300]]
     * @param  ?string  $desiredName  Admin-supplied name (typically the alt
     *                                text) to slugify into the filename;
     *                                falls back to a UUID when empty.
     */
    public function uploadSingle(UploadedFile $file, string $directory, ?string $oldPath = null, array $sizes = [], ?string $desiredName = null, ?string $uuid = null): string
    {
        $directory = $this->resolveDirectory($directory, $uuid);
        $this->ensureDirectoryExists($directory);
        $extension = $file->getClientOriginalExtension() ?: 'jpg';
        $filename = $this->resolveFilename($desiredName, $extension, $directory);
        $path = $file->storeAs($directory, $filename, $this->disk);
        $this->mirrorToPublic($path);

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
        $this->ensureDirectoryExists('temp');
        $extension = $file->getClientOriginalExtension() ?: 'jpg';
        $filename = Str::uuid() . '.' . $extension;
        $path = $file->storeAs('temp', $filename, $this->disk);
        $this->mirrorToPublic($path);

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
    public function promoteTemp(?string $tempPath, string $directory, ?string $oldPath = null, ?string $desiredName = null, ?string $uuid = null): ?string
    {
        if (empty($tempPath) || ! Storage::disk($this->disk)->exists($tempPath)) {
            return null;
        }

        $directory = $this->resolveDirectory($directory, $uuid);
        $this->ensureDirectoryExists($directory);
        $extension = pathinfo($tempPath, PATHINFO_EXTENSION) ?: 'jpg';
        $filename = $this->resolveFilename($desiredName, $extension, $directory);
        $path = $directory . '/' . $filename;

        Storage::disk($this->disk)->copy($tempPath, $path);
        Storage::disk($this->disk)->delete($tempPath);
        $this->mirrorToPublic($path);
        $this->removeMirroredPublic($tempPath);

        if ($oldPath) {
            $this->deleteSingle($oldPath);
        }

        return $path;
    }

    /**
     * Promote a temp upload (from the crop-and-upload widget) straight into
     * a permanent Media row attached to $model — the gallery-table
     * counterpart of promoteTemp(), used by controllers whose gallery is
     * backed by the polymorphic Media table instead of a flat JSON column.
     * $model must already be persisted (has a primary key).
     */
    public function promoteTempToMedia(string $tempPath, Model $model, string $collection, string $directory, ?string $alt = null, ?string $title = null): ?Media
    {
        if (empty($tempPath) || ! Storage::disk($this->disk)->exists($tempPath)) {
            return null;
        }

        $directory = $this->resolveDirectory($directory, $model->uuid ?? null);
        $this->ensureDirectoryExists($directory);
        $extension = pathinfo($tempPath, PATHINFO_EXTENSION) ?: 'jpg';
        $filename = $this->resolveFilename($title ?: $alt, $extension, $directory);
        $path = $directory . '/' . $filename;

        Storage::disk($this->disk)->copy($tempPath, $path);
        Storage::disk($this->disk)->delete($tempPath);
        $this->mirrorToPublic($path);
        $this->removeMirroredPublic($tempPath);

        [$width, $height] = $this->dimensions($path);
        $userId = Auth::guard('admin')->id() ?? Auth::guard('web')->id();

        $nextOrder = Media::where('model_type', get_class($model))
            ->where('model_id', $model->getKey())
            ->where('collection', $collection)
            ->max('display_order');

        return Media::create([
            'model_type' => get_class($model),
            'model_id' => $model->getKey(),
            'collection' => $collection,
            'name' => $title ?: pathinfo($filename, PATHINFO_FILENAME),
            'file_name' => $filename,
            'mime_type' => Storage::disk($this->disk)->mimeType($path),
            'disk' => $this->disk,
            'path' => $path,
            'size' => Storage::disk($this->disk)->size($path),
            'width' => $width,
            'height' => $height,
            'alt_text' => $alt,
            'caption' => $title,
            'is_active' => true,
            'display_order' => ($nextOrder ?? 0) + 1,
            'uploaded_by' => $userId,
        ]);
    }

    /**
     * App-wide storage convention: "{directory}/{uuid}/..." when a uuid is
     * available (e.g. "blogs/3f2a-.../featured.jpg"), otherwise just
     * "{directory}/..." — used for directories with no owning record (e.g.
     * "temp", "media-library").
     */
    protected function resolveDirectory(string $directory, ?string $uuid): string
    {
        $directory = trim($directory, '/');

        return empty($uuid) ? $directory : $directory . '/' . $uuid;
    }

    /**
     * Create the target folder (and any missing parent folders, e.g. a
     * brand-new uuid subfolder) before writing to it, with public
     * read/traverse permissions — the local Flysystem adapter normally does
     * this on its own, but shared hosts can leave a freshly created folder
     * without execute permission, which then blocks anything from being
     * read back out of it. Safe to call on a folder that already exists.
     */
    protected function ensureDirectoryExists(string $directory): void
    {
        $directory = trim($directory, '/');

        if ($directory === '' || Storage::disk($this->disk)->directoryExists($directory)) {
            return;
        }

        Storage::disk($this->disk)->makeDirectory($directory);

        $fullPath = Storage::disk($this->disk)->path($directory);

        if (is_dir($fullPath)) {
            @chmod($fullPath, 0755);
        }
    }

    /**
     * Some hosts (certain Hostinger plans among them) don't allow creating
     * the "public/storage" symlink at all, which otherwise silently breaks
     * every uploaded image (the file exists on disk but nothing serves it).
     * As a fallback, physically copy every stored file into public/storage
     * too, so uploads work even without a working symlink.
     *
     * Skipped entirely when "public/storage" IS a working symlink (the
     * normal case) — copying a file there would just copy it onto itself
     * through the link, which risks corrupting it for no benefit.
     */
    protected function mirrorToPublic(string $relativePath): void
    {
        if (empty($relativePath) || is_link(public_path('storage'))) {
            return;
        }

        $source = Storage::disk($this->disk)->path($relativePath);

        if (! File::exists($source)) {
            return;
        }

        $destination = public_path('storage/' . $relativePath);
        File::ensureDirectoryExists(dirname($destination));
        File::copy($source, $destination);
    }

    /**
     * Counterpart to mirrorToPublic() — removes the mirrored copy (if any)
     * so deleted/replaced files don't linger as orphaned duplicates under
     * public/storage. No-ops when a real symlink is in play, same as above.
     */
    protected function removeMirroredPublic(string $relativePath): void
    {
        if (empty($relativePath) || is_link(public_path('storage'))) {
            return;
        }

        $destination = public_path('storage/' . $relativePath);

        if (File::exists($destination)) {
            File::delete($destination);
        }
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
        $this->removeMirroredPublic($path);

        $directory = pathinfo($path, PATHINFO_DIRNAME);
        $basename = pathinfo($path, PATHINFO_FILENAME);

        foreach (Storage::disk($this->disk)->files($directory === '.' ? '' : $directory) as $file) {
            if (Str::startsWith(pathinfo($file, PATHINFO_FILENAME), $basename . '_')) {
                Storage::disk($this->disk)->delete($file);
                $this->removeMirroredPublic($file);
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
        $directory = $this->resolveDirectory($directory, $model->uuid ?? null);
        $this->ensureDirectoryExists($directory);
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
            $this->mirrorToPublic($path);

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
    public function url(?string $path, ?string $size = null, string $fallback = 'assets/front/img/default-img.avif'): string
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
                $this->mirrorToPublic($sizedPath);

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
