@extends('backend.layouts.app')

@section('title', isset($testimonial) ? 'Edit Testimonial' : 'Create Testimonial')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">
            {{ isset($testimonial) ? 'Edit' : 'Create' }} Testimonial
        </h5>
    </div>

    <form method="POST"
          action="{{ isset($testimonial)
                ? route('admin.testimonials.saveorupdate', $testimonial->uuid)
                : route('admin.testimonials.saveorupdate') }}"
          enctype="multipart/form-data">
        @csrf

        <div class="card-body row g-3">

            {{-- NAME --}}
            <div class="col-md-3">
                <label class="form-label">Client Name *</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $testimonial->name ?? '') }}"
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- DESIGNATION --}}
            <div class="col-md-3">
                <label class="form-label">Designation</label>
                <input type="text"
                       name="designation"
                       class="form-control"
                       value="{{ old('designation', $testimonial->designation ?? '') }}">
            </div>

            {{-- COMPANY --}}
            <div class="col-md-3">
                <label class="form-label">Company</label>
                <input type="text"
                       name="company"
                       class="form-control"
                       value="{{ old('company', $testimonial->company ?? '') }}">
            </div>
            {{-- PAGE --}}
<div class="col-md-3">
    <label class="form-label">Show on Page</label>
    <select name="location"
            class="form-control @error('location') is-invalid @enderror">

        <option value="">-- All Pages --</option>

        @foreach($pages as $p)
            <option value="{{ $p->slug }}"
                {{ old('location', $testimonial->location ?? '') == $p->slug ? 'selected' : '' }}>
                {{ $p->name }}
            </option>
        @endforeach

    </select>
    <div class="form-text">Leave as "All Pages" to show this testimonial everywhere.</div>

    @error('location')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

            {{-- IMAGE --}}
            <div class="col-md-3">
                <label class="form-label">Client Image</label>
                <input type="file"
                       name="photo"
                       class="form-control image-preview-input @error('photo') is-invalid @enderror"
                       data-preview="#testimonialImagePreview">
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <img id="testimonialImagePreview"
                     src="{{ isset($testimonial) && $testimonial->photo ? asset('storage/' . $testimonial->photo) : 'https://placehold.co/130x130' }}"
                     class="mt-2 rounded border img-thumbnail" height="130" width="130">
            </div>

            {{-- RATING --}}
            <div class="col-md-3">
                <label class="form-label">Rating (1–5)</label>
                <input type="number"
                       name="rating"
                       min="1"
                       max="5"
                       class="form-control"
                       value="{{ old('rating', $testimonial->rating ?? 5) }}">
            </div>

            {{-- ICON --}}
            <div class="col-md-3">
                <label class="form-label">Icon Class</label>
                <input type="text"
                       name="icon"
                       class="form-control"
                       placeholder="bx bxs-quote-alt-left"
                       value="{{ old('icon', $testimonial->icon ?? 'bx bxs-quote-alt-left') }}">
            </div>

             {{-- DISPLAY ORDER --}}
            <div class="col-md-3">
                <label class="form-label">Display Order</label>
                <input type="number"
                       name="display_order"
                       class="form-control"
                       value="{{ old('display_order', $testimonial->display_order ?? 0) }}">
            </div>

            {{-- MESSAGE --}}
            <div class="col-md-12">
                <label class="form-label">Message *</label>
                <textarea name="message"
                          class="form-control @error('message') is-invalid @enderror"
                          rows="4"
                          required>{{ old('message', $testimonial->message ?? '') }}</textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>



            {{-- FEATURED --}}
            <div class="col-md-3">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_featured"
                           value="1"
                           {{ old('is_featured', $testimonial->is_featured ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label">Featured</label>
                </div>
            </div>

            {{-- ACTIVE --}}
            <div class="col-md-3">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">
                {{ isset($testimonial) ? 'Update' : 'Create' }}
            </button>
        </div>

    </form>
</div>
@endsection
