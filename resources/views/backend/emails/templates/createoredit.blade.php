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

    <div class="border rounded p-3" style="background:#f5f7fb">

        <style>
            .email-wrapper {
                width: 100%;
                max-width: 650px;
                margin: auto;
                font-family: Arial, Helvetica, sans-serif;
            }

            .email-header {
                background: rgb(6, 52, 112);
                color: #fff;
                padding: 35px 30px;
                text-align: center;
            }

            .email-logo {
                height: 55px;
                margin-bottom: 12px;
            }

            .email-title {
                margin: 0;
                font-size: 24px;
                font-weight: 600;
                color: #fff;
            }

            .email-subtitle {
                margin-top: 6px;
                font-size: 14px;
                opacity: 0.9;
            }

            .email-body {
                background: #ffffff;
                padding: 45px 40px;
            }

            .email-body p {
                color: #6c757d;
                font-size: 16px;
                line-height: 1.8;
            }

            .cta-section {
                text-align: center;
                padding: 25px;
                background: #ffffff;
            }

            .cta-btn {
                background: rgb(6, 52, 112);
                color: #fff;
                padding: 14px 32px;
                text-decoration: none;
                border-radius: 6px;
                font-weight: 600;
                display: inline-block;
            }

            .email-footer {
                background: #f2f5fa;
                padding: 30px;
                text-align: center;
                font-size: 13px;
                color: #666;
            }
        </style>

        <div class="email-wrapper">

            <table width="100%" cellpadding="0" cellspacing="0">

                <tr>
                    <td class="email-header">

                        <img src="{{ asset('assets/frontend/images/logo.png') }}"
                             class="email-logo"
                             alt="Logo">

                        <h2 class="email-title">
                            {{ config('app.name') }}
                        </h2>

                        <p class="email-subtitle">
                            Future Ready Digital Platform
                        </p>

                    </td>
                </tr>

                <tr>
                    <td class="email-body" id="preview-body">

                        {!! $template->body ?? 'Email content will appear here...' !!}

                    </td>
                </tr>

                <tr>
                    <td class="cta-section">

                        <a href="{{ url('/') }}" class="cta-btn">
                            Visit Website
                        </a>

                    </td>
                </tr>

                <tr>
                    <td class="email-footer">

                        <p>
                            © {{ date('Y') }} {{ config('app.name') }}
                        </p>

                        <p>
                            This email was sent automatically. If you did not request this email please ignore it.
                        </p>

                        <div>
                            <a href="{{ url('/') }}">Website</a>
                            <a href="#">Support</a>
                            <a href="#">Privacy</a>
                        </div>

                    </td>
                </tr>

            </table>

        </div>

    </div>

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

    const textarea = document.getElementById("description");
    const preview = document.getElementById("preview-body");

    function updatePreview() {
        preview.innerHTML = textarea.value;
    }

    textarea.addEventListener("keyup", updatePreview);
    textarea.addEventListener("change", updatePreview);

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