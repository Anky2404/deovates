<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Form;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class FormController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'pages.layouts.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    // Index Function
    public function index(Request $request)
    {
        $rows = Form::orderBy('display_order')->orderBy('id')->paginate($this->pagerecords)->withQueryString();
        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    // Create / Edit Function
    public function createoredit(Request $request, $uuid = null)
    {
        $form = null;

        if ($uuid) {
            try {
                $form = Form::with('fields')->where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('Form createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.pages.forms.index')->with('error', 'Unable to load the requested form.');
            }
        }

        return view($this->prefix . $this->folder . 'createoredit', compact('form'));
    }

    // Details Function (read-only live preview)
    public function details(Request $request, $uuid)
    {
        try {
            $form = Form::with('fields')->where('uuid', $uuid)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (\Throwable $e) {
            Log::error('Form details lookup failed: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->route('admin.pages.forms.index')->with('error', 'Unable to load the requested form.');
        }

        return view($this->prefix . $this->folder . 'details', compact('form'));
    }

    // Save / Update Function
    public function saveorupdate(Request $request, $uuid = null)
    {
        $form = $uuid ? Form::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('forms', 'slug')->ignore($form?->id)],
            'heading' => 'nullable|string|max:255',
            'paragraph' => 'nullable|string',
            'action' => 'required|string|max:255',
            'action_type' => 'required|in:create,edit,toggle',
            'heading_align' => 'nullable|in:left,center,right',
            'style' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'fields' => 'nullable|array',
        ]);

        $data['form_type'] = $data['action_type'];
        unset($data['action_type'], $data['fields']);

        $data['is_active'] = $request->boolean('is_active');

        try {
            DB::beginTransaction();

            $oldValues = $form ? array_intersect_key($form->getAttributes(), $data) : [];

            if ($form) {
                $form->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated form ' . $form->name;
            } else {
                $data['display_order'] = (Form::max('display_order') ?? 0) + 1;
                $form = Form::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created form ' . $form->name;
            }

            $this->syncFields($form, $request->input('fields', []));

            $newValues = collect($form->getChanges())->except('updated_at')->toArray();
            $oldValues = collect($oldValues)->only(array_keys($newValues))->toArray();

            ActivityLog::log($action, config('constants.MODULES.form'), [
                'subject_type' => Form::class,
                'subject_id' => $form->id,
                'old_values' => $oldValues,
                'new_values' => $newValues,
                'description' => $description,
            ]);

            DB::commit();

            return redirect()->route('admin.pages.forms.index')->with('success', 'Form saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Form saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Sync fields from the createoredit form rows (create/update/delete).
    private function syncFields(Form $form, array $rows): void
    {
        $keepIds = [];

        foreach ($rows as $index => $row) {
            if (empty($row['label']) || empty($row['type'])) {
                continue;
            }

            $decodedOptions = json_decode($row['options'] ?? '', true);

            $data = [
                'name' => $row['name'] ?? null,
                'label' => $row['label'],
                'type' => $row['type'],
                'is_multiple' => !empty($row['is_multiple']) && $row['is_multiple'] !== '0',
                'group_key' => $row['group_key'] ?? null,
                'enable_croppie' => !array_key_exists('enable_croppie', $row) || ($row['enable_croppie'] !== '0' && $row['enable_croppie'] !== false),
                'field_id' => $row['field_id'] ?? null,
                'class' => $row['class'] ?? null,
                'required' => !empty($row['required']) && $row['required'] !== '0',
                'disabled' => !empty($row['disabled']) && $row['disabled'] !== '0',
                'use_ck_editor' => !empty($row['use_ck_editor']) && $row['use_ck_editor'] !== '0',
                'add_country_code' => !empty($row['add_country_code']) && $row['add_country_code'] !== '0',
                'placeholder' => $row['placeholder'] ?? null,
                'field_width' => $row['field_width'] ?? 12,
                'options' => is_array($decodedOptions) ? $decodedOptions : [],
                'sort_order' => $row['sort_order'] ?? $index,
            ];

            $field = !empty($row['id']) ? $form->fields()->find($row['id']) : null;
            $field ? $field->update($data) : $field = $form->fields()->create($data);

            $keepIds[] = $field->id;
        }

        $form->fields()->whereNotIn('id', $keepIds)->delete();
    }

    // Destroy Function
    public function destroy(Request $request, $uuid)
    {
        try {
            $form = Form::where('uuid', $uuid)->firstOrFail();
            $form->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.form'), [
                'subject_type' => Form::class,
                'subject_id' => $form->id,
                'description' => 'Deleted form ' . $form->name,
            ]);

            return back()->with('success', 'Form deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Form destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Toggle Status Function
    public function togglestatus(Request $request, $uuid)
    {
        try {
            $form = Form::where('uuid', $uuid)->firstOrFail();
            $form->is_active = !$form->is_active;
            $form->save();

            ActivityLog::log(
                $form->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.form'),
                [
                    'subject_type' => Form::class,
                    'subject_id' => $form->id,
                    'description' => ($form->is_active ? 'Activated' : 'Deactivated') . ' form ' . $form->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $form->is_active]);
            }

            return back()->with('success', 'Form status updated.');
        } catch (\Throwable $e) {
            Log::error('Form togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
