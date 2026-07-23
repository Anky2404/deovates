<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Media;
use App\Services\MediaUploader;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MediaLibraryController extends Controller
{
    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'media.library.';

    public function __construct(private MediaUploader $mediaUploader)
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Media::latest('id')->paginate($this->pagerecords)->withQueryString();

        return view($this->prefix.$this->folder.'index', compact('rows'));
    }

    public function createoredit(Request $request, ?string $uuid = null)
    {
        $media = null;

        if ($uuid) {
            try {
                $media = Media::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('Media createoredit lookup failed: '.$e->getMessage(), ['exception' => $e]);

                return redirect()->route('admin.media.library.index')->with('error', 'Unable to load the requested media item.');
            }
        }

        return view($this->prefix.$this->folder.'createoredit', compact('media'));
    }

    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $media = $uuid ? Media::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'file' => [$media ? 'nullable' : 'required', 'file', 'max:10240'],
            'name' => ['nullable', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'caption' => ['nullable', 'string'],
            'collection' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        unset($data['file']);

        $data['collection'] = $data['collection'] ?? 'library';
        $data['is_active'] = $request->boolean('is_active');

        try {
            DB::beginTransaction();

            $newUuid = null;

            if (! $media) {
                $newUuid = (string) Str::uuid();
                $data['uuid'] = $newUuid;
            }

            $uuidForUpload = $media?->uuid ?? $newUuid;

            if ($request->hasFile('file')) {
                $file = $request->file('file');

                $data['path'] = $this->mediaUploader->uploadSingle($file, 'media-library', $media->path ?? null, [], null, $uuidForUpload);
                $data['file_name'] = $file->getClientOriginalName();
                $data['mime_type'] = $file->getMimeType();
                $data['size'] = $file->getSize();
                $data['disk'] = 'public';
                $data['name'] = $data['name'] ?: pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            }

            if ($media) {
                $media->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated media '.$media->name;
            } else {
                // Not attached to a model yet
                $data['model_type'] = null;
                $data['model_id'] = null;
                $data['uploaded_by'] = auth('admin')->id();

                $media = Media::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created media '.$media->name;
            }

            ActivityLog::log($action, config('constants.MODULES.media'), [
                'subject_type' => Media::class,
                'subject_id' => $media->id,
                'new_values' => $media->getChanges(),
                'description' => $description,
            ]);

            DB::commit();

            return redirect()->route('admin.media.library.index')->with('success', 'Media saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Media saveorupdate failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, string $uuid)
    {
        try {
            $media = Media::where('uuid', $uuid)->firstOrFail();
            $media->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.media'), [
                'subject_type' => Media::class,
                'subject_id' => $media->id,
                'description' => 'Deleted media '.$media->name,
            ]);

            return back()->with('success', 'Media deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Media destroy failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, string $uuid)
    {
        try {
            $media = Media::where('uuid', $uuid)->firstOrFail();
            $media->is_active = ! $media->is_active;
            $media->save();

            ActivityLog::log(
                $media->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.media'),
                [
                    'subject_type' => Media::class,
                    'subject_id' => $media->id,
                    'description' => ($media->is_active ? 'Activated' : 'Deactivated').' media '.$media->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $media->is_active]);
            }

            return back()->with('success', 'Media status updated.');
        } catch (\Throwable $e) {
            Log::error('Media togglestatus failed: '.$e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglefeatured(Request $request, string $uuid)
    {
        try {
            $media = Media::where('uuid', $uuid)->firstOrFail();
            $media->is_featured = ! $media->is_featured;
            $media->save();

            ActivityLog::log(
                $media->is_featured ? config('constants.ACTIVITY_ACTIONS.feature') : config('constants.ACTIVITY_ACTIONS.unfeature'),
                config('constants.MODULES.media'),
                [
                    'subject_type' => Media::class,
                    'subject_id' => $media->id,
                    'description' => ($media->is_featured ? 'Marked featured' : 'Unmarked featured').' media '.$media->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $media->is_featured]);
            }

            return back()->with('success', 'Media featured status updated.');
        } catch (\Throwable $e) {
            Log::error('Media togglefeatured failed: '.$e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
