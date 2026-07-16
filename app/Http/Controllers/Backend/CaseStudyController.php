<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\CaseStudy;
use App\Models\CaseStudyCategory;
use App\Models\Media;
use App\Services\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CaseStudyController extends Controller
{
    use HandlesImageUploads;

    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'casestudies.';

    public function __construct(private MediaUploader $mediaUploader)
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = CaseStudy::with('category')
            ->latest('id')
            ->paginate($this->pagerecords)
            ->withQueryString();
        $reorderRows = CaseStudy::orderBy('display_order')->orderBy('id')->take(300)->get();

        return view($this->prefix . $this->folder . 'index', compact('rows', 'reorderRows'));
    }

    // saves drag-drop order
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->input('order') as $position => $uuid) {
                    CaseStudy::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.casestudy'), [
                'description' => 'Reordered case studies',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('CaseStudy reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function createoredit(?string $uuid = null)
    {
        $caseStudy = null;

        if ($uuid) {
            $caseStudy = CaseStudy::where('uuid', $uuid)->firstOrFail();
        }

        $categories = CaseStudyCategory::orderBy('name')->get();

        return view($this->prefix . $this->folder . 'createoredit', compact('caseStudy', 'categories'));
    }

    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $caseStudy = $uuid ? CaseStudy::where('uuid', $uuid)->firstOrFail() : null;

        $validated = $request->validate([
            'case_study_category_id' => ['nullable', 'exists:case_study_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('case_studies', 'slug')->ignore($caseStudy?->id)],
            'client_name' => ['nullable', 'string', 'max:255'],
            'industry' => ['nullable', 'string', 'max:255'],
            'project_duration' => ['nullable', 'string', 'max:255'],
            'project_budget' => ['nullable', 'string', 'max:255'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
            'display_order' => ['nullable', 'integer'],
            'published_at' => ['nullable', 'date'],
            'featured_image' => ['nullable', 'image', 'max:4096'],
            'featured_image_alt' => ['nullable', 'string', 'max:255'],
            'banner_image' => ['nullable', 'image', 'max:4096'],
            'banner_image_alt' => ['nullable', 'string', 'max:255'],
            'gallery_items' => ['nullable', 'array'],
            'gallery_items.*.id' => ['nullable', 'string'],
            'gallery_items.*.temp' => ['nullable', 'string'],
            'gallery_items.*.alt' => ['nullable', 'string', 'max:255'],
            'gallery_items.*.title' => ['nullable', 'string', 'max:255'],
            'overview' => ['nullable', 'string'],
            'challenges' => ['nullable', 'string'],
            'solutions' => ['nullable', 'string'],
            'results' => ['nullable', 'string'],
            'testimonial' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'key_metrics' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
        ]);

        try {
            DB::beginTransaction();

            $data = $validated;
            unset($data['featured_image'], $data['banner_image'], $data['gallery_items']);

            $data['is_active'] = $request->boolean('is_active');
            $data['is_featured'] = $request->boolean('is_featured');
            $data['published_at'] = $request->filled('published_at') ? $request->input('published_at') : null;
            $data['key_metrics'] = $this->parseCommaList($request->input('key_metrics'));
            $data['meta_keywords'] = $this->parseCommaList($request->input('meta_keywords'));

            $isNew = ! $caseStudy;
            $newUuid = null;

            if ($isNew) {
                $newUuid = (string) Str::uuid();
                $data['uuid'] = $newUuid;
            }

            $this->applyImage($request, $data, 'featured_image', 'case-studies', $caseStudy, $newUuid);
            $this->applyImage($request, $data, 'banner_image', 'case-studies', $caseStudy, $newUuid);

            if ($caseStudy) {
                $caseStudy->fill($data);
                $caseStudy->save();
            } else {
                $caseStudy = CaseStudy::create($data);
            }

            $this->syncGalleryMedia($request, $caseStudy);

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($isNew ? 'create' : 'update')),
                config('constants.MODULES.casestudy'),
                [
                    'subject_type' => CaseStudy::class,
                    'subject_id' => $caseStudy->id,
                    'new_values' => $caseStudy->getChanges(),
                    'description' => ($isNew ? 'Created' : 'Updated') . ' case study: ' . $caseStudy->title,
                ]
            );

            DB::commit();

            return redirect()->route('admin.casestudies.index')->with('success', 'Case study saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('CaseStudy saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, string $uuid)
    {
        $caseStudy = CaseStudy::where('uuid', $uuid)->firstOrFail();

        try {
            $caseStudy->is_active = ! $caseStudy->is_active;
            $caseStudy->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($caseStudy->is_active ? 'activate' : 'deactivate')),
                config('constants.MODULES.casestudy'),
                [
                    'subject_type' => CaseStudy::class,
                    'subject_id' => $caseStudy->id,
                    'new_values' => ['is_active' => $caseStudy->is_active],
                    'description' => 'Toggled status of case study: ' . $caseStudy->title,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $caseStudy->is_active]);
            }

            return back()->with('success', 'Status updated successfully.');
        } catch (\Throwable $e) {
            Log::error('CaseStudy togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglefeatured(Request $request, string $uuid)
    {
        $caseStudy = CaseStudy::where('uuid', $uuid)->firstOrFail();

        try {
            $caseStudy->is_featured = ! $caseStudy->is_featured;
            $caseStudy->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($caseStudy->is_featured ? 'feature' : 'unfeature')),
                config('constants.MODULES.casestudy'),
                [
                    'subject_type' => CaseStudy::class,
                    'subject_id' => $caseStudy->id,
                    'new_values' => ['is_featured' => $caseStudy->is_featured],
                    'description' => 'Toggled featured status of case study: ' . $caseStudy->title,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $caseStudy->is_featured]);
            }

            return back()->with('success', 'Status updated successfully.');
        } catch (\Throwable $e) {
            Log::error('CaseStudy togglefeatured failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // edit mode only, skips unsaved temp items
    public function galleryreorder(Request $request, string $uuid)
    {
        $request->validate([
            'order' => ['required', 'array'],
            'order.*' => ['string'],
        ]);

        try {
            $caseStudy = CaseStudy::where('uuid', $uuid)->firstOrFail();

            foreach ($request->input('order') as $position => $mediaUuid) {
                Media::where('uuid', $mediaUuid)
                    ->where('model_type', CaseStudy::class)
                    ->where('model_id', $caseStudy->id)
                    ->where('collection', 'gallery')
                    ->update(['display_order' => $position + 1]);
            }

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('CaseStudy galleryreorder failed: ' . $e->getMessage(), ['exception' => $e]);

            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function destroy(string $uuid)
    {
        $caseStudy = CaseStudy::where('uuid', $uuid)->firstOrFail();

        try {
            $caseStudy->delete();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.delete'),
                config('constants.MODULES.casestudy'),
                [
                    'subject_type' => CaseStudy::class,
                    'subject_id' => $caseStudy->id,
                    'description' => 'Deleted case study: ' . $caseStudy->title,
                ]
            );

            return back()->with('success', 'Case study deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('CaseStudy destroy failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // removed images get deleted, temp uploads promoted
    private function syncGalleryMedia(Request $request, CaseStudy $caseStudy): void
    {
        $existing = $caseStudy->galleryMedia()->get()->keyBy('uuid');
        $rows = (array) $request->input('gallery_items', []);
        $keepUuids = [];
        $position = 0;

        foreach ($rows as $row) {
            $position++;
            $alt = $row['alt'] ?? null;
            $title = $row['title'] ?? null;

            if (!empty($row['id']) && $existing->has($row['id'])) {
                $media = $existing->get($row['id']);
                $media->update([
                    'alt_text' => $alt,
                    'caption' => $title,
                    'name' => $title ?: $media->name,
                    'display_order' => $position,
                ]);
                $keepUuids[] = $media->uuid;

                continue;
            }

            if (!empty($row['temp'])) {
                $media = $this->mediaUploader->promoteTempToMedia($row['temp'], $caseStudy, 'gallery', 'case-studies', $alt, $title);

                if ($media) {
                    $media->update(['display_order' => $position]);
                    $keepUuids[] = $media->uuid;
                }
            }
        }

        $existing->whereNotIn('uuid', $keepUuids)->each(fn (Media $media) => $this->mediaUploader->deleteMedia($media));
    }

    private function parseCommaList(?string $value): array
    {
        if (empty($value)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $value)), fn ($item) => $item !== ''));
    }
}
