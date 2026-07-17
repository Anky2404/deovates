@extends('backend.layouts.app')

@section('title', isset($form) ? 'Edit Form Layout' : 'Create Form Layout')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">{{ isset($form) ? 'Edit Form Layout' : 'Create Form Layout' }}</h5>
    </div>

  <form id="dynamicForm"
      method="POST"
      action="{{ route('admin.pages.forms.saveorupdate', ['uuid' => $form->uuid ?? null]) }}">
    @csrf

        <div class="card-body">

            {{-- ================= FORM META ================= --}}
            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Form Name</label>
                    <input type="text" name="name" class="form-control" id="title_input"
                           value="{{ $form->name ?? '' }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" id="slug_input"
                           value="{{ $form->slug ?? '' }}" required>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Heading</label>
                    <input type="text" name="heading" class="form-control"
                           value="{{ $form->heading ?? '' }}">
                </div>

                <div class="col-md-12">
                    <label class="form-label">Paragraph</label>
                    <textarea name="paragraph" class="form-control" rows="2">{{ $form->paragraph ?? '' }}</textarea>
                </div>

                {{-- ===== ROUTE BUILDER ===== --}}
                <div class="col-md-6">
                    <label class="form-label">Action Route</label>
                    <input type="text"
                           name="action"
                           id="action"
                           class="form-control"
                           placeholder="abc.page"
                           value="{{ $form->action ?? '' }}"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Action Type</label>
                    <select name="action_type" id="action_type" class="form-select" required>
                        <option value="">-- Select --</option>
                        <option value="create" {{ ($form->form_type ?? '')=='create'?'selected':'' }}>Create</option>
                        <option value="edit" {{ ($form->form_type ?? '')=='edit'?'selected':'' }}>Edit</option>
                        <option value="toggle" {{ ($form->form_type ?? '')=='toggle'?'selected':'' }}>Toggle</option>
                    </select>
                </div>



                <div class="col-md-6">
                    <label class="form-label">Heading Alignment</label>
                    <select name="heading_align" class="form-select">
                        <option value="left" {{ ($form->heading_align ?? '')=='left'?'selected':'' }}>Left</option>
                        <option value="center" {{ ($form->heading_align ?? '')=='center'?'selected':'' }}>Center</option>
                        <option value="right" {{ ($form->heading_align ?? '')=='right'?'selected':'' }}>Right</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Form Style (CSS Class)</label>
                    <input type="text" name="style" class="form-control"
                           value="{{ $form->style ?? '' }}">
                </div>

                <div class="col-md-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox"
                               name="is_active" value="1"
                               {{ !isset($form) || $form->is_active ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>

            </div>

            <hr class="my-4">

            {{-- ================= ADD FIELD ================= --}}
            <button type="button" class="btn btn-primary mb-3" onclick="openAddModal()">+ Add Field</button>
            <button type="button" class="btn btn-outline-primary mb-3 ms-2" onclick="openGroupModal()">+ Add Repeat Field</button>

            {{-- ================= FIELD PREVIEW ================= --}}
            <div class="row" id="fieldPreview">
                @if(isset($form))
                    @php
                        $renderedGroupKeys = [];
                        $globalIdx = 0;
                    @endphp

                    @foreach($form->fields as $field)
                        @continue(!empty($field->group_key) && in_array($field->group_key, $renderedGroupKeys))

                        @if(!empty($field->group_key))
                            @php
                                $renderedGroupKeys[] = $field->group_key;
                                $groupFields = $form->fields->where('group_key', $field->group_key)->values();
                            @endphp

                            <div class="col-md-12 mb-3 field-wrapper group-wrapper"
                                 data-group-key="{{ $field->group_key }}"
                                 data-group-label="{{ \Illuminate\Support\Str::headline($field->group_key) }}">
                                <div class="card shadow-sm field-card border-info position-relative"
                                     onclick="editGroupWrapper(this)">
                                    <div class="card-body p-2">
                                        <span class="badge bg-info">Repeat Group</span>
                                        <strong class="ms-1">{{ \Illuminate\Support\Str::headline($field->group_key) }}</strong>
                                        <button type="button"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                                                onclick="event.stopPropagation(); removeGroupWrapper(event, this)">&times;</button>
                                        <div class="mt-2">
                                            @foreach($groupFields as $gf)
                                                <span class="badge bg-secondary me-1">{{ $gf->label }} ({{ $gf->type }})</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                @foreach($groupFields as $gf)
                                    <input type="hidden" name="fields[{{ $globalIdx }}][id]" value="{{ $gf->id }}">
                                    <input type="hidden" name="fields[{{ $globalIdx }}][name]" value="{{ $gf->name }}">
                                    <input type="hidden" name="fields[{{ $globalIdx }}][label]" value="{{ $gf->label }}">
                                    <input type="hidden" name="fields[{{ $globalIdx }}][type]" value="{{ $gf->type }}">
                                    <input type="hidden" name="fields[{{ $globalIdx }}][is_multiple]" value="{{ $gf->is_multiple ? 1 : 0 }}">
                                    <input type="hidden" name="fields[{{ $globalIdx }}][group_key]" value="{{ $gf->group_key }}">
                                    <input type="hidden" name="fields[{{ $globalIdx }}][enable_croppie]" value="{{ $gf->enable_croppie ? 1 : 0 }}">
                                    <input type="hidden" name="fields[{{ $globalIdx }}][field_id]" value="{{ $gf->field_id }}">
                                    <input type="hidden" name="fields[{{ $globalIdx }}][class]" value="{{ $gf->class }}">
                                    <input type="hidden" name="fields[{{ $globalIdx }}][required]" value="{{ $gf->required ? 1 : 0 }}">
                                    <input type="hidden" name="fields[{{ $globalIdx }}][disabled]" value="{{ $gf->disabled ? 1 : 0 }}">
                                    <input type="hidden" name="fields[{{ $globalIdx }}][use_ck_editor]" value="{{ $gf->use_ck_editor ? 1 : 0 }}">
                                    <input type="hidden" name="fields[{{ $globalIdx }}][add_country_code]" value="{{ $gf->add_country_code ? 1 : 0 }}">
                                    <input type="hidden" name="fields[{{ $globalIdx }}][placeholder]" value="{{ $gf->placeholder }}">
                                    <input type="hidden" name="fields[{{ $globalIdx }}][field_width]" value="{{ $gf->field_width }}">
                                    <input type="hidden" name="fields[{{ $globalIdx }}][options]" value="{{ json_encode($gf->options ?? []) }}">
                                    <input type="hidden" name="fields[{{ $globalIdx }}][sort_order]" value="{{ $gf->sort_order }}">
                                    @php $globalIdx++; @endphp
                                @endforeach
                            </div>
                        @else
                            <div class="col-md-{{ $field->field_width }} mb-3 field-wrapper" data-index="{{ $globalIdx }}">
                                <div class="card shadow-sm field-card position-relative"
                                     onclick="editField({{ $globalIdx }})">
                                    <div class="card-body p-2">
                                        <strong>{{ $field->label }}</strong>
                                        <span class="badge bg-primary ms-2">{{ $field->type }}</span>
                                        <button type="button"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                                                onclick="removeField(event, {{ $globalIdx }})">&times;</button>
                                    </div>
                                </div>

                                <input type="hidden" name="fields[{{ $globalIdx }}][id]" value="{{ $field->id }}">
                                <input type="hidden" name="fields[{{ $globalIdx }}][name]" value="{{ $field->name }}">
                                <input type="hidden" name="fields[{{ $globalIdx }}][label]" value="{{ $field->label }}">
                                <input type="hidden" name="fields[{{ $globalIdx }}][type]" value="{{ $field->type }}">
                                <input type="hidden" name="fields[{{ $globalIdx }}][is_multiple]" value="{{ $field->is_multiple ? 1 : 0 }}">
                                <input type="hidden" name="fields[{{ $globalIdx }}][group_key]" value="">
                                <input type="hidden" name="fields[{{ $globalIdx }}][enable_croppie]" value="{{ $field->enable_croppie ? 1 : 0 }}">
                                <input type="hidden" name="fields[{{ $globalIdx }}][field_id]" value="{{ $field->field_id }}">
                                <input type="hidden" name="fields[{{ $globalIdx }}][class]" value="{{ $field->class }}">
                                <input type="hidden" name="fields[{{ $globalIdx }}][required]" value="{{ $field->required ? 1 : 0 }}">
                                <input type="hidden" name="fields[{{ $globalIdx }}][disabled]" value="{{ $field->disabled ? 1 : 0 }}">
                                <input type="hidden" name="fields[{{ $globalIdx }}][use_ck_editor]" value="{{ $field->use_ck_editor ? 1 : 0 }}">
                                <input type="hidden" name="fields[{{ $globalIdx }}][add_country_code]" value="{{ $field->add_country_code ? 1 : 0 }}">
                                <input type="hidden" name="fields[{{ $globalIdx }}][placeholder]" value="{{ $field->placeholder }}">
                                <input type="hidden" name="fields[{{ $globalIdx }}][field_width]" value="{{ $field->field_width }}">
                                <input type="hidden" name="fields[{{ $globalIdx }}][options]" value="{{ json_encode($field->options ?? []) }}">
                                <input type="hidden" name="fields[{{ $globalIdx }}][sort_order]" value="{{ $field->sort_order }}">
                            </div>
                            @php $globalIdx++; @endphp
                        @endif
                    @endforeach
                @endif
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.pages.forms.index') }}" class="btn btn-outline-secondary">Back</a>
            <button class="btn btn-success">Save Form</button>
        </div>

    </form>
</div>


{{-- ================= FIELD MODAL (single field: standalone OR one member of a repeat group) ================= --}}
<div class="modal fade" id="fieldModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="modalTitle">Add Field</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                {{-- Used for edit (standalone fields only) --}}
                <input type="hidden" id="currentIndex">

                <div class="row g-3">

                    {{-- Label --}}
                    <div class="col-md-4">
                        <label class="form-label">Label</label>
                        <input id="f_label" class="form-control">
                    </div>

                    {{-- Name --}}
                    <div class="col-md-4">
                        <label class="form-label">Name</label>
                        <input id="f_name" class="form-control">
                    </div>

                    {{-- Field ID --}}
                    <div class="col-md-4">
                        <label class="form-label">Field ID</label>
                        <input id="f_field_id" class="form-control">
                    </div>

                    {{-- Type --}}
                    <div class="col-md-4">
                        <label class="form-label">Type</label>
                        <select id="f_type" class="form-select" onchange="toggleOptions()">
                            <option value="text">Text</option>
                            <option value="textarea">Textarea</option>
                            <option value="email">Email</option>
                            <option value="number">Number</option>
                            <option value="password">Password</option>
                            <option value="select">Select</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="radio">Radio</option>
                            <option value="file">File</option>
                            <option value="gallery">Gallery (multiple images)</option>
                            <option value="date">Date</option>
                            <option value="time">Time</option>
                            <option value="hidden">Hidden</option>
                        </select>
                    </div>

                    {{-- Column / Field Width --}}
                    <div class="col-md-4">
                        <label class="form-label">Field Width (Column)</label>
                        <select id="f_field_width" class="form-select">
                            <option value="12">12</option>
                            <option value="6">6</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                        </select>
                    </div>

                    {{-- CSS Class --}}
                    <div class="col-md-4">
                        <label class="form-label">CSS Class</label>
                        <input id="f_class" class="form-control">
                    </div>

                    {{-- Placeholder --}}
                    <div class="col-md-6">
                        <label class="form-label">Placeholder</label>
                        <input id="f_placeholder" class="form-control">
                    </div>

                    {{-- Sort Order --}}
                    <div class="col-md-6">
                        <label class="form-label">Sort Order</label>
                        <input id="f_sort_order" type="number" class="form-control" value="0">
                    </div>

                    {{-- Required --}}
                    <div class="col-md-3">
                        <label class="form-label">Required</label>
                        <select id="f_required" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    {{-- Disabled --}}
                    <div class="col-md-3">
                        <label class="form-label">Disabled</label>
                        <select id="f_disabled" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    {{-- CK Editor --}}
                    <div class="col-md-3">
                        <label class="form-label">Use CK Editor</label>
                        <select id="f_use_ck_editor" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    {{-- Country Code --}}
                    <div class="col-md-3">
                        <label class="form-label">Add Country Code</label>
                        <select id="f_add_country_code" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    {{-- Allow Multiple (select only) --}}
                    <div class="col-md-3 d-none" id="multipleWrap">
                        <label class="form-label">Allow Multiple</label>
                        <select id="f_is_multiple" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    {{-- Enable Croppie (file / gallery only) --}}
                    <div class="col-md-3 d-none" id="croppieWrap">
                        <label class="form-label">Enable Croppie (crop before upload)</label>
                        <select id="f_enable_croppie" class="form-select">
                            <option value="1">Yes</option>
                            <option value="0">No (plain upload)</option>
                        </select>
                    </div>

                    {{-- Options --}}
                    <div class="col-md-12 d-none" id="optionsWrap">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label mb-0">Options</label>
                            <button type="button" class="btn btn-sm btn-primary" onclick="addOptionRow()">+ Add Option</button>
                        </div>

                        <div id="optionsList"></div>
                        <input type="hidden" id="f_options" value="[]">
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveOrUpdateField()">Save Field</button>
            </div>

        </div>
    </div>
</div>

{{-- ================= REPEAT GROUP MODAL ================= --}}
<div class="modal fade" id="groupModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="groupModalTitle">Add Repeat Field</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Group Label</label>
                    <input id="g_label" class="form-control" placeholder="e.g. Team Member">
                    <small class="text-muted">This whole set of fields can be added/removed as one repeating block wherever the form is used.</small>
                </div>

                <label class="form-label">Fields in this group</label>
                <div id="groupFieldsList" class="mb-2"></div>

                <button type="button" class="btn btn-sm btn-primary" onclick="addFieldToGroupClick()">+ Add Field</button>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="saveGroup()">Save Repeat Field</button>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('assets/js/Sortable.min.js') }}"></script>
