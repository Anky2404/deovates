@extends('backend.layouts.app')

@section('title', isset($career) ? 'Edit Career' : 'Create Career')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">{{ isset($career) ? 'Edit' : 'Create' }} Career</h5>
    </div>

    <form method="POST"
          action="{{ route('admin.careers.saveorupdate', $career->uuid ?? null) }}">
        @csrf

        <div class="card-body row g-3">

            {{-- DEPARTMENT --}}
            <div class="col-md-6">
                <label class="form-label">Department *</label>
                <select name="department_id" class="form-control" required>
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}"
                            {{ old('department_id', $career->department_id ?? '') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- TITLE --}}
            <div class="col-md-6">
                <label class="form-label">Job Title *</label>
                <input type="text" id="title_input" name="title" class="form-control"
                       value="{{ old('title', $career->title ?? '') }}" required>
            </div>

            {{-- SLUG --}}
            <div class="col-md-6">
                <label class="form-label">Slug *</label>
                <input type="text" id="slug_input" name="slug" class="form-control"
                       value="{{ old('slug', $career->slug ?? '') }}" required>
            </div>

            {{-- EMPLOYMENT TYPE --}}
            <div class="col-md-6">
                <label class="form-label">Employment Type</label>
                <select name="employment_type" class="form-control">
                    <option value="Full Time">Full Time</option>
                    <option value="Part Time">Part Time</option>
                    <option value="Contract">Contract</option>
                    <option value="Internship">Internship</option>
                </select>
            </div>

            {{-- EXPERIENCE LEVEL --}}
            <div class="col-md-6">
                <label class="form-label">Experience Level</label>
                <input type="text" name="experience_level" class="form-control"
                       value="{{ old('experience_level', $career->experience_level ?? '') }}">
            </div>

            {{-- LOCATION --}}
            <div class="col-md-6">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control"
                       value="{{ old('location', $career->location ?? '') }}">
            </div>

            {{-- REMOTE --}}
            <div class="col-md-3">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_remote"
                           value="1"
                           {{ old('is_remote', $career->is_remote ?? 0) ? 'checked' : '' }}>
                    <label class="form-check-label">Remote</label>
                </div>
            </div>

            {{-- OPENINGS --}}
            <div class="col-md-3">
                <label class="form-label">Openings</label>
                <input type="number" name="openings" class="form-control"
                       value="{{ old('openings', $career->openings ?? 1) }}">
            </div>

            {{-- SALARY --}}
            <div class="col-md-4">
                <label class="form-label">Salary Min</label>
                <input type="number" name="salary_min" class="form-control"
                       value="{{ old('salary_min', $career->salary_min ?? '') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Salary Max</label>
                <input type="number" name="salary_max" class="form-control"
                       value="{{ old('salary_max', $career->salary_max ?? '') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Currency</label>
                <input type="text" name="salary_currency" class="form-control"
                       value="{{ old('salary_currency', $career->salary_currency ?? 'INR') }}">
            </div>

            {{-- DESCRIPTION --}}
            <div class="col-md-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4">
                    {{ old('description', $career->description ?? '') }}
                </textarea>
            </div>

            {{-- RESPONSIBILITIES --}}
            <div class="col-md-12">
                <label class="form-label">Responsibilities</label>
                <textarea name="responsibilities" class="form-control" rows="3">
                    {{ old('responsibilities', $career->responsibilities ?? '') }}
                </textarea>
            </div>

            {{-- REQUIREMENTS --}}
            <div class="col-md-12">
                <label class="form-label">Requirements</label>
                <textarea name="requirements" class="form-control" rows="3">
                    {{ old('requirements', $career->requirements ?? '') }}
                </textarea>
            </div>

            {{-- BENEFITS --}}
            <div class="col-md-12">
                <label class="form-label">Benefits</label>
                <textarea name="benefits" class="form-control" rows="3">
                    {{ old('benefits', $career->benefits ?? '') }}
                </textarea>
            </div>

            {{-- SKILLS --}}
            <div class="col-md-12">
                <label class="form-label">Skills (Comma separated)</label>
                <input type="text" name="skills" class="form-control"
                       value="{{ old('skills', $career->skills ?? '') }}">
            </div>

            {{-- APPLY INFO --}}
            <div class="col-md-6">
                <label class="form-label">Apply URL</label>
                <input type="url" name="apply_url" class="form-control"
                       value="{{ old('apply_url', $career->apply_url ?? '') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Apply Email</label>
                <input type="email" name="apply_email" class="form-control"
                       value="{{ old('apply_email', $career->apply_email ?? '') }}">
            </div>

            {{-- DEADLINE --}}
            <div class="col-md-6">
                <label class="form-label">Application Deadline</label>
                <input type="date" name="application_deadline" class="form-control"
                       value="{{ old('application_deadline', $career->application_deadline ?? '') }}">
            </div>

            {{-- SEO --}}
            <div class="col-md-6">
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" class="form-control"
                       value="{{ old('meta_title', $career->meta_title ?? '') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description" class="form-control" rows="2">
                    {{ old('meta_description', $career->meta_description ?? '') }}
                </textarea>
            </div>

            {{-- SWITCHES --}}
            <div class="col-md-6">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $career->is_active ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_featured"
                           value="1"
                           {{ old('is_featured', $career->is_featured ?? 0) ? 'checked' : '' }}>
                    <label class="form-check-label">Featured</label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.careers.index') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">
                {{ isset($career) ? 'Update' : 'Create' }}
            </button>
        </div>

    </form>
</div>
@endsection
