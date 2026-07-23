<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Industry;
use App\Models\IndustryCategory;
use App\Services\MediaUploader;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MarketingIndustryController extends Controller
{
    use HandlesImageUploads;

    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'industries.';

    public function __construct(private MediaUploader $mediaUploader)
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Industry::with('category')->latest('id')->paginate($this->pagerecords)->withQueryString();
        $reorderRows = Industry::orderBy('display_order')->orderBy('id')->get();

        return view($this->prefix.$this->folder.'index', compact('rows', 'reorderRows'));
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
                    Industry::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.industry'), [
                'description' => 'Reordered industries',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Industry reorder failed: '.$e->getMessage(), ['exception' => $e]);

            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function createoredit(Request $request, $uuid = null)
    {
        $industry = null;

        if ($uuid) {
            try {
                $industry = Industry::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('Industry createoredit lookup failed: '.$e->getMessage(), ['exception' => $e]);

                return redirect()->route('admin.marketing.industries.index')->with('error', 'Unable to load the requested industry.');
            }
        }

        $categories = IndustryCategory::orderBy('name')->get();

        return view($this->prefix.$this->folder.'createoredit', compact('industry', 'categories'));
    }

    public function saveorupdate(Request $request, $uuid = null)
    {
        $industry = $uuid ? Industry::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'category_id' => 'required|exists:industry_categories,id',
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('industries', 'slug')->ignore($industry?->id)],
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|mimes:'.config('constants.IMAGE_MIMES').'|max:4096',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['display_order'] = $data['display_order'] ?? 0;

        try {
            DB::beginTransaction();

            $newUuid = null;

            if (! $industry) {
                $newUuid = (string) Str::uuid();
                $data['uuid'] = $newUuid;
            }

            $uuidForUpload = $industry?->uuid ?? $newUuid;

            $this->applyImage($request, $data, 'image', 'industries', $industry, $uuidForUpload);

            if ($industry) {
                $industry->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated industry '.$industry->name;
            } else {
                $industry = Industry::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created industry '.$industry->name;
            }

            ActivityLog::log($action, config('constants.MODULES.industry'), [
                'subject_type' => Industry::class,
                'subject_id' => $industry->id,
                'new_values' => $industry->getChanges(),
                'description' => $description,
            ]);

            DB::commit();

            return redirect()->route('admin.marketing.industries.index')->with('success', 'Industry saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Industry saveorupdate failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            $industry = Industry::where('uuid', $uuid)->firstOrFail();
            $industry->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.industry'), [
                'subject_type' => Industry::class,
                'subject_id' => $industry->id,
                'description' => 'Deleted industry '.$industry->name,
            ]);

            return back()->with('success', 'Industry deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Industry destroy failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, $uuid)
    {
        try {
            $industry = Industry::where('uuid', $uuid)->firstOrFail();
            $industry->is_active = ! $industry->is_active;
            $industry->save();

            ActivityLog::log(
                $industry->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.industry'),
                [
                    'subject_type' => Industry::class,
                    'subject_id' => $industry->id,
                    'description' => ($industry->is_active ? 'Activated' : 'Deactivated').' industry '.$industry->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $industry->is_active]);
            }

            return back()->with('success', 'Industry status updated.');
        } catch (\Throwable $e) {
            Log::error('Industry togglestatus failed: '.$e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglefeatured(Request $request, $uuid)
    {
        try {
            $industry = Industry::where('uuid', $uuid)->firstOrFail();
            $industry->is_featured = ! $industry->is_featured;
            $industry->save();

            ActivityLog::log(
                $industry->is_featured ? config('constants.ACTIVITY_ACTIONS.feature') : config('constants.ACTIVITY_ACTIONS.unfeature'),
                config('constants.MODULES.industry'),
                [
                    'subject_type' => Industry::class,
                    'subject_id' => $industry->id,
                    'description' => ($industry->is_featured ? 'Marked featured' : 'Unmarked featured').' industry '.$industry->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $industry->is_featured]);
            }

            return back()->with('success', 'Industry featured status updated.');
        } catch (\Throwable $e) {
            Log::error('Industry togglefeatured failed: '.$e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
