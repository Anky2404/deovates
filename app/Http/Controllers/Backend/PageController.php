<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Page;
use App\Models\PageSectionContent;
use App\Models\Section;
use App\Services\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'pages.';

    public function __construct(private MediaUploader $mediaUploader)
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Page::orderBy('display_order')->orderBy('id')->paginate($this->pagerecords)->withQueryString();
        $reorderRows = Page::orderBy('display_order')->orderBy('id')->get();

        return view($this->prefix.$this->folder.'index', compact('rows', 'reorderRows'));
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
                    Page::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.page'), [
                'description' => 'Reordered pages',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Page reorder failed: '.$e->getMessage(), ['exception' => $e]);

            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function details(string $uuid)
    {
        $page = Page::with(['template', 'sections' => fn ($q) => $q->with('form.fields')])
            ->where('uuid', $uuid)
            ->firstOrFail();

        $sectionContents = $page->sectionContents()->pluck('data', 'section_id');

        return view($this->prefix.$this->folder.'details', compact('page', 'sectionContents'));
    }

    public function createoredit(?string $uuid = null)
    {
        $page = null;
        $sectionContents = [];

        if ($uuid) {
            $page = Page::with('sections')->where('uuid', $uuid)->firstOrFail();

            $sectionContents = $page->sectionContents()
                ->pluck('data', 'section_id')
                ->toArray();
        }

        $sections = Section::with('form.fields')->orderBy('name')->get();

        return view($this->prefix.$this->folder.'createoredit', compact('page', 'sections', 'sectionContents'));
    }

    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $page = $uuid ? Page::where('uuid', $uuid)->firstOrFail() : null;

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('pages', 'slug')->ignore($page?->id)],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:1000'],
            'meta_keywords' => ['nullable', 'string'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
            'is_active' => ['nullable'],
            'is_published' => ['nullable'],
            'sections' => ['nullable', 'array'],
            'sections.order' => ['nullable', 'array'],
            'sections.order.*' => ['integer', 'exists:sections,id'],
        ]);

        try {
            DB::beginTransaction();

            $data = $validated;
            unset($data['meta_keywords'], $data['sections']);

            // "name" has no dedicated field in this simplified form — keep
            // it in sync with title since the column is still NOT NULL.
            $data['name'] = $validated['title'];
            $data['meta_keywords'] = $this->parseCommaList($request->input('meta_keywords'));
            $data['is_active'] = $request->boolean('is_active');
            $data['is_published'] = $request->boolean('is_published');

            $isNew = ! $page;

            if ($isNew) {
                $data['created_by'] = auth('admin')->id();
            }
            $data['updated_by'] = auth('admin')->id();

            if ($page) {
                $page->fill($data);
                $page->save();
            } else {
                $page = Page::create($data);
            }

            $sectionOrder = $request->input('sections.order', []);
            $activeSections = $request->input('sections_active', []);
            $sectionSync = [];

            foreach ($sectionOrder as $position => $sectionId) {
                $sectionSync[$sectionId] = [
                    'display_order' => $position + 1,
                    'is_active' => isset($activeSections[$sectionId]),
                ];
            }

            $page->sections()->sync($sectionSync);

            foreach (array_keys($sectionSync) as $sectionId) {
                $this->saveSectionContent($request, $page, (int) $sectionId);
            }

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.'.($isNew ? 'create' : 'update')),
                config('constants.MODULES.page'),
                [
                    'subject_type' => Page::class,
                    'subject_id' => $page->id,
                    'new_values' => $page->getChanges(),
                    'description' => ($isNew ? 'Created' : 'Updated').' page: '.$page->name,
                ]
            );

            DB::commit();

            return redirect()->route('admin.pages.index')->with('success', 'Page saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Page saveorupdate failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, string $uuid)
    {
        $page = Page::where('uuid', $uuid)->firstOrFail();

        try {
            $page->is_active = ! $page->is_active;
            $page->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.'.($page->is_active ? 'activate' : 'deactivate')),
                config('constants.MODULES.page'),
                [
                    'subject_type' => Page::class,
                    'subject_id' => $page->id,
                    'new_values' => ['is_active' => $page->is_active],
                    'description' => 'Toggled status of page: '.$page->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $page->is_active]);
            }

            return back()->with('success', 'Status updated successfully.');
        } catch (\Throwable $e) {
            Log::error('Page togglestatus failed: '.$e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(string $uuid)
    {
        $page = Page::where('uuid', $uuid)->firstOrFail();

        try {
            $page->delete();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.delete'),
                config('constants.MODULES.page'),
                [
                    'subject_type' => Page::class,
                    'subject_id' => $page->id,
                    'description' => 'Deleted page: '.$page->name,
                ]
            );

            return back()->with('success', 'Page deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Page destroy failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    private function parseCommaList(?string $value): array
    {
        if (empty($value)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $value)), fn ($item) => $item !== ''));
    }

    // Resolves this section's field values out of the submitted
    // sections_data[{section}] payload (promoting any new file/gallery
    // uploads) and upserts the page+section content row.
    private function saveSectionContent(Request $request, Page $page, int $sectionId): void
    {
        $section = Section::with('form.fields')->find($sectionId);

        if (! $section || ! $section->form) {
            return;
        }

        $existing = PageSectionContent::where('page_id', $page->id)->where('section_id', $sectionId)->first();
        $oldData = $existing?->data ?? [];

        $data = $this->resolveSectionContentData($request, $section->form->fields, $sectionId, $oldData, $page->id);

        PageSectionContent::updateOrCreate(
            ['page_id' => $page->id, 'section_id' => $sectionId],
            ['data' => $data]
        );
    }

    private function resolveSectionContentData(Request $request, $fields, int $sectionId, array $oldData, int $pageId): array
    {
        $result = [];
        $renderedGroups = [];
        $fieldKeyFor = fn ($f) => $f->name ?: ($f->field_id ?: 'field_'.$f->id);

        foreach ($fields as $field) {
            if (! empty($field->group_key)) {
                if (in_array($field->group_key, $renderedGroups, true)) {
                    continue;
                }
                $renderedGroups[] = $field->group_key;

                $groupKey = $field->group_key;
                $groupFields = $fields->where('group_key', $groupKey)->values();
                $rawInstances = $request->input("sections_data.{$sectionId}.group_data.{$groupKey}", []);
                $oldInstances = $oldData['group_data'][$groupKey] ?? [];

                $instances = [];
                foreach ($rawInstances as $i => $rawInstance) {
                    $instanceOld = $oldInstances[$i] ?? [];
                    $instanceResult = [];

                    foreach ($groupFields as $gField) {
                        $fieldKey = $fieldKeyFor($gField);
                        $instanceResult[$fieldKey] = $this->resolveFieldValue(
                            $request,
                            $gField,
                            "sections_data.{$sectionId}.group_data.{$groupKey}.{$i}.{$fieldKey}",
                            $instanceOld[$fieldKey] ?? null,
                            "sections/{$pageId}/{$sectionId}/{$groupKey}/{$i}"
                        );
                    }

                    if ($this->isBlankInstance($instanceResult)) {
                        continue;
                    }

                    $instances[] = $instanceResult;
                }

                $result['group_data'][$groupKey] = array_values($instances);

                continue;
            }

            $fieldKey = $fieldKeyFor($field);
            $result[$fieldKey] = $this->resolveFieldValue(
                $request,
                $field,
                "sections_data.{$sectionId}.{$fieldKey}",
                $oldData[$fieldKey] ?? null,
                "sections/{$pageId}/{$sectionId}"
            );
        }

        return $result;
    }

    // Treats a repeat-group row as blank when every field in it is null, an
    // empty string, or an empty array, so it never overrides a section's
    // static fallback content with a phantom row from an unfilled repeater.
    private function isBlankInstance(array $instance): bool
    {
        foreach ($instance as $value) {
            if (is_array($value)) {
                if (! empty($value)) {
                    return false;
                }

                continue;
            }

            if ($value !== null && $value !== '') {
                return false;
            }
        }

        return true;
    }

    private function resolveFieldValue(Request $request, $field, string $dotPath, $oldValue, string $directory)
    {
        if ($field->type === 'file') {
            $tempPath = $request->input($dotPath.'_temp');
            $altText = $request->input($dotPath.'_alt');
            $oldPath = is_string($oldValue) ? $oldValue : null;

            if (! empty($tempPath)) {
                return $this->mediaUploader->promoteTemp($tempPath, $directory, $oldPath, $altText) ?: $oldValue;
            }

            if ($request->hasFile($dotPath)) {
                return $this->mediaUploader->uploadSingle($request->file($dotPath), $directory, $oldPath, [], $altText);
            }

            return $oldValue;
        }

        if ($field->type === 'gallery') {
            $rawItems = $request->input($dotPath, []);
            $items = [];

            foreach ((array) $rawItems as $item) {
                if (! empty($item['temp'])) {
                    $promoted = $this->mediaUploader->promoteTemp($item['temp'], $directory);

                    if ($promoted) {
                        $items[] = ['path' => $promoted, 'title' => $item['title'] ?? null, 'alt' => $item['alt'] ?? null];
                    }

                    continue;
                }

                if (! empty($item['path'])) {
                    $items[] = ['path' => $item['path'], 'title' => $item['title'] ?? null, 'alt' => $item['alt'] ?? null];
                }
            }

            return $items;
        }

        return $request->input($dotPath, $oldValue);
    }
}
