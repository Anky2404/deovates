@extends('backend.layouts.app')

@section('title', isset($service) ? 'Edit Service' : 'Create Service')

@section('content')

    {{-- SECTION BUTTONS --}}
    <div class="mb-3">
        <div class="btn-group w-100" role="group" id="serviceTabs">
            <button type="button" class="btn btn-outline-primary active" data-section="basic">Basic</button>
            <button type="button" class="btn btn-outline-primary" data-section="faq">FAQ</button>
            <button type="button" class="btn btn-outline-primary" data-section="features">Features</button>
            <button type="button" class="btn btn-outline-primary" data-section="platforms">Platforms</button>
            <button type="button" class="btn btn-outline-primary" data-section="problems">Problems & Solutions</button>
            <button type="button" class="btn btn-outline-primary" data-section="technology">Technology</button>
            <button type="button" class="btn btn-outline-primary" data-section="seo">SEO</button>
        </div>

    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ isset($service) ? 'Edit Service' : 'Create Service' }}</h5>
        </div>

        <form method="POST" action="{{ route('admin.services.saveorupdate', $service->uuid ?? null) }}"
            enctype="multipart/form-data">
            @csrf

            <div class="card-body">

                {{-- ================= BASIC ================= --}}
                <div class="service-section" id="section-basic">
                    <div class="row g-3">

                        {{-- TITLE --}}
                        <div class="col-md-6">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" id="title_input" class="form-control"
                                value="{{ old('title', $service->title ?? '') }}" required>
                        </div>

                        {{-- SLUG --}}
                        <div class="col-md-6">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" id="slug_input" class="form-control"
                                value="{{ old('slug', $service->slug ?? '') }}" required>
                        </div>


                        <div class="row g-3 mt-1">

                            <div class="col-md-4">
                                @include('backend.partials.image-upload-box', [
                                    'name' => 'featured_image',
                                    'label' => 'Featured Image',
                                    'previewId' => 'featuredImagePreview',
                                    'previewUrl' => !empty($service->featured_image) ? asset('storage/' . $service->featured_image) : null,
                                    'width' => 800,
                                    'height' => 600,
                                    'altName' => 'featured_image_alt',
                                    'altValue' => old('featured_image_alt', $service->featured_image_alt ?? ''),
                                ])
                            </div>

                            <div class="col-md-4">
                                @include('backend.partials.image-upload-box', [
                                    'name' => 'banner_image',
                                    'label' => 'Banner Image',
                                    'previewId' => 'bannerImagePreview',
                                    'previewUrl' => !empty($service->banner_image) ? asset('storage/' . $service->banner_image) : null,
                                    'width' => 1600,
                                    'height' => 600,
                                    'altName' => 'banner_image_alt',
                                    'altValue' => old('banner_image_alt', $service->banner_image_alt ?? ''),
                                ])
                            </div>

                            <div class="col-md-4">
                                @include('backend.partials.icon-picker-field', [
                                    'name' => 'icon',
                                    'value' => old('icon', $service->icon ?? ''),
                                    'inputId' => 'icon_input',
                                    'previewId' => 'icon_preview',
                                ])
                            </div>

                        </div>

                        {{-- GALLERY (multiple images, each cropped + alt/title-texted individually) --}}
                        <div class="col-md-12">
                            @include('backend.partials.gallery-upload-box', [
                                'containerId' => 'galleryItems',
                                'field' => 'gallery_items',
                                'startIndex' => isset($service) ? $service->galleryMedia->count() : 0,
                                'width' => 800,
                                'height' => 600,
                            ])

                            <div id="galleryItems" class="gallery-sortable d-flex flex-wrap gap-2 mt-3"
                                data-reorder-url="{{ isset($service) ? route('admin.services.galleryreorder', $service->uuid) : '' }}"
                                data-uuid="{{ $service->uuid ?? '' }}">
                                @foreach ((isset($service) ? $service->galleryMedia : collect()) as $index => $item)
                                    <div class="gallery-crop-item position-relative d-inline-block m-1 align-top"
                                        style="width:140px;" data-id="{{ $item->uuid }}">
                                        <span class="gallery-drag-handle" title="Drag to reorder"
                                            style="position:absolute;top:2px;left:2px;z-index:9;cursor:move;background:#fff;border-radius:3px;padding:0 4px;font-size:14px;line-height:1.4;">&#9776;</span>

                                        <button type="button" class="btn btn-danger btn-sm remove-gallery-crop-item"
                                            style="position:absolute; top:2px; right:2px; z-index:9; padding:0 6px;">
                                            &times;
                                        </button>

                                        <img src="{{ $item->url }}" class="rounded border img-thumbnail"
                                            width="120" height="120" style="object-fit:cover;">

                                        <input type="hidden" name="gallery_items[{{ $index }}][id]"
                                            value="{{ $item->uuid }}">
                                        <input type="text" name="gallery_items[{{ $index }}][title]"
                                            class="form-control form-control-sm mt-1" placeholder="Title"
                                            value="{{ $item->caption }}">
                                        <input type="text" name="gallery_items[{{ $index }}][alt]"
                                            class="form-control form-control-sm mt-1" placeholder="Alt text"
                                            value="{{ $item->alt_text }}">
                                        <button type="button"
                                            class="btn btn-outline-secondary btn-sm copy-gallery-link w-100 mt-1"
                                            data-path="{{ $item->path }}" title="Copy image path">
                                            <i class="bx bx-link"></i> Copy link
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- SHORT DESCRIPTION + DESCRIPTION (side-by-side, both CKEditor) --}}
                        <div class="row g-3 mx-0 w-100">
                            <div class="col-md-6">
                                <label class="form-label">Short Description</label>
                                <textarea name="short_description" id="short_description_input" class="form-control ckeditor-field"
                                    data-ck-height="200" rows="5">{{ old('short_description', $service->short_description ?? '') }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="description_input" class="form-control ckeditor-field" data-ck-height="300"
                                    rows="5">{{ old('description', $service->description ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check form-switch mt-3">
                                <input class="form-check-input" type="checkbox" name="is_featured" value="1"
                                    {{ old('is_featured', $service->is_featured ?? 0) ? 'checked' : '' }}>
                                <label class="form-check-label">Featured</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check form-switch mt-3">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                    {{ old('is_active', $service->is_active ?? 1) ? 'checked' : '' }}>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>

                    </div>
                </div>


                {{-- ================= FAQ ================= --}}
                <div class="service-section {{ !empty($service) && $service->faqs->isNotEmpty() ? '' : 'd-none' }}"
                    id="section-faq">
                    <div class="row">
                        {{-- LEFT : FAQ FORM --}}
                        <div class="col-md-7">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Service FAQs</h6>
                                <button type="button" class="btn btn-sm btn-primary" id="addFaqBtn">
                                    + Add FAQ
                                </button>
                            </div>

                            <div id="faqContainer">
                                @foreach ($service->faqs ?? [] as $faq)
                                    <div class="card mb-3 faq-item" data-index="{{ $loop->index }}">
                                        <div class="card-body">
                                            <input type="hidden" name="faqs[{{ $loop->index }}][id]"
                                                value="{{ $faq->id }}">
                                            <div class="mb-2">
                                                <label class="form-label">Question</label>
                                                <input type="text" name="faqs[{{ $loop->index }}][question]"
                                                    class="form-control faq-question" value="{{ $faq->question }}"
                                                    required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">Answer</label>
                                                <textarea name="faqs[{{ $loop->index }}][answer]" class="form-control faq-answer" rows="3" required>{{ $faq->answer }}</textarea>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">Order from preview</small>
                                                <button type="button"
                                                    class="btn btn-sm btn-danger removeFaq">Remove</button>
                                            </div>
                                            <input type="hidden" name="faqs[{{ $loop->index }}][display_order]"
                                                class="faq-order" value="{{ $faq->display_order }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- RIGHT : PREVIEW --}}
                        <div class="col-md-5">
                            <div class="border rounded p-3 bg-light">
                                <h6 class="mb-2">Preview (Drag & Drop)</h6>
                                <ul class="list-group" id="faqPreview">
                                    @foreach ($service->faqs ?? [] as $faq)
                                        <li class="list-group-item" data-index="{{ $loop->index }}">
                                            <strong>{{ $faq->display_order }}. {{ $faq->question }}</strong>
                                            <div class="small text-muted">{{ $faq->answer }}</div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>



                {{-- ================= FEATURES ================= --}}
                <div class="service-section {{ !empty($service) && $service->features->isNotEmpty() ? '' : 'd-none' }}"
                    id="section-features">

                    <div class="row">
                        {{-- LEFT : FEATURE FORM --}}
                        <div class="col-md-7">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Service Features</h6>
                                <button type="button" class="btn btn-sm btn-primary" id="addFeatureBtn">
                                    + Add Feature
                                </button>
                            </div>

                            <div id="featureContainer">
                                @foreach ($service->features ?? [] as $feature)
                                    <div class="card mb-3 feature-item" data-index="{{ $loop->index }}">
                                        <div class="card-body">
                                            <input type="hidden" name="features[{{ $loop->index }}][id]"
                                                value="{{ $feature->id }}">

                                            <div class="mb-2">
                                                <label class="form-label">Title</label>
                                                <input type="text" name="features[{{ $loop->index }}][title]"
                                                    class="form-control feature-title" placeholder="Feature title"
                                                    value="{{ old('features.' . $loop->index . '.title', $feature->title) }}"
                                                    required>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label">Short Description</label>
                                                <textarea name="features[{{ $loop->index }}][short_description]" class="form-control feature-desc" rows="2"
                                                    placeholder="Short description">{{ old('features.' . $loop->index . '.short_description', $feature->short_description) }}</textarea>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="form-label">Icon Class</label>
                                                    <input type="text" name="features[{{ $loop->index }}][icon]"
                                                        class="form-control feature-icon" placeholder="bx bx-star"
                                                        value="{{ old('features.' . $loop->index . '.icon', $feature->icon) }}">
                                                </div>

                                                <div class="col-md-6 d-flex align-items-end">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input feature-highlight" type="checkbox"
                                                            name="features[{{ $loop->index }}][is_highlighted]"
                                                            value="1"
                                                            {{ old('features.' . $loop->index . '.is_highlighted', $feature->is_highlighted) ? 'checked' : '' }}>
                                                        <label class="form-check-label">Highlighted</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-2 mt-2">
                                                @include('backend.partials.image-upload-box', [
                                                    'name' => 'features[' . $loop->index . '][image]',
                                                    'label' => 'Image',
                                                    'previewId' => 'featureImagePreview' . $loop->index,
                                                    'previewUrl' => !empty($feature->image) ? asset('storage/' . $feature->image) : null,
                                                    'width' => 300,
                                                    'height' => 300,
                                                    'altName' => 'features[' . $loop->index . '][image_alt]',
                                                    'altValue' => old('features.' . $loop->index . '.image_alt', $feature->image_alt),
                                                ])
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center mt-2">
                                                <small class="text-muted">Order from preview</small>
                                                <button type="button"
                                                    class="btn btn-sm btn-danger removeFeature">Remove</button>
                                            </div>

                                            <input type="hidden" name="features[{{ $loop->index }}][display_order]"
                                                class="feature-order" value="{{ $feature->display_order }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- RIGHT : PREVIEW --}}
                        <div class="col-md-5">
                            <div class="border rounded p-3 bg-light">
                                <h6 class="mb-2">Preview (Drag & Drop)</h6>
                                <ul class="list-group" id="featurePreview">
                                    @foreach ($service->features ?? [] as $feature)
                                        <li class="list-group-item d-flex align-items-start"
                                            data-index="{{ $loop->index }}">
                                            <i class="{{ $feature->icon ?? 'bx bx-star' }} me-2 mt-1"></i>
                                            <div class="flex-grow-1">
                                                <strong>{{ $feature->display_order }}. {{ $feature->title }}</strong>
                                                @if ($feature->is_highlighted)
                                                    <span class="badge bg-warning ms-2">Highlighted</span>
                                                @endif
                                                <div class="small text-muted">{{ $feature->short_description }}</div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>


                {{-- ================= PLATFORMS ================= --}}
                <div class="service-section {{ !empty($service) && $service->platforms->isNotEmpty() ? '' : 'd-none' }}"
                    id="section-platforms">

                    <div class="row">
                        {{-- LEFT --}}
                        <div class="col-md-7">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Supported Platforms</h6>
                                <button type="button" class="btn btn-sm btn-primary" id="addPlatformBtn">
                                    + Add Platform
                                </button>
                            </div>

                            <div id="platformContainer">
                                @foreach ($service->platforms ?? [] as $platform)
                                    <div class="card mb-2 platform-item" data-index="{{ $loop->index }}">
                                        <div class="card-body p-2">

                                            {{-- PIVOT ID --}}
                                            <input type="hidden" name="platforms[{{ $loop->index }}][id]"
                                                value="{{ $platform->id }}">

                                            <div class="row align-items-center g-2">

                                                {{-- PLATFORM SELECT --}}
                                                <div class="col-md-6">
                                                    <select class="form-select platform-select"
                                                        name="platforms[{{ $loop->index }}][platform_id]">
                                                        <option value="">Select Platform</option>
                                                        @foreach ($platforms as $p)
                                                            <option value="{{ $p->id }}"
                                                                {{ $p->id == $platform->platform_id ? 'selected' : '' }}
                                                                data-icon="{{ $p->icon }}">
                                                                {{ $p->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                {{-- ACTIVE --}}
                                                <div class="col-md-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input platform-active" type="checkbox"
                                                            name="platforms[{{ $loop->index }}][is_active]"
                                                            value="1" {{ $platform->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label">Active</label>
                                                    </div>
                                                </div>

                                                {{-- REMOVE --}}
                                                <div class="col-md-3 text-end">
                                                    <button type="button" class="btn btn-sm btn-danger removePlatform">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>

                                            <input type="hidden" name="platforms[{{ $loop->index }}][display_order]"
                                                class="platform-order" value="{{ $platform->display_order }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- RIGHT : PREVIEW --}}
                        <div class="col-md-5">
                            <div class="border rounded p-3 bg-light">
                                <h6 class="mb-2">Preview (Drag & Drop)</h6>
                                <ul class="list-group" id="platformPreview"></ul>
                            </div>
                        </div>
                    </div>
                </div>



                {{-- ================= PROBLEM & SOLUTION ================= --}}
                <div class="service-section {{ !empty($service) && $service->challenges->isNotEmpty() ? '' : 'd-none' }}"
                    id="section-problems">
                    <div class="row">
                        {{-- LEFT : FORM --}}
                        <div class="col-md-7">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Challenges & Solutions</h6>
                                <button type="button" class="btn btn-sm btn-primary" id="addProblemBtn">
                                    + Add Item
                                </button>
                            </div>

                            <div id="problemContainer">
                                @foreach ($service->challenges ?? [] as $problem)
                                    <div class="card mb-3 problem-item" data-index="{{ $loop->index }}">
                                        <div class="card-body">
                                            <input type="hidden" name="problems[{{ $loop->index }}][id]"
                                                value="{{ $problem->id }}">

                                            <input type="text" name="problems[{{ $loop->index }}][challenge]"
                                                class="form-control mb-2 challenge-text" placeholder="Challenge"
                                                value="{{ $problem->challenge }}" required>

                                            <textarea name="problems[{{ $loop->index }}][solution]" class="form-control mb-2 solution-text" rows="3"
                                                required>{{ $problem->solution }}</textarea>

                                            <input type="text" name="problems[{{ $loop->index }}][icon]"
                                                class="form-control mb-2 icon-text" placeholder="fa-solid fa-star"
                                                value="{{ $problem->icon }}">

                                            <div class="mb-2">
                                                @include('backend.partials.image-upload-box', [
                                                    'name' => 'problems[' . $loop->index . '][image]',
                                                    'label' => 'Image',
                                                    'previewId' => 'problemImagePreview' . $loop->index,
                                                    'previewUrl' => !empty($problem->image) ? asset('storage/' . $problem->image) : null,
                                                    'width' => 600,
                                                    'height' => 400,
                                                    'altName' => 'problems[' . $loop->index . '][image_alt]',
                                                    'altValue' => $problem->image_alt,
                                                ])
                                            </div>

                                            <input type="number" name="problems[{{ $loop->index }}][views]"
                                                class="form-control mb-2 views-text" value="{{ $problem->views ?? 0 }}">

                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex gap-3 align-items-center">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input problem-active" type="checkbox"
                                                            name="problems[{{ $loop->index }}][is_active]"
                                                            value="1" {{ $problem->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label">Active</label>
                                                    </div>

                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input problem-featured" type="checkbox"
                                                            name="problems[{{ $loop->index }}][is_featured]"
                                                            value="1" {{ $problem->is_featured ? 'checked' : '' }}>
                                                        <label class="form-check-label">Featured</label>
                                                    </div>
                                                </div>

                                                <button type="button"
                                                    class="btn btn-sm btn-danger removeProblem">Remove</button>
                                            </div>

                                            <input type="hidden" name="problems[{{ $loop->index }}][display_order]"
                                                class="problem-order" value="{{ $problem->display_order }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- RIGHT : PREVIEW --}}
                        <div class="col-md-5">
                            <div class="border rounded p-3 bg-light">
                                <h6 class="mb-2">Preview (Drag & Drop)</h6>
                                <ul class="list-group" id="problemPreview">
                                    @foreach ($service->challenges ?? [] as $problem)
                                        <li class="list-group-item" data-index="{{ $loop->index }}">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    @if ($problem->icon)
                                                        <i class="{{ $problem->icon }} me-1"></i>
                                                    @endif
                                                    <strong>{{ $problem->display_order }}.
                                                        {{ $problem->challenge }}</strong>
                                                </div>
                                                <div>
                                                    @if ($problem->is_featured)
                                                        <span class="badge bg-warning text-dark me-1">Featured</span>
                                                    @endif
                                                    @if (!$problem->is_active)
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="small text-muted">{{ $problem->solution }}</div>
                                            @if ($problem->image)
                                                <img src="{{ asset($problem->image) }}" class="mt-2 rounded"
                                                    style="max-height:80px;">
                                            @endif
                                            <div class="small text-muted mt-1">Views: {{ $problem->views ?? 0 }}</div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>



                {{-- ================= TECHNOLOGY ================= --}}
                <div class="service-section {{ !empty($service) && $service->technologies->isNotEmpty() ? '' : 'd-none' }}"
                    id="section-technology">

                    <div class="row">
                        {{-- LEFT --}}
                        <div class="col-md-7">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Technologies Used</h6>
                                <button type="button" class="btn btn-sm btn-primary" id="addTechnologyBtn">
                                    + Add Technology
                                </button>
                            </div>

                            <div id="technologyContainer">
                                @foreach ($service->technologies ?? [] as $technology)
                                    <div class="card mb-2 technology-item" data-index="{{ $loop->index }}">
                                        <div class="card-body p-2">

                                            {{-- PIVOT ID --}}
                                            <input type="hidden" name="technologies[{{ $loop->index }}][id]"
                                                value="{{ $technology->id }}">

                                            {{-- ROW --}}
                                            <div class="row align-items-center g-2">

                                                {{-- TECHNOLOGY SELECT --}}
                                                <div class="col-md-6 d-flex align-items-center gap-2">

                                                    {{-- ICON PREVIEW --}}
                                                    <i class="technology-icon-preview bx bx-chip"
                                                        style="font-size:22px;"></i>

                                                    {{-- TECHNOLOGY SELECT --}}
                                                    <select class="form-select technology-select"
                                                        name="technologies[{{ $loop->index }}][technology_id]">

                                                        <option value="">Select Technology</option>

                                                        @foreach ($technologies as $tech)
                                                            <option value="{{ $tech->id }}"
                                                                {{ $tech->id == $technology->technology_id ? 'selected' : '' }}
                                                                data-icon="{{ $tech->icon }}">
                                                                {{ $tech->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                {{-- ACTIVE --}}
                                                <div class="col-md-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input technology-active" type="checkbox"
                                                            name="technologies[{{ $loop->index }}][is_active]"
                                                            value="1" {{ $technology->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label">Active</label>
                                                    </div>
                                                </div>

                                                {{-- REMOVE --}}
                                                <div class="col-md-3 text-end">
                                                    <button type="button" class="btn btn-sm btn-danger removeTechnology">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>

                                            <input type="hidden"
                                                name="technologies[{{ $loop->index }}][display_order]"
                                                class="technology-order" value="{{ $technology->display_order }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- RIGHT : PREVIEW --}}
                        <div class="col-md-5">
                            <div class="border rounded p-3 bg-light">
                                <h6 class="mb-2">Preview (Drag & Drop)</h6>
                                <ul class="list-group" id="technologyPreview"></ul>
                            </div>
                        </div>
                    </div>
                </div>






                {{-- ================= SEO ================= --}}
                <div class="service-section d-none" id="section-seo">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control"
                                value="{{ old('meta_title', $service->meta_title ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Meta Keywords (JSON Array)</label>
                            <textarea name="meta_keywords" class="form-control json-auto" rows="3"
                                placeholder="local seo, google business profile">{{ old(
                                    'meta_keywords',
                                    !empty(optional($service)->meta_keywords) ? json_encode($service->meta_keywords, JSON_UNESCAPED_UNICODE) : '',
                                ) }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', optional($service)->meta_description ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-footer text-end">
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button class="btn btn-primary">
                    {{ isset($service) ? 'Update Service' : 'Create Service' }}
                </button>
            </div>
        </form>
    </div>

    {{-- CROPIE MODAL --}}

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/Sortable.min.js') }}"></script>
    <script>
        // Initialize FAQ index based on existing FAQ items
        let faqItems = document.querySelectorAll('.faq-item');
        let faqIndex = faqItems.length ? Math.max(...Array.from(faqItems).map(i => parseInt(i.dataset.index))) : -1;

        // ADD FAQ
        document.getElementById('addFaqBtn')?.addEventListener('click', function() {
            faqIndex++; // increment index for new FAQ

            const html = `
    <div class="card mb-3 faq-item" data-index="${faqIndex}">
        <div class="card-body">

            <div class="mb-2">
                <label class="form-label">Question</label>
                <input type="text"
                       name="faqs[${faqIndex}][question]"
                       class="form-control faq-question"
                       placeholder="Enter question"
                       required>
            </div>

            <div class="mb-2">
                <label class="form-label">Answer</label>
                <textarea name="faqs[${faqIndex}][answer]"
                          class="form-control faq-answer"
                          rows="3"
                          placeholder="Enter answer"
                          required></textarea>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Order from preview</small>
                <button type="button" class="btn btn-sm btn-danger removeFaq">Remove</button>
            </div>

            <input type="hidden"
                   name="faqs[${faqIndex}][display_order]"
                   class="faq-order">
        </div>
    </div>
    `;

            document.getElementById('faqContainer').insertAdjacentHTML('beforeend', html);
            refreshFaqPreview();
        });

        // REMOVE FAQ
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('removeFaq')) {
                e.target.closest('.faq-item').remove();
                refreshFaqPreview();
            }
        });

        // LIVE PREVIEW UPDATE
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('faq-question') ||
                e.target.classList.contains('faq-answer')) {
                refreshFaqPreview();
            }
        });

        // RENDER PREVIEW
        function refreshFaqPreview() {
            const preview = document.getElementById('faqPreview');
            preview.innerHTML = '';

            document.querySelectorAll('.faq-item').forEach((item, index) => {
                const q = item.querySelector('.faq-question').value || 'Question';
                const a = item.querySelector('.faq-answer').value || 'Answer';

                // Update display order
                item.querySelector('.faq-order').value = index + 1;

                // Add/update preview
                preview.insertAdjacentHTML('beforeend', `
        <li class="list-group-item" data-index="${item.dataset.index}">
            <strong>${index + 1}. ${q}</strong>
            <div class="small text-muted">${a}</div>
        </li>
        `);
            });
        }

        // SORTABLE PREVIEW
        new Sortable(document.getElementById('faqPreview'), {
            animation: 150,
            onEnd: function() {
                const previewItems = document.querySelectorAll('#faqPreview li');
                const container = document.getElementById('faqContainer');

                previewItems.forEach(item => {
                    const match = container.querySelector(
                        '.faq-item[data-index="' + item.dataset.index + '"]'
                    );
                    if (match) container.appendChild(match);
                });

                refreshFaqPreview();
            }
        });


        // ========================== FEATURE SECTION ==========================

        let featureIndex = 0;

        // Detect existing features on edit and set featureIndex
        document.addEventListener('DOMContentLoaded', () => {
            const existingFeatures = document.querySelectorAll('#featureContainer .feature-item');
            if (existingFeatures.length > 0) {
                // Set featureIndex to the last data-index + 1
                const lastIndex = Math.max(...Array.from(existingFeatures).map(f => parseInt(f.dataset.index)));
                featureIndex = lastIndex;
            }
            // Initial render of preview
            refreshFeaturePreview();
        });

        // ADD FEATURE
        document.getElementById('addFeatureBtn')?.addEventListener('click', function() {
            featureIndex++;

            const html = `
    <div class="card mb-3 feature-item" data-index="${featureIndex}">
        <div class="card-body">

            <div class="mb-2">
                <label class="form-label">Title</label>
                <input type="text"
                       name="features[${featureIndex}][title]"
                       class="form-control feature-title"
                       placeholder="Feature title"
                       required>
            </div>

            <div class="mb-2">
                <label class="form-label">Short Description</label>
                <textarea name="features[${featureIndex}][short_description]"
                          class="form-control feature-desc"
                          rows="2"
                          placeholder="Short description"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Icon Class</label>
                    <input type="text"
                           name="features[${featureIndex}][icon]"
                           class="form-control feature-icon"
                           placeholder="bx bx-star">
                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input feature-highlight"
                               type="checkbox"
                               name="features[${featureIndex}][is_highlighted]"
                               value="1">
                        <label class="form-check-label">Highlighted</label>
                    </div>
                </div>
            </div>

            <div class="mb-2 mt-2">
                <label class="form-label">Image</label>
                <div class="image-upload-box upload-dropzone" data-placeholder="https://placehold.co/130x130">
                    <input type="file" name="features[${featureIndex}][image]" class="image-upload-input croppie-upload"
                           data-preview="#featureImagePreview${featureIndex}" data-width="300" data-height="300" accept="image/*">
                    <div class="image-upload-empty">
                        <i class="bx bx-cloud-upload image-upload-icon"></i>
                        <p class="image-upload-text">Drag &amp; drop image here, or click to browse</p>
                    </div>
                    <div class="image-upload-preview">
                        <img id="featureImagePreview${featureIndex}" src="https://placehold.co/130x130" class="image-upload-thumb">
                        <button type="button" class="btn btn-link btn-sm text-danger image-upload-remove">Remove file</button>
                    </div>
                </div>
                <input type="text" name="features[${featureIndex}][image_alt]"
                       class="form-control mt-2" placeholder="Alt text (used for the image name too)">
            </div>

            <div class="d-flex justify-content-between align-items-center mt-2">
                <small class="text-muted">Order from preview</small>
                <button type="button" class="btn btn-sm btn-danger removeFeature">
                    Remove
                </button>
            </div>

            <input type="hidden"
                   name="features[${featureIndex}][display_order]"
                   class="feature-order">
        </div>
    </div>
    `;

            document.getElementById('featureContainer').insertAdjacentHTML('beforeend', html);
            refreshFeaturePreview();
        });

        // REMOVE FEATURE
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('removeFeature')) {
                e.target.closest('.feature-item').remove();
                refreshFeaturePreview();
            }
        });

        // LIVE UPDATE PREVIEW
        document.addEventListener('input', function(e) {
            if (
                e.target.classList.contains('feature-title') ||
                e.target.classList.contains('feature-desc') ||
                e.target.classList.contains('feature-icon') ||
                e.target.classList.contains('feature-highlight')
            ) {
                refreshFeaturePreview();
            }
        });

        // RENDER PREVIEW
        function refreshFeaturePreview() {
            const preview = document.getElementById('featurePreview');
            preview.innerHTML = '';

            document.querySelectorAll('.feature-item').forEach((item, index) => {
                const title = item.querySelector('.feature-title').value || 'Feature title';
                const desc = item.querySelector('.feature-desc').value || '';
                const icon = item.querySelector('.feature-icon').value || 'bx bx-star';
                const highlighted = item.querySelector('.feature-highlight').checked;

                item.querySelector('.feature-order').value = index + 1;

                preview.insertAdjacentHTML('beforeend', `
            <li class="list-group-item d-flex align-items-start"
                data-index="${item.dataset.index}">
                <i class="${icon} me-2 mt-1"></i>
                <div class="flex-grow-1">
                    <strong>${index + 1}. ${title}</strong>
                    ${highlighted ? '<span class="badge bg-warning ms-2">Highlighted</span>' : ''}
                    <div class="small text-muted">${desc}</div>
                </div>
            </li>
        `);
            });
        }

        // SORTABLE PREVIEW
        new Sortable(document.getElementById('featurePreview'), {
            animation: 150,
            onEnd: function() {
                const previewItems = document.querySelectorAll('#featurePreview li');
                const container = document.getElementById('featureContainer');

                previewItems.forEach(item => {
                    const match = container.querySelector(
                        '.feature-item[data-index="' + item.dataset.index + '"]'
                    );
                    container.appendChild(match);
                });

                refreshFeaturePreview();
            }
        });


        /* ==========================
           INITIAL INDEX (EDIT SAFE)
        ========================== */
        let platformIndex =
            document.querySelectorAll('.platform-item').length ?
            Math.max(...[...document.querySelectorAll('.platform-item')]
                .map(el => parseInt(el.dataset.index))) + 1 :
            0;

        /* ==========================
           ADD PLATFORM
        ========================== */
        document.getElementById('addPlatformBtn')?.addEventListener('click', function() {

            const options = document.querySelector('.platform-select')?.innerHTML || '';

            const html = `
    <div class="card mb-2 platform-item" data-index="${platformIndex}">
        <div class="card-body p-2">

            <div class="row align-items-center g-2">

                <div class="col-md-6">
                    <select class="form-select platform-select"
                            name="platforms[${platformIndex}][platform_id]">
                        ${options}
                    </select>
                </div>

                <div class="col-md-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input platform-active"
                               type="checkbox"
                               name="platforms[${platformIndex}][is_active]"
                               value="1"
                               checked>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>

                <div class="col-md-3 text-end">
                    <button type="button"
                            class="btn btn-sm btn-danger removePlatform">
                        Remove
                    </button>
                </div>
            </div>

            <input type="hidden"
                   name="platforms[${platformIndex}][display_order]"
                   class="platform-order">
        </div>
    </div>`;

            document.getElementById('platformContainer')
                .insertAdjacentHTML('beforeend', html);

            platformIndex++;
            refreshPlatformPreview();
        });

        /* ==========================
           REMOVE
        ========================== */
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('removePlatform')) {
                e.target.closest('.platform-item')?.remove();
                refreshPlatformPreview();
            }
        });

        /* ==========================
           LIVE UPDATE
        ========================== */
        document.addEventListener('change', function(e) {
            if (
                e.target.classList.contains('platform-select') ||
                e.target.classList.contains('platform-active')
            ) {
                refreshPlatformPreview();
            }
        });

        /* ==========================
           PREVIEW RENDER
        ========================== */
        function refreshPlatformPreview() {
            const preview = document.getElementById('platformPreview');
            if (!preview) return;

            preview.innerHTML = '';

            document.querySelectorAll('.platform-item').forEach((item, index) => {

                const select = item.querySelector('.platform-select');
                const name = select?.selectedOptions[0]?.text || 'Platform';
                const icon = select?.selectedOptions[0]?.dataset.icon || 'bx bx-globe';
                const active = item.querySelector('.platform-active')?.checked;

                item.querySelector('.platform-order').value = index + 1;

                preview.insertAdjacentHTML('beforeend', `
            <li class="list-group-item d-flex align-items-center gap-2"
                data-index="${item.dataset.index}">
                <i class="${icon}"></i>
                <strong>${index + 1}. ${name}</strong>
                ${active ? '' : '<span class="badge bg-secondary ms-auto">Inactive</span>'}
            </li>
        `);
            });
        }

        /* ==========================
           SORTABLE
        ========================== */
        new Sortable(document.getElementById('platformPreview'), {
            animation: 150,
            onEnd() {
                const container = document.getElementById('platformContainer');

                [...document.querySelectorAll('#platformPreview li')].forEach(li => {
                    const item = container.querySelector(
                        '.platform-item[data-index="' + li.dataset.index + '"]'
                    );
                    if (item) container.appendChild(item);
                });

                refreshPlatformPreview();
            }
        });

        /* ==========================
           INITIAL RENDER
        ========================== */
        refreshPlatformPreview();

        let problemIndex = 0;
        let isSorting = false;

        // Initialize problemIndex based on existing problems
        document.addEventListener('DOMContentLoaded', () => {
            const existingProblems = document.querySelectorAll('#problemContainer .problem-item');
            if (existingProblems.length > 0) {
                const lastIndex = Math.max(...Array.from(existingProblems).map(f => parseInt(f.dataset.index)));
                problemIndex = lastIndex;
            }
            refreshProblemPreview();
        });

        // ===============================
        // ADD ITEM
        // ===============================
        document.getElementById('addProblemBtn')?.addEventListener('click', function() {
            problemIndex++;

            document.getElementById('problemContainer').insertAdjacentHTML('beforeend', `
        <div class="card mb-3 problem-item" data-index="${problemIndex}">
            <div class="card-body">

                <input type="text" name="problems[${problemIndex}][challenge]" class="form-control mb-2 challenge-text" placeholder="Challenge" required>
                <textarea name="problems[${problemIndex}][solution]" class="form-control mb-2 solution-text" rows="3" placeholder="Solution" required></textarea>
                <input type="text" name="problems[${problemIndex}][icon]" class="form-control mb-2 icon-text" placeholder="fa-solid fa-star">
                <div class="image-upload-box upload-dropzone mb-2" data-placeholder="https://placehold.co/130x130">
                    <input type="file" name="problems[${problemIndex}][image]" class="image-upload-input croppie-upload" data-preview="#problemImagePreview${problemIndex}" data-width="600" data-height="400" accept="image/*">
                    <div class="image-upload-empty">
                        <i class="bx bx-cloud-upload image-upload-icon"></i>
                        <p class="image-upload-text">Drag &amp; drop image here, or click to browse</p>
                    </div>
                    <div class="image-upload-preview">
                        <img id="problemImagePreview${problemIndex}" src="https://placehold.co/130x130" class="image-upload-thumb">
                        <button type="button" class="btn btn-link btn-sm text-danger image-upload-remove">Remove file</button>
                    </div>
                </div>
                <input type="text" name="problems[${problemIndex}][image_alt]" class="form-control mb-2" placeholder="Alt text (used for the image name too)">
                <input type="number" name="problems[${problemIndex}][views]" class="form-control mb-2 views-text" value="0">

                <div class="d-flex justify-content-between">
                    <div class="d-flex gap-3 align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input problem-active" type="checkbox" name="problems[${problemIndex}][is_active]" value="1" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input problem-featured" type="checkbox" name="problems[${problemIndex}][is_featured]" value="1">
                            <label class="form-check-label">Featured</label>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger removeProblem">Remove</button>
                </div>

                <input type="hidden" name="problems[${problemIndex}][display_order]" class="problem-order">
            </div>
        </div>
    `);

            refreshProblemPreview();
        });

        // ===============================
        // REMOVE
        // ===============================
        document.addEventListener('click', e => {
            if (e.target.classList.contains('removeProblem')) {
                e.target.closest('.problem-item').remove();
                refreshProblemPreview();
            }
        });

        // ===============================
        // LIVE UPDATE
        // ===============================
        document.addEventListener('input', () => {
            if (!isSorting) refreshProblemPreview();
        });
        document.getElementById('problemContainer').addEventListener('croppie:uploaded', () => {
            if (!isSorting) refreshProblemPreview();
        });

        // ===============================
        // PREVIEW RENDER
        // ===============================
        function refreshProblemPreview() {
            const preview = document.getElementById('problemPreview');
            preview.innerHTML = '';

            document.querySelectorAll('.problem-item').forEach((item, index) => {
                item.querySelector('.problem-order').value = index + 1;

                const challenge = item.querySelector('.challenge-text').value || 'Challenge';
                const solution = item.querySelector('.solution-text').value || 'Solution';
                const icon = item.querySelector('.icon-text').value;
                const views = item.querySelector('.views-text').value || 0;
                const active = item.querySelector('.problem-active').checked;
                const featured = item.querySelector('.problem-featured').checked;

                // ===============================
                // IMAGE HANDLING — the crop-and-upload widget keeps this
                // row's preview <img> current (cropped or original), so the
                // list preview just mirrors whatever it's already showing.
                // ===============================
                let imageHTML = '';
                const existingImg = item.querySelector('img[id^="problemImagePreview"]');

                if (existingImg && !existingImg.src.includes('placehold.co')) {
                    imageHTML = `<img src="${existingImg.src}" class="mt-2 rounded" style="max-height:80px;">`;
                }

                preview.insertAdjacentHTML('beforeend', `
            <li class="list-group-item" data-index="${item.dataset.index}">
                <div class="d-flex justify-content-between">
                    <div>
                        ${icon ? `<i class="${icon} me-1"></i>` : ''}
                        <strong>${index + 1}. ${challenge}</strong>
                    </div>
                    <div>
                        ${featured ? '<span class="badge bg-warning text-dark me-1">Featured</span>' : ''}
                        ${!active ? '<span class="badge bg-secondary">Inactive</span>' : ''}
                    </div>
                </div>
                <div class="small text-muted">${solution}</div>
                ${imageHTML}
                <div class="small text-muted mt-1">Views: ${views}</div>
            </li>
        `);
            });
        }

        // ===============================
        // SORTABLE
        // ===============================
        new Sortable(document.getElementById('problemPreview'), {
            animation: 150,
            onStart() {
                isSorting = true;
            },
            onEnd() {
                isSorting = false;
                const container = document.getElementById('problemContainer');
                document.querySelectorAll('#problemPreview li').forEach(li => {
                    const match = container.querySelector(
                        `.problem-item[data-index="${li.dataset.index}"]`);
                    if (match) container.appendChild(match);
                });
                refreshProblemPreview();
            }
        });


        /* ==========================
           INITIAL INDEX (EDIT SAFE)
        ========================== */
        let technologyIndex =
            document.querySelectorAll('.technology-item').length ?
            Math.max(...[...document.querySelectorAll('.technology-item')]
                .map(el => parseInt(el.dataset.index))) + 1 :
            0;

        /* ==========================
           ADD TECHNOLOGY
        ========================== */
        document.getElementById('addTechnologyBtn')?.addEventListener('click', function() {

            const options = document.querySelector('.technology-select')?.innerHTML || '';

            const html = `
    <div class="card mb-2 technology-item" data-index="${technologyIndex}">
        <div class="card-body p-2">

            <div class="row align-items-center g-2">

                <div class="col-md-6">
                    <select class="form-select technology-select"
                            name="technologies[${technologyIndex}][technology_id]">
                        ${options}
                    </select>
                </div>

                <div class="col-md-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input technology-active"
                               type="checkbox"
                               name="technologies[${technologyIndex}][is_active]"
                               value="1"
                               checked>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>

                <div class="col-md-3 text-end">
                    <button type="button"
                            class="btn btn-sm btn-danger removeTechnology">
                        Remove
                    </button>
                </div>
            </div>

            <input type="hidden"
                   name="technologies[${technologyIndex}][display_order]"
                   class="technology-order">
        </div>
    </div>`;

            document.getElementById('technologyContainer')
                .insertAdjacentHTML('beforeend', html);

            technologyIndex++;
            refreshTechnologyPreview();
        });

        /* ==========================
           REMOVE
        ========================== */
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('removeTechnology')) {
                e.target.closest('.technology-item')?.remove();
                refreshTechnologyPreview();
            }
        });

        /* ==========================
           LIVE UPDATE
        ========================== */
        document.addEventListener('change', function(e) {
            if (
                e.target.classList.contains('technology-select') ||
                e.target.classList.contains('technology-active')
            ) {
                refreshTechnologyPreview();
            }
        });

        /* ==========================
           PREVIEW RENDER
        ========================== */
        function refreshTechnologyPreview() {
            const preview = document.getElementById('technologyPreview');
            if (!preview) return;

            preview.innerHTML = '';

            document.querySelectorAll('.technology-item').forEach((item, index) => {

                const select = item.querySelector('.technology-select');
                const name = select?.selectedOptions[0]?.text || 'Technology';
                const icon = select?.selectedOptions[0]?.dataset.icon || 'bx bx-chip';
                const active = item.querySelector('.technology-active')?.checked;

                item.querySelector('.technology-order').value = index + 1;

                preview.insertAdjacentHTML('beforeend', `
        <li class="list-group-item d-flex align-items-center gap-2"
            data-index="${item.dataset.index}">
            <i class="${icon}" style="font-size:20px;"></i>
            <strong>${index + 1}. ${name}</strong>
            ${active ? '' : '<span class="badge bg-secondary ms-auto">Inactive</span>'}
        </li>
        `);
            });
        }

        /* ==========================
           SORTABLE
        ========================== */
        new Sortable(document.getElementById('technologyPreview'), {
            animation: 150,
            onEnd: function() {
                const container = document.getElementById('technologyContainer');

                [...document.querySelectorAll('#technologyPreview li')].forEach(li => {
                    const item = container.querySelector(
                        '.technology-item[data-index="' + li.dataset.index + '"]'
                    );
                    if (item) container.appendChild(item);
                });

                refreshTechnologyPreview();
            }
        });

        /* ==========================
           INITIAL RENDER
        ========================== */
        refreshTechnologyPreview();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const tabs = document.querySelectorAll('#serviceTabs button');
            const sections = document.querySelectorAll('.service-section');

            // SAFETY CHECK
            if (!tabs.length || !sections.length) return;

            // SHOW BASIC BY DEFAULT
            sections.forEach(section => section.classList.add('d-none'));
            const defaultSection = document.getElementById('section-basic');
            if (defaultSection) defaultSection.classList.remove('d-none');

            tabs.forEach(btn => {
                btn.addEventListener('click', function() {

                    const target = this.dataset.section;
                    if (!target) return;

                    // Hide all sections
                    sections.forEach(section => section.classList.add('d-none'));

                    // Remove active from all buttons
                    tabs.forEach(b => b.classList.remove('active'));

                    // Show selected section safely
                    const activeSection = document.getElementById('section-' + target);
                    if (activeSection) {
                        activeSection.classList.remove('d-none');
                    }

                    // Activate clicked button
                    this.classList.add('active');
                });
            });

        });
    </script>
@endpush
