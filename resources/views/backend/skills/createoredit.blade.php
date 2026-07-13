@extends('backend.layouts.app')

@section('title', isset($skill) ? 'Edit Skill' : 'Create Skill')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">{{ isset($skill) ? 'Edit' : 'Create' }} Skill</h5>
    </div>

    <form method="POST"
          action="{{ route('admin.skills.saveorupdate', $skill->uuid ?? null) }}"
          enctype="multipart/form-data">
        @csrf

        <div class="card-body row g-3">

            {{-- NAME --}}
            <div class="col-md-4">
                <label class="form-label">Name *</label>
                <input type="text"
                       name="name"
                       id="title_input"
                       class="form-control"
                       value="{{ old('name', $skill->name ?? '') }}"
                       required>
            </div>

            {{-- SLUG --}}
            <div class="col-md-4">
                <label class="form-label">Slug *</label>
                <input type="text"
                        id="slug_input"
                       name="slug"
                       class="form-control"
                       value="{{ old('slug', $skill->slug ?? '') }}"
                       required>
            </div>

           {{-- ICON --}}
<div class="col-md-4">
    <label class="form-label">Icon Class</label>
    <input type="text"
           name="icon"
           class="form-control"
           placeholder="bx bx-star"
           value="{{ old('icon', $skill->icon ?? '') }}">
</div>

            {{-- TECHNOLOGY --}}
            <div class="col-md-3">
                <label class="form-label">Technology</label>
                <select name="technology_id" class="form-control">
                    <option value="">-- Select Technology --</option>
                    @foreach($technologies as $tech)
                        <option value="{{ $tech->id }}"
                            {{ old('technology_id', $skill->technology_id ?? '') == $tech->id ? 'selected' : '' }}>
                            {{ $tech->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- TYPE --}}
            <div class="col-md-3">
                <label class="form-label">Type</label>
                <input type="text"
                       name="type"
                       class="form-control"
                       value="{{ old('type', $skill->type ?? '') }}">
            </div>

            {{-- DISPLAY ORDER --}}
            <div class="col-md-3">
                <label class="form-label">Display Order</label>
                <input type="number"
                       name="display_order"
                       class="form-control"
                       value="{{ old('display_order', $skill->display_order ?? 0) }}">
            </div>

            {{-- USAGE COUNT --}}
            <div class="col-md-3">
                <label class="form-label">Usage Count</label>
                <input type="number"
                       name="usage_count"
                       class="form-control"
                       value="{{ old('usage_count', $skill->usage_count ?? 0) }}">
            </div>

            {{-- DESCRIPTION --}}
            <div class="col-md-12">
                <label class="form-label">Description</label>
                <textarea name="description"
                          class="form-control"
                          rows="4">{{ old('description', $skill->description ?? '') }}</textarea>
            </div>

            {{-- SWITCHES --}}
            <div class="col-md-6">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_featured"
                           value="1"
                           {{ old('is_featured', $skill->is_featured ?? 0) ? 'checked' : '' }}>
                    <label class="form-check-label">Featured</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $skill->is_active ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">
                {{ isset($skill) ? 'Update' : 'Create' }}
            </button>
        </div>

    </form>
</div>
@endsection