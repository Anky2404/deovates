@extends('backend.layouts.app')

@section('title', 'Page Content Details')

@section('content')
<div class="card">

    {{-- HEADER --}}
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Page Content Details</h5>

        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back"></i> Back
        </a>
    </div>

    <div class="card-body">

        {{-- ================= BASIC INFO ================= --}}
        <div class="row mb-4">

            <div class="col-md-3">
                <strong>ID:</strong><br>
                {{ $content->id }}
            </div>

            <div class="col-md-3">
                <strong>UUID:</strong><br>
                {{ $content->uuid }}
            </div>

            <div class="col-md-3">
                <strong>Page:</strong><br>
                {{ $content->page->name ?? '-' }}
            </div>

            <div class="col-md-3">
                <strong>Slug:</strong><br>
                {{ $content->page->slug ?? '-' }}
            </div>

        </div>

        <hr>

        {{-- ================= FORM BUTTONS ================= --}}
        <div class="mb-3">
            <label class="form-label">Forms in this Page</label>

            <div class="d-flex flex-wrap gap-2">
                @foreach($pageContents as $item)
                    <button class="btn btn-outline-primary form-btn"
                        data-id="{{ $item->id }}">
                        {{ $item->form->name ?? 'Form' }}
                    </button>
                @endforeach
            </div>
        </div>

        <hr>

        {{-- ================= FORM + JSON SECTION ================= --}}
        <form method="POST"
            action="{{ route('admin.page_contents.saveorupdate', $content->uuid) }}">
            @csrf

            <input type="hidden" name="page_id" value="{{ $content->page_id }}">
            <input type="hidden" name="form_id" id="form_id" value="{{ $content->form_id }}">

            {{-- FORM AREA --}}
            <div id="dynamicFormArea" class="mb-4">
                <div class="alert alert-info">
                    Select a form to load fields
                </div>
            </div>

            {{-- TOGGLE BUTTONS --}}
            <div class="mb-3">
                <button type="button" class="btn btn-outline-primary" onclick="showForm()">Form</button>
                <button type="button" class="btn btn-outline-dark" onclick="showJson()">JSON Preview</button>
            </div>

            {{-- JSON BOX --}}
            <div id="jsonBox" class="mb-3 d-none">
                <label class="form-label">Content JSON</label>
                <textarea name="content" class="form-control" rows="8">
{{ json_encode($content->content, JSON_PRETTY_PRINT) }}
                </textarea>
            </div>

            {{-- SETTINGS --}}
            <div class="mb-3">
                <label class="form-label">Settings JSON</label>
                <textarea name="settings" class="form-control" rows="4">
{{ json_encode($content->settings, JSON_PRETTY_PRINT) }}
                </textarea>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    Cancel
                </a>

                <button class="btn btn-success">
                    Update
                </button>
            </div>

        </form>

    </div>

</div>
@endsection


@push('scripts')
<script>

/* ================= FORM SWITCH ================= */
document.querySelectorAll('.form-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        let id = this.dataset.id;

        fetch(`/admin/page-contents/get-form/${id}`)
            .then(res => res.json())
            .then(res => {

                document.getElementById('form_id').value = res.form_id;

                let html = '';

                res.fields.forEach(field => {

                    html += `
                        <div class="mb-3">
                            <label class="form-label">${field.label}</label>
                            <input type="text"
                                name="content[${field.name}]"
                                class="form-control"
                                value="${res.content?.[field.name] ?? ''}">
                        </div>
                    `;
                });

                document.getElementById('dynamicFormArea').innerHTML = html;
            });

    });
});


/* ================= TOGGLE ================= */
function showJson() {
    document.getElementById('jsonBox').classList.remove('d-none');
    document.getElementById('dynamicFormArea').classList.add('d-none');
}

function showForm() {
    document.getElementById('jsonBox').classList.add('d-none');
    document.getElementById('dynamicFormArea').classList.remove('d-none');
}

</script>
@endpush