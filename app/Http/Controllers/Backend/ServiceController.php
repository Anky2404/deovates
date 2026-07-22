<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Media;
use App\Models\Platform;
use App\Models\Service;
use App\Models\Technology;
use App\Services\MediaUploader;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    use HandlesImageUploads;

    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'services.';

    public function __construct(private MediaUploader $mediaUploader)
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Service::orderBy('display_order')->orderBy('id')->paginate($this->pagerecords)->withQueryString();
        $reorderRows = Service::orderBy('display_order')->orderBy('id')->get();

        return view($this->prefix . $this->folder . 'index', compact('rows', 'reorderRows'));
    }

    // Persist drag-drop reorder
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->input('order') as $position => $uuid) {
                    Service::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.service'), [
                'description' => 'Reordered services',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Service reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function createoredit(Request $request, $uuid = null)
    {
        $service = null;

        if ($uuid) {
            try {
                $service = Service::with(['faqs', 'features', 'platforms', 'challenges', 'technologies'])
                    ->where('uuid', $uuid)
                    ->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('Service createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.services.index')->with('error', 'Unable to load the requested service.');
            }
        }

        $platforms = Platform::orderBy('name')->get();
        $technologies = Technology::orderBy('name')->get();

        return view($this->prefix . $this->folder . 'createoredit', compact('service', 'platforms', 'technologies'));
    }

    public function saveorupdate(Request $request, $uuid = null)
    {
        $service = $uuid ? Service::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('services', 'slug')->ignore($service?->id)],
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            // No-JS fallback only, temp field is normal path
            'featured_image' => 'nullable|mimes:' . config('constants.IMAGE_MIMES') . '|max:4096',
            'featured_image_alt' => 'nullable|string|max:255',
            'banner_image' => 'nullable|mimes:' . config('constants.IMAGE_MIMES') . '|max:4096',
            'banner_image_alt' => 'nullable|string|max:255',
            'gallery_items' => 'nullable|array',
            'gallery_items.*.id' => 'nullable|string',
            'gallery_items.*.temp' => 'nullable|string',
            'gallery_items.*.alt' => 'nullable|string|max:255',
            'gallery_items.*.title' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'platforms' => 'nullable|array',
            'technologies' => 'nullable|array',
            'faqs' => 'nullable|array',
            'features' => 'nullable|array',
            'problems' => 'nullable|array',
        ]);

        // Form covers only a subset of fillable columns
        unset($data['platforms'], $data['technologies'], $data['faqs'], $data['features'], $data['problems'], $data['gallery_items']);

        // New services join list end
        $newUuid = null;

        if (!$service) {
            $data['display_order'] = (Service::max('display_order') ?? 0) + 1;
            $newUuid = (string) Str::uuid();
            $data['uuid'] = $newUuid;
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        // Decode safely, bad JSON must not crash save
        $decodedKeywords = json_decode($data['meta_keywords'] ?? '', true);
        $data['meta_keywords'] = is_array($decodedKeywords) ? $decodedKeywords : [];

        try {
            DB::beginTransaction();

            $this->applyImage($request, $data, 'featured_image', 'services', $service, $newUuid);
            $this->applyImage($request, $data, 'banner_image', 'services', $service, $newUuid);

            if ($service) {
                $service->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated service ' . $service->title;
            } else {
                $service = Service::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created service ' . $service->title;
            }

            $this->syncGalleryMedia($request, $service);
            $this->syncPlatforms($service, $request->input('platforms', []));
            $this->syncTechnologies($service, $request->input('technologies', []));
            $this->syncFaqs($service, $request->input('faqs', []));
            $this->syncFeatures($service, $request->input('features', []));
            $this->syncProblems($service, $request->input('problems', []));

            ActivityLog::log($action, config('constants.MODULES.service'), [
                'subject_type' => Service::class,
                'subject_id' => $service->id,
                'new_values' => $service->getChanges(),
                'description' => $description,
            ]);

            DB::commit();

            return redirect()->route('admin.services.index')->with('success', 'Service saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Service saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Removed rows delete their media
    private function syncGalleryMedia(Request $request, Service $service): void
    {
        $existing = $service->galleryMedia()->get()->keyBy('uuid');
        $rows = (array) $request->input('gallery_items', []);
        $keepUuids = [];
        $position = 0;

        foreach ($rows as $row) {
            $position++;
            $alt = $row['alt'] ?? null;
            $title = $row['title'] ?? null;

            if (!empty($row['id']) && $existing->has($row['id'])) {
                $media = $existing->get($row['id']);
                $media->update([
                    'alt_text' => $alt,
                    'caption' => $title,
                    'name' => $title ?: $media->name,
                    'display_order' => $position,
                ]);
                $keepUuids[] = $media->uuid;

                continue;
            }

            if (!empty($row['temp'])) {
                $media = $this->mediaUploader->promoteTempToMedia($row['temp'], $service, 'gallery', 'services', $alt, $title);

                if ($media) {
                    $media->update(['display_order' => $position]);
                    $keepUuids[] = $media->uuid;
                }
            }
        }

        $existing->whereNotIn('uuid', $keepUuids)->each(fn (Media $media) => $this->mediaUploader->deleteMedia($media));
    }

    // Only reorders items with existing media id
    public function galleryreorder(Request $request, string $uuid)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'string',
        ]);

        try {
            $service = Service::where('uuid', $uuid)->firstOrFail();

            foreach ($request->input('order') as $position => $mediaUuid) {
                Media::where('uuid', $mediaUuid)
                    ->where('model_type', Service::class)
                    ->where('model_id', $service->id)
                    ->where('collection', 'gallery')
                    ->update(['display_order' => $position + 1]);
            }

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Service galleryreorder failed: ' . $e->getMessage(), ['exception' => $e]);

            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    private function syncFaqs(Service $service, array $rows): void
    {
        $keepIds = [];

        foreach ($rows as $row) {
            if (empty($row['question']) || empty($row['answer'])) {
                continue;
            }

            $data = [
                'question' => $row['question'],
                'answer' => $row['answer'],
                'display_order' => $row['display_order'] ?? 0,
            ];

            $faq = !empty($row['id']) ? $service->faqs()->find($row['id']) : null;
            $faq ? $faq->update($data) : $faq = $service->faqs()->create($data);

            $keepIds[] = $faq->id;
        }

        $service->faqs()->whereNotIn('id', $keepIds)->delete();
    }

    // Each row has its own image upload
    private function syncFeatures(Service $service, array $rows): void
    {
        $keepIds = [];

        foreach ($rows as $row) {
            if (empty($row['title'])) {
                continue;
            }

            $feature = !empty($row['id']) ? $service->features()->find($row['id']) : null;

            $data = [
                'title' => $row['title'],
                'short_description' => $row['short_description'] ?? null,
                'icon' => $row['icon'] ?? null,
                'image_alt' => $row['image_alt'] ?? null,
                'is_highlighted' => isset($row['is_highlighted']),
                'display_order' => $row['display_order'] ?? 0,
            ];

            if (!empty($row['image_temp'])) {
                $promoted = $this->mediaUploader->promoteTemp($row['image_temp'], 'services/' . $service->uuid . '/features', $feature?->image, $row['image_alt'] ?? null);

                if ($promoted) {
                    $data['image'] = $promoted;
                }
            }

            $feature ? $feature->update($data) : $feature = $service->features()->create($data);

            $keepIds[] = $feature->id;
        }

        $service->features()->whereNotIn('id', $keepIds)->get()->each(
            fn ($feature) => $this->mediaUploader->deleteSingle($feature->image)
        );

        $service->features()->whereNotIn('id', $keepIds)->delete();
    }

    // Each row has its own image upload
    private function syncProblems(Service $service, array $rows): void
    {
        $keepIds = [];

        foreach ($rows as $row) {
            if (empty($row['challenge']) || empty($row['solution'])) {
                continue;
            }

            $problem = !empty($row['id']) ? $service->challenges()->find($row['id']) : null;

            $data = [
                'challenge' => $row['challenge'],
                'solution' => $row['solution'],
                'icon' => $row['icon'] ?? null,
                'image_alt' => $row['image_alt'] ?? null,
                'views' => $row['views'] ?? 0,
                'is_active' => isset($row['is_active']),
                'is_featured' => isset($row['is_featured']),
                'display_order' => $row['display_order'] ?? 0,
            ];

            if (!empty($row['image_temp'])) {
                $promoted = $this->mediaUploader->promoteTemp($row['image_temp'], 'services/' . $service->uuid . '/challenges', $problem?->image, $row['image_alt'] ?? null);

                if ($promoted) {
                    $data['image'] = $promoted;
                }
            }

            $problem ? $problem->update($data) : $problem = $service->challenges()->create($data);

            $keepIds[] = $problem->id;
        }

        $service->challenges()->whereNotIn('id', $keepIds)->get()->each(
            fn ($problem) => $this->mediaUploader->deleteSingle($problem->image)
        );

        $service->challenges()->whereNotIn('id', $keepIds)->delete();
    }

    // New pivot rows need uuid
    private function syncPlatforms(Service $service, array $rows): void
    {
        $existingIds = $service->platforms()->pluck('platforms.id')->all();
        $sync = [];

        foreach ($rows as $row) {
            $platformId = $row['platform_id'] ?? $row['id'] ?? null;

            if (empty($platformId)) {
                continue;
            }

            $pivotData = [
                'is_active' => isset($row['is_active']),
                'display_order' => $row['display_order'] ?? 0,
            ];

            if (!in_array($platformId, $existingIds)) {
                $pivotData['uuid'] = (string) Str::uuid();
                $pivotData['is_featured'] = false;
                $pivotData['views'] = 0;
            }

            $sync[$platformId] = $pivotData;
        }

        $service->platforms()->sync($sync);
    }

    // New pivot rows need uuid
    private function syncTechnologies(Service $service, array $rows): void
    {
        $existingIds = $service->technologies()->pluck('technologies.id')->all();
        $sync = [];

        foreach ($rows as $row) {
            $technologyId = $row['technology_id'] ?? $row['id'] ?? null;

            if (empty($technologyId)) {
                continue;
            }

            $pivotData = [
                'is_active' => isset($row['is_active']),
                'display_order' => $row['display_order'] ?? 0,
            ];

            if (!in_array($technologyId, $existingIds)) {
                $pivotData['uuid'] = (string) Str::uuid();
                $pivotData['is_featured'] = false;
            }

            $sync[$technologyId] = $pivotData;
        }

        $service->technologies()->sync($sync);
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            $service = Service::where('uuid', $uuid)->firstOrFail();
            $service->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.service'), [
                'subject_type' => Service::class,
                'subject_id' => $service->id,
                'description' => 'Deleted service ' . $service->title,
            ]);

            return back()->with('success', 'Service deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Service destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, $uuid)
    {
        try {
            $service = Service::where('uuid', $uuid)->firstOrFail();
            $service->is_active = ! $service->is_active;
            $service->save();

            ActivityLog::log(
                $service->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.service'),
                [
                    'subject_type' => Service::class,
                    'subject_id' => $service->id,
                    'description' => ($service->is_active ? 'Activated' : 'Deactivated') . ' service ' . $service->title,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $service->is_active]);
            }

            return back()->with('success', 'Service status updated.');
        } catch (\Throwable $e) {
            Log::error('Service togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglefeatured(Request $request, $uuid)
    {
        try {
            $service = Service::where('uuid', $uuid)->firstOrFail();
            $service->is_featured = ! $service->is_featured;
            $service->save();

            ActivityLog::log(
                $service->is_featured ? config('constants.ACTIVITY_ACTIONS.feature') : config('constants.ACTIVITY_ACTIONS.unfeature'),
                config('constants.MODULES.service'),
                [
                    'subject_type' => Service::class,
                    'subject_id' => $service->id,
                    'description' => ($service->is_featured ? 'Marked featured: ' : 'Unmarked featured: ') . $service->title,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $service->is_featured]);
            }

            return back()->with('success', 'Service featured status updated.');
        } catch (\Throwable $e) {
            Log::error('Service togglefeatured failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
