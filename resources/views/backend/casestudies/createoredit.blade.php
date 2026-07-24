@extends('backend.layouts.app')

@section('title', isset($caseStudy) ? 'Edit Case Study' : 'Create Case Study')

@section('content')

    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">
                {{ isset($caseStudy) ? 'Edit Case Study' : 'Create Case Study' }}
            </h5>
        </div>

        <form method="POST" action="{{ route('admin.casestudies.saveorupdate', $caseStudy->uuid ?? null) }}"
            enctype="multipart/form-data">

            @csrf

            <div class="card-body row g-3">
                {{-- CATEGORY --}}
                <div class="col-md-4">
                    <label class="form-label">Category</label>

                    <select name="case_study_category_id" class="form-control">

                        <option value="">-- Select Category --</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('case_study_category_id', $caseStudy->case_study_category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- TITLE --}}
                <div class="col-md-4">
                    <label class="form-label">Title *</label>

                    <input type="text" id="title_input" name="title" class="form-control"
                        value="{{ old('title', $caseStudy->title ?? '') }}" required>
                </div>

                {{-- SLUG --}}
                <div class="col-md-4">
                    <label class="form-label">Slug *</label>

                    <input type="text" id="slug_input" name="slug" class="form-control"
                        value="{{ old('slug', $caseStudy->slug ?? '') }}" required>
                </div>



                {{-- CLIENT NAME --}}
                <div class="col-md-3">
                    <label class="form-label">Client Name</label>

                    <input type="text" name="client_name" class="form-control"
                        value="{{ old('client_name', $caseStudy->client_name ?? '') }}">
                </div>

                {{-- INDUSTRY --}}
                <div class="col-md-3">
                    <label class="form-label">Industry</label>

                    <input type="text" name="industry" class="form-control"
                        value="{{ old('industry', $caseStudy->industry ?? '') }}">
                </div>

                {{-- PROJECT DURATION --}}
                <div class="col-md-3">
                    <label class="form-label">Project Duration</label>

                    <input type="text" name="project_duration" class="form-control"
                        value="{{ old('project_duration', $caseStudy->project_duration ?? '') }}">
                </div>

                {{-- PROJECT BUDGET --}}
                <div class="col-md-3">
                    <label class="form-label">Project Budget</label>

                    <input type="text" name="project_budget" class="form-control"
                        value="{{ old('project_budget', $caseStudy->project_budget ?? '') }}">
                </div>

                {{-- VIDEO URL --}}
                <div class="col-md-3">
                    @include('backend.partials.url-input', ['name' => 'video_url', 'label' => 'Video URL', 'value' => $caseStudy->video_url ?? ''])
                </div>

                {{-- CANONICAL URL --}}
                <div class="col-md-3">
                    @include('backend.partials.url-input', ['name' => 'canonical_url', 'label' => 'Canonical URL', 'value' => $caseStudy->canonical_url ?? ''])
                </div>

                {{-- DISPLAY ORDER --}}
                <div class="col-md-3">
                    <label class="form-label">Display Order</label>

                    <input type="number" name="display_order" class="form-control"
                        value="{{ old('display_order', $caseStudy->display_order ?? 0) }}">
                </div>

                {{-- PUBLISHED AT --}}
                <div class="col-md-3">
                    <label class="form-label">Published At</label>

                    <input type="datetime-local" name="published_at" class="form-control"
                        value="{{ old('published_at', isset($caseStudy->published_at) ? $caseStudy->published_at->format('Y-m-d\TH:i') : '') }}">
                </div>

                <div class="row">

                    <div class="col-md-6">

                        @include('backend.partials.image-upload-box', [
                            'name' => 'featured_image',
                            'label' => 'Featured Image',
                            'previewId' => 'featuredImagePreview',
                            'previewUrl' => !empty($caseStudy->featured_image) ? asset('storage/' . $caseStudy->featured_image) : null,
                            'width' => 800,
                            'height' => 600,
                            'altName' => 'featured_image_alt',
                            'altValue' => old('featured_image_alt', $caseStudy->featured_image_alt ?? ''),
                        ])

                    </div>

                    <div class="col-md-6">

                        @include('backend.partials.image-upload-box', [
                            'name' => 'banner_image',
                            'label' => 'Banner Image',
                            'previewId' => 'bannerImagePreview',
                            'previewUrl' => !empty($caseStudy->banner_image) ? asset('storage/' . $caseStudy->banner_image) : null,
                            'width' => 1600,
                            'height' => 600,
                            'altName' => 'banner_image_alt',
                            'altValue' => old('banner_image_alt', $caseStudy->banner_image_alt ?? ''),
                        ])

                    </div>
                </div>
  <div class="row">
                    <div class="col-md-12">

                        @include('backend.partials.gallery-upload-box', [
                            'containerId' => 'galleryItems',
                            'field' => 'gallery_items',
                            'startIndex' => isset($caseStudy) ? $caseStudy->galleryMedia->count() : 0,
                            'width' => 800,
                            'height' => 600,
                        ])

                        <div id="galleryItems" class="gallery-sortable d-flex flex-wrap gap-2 mt-3"
                            data-reorder-url="{{ isset($caseStudy) ? route('admin.casestudies.galleryreorder', $caseStudy->uuid) : '' }}"
                            data-uuid="{{ $caseStudy->uuid ?? '' }}">
                            @foreach ((isset($caseStudy) ? $caseStudy->galleryMedia : collect()) as $index => $item)
                                <div class="gallery-crop-item position-relative d-inline-block m-1 align-top"
                                    style="width:140px;" data-id="{{ $item->uuid }}">
                                    <span class="gallery-drag-handle" title="Drag to reorder"
                                        style="position:absolute;top:2px;left:2px;z-index:9;cursor:move;background:#fff;border-radius:3px;padding:0 4px;font-size:14px;line-height:1.4;">&#9776;</span>

                                    <button type="button" class="btn btn-danger btn-sm remove-gallery-crop-item"
                                        style="position:absolute; top:2px; right:2px; z-index:9; padding:0 6px;">
                                        &times;
                                    </button>

                                    <img src="{{ $item->url }}"
                                        class="rounded border img-thumbnail" width="120" height="120" style="object-fit:cover;">

                                    <input type="hidden" name="gallery_items[{{ $index }}][id]" value="{{ $item->uuid }}">
                                    <input type="text" name="gallery_items[{{ $index }}][title]" class="form-control form-control-sm mt-1"
                                        placeholder="Title" value="{{ $item->caption }}">
                                    <input type="text" name="gallery_items[{{ $index }}][alt]" class="form-control form-control-sm mt-1"
                                        placeholder="Alt text" value="{{ $item->alt_text }}">
                                    <button type="button" class="btn btn-outline-secondary btn-sm copy-gallery-link w-100 mt-1"
                                        data-path="{{ $item->path }}" title="Copy image path">
                                        <i class="bx bx-link"></i> Copy link
                                    </button>
                                </div>
                            @endforeach
                        </div>

                    </div>



                </div>

                {{-- OVERVIEW + CHALLENGES (side-by-side, both CKEditor) --}}
                <div class="row g-3 mx-0 w-100">
                    <div class="col-md-6">
                        <label class="form-label">Overview</label>
                        <textarea name="overview" id="overview_input" class="form-control ckeditor-field"
                            data-ck-height="250" rows="4">{{ old('overview', $caseStudy->overview ?? '') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Challenges</label>
                        <textarea name="challenges" id="challenges_input" class="form-control ckeditor-field"
                            data-ck-height="250" rows="4">{{ old('challenges', $caseStudy->challenges ?? '') }}</textarea>
                    </div>
                </div>

                {{-- SOLUTIONS --}}
                <div class="col-md-6">
                    <label class="form-label">Solutions</label>

                    <textarea name="solutions" class="form-control" rows="4">{{ old('solutions', $caseStudy->solutions ?? '') }}</textarea>
                </div>

                {{-- RESULTS --}}
                <div class="col-md-6">
                    <label class="form-label">Results</label>

                    <textarea name="results" class="form-control" rows="4">{{ old('results', $caseStudy->results ?? '') }}</textarea>
                </div>

                {{-- TESTIMONIAL --}}
                <div class="col-md-6">
                    <label class="form-label">Client Testimonial</label>

                    <textarea name="testimonial" class="form-control" rows="4">{{ old('testimonial', $caseStudy->testimonial ?? '') }}</textarea>
                </div>



                {{-- META TITLE --}}
                <div class="col-md-12">
                    <label class="form-label">Meta Title</label>

                    <input type="text" name="meta_title" class="form-control"
                        value="{{ old('meta_title', $caseStudy->meta_title ?? '') }}">
                </div>
                {{-- KEY METRICS --}}
                <div class="col-md-4">
                    <label class="form-label">Key Metrics (comma separated)</label>

                    <textarea name="key_metrics" class="form-control" rows="3">{{ old('key_metrics', isset($caseStudy->key_metrics) ? implode(',', $caseStudy->key_metrics) : '') }}</textarea>
                </div>

                {{-- META DESCRIPTION --}}
                <div class="col-md-4">
                    <label class="form-label">Meta Description</label>

                    <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $caseStudy->meta_description ?? '') }}</textarea>
                </div>

                {{-- META KEYWORDS --}}
                <div class="col-md-4">
                    <label class="form-label">Meta Keywords (JSON Array)</label>

                    <textarea name="meta_keywords" class="form-control json-auto" rows="3"
                        placeholder="local seo, google business profile">{{ old('meta_keywords', !empty($caseStudy->meta_keywords) ? json_encode($caseStudy->meta_keywords, JSON_UNESCAPED_UNICODE) : '') }}</textarea>
                </div>



                {{-- SWITCHES --}}
                <div class="col-md-6 mt-3">

                    <div class="form-check form-switch">

                        <input class="form-check-input" type="checkbox" name="is_featured" value="1"
                            {{ old('is_featured', $caseStudy->is_featured ?? 0) ? 'checked' : '' }}>

                        <label class="form-check-label">
                            Featured
                        </label>

                    </div>

                </div>

                <div class="col-md-6 mt-3">

                    <div class="form-check form-switch">

                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $caseStudy->is_active ?? 1) ? 'checked' : '' }}>

                        <label class="form-check-label">
                            Active
                        </label>

                    </div>

                </div>

            </div>

            <div class="card-footer text-end">

                <a href="{{ route('admin.casestudies.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

                <button class="btn btn-primary">
                    {{ isset($caseStudy) ? 'Update Case Study' : 'Create Case Study' }}
                </button>

            </div>

        </form>

    </div>

    {{-- CROP MODAL (powers the croppie-upload / gallery-cropper-upload fields above) --}}
@endsection
