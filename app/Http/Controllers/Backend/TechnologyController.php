<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Technology;
use App\Models\TechnologyCategory;
use App\Services\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class TechnologyController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'technologies.';

    public function __construct(private MediaUploader $mediaUploader)
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Technology::with('category')
            ->latest('id')
            ->paginate($this->pagerecords)
            ->withQueryString();

        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    public function createoredit(?string $uuid = null)
    {
        $technology = null;

        if ($uuid) {
            $technology = Technology::where('uuid', $uuid)->firstOrFail();
        }

        $categories = TechnologyCategory::orderBy('name')->get();

        return view($this->prefix . $this->folder . 'createoredit', compact('technology', 'categories'));
    }

    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $technology = $uuid ? Technology::where('uuid', $uuid)->firstOrFail() : null;

        $validated = $request->validate([
            'technology_category_id' => ['nullable', 'exists:technology_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('technologies', 'slug')->ignore($technology?->id)],
            'icon' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:4096'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'version' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'display_order' => ['nullable', 'integer'],
            'views' => ['nullable', 'integer'],
        ]);

        try {
            DB::beginTransaction();

            $data = $validated;
            unset($data['image']);

            $data['is_active'] = $request->boolean('is_active');
            $data['is_featured'] = $request->boolean('is_featured');

            if ($request->hasFile('image')) {
                $data['image'] = $this->mediaUploader->uploadSingle(
                    $request->file('image'),
                    'technologies',
                    $technology?->image
                );
            }

            $isNew = ! $technology;

            if ($technology) {
                $technology->fill($data);
                $technology->save();
            } else {
                $technology = Technology::create($data);
            }

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($isNew ? 'create' : 'update')),
                config('constants.MODULES.technology'),
                [
                    'subject_type' => Technology::class,
                    'subject_id' => $technology->id,
                    'new_values' => $technology->getChanges(),
                    'description' => ($isNew ? 'Created' : 'Updated') . ' technology: ' . $technology->name,
                ]
            );

            DB::commit();

            return redirect()->route('admin.technologies.index')->with('success', 'Technology saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Technology saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, string $uuid)
    {
        $technology = Technology::where('uuid', $uuid)->firstOrFail();

        try {
            $technology->is_active = ! $technology->is_active;
            $technology->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($technology->is_active ? 'activate' : 'deactivate')),
                config('constants.MODULES.technology'),
                [
                    'subject_type' => Technology::class,
                    'subject_id' => $technology->id,
                    'new_values' => ['is_active' => $technology->is_active],
                    'description' => 'Toggled status of technology: ' . $technology->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $technology->is_active]);
            }

            return back()->with('success', 'Status updated successfully.');
        } catch (\Throwable $e) {
            Log::error('Technology togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglefeatured(Request $request, string $uuid)
    {
        $technology = Technology::where('uuid', $uuid)->firstOrFail();

        try {
            $technology->is_featured = ! $technology->is_featured;
            $technology->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($technology->is_featured ? 'feature' : 'unfeature')),
                config('constants.MODULES.technology'),
                [
                    'subject_type' => Technology::class,
                    'subject_id' => $technology->id,
                    'new_values' => ['is_featured' => $technology->is_featured],
                    'description' => 'Toggled featured status of technology: ' . $technology->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $technology->is_featured]);
            }

            return back()->with('success', 'Status updated successfully.');
        } catch (\Throwable $e) {
            Log::error('Technology togglefeatured failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(string $uuid)
    {
        $technology = Technology::where('uuid', $uuid)->firstOrFail();

        try {
            $technology->delete();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.delete'),
                config('constants.MODULES.technology'),
                [
                    'subject_type' => Technology::class,
                    'subject_id' => $technology->id,
                    'description' => 'Deleted technology: ' . $technology->name,
                ]
            );

            return back()->with('success', 'Technology deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Technology destroy failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