<script>
/* ================= SAFE GLOBAL VARS ================= */
window.fieldIndex = window.fieldIndex ?? {{ isset($form) ? $form->fields->count() : 0 }};
window.modal = window.modal ?? null;
window.groupModalInstance = window.groupModalInstance ?? null;
window.modalContext = null; // null = standalone field; {type:'group', tempId} = editing/adding a group member
window.currentGroupFields = [];
window.currentGroupEditingWrapper = null;
window.groupTempCounter = 1;

/* ================= INIT ================= */
document.addEventListener('DOMContentLoaded', function () {
    const modalEl = document.getElementById('fieldModal');
    if (modalEl && !window.modal) {
        window.modal = new bootstrap.Modal(modalEl);

        // If a sub-field modal is dismissed (saved OR cancelled) while we were
        // building/editing a repeat group, always return to the group modal.
        modalEl.addEventListener('hidden.bs.modal', function () {
            if (window.modalContext && window.modalContext.type === 'group') {
                window.groupModalInstance.show();
            }
        });
    }

    const groupModalEl = document.getElementById('groupModal');
    if (groupModalEl && !window.groupModalInstance) {
        window.groupModalInstance = new bootstrap.Modal(groupModalEl);
    }

    const preview = document.getElementById('fieldPreview');
    if (preview) {
        new Sortable(preview, {
            animation: 150,
            handle: '.field-card',
            onEnd: renumberFieldOrder
        });
    }
});

