@extends('backend.layouts.app')

@section('title', isset($technology) ? 'Edit Technology' : 'Create Technology')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ isset($technology) ? 'Edit' : 'Create' }} Technology</h5>
    </div>

    <form method="POST"
          action="{{ route('admin.technologies.saveorupdate', $technology->uuid ?? null) }}"
          enctype="multipart/form-data">
        @csrf

        <div class="card-body row g-3">

            {{-- CATEGORY --}}
            <div class="col-md-4">
                <label class="form-label">Technology Category</label>
                <select name="technology_category_id" class="form-control">
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('technology_category_id', $technology->technology_category_id ?? '') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- NAME --}}
            <div class="col-md-4">
                <label class="form-label">Name *</label>
                <input type="text"
                       id="title_input"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $technology->name ?? '') }}"
                       required>
            </div>

            {{-- SLUG --}}
            <div class="col-md-4">
                <label class="form-label">Slug *</label>
                <input type="text"
                       id="slug_input"
                       name="slug"
                       class="form-control"
                       value="{{ old('slug', $technology->slug ?? '') }}"
                       required>
            </div>

            {{-- ICON --}}
            <div class="col-md-4">
                <label class="form-label">Icon Class</label>
                <input type="text"
                       name="icon"
                       class="form-control"
                       placeholder="bx bxl-react"
                       value="{{ old('icon', $technology->icon ?? '') }}">
            </div>

            {{-- IMAGE --}}
            <div class="col-md-4">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control image-preview-input"
                        data-preview="#ImagePreview">

                    <img id="ImagePreview"
                        src="{{ !empty($technology->image) ? asset('storage/' . $technology->image) : 'https://placehold.co/130x130' }}"
                        class="mt-2 rounded border img-thumbnail" height="130" width="130">
            </div>

            {{-- WEBSITE URL --}}
            <div class="col-md-4">
                <label class="form-label">Website URL</label>
                <input type="url"
                       name="website_url"
                       class="form-control"
                       value="{{ old('website_url', $technology->website_url ?? '') }}">
            </div>

            {{-- VERSION --}}
            <div class="col-md-4">
                <label class="form-label">Version</label>
                <input type="text"
                       name="version"
                       class="form-control"
                       value="{{ old('version', $technology->version ?? '') }}">
            </div>
              {{-- ORDER --}}
            <div class="col-md-4">
                <label class="form-label">Display Order</label>
                <input type="number"
                       name="display_order"
                       class="form-control"
                       value="{{ old('display_order', $technology->display_order ?? 0) }}">
            </div>

            {{-- VIEWS --}}
            <div class="col-md-4">
                <label class="form-label">Views</label>
                <input type="number"
                       name="views"
                       class="form-control"
                       value="{{ old('views', $technology->views ?? 0) }}">
            </div>

            {{-- DESCRIPTION --}}
            <div class="col-md-12">
                <label class="form-label">Description</label>
                <textarea name="description" id="description"
                          class="form-control"
                          rows="4">{{ old('description', $technology->description ?? '') }}</textarea>
            </div>

            {{-- SEO --}}
            <div class="col-md-12">
                <label class="form-label">Meta Title</label>
                <input type="text"
                       name="meta_title"
                       class="form-control"
                       value="{{ old('meta_title', $technology->meta_title ?? '') }}">
            </div>

            <div class="col-md-12">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description"
                          class="form-control"
                          rows="2">{{ old('meta_description', $technology->meta_description ?? '') }}</textarea>
            </div>

          

            {{-- SWITCHES --}}
            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $technology->is_active ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_featured"
                           value="1"
                           {{ old('is_featured', $technology->is_featured ?? 0) ? 'checked' : '' }}>
                    <label class="form-check-label">Featured</label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.technologies.index') }}" class="btn btn-secondary">Cancel</a>

            <button class="btn btn-primary">
                {{ isset($technology) ? 'Update' : 'Create' }}
            </button>
        </div>
    </form>
</div>
@endsection
