@extends('backend.layouts.app')
@section('title', isset($service) ? 'Edit Service' : 'Create Service')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ isset($service) ? 'Edit Service' : 'Create Service' }}</h5>
    </div>

    <form method="POST" action="{{ route('admin.services.saveorupdate', $service->uuid ?? null) }}">
        @csrf

        <div class="card-body">
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


                {{-- SHORT DESC + IMAGE + ICON --}}
                <div class="row g-3 mt-1">

                    {{-- LEFT --}}
                    <div class="col-md-6">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" id="short_description" class="form-control" rows="5">
                        {{ old('short_description', $service->short_description ?? '') }}</textarea>
                    </div>

                    {{-- RIGHT --}}
                    <div class="col-md-6">
                        <label class="form-label">Featured Image</label>
                        <input type="file"
                            class="form-control croppie-upload"
                            data-target="featured_image"
                            data-preview="#image_preview"
                            accept="image/*">

                        <input type="hidden" name="featured_image" id="featured_image">

                        <div class="mt-2">
                            <img id="image_preview"
                                src="{{ !empty($service->featured_image) ? asset($service->featured_image) : '' }}"
                                class="img-thumbnail {{ empty($service->featured_image) ? 'd-none' : '' }}"
                                width="180">
                        </div>




                        {{-- ICON --}}
                        <label class="form-label mt-3">Icon (CSS Class)</label>
                        <input type="text" id="icon_input" name="icon" class="form-control mb-2"
                            value="{{ old('icon', $service->icon ?? '') }}" placeholder="bx bx-cog">

                        {{-- ICON PREVIEW --}}
                        <div class="border rounded p-3 text-center">
                            <i id="icon_preview" class="{{ old('icon', $service->icon ?? 'bx bx-cog') }}"
                                style="font-size:32px;"></i>
                        </div>
                    </div>
                </div>

                {{-- DESCRIPTION --}}
                <div class="col-md-12 mt-2"> <label class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5">{{ old('description', $service->description ?? '') }}</textarea>
                </div> {{-- META TITLE --}}
                <div class="col-md-6"> <label class="form-label">Meta Title</label> <input
                        type="text" name="meta_title" class="form-control"
                        value="{{ old('meta_title', $service->meta_title ?? '') }}"> </div> {{-- META KEYWORDS --}}
                <div
                    class="col-md-6"> <label class="form-label">Meta Keywords</label> <input type="text"
                        name="meta_keywords" class="form-control"
                        value="{{ old('meta_keywords', $service->meta_keywords ?? '') }}"> </div>
                {{-- META DESCRIPTION --}}
                <div class="col-md-12"> <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', $service->meta_description ?? '') }}</textarea>
                </div> {{-- FEATURED --}}
                <div class="col-md-6">
                    <div class="form-check form-switch mt-4"> <input class="form-check-input" type="checkbox"
                            name="is_featured" value="1"
                            {{ old('is_featured', $service->is_featured ?? 0) ? 'checked' : '' }}> <label
                            class="form-check-label">Featured</label> </div>
                </div> {{-- STATUS --}}
                <div class="col-md-6">
                    <div class="form-check form-switch mt-4"> <input class="form-check-input" type="checkbox"
                            name="is_active" value="1"
                            {{ old('is_active', $service->is_active ?? 1) ? 'checked' : '' }}> <label
                            class="form-check-label">Active</label> </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end"> <a href="{{ route('admin.services.index') }}"
                class="btn btn-outline-secondary">Cancel</a> <button class="btn btn-primary">
                {{ isset($service) ? 'Update Service' : 'Create Service' }} </button> </div>
    </form>
</div>

{{-- CROPIE MODAL --}}
@include('backend.partials.modal')

@endsection