/* ================= FIELD ORDER (drag-reorder) ================= */
function renumberFieldOrder() {
    let counter = 0;
    document.querySelectorAll('#fieldPreview .field-wrapper').forEach((wrapper) => {
        wrapper.querySelectorAll('input[name$="[sort_order]"]').forEach((sortInput) => {
            sortInput.value = counter++;
        });
    });
}

/* ================= OPTIONS LIST (add/remove/drag) ================= */
let optionsSortable = null;

function ensureOptionsSortable() {
    const list = document.getElementById('optionsList');
    if (list && !optionsSortable) {
        optionsSortable = new Sortable(list, { animation: 150, handle: '.option-drag-handle' });
    }
}

window.addOptionRow = function (label = '', value = '') {
    const list = document.getElementById('optionsList');

    const row = document.createElement('div');
    row.className = 'input-group input-group-sm mb-2 option-row';
    row.innerHTML = `
        <span class="input-group-text option-drag-handle" style="cursor:grab;"><i class="bx bx-menu"></i></span>
        <input type="text" class="form-control option-label" placeholder="Label" value="${label}">
        <input type="text" class="form-control option-value" placeholder="Value" value="${value}">
        <button type="button" class="btn btn-outline-danger" onclick="this.closest('.option-row').remove()">&times;</button>
    `;

    list.appendChild(row);
    ensureOptionsSortable();
};

