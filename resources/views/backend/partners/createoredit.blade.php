@extends('backend.layouts.app')

@section('title', isset($partner) ? config('constants.BUSINESS.name') . ' | Edit Partner' : config('constants.BUSINESS.name') . ' | Create Partner')

@section('content')

<div class="card">


<div class="card-header">
    <h5 class="mb-0">
        {{ isset($partner) ? 'Edit Partner' : 'Create Partner' }}
    </h5>
</div>

<form method="POST"
      action="{{ route('admin.marketing.partners.saveorupdate', $partner->uuid ?? null) }}"
      enctype="multipart/form-data">

    @csrf

    <div class="card-body row g-3">

        {{-- NAME --}}
        <div class="col-md-3">
            <label class="form-label">Partner Name</label>

            <input type="text"
                   id="title_input"
                   name="name"
                   class="form-control"
                   value="{{ old('name', $partner->name ?? '') }}"
                   required>
        </div>

        {{-- SLUG --}}
        <div class="col-md-3">
            <label class="form-label">Slug</label>

            <input type="text"
                   id="slug_input"
                   name="slug"
                   class="form-control"
                   value="{{ old('slug', $partner->slug ?? '') }}"
                   required>
        </div>

        {{-- TYPE --}}
        <div class="col-md-3">
            <label class="form-label">Partner Type</label>

            <input type="text"
                   name="type"
                   class="form-control"
                   placeholder="Technology Partner"
                   value="{{ old('type', $partner->type ?? '') }}">
        </div>

        {{-- INDUSTRY --}}
        <div class="col-md-3">
            <label class="form-label">Industry</label>

            <input type="text"
                   name="industry"
                   class="form-control"
                   placeholder="Software"
                   value="{{ old('industry', $partner->industry ?? '') }}">
        </div>

        {{-- WEBSITE URL --}}
        <div class="col-md-3">
            @include('backend.partials.url-input', ['name' => 'website_url', 'label' => 'Website URL', 'value' => $partner->website_url ?? ''])
        </div>

        {{-- DISPLAY ORDER --}}
        <div class="col-md-3">
            <label class="form-label">Display Order</label>

            <input type="number"
                   name="display_order"
                   class="form-control"
                   value="{{ old('display_order', $partner->display_order ?? 0) }}">
        </div>

        {{-- LOGO --}}
        <div class="col-md-3">

            @include('backend.partials.simple-image-upload-box', [
                'name' => 'logo',
                'label' => 'Partner Logo',
                'previewId' => 'partnerLogoPreview',
                'previewUrl' => !empty($partner->logo) ? asset('storage/'.$partner->logo) : null,
            ])

        </div>

        {{-- VIEWS --}}
        <div class="col-md-3">
            <label class="form-label">Views</label>

            <input type="number"
                   class="form-control"
                   value="{{ $partner->views ?? 0 }}"
                   readonly>
        </div>

        {{-- DESCRIPTION --}}
        <div class="col-md-12">
            <label class="form-label">Description</label>

            <textarea name="description"
                      id="description_input"
                      rows="5"
                      data-ck-height="300"
                      class="form-control ckeditor-field">{{ old('description', $partner->description ?? '') }}</textarea>
        </div>

        {{-- META TITLE --}}
        <div class="col-md-12">
            <label class="form-label">Meta Title</label>

            <input type="text"
                   name="meta_title"
                   class="form-control"
                   value="{{ old('meta_title', $partner->meta_title ?? '') }}">
        </div>

        {{-- META DESCRIPTION --}}
        <div class="col-md-12">
            <label class="form-label">Meta Description</label>

            <textarea name="meta_description"
                      rows="3"
                      class="form-control">{{ old('meta_description', $partner->meta_description ?? '') }}</textarea>
        </div>

        {{-- ACTIVE --}}
        <div class="col-md-3">
            <div class="form-check form-switch mt-4">

                <input class="form-check-input"
                       type="checkbox"
                       name="is_active"
                       value="1"
                       {{ old('is_active', $partner->is_active ?? 1) ? 'checked' : '' }}>

                <label class="form-check-label">
                    Active
                </label>

            </div>
        </div>

        {{-- FEATURED --}}
        <div class="col-md-3">
            <div class="form-check form-switch mt-4">

                <input class="form-check-input"
                       type="checkbox"
                       name="is_featured"
                       value="1"
                       {{ old('is_featured', $partner->is_featured ?? 0) ? 'checked' : '' }}>

                <label class="form-check-label">
                    Featured
                </label>

            </div>
        </div>

    </div>

    <div class="card-footer text-end">

        <a href="{{ route('admin.marketing.partners.index') }}"
           class="btn btn-secondary">
            Cancel
        </a>

        <button type="submit" class="btn btn-primary">
            {{ isset($partner) ? 'Update Partner' : 'Create Partner' }}
        </button>

    </div>

</form>


</div>

@endsection

@push('scripts')

<script>

document.querySelectorAll('.image-preview-input').forEach(input => {

    input.addEventListener('change', function () {

        const preview = document.querySelector(this.dataset.preview);

        if (!this.files.length || !preview) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(this.files[0]);

    });

});

</script>

@endpush
