@extends('backend.layouts.app')

@section('title', isset($sectionContent) ? 'Edit Section Content' : 'Create Section Content')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">{{ isset($sectionContent) ? 'Edit' : 'Create' }} Section Content</h5>
    </div>

    <form method="POST"
          action="{{ route('admin.section-contents.saveorupdate', $sectionContent->uuid ?? null) }}">
        @csrf

        <div class="card-body row g-3">

            {{-- TITLE --}}
            <div class="col-md-6">
                <label class="form-label">Title *</label>
                <input type="text"
                       name="title"
                       id="title_input"
                       class="form-control"
                       value="{{ old('title', $sectionContent->title ?? '') }}"
                       required>
                @error('title')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- SLUG --}}
            <div class="col-md-6">
                <label class="form-label">Slug *</label>
                <input type="text"
                       name="slug"
                       id="slug_input"
                       class="form-control"
                       value="{{ old('slug', $sectionContent->slug ?? '') }}"
                       required>
                @error('slug')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- PAGE NAME --}}
            <div class="col-md-6">
                <label class="form-label">Page *</label>
                <select name="page_name" class="form-select" required>
                    <option value="">Select page</option>
                    @foreach (config('constants.PAGE_NAMES') as $value => $label)
                        <option value="{{ $value }}" {{ old('page_name', $sectionContent->page_name ?? '') == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('page_name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- SECTION NAME --}}
            <div class="col-md-6">
                <label class="form-label">Section *</label>
                <select name="section_name" class="form-select" required>
                    <option value="">Select section</option>
                    @foreach (config('constants.SECTION_NAMES') as $value => $label)
                        <option value="{{ $value }}" {{ old('section_name', $sectionContent->section_name ?? '') == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('section_name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- SECTION LABEL --}}
            <div class="col-md-4">
                <label class="form-label">Section Label</label>
                <input type="text"
                       name="section_label"
                       class="form-control"
                       placeholder="e.g. Who We Are"
                       value="{{ old('section_label', $sectionContent->section_label ?? '') }}">
            </div>

            {{-- SECTION TITLE --}}
            <div class="col-md-4">
                <label class="form-label">Section Title</label>
                <input type="text"
                       name="section_title"
                       class="form-control"
                       value="{{ old('section_title', $sectionContent->section_title ?? '') }}">
            </div>

            {{-- SECTION SUBTITLE --}}
            <div class="col-md-4">
                <label class="form-label">Section Subtitle</label>
                <input type="text"
                       name="section_subtitle"
                       class="form-control"
                       value="{{ old('section_subtitle', $sectionContent->section_subtitle ?? '') }}">
            </div>

            {{-- LEFT DESCRIPTION --}}
            <div class="col-md-6">
                <label class="form-label">Left Description</label>
                <textarea name="left_description"
                          id="left_description"
                          class="form-control"
                          rows="8">{{ old('left_description', $sectionContent->left_description ?? '') }}</textarea>
            </div>

            {{-- RIGHT LIST --}}
            <div class="col-md-6">
                <label class="form-label">Right List</label>
                <textarea name="right_list"
                          id="right_list"
                          class="form-control"
                          rows="8">{{ old('right_list', $sectionContent->right_list ?? '') }}</textarea>
            </div>

            {{-- ACTIVE SWITCH --}}
            <div class="col-md-6">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $sectionContent->is_active ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.section-contents.index') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">
                {{ isset($sectionContent) ? 'Update' : 'Create' }}
            </button>
        </div>

    </form>
</div>
@endsection