function collectOptionsAsJSON() {
    const rows = document.querySelectorAll('#optionsList .option-row');
    const options = Array.from(rows)
        .map(row => ({
            label: row.querySelector('.option-label').value.trim(),
            value: row.querySelector('.option-value').value.trim() || row.querySelector('.option-label').value.trim(),
        }))
        .filter(option => option.label !== '');

    return JSON.stringify(options);
}

function renderOptionsFromJSON(json) {
    const list = document.getElementById('optionsList');
    list.innerHTML = '';

    let options = [];
    try { options = JSON.parse(json || '[]'); } catch (e) { options = []; }
    if (!Array.isArray(options)) options = [];

    options.forEach(option => addOptionRow(option.label ?? '', option.value ?? ''));
}

/* ================= SHARED: POPULATE / COLLECT FIELD MODAL ================= */
function populateFieldModal(f) {
    document.getElementById('f_label').value = f.label || '';
    document.getElementById('f_name').value = f.name || '';
    document.getElementById('f_field_id').value = f.field_id || '';
    document.getElementById('f_type').value = f.type || 'text';
    document.getElementById('f_field_width').value = f.field_width || '12';
    document.getElementById('f_class').value = f.class || '';
    document.getElementById('f_placeholder').value = f.placeholder || '';
    document.getElementById('f_sort_order').value = f.sort_order ?? 0;
    document.getElementById('f_required').value = f.required || '0';
    document.getElementById('f_disabled').value = f.disabled || '0';
    document.getElementById('f_use_ck_editor').value = f.use_ck_editor || '0';
    document.getElementById('f_add_country_code').value = f.add_country_code || '0';
    document.getElementById('f_is_multiple').value = f.is_multiple || '0';
    document.getElementById('f_enable_croppie').value = f.enable_croppie ?? '1';
    document.getElementById('f_options').value = f.options || '[]';
    renderOptionsFromJSON(f.options || '[]');
    toggleOptions();
}

