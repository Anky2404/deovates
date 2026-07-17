@extends('backend.layouts.app')

@section('title', isset($template) ? 'Edit Email Template' : 'Create Email Template')

@section('content')

<div class="card">

    <div class="card-header">
        <h5 class="mb-0">
            {{ isset($template) ? 'Edit Email Template' : 'Create Email Template' }}
        </h5>
    </div>

    <form method="POST"
          action="{{ route('admin.emails.templates.saveorupdate', $template->uuid ?? null) }}">
        @csrf

        <div class="card-body row g-3">

            {{-- NAME --}}
            <div class="col-md-6">
                <label class="form-label">Template Name *</label>
                <input type="text"
                       name="name"
                       id="title_input"
                       class="form-control"
                       value="{{ old('name', $template->name ?? '') }}"
                       required>
            </div>

            {{-- SLUG --}}
            <div class="col-md-6">
                <label class="form-label">Slug *</label>
                <input type="text"
                       name="slug"
                       id="slug_input"
                       class="form-control"
                       value="{{ old('slug', $template->slug ?? '') }}"
                       required>
            </div>

            {{-- SUBJECT --}}
            <div class="col-md-12">
                <label class="form-label">Email Subject *</label>
                <input type="text"
                       name="subject"
                       id="subjectInput"
                       class="form-control"
                       value="{{ old('subject', $template->subject ?? '') }}"
                       required>
            </div>

            {{-- EMAIL BODY --}}
            <div class="col-md-6">
                <label class="form-label">Email Body *</label>

                <textarea name="body"
                          id="description"
                          class="form-control"
                          rows="10"
                          required>{{ old('body', $template->body ?? '') }}</textarea>

                <small class="text-muted">
                    Use variables like
                    <code>@{{name}}</code>,
                    <code>@{{email}}</code>,
                    <code>@{{password}}</code>
                </small>
            </div>

            {{-- PREVIEW --}}
            <div class="col-md-6">
                <label class="form-label">Email Preview</label>

                @include('backend.partials.email-preview', [
                    'previewId' => 'templateEditPreview',
                    'alwaysRefresh' => true,
                    'previewHtml' => view('emails.layout', [
                        'subject' => $template->subject ?? 'Your Subject Here',
                        'body' => $template->body ?? '<p>Email content will appear here...</p>',
                    ])->render(),
                ])
            </div>

            {{-- VARIABLES JSON --}}
            <div class="col-md-12">
                <label class="form-label">Variables (JSON)</label>

                <textarea name="variables"
                          class="form-control"
                          rows="4">{{ old(
                            'variables',
                            isset($template->variables)
                                ? json_encode($template->variables, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                                : ''
                          ) }}</textarea>

                <small class="text-muted">
                    Example: ["name","email","password"]
                </small>
            </div>

            {{-- TYPE --}}
            <div class="col-md-6">
                <label class="form-label">Type</label>
                <input type="text"
                       name="type"
                       class="form-control"
                       value="{{ old('type', $template->type ?? '') }}"
                       placeholder="transactional / marketing">
            </div>

            {{-- MODULE --}}
            <div class="col-md-6">
                <label class="form-label">Module</label>
                <input type="text"
                       name="module"
                       class="form-control"
                       value="{{ old('module', $template->module ?? '') }}"
                       placeholder="auth / order / blog">
            </div>

            {{-- LANGUAGE --}}
            <div class="col-md-6">
                <label class="form-label">Language</label>
                <input type="text"
                       name="language"
                       class="form-control"
                       value="{{ old('language', $template->language ?? 'en') }}">
            </div>

            {{-- DEFAULT TEMPLATE --}}
            <div class="col-md-3">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_default"
                           value="1"
                           {{ old('is_default', $template->is_default ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label">
                        Default Template
                    </label>
                </div>
            </div>

            {{-- ACTIVE --}}
            <div class="col-md-3">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $template->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label">
                        Active
                    </label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">

            <a href="{{ route('admin.emails.templates.index') }}"
               class="btn btn-secondary">
                Cancel
            </a>

            <button type="submit" class="btn btn-primary">
                {{ isset($template) ? 'Update Template' : 'Create Template' }}
            </button>

        </div>

    </form>

</div>

@endsection
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

    const subjectField = document.getElementById('subjectInput');
    const desktopFrame = document.getElementById('templateEditPreviewIframeDesktop');
    const mobileFrame = document.getElementById('templateEditPreviewIframeMobile');
    let debounceTimer = null;

    function refreshPreview() {
        const editorInstance = typeof CKEDITOR !== 'undefined' ? CKEDITOR.instances.description : null;
        const bodyValue = editorInstance ? editorInstance.getData() : document.getElementById('description').value;

        fetch('{{ route('admin.emails.templates.preview') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: new URLSearchParams({
                subject: subjectField.value,
                body: bodyValue,
            }),
        })
            .then(function (response) { return response.text(); })
            .then(function (html) {
                [desktopFrame, mobileFrame].forEach(function (iframe) {
                    if (!iframe) return;

                    iframe.dataset.html = html;

                    if (!iframe.closest('.email-open-mockup').classList.contains('d-none')) {
                        iframe.srcdoc = html;
                    }
                });
            })
            .catch(function () {
                // Preview is a nicety, not critical — silently skip on failure.
            });
    }

    function debouncedRefresh() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(refreshPreview, 500);
    }

    subjectField?.addEventListener('input', debouncedRefresh);

    // CKEDITOR.replace() for #description runs in its own DOMContentLoaded
    // listener (see partials/foot.blade.php) — give it a tick to finish
    // before deciding whether the editor instance exists yet.
    setTimeout(function () {
        if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.description) {
            CKEDITOR.instances.description.on('change', debouncedRefresh);
        } else {
            document.getElementById('description')?.addEventListener('input', debouncedRefresh);
        }
    }, 0);
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("form");
    const variablesField = document.querySelector("textarea[name='variables']");

    form.addEventListener("submit", function () {

        if (!variablesField.value.trim()) return;

        try {

            // try parse json
            let data = JSON.parse(variablesField.value);

            // if string inside array fix it
            if (typeof data === "string") {
                data = JSON.parse(data);
            }

            // normalize array
            if (Array.isArray(data)) {
                variablesField.value = JSON.stringify(data, null, 4);
            }

        } catch (e) {

            // fallback: convert comma list to array
            let cleaned = variablesField.value
                .replace(/[\[\]\"]/g, "")
                .split(",")
                .map(v => v.trim())
                .filter(v => v !== "");

            variablesField.value = JSON.stringify(cleaned, null, 4);
        }

    });

});
</script>
@endpush
