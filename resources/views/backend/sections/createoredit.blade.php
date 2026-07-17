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
            <div class="col-md-4">
                <label class="form-label">Display Order</label>
                <input type="number"
                       name="display_order"
                       class="form-control"
                       value="{{ old('display_order', $section->display_order ?? 0) }}">
            </div>

            {{-- SWITCHES --}}
            <div class="col-md-4">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_visible"
                           value="1"
                           {{ old('is_visible', $section->is_visible ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Visible</label>
                </div>
            </div>

            <div class="col-md-4">
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
