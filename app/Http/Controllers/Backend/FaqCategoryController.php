<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class FaqCategoryController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'faqs.categories.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = FaqCategory::withCount('faqs')->latest('id')->paginate($this->pagerecords)->withQueryString();
        $reorderRows = FaqCategory::orderBy('display_order')->orderBy('id')->get();

        return view($this->prefix . $this->folder . 'index', compact('rows', 'reorderRows'));
    }

    // Persist a drag-and-drop order from the reorder modal on the index page.
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->input('order') as $position => $uuid) {
                    FaqCategory::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.faqcategory'), [
                'description' => 'Reordered FAQ categories',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('FaqCategory reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function createoredit(Request $request, ?string $uuid = null)
    {
        $category = $uuid ? FaqCategory::with('faqs')->where('uuid', $uuid)->firstOrFail() : null;

        return view($this->prefix . $this->folder . 'createoredit', compact('category'));
    }

    /**
     * The create/edit view manages the category fields alongside a nested
     * "faqs" array, each row optionally carrying an "id" (existing Faq) —
     * see resources/views/backend/faqs/categories/createoredit.blade.php.
     * Rows with an id are updated, rows without one are created, and any
     * existing FAQ under this category that is missing from the submission
     * (i.e. removed via the "Remove" button) is soft-deleted.
     */
    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $category = $uuid ? FaqCategory::where('uuid', $uuid)->firstOrFail() : null;

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('faq_categories', 'slug')->ignore($category?->id)],
            'page' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'faqs' => ['nullable', 'array'],
            'faqs.*.id' => ['nullable', 'integer', 'exists:faq_items,id'],
            'faqs.*.question' => ['required_with:faqs.*.answer', 'nullable', 'string', 'max:2000'],
            'faqs.*.answer' => ['nullable', 'string'],
            'faqs.*.display_order' => ['nullable', 'integer'],
        ]);

        try {
            DB::beginTransaction();

            $category = $category ?? new FaqCategory();
            $isNew = ! $category->exists;

            $category->fill([
                'title' => $validated['title'],
                'slug' => $validated['slug'] ?? null,
                'page' => $validated['page'] ?? null,
                'short_description' => $validated['short_description'] ?? null,
                'is_active' => $request->boolean('is_active', true),
            ]);
            $category->save();

            $items = collect($validated['faqs'] ?? [])
                ->filter(fn ($item) => ! empty($item['question']))
                ->values();

            $submittedIds = $items->pluck('id')->filter()->map(fn ($v) => (int) $v)->all();

            // Remove FAQs that used to belong to this category but were
            // dropped from the submitted list via the "Remove" button.
            $category->faqs()
                ->whereNotIn('id', $submittedIds ?: [0])
                ->get()
                ->each(function (Faq $stale) use ($category) {
                    $stale->delete();

                    ActivityLog::log(
                        config('constants.ACTIVITY_ACTIONS.delete'),
                        config('constants.MODULES.faq'),
                        [
                            'subject_type' => Faq::class,
                            'subject_id' => $stale->id,
                            'description' => "Removed FAQ \"{$stale->question}\" from category \"{$category->title}\".",
                        ]
                    );
                });

            foreach ($items as $item) {
                if (! empty($item['id'])) {
                    $faq = $category->faqs()->whereKey($item['id'])->first();

                    if (! $faq) {
                        continue;
                    }

                    $faq->update([
                        'question' => $item['question'],
                        'answer' => $item['answer'] ?? '',
                        'display_order' => $item['display_order'] ?? 0,
                    ]);

                    ActivityLog::log(
                        config('constants.ACTIVITY_ACTIONS.update'),
                        config('constants.MODULES.faq'),
                        [
                            'subject_type' => Faq::class,
                            'subject_id' => $faq->id,
                            'new_values' => $faq->getChanges(),
                            'description' => "Updated FAQ \"{$faq->question}\".",
                        ]
                    );
                } else {
                    $faq = Faq::create([
                        'faq_category_id' => $category->id,
                        'question' => $item['question'],
                        'answer' => $item['answer'] ?? '',
                        'display_order' => $item['display_order'] ?? 0,
                        'is_active' => true,
                    ]);

                    ActivityLog::log(
                        config('constants.ACTIVITY_ACTIONS.create'),
                        config('constants.MODULES.faq'),
                        [
                            'subject_type' => Faq::class,
                            'subject_id' => $faq->id,
                            'new_values' => $faq->getAttributes(),
                            'description' => "Created FAQ \"{$faq->question}\" under category \"{$category->title}\".",
                        ]
                    );
                }
            }

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($isNew ? 'create' : 'update')),
                config('constants.MODULES.faqcategory'),
                [
                    'subject_type' => FaqCategory::class,
                    'subject_id' => $category->id,
                    'new_values' => $category->getChanges(),
                    'description' => ($isNew ? 'Created' : 'Updated') . " FAQ category \"{$category->title}\".",
                ]
            );

            DB::commit();

            return redirect()->route('admin.faqs.categories.index')->with('success', 'FAQ category saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('FaqCategory saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, string $uuid)
    {
        try {
            DB::beginTransaction();

            $category = FaqCategory::where('uuid', $uuid)->firstOrFail();
            $category->delete();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.delete'),
                config('constants.MODULES.faqcategory'),
                [
                    'subject_type' => FaqCategory::class,
                    'subject_id' => $category->id,
                    'description' => "Deleted FAQ category \"{$category->title}\".",
                ]
            );

            DB::commit();

            return back()->with('success', 'FAQ category deleted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('FaqCategory destroy failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, string $uuid)
    {
        try {
            DB::beginTransaction();

            $category = FaqCategory::where('uuid', $uuid)->firstOrFail();
            $category->is_active = ! $category->is_active;
            $category->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($category->is_active ? 'activate' : 'deactivate')),
                config('constants.MODULES.faqcategory'),
                [
                    'subject_type' => FaqCategory::class,
                    'subject_id' => $category->id,
                    'description' => 'FAQ category status toggled to ' . ($category->is_active ? 'active' : 'inactive') . '.',
                ]
            );

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $category->is_active]);
            }

            return back()->with('success', 'FAQ category status updated.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('FaqCategory togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
