@extends('backend.layouts.app')

@section('title', isset($department) ? 'Edit Department' : 'Create Department')

@section('content')

<div class="card">

    <div class="card-header">
        <h5 class="mb-0">
            {{ isset($department) ? 'Edit Department' : 'Create Department' }}
        </h5>
    </div>

    <form method="POST"
          action="{{ route('admin.departments.saveorupdate', $department->uuid ?? null) }}">

        @csrf

        <div class="card-body row g-3">

            {{-- NAME --}}
            <div class="col-md-6">
                <label class="form-label">Name *</label>

                <input type="text"
                       id="title_input"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $department->name ?? '') }}"
                       required>
            </div>

            {{-- SLUG --}}
            <div class="col-md-6">
                <label class="form-label">Slug *</label>

                <input type="text"
                       id="slug_input"
                       name="slug"
                       class="form-control"
                       value="{{ old('slug', $department->slug ?? '') }}"
                       required>
            </div>

            {{-- DESCRIPTION --}}
            <div class="col-md-12">
                <label class="form-label">Description</label>

                <textarea name="description"
                          class="form-control"
                          rows="4">{{ old('description', $department->description ?? '') }}</textarea>
            </div>

            {{-- STATUS --}}
            <div class="col-md-6">

                <div class="form-check form-switch mt-4">

                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $department->is_active ?? 1) ? 'checked' : '' }}>

                    <label class="form-check-label">
                        Active
                    </label>

                </div>

            </div>

        </div>

        <div class="card-footer text-end">

            <a href="{{ route('admin.departments.index') }}"
               class="btn btn-secondary">
                Cancel
            </a>

            <button class="btn btn-primary">
                {{ isset($department) ? 'Update' : 'Create' }}
            </button>

        </div>

    </form>

</div>

@endsection