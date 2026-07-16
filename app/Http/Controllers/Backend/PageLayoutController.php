<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Form;
use App\Models\FormField;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PageLayoutController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'pages.layouts.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Form::latest('id')->paginate($this->pagerecords)->withQueryString();

        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    public function details(string $uuid)
    {
        $form = Form::with('fields')->where('uuid', $uuid)->firstOrFail();

        return view($this->prefix . $this->folder . 'details', compact('form'));
    }

    public function createoredit(?string $uuid = null)
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

    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $form = $uuid ? Form::where('uuid', $uuid)->firstOrFail() : null;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('forms', 'slug')->ignore($form?->id)],
            'heading' => ['nullable', 'string', 'max:255'],
            'paragraph' => ['nullable', 'string'],
            'action' => ['required', 'string', 'max:255'],
            'action_type' => ['nullable', 'string', 'in:create,edit,toggle'],
            'heading_align' => ['nullable', 'string', 'in:left,center,right'],
            'style' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable'],
            'fields' => ['nullable', 'array'],
            'fields.*.name' => ['required_with:fields', 'string', 'max:255'],
            'fields.*.label' => ['nullable', 'string', 'max:255'],
            'fields.*.type' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            DB::beginTransaction();

            $data = [
                'name' => $validated['name'],
                'slug' => $validated['slug'],
                'heading' => $validated['heading'] ?? null,
                'paragraph' => $validated['paragraph'] ?? null,
                'action' => $validated['action'],
                'form_type' => $validated['action_type'] ?? null,
                'heading_align' => $validated['heading_align'] ?? null,
                'style' => $validated['style'] ?? null,
                'is_active' => $request->boolean('is_active', true),
            ];

            $isNew = ! $form;

            if ($isNew) {
                $form = Form::create($data);
            } else {
                $form->update($data);
            }

            $this->syncFields($form, $request->input('fields', []));

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($isNew ? 'create' : 'update')),
                config('constants.MODULES.form'),
                [
                    'subject_type' => Form::class,
                    'subject_id' => $form->id,
                    'new_values' => $form->getChanges(),
                    'description' => ($isNew ? 'Created' : 'Updated') . ' form: ' . $form->name,
                ]
            );

            DB::commit();

            return redirect()->route('admin.pages.forms.index')->with('success', 'Form saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Form saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Fields arrive as fields[{index}][...]; rows with an existing "id" are
    // updated in place, rows without one are new, and any field that
    // belonged to this form but wasn't resubmitted (removed in the builder)
    // is deleted.
    private function syncFields(Form $form, array $rows): void
    {
        $keepIds = [];

        foreach ($rows as $position => $row) {
            if (empty($row['name'])) {
                continue;
            }

            $fieldData = [
                'form_id' => $form->id,
                'name' => $row['name'],
                'label' => $row['label'] ?? null,
                'type' => $row['type'] ?? 'text',
                'field_id' => $row['field_id'] ?? null,
                'class' => $row['class'] ?? null,
                'required' => !empty($row['required']),
                'disabled' => !empty($row['disabled']),
                'use_ck_editor' => !empty($row['use_ck_editor']),
                'add_country_code' => !empty($row['add_country_code']),
                'placeholder' => $row['placeholder'] ?? null,
                'field_width' => $row['field_width'] ?? '12',
                'options' => $this->parseCommaList($row['options'] ?? null),
                'sort_order' => $row['sort_order'] ?? $position,
                'is_active' => true,
            ];

            $field = !empty($row['id']) ? FormField::where('form_id', $form->id)->find($row['id']) : null;

            if ($field) {
                $field->update($fieldData);
            } else {
                $field = FormField::create($fieldData);
            }

            $keepIds[] = $field->id;
        }

        $form->fields()->whereNotIn('id', $keepIds)->delete();
    }

    private function parseCommaList(?string $value): array
    {
        if (empty($value)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $value)), fn ($item) => $item !== ''));
    }

    public function togglestatus(Request $request, string $uuid)
    {
        try {
            $form = Form::where('uuid', $uuid)->firstOrFail();
            $form->is_active = ! $form->is_active;
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

    public function destroy(Request $request, string $uuid)
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
}
