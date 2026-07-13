<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\CaseStudy;
use App\Models\CaseStudyCategory;
use App\Services\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class CaseStudyController extends Controller
{
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

        return view($this->prefix . $this->folder . 'index', compact('rows'));
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
            'banner_image' => ['nullable', 'image', 'max:4096'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['nullable', 'image', 'max:4096'],
            'old_gallery' => ['nullable', 'array'],
            'old_gallery.*' => ['nullable', 'string'],
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
            unset($data['featured_image'], $data['banner_image'], $data['gallery'], $data['old_gallery']);

            $data['is_active'] = $request->boolean('is_active');
            $data['is_featured'] = $request->boolean('is_featured');
            $data['published_at'] = $request->filled('published_at') ? $request->input('published_at') : null;
            $data['key_metrics'] = $this->parseCommaList($request->input('key_metrics'));
            $data['meta_keywords'] = $this->parseCommaList($request->input('meta_keywords'));

            if ($request->hasFile('featured_image')) {
                $data['featured_image'] = $this->mediaUploader->uploadSingle(
                    $request->file('featured_image'),
                    'case-studies',
                    $caseStudy?->featured_image
                );
            }

            if ($request->hasFile('banner_image')) {
                $data['banner_image'] = $this->mediaUploader->uploadSingle(
                    $request->file('banner_image'),
                    'case-studies',
                    $caseStudy?->banner_image
                );
            }

            $data['gallery'] = $this->resolveGallery($request, $caseStudy);

            $isNew = ! $caseStudy;

            if ($caseStudy) {
                $caseStudy->fill($data);
                $caseStudy->save();
            } else {
                $caseStudy = CaseStudy::create($data);
            }

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

    /**
     * Merge kept old gallery paths with newly uploaded files, deleting
     * any previously stored images the user removed on the form.
     */
    private function resolveGallery(Request $request, ?CaseStudy $caseStudy): array
    {
        $existingGallery = $caseStudy->gallery ?? [];
        $keptGallery = array_values(array_filter((array) $request->input('old_gallery', [])));

        foreach (array_diff($existingGallery, $keptGallery) as $removedPath) {
            $this->mediaUploader->deleteSingle($removedPath);
        }

        $uploadedPaths = [];

        foreach ((array) $request->file('gallery', []) as $file) {
            if ($file instanceof UploadedFile) {
                $uploadedPaths[] = $this->mediaUploader->uploadSingle($file, 'case-studies', null);
            }
        }

        return array_values(array_merge($keptGallery, $uploadedPaths));
    }

    private function parseCommaList(?string $value): array
    {
        if (empty($value)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $value)), fn ($item) => $item !== ''));
    }
}
