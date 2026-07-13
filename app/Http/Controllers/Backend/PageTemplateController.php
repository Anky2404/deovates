<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Template;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

/**
 * Second admin nav entry over the shared `templates` table (App\Models\Template),
 * scoped to type = "page" so it only ever lists/creates page templates. The
 * top-level Templates module (App\Http\Controllers\Backend\TemplateController)
 * manages the same table without this scoping.
 */
class PageTemplateController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'pages.templates.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    // Index Function
    public function index(Request $request)
    {
        $rows = Template::where('type', 'page')
            ->orWhereNull('type')
            ->latest('id')
            ->paginate($this->pagerecords)
            ->withQueryString();

        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    // Create / Edit Function
    public function createoredit(Request $request, $uuid = null)
    {
        $template = null;

        if ($uuid) {
            try {
                $template = Template::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('PageTemplate createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.pages.templates.index')->with('error', 'Unable to load the requested template.');
            }
        }

        return view($this->prefix . $this->folder . 'createoredit', compact('template'));
    }

    // Save / Update Function
    public function saveorupdate(Request $request, $uuid = null)
    {
        $template = $uuid ? Template::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('templates', 'slug')->ignore($template?->id)],
            'description' => ['nullable', 'string'],
            'layouts' => ['nullable', 'string'],
            'settings' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'is_default' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // This controller is scoped to page templates only.
        $data['type'] = 'page';

        // JSON-auto textareas: decode safely, never let bad JSON crash the save.
        $decodedLayouts = json_decode($data['layouts'] ?? '', true);
        $data['layouts'] = is_array($decodedLayouts) ? $decodedLayouts : [];

        $decodedSettings = json_decode($data['settings'] ?? '', true);
        $data['settings'] = is_array($decodedSettings) ? $decodedSettings : [];

        $data['is_default'] = $request->boolean('is_default');
        $data['is_active'] = $request->boolean('is_active');

        try {
            DB::beginTransaction();

            if ($template) {
                $template->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated page template ' . $template->name;
            } else {
                $template = Template::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created page template ' . $template->name;
            }

            ActivityLog::log($action, config('constants.MODULES.template'), [
                'subject_type' => Template::class,
                'subject_id' => $template->id,
                'new_values' => $template->getChanges(),
                'description' => $description,
            ]);

            DB::commit();

            return redirect()->route('admin.pages.templates.index')->with('success', 'Template saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('PageTemplate saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Destroy Function
    public function destroy(Request $request, $uuid)
    {
        try {
            DB::beginTransaction();

            $template = Template::where('uuid', $uuid)->firstOrFail();
            $template->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.template'), [
                'subject_type' => Template::class,
                'subject_id' => $template->id,
                'description' => 'Deleted page template ' . $template->name,
            ]);

            DB::commit();

            return back()->with('success', 'Template deleted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('PageTemplate destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Toggle Status Function
    public function togglestatus(Request $request, $uuid)
    {
        try {
            $template = Template::where('uuid', $uuid)->firstOrFail();
            $template->is_active = ! $template->is_active;
            $template->save();

            ActivityLog::log(
                $template->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.template'),
                [
                    'subject_type' => Template::class,
                    'subject_id' => $template->id,
                    'description' => ($template->is_active ? 'Activated' : 'Deactivated') . ' page template ' . $template->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $template->is_active]);
            }

            return back()->with('success', 'Template status updated.');
        } catch (\Throwable $e) {
            Log::error('PageTemplate togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
