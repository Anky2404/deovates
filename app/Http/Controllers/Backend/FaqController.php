<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
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
        $rows = Faq::with('category')
            ->latest('id')
            ->paginate($this->pagerecords)
            ->withQueryString();

        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    public function createoredit(Request $request, ?string $id = null)
    {
        // The route parameter is historically named {uuid}, but Faq has no
        // uuid column (no HasUuid trait) — it is really the numeric id.
        $faq = $id ? Faq::findOrFail($id) : null;

        $categories = FaqCategory::active()->orderBy('title')->pluck('title', 'id');

        return view($this->prefix . $this->folder . 'createoredit', compact('faq', 'categories'));
    }

    /**
     * The create/edit view submits a single faq_category_id plus a "faqs"
     * array of {question, answer, display_order} rows (no per-row id — see
     * resources/views/backend/faqs/createoredit.blade.php). When editing,
     * the first row updates the targeted Faq; any additional rows added via
     * the "+ Add FAQ" button are created as new Faq records under the same
     * category. When creating, every row becomes a new Faq record.
     */
    public function saveorupdate(Request $request, ?string $id = null)
    {
        $validated = $request->validate([
            'faq_category_id' => ['required', 'exists:faq_categories,id'],
            'faqs' => ['required', 'array', 'min:1'],
            'faqs.*.question' => ['required', 'string', 'max:2000'],
            'faqs.*.answer' => ['required', 'string'],
            'faqs.*.display_order' => ['nullable', 'integer'],
        ]);

        $isActive = $request->boolean('is_active', true);
        $items = array_values($validated['faqs']);
        $categoryId = $validated['faq_category_id'];

        try {
            DB::beginTransaction();

            $updatedFaq = null;

            if ($id) {
                $updatedFaq = Faq::findOrFail($id);
                $first = array_shift($items);

                $updatedFaq->update([
                    'faq_category_id' => $categoryId,
                    'question' => $first['question'],
                    'answer' => $first['answer'],
                    'display_order' => $first['display_order'] ?? 0,
                    'is_active' => $isActive,
                ]);

                ActivityLog::log(
                    config('constants.ACTIVITY_ACTIONS.update'),
                    config('constants.MODULES.faq'),
                    [
                        'subject_type' => Faq::class,
                        'subject_id' => $updatedFaq->id,
                        'new_values' => $updatedFaq->getChanges(),
                        'description' => "Updated FAQ \"{$updatedFaq->question}\".",
                    ]
                );
            }

            foreach ($items as $item) {
                if (empty($item['question'])) {
                    continue;
                }

                $newFaq = Faq::create([
                    'faq_category_id' => $categoryId,
                    'question' => $item['question'],
                    'answer' => $item['answer'] ?? '',
                    'display_order' => $item['display_order'] ?? 0,
                    'is_active' => $isActive,
                ]);

                ActivityLog::log(
                    config('constants.ACTIVITY_ACTIONS.create'),
                    config('constants.MODULES.faq'),
                    [
                        'subject_type' => Faq::class,
                        'subject_id' => $newFaq->id,
                        'new_values' => $newFaq->getAttributes(),
                        'description' => "Created FAQ \"{$newFaq->question}\".",
                    ]
                );
            }

            DB::commit();

            return redirect()->route('admin.faqs.index')->with('success', 'FAQ saved successfully.');
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
