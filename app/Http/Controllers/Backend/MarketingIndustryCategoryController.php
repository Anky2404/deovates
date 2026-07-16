<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\IndustryCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class MarketingIndustryCategoryController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'industries.categories.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = IndustryCategory::latest('id')->paginate($this->pagerecords)->withQueryString();
        $reorderRows = IndustryCategory::orderBy('display_order')->orderBy('id')->get();
        return view($this->prefix . $this->folder . 'index', compact('rows', 'reorderRows'));
    }

    // Drag-drop reorder
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->input('order') as $position => $uuid) {
                    IndustryCategory::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.industrycategory'), [
                'description' => 'Reordered industry categories',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('IndustryCategory reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function createoredit(Request $request, $uuid = null)
    {
        $category = null;

        if ($uuid) {
            try {
                $category = IndustryCategory::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('IndustryCategory createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.marketing.industries.categories.index')->with('error', 'Unable to load the requested category.');
            }
        }

        return view($this->prefix . $this->folder . 'createoredit', compact('category'));
    }

    public function saveorupdate(Request $request, $uuid = null)
    {
        $category = $uuid ? IndustryCategory::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('industry_categories', 'slug')->ignore($category?->id)],
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['display_order'] = $data['display_order'] ?? 0;

        try {
            DB::beginTransaction();

            if ($category) {
                $category->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated industry category ' . $category->name;
            } else {
                $category = IndustryCategory::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created industry category ' . $category->name;
            }

            ActivityLog::log($action, config('constants.MODULES.industrycategory'), [
                'subject_type' => IndustryCategory::class,
                'subject_id' => $category->id,
                'new_values' => $category->getChanges(),
                'description' => $description,
            ]);

            DB::commit();

            return redirect()->route('admin.marketing.industries.categories.index')->with('success', 'Industry category saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('IndustryCategory saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            $category = IndustryCategory::where('uuid', $uuid)->firstOrFail();
            $category->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.industrycategory'), [
                'subject_type' => IndustryCategory::class,
                'subject_id' => $category->id,
                'description' => 'Deleted industry category ' . $category->name,
            ]);

            return back()->with('success', 'Industry category deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('IndustryCategory destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, $uuid)
    {
        try {
            $category = IndustryCategory::where('uuid', $uuid)->firstOrFail();
            $category->is_active = ! $category->is_active;
            $category->save();

            ActivityLog::log(
                $category->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.industrycategory'),
                [
                    'subject_type' => IndustryCategory::class,
                    'subject_id' => $category->id,
                    'description' => ($category->is_active ? 'Activated' : 'Deactivated') . ' industry category ' . $category->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $category->is_active]);
            }

            return back()->with('success', 'Industry category status updated.');
        } catch (\Throwable $e) {
            Log::error('IndustryCategory togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
