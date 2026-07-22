<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Page;
use App\Models\Testimonial;
use App\Services\MediaUploader;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    use HandlesImageUploads;

    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'testimonials.';

    public function __construct(private MediaUploader $mediaUploader)
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Testimonial::latest('id')->paginate($this->pagerecords)->withQueryString();
        $reorderRows = Testimonial::orderBy('display_order')->orderBy('id')->get();
        $pageNamesBySlug = Page::pluck('name', 'slug');
        return view($this->prefix . $this->folder . 'index', compact('rows', 'reorderRows', 'pageNamesBySlug'));
    }

    // Persist drag-drop reorder
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->input('order') as $position => $uuid) {
                    Testimonial::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.testimonial'), [
                'description' => 'Reordered testimonials',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Testimonial reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function createoredit(Request $request, $uuid = null)
    {
        $testimonial = null;

        if ($uuid) {
            try {
                $testimonial = Testimonial::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('Testimonial createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.testimonials.index')->with('error', 'Unable to load the requested testimonial.');
            }
        }

        $pages = Page::orderBy('display_order')->orderBy('id')->get(['slug', 'name']);

        return view($this->prefix . $this->folder . 'createoredit', compact('testimonial', 'pages'));
    }

    // Form field "image" maps to column "photo"
    public function saveorupdate(Request $request, $uuid = null)
    {
        $testimonial = $uuid ? Testimonial::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'message' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'display_order' => 'nullable|integer|min:0',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'photo' => 'nullable|mimes:' . config('constants.IMAGE_MIMES') . '|max:4096',
        ]);

        unset($data['photo']);

        $data['display_order'] = $data['display_order'] ?? 0;
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        try {
            $newUuid = null;

            if (!$testimonial) {
                $newUuid = (string) Str::uuid();
                $data['uuid'] = $newUuid;
            }

            $uuidForUpload = $testimonial?->uuid ?? $newUuid;

            $this->applyImage($request, $data, 'photo', 'testimonials', $testimonial, $uuidForUpload);

            if ($testimonial) {
                $testimonial->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated testimonial ' . $testimonial->name;
            } else {
                $testimonial = Testimonial::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created testimonial ' . $testimonial->name;
            }

            ActivityLog::log($action, config('constants.MODULES.testimonial'), [
                'subject_type' => Testimonial::class,
                'subject_id' => $testimonial->id,
                'new_values' => $testimonial->getChanges(),
                'description' => $description,
            ]);

            return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial saved successfully.');
        } catch (\Throwable $e) {
            Log::error('Testimonial saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            $testimonial = Testimonial::where('uuid', $uuid)->firstOrFail();
            $testimonial->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.testimonial'), [
                'subject_type' => Testimonial::class,
                'subject_id' => $testimonial->id,
                'description' => 'Deleted testimonial ' . $testimonial->name,
            ]);

            return back()->with('success', 'Testimonial deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Testimonial destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, $uuid)
    {
        try {
            $testimonial = Testimonial::where('uuid', $uuid)->firstOrFail();
            $testimonial->is_active = ! $testimonial->is_active;
            $testimonial->save();

            ActivityLog::log(
                $testimonial->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.testimonial'),
                [
                    'subject_type' => Testimonial::class,
                    'subject_id' => $testimonial->id,
                    'description' => ($testimonial->is_active ? 'Activated' : 'Deactivated') . ' testimonial ' . $testimonial->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $testimonial->is_active]);
            }

            return back()->with('success', 'Testimonial status updated.');
        } catch (\Throwable $e) {
            Log::error('Testimonial togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglefeatured(Request $request, $uuid)
    {
        try {
            $testimonial = Testimonial::where('uuid', $uuid)->firstOrFail();
            $testimonial->is_featured = ! $testimonial->is_featured;
            $testimonial->save();

            ActivityLog::log(
                $testimonial->is_featured ? config('constants.ACTIVITY_ACTIONS.feature') : config('constants.ACTIVITY_ACTIONS.unfeature'),
                config('constants.MODULES.testimonial'),
                [
                    'subject_type' => Testimonial::class,
                    'subject_id' => $testimonial->id,
                    'description' => ($testimonial->is_featured ? 'Marked featured: ' : 'Unmarked featured: ') . $testimonial->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $testimonial->is_featured]);
            }

            return back()->with('success', 'Testimonial featured status updated.');
        } catch (\Throwable $e) {
            Log::error('Testimonial togglefeatured failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
