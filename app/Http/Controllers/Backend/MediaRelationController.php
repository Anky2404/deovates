<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Media;
use App\Models\MediaRelation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MediaRelationController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'media.relations.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    // Index Function
    public function index(Request $request)
    {
        $rows = MediaRelation::with('media')->latest('id')->paginate($this->pagerecords)->withQueryString();

        // MediaRelation has no title/name column of its own — build a
        // display label from the linked media's name plus the collection
        // (or model type) for the reorder modal only.
        $reorderRows = MediaRelation::with('media')->orderBy('display_order')->orderBy('id')->get();
        $reorderRows->each(function (MediaRelation $relation) {
            $mediaLabel = $relation->media->name ?? ('Media #' . $relation->media_id);
            $contextLabel = $relation->collection ?? $relation->model_type ?? 'relation';
            $relation->label = $mediaLabel . ' — ' . $contextLabel;
        });

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
                    MediaRelation::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.mediarelation'), [
                'description' => 'Reordered media relations',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('MediaRelation reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    // Create / Edit Function
    public function createoredit(Request $request, ?string $uuid = null)
    {
        $relation = null;

        if ($uuid) {
            try {
                $relation = MediaRelation::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('MediaRelation createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.media.relations.index')->with('error', 'Unable to load the requested media relation.');
            }
        }

        $media = Media::active()->orderBy('name')->pluck('name', 'id');

        return view($this->prefix . $this->folder . 'createoredit', compact('relation', 'media'));
    }

    // Save / Update Function
    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $relation = $uuid ? MediaRelation::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'media_id' => ['required', 'exists:media,id'],
            'model_type' => ['nullable', 'string', 'max:255'],
            'model_id' => ['nullable', 'integer', 'min:1'],
            'collection' => ['nullable', 'string', 'max:255'],
            'usage' => ['nullable', 'string', 'max:255'],
            'tag' => ['nullable', 'string', 'max:255'],
            'is_primary' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['is_primary'] = $request->boolean('is_primary');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        $data['display_order'] = $data['display_order'] ?? 0;

        try {
            DB::beginTransaction();

            if ($relation) {
                $relation->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated media relation #' . $relation->id;
            } else {
                $data['linked_by'] = auth('admin')->id();

                $relation = MediaRelation::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created media relation #' . $relation->id;
            }

            ActivityLog::log($action, config('constants.MODULES.mediarelation'), [
                'subject_type' => MediaRelation::class,
                'subject_id' => $relation->id,
                'new_values' => $relation->getChanges(),
                'description' => $description,
            ]);

            DB::commit();

            return redirect()->route('admin.media.relations.index')->with('success', 'Media relation saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('MediaRelation saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Destroy Function
    public function destroy(Request $request, string $uuid)
    {
        try {
            $relation = MediaRelation::where('uuid', $uuid)->firstOrFail();
            $relation->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.mediarelation'), [
                'subject_type' => MediaRelation::class,
                'subject_id' => $relation->id,
                'description' => 'Deleted media relation #' . $relation->id,
            ]);

            return back()->with('success', 'Media relation deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('MediaRelation destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Toggle Status Function
    public function togglestatus(Request $request, string $uuid)
    {
        try {
            $relation = MediaRelation::where('uuid', $uuid)->firstOrFail();
            $relation->is_active = ! $relation->is_active;
            $relation->save();

            ActivityLog::log(
                $relation->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.mediarelation'),
                [
                    'subject_type' => MediaRelation::class,
                    'subject_id' => $relation->id,
                    'description' => ($relation->is_active ? 'Activated' : 'Deactivated') . ' media relation #' . $relation->id,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $relation->is_active]);
            }

            return back()->with('success', 'Media relation status updated.');
        } catch (\Throwable $e) {
            Log::error('MediaRelation togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

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
            $relation = MediaRelation::where('uuid', $uuid)->firstOrFail();
            $relation->is_featured = ! $relation->is_featured;
            $relation->save();

            ActivityLog::log(
                $relation->is_featured ? config('constants.ACTIVITY_ACTIONS.feature') : config('constants.ACTIVITY_ACTIONS.unfeature'),
                config('constants.MODULES.mediarelation'),
                [
                    'subject_type' => MediaRelation::class,
                    'subject_id' => $relation->id,
                    'description' => ($relation->is_featured ? 'Marked featured' : 'Unmarked featured') . ' media relation #' . $relation->id,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $relation->is_featured]);
            }

            return back()->with('success', 'Media relation featured status updated.');
        } catch (\Throwable $e) {
            Log::error('MediaRelation togglefeatured failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
