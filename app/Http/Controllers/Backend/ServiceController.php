<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
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

    // Index Function
    //
    // Unpaginated and ordered by display_order: the list is drag-reorderable
    // (see reorder()), and reordering across paginated boundaries doesn't
    // make sense.
    public function index(Request $request)
    {
        $rows = Service::orderBy('display_order')->orderBy('id')->get();
        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    // Persist a new drag-and-drop order from the index list.
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

    // Create / Edit Function
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

    // Save / Update Function
    public function saveorupdate(Request $request, $uuid = null)
    {
        $service = $uuid ? Service::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('services', 'slug')->ignore($service?->id)],
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            // Raw file inputs are only ever populated as a no-JS fallback —
            // the normal path is the *_temp hidden field (see below), which
            // carries a path already produced by the crop-and-upload widget.
            'featured_image' => 'nullable|image|max:4096',
            'featured_image_alt' => 'nullable|string|max:255',
            'banner_image' => 'nullable|image|max:4096',
            'banner_image_alt' => 'nullable|string|max:255',
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

        // The form only manages a subset of Service's fillable columns; the
        // rest (parent_service_id, rating, review_count, canonical_url,
        // views) aren't present in the view and are intentionally left
        // untouched here.
        unset($data['platforms'], $data['technologies'], $data['faqs'], $data['features'], $data['problems']);

        // New services join at the end of the drag-reorderable index list,
        // rather than colliding with everything else at the column default.
        if (!$service) {
            $data['display_order'] = (Service::max('display_order') ?? 0) + 1;
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        // JSON-auto field: decode safely, never let bad JSON crash the save.
        $decodedKeywords = json_decode($data['meta_keywords'] ?? '', true);
        $data['meta_keywords'] = is_array($decodedKeywords) ? $decodedKeywords : [];

        try {
            DB::beginTransaction();

            $this->applyImage($request, $data, 'featured_image', 'services', $service);
            $this->applyImage($request, $data, 'banner_image', 'services', $service);

            if ($service) {
                $service->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated service ' . $service->title;
            } else {
                $service = Service::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created service ' . $service->title;
            }

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

    // Sync FAQs from the createoredit form rows (create/update/delete).
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

    // Sync Features from the createoredit form rows, including each row's
    // own image (via the same temp-upload/promote flow as the main images).
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
                $promoted = $this->mediaUploader->promoteTemp($row['image_temp'], 'services/features', $feature?->image, $row['image_alt'] ?? null);

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

    // Sync Challenges (the "Problems & Solutions" tab) from the createoredit
    // form rows, including each row's own image.
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
                $promoted = $this->mediaUploader->promoteTemp($row['image_temp'], 'services/challenges', $problem?->image, $row['image_alt'] ?? null);

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

    // Sync the supported-platforms pivot from the createoredit form rows.
    //
    // Note: the pivot's `uuid`, `is_featured` and `views` columns are all
    // NOT NULL with no DB default, and sync() does a raw insert that
    // bypasses ServicePlatform's HasUuid model-event hook — so newly
    // attached rows need those supplied explicitly or the insert fails.
    // Already-attached rows are left alone for those columns (the form has
    // no UI for them here) so a save never clobbers values set elsewhere.
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

    // Sync the technologies-used pivot from the createoredit form rows.
    // See syncPlatforms() above for why new rows need an explicit uuid.
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

    // Destroy Function
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

    // Toggle Status Function
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

    // Toggle Featured Function
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