function collectFieldModalData() {
    return {
        name: f_name.value,
        label: f_label.value,
        required: f_required.value,
        disabled: f_disabled.value,
        type: f_type.value,
        is_multiple: f_is_multiple.value,
        enable_croppie: f_enable_croppie.value,
        class: f_class.value,
        field_id: f_field_id.value,
        use_ck_editor: f_use_ck_editor.value,
        placeholder: f_placeholder.value,
        field_width: f_field_width.value,
        add_country_code: f_add_country_code.value,
        options: collectOptionsAsJSON(),
        sort_order: f_sort_order.value,
    };
}

/* ================= OPEN ADD MODAL (standalone field) ================= */
window.openAddModal = function () {
    window.modalContext = null;

    document.getElementById('modalTitle').innerText = 'Add Field';
    document.getElementById('currentIndex').value = '';

    populateFieldModal({
        type: 'text', field_width: '12', required: '0', disabled: '0', use_ck_editor: '0',
        add_country_code: '0', is_multiple: '0', enable_croppie: '1', options: '[]',
        sort_order: window.fieldIndex,
    });

    window.modal.show();
};

/* ================= TOGGLE OPTIONS / MULTIPLE ================= */
window.toggleOptions = function () {
    const type = document.getElementById('f_type').value;
    const wrap = document.getElementById('optionsWrap');
    const multipleWrap = document.getElementById('multipleWrap');
    const croppieWrap = document.getElementById('croppieWrap');

    if (['select', 'checkbox', 'radio'].includes(type)) {
        wrap.classList.remove('d-none');
    } else {
        wrap.classList.add('d-none');
    }

    if (type === 'select') {
        multipleWrap.classList.remove('d-none');
    } else {
        multipleWrap.classList.add('d-none');
    }

    if (['file', 'gallery'].includes(type)) {
        croppieWrap.classList.remove('d-none');
    } else {
        croppieWrap.classList.add('d-none');
    }
};

