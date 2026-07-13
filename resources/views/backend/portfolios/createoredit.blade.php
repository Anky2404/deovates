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
                     <input type="file" name="featured_image" class="form-control image-preview-input"
                        data-preview="#featuredImagePreview">

                    <img id="featuredImagePreview"
                        src="{{ !empty($portfolio->featured_image) ? asset('storage/' . $portfolio->featured_image) : 'https://placehold.co/130x130' }}"
                        class="mt-2 rounded border img-thumbnail" height="130" width="130">

                </div>

                {{-- BANNER IMAGE --}}
                <div class="col-md-3">
                    <label class="form-label">Banner Image</label>
                     <input type="file" name="banner_image" class="form-control image-preview-input"
                        data-preview="#bannerImagePreview">

                    <img id="bannerImagePreview"
                        src="{{ !empty($portfolio->banner_image) ? asset('storage/' . $portfolio->banner_image) : 'https://placehold.co/130x130' }}"
                        class="mt-2 rounded border img-thumbnail" height="130" width="130">

                </div>

                {{-- GALLERY (multiple images) --}}
                <div class="col-md-6">
                    <label class="form-label">Gallery Images</label>

                        <input type="file" name="gallery[]" class="form-control image-preview-input"
                            id="galleryInput" data-preview="#galleryPreview" multiple>

                        <div id="galleryPreview" data-input="#galleryInput" class="d-flex flex-wrap gap-2 mt-3">

                            @if (!empty($portfolio->gallery))

                                @php
                                    $galleryImages = is_array($portfolio->gallery)
                                        ? $portfolio->gallery
                                        : json_decode($portfolio->gallery, true);
                                @endphp

                                @foreach ($galleryImages as $key => $gallery)
                                    <div class="position-relative d-inline-block m-1 old-gallery-item"
                                        data-image="{{ $gallery }}">

                                        <button type="button" class="btn btn-danger btn-sm remove-old-image"
                                            style="position:absolute; top:5px; right:5px; z-index:9; padding:0px 6px;">
                                            ×
                                        </button>

                                        <img src="{{ asset('storage/' . $gallery) }}"
                                            class="rounded border img-thumbnail" width="80" height="80">

                                        <input type="hidden" name="old_gallery[]" value="{{ $gallery }}">

                                    </div>
                                @endforeach

                            @endif

                        </div>
                    {{-- store deleted image ids --}}
                    {{-- <input type="hidden" name="deleted_images" id="deletedImages"> --}}

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
@endsection
