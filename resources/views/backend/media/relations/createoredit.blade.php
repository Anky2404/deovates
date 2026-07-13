@extends('backend.layouts.app')

@section('title', isset($relation) ? 'Edit Media Relation' : 'Create Media Relation')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">{{ isset($relation) ? 'Edit' : 'Create' }} Media Relation</h5>
    </div>

    <form method="POST"
          action="{{ route('admin.media.relations.saveorupdate', $relation->uuid ?? null) }}">
        @csrf

        <div class="card-body row g-3">

            {{-- MEDIA --}}
            <div class="col-md-6">
                <label class="form-label">Media *</label>
                <select name="media_id" class="form-control" required>
                    <option value="">-- choose media --</option>
                    @foreach ($media as $id => $name)
                        <option value="{{ $id }}"
                            {{ old('media_id', $relation->media_id ?? '') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- MODEL TYPE --}}
            <div class="col-md-3">
                <label class="form-label">Model Type</label>
                <input type="text"
                       name="model_type"
                       class="form-control"
                       placeholder="App\Models\Blog"
                       value="{{ old('model_type', $relation->model_type ?? '') }}">
            </div>

            {{-- MODEL ID --}}
            <div class="col-md-3">
                <label class="form-label">Model ID</label>
                <input type="number"
                       name="model_id"
                       class="form-control"
                       value="{{ old('model_id', $relation->model_id ?? '') }}">
            </div>

            {{-- COLLECTION --}}
            <div class="col-md-4">
                <label class="form-label">Collection</label>
                <input type="text"
                       name="collection"
                       class="form-control"
                       value="{{ old('collection', $relation->collection ?? '') }}">
            </div>

            {{-- USAGE --}}
            <div class="col-md-4">
                <label class="form-label">Usage</label>
                <input type="text"
                       name="usage"
                       class="form-control"
                       value="{{ old('usage', $relation->usage ?? '') }}">
            </div>

            {{-- TAG --}}
            <div class="col-md-4">
                <label class="form-label">Tag</label>
                <input type="text"
                       name="tag"
                       class="form-control"
                       value="{{ old('tag', $relation->tag ?? '') }}">
            </div>

            {{-- DISPLAY ORDER --}}
            <div class="col-md-4">
                <label class="form-label">Display Order</label>
                <input type="number"
                       name="display_order"
                       class="form-control"
                       value="{{ old('display_order', $relation->display_order ?? 0) }}">
            </div>

            {{-- SWITCHES --}}
            <div class="col-md-4">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_primary"
                           value="1"
                           {{ old('is_primary', $relation->is_primary ?? 0) ? 'checked' : '' }}>
                    <label class="form-check-label">Primary</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_featured"
                           value="1"
                           {{ old('is_featured', $relation->is_featured ?? 0) ? 'checked' : '' }}>
                    <label class="form-check-label">Featured</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $relation->is_active ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.media.relations.index') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">
                {{ isset($relation) ? 'Update' : 'Create' }}
            </button>
        </div>

    </form>
</div>
@endsection
