@extends('backend.layouts.app')

@section('title', isset($category) ? config('constants.BUSINESS.name') . ' | Edit Category' : config('constants.BUSINESS.name') . ' | Create Category')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ isset($category) ? 'Edit' : 'Create' }} Blog Category</h5>
    </div>

    <form method="POST"
          action="{{ route('admin.technologies.categories.saveorupdate', $category->uuid ?? null) }}"
          enctype="multipart/form-data">
        @csrf

        <div class="card-body row g-3">

            {{-- NAME --}}
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text"
                id="title_input"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $category->name ?? '') }}"
                       required>
            </div>

            {{-- SLUG --}}
            <div class="col-md-6">
                <label class="form-label">Slug</label>
                <input type="text"
                id="slug_input"
                       name="slug"
                       class="form-control"
                       value="{{ old('slug', $category->slug ?? '') }}"
                       required>
            </div>

            {{-- ICON --}}
            <div class="col-md-6">
                <label class="form-label">Icon Class</label>
                <input type="text"
                       name="icon"
                       class="form-control"
                       value="{{ old('icon', $category->icon ?? '') }}"
                       placeholder="bx bxl-react">
            </div>

            {{-- IMAGE --}}
            <div class="col-md-6">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control image-preview-input"
                       data-preview="#imagePreview">

                <img id="imagePreview"
                     src="{{ !empty($category->image) ? asset('storage/' . $category->image) : 'https://placehold.co/130x130' }}"
                     class="mt-2 rounded border img-thumbnail" height="130" width="130">
            </div>

            {{-- DESCRIPTION --}}
            <div class="col-md-12">
                <label class="form-label">Description</label>
                <textarea name="description"
                id="description"
                          class="form-control"
                          rows="4">{{ old('description', $category->description ?? '') }}</textarea>
            </div>

            {{-- SEO --}}
            <div class="col-md-12">
                <label class="form-label">Meta Title</label>
                <input type="text"
                       name="meta_title"
                       class="form-control"
                       value="{{ old('meta_title', $category->meta_title ?? '') }}">
            </div>

            <div class="col-md-12">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description"
                          class="form-control"
                          rows="2">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>
            </div>

            {{-- ORDER & VIEWS --}}
            {{-- <div class="col-md-6">
                <label class="form-label">Display Order</label>
                <input type="number"
                       name="display_order"
                       class="form-control"
                       value="{{ old('display_order', $category->display_order ?? 0) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Views</label>
                <input type="number"
                       name="views"
                       class="form-control"
                       value="{{ old('views', $category->views ?? 0) }}">
            </div> --}}

            {{-- SWITCHES --}}
            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $category->is_active ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

            {{-- <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_featured"
                           value="1"
                           {{ old('is_featured', $category->is_featured ?? 0) ? 'checked' : '' }}>
                    <label class="form-check-label">Featured</label>
                </div>
            </div> --}}

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.blogs.categories.index') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">
                {{ isset($category) ? 'Update' : 'Create' }}
            </button>
        </div>
    </form>
</div>
@endsection
