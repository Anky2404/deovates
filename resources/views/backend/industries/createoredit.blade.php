@extends('backend.layouts.app')

@section('title', isset($industry) ? 'Deovate | Edit Industry' : 'Deovate | Create Industry')

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
                    <label class="form-label">Icon</label>

                    <input type="text" name="icon" class="form-control" placeholder="bx bx-building"
                        value="{{ old('icon', $industry->icon ?? '') }}">
                </div>

                {{-- IMAGE --}}
                <div class="col-md-4">

                    <label class="form-label">Image</label>

                    <input type="file" name="image" class="form-control image-preview-input"
                        data-preview="#industryImagePreview">

                    <img id="industryImagePreview"
                        src="{{ !empty($industry->image) ? asset('storage/' . $industry->image) : 'https://placehold.co/130x130' }}"
                        class="mt-2 rounded border img-thumbnail" height="130" width="130">

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

                    <textarea name="description" id="description" rows="5" class="form-control">{{ old('description', $industry->description ?? '') }}</textarea>
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
