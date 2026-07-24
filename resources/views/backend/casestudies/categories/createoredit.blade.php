@extends('backend.layouts.app')

@section('title', isset($category) ? config('constants.BUSINESS.name') . ' | Edit Case Study Category' : config('constants.BUSINESS.name') . ' | Create Case Study Category')

@section('content')

<div class="card">

    <div class="card-header">
        <h5 class="mb-0">
            {{ isset($category) ? 'Edit' : 'Create' }} Case Study Category
        </h5>
    </div>

    <form method="POST"
          action="{{ route('admin.casestudies.categories.saveorupdate', $category->uuid ?? null) }}"
          enctype="multipart/form-data">

        @csrf

        <div class="card-body row g-3">

            {{-- NAME --}}
            <div class="col-md-6">
                <label class="form-label">Name</label>

                <input
                    type="text"
                    id="title_input"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $category->name ?? '') }}"
                    required>
            </div>

            {{-- SLUG --}}
            <div class="col-md-6">
                <label class="form-label">Slug</label>

                <input
                    type="text"
                    id="slug_input"
                    name="slug"
                    class="form-control"
                    value="{{ old('slug', $category->slug ?? '') }}"
                    required>
            </div>

            {{-- ICON --}}
            <div class="col-md-6">
                @include('backend.partials.icon-picker-field', [
                    'name' => 'icon',
                    'label' => 'Icon (Boxicons Class)',
                    'value' => old('icon', $category->icon ?? ''),
                    'placeholder' => 'bx bx-line-chart',
                ])
            </div>

            {{-- IMAGE --}}

             <div class="col-md-6">

                        @include('backend.partials.image-upload-box', [
                            'name' => 'image',
                            'label' => 'Image',
                            'previewId' => 'imagePreview',
                            'previewUrl' => !empty($category->image) ? asset('storage/' . $category->image) : null,
                            'width' => 800,
                            'height' => 600,
                            'altName' => 'image_alt',
                            'altValue' => old('featured_image_alt', $category->image ?? ''),
                        ])

                    </div>
            

            {{-- DESCRIPTION --}}
            <div class="col-md-12">
                <label class="form-label">Description</label>

                <textarea
                    name="description"
                    id="description"
                    class="form-control"
                    rows="4">{{ old('description', $category->description ?? '') }}</textarea>
            </div>

             {{-- DISPLAY ORDER --}}
            <div class="col-md-6">
                <label class="form-label">Display Order</label>

                <input
                    type="number"
                    name="display_order"
                    class="form-control"
                    value="{{ old('display_order', $category->display_order ?? 0) }}">
            </div>

            {{-- META TITLE --}}
            <div class="col-md-6">
                <label class="form-label">Meta Title</label>

                <input
                    type="text"
                    name="meta_title"
                    class="form-control"
                    value="{{ old('meta_title', $category->meta_title ?? '') }}">
            </div>

            {{-- META DESCRIPTION --}}
            <div class="col-md-12">
                <label class="form-label">Meta Description</label>

                <textarea
                    name="meta_description"
                    class="form-control"
                    rows="2">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>
            </div>



            {{-- ACTIVE SWITCH --}}
            <div class="col-md-3">
                <div class="form-check form-switch mt-4">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', $category->is_active ?? 1) ? 'checked' : '' }}>

                    <label class="form-check-label">
                        Active
                    </label>

                </div>
            </div>

            {{-- FEATURED SWITCH --}}
            <div class="col-md-3">
                <div class="form-check form-switch mt-4">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="is_featured"
                        value="1"
                        {{ old('is_featured', $category->is_featured ?? 0) ? 'checked' : '' }}>

                    <label class="form-check-label">
                        Featured
                    </label>

                </div>
            </div>

        </div>

        <div class="card-footer text-end">

            <a href="{{ route('admin.casestudies.categories.index') }}"
               class="btn btn-secondary">
                Cancel
            </a>

            <button class="btn btn-primary">
                {{ isset($category) ? 'Update Category' : 'Create Category' }}
            </button>

        </div>

    </form>

</div>

@endsection
