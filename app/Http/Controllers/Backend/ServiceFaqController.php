<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Service;
use App\Models\ServiceFaq;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceFaqController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'services.faqs.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    // Index Function
    public function index(Request $request)
    {
        $rows = ServiceFaq::with('service')->latest('id')->paginate($this->pagerecords)->withQueryString();
        $reorderRows = ServiceFaq::orderBy('display_order')->orderBy('id')->get();
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
                    ServiceFaq::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.servicefaq'), [
                'description' => 'Reordered service FAQs',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('ServiceFaq reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    // Create / Edit Function
    public function createoredit(Request $request, $uuid = null)
    {
        $faq = null;

        if ($uuid) {
            try {
                $faq = ServiceFaq::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('ServiceFaq createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.services.faqs.index')->with('error', 'Unable to load the requested service FAQ.');
            }
        }

        $services = Service::active()->orderBy('title')->pluck('title', 'id');

        return view($this->prefix . $this->folder . 'createoredit', compact('faq', 'services'));
    }

    // Save / Update Function
    //
    // The createoredit view is a bulk FAQ builder: it lets the admin pick one
    // service and add any number of question/answer rows in a single submit.
    // When a uuid is present (editing a single existing FAQ), only the first
    // submitted row is applied to that record; otherwise every row becomes a
    // new ServiceFaq for the chosen service.
    public function saveorupdate(Request $request, $uuid = null)
    {
        $data = $request->validate([
            'service_id' => 'required|exists:services,id',
            'faqs' => 'required|array|min:1',
            'faqs.*.question' => 'required|string|max:500',
            'faqs.*.answer' => 'required|string',
            'faqs.*.display_order' => 'nullable|integer|min:0',
        ]);

        try {
            DB::beginTransaction();

            $affected = [];

            if ($uuid) {
                $faq = ServiceFaq::where('uuid', $uuid)->firstOrFail();
                $first = $data['faqs'][0];

                $faq->update([
                    'service_id' => $data['service_id'],
                    'question' => $first['question'],
                    'answer' => $first['answer'],
                    'display_order' => $first['display_order'] ?? $faq->display_order,
                ]);

                $affected[] = $faq;
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated service FAQ ' . $faq->question;
            } else {
                foreach ($data['faqs'] as $index => $row) {
                    $affected[] = ServiceFaq::create([
                        'service_id' => $data['service_id'],
                        'question' => $row['question'],
                        'answer' => $row['answer'],
                        'display_order' => $row['display_order'] ?? $index,
                        'is_active' => true,
                    ]);
                }

                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = count($affected) . ' service FAQ(s) created';
            }

            foreach ($affected as $faq) {
                ActivityLog::log($action, config('constants.MODULES.servicefaq'), [
                    'subject_type' => ServiceFaq::class,
                    'subject_id' => $faq->id,
                    'new_values' => $faq->getChanges(),
                    'description' => $description,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.services.faqs.index')->with('success', 'Service FAQ(s) saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ServiceFaq saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Destroy Function
    public function destroy(Request $request, $uuid)
    {
        try {
            $faq = ServiceFaq::where('uuid', $uuid)->firstOrFail();
            $faq->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.servicefaq'), [
                'subject_type' => ServiceFaq::class,
                'subject_id' => $faq->id,
                'description' => 'Deleted service FAQ ' . $faq->question,
            ]);

            return back()->with('success', 'Service FAQ deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('ServiceFaq destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Toggle Status Function
    public function togglestatus(Request $request, $uuid)
    {
        try {
            $faq = ServiceFaq::where('uuid', $uuid)->firstOrFail();
            $faq->is_active = ! $faq->is_active;
            $faq->save();

            ActivityLog::log(
                $faq->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.servicefaq'),
                [
                    'subject_type' => ServiceFaq::class,
                    'subject_id' => $faq->id,
                    'description' => ($faq->is_active ? 'Activated' : 'Deactivated') . ' service FAQ ' . $faq->question,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $faq->is_active]);
            }

            return back()->with('success', 'Service FAQ status updated.');
        } catch (\Throwable $e) {
            Log::error('ServiceFaq togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Toggle Featured Function
    public function togglefeatured(Request $request, $uuid)
    {
        try {
            $faq = ServiceFaq::where('uuid', $uuid)->firstOrFail();
            $faq->is_featured = ! $faq->is_featured;
            $faq->save();

            ActivityLog::log(
                $faq->is_featured ? config('constants.ACTIVITY_ACTIONS.feature') : config('constants.ACTIVITY_ACTIONS.unfeature'),
                config('constants.MODULES.servicefaq'),
                [
                    'subject_type' => ServiceFaq::class,
                    'subject_id' => $faq->id,
                    'description' => ($faq->is_featured ? 'Marked featured' : 'Unmarked featured') . ' service FAQ ' . $faq->question,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $faq->is_featured]);
            }

            return back()->with('success', 'Service FAQ featured status updated.');
        } catch (\Throwable $e) {
            Log::error('ServiceFaq togglefeatured failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
