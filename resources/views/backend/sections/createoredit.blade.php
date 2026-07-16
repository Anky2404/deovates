@extends('backend.layouts.app')

@section('title', isset($section) ? 'Edit Section' : 'Create Section')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">{{ isset($section) ? 'Edit' : 'Create' }} Section</h5>
    </div>

    <form method="POST"
          action="{{ route('admin.sections.saveorupdate', $section->uuid ?? null) }}">
        @csrf

        <div class="card-body row g-3">

            {{-- NAME --}}
            <div class="col-md-4">
                <label class="form-label">Name *</label>
                <input type="text"
                       id="title_input"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $section->name ?? '') }}"
                       required>
            </div>

            {{-- SLUG --}}
            <div class="col-md-4">
                <label class="form-label">Slug *</label>
                <input type="text"
                       name="slug"
                       id="slug_input"
                       class="form-control"
                       value="{{ old('slug', $section->slug ?? '') }}"
                       required>
            </div>

            {{-- TYPE --}}
            <div class="col-md-4">
                <label class="form-label">Type</label>
                <input type="text"
                       name="type"
                       class="form-control"
                       placeholder="e.g. hero, faq, gallery"
                       value="{{ old('type', $section->type ?? '') }}">
            </div>

            {{-- FORM --}}
            <div class="col-md-6">
                <label class="form-label">Form</label>
                <select name="form_id" class="form-control">
                    <option value="">-- create a new form automatically --</option>
                    @foreach ($forms as $id => $name)
                        <option value="{{ $id }}"
                            {{ old('form_id', $section->form_id ?? '') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                <div class="form-text">
                    Leave unset to auto-create a dedicated form for this section (seeded with the
                    mandatory Section Label / Title / Subtitle fields).
                </div>
            </div>

            @if (isset($section) && $section->form)
                <div class="col-md-6 d-flex align-items-end">
                    <a href="{{ route('admin.pages.forms.createoredit', $section->form->uuid) }}"
                       class="btn btn-outline-secondary">
                        <i class="bx bx-list-plus me-1"></i> Manage Fields for This Section
                    </a>
                </div>
            @endif

            {{-- DISPLAY ORDER --}}
            <div class="col-md-3">
                <label class="form-label">Display Order</label>
                <input type="number"
                       name="display_order"
                       class="form-control"
                       value="{{ old('display_order', $section->display_order ?? 0) }}">
            </div>

            {{-- VIEWS --}}
            <div class="col-md-3">
                <label class="form-label">Views</label>
                <input type="number"
                       name="views"
                       class="form-control"
                       value="{{ old('views', $section->views ?? 0) }}">
            </div>

            {{-- CONTENT (dynamic, one input per field on the linked form) --}}
            <div class="col-md-12">
                <hr class="my-2">
                <label class="form-label fw-semibold">Content</label>

                @php
                    $contentFields = isset($section) && $section->form
                        ? $section->form->fields
                        : collect([
                            (object) ['name' => 'section_label', 'label' => 'Section Label', 'type' => 'text', 'use_ck_editor' => false, 'field_width' => '12'],
                            (object) ['name' => 'section_title', 'label' => 'Section Title', 'type' => 'text', 'use_ck_editor' => false, 'field_width' => '12'],
                            (object) ['name' => 'section_subtitle', 'label' => 'Section Subtitle', 'type' => 'text', 'use_ck_editor' => false, 'field_width' => '12'],
                        ]);
                @endphp

                <div class="row g-3">
                    @foreach ($contentFields as $field)
                        @php
                            $fieldValue = old('content.' . $field->name, $section->content[$field->name] ?? '');
                        @endphp
                        <div class="col-md-{{ $field->field_width ?: 12 }}">
                            <label class="form-label">{{ $field->label ?: $field->name }}</label>

                            @if ($field->type === 'textarea')
                                <textarea name="content[{{ $field->name }}]"
                                          id="content_field_{{ $field->name }}"
                                          class="form-control @if ($field->use_ck_editor ?? false) section-ckeditor-field @endif"
                                          rows="4">{{ $fieldValue }}</textarea>
                            @else
                                <input type="text"
                                       name="content[{{ $field->name }}]"
                                       class="form-control"
                                       value="{{ $fieldValue }}">
                            @endif
                        </div>
                    @endforeach
                </div>

                @if (! isset($section) || ! $section->form)
                    <div class="form-text mt-2">
                        These three fields are always created for a new section. Once saved, you can add more
                        fields (description, list, image, etc.) from "Manage Fields for This Section" above.
                    </div>
                @endif
            </div>

            {{-- SETTINGS (JSON) --}}
            <div class="col-md-6">
                <label class="form-label">Settings (JSON)</label>
                <textarea name="settings"
                          class="form-control json-auto"
                          rows="5">{{
    old('settings',
        isset($section->settings)
            ? json_encode($section->settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
            : ''
    )
}}</textarea>
            </div>

            {{-- SWITCHES --}}
            <div class="col-md-6">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_visible"
                           value="1"
                           {{ old('is_visible', $section->is_visible ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Visible</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $section->is_active ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.sections.index') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">
                {{ isset($section) ? 'Update' : 'Create' }}
            </button>
        </div>

    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof CKEDITOR === 'undefined') {
        return;
    }

    document.querySelectorAll('.section-ckeditor-field').forEach(function (el) {
        CKEDITOR.replace(el.id, { height: 250 });
    });
});
</script>
@endpush
@endsection
