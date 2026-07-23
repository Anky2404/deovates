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

class TemplateController extends Controller
{
    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'templates.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Template::latest('id')->paginate($this->pagerecords)->withQueryString();
        $reorderRows = Template::orderBy('display_order')->orderBy('id')->get();

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
                    Template::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.template'), [
                'description' => 'Reordered templates',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Template reorder failed: '.$e->getMessage(), ['exception' => $e]);

            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function createoredit(Request $request, ?string $uuid = null)
    {
        $template = null;

        if ($uuid) {
            try {
                $template = Template::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('Template createoredit lookup failed: '.$e->getMessage(), ['exception' => $e]);

                return redirect()->route('admin.templates.index')->with('error', 'Unable to load the requested template.');
            }
        }

        return view($this->prefix.$this->folder.'createoredit', compact('template'));
    }

    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $template = $uuid ? Template::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('templates', 'slug')->ignore($template?->id)],
            'type' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'layouts' => ['nullable', 'string'],
            'settings' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'is_default' => ['nullable', 'boolean'],
            'usage_count' => ['nullable', 'integer', 'min:0'],
        ]);

        // Never let bad JSON crash the save
        $decodedLayouts = json_decode($data['layouts'] ?? '', true);
        $data['layouts'] = is_array($decodedLayouts) ? $decodedLayouts : [];

        $decodedSettings = json_decode($data['settings'] ?? '', true);
        $data['settings'] = is_array($decodedSettings) ? $decodedSettings : [];

        $data['is_active'] = $request->boolean('is_active');
        $data['is_default'] = $request->boolean('is_default');
        $data['usage_count'] = $data['usage_count'] ?? 0;

        try {
            DB::beginTransaction();

            if ($template) {
                $template->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated template '.$template->name;
            } else {
                $template = Template::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created template '.$template->name;
            }

            ActivityLog::log($action, config('constants.MODULES.template'), [
                'subject_type' => Template::class,
                'subject_id' => $template->id,
                'new_values' => $template->getChanges(),
                'description' => $description,
            ]);

            DB::commit();

            return redirect()->route('admin.templates.index')->with('success', 'Template saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Template saveorupdate failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, string $uuid)
    {
        try {
            $template = Template::where('uuid', $uuid)->firstOrFail();
            $template->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.template'), [
                'subject_type' => Template::class,
                'subject_id' => $template->id,
                'description' => 'Deleted template '.$template->name,
            ]);

            return back()->with('success', 'Template deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Template destroy failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, string $uuid)
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
                    'description' => ($template->is_active ? 'Activated' : 'Deactivated').' template '.$template->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $template->is_active]);
            }

            return back()->with('success', 'Template status updated.');
        } catch (\Throwable $e) {
            Log::error('Template togglestatus failed: '.$e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
