@extends('backend.layouts.app')

@section('title', isset($tag) ? 'Edit Tag' : 'Create Tag')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">{{ isset($tag) ? 'Edit' : 'Create' }} Tag</h5>
    </div>

    <form method="POST"
          action="{{ route('admin.tags.saveorupdate', $tag->uuid ?? null) }}">
        @csrf

        <div class="card-body row g-3">

            {{-- NAME --}}
            <div class="col-md-6">
                <label class="form-label">Name *</label>
                <input type="text"
                       name="name"
                       id="title_input"
                       class="form-control"
                       value="{{ old('name', $tag->name ?? '') }}"
                       required>
            </div>

            {{-- SLUG --}}
            <div class="col-md-6">
                <label class="form-label">Slug *</label>
                <input type="text"
                       name="slug"
                       id="slug_input"
                       class="form-control"
                       value="{{ old('slug', $tag->slug ?? '') }}"
                       required>
            </div>

            {{-- META TITLE --}}
            <div class="col-md-6">
                <label class="form-label">Meta Title</label>
                <input type="text"
                       name="meta_title"
                       class="form-control"
                       value="{{ old('meta_title', $tag->meta_title ?? '') }}">
            </div>

            {{-- META DESCRIPTION --}}
            <div class="col-md-6">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description"
                          class="form-control"
                          rows="2">{{ old('meta_description', $tag->meta_description ?? '') }}</textarea>
            </div>

            {{-- ACTIVE SWITCH --}}
            <div class="col-md-6">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $tag->is_active ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">
                {{ isset($tag) ? 'Update' : 'Create' }}
            </button>
        </div>

    </form>
</div>
@endsection