/* ================= REMOVE STANDALONE FIELD ================= */
window.removeField = function (e, index) {
    e.stopPropagation();
    document.querySelector(`.field-wrapper[data-index="${index}"]`)?.remove();
    renumberFieldOrder();
};

/* ================= EDIT STANDALONE FIELD ================= */
window.editField = function (index) {
    window.modalContext = null;

    document.getElementById('modalTitle').innerText = 'Edit Field';
    document.getElementById('currentIndex').value = index;

    const wrapper = document.querySelector(`.field-wrapper[data-index="${index}"]`);
    if (!wrapper) return;

    const f = {};
    wrapper.querySelectorAll('input[type="hidden"]').forEach(input => {
        const match = input.name.match(/\[(\w+)\]$/);
        if (match) f[match[1]] = input.value;
    });

    populateFieldModal(f);
    window.modal.show();
};

/* ================= SAVE / UPDATE FIELD (standalone or group member) ================= */
window.saveOrUpdateField = function () {
    const data = collectFieldModalData();

    // Saving a field that belongs to a repeat group being built/edited in the group modal.
    if (window.modalContext && window.modalContext.type === 'group') {
        if (window.modalContext.tempId !== null) {
            const idx = window.currentGroupFields.findIndex(x => x._tempId === window.modalContext.tempId);
            if (idx !== -1) {
                data.id = window.currentGroupFields[idx].id || '';
                data._tempId = window.modalContext.tempId;
                window.currentGroupFields[idx] = data;
            }
        } else {
            data.id = '';
            data._tempId = window.groupTempCounter++;
            window.currentGroupFields.push(data);
        }

        renderGroupFieldsList();
        window.modal.hide();
        return;
    }

    // Standalone top-level field.
    let index = document.getElementById('currentIndex').value;
    if (index === '') index = window.fieldIndex++;

    let wrapper = document.querySelector(`.field-wrapper[data-index="${index}"]`);
    const col = data.field_width;

    if (!wrapper) {
        wrapper = document.createElement('div');
        wrapper.className = `col-md-${col} mb-3 field-wrapper`;
        wrapper.dataset.index = index;

        wrapper.innerHTML = `
            <div class="card shadow-sm field-card position-relative" onclick="editField(${index})">
                <div class="card-body p-2"></div>
            </div>
        `;
        document.getElementById('fieldPreview').appendChild(wrapper);
    } else {
        wrapper.className = `col-md-${col} mb-3 field-wrapper`;
    }

    wrapper.querySelector('.card-body').innerHTML = `
        <strong>${data.label}</strong>
        <span class="badge bg-primary ms-2">${data.type}</span>
        <button type="button"
            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
            onclick="removeField(event, ${index})">&times;</button>
    `;

    wrapper.querySelectorAll('input[type="hidden"]').forEach(i => i.remove());

    data.group_key = '';

    Object.entries(data).forEach(([key, value]) => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = `fields[${index}][${key}]`;
        input.value = value ?? '';
        wrapper.appendChild(input);
    });

    renumberFieldOrder();
    window.modal.hide();
};

