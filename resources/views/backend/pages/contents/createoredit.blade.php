@extends('backend.layouts.app')

@section('title', isset($pageContent) ? 'Edit Content' : 'Create Content')

@section('content')
<div class="card">

    <div class="card-header">
        <h5>{{ isset($pageContent) ? 'Edit Content' : 'Create Content' }}</h5>
    </div>

    <form method="POST"
        action="{{ route('admin.pages.contents.saveorupdate', ['uuid' => $pageContent->uuid ?? null]) }}">
        @csrf

        <div class="card-body">

            {{-- PAGE --}}
            <div class="mb-3">
                <label>Select Page</label>
                <select id="pageSelect" class="form-select">
                    <option value="">-- Select Page --</option>
                    @foreach($pages as $page)
                        <option value="{{ $page->id }}"
                            {{ isset($pageContent) && $pageContent->page_id == $page->id ? 'selected' : '' }}>
                            {{ $page->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="page_id" id="page_id"
                value="{{ $pageContent->page_id ?? '' }}">

            <input type="hidden" name="form_id" id="form_id"
                value="{{ $pageContent->form_id ?? '' }}">

            <hr>

            {{-- FORM BUTTONS --}}
            <div id="formButtons" class="mb-3"></div>

            {{-- FORM FIELDS --}}
            <div id="formArea"></div>

        </div>

        <div class="card-footer text-end">
            <button class="btn btn-success">Save</button>
        </div>

    </form>

</div>
@endsection


@push('scripts')
<script>

const pagesData = @json($pages->load('forms.fields'));
const oldContent = @json($pageContent->content ?? []);

let selectedPage = null;

/* PAGE CHANGE */
document.getElementById('pageSelect').addEventListener('change', function () {
    let pageId = this.value;
    document.getElementById('page_id').value = pageId;
    if (!pageId) {
        document.getElementById('formButtons').innerHTML = '';
        document.getElementById('formArea').innerHTML = '';
        return;
    }

    selectedPage = pagesData.find(p => p.id == pageId);

    let html = '';

    (selectedPage?.forms || []).forEach(form => {
        html += `
            <button type="button"
                class="btn btn-outline-primary m-1 form-btn"
                data-id="${form.id}">
                ${form.name}
            </button>
        `;
    });

    document.getElementById('formButtons').innerHTML = html;

    document.getElementById('formArea').innerHTML = ''; 

    bindForms();
});


/* FORM CLICK */
function bindForms() {

    document.querySelectorAll('.form-btn').forEach(btn => {

        btn.addEventListener('click', function () {

            let formId = this.dataset.id;

            document.getElementById('form_id').value = formId;

            let form = selectedPage.forms.find(f => f.id == formId);

            let html = '';

            (form.fields || []).forEach(field => {

                let col = (field.field_width && field.field_width <= 12)
                    ? `col-md-${field.field_width}`
                    : 'col-md-12';

                let value = oldContent[form.slug]?.[field.name] ?? '';

                let input = `
                    <input type="${field.type || 'text'}"
                        name="content[${form.slug}][${field.name}]"
                        class="form-control ${field.class || ''}"
                        value="${value}"
                        placeholder="${field.placeholder || ''}"
                        ${field.required ? 'required' : ''}
                        ${field.disabled ? 'disabled' : ''}>
                `;

                if (field.type === 'textarea') {
                    input = `
                        <textarea name="content[${form.slug}][${field.name}]"
                            class="form-control"
                            placeholder="${field.placeholder || ''}">${value}</textarea>
                    `;
                }

                html += `
                    <div class="${col} mb-3">
                        <label>${field.label}</label>
                        ${input}
                    </div>
                `;
            });

            document.getElementById('formArea').innerHTML = `
                <div class="row">${html}</div>
            `;
        });

    });
}


/* EDIT AUTO LOAD */
window.addEventListener('load', function () {

    let pageId = document.getElementById('page_id').value;

    if (pageId) {
        document.getElementById('pageSelect').value = pageId;
        document.getElementById('pageSelect').dispatchEvent(new Event('change'));

        setTimeout(() => {
            let formId = document.getElementById('form_id').value;
            document.querySelector(`[data-id="${formId}"]`)?.click();
        }, 300);
    }

});

</script>
@endpush