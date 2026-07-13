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
                    <option value="">-- none --</option>
                    @foreach ($forms as $id => $name)
                        <option value="{{ $id }}"
                            {{ old('form_id', $section->form_id ?? '') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

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

            {{-- CONTENT (JSON) --}}
            <div class="col-md-6">
                <label class="form-label">Content (JSON)</label>
                <textarea name="content"
                          class="form-control json-auto"
                          rows="5">{{
    old('content',
        isset($section->content)
            ? json_encode($section->content, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
            : ''
    )
}}</textarea>
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
@endsection
