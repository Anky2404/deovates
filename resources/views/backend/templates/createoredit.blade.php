@extends('backend.layouts.app')

@section('title', isset($template) ? 'Edit Template' : 'Create Template')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">{{ isset($template) ? 'Edit' : 'Create' }} Template</h5>
    </div>

    <form method="POST"
          action="{{ route('admin.templates.saveorupdate', $template->uuid ?? null) }}">
        @csrf

        <div class="card-body row g-3">

            {{-- NAME --}}
            <div class="col-md-4">
                <label class="form-label">Name *</label>
                <input type="text"
                       id="title_input"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $template->name ?? '') }}"
                       required>
            </div>

            {{-- SLUG --}}
            <div class="col-md-4">
                <label class="form-label">Slug *</label>
                <input type="text"
                       name="slug"
                       id="slug_input"
                       class="form-control"
                       value="{{ old('slug', $template->slug ?? '') }}"
                       required>
            </div>

            {{-- TYPE --}}
            <div class="col-md-4">
                <label class="form-label">Type</label>
                <input type="text"
                       name="type"
                       class="form-control"
                       placeholder="e.g. page, email, blog"
                       value="{{ old('type', $template->type ?? '') }}">
            </div>

            {{-- DESCRIPTION --}}
            <div class="col-md-12">
                <label class="form-label">Description</label>
                <textarea name="description"
                          class="form-control"
                          rows="3">{{ old('description', $template->description ?? '') }}</textarea>
            </div>

            {{-- LAYOUTS (JSON) --}}
            <div class="col-md-6">
                <label class="form-label">Layouts (JSON)</label>
                <textarea name="layouts"
                          class="form-control json-auto"
                          rows="5">{{
    old('layouts',
        isset($template->layouts)
            ? json_encode($template->layouts, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
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
        isset($template->settings)
            ? json_encode($template->settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
            : ''
    )
}}</textarea>
            </div>

            {{-- SEO --}}
            <div class="col-md-6">
                <label class="form-label">Meta Title</label>
                <input type="text"
                       name="meta_title"
                       class="form-control"
                       value="{{ old('meta_title', $template->meta_title ?? '') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description"
                          class="form-control"
                          rows="2">{{ old('meta_description', $template->meta_description ?? '') }}</textarea>
            </div>

            {{-- USAGE COUNT --}}
            <div class="col-md-4">
                <label class="form-label">Usage Count</label>
                <input type="number"
                       name="usage_count"
                       class="form-control"
                       value="{{ old('usage_count', $template->usage_count ?? 0) }}">
            </div>

            {{-- SWITCHES --}}
            <div class="col-md-4">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_default"
                           value="1"
                           {{ old('is_default', $template->is_default ?? 0) ? 'checked' : '' }}>
                    <label class="form-check-label">Default</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $template->is_active ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.templates.index') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">
                {{ isset($template) ? 'Update' : 'Create' }}
            </button>
        </div>

    </form>
</div>
@endsection
