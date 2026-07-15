<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\TechnologyCategory;
use App\Services\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class TechnologyCategoryController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'technologies.categories.';

    public function __construct(private MediaUploader $mediaUploader)
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = TechnologyCategory::latest('id')
            ->paginate($this->pagerecords)
            ->withQueryString();

        $reorderRows = TechnologyCategory::orderBy('display_order')->orderBy('id')->get();

        return view($this->prefix . $this->folder . 'index', compact('rows', 'reorderRows'));
    }

    // Persist a drag-and-drop order from the reorder modal.
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->input('order') as $position => $uuid) {
                    TechnologyCategory::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.technologycategory'), [
                'description' => 'Reordered technology categories',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('TechnologyCategory reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function createoredit(?string $uuid = null)
    {
        $category = null;

        if ($uuid) {
            $category = TechnologyCategory::where('uuid', $uuid)->firstOrFail();
        }

        return view($this->prefix . $this->folder . 'createoredit', compact('category'));
    }

    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $category = $uuid ? TechnologyCategory::where('uuid', $uuid)->firstOrFail() : null;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('technology_categories', 'slug')->ignore($category?->id)],
            'icon' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:4096'],
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
                    'technology-categories',
                    $category?->image
                );
            }

            $isNew = ! $category;

            if ($category) {
                $category->fill($data);
                $category->save();
            } else {
                $category = TechnologyCategory::create($data);
            }

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($isNew ? 'create' : 'update')),
                config('constants.MODULES.technologycategory'),
                [
                    'subject_type' => TechnologyCategory::class,
                    'subject_id' => $category->id,
                    'new_values' => $category->getChanges(),
                    'description' => ($isNew ? 'Created' : 'Updated') . ' technology category: ' . $category->name,
                ]
            );

            DB::commit();

            return redirect()->route('admin.technologies.categories.index')->with('success', 'Technology category saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('TechnologyCategory saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, string $uuid)
    {
        $category = TechnologyCategory::where('uuid', $uuid)->firstOrFail();

        try {
            $category->is_active = ! $category->is_active;
            $category->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($category->is_active ? 'activate' : 'deactivate')),
                config('constants.MODULES.technologycategory'),
                [
                    'subject_type' => TechnologyCategory::class,
                    'subject_id' => $category->id,
                    'new_values' => ['is_active' => $category->is_active],
                    'description' => 'Toggled status of technology category: ' . $category->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $category->is_active]);
            }

            return back()->with('success', 'Status updated successfully.');
        } catch (\Throwable $e) {
            Log::error('TechnologyCategory togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglefeatured(Request $request, string $uuid)
    {
        $category = TechnologyCategory::where('uuid', $uuid)->firstOrFail();

        try {
            $category->is_featured = ! $category->is_featured;
            $category->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($category->is_featured ? 'feature' : 'unfeature')),
                config('constants.MODULES.technologycategory'),
                [
                    'subject_type' => TechnologyCategory::class,
                    'subject_id' => $category->id,
                    'new_values' => ['is_featured' => $category->is_featured],
                    'description' => 'Toggled featured status of technology category: ' . $category->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $category->is_featured]);
            }

            return back()->with('success', 'Status updated successfully.');
        } catch (\Throwable $e) {
            Log::error('TechnologyCategory togglefeatured failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(string $uuid)
    {
        $category = TechnologyCategory::where('uuid', $uuid)->firstOrFail();

        try {
            $category->delete();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.delete'),
                config('constants.MODULES.technologycategory'),
                [
                    'subject_type' => TechnologyCategory::class,
                    'subject_id' => $category->id,
                    'description' => 'Deleted technology category: ' . $category->name,
                ]
            );

            return back()->with('success', 'Technology category deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('TechnologyCategory destroy failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
