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

            {{-- ================= FIELD PREVIEW ================= --}}
            <div class="row" id="fieldPreview">
                @if(isset($form))
                    @foreach($form->fields as $i => $field)
                        <div class="col-md-{{ $field->field_width }} mb-3 field-wrapper" data-index="{{ $i }}">
                            <div class="card shadow-sm field-card position-relative"
                                 onclick="editField({{ $i }})">
                                <div class="card-body p-2">
                                    <strong>{{ $field->label }}</strong>
                                    <span class="badge bg-primary ms-2">{{ $field->type }}</span>
                                    <button type="button"
                                            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                                            onclick="removeField(event, {{ $i }})">&times;</button>
                                </div>
                            </div>

                            @foreach($field->toArray() as $key => $val)
                                <input type="hidden" name="fields[{{ $i }}][{{ $key }}]" value="{{ $val }}">
                            @endforeach
                        </div>
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


{{-- ================= FIELD MODAL ================= --}}
<div class="modal fade" id="fieldModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="modalTitle">Add Field</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                {{-- Used for edit --}}
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

                    {{-- Options --}}
                    <div class="col-md-12 d-none" id="optionsWrap">
                        <label class="form-label">Options (comma separated)</label>
                        <input id="f_options" class="form-control" placeholder="Male,Female,Other">
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveOrUpdateField()">Save Field</button>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
/* ================= SAFE GLOBAL VARS ================= */
window.fieldIndex = window.fieldIndex ?? {{ isset($form) ? $form->fields->count() : 0 }};
window.modal = window.modal ?? null;

/* ================= INIT ================= */
document.addEventListener('DOMContentLoaded', function () {
    const modalEl = document.getElementById('fieldModal');
    if (modalEl && !window.modal) {
        window.modal = new bootstrap.Modal(modalEl);
    }
});

/* ================= OPEN ADD MODAL ================= */
window.openAddModal = function () {
    document.getElementById('modalTitle').innerText = 'Add Field';
    document.getElementById('currentIndex').value = '';

    document.querySelectorAll('#fieldModal input, #fieldModal select').forEach(el => {
        el.value = '';
    });

    document.getElementById('f_sort_order').value = window.fieldIndex;

    toggleOptions();
    window.modal.show();
};

/* ================= TOGGLE OPTIONS ================= */
window.toggleOptions = function () {
    const type = document.getElementById('f_type').value;
    const wrap = document.getElementById('optionsWrap');

    if (['select', 'checkbox', 'radio'].includes(type)) {
        wrap.classList.remove('d-none');
    } else {
        wrap.classList.add('d-none');
    }
};

/* ================= REMOVE FIELD ================= */
window.removeField = function (e, index) {
    e.stopPropagation();
    document.querySelector(`.field-wrapper[data-index="${index}"]`)?.remove();
};

/* ================= EDIT FIELD ================= */
window.editField = function (index) {
    document.getElementById('modalTitle').innerText = 'Edit Field';
    document.getElementById('currentIndex').value = index;

    const wrapper = document.querySelector(`.field-wrapper[data-index="${index}"]`);
    if (!wrapper) return;

    wrapper.querySelectorAll('input[type="hidden"]').forEach(input => {
        const match = input.name.match(/\[(\w+)\]$/);
        if (!match) return;

        const key = match[1];
        const el = document.getElementById('f_' + key);
        if (el) el.value = input.value;
    });

    toggleOptions();
    window.modal.show();
};

/* ================= SAVE / UPDATE FIELD ================= */
window.saveOrUpdateField = function () {
    let index = document.getElementById('currentIndex').value;
    if (index === '') index = window.fieldIndex++;

    let wrapper = document.querySelector(`.field-wrapper[data-index="${index}"]`);

    const col = document.getElementById('f_field_width').value;

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
        <strong>${f_label.value}</strong>
        <span class="badge bg-primary ms-2">${f_type.value}</span>
        <button type="button"
            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
            onclick="removeField(event, ${index})">&times;</button>
    `;

    /* remove old hidden inputs */
    wrapper.querySelectorAll('input[type="hidden"]').forEach(i => i.remove());

    /* ================= DB MATCHING DATA ================= */
    const data = {
        name: f_name.value,
        label: f_label.value,
        required: f_required.value,
        disabled: f_disabled.value,
        type: f_type.value,
        class: f_class.value,
        field_id: f_field_id.value,
        use_ck_editor: f_use_ck_editor.value,
        placeholder: f_placeholder.value,
        field_width: f_field_width.value,
        add_country_code: f_add_country_code.value,
        options: f_options.value,
        sort_order: f_sort_order.value
    };

    Object.entries(data).forEach(([key, value]) => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = `fields[${index}][${key}]`;
        input.value = value ?? '';
        wrapper.appendChild(input);
    });

    window.modal.hide();
};
</script>
@endpush

