@extends('backend.layouts.app')

@section('title', isset($author) ? 'Edit Author' : 'Create Author')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">{{ isset($author) ? 'Edit' : 'Create' }} Author</h5>
    </div>

    <form method="POST"
          action="{{ route('admin.authors.saveorupdate', $author->uuid ?? null) }}"
          enctype="multipart/form-data">
        @csrf

        <div class="card-body row g-3">

            {{-- USER --}}
            <div class="col-md-6">
                <label class="form-label">User ID</label>
                <input type="number"
                       name="user_id"
                       class="form-control"
                       value="{{ old('user_id', $author->user_id ?? '') }}">
            </div>

            {{-- NAME --}}
            <div class="col-md-6">
                <label class="form-label">Name *</label>
                <input type="text"
                       id="title_input"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $author->name ?? '') }}"
                       required>
            </div>

            {{-- SLUG --}}
            <div class="col-md-6">
                <label class="form-label">Slug *</label>
                <input type="text"
                       id="slug_input"
                       name="slug"
                       class="form-control"
                       value="{{ old('slug', $author->slug ?? '') }}"
                       required>
            </div>

            {{-- EMAIL --}}
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email', $author->email ?? '') }}">
            </div>

            {{-- PHONE --}}
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text"
                       name="phone"
                       class="form-control"
                       value="{{ old('phone', $author->phone ?? '') }}">
            </div>

            {{-- DESIGNATION --}}
            <div class="col-md-6">
                <label class="form-label">Designation</label>
                <input type="text"
                       name="designation"
                       class="form-control"
                       value="{{ old('designation', $author->designation ?? '') }}">
            </div>

            {{-- COMPANY --}}
            <div class="col-md-6">
                <label class="form-label">Company</label>
                <input type="text"
                       name="company"
                       class="form-control"
                       value="{{ old('company', $author->company ?? '') }}">
            </div>

            {{-- WEBSITE --}}
            <div class="col-md-6">
                <label class="form-label">Website</label>
                <input type="url"
                       name="website"
                       class="form-control"
                       value="{{ old('website', $author->website ?? '') }}">
            </div>

            {{-- PROFILE IMAGE --}}
            <div class="col-md-6">
                <label class="form-label">Profile Image</label>
                <input type="file" name="profile_image" class="form-control image-preview-input"
                       data-preview="#profileImagePreview">

                <img id="profileImagePreview"
                     src="{{ !empty($author->profile_image) ? asset('storage/' . $author->profile_image) : 'https://placehold.co/130x130' }}"
                     class="mt-2 rounded border img-thumbnail" height="130" width="130">
            </div>

            {{-- COVER IMAGE --}}
            <div class="col-md-6">
                <label class="form-label">Cover Image</label>
                <input type="file" name="cover_image" class="form-control image-preview-input"
                       data-preview="#coverImagePreview">

                <img id="coverImagePreview"
                     src="{{ !empty($author->cover_image) ? asset('storage/' . $author->cover_image) : 'https://placehold.co/130x130' }}"
                     class="mt-2 rounded border img-thumbnail" height="130" width="130">
            </div>

            {{-- BIO --}}
            <div class="col-md-12">
                <label class="form-label">Bio</label>
                <textarea name="bio"
                          class="form-control"
                          rows="4">{{ old('bio', $author->bio ?? '') }}</textarea>
            </div>

            {{-- SOCIAL LINKS (JSON) --}}
            <div class="col-md-12">
    <label class="form-label">Social Links (JSON)</label>
    <textarea name="social_links"
          class="form-control"
          rows="4">{{ 
    old('social_links', 
        isset($author->social_links) 
            ? json_encode($author->social_links, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) 
            : ''
    ) 
}}</textarea>
o
</div>


            {{-- SEO --}}
            <div class="col-md-6">
                <label class="form-label">Meta Title</label>
                <input type="text"
                       name="meta_title"
                       class="form-control"
                       value="{{ old('meta_title', $author->meta_title ?? '') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description"
                          class="form-control"
                          rows="2">{{ old('meta_description', $author->meta_description ?? '') }}</textarea>
            </div>

            {{-- TOTAL BLOGS --}}
            <div class="col-md-6">
                <label class="form-label">Total Blogs</label>
                <input type="number"
                       name="total_blogs"
                       class="form-control"
                       value="{{ old('total_blogs', $author->total_blogs ?? 0) }}">
            </div>

            {{-- SWITCHES --}}
            <div class="col-md-6">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_featured"
                           value="1"
                           {{ old('is_featured', $author->is_featured ?? 0) ? 'checked' : '' }}>
                    <label class="form-check-label">Featured</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $author->is_active ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">
                {{ isset($author) ? 'Update' : 'Create' }}
            </button>
        </div>

    </form>
</div>
@endsection