/* ================= REPEAT GROUP: OPEN / BUILD ================= */
function slugify(text) {
    return (text || '').toString().toLowerCase().trim()
        .replace(/[^a-z0-9]+/g, '_')
        .replace(/^_+|_+$/g, '') || 'group';
}

let groupFieldsSortable = null;

function ensureGroupFieldsSortable() {
    const list = document.getElementById('groupFieldsList');
    if (!list) return;
    if (groupFieldsSortable) {
        groupFieldsSortable.destroy();
        groupFieldsSortable = null;
    }
    groupFieldsSortable = new Sortable(list, {
        animation: 150,
        handle: '.group-field-drag',
        onEnd: function () {
            const order = Array.from(list.querySelectorAll('.group-field-row')).map(r => parseInt(r.dataset.tempId, 10));
            window.currentGroupFields.sort((a, b) => order.indexOf(a._tempId) - order.indexOf(b._tempId));
        },
    });
}

function renderGroupFieldsList() {
    const list = document.getElementById('groupFieldsList');
    list.innerHTML = '';

    if (!window.currentGroupFields.length) {
        list.innerHTML = '<p class="text-muted mb-2">No fields yet &mdash; click "+ Add Field" below.</p>';
        return;
    }

    window.currentGroupFields.forEach(f => {
        const row = document.createElement('div');
        row.className = 'card mb-2 group-field-row';
        row.dataset.tempId = f._tempId;
        row.innerHTML = `
            <div class="card-body p-2 d-flex justify-content-between align-items-center">
                <span style="cursor:pointer;" onclick="editFieldInGroup(${f._tempId})">
                    <i class="bx bx-menu group-field-drag" style="cursor:grab;"></i>
                    <strong>${f.label || '(untitled)'}</strong>
                    <span class="badge bg-primary ms-2">${f.type}</span>
                </span>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFieldFromGroup(${f._tempId})">&times;</button>
            </div>
        `;
        list.appendChild(row);
    });

    ensureGroupFieldsSortable();
}

window.openGroupModal = function () {
    window.currentGroupFields = [];
    window.currentGroupEditingWrapper = null;

    document.getElementById('groupModalTitle').innerText = 'Add Repeat Field';
    document.getElementById('g_label').value = '';

    renderGroupFieldsList();
    window.groupModalInstance.show();
};

window.addFieldToGroupClick = function () {
    window.modalContext = { type: 'group', tempId: null };

    document.getElementById('modalTitle').innerText = 'Add Field to Group';
    document.getElementById('currentIndex').value = '';

    populateFieldModal({
        type: 'text', field_width: '12', required: '0', disabled: '0', use_ck_editor: '0',
        add_country_code: '0', is_multiple: '0', enable_croppie: '1', options: '[]',
        sort_order: window.currentGroupFields.length,
    });

    window.groupModalInstance.hide();
    window.modal.show();
};

window.editFieldInGroup = function (tempId) {
    const f = window.currentGroupFields.find(x => x._tempId === tempId);
    if (!f) return;

    window.modalContext = { type: 'group', tempId };

    document.getElementById('modalTitle').innerText = 'Edit Field';
    document.getElementById('currentIndex').value = '';

    populateFieldModal(f);

    window.groupModalInstance.hide();
    window.modal.show();
};

