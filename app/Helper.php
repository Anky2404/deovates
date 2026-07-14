<?php

namespace App;

use App\Models\ActivityLog;
use App\Models\Page;
use App\Models\Role;
use App\Models\Section;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class Helper
{

    /**
     * Check if current route is active
     */
    public static function isActive($routes, $class = 'active')
    {
        $routes = (array) $routes;

        foreach ($routes as $route) {
            if (Route::currentRouteNamed($route)) {
                return $class;
            }
        }

        return '';
    }

    /**
     * Check if any child route is active (parent menu)
     */
    public static function isParentActive($routes, $classes = 'active open')
    {
        $routes = (array) $routes;

        foreach ($routes as $route) {
            if (Route::currentRouteNamed($route)) {
                return $classes;
            }
        }

        return '';
    }


    /**
     * Get all roles except Admin & Super Admin
     */
    public static function getUserRole()
    {
        return Role::whereNotIn('slug', ['admin', 'super-admin'])
            ->where('is_active', 1)
            ->orderBy('name')
            ->get();
    }

    public static function getAllSection()
    {
        return Section::where('is_active', 1)
            ->orderBy('id')
            ->get()
            ->keyBy('slug');
    }

    public static function getAllPages()
    {
        return Page::where('is_active', 1)
            ->orderBy('id')
            ->get();
    }

    // Read JSON file
    public static function readJSONData(string $filename): array
    {
        $path = storage_path('app/data/' . ltrim($filename, '/'));

        if (!file_exists($path)) {
            abort(500, 'JSON file not found at: ' . $path);
        }

        $json = file_get_contents($path);
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            abort(500, 'Invalid JSON format in: ' . $filename);
        }

        return $data;
    }

    /**
     * Look up a section's title/subtitle from the shared
     * storage/app/data/section_titles.json file, so every front page pulls
     * its section headings from one common, editable source instead of
     * hardcoding them in the blade views.
     */
    public static function sectionTitle(string $page, string $section, string $field = 'title', string $default = ''): string
    {
        static $sections = null;

        if ($sections === null) {
            $sections = self::readJSONData('section_titles.json');
        }

        return $sections[$page][$section][$field] ?? $default;
    }

    /**
     * Resolve a per-page hero banner from public/assets/front/img/banners/.
     * Lets pages reference a not-yet-provided photo (e.g. a real {{ config('constants.BRAND_NAME') }}
     * office shot the client is generating separately) and fall back to
     * an existing placeholder until that file actually shows up.
     */
    public static function heroBanner(string $filename, string $fallback = 'assets/front/img/hero/h2_hero.png'): string
    {
        $path = public_path('assets/front/img/banners/' . ltrim($filename, '/'));

        return file_exists($path)
            ? asset('assets/front/img/banners/' . ltrim($filename, '/'))
            : asset($fallback);
    }

    /**
     * Resolve a storage-relative image path to a public URL, falling back
     * to a default image when the field is empty or the file was never
     * actually uploaded (several seeded tables reference paths that don't
     * exist on disk).
     */
    public static function img(?string $path, string $fallback = 'assets/front/img/default-img.png'): string
    {
        if (!empty($path) && Storage::disk('public')->exists($path)) {
            return asset('storage/' . $path);
        }

        return asset($fallback);
    }

    public static function canView($role): bool
    {

        if (!auth('admin')->user()) {
            return false;
        }

        return auth('admin')->user()->role->name === $role;
    }





    public static function uploadImage($file, $directory, $model = null, $column = 'filename', $isDeleteOld = true)
    {
        try {

            if (!$file instanceof UploadedFile) {
                return null;
            }

            $uuid = $model?->uuid;
            $basePath = "{$directory}/{$uuid}";

            // Delete old file if enabled and exists
            if ($isDeleteOld && $model && !empty($model->{$column})) {
                if (Storage::disk('public')->exists($model->{$column})) {
                    Storage::disk('public')->delete($model->{$column});
                }
            }

            // Generate new filename
            $originalExt = $file->getClientOriginalExtension();
            $username    = Str::slug($model?->username ?? 'user');
            $filename    = $username . '.' . $originalExt;

            // Store new file
            $storedPath = $file->storeAs($basePath, $filename, 'public');

            // Update DB column
            if ($model) {
                $model->update([$column => $filename]);
            }

            return $storedPath;
        } catch (\Exception $e) {
            dd("UPLOAD ERROR: " . $e->getMessage());
            return null;
        }
    }








    /**
     * Upload Multiple Images
     *
     * @param array|object $files
     * @param string       $directory
     * @return array
     */
    public static function uploadImages($files, $directory)
    {
        $uploadedFiles = [];

        try {

            if (!$files) return [];

            $path = public_path($directory);

            // Create directory if not exists
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            foreach ($files as $file) {

                // If base64 image
                if (is_string($file) && preg_match('/^data:image/', $file)) {

                    [$meta, $encoded] = explode(',', $file);
                    $image = base64_decode($encoded);

                    $filename = Str::uuid() . ".png";
                    file_put_contents($path . '/' . $filename, $image);
                } else {

                    // Normal uploaded file
                    $ext       = $file->getClientOriginalExtension();
                    $origName  = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                    $filename  = Str::uuid() . '-' . $origName . '.' . $ext;

                    $file->move($path, $filename);
                }

                $uploadedFiles[] = $filename;
            }

            return $uploadedFiles;
        } catch (\Exception $e) {
            return [];
        }
    }


    public static function saveactivity(array $data = []): void
    {


        try {
            ActivityLog::create([
                'uuid' => Str::uuid()->toString(),
                'user_id' => $data['user_id'],
                'user_role' => $data['user_role'],
                'action' => $data['action'] ?? 'UNKNOWN',
                'module' => $data['module'] ?? null,
                'subject_type' => $data['subject_type'] ?? null,
                'subject_id' => $data['subject_id'] ?? null,
                'old_values' => $data['old_values'] ?? null,
                'new_values' => $data['new_values'] ?? null,
                'description' => $data['description'] ?? null,
                'ip_address' => $data['ip_address']
                    ?? request()->ip(),
                'user_agent' => $data['user_agent']
                    ?? request()->userAgent(),
                'url' => $data['url']
                    ?? request()->fullUrl(),
                'method' => $data['method']
                    ?? request()->method(),
                'level' => strtoupper(
                    $data['level'] ?? 'INFO'
                ),
                'meta' => $data['meta'] ?? null,
                'is_system' => $data['is_system'] ?? false,
            ]);
        } catch (\Throwable $e) {

            Log::error('Activity Log Error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);
        }
    }
}
