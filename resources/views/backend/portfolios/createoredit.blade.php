@extends('backend.layouts.app')

@section('title', isset($portfolio) ? 'Edit Portfolio' : 'Create Portfolio')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ isset($portfolio) ? 'Edit' : 'Create' }} Portfolio</h5>
        </div>

        <form method="POST" action="{{ route('admin.portfolios.saveorupdate', $portfolio->uuid ?? null) }}"
            enctype="multipart/form-data">
            @csrf

            <div class="card-body row g-3">

                {{-- CATEGORY --}}
                <div class="col-md-4">
                    <label class="form-label">Category</label>
                    <select name="portfolio_category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('portfolio_category_id', $portfolio->portfolio_category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- TITLE --}}
                <div class="col-md-4">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" id="title_input" class="form-control"
                        value="{{ old('title', $portfolio->title ?? '') }}" required>
                </div>

                {{-- SLUG --}}
                <div class="col-md-4">
                    <label class="form-label">Slug *</label>
                    <input type="text" name="slug" id="slug_input" class="form-control"
                        value="{{ old('slug', $portfolio->slug ?? '') }}" required>
                </div>

                {{-- CLIENT NAME --}}
                <div class="col-md-3">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-control"
                        value="{{ old('client_name', $portfolio->client_name ?? '') }}">
                </div>

                {{-- PROJECT URL --}}
                <div class="col-md-3">
                    <label class="form-label">Project URL</label>
                    <input type="url" name="project_url" class="form-control"
                        value="{{ old('project_url', $portfolio->project_url ?? '') }}">
                </div>

                {{-- PROJECT DURATION --}}
                <div class="col-md-3">
                    <label class="form-label">Project Duration</label>
                    <input type="text" name="project_duration" class="form-control"
                        value="{{ old('project_duration', $portfolio->project_duration ?? '') }}">
                </div>

                {{-- PROJECT BUDGET --}}
                <div class="col-md-3">
                    <label class="form-label">Project Budget</label>
                    <input type="text" name="project_budget" class="form-control"
                        value="{{ old('project_budget', $portfolio->project_budget ?? '') }}">
                </div>

                {{-- FEATURED IMAGE --}}
                <div class="col-md-3">
                    <label class="form-label">Featured Image</label>
                     <input type="file" name="featured_image" class="form-control croppie-upload"
                        data-preview="#featuredImagePreview" data-width="800" data-height="600" accept="image/*">

                    <img id="featuredImagePreview"
                        src="{{ !empty($portfolio->featured_image) ? asset('storage/' . $portfolio->featured_image) : 'https://placehold.co/130x130' }}"
                        class="mt-2 rounded border img-thumbnail" height="130" width="130">

                    <input type="text" name="featured_image_alt" class="form-control mt-2"
                        placeholder="Alt text (used for the image name too)"
                        value="{{ old('featured_image_alt', $portfolio->featured_image_alt ?? '') }}">

                </div>

                {{-- BANNER IMAGE --}}
                <div class="col-md-3">
                    <label class="form-label">Banner Image</label>
                     <input type="file" name="banner_image" class="form-control croppie-upload"
                        data-preview="#bannerImagePreview" data-width="1600" data-height="600" accept="image/*">

                    <img id="bannerImagePreview"
                        src="{{ !empty($portfolio->banner_image) ? asset('storage/' . $portfolio->banner_image) : 'https://placehold.co/130x130' }}"
                        class="mt-2 rounded border img-thumbnail" height="130" width="130">

                    <input type="text" name="banner_image_alt" class="form-control mt-2"
                        placeholder="Alt text (used for the image name too)"
                        value="{{ old('banner_image_alt', $portfolio->banner_image_alt ?? '') }}">

                </div>

                {{-- GALLERY (multiple images, each cropped + alt-texted individually) --}}
                <div class="col-md-6">
                    <label class="form-label">Gallery Images</label>

                    <input type="file" class="form-control gallery-cropper-upload"
                        data-container="#galleryItems" data-field="gallery_items"
                        data-start-index="{{ count($portfolio->gallery ?? []) }}"
                        data-width="800" data-height="600" multiple accept="image/*">

                    <div id="galleryItems" class="d-flex flex-wrap gap-2 mt-3">
                        @foreach ($portfolio->gallery ?? [] as $index => $item)
                            <div class="gallery-crop-item position-relative d-inline-block m-1 align-top" style="width:140px;">
                                <button type="button" class="btn btn-danger btn-sm remove-gallery-crop-item"
                                    style="position:absolute; top:2px; right:2px; z-index:9; padding:0 6px;">
                                    &times;
                                </button>

                                <img src="{{ asset('storage/' . $item['path']) }}"
                                    class="rounded border img-thumbnail" width="120" height="120" style="object-fit:cover;">

                                <input type="hidden" name="gallery_items[{{ $index }}][path]" value="{{ $item['path'] }}">
                                <input type="text" name="gallery_items[{{ $index }}][alt]" class="form-control form-control-sm mt-1"
                                    placeholder="Alt text" value="{{ $item['alt'] ?? '' }}">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-6">


                    {{-- DESCRIPTION --}}
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="short_description" class="form-control" rows="6">{{ old('description', $portfolio->description ?? '') }}</textarea>
                    </div>
                    {{-- VIDEO URL --}}
                    <div class="mb-3">
                        <label class="form-label">Video URL</label>
                        <input type="url" name="video_url" class="form-control"
                            value="{{ old('video_url', $portfolio->video_url ?? '') }}">
                    </div>
                    {{-- CANONICAL URL --}}
                    <div class="mb-3">
                        <label class="form-label">Canonical URL</label>
                        <input type="url" name="canonical_url" class="form-control"
                            value="{{ old('canonical_url', $portfolio->canonical_url ?? '') }}">

                    </div>
                </div>

                {{-- OVERVIEW --}}
                <div class="col-md-6">
                    <label class="form-label">Overview</label>
                    <textarea name="overview" class="form-control" id="description" rows="3">{{ old('overview', $portfolio->overview ?? '') }}</textarea>
                </div>



                {{-- CHALLENGES --}}
                <div class="col-md-4">
                    <label class="form-label">Challenges</label>
                    <textarea name="challenges" class="form-control" rows="3">{{ old('challenges', $portfolio->challenges ?? '') }}</textarea>
                </div>

                {{-- SOLUTIONS --}}
                <div class="col-md-4">
                    <label class="form-label">Solutions</label>
                    <textarea name="solutions" class="form-control" rows="3">{{ old('solutions', $portfolio->solutions ?? '') }}</textarea>
                </div>

                {{-- RESULTS --}}
                <div class="col-md-4">
                    <label class="form-label">Results</label>
                    <textarea name="results" class="form-control" rows="3">{{ old('results', $portfolio->results ?? '') }}</textarea>
                </div>



                {{-- INDUSTRY --}}
                <div class="col-md-4">
                    <label class="form-label">Industry</label>
                    <input type="text" name="industry" class="form-control"
                        value="{{ old('industry', $portfolio->industry ?? '') }}">
                </div>

                {{-- PUBLISHED AT --}}
                <div class="col-md-4">
                    <label class="form-label">Published At</label>
                    <input type="datetime-local" name="published_at" class="form-control"
                        value="{{ old('published_at', isset($portfolio->published_at) ? $portfolio->published_at->format('Y-m-d\TH:i') : '') }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Project Type</label>
                    <input type="text" name="project_type" class="form-control"
                        value="{{ old('project_type', $portfolio->project_type ?? '') }}">
                </div>
                {{-- DISPLAY ORDER --}}
                <div class="col-md-4">
                    <label class="form-label">Display Order</label>
                    <input type="number" name="display_order" class="form-control"
                        value="{{ old('display_order', $portfolio->display_order ?? 0) }}">
                </div>
                {{-- VIEWS --}}
                <div class="col-md-4">
                    <label class="form-label">Views</label>
                    <input type="number" name="views" class="form-control"
                        value="{{ old('views', $portfolio->views ?? 0) }}">
                </div>

                {{-- SEO --}}
                <div class="col-md-4">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control"
                        value="{{ old('meta_title', $portfolio->meta_title ?? '') }}">
                </div>



                <div class="col-md-6">
                    <label class="form-label">Meta Keywords (comma-separated)</label>

                    <textarea name="meta_keywords" id="meta_input" class="form-control json-auto" rows="3"
                        placeholder="seo, blog, marketing">{{ old('meta', !empty($portfolio->meta_keywords) ? json_encode($portfolio->meta_keywords, JSON_UNESCAPED_UNICODE) : '') }}</textarea>

                </div>

                <div class="col-md-6">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $portfolio->meta_description ?? '') }}</textarea>
                </div>
                {{-- SWITCHES --}}
                <div class="col-md-6">
                    <div class="form-check form-switch mt-4">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1"
                            {{ old('is_featured', $portfolio->is_featured ?? 0) ? 'checked' : '' }}>
                        <label class="form-check-label">Featured</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-check form-switch mt-4">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $portfolio->is_active ?? 1) ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>



            </div>

            <div class="card-footer text-end">
                <a href="{{ route('admin.portfolios.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    {{ isset($portfolio) ? 'Update' : 'Create' }}
                </button>
            </div>

        </form>
    </div>

    {{-- CROP MODAL (powers the croppie-upload / gallery-cropper-upload fields above) --}}
    @include('backend.partials.modal')
@endsection
