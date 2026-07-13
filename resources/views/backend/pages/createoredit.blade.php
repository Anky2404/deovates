@extends('backend.layouts.app')

@section('title', isset($page) ? 'Edit Page' : 'Create Page')

@section('content')
<div class="card">

    <!-- Header -->
    <div class="card-header">
        <h5 class="mb-0">
            {{ isset($page) ? 'Edit Page' : 'Create Page' }}
        </h5>
    </div>

    <form method="POST"
        action="{{ route('admin.pages.saveorupdate', ['uuid' => $page->uuid ?? null]) }}">
        @csrf

        <div class="card-body">

            <div class="row g-3">

                {{-- NAME --}}
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', $page->name ?? '') }}" required>
                </div>

                {{-- SLUG --}}
                <div class="col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" id="slug_input" name="slug" class="form-control"
                        value="{{ old('slug', $page->slug ?? '') }}" required>
                </div>

                {{-- TITLE --}}
                <div class="col-md-12">
                    <label class="form-label">Title</label>
                    <input type="text" id="title_input" name="title" class="form-control"
                        value="{{ old('title', $page->title ?? '') }}">
                </div>

                {{-- DESCRIPTION --}}
                <div class="col-md-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $page->description ?? '') }}</textarea>
                </div>

                {{-- TEMPLATE --}}
                <div class="col-md-6">
                    <label class="form-label">Template</label>
                    <input type="text" name="template_id" class="form-control"
                        value="{{ old('template_id', $page->template_id ?? '') }}">
                </div>

                {{-- DISPLAY ORDER --}}
                <div class="col-md-6">
                    <label class="form-label">Display Order</label>
                    <input type="number" name="display_order" class="form-control"
                        value="{{ old('display_order', $page->display_order ?? 0) }}">
                </div>

                {{-- META TITLE --}}
                <div class="col-md-6">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control"
                        value="{{ old('meta_title', $page->meta_title ?? '') }}">
                </div>

                {{-- META DESCRIPTION --}}
                <div class="col-md-6">
                    <label class="form-label">Meta Description</label>
                    <input type="text" name="meta_description" class="form-control"
                        value="{{ old('meta_description', $page->meta_description ?? '') }}">
                </div>

                {{-- META KEYWORDS --}}
                <div class="col-md-6">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control"
                        value="{{ old('meta_keywords', $page->meta_keywords ?? '') }}">
                </div>

                {{-- CANONICAL URL --}}
                <div class="col-md-6">
                    <label class="form-label">Canonical URL</label>
                    <input type="url" name="canonical_url" class="form-control"
                        value="{{ old('canonical_url', $page->canonical_url ?? '') }}">
                </div>

                {{-- PUBLISHED AT --}}
                <div class="col-md-6">
                    <label class="form-label">Published At</label>
                    <input type="datetime-local" name="published_at" class="form-control"
                        value="{{ old('published_at', isset($page->published_at) ? \Carbon\Carbon::parse($page->published_at)->format('Y-m-d\TH:i') : '') }}">
                </div>

                {{-- STATUS --}}
                <div class="col-md-3">
                    <label class="form-label">Active</label>
                    <select name="is_active" class="form-select">
                        <option value="1" {{ old('is_active', $page->is_active ?? 1) ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('is_active', $page->is_active ?? 1) == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                {{-- HOMEPAGE --}}
                <div class="col-md-3">
                    <label class="form-label">Homepage</label>
                    <select name="is_homepage" class="form-select">
                        <option value="0" {{ old('is_homepage', $page->is_homepage ?? 0) == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('is_homepage', $page->is_homepage ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>

                {{-- ================= MULTIPLE SELECT FOR FORMS ================= --}}
                <div class="col-md-12">
    <label class="form-label">Assign Forms</label>

    <select name="form_ids[]" id="formSelect"
        class="form-select select2" multiple>
        
        @foreach($forms as $form)
            <option value="{{ $form->id }}"
                {{ isset($page) && $page->forms->contains($form->id) ? 'selected' : '' }}>
                {{ $form->name }}
            </option>
        @endforeach

    </select>
</div>

            </div>

        </div>

        <!-- Footer -->
        <div class="card-footer text-end">

            <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
                Cancel
            </a>

            <button class="btn btn-success">
                Save Page
            </button>

        </div>

    </form>

</div>
@endsection
@push('scripts')
<script>
$(document).ready(function() {

    $('#formSelect').select2({
        placeholder: "Select Forms",
        allowClear: true,
        width: '100%',
        closeOnSelect: false
    });

});
</script>
@endpush
