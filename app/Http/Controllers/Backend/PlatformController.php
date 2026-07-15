<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Platform;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PlatformController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'platforms.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    // Index Function
    public function index(Request $request)
    {
        $rows = Platform::latest('id')->paginate($this->pagerecords)->withQueryString();
        $reorderRows = Platform::orderBy('display_order')->orderBy('id')->get();
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
                    Platform::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.platform'), [
                'description' => 'Reordered platforms',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Platform reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    // Create / Edit Function
    public function createoredit(Request $request, ?string $uuid = null)
    {
        $platform = null;

        if ($uuid) {
            try {
                $platform = Platform::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('Platform createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.platforms.index')->with('error', 'Unable to load the requested platform.');
            }
        }

        return view($this->prefix . $this->folder . 'createoredit', compact('platform'));
    }

    // Save / Update Function
    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $platform = $uuid ? Platform::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('platforms', 'slug')->ignore($platform?->id)],
            'icon' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['display_order'] = $data['display_order'] ?? 0;

        try {
            DB::beginTransaction();

            if ($platform) {
                $platform->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated platform ' . $platform->name;
            } else {
                $platform = Platform::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created platform ' . $platform->name;
            }

            ActivityLog::log($action, config('constants.MODULES.platform'), [
                'subject_type' => Platform::class,
                'subject_id' => $platform->id,
                'new_values' => $platform->getChanges(),
                'description' => $description,
            ]);

            DB::commit();

            return redirect()->route('admin.platforms.index')->with('success', 'Platform saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Platform saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Destroy Function
    public function destroy(Request $request, string $uuid)
    {
        try {
            $platform = Platform::where('uuid', $uuid)->firstOrFail();
            $platform->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.platform'), [
                'subject_type' => Platform::class,
                'subject_id' => $platform->id,
                'description' => 'Deleted platform ' . $platform->name,
            ]);

            return back()->with('success', 'Platform deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Platform destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Toggle Status Function
    public function togglestatus(Request $request, string $uuid)
    {
        try {
            $platform = Platform::where('uuid', $uuid)->firstOrFail();
            $platform->is_active = ! $platform->is_active;
            $platform->save();

            ActivityLog::log(
                $platform->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.platform'),
                [
                    'subject_type' => Platform::class,
                    'subject_id' => $platform->id,
                    'description' => ($platform->is_active ? 'Activated' : 'Deactivated') . ' platform ' . $platform->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $platform->is_active]);
            }

            return back()->with('success', 'Platform status updated.');
        } catch (\Throwable $e) {
            Log::error('Platform togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Toggle Featured Function
    public function togglefeatured(Request $request, string $uuid)
    {
        try {
            $platform = Platform::where('uuid', $uuid)->firstOrFail();
            $platform->is_featured = ! $platform->is_featured;
            $platform->save();

            ActivityLog::log(
                $platform->is_featured ? config('constants.ACTIVITY_ACTIONS.feature') : config('constants.ACTIVITY_ACTIONS.unfeature'),
                config('constants.MODULES.platform'),
                [
                    'subject_type' => Platform::class,
                    'subject_id' => $platform->id,
                    'description' => ($platform->is_featured ? 'Marked featured' : 'Unmarked featured') . ' platform ' . $platform->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $platform->is_featured]);
            }

            return back()->with('success', 'Platform featured status updated.');
        } catch (\Throwable $e) {
            Log::error('Platform togglefeatured failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
