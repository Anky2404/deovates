<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'tags.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    // Index Function
    public function index(Request $request)
    {
        $rows = Tag::latest('id')->paginate($this->pagerecords)->withQueryString();
        $reorderRows = Tag::orderBy('display_order')->orderBy('id')->get();
        return view($this->prefix . $this->folder . 'index', compact('rows', 'reorderRows'));
    }

    // Persist a new drag-and-drop order from the reorder modal.
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->input('order') as $position => $uuid) {
                    Tag::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.tag'), [
                'description' => 'Reordered tags',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Tag reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    // Create / Edit Function
    public function createoredit(Request $request, $uuid = null)
    {
        $tag = null;

        if ($uuid) {
            try {
                $tag = Tag::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('Tag createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.tags.index')->with('error', 'Unable to load the requested tag.');
            }
        }

        return view($this->prefix . $this->folder . 'createoredit', compact('tag'));
    }

    // Save / Update Function
    public function saveorupdate(Request $request, $uuid = null)
    {
        $tag = $uuid ? Tag::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('tags', 'slug')->ignore($tag?->id)],
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        try {
            if ($tag) {
                $tag->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated tag ' . $tag->name;
            } else {
                $tag = Tag::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created tag ' . $tag->name;
            }

            ActivityLog::log($action, config('constants.MODULES.tag'), [
                'subject_type' => Tag::class,
                'subject_id' => $tag->id,
                'new_values' => $tag->getChanges(),
                'description' => $description,
            ]);

            return redirect()->route('admin.tags.index')->with('success', 'Tag saved successfully.');
        } catch (\Throwable $e) {
            Log::error('Tag saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Destroy Function
    public function destroy(Request $request, $uuid)
    {
        try {
            $tag = Tag::where('uuid', $uuid)->firstOrFail();
            $tag->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.tag'), [
                'subject_type' => Tag::class,
                'subject_id' => $tag->id,
                'description' => 'Deleted tag ' . $tag->name,
            ]);

            return back()->with('success', 'Tag deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Tag destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Toggle Status Function
    public function togglestatus(Request $request, $uuid)
    {
        try {
            $tag = Tag::where('uuid', $uuid)->firstOrFail();
            $tag->is_active = ! $tag->is_active;
            $tag->save();

            ActivityLog::log(
                $tag->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.tag'),
                [
                    'subject_type' => Tag::class,
                    'subject_id' => $tag->id,
                    'description' => ($tag->is_active ? 'Activated' : 'Deactivated') . ' tag ' . $tag->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $tag->is_active]);
            }

            return back()->with('success', 'Tag status updated.');
        } catch (\Throwable $e) {
            Log::error('Tag togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
