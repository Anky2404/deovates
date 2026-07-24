@extends('backend.layouts.app')

@section('title', isset($industry) ? config('constants.BUSINESS.name') . ' | Edit Industry' : config('constants.BUSINESS.name') . ' | Create Industry')

@section('content')

    <div class="card">


        <div class="card-header">
            <h5 class="mb-0">
                {{ isset($industry) ? 'Edit Industry' : 'Create Industry' }}
            </h5>
        </div>

        <form method="POST" action="{{ route('admin.marketing.industries.saveorupdate', $industry->uuid ?? null) }}"
            enctype="multipart/form-data">

            @csrf

            <div class="card-body row g-3">

                {{-- CATEGORY ID --}}
                <div class="col-md-4">
                    <label class="form-label">Category</label>

                    <select name="category_id" class="form-select" required>
                        <option value="">Select Category</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $industry->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>



                {{-- NAME --}}
                <div class="col-md-4">
                    <label class="form-label">Industry Name</label>

                    <input type="text" id="title_input" name="name" class="form-control"
                        value="{{ old('name', $industry->name ?? '') }}" required>
                </div>

                {{-- SLUG --}}
                <div class="col-md-4">
                    <label class="form-label">Slug</label>

                    <input type="text" id="slug_input" name="slug" class="form-control"
                        value="{{ old('slug', $industry->slug ?? '') }}" required>
                </div>

                {{-- ICON --}}
                <div class="col-md-4">
                    @include('backend.partials.icon-picker-field', [
                        'name' => 'icon',
                        'value' => old('icon', $industry->icon ?? ''),
                        'placeholder' => 'bx bx-building',
                    ])
                </div>

                {{-- IMAGE --}}
                <div class="col-md-4">

                    @include('backend.partials.simple-image-upload-box', [
                        'name' => 'image',
                        'label' => 'Image',
                        'previewId' => 'industryImagePreview',
                        'previewUrl' => !empty($industry->image) ? asset('storage/' . $industry->image) : null,
                    ])

                </div>
                {{-- DISPLAY ORDER --}}
                <div class="col-md-4">
                    <label class="form-label">Display Order</label>

                    <input type="number" name="display_order" class="form-control"
                        value="{{ old('display_order', $industry->display_order ?? 0) }}">
                </div>

                {{-- DESCRIPTION --}}
                <div class="col-md-12">
                    <label class="form-label">Description</label>

                    <textarea name="description" id="description_input" rows="5" data-ck-height="300" class="form-control ckeditor-field">{{ old('description', $industry->description ?? '') }}</textarea>
                </div>

                {{-- META TITLE --}}
                <div class="col-md-6">
                    <label class="form-label">Meta Title</label>

                    <input type="text" name="meta_title" class="form-control"
                        value="{{ old('meta_title', $industry->meta_title ?? '') }}">
                </div>

                {{-- VIEWS --}}
                <div class="col-md-6">
                    <label class="form-label">Views</label>

                    <input type="number" class="form-control" value="{{ $industry->views ?? 0 }}" readonly>
                </div>


                {{-- META DESCRIPTION --}}
                <div class="col-md-12">
                    <label class="form-label">Meta Description</label>

                    <textarea name="meta_description" rows="3" class="form-control">{{ old('meta_description', $industry->meta_description ?? '') }}</textarea>
                </div>


                {{-- ACTIVE --}}
                <div class="col-md-3">
                    <div class="form-check form-switch mt-4">

                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $industry->is_active ?? 1) ? 'checked' : '' }}>

                        <label class="form-check-label">
                            Active
                        </label>

                    </div>
                </div>

                {{-- FEATURED --}}
                <div class="col-md-3">
                    <div class="form-check form-switch mt-4">

                        <input class="form-check-input" type="checkbox" name="is_featured" value="1"
                            {{ old('is_featured', $industry->is_featured ?? 0) ? 'checked' : '' }}>

                        <label class="form-check-label">
                            Featured
                        </label>

                    </div>
                </div>

            </div>

            <div class="card-footer text-end">

                <a href="{{ route('admin.marketing.industries.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

                <button type="submit" class="btn btn-primary">
                    {{ isset($industry) ? 'Update Industry' : 'Create Industry' }}
                </button>

            </div>

        </form>


    </div>

@endsection
