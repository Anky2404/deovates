<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FaqController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'faqs.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = FaqCategory::withCount('faqs')
            ->latest('id')
            ->paginate($this->pagerecords)
            ->withQueryString();

        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->input('order') as $position => $id) {
                    Faq::where('id', $id)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.faq'), [
                'description' => 'Reordered FAQs',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Faq reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    // Manages all FAQs in one category
    public function createoredit(Request $request, ?string $uuid = null)
    {
        $faqs = collect();
        $selectedCategory = null;

        if ($uuid) {
            $selectedCategory = FaqCategory::with('faqs')->where('uuid', $uuid)->firstOrFail();
            $faqs = $selectedCategory->faqs;
        }

        $categories = FaqCategory::active()->orderBy('title')->pluck('title', 'uuid');

        return view(
            $this->prefix . $this->folder . 'createoredit',
            compact('faqs', 'categories', 'selectedCategory')
        );
    }

    // Missing FAQ rows are deleted
    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $validated = $request->validate([
            'faq_category_id' => ['required', 'exists:faq_categories,uuid'],
            'faqs' => ['nullable', 'array'],
            'faqs.*.id' => ['nullable', 'integer', 'exists:faq_items,id'],
            'faqs.*.question' => ['required_with:faqs.*.answer', 'nullable', 'string', 'max:2000'],
            'faqs.*.answer' => ['nullable', 'string'],
            'faqs.*.display_order' => ['nullable', 'integer'],
        ]);

        try {
            DB::beginTransaction();

            $category = FaqCategory::where('uuid', $validated['faq_category_id'])->firstOrFail();

            $items = collect($validated['faqs'] ?? [])
                ->filter(fn ($item) => ! empty($item['question']))
                ->values();

            $submittedIds = $items->pluck('id')->filter()->map(fn ($v) => (int) $v)->all();

            // Delete FAQs dropped from submission
            $category->faqs()
                ->whereNotIn('id', $submittedIds ?: [0])
                ->get()
                ->each(function (Faq $stale) use ($category) {
                    $oldValues = $stale->getAttributes();
                    $stale->delete();

                    ActivityLog::log(
                        config('constants.ACTIVITY_ACTIONS.delete'),
                        config('constants.MODULES.faq'),
                        [
                            'subject_type' => Faq::class,
                            'subject_id' => $stale->id,
                            'old_values' => $oldValues,
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

                    $oldValues = $faq->getOriginal();

                    $faq->update([
                        'question' => $item['question'],
                        'answer' => $item['answer'] ?? '',
                        'display_order' => $item['display_order'] ?? 0,
                    ]);

                    if ($faq->wasChanged()) {
                        ActivityLog::log(
                            config('constants.ACTIVITY_ACTIONS.update'),
                            config('constants.MODULES.faq'),
                            [
                                'subject_type' => Faq::class,
                                'subject_id' => $faq->id,
                                'old_values' => Arr::only($oldValues, array_keys($faq->getChanges())),
                                'new_values' => $faq->getChanges(),
                                'description' => "Updated FAQ \"{$faq->question}\".",
                            ]
                        );
                    }
                } else {
                    $newFaq = Faq::create([
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
                            'subject_id' => $newFaq->id,
                            'new_values' => $newFaq->getAttributes(),
                            'description' => "Created FAQ \"{$newFaq->question}\" under category \"{$category->title}\".",
                        ]
                    );
                }
            }

            DB::commit();

            return redirect()->route('admin.faqs.createoredit', $category->uuid)->with('success', 'FAQs saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Faq saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $faq = Faq::findOrFail($id);
            $faq->delete();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.delete'),
                config('constants.MODULES.faq'),
                [
                    'subject_type' => Faq::class,
                    'subject_id' => $faq->id,
                    'description' => "Deleted FAQ \"{$faq->question}\".",
                ]
            );

            DB::commit();

            return back()->with('success', 'FAQ deleted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Faq destroy failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $faq = Faq::findOrFail($id);
            $faq->is_active = ! $faq->is_active;
            $faq->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($faq->is_active ? 'activate' : 'deactivate')),
                config('constants.MODULES.faq'),
                [
                    'subject_type' => Faq::class,
                    'subject_id' => $faq->id,
                    'description' => 'FAQ status toggled to ' . ($faq->is_active ? 'active' : 'inactive') . '.',
                ]
            );

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $faq->is_active]);
            }

            return back()->with('success', 'FAQ status updated.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Faq togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
