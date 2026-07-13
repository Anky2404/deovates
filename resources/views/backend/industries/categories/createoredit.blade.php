@extends('backend.layouts.app')

@section('title', isset($category) ? 'Deovate | Edit Industry Category' : 'Deovate | Create Industry Category')

@section('content')

<div class="card">


<div class="card-header">
    <h5 class="mb-0">
        {{ isset($category) ? 'Edit' : 'Create' }} Industry Category
    </h5>
</div>

<form method="POST"
      action="{{ route('admin.marketing.industries.categories.saveorupdate', $category->uuid ?? null) }}">

    @csrf

    <div class="card-body row g-3">

        {{-- NAME --}}
        <div class="col-md-6">
            <label class="form-label">Category Name</label>

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
                   placeholder="bx bx-category">
        </div>

        {{-- STATUS --}}
        <div class="col-md-6">
            <div class="form-check form-switch mt-4">

                <input class="form-check-input"
                       type="checkbox"
                       name="is_active"
                       value="1"
                       {{ old('is_active', $category->is_active ?? 1) ? 'checked' : '' }}>

                <label class="form-check-label">
                    Active
                </label>

            </div>
        </div>

        {{-- DESCRIPTION --}}
        <div class="col-md-12">
            <label class="form-label">Description</label>

            <textarea name="description"
                      id="description"
                      class="form-control"
                      rows="5">{{ old('description', $category->description ?? '') }}</textarea>
        </div>

    </div>

    <div class="card-footer text-end">

        <a href="{{ route('admin.marketing.industries.categories.index') }}"
           class="btn btn-secondary">
            Cancel
        </a>

        <button type="submit" class="btn btn-primary">
            {{ isset($category) ? 'Update Category' : 'Create Category' }}
        </button>

    </div>

</form>


</div>

@endsection