window.removeFieldFromGroup = function (tempId) {
    window.currentGroupFields = window.currentGroupFields.filter(f => f._tempId !== tempId);
    renderGroupFieldsList();
};

window.editGroupWrapper = function (cardEl) {
    const wrapper = cardEl.closest('.field-wrapper');
    if (!wrapper) return;

    const fieldsMap = {};
    wrapper.querySelectorAll('input[type="hidden"]').forEach(input => {
        const match = input.name.match(/^fields\[(\d+)\]\[(\w+)\]$/);
        if (!match) return;
        const [, idx, key] = match;
        fieldsMap[idx] = fieldsMap[idx] || {};
        fieldsMap[idx][key] = input.value;
    });

    const idxKeys = Object.keys(fieldsMap).map(Number).sort((a, b) => a - b);
    window.currentGroupFields = idxKeys.map(idx => ({ ...fieldsMap[idx], _tempId: window.groupTempCounter++ }));
    window.currentGroupEditingWrapper = wrapper;

    document.getElementById('groupModalTitle').innerText = 'Edit Repeat Field';
    document.getElementById('g_label').value = wrapper.dataset.groupLabel || '';

    renderGroupFieldsList();
    window.groupModalInstance.show();
};

window.removeGroupWrapper = function (e, el) {
    e.stopPropagation();
    const wrapper = el.closest('.field-wrapper');
    if (wrapper) wrapper.remove();
    renumberFieldOrder();
};

window.saveGroup = function () {
    const label = document.getElementById('g_label').value.trim();

    if (!label) {
        if (typeof showToast === 'function') showToast('error', 'Group label is required');
        return;
    }
    if (!window.currentGroupFields.length) {
        if (typeof showToast === 'function') showToast('error', 'Add at least one field to the group');
        return;
    }

    const existingKeys = Array.from(document.querySelectorAll('.group-wrapper'))
        .filter(w => w !== window.currentGroupEditingWrapper)
        .map(w => w.dataset.groupKey);

    let groupKey = slugify(label);
    let suffix = 1;
    while (existingKeys.includes(groupKey)) {
        groupKey = slugify(label) + '_' + (++suffix);
    }

    let wrapper = window.currentGroupEditingWrapper;
    if (!wrapper) {
        wrapper = document.createElement('div');
        wrapper.className = 'col-md-12 mb-3 field-wrapper group-wrapper';
        document.getElementById('fieldPreview').appendChild(wrapper);
    }
    wrapper.dataset.groupKey = groupKey;
    wrapper.dataset.groupLabel = label;

    const badges = window.currentGroupFields
        .map(f => `<span class="badge bg-secondary me-1">${f.label} (${f.type})</span>`)
        .join('');

    wrapper.innerHTML = `
        <div class="card shadow-sm field-card border-info position-relative" onclick="editGroupWrapper(this)">
            <div class="card-body p-2">
                <span class="badge bg-info">Repeat Group</span>
                <strong class="ms-1">${label}</strong>
                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                    onclick="event.stopPropagation(); removeGroupWrapper(event, this)">&times;</button>
                <div class="mt-2">${badges}</div>
            </div>
        </div>
    `;

    window.currentGroupFields.forEach((f, i) => {
        const fieldIdx = window.fieldIndex + i;
        const row = { ...f, group_key: groupKey };
        delete row._tempId;

        ['id', 'name', 'label', 'type', 'is_multiple', 'group_key', 'enable_croppie', 'field_id', 'class',
         'required', 'disabled', 'use_ck_editor', 'add_country_code', 'placeholder', 'field_width', 'options', 'sort_order']
            .forEach(key => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `fields[${fieldIdx}][${key}]`;
                input.value = row[key] ?? '';
                wrapper.appendChild(input);
            });
    });

    window.fieldIndex += window.currentGroupFields.length;

    window.currentGroupEditingWrapper = null;
    window.modalContext = null;
    window.groupModalInstance.hide();

    renumberFieldOrder();
};
</script>
@endpush
