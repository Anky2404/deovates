@extends('backend.layouts.app')

@section('title', isset($platform) ? 'Edit Platform' : 'Create Platform')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">{{ isset($platform) ? 'Edit' : 'Create' }} Platform</h5>
    </div>

    <form method="POST"
          action="{{ route('admin.platforms.saveorupdate', $platform->uuid ?? null) }}">
        @csrf

        <div class="card-body row g-3">

            {{-- NAME --}}
            <div class="col-md-4">
                <label class="form-label">Name *</label>
                <input type="text"
                       id="title_input"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $platform->name ?? '') }}"
                       required>
            </div>

            {{-- SLUG --}}
            <div class="col-md-4">
                <label class="form-label">Slug *</label>
                <input type="text"
                       name="slug"
                       id="slug_input"
                       class="form-control"
                       value="{{ old('slug', $platform->slug ?? '') }}"
                       required>
            </div>

            {{-- ICON --}}
            <div class="col-md-4">
                @include('backend.partials.icon-picker-field', [
                    'name' => 'icon',
                    'value' => old('icon', $platform->icon ?? ''),
                    'placeholder' => 'bx bx-mobile',
                ])
            </div>

            {{-- DESCRIPTION --}}
            <div class="col-md-12">
                <label class="form-label">Description</label>
                <textarea name="description"
                          class="form-control"
                          rows="4">{{ old('description', $platform->description ?? '') }}</textarea>
            </div>

            {{-- DISPLAY ORDER --}}
            <div class="col-md-4">
                <label class="form-label">Display Order</label>
                <input type="number"
                       name="display_order"
                       class="form-control"
                       value="{{ old('display_order', $platform->display_order ?? 0) }}">
            </div>

            {{-- SWITCHES --}}
            <div class="col-md-4">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_featured"
                           value="1"
                           {{ old('is_featured', $platform->is_featured ?? 0) ? 'checked' : '' }}>
                    <label class="form-check-label">Featured</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $platform->is_active ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.platforms.index') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">
                {{ isset($platform) ? 'Update' : 'Create' }}
            </button>
        </div>

    </form>
</div>
@endsection
