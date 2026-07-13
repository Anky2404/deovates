@extends('backend.layouts.app')

@section('title', 'Page Details')

@section('content')
<div class="card">

    <!-- HEADER -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Page Content Details</h5>

        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
            Back
        </a>
    </div>

    <div class="card-body">

        <!-- BASIC INFO -->
        <div class="row mb-4">
            <div class="col-md-3">
                <strong>ID</strong><br>
                {{ $page->id }}
            </div>

            <div class="col-md-3">
                <strong>UUID</strong><br>
                {{ $page->uuid }}
            </div>

            <div class="col-md-3">
                <strong>Page Name</strong><br>
                {{ $page->name }}
            </div>

            <div class="col-md-3">
                <strong>Slug</strong><br>
                {{ $page->slug }}
            </div>
        </div>

        <hr>

        <!-- FORM BUTTONS -->
        <div class="mb-3">
            <label class="form-label">Forms in this Page</label>

            <div class="d-flex flex-wrap gap-2">
                @forelse($page->forms as $form)
                    <button type="button"
                        class="btn btn-outline-primary form-btn"
                        data-id="{{ $form->id }}">
                        {{ $form->name }}
                    </button>
                @empty
                    <span class="text-muted">No forms found</span>
                @endforelse
            </div>
        </div>

        <hr>

        <!-- FORM AREA -->
        <form method="POST" action="#">
            @csrf

            <input type="hidden" id="form_id" name="form_id">

            <!-- TOGGLE -->
            <div class="mb-3">
                <button type="button" class="btn btn-outline-primary" onclick="showForm()">Form</button>
                <button type="button" class="btn btn-outline-dark" onclick="showJson()">JSON</button>
            </div>

            <!-- FORM -->
            <div id="formArea" class="mb-4">
                <div class="alert alert-info">
                    Click any form button to load fields
                </div>
            </div>

            <!-- JSON -->
            <div id="jsonArea" class="d-none mb-4">
                <label class="form-label">JSON Data</label>
                <textarea class="form-control" rows="8" id="jsonBox"></textarea>
            </div>

            <!-- ACTION -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    Cancel
                </a>

                <button type="submit" class="btn btn-success">
                    Update
                </button>
            </div>

        </form>

    </div>

</div>
@endsection


@push('scripts')
<script>

// ✅ ALL FORMS DATA (NO API)
const formsData = @json($page->forms);

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.form-btn').forEach(btn => {

        btn.addEventListener('click', function () {

            let formId = this.dataset.id;
            let form = formsData.find(f => f.id == formId);

            if (!form) return;

            let html = '';

            (form.fields || []).forEach(field => {

                let col = field.field_width ? `col-md-${field.field_width}` : 'col-md-12';
                let required = field.required ? 'required' : '';
                let disabled = field.disabled ? 'disabled' : '';
                let value = field.default_value ?? '';

                let inputHtml = '';

                try {

                    switch(field.type) {

                        case 'textarea':
                            inputHtml = `
                                <textarea class="form-control"
                                    name="content[${field.name}]"
                                    placeholder="${field.placeholder || ''}"
                                    ${required} ${disabled}>${value}</textarea>
                            `;
                            break;

                        case 'select':
                            let options = field.options ? JSON.parse(field.options) : [];
                            inputHtml = `<select class="form-control" name="content[${field.name}]" ${required} ${disabled}>`;

                            options.forEach(opt => {
                                inputHtml += `<option value="${opt}">${opt}</option>`;
                            });

                            inputHtml += `</select>`;
                            break;

                        case 'radio':
                            let radioOptions = field.options ? JSON.parse(field.options) : [];
                            radioOptions.forEach(opt => {
                                inputHtml += `
                                    <div class="form-check">
                                        <input class="form-check-input"
                                            type="radio"
                                            name="content[${field.name}]"
                                            value="${opt}">
                                        <label class="form-check-label">${opt}</label>
                                    </div>
                                `;
                            });
                            break;

                        case 'checkbox':
                            let checkOptions = field.options ? JSON.parse(field.options) : [];
                            checkOptions.forEach(opt => {
                                inputHtml += `
                                    <div class="form-check">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            name="content[${field.name}][]"
                                            value="${opt}">
                                        <label class="form-check-label">${opt}</label>
                                    </div>
                                `;
                            });
                            break;

                        default:
                            inputHtml = `
                                <input type="${field.type || 'text'}"
                                    class="form-control ${field.class || ''}"
                                    name="content[${field.name}]"
                                    placeholder="${field.placeholder || ''}"
                                    value="${value}"
                                    ${required} ${disabled}>
                            `;
                    }

                } catch (e) {
                    console.error('Field error:', e);
                }

                html += `
                    <div class="${col} mb-3">
                        <label class="form-label">${field.label || ''}</label>
                        ${inputHtml}
                    </div>
                `;
            });

            document.getElementById('formArea').innerHTML = `<div class="row">${html}</div>`;
            document.getElementById('jsonBox').value = JSON.stringify(form, null, 2);
            document.getElementById('form_id').value = formId;

        });

    });

});

// TOGGLE
function showJson() {
    document.getElementById('jsonArea').classList.remove('d-none');
    document.getElementById('formArea').classList.add('d-none');
}

function showForm() {
    document.getElementById('jsonArea').classList.add('d-none');
    document.getElementById('formArea').classList.remove('d-none');
}

</script>
@endpush