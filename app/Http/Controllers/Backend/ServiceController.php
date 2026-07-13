<?php

namespace App\Http\Controllers\Backend;

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
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'services.';

    public function __construct(private MediaUploader $mediaUploader)
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    // Index Function
    public function index(Request $request)
    {
        $rows = Service::latest('id')->paginate($this->pagerecords)->withQueryString();
        return view($this->prefix . $this->folder . 'index', compact('rows'));
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
            'featured_image' => 'nullable|image|max:4096',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'platforms' => 'nullable|array',
            'technologies' => 'nullable|array',
        ]);

        // The form only manages a subset of Service's fillable columns; the
        // rest (parent_service_id, banner_image, rating, review_count,
        // canonical_url, display_order, views) aren't present in the view
        // and are intentionally left untouched here.
        unset($data['platforms'], $data['technologies']);

        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        // JSON-auto field: decode safely, never let bad JSON crash the save.
        $decodedKeywords = json_decode($data['meta_keywords'] ?? '', true);
        $data['meta_keywords'] = is_array($decodedKeywords) ? $decodedKeywords : [];

        try {
            DB::beginTransaction();

            if ($request->hasFile('featured_image')) {
                $data['featured_image'] = $this->mediaUploader->uploadSingle(
                    $request->file('featured_image'),
                    'services',
                    $service->featured_image ?? null
                );
            }

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

    // Sync the supported-platforms pivot from the createoredit form rows.
    private function syncPlatforms(Service $service, array $rows): void
    {
        $sync = [];

        foreach ($rows as $row) {
            $platformId = $row['platform_id'] ?? $row['id'] ?? null;

            if (empty($platformId)) {
                continue;
            }

            $sync[$platformId] = [
                'is_active' => isset($row['is_active']),
                'display_order' => $row['display_order'] ?? 0,
            ];
        }

        $service->platforms()->sync($sync);
    }

    // Sync the technologies-used pivot from the createoredit form rows.
    private function syncTechnologies(Service $service, array $rows): void
    {
        $sync = [];

        foreach ($rows as $row) {
            $technologyId = $row['technology_id'] ?? $row['id'] ?? null;

            if (empty($technologyId)) {
                continue;
            }

            $sync[$technologyId] = [
                'is_active' => isset($row['is_active']),
                'display_order' => $row['display_order'] ?? 0,
            ];
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
}
