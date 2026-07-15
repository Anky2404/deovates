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
                    <label class="form-label">Video URL</label>

                    <input type="url" name="video_url" class="form-control"
                        value="{{ old('video_url', $caseStudy->video_url ?? '') }}">
                </div>

                {{-- CANONICAL URL --}}
                <div class="col-md-3">
                    <label class="form-label">Canonical URL</label>

                    <input type="url" name="canonical_url" class="form-control"
                        value="{{ old('canonical_url', $caseStudy->canonical_url ?? '') }}">
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

                    <div class="col-md-3">

                        <label class="form-label">Featured Image</label>

                        <input type="file" name="featured_image" class="form-control croppie-upload"
                            data-preview="#featuredImagePreview" data-width="800" data-height="600" accept="image/*">

                        <img id="featuredImagePreview"
                            src="{{ !empty($caseStudy->featured_image) ? asset('storage/' . $caseStudy->featured_image) : 'https://placehold.co/130x130' }}"
                            class="mt-2 rounded border img-thumbnail" height="130" width="130">

                        <input type="text" name="featured_image_alt" class="form-control mt-2"
                            placeholder="Alt text (used for the image name too)"
                            value="{{ old('featured_image_alt', $caseStudy->featured_image_alt ?? '') }}">

                    </div>

                    <div class="col-md-3">

                        <label class="form-label">Banner Image</label>

                        <input type="file" name="banner_image" class="form-control croppie-upload"
                            data-preview="#bannerImagePreview" data-width="1600" data-height="600" accept="image/*">

                        <img id="bannerImagePreview"
                            src="{{ !empty($caseStudy->banner_image) ? asset('storage/' . $caseStudy->banner_image) : 'https://placehold.co/130x130' }}"
                            class="mt-2 rounded border img-thumbnail" height="130" width="130">

                        <input type="text" name="banner_image_alt" class="form-control mt-2"
                            placeholder="Alt text (used for the image name too)"
                            value="{{ old('banner_image_alt', $caseStudy->banner_image_alt ?? '') }}">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">Gallery Images</label>

                        <input type="file" class="form-control gallery-cropper-upload"
                            data-container="#galleryItems" data-field="gallery_items"
                            data-start-index="{{ count($caseStudy->gallery ?? []) }}"
                            data-width="800" data-height="600" multiple accept="image/*">

                        <div id="galleryItems" class="d-flex flex-wrap gap-2 mt-3">
                            @foreach ($caseStudy->gallery ?? [] as $index => $item)
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



                </div>

                {{-- OVERVIEW --}}
                <div class="col-md-12">
                    <label class="form-label">Overview</label>

                    <textarea name="overview" id="description" class="form-control" rows="4">{{ old('overview', $caseStudy->overview ?? '') }}</textarea>
                </div>

                {{-- CHALLENGES --}}
                <div class="col-md-6">
                    <label class="form-label">Challenges</label>

                    <textarea name="challenges" class="form-control" rows="4">{{ old('challenges', $caseStudy->challenges ?? '') }}</textarea>
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
                    <label class="form-label">Meta Keywords (comma separated)</label>

                    <textarea name="meta_keywords" class="form-control" rows="3">{{ old('meta_keywords', isset($caseStudy->meta_keywords) ? implode(',', $caseStudy->meta_keywords) : '') }}</textarea>
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
    @include('backend.partials.modal')
@endsection
