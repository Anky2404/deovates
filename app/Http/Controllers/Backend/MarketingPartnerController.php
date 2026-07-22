<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Partner;
use App\Services\MediaUploader;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MarketingPartnerController extends Controller
{
    use HandlesImageUploads;

    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'partners.';

    public function __construct(private MediaUploader $mediaUploader)
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Partner::latest('id')->paginate($this->pagerecords)->withQueryString();
        $reorderRows = Partner::orderBy('display_order')->orderBy('id')->get();
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
                    Partner::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.partner'), [
                'description' => 'Reordered partners',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Partner reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function createoredit(Request $request, $uuid = null)
    {
        $partner = null;

        if ($uuid) {
            try {
                $partner = Partner::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('Partner createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.marketing.partners.index')->with('error', 'Unable to load the requested partner.');
            }
        }

        return view($this->prefix . $this->folder . 'createoredit', compact('partner'));
    }

    public function saveorupdate(Request $request, $uuid = null)
    {
        $partner = $uuid ? Partner::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('partners', 'slug')->ignore($partner?->id)],
            'logo' => 'nullable|mimes:' . config('constants.IMAGE_MIMES') . '|max:4096',
            'website_url' => 'nullable|url|max:255',
            'type' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
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

            if (!$partner) {
                $newUuid = (string) Str::uuid();
                $data['uuid'] = $newUuid;
            }

            $uuidForUpload = $partner?->uuid ?? $newUuid;

            $this->applyImage($request, $data, 'logo', 'partners', $partner, $uuidForUpload);

            if ($partner) {
                $partner->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated partner ' . $partner->name;
            } else {
                $partner = Partner::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created partner ' . $partner->name;
            }

            ActivityLog::log($action, config('constants.MODULES.partner'), [
                'subject_type' => Partner::class,
                'subject_id' => $partner->id,
                'new_values' => $partner->getChanges(),
                'description' => $description,
            ]);

            DB::commit();

            return redirect()->route('admin.marketing.partners.index')->with('success', 'Partner saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Partner saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            $partner = Partner::where('uuid', $uuid)->firstOrFail();
            $partner->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.partner'), [
                'subject_type' => Partner::class,
                'subject_id' => $partner->id,
                'description' => 'Deleted partner ' . $partner->name,
            ]);

            return back()->with('success', 'Partner deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Partner destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, $uuid)
    {
        try {
            $partner = Partner::where('uuid', $uuid)->firstOrFail();
            $partner->is_active = ! $partner->is_active;
            $partner->save();

            ActivityLog::log(
                $partner->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.partner'),
                [
                    'subject_type' => Partner::class,
                    'subject_id' => $partner->id,
                    'description' => ($partner->is_active ? 'Activated' : 'Deactivated') . ' partner ' . $partner->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $partner->is_active]);
            }

            return back()->with('success', 'Partner status updated.');
        } catch (\Throwable $e) {
            Log::error('Partner togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglefeatured(Request $request, $uuid)
    {
        try {
            $partner = Partner::where('uuid', $uuid)->firstOrFail();
            $partner->is_featured = ! $partner->is_featured;
            $partner->save();

            ActivityLog::log(
                $partner->is_featured ? config('constants.ACTIVITY_ACTIONS.feature') : config('constants.ACTIVITY_ACTIONS.unfeature'),
                config('constants.MODULES.partner'),
                [
                    'subject_type' => Partner::class,
                    'subject_id' => $partner->id,
                    'description' => ($partner->is_featured ? 'Marked featured' : 'Unmarked featured') . ' partner ' . $partner->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $partner->is_featured]);
            }

            return back()->with('success', 'Partner featured status updated.');
        } catch (\Throwable $e) {
            Log::error('Partner togglefeatured failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
