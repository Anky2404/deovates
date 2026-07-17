@extends('backend.layouts.app')

@section('title', isset($career) ? 'Edit Career' : 'Create Career')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">{{ isset($career) ? 'Edit' : 'Create' }} Career</h5>
    </div>

    <form method="POST" action="{{ route('admin.careers.saveorupdate', $career->uuid ?? null) }}">
        @csrf

        <div class="card-body row g-4">

            {{-- DEPARTMENT --}}
            <div class="col-md-4">
                <label class="form-label">Department *</label>
                <select name="department_id" class="form-control trim" required>
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
            <div class="col-md-4">
                <label class="form-label">Job Title *</label>
                <input type="text" id="title_input" name="title" class="form-control trim"
                       value="{{ old('title', $career->title ?? '') }}" required>
            </div>

            {{-- SLUG --}}
            <div class="col-md-4">
                <label class="form-label">Slug *</label>
                <input type="text"id="slug_input" name="slug" class="form-control trim"
                       value="{{ old('slug', $career->slug ?? '') }}" required>
            </div>

            {{-- EMPLOYMENT TYPE --}}
            <div class="col-md-4">
                <label class="form-label">Employment Type</label>
                @php
                    $etype = old('employment_type', $career->employment_type ?? '');
                @endphp
                <select name="employment_type" class="form-control trim">
                    <option value="full-time" {{ $etype == 'full-time' ? 'selected' : '' }}>Full Time</option>
                    <option value="part-time" {{ $etype == 'part-time' ? 'selected' : '' }}>Part Time</option>
                    <option value="contract" {{ $etype == 'contract' ? 'selected' : '' }}>Contract</option>
                    <option value="internship" {{ $etype == 'internship' ? 'selected' : '' }}>Internship</option>
                    <option value="freelance" {{ $etype == 'freelance' ? 'selected' : '' }}>Freelance</option>
                </select>
            </div>

            {{-- EXPERIENCE LEVEL --}}
            <div class="col-md-4">
                <label class="form-label">Experience Level</label>
                @php $elevel = old('experience_level', $career->experience_level ?? 'mid'); @endphp
                <select name="experience_level" class="form-control trim">
                    <option value="fresher" {{ $elevel == 'fresher' ? 'selected' : '' }}>Fresher</option>
                    <option value="junior" {{ $elevel == 'junior' ? 'selected' : '' }}>Junior</option>
                    <option value="mid" {{ $elevel == 'mid' ? 'selected' : '' }}>Mid</option>
                    <option value="senior" {{ $elevel == 'senior' ? 'selected' : '' }}>Senior</option>
                    <option value="lead" {{ $elevel == 'lead' ? 'selected' : '' }}>Lead</option>
                </select>
            </div>

            {{-- LOCATION --}}
            <div class="col-md-4">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control trim"
                       value="{{ old('location', $career->location ?? '') }}">
            </div>


            {{-- OPENINGS --}}
            <div class="col-md-3">
                <label class="form-label">Openings</label>
                <input type="number" name="openings" class="form-control trim"
                       value="{{ old('openings', $career->openings ?? 1) }}">
            </div>

            {{-- SALARY --}}
            <div class="col-md-3">
                <label class="form-label">Salary Min</label>
                <input type="number" name="salary_min" class="form-control trim"
                       value="{{ old('salary_min', $career->salary_min ?? '') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Salary Max</label>
                <input type="number" name="salary_max" class="form-control trim"
                       value="{{ old('salary_max', $career->salary_max ?? '') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Currency</label>
                <input type="text" name="salary_currency" class="form-control trim"
                       value="{{ old('salary_currency', $career->salary_currency ?? 'INR') }}">
            </div>

            {{-- TEXTAREAS FULL WIDTH --}}
            <div class="col-md-6">
                <label class="form-label">Description</label>
                <textarea name="description" rows="5" class="form-control trim">{{ old('description', $career->description ?? '') }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Responsibilities</label>
                <textarea name="responsibilities" rows="5" class="form-control trim">{{ old('responsibilities', $career->responsibilities ?? '') }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Requirements</label>
                <textarea name="requirements" rows="3" class="form-control trim">{{ old('requirements', $career->requirements ?? '') }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Benefits</label>
                <textarea name="benefits" rows="3" class="form-control trim">{{ old('benefits', $career->benefits ?? '') }}</textarea>
            </div>

           

            {{-- APPLY INFO --}}
            <div class="col-md-4">
                <label class="form-label">Apply URL</label>
                <input type="url" name="apply_url" class="form-control trim"
                       value="{{ old('apply_url', $career->apply_url ?? '') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Apply Email</label>
                <input type="email" name="apply_email" class="form-control trim"
                       value="{{ old('apply_email', $career->apply_email ?? '') }}">
            </div>

            {{-- DEADLINE --}}
           <div class="col-md-4">
    <label class="form-label">Application Deadline</label>
    <input type="date" name="application_deadline" class="form-control trim"
           value="{{ old('application_deadline', isset($career->application_deadline) ? \Carbon\Carbon::parse($career->application_deadline)->format('Y-m-d') : '') }}">
</div>

 {{-- SKILLS --}}
            <div class="col-md-6">
                <label class="form-label">Skills (Comma separated)</label>

                @php
                    $skills = $career->skills ?? '';
                    if (is_array(json_decode($skills, true))) {
                        $skills = implode(',', json_decode($skills, true));
                    }
                @endphp

                <input type="text" name="skills" class="form-control trim"
                       value="{{ old('skills', $skills) }}">
            </div>
            {{-- SEO --}}
            <div class="col-md-6">
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" class="form-control trim"
                       value="{{ old('meta_title', $career->meta_title ?? '') }}">
            </div>

            <div class="col-md-12">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description" rows="2" class="form-control trim">{{ old('meta_description', $career->meta_description ?? '') }}</textarea>
            </div>

          {{-- SWITCHES + BUTTONS IN ONE SINGLE ROW --}}
<div class="card-footer d-flex align-items-center justify-content-between flex-wrap gap-4">

    {{-- SWITCHES GROUP --}}
    <div class="d-flex gap-5">

        {{-- ACTIVE --}}
        <div class="form-check form-switch">
            <input type="checkbox" class="form-check-input" name="is_active" value="1"
                {{ old('is_active', $career->is_active ?? 1) ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

        {{-- FEATURED --}}
        <div class="form-check form-switch">
            <input type="checkbox" class="form-check-input" name="is_featured" value="1"
                {{ old('is_featured', $career->is_featured ?? 0) ? 'checked' : '' }}>
            <label class="form-check-label">Featured</label>
        </div>

        {{-- REMOTE --}}
        <div class="form-check form-switch">
            <input type="checkbox" class="form-check-input" name="is_remote" value="1"
                {{ old('is_remote', $career->is_remote ?? 0) ? 'checked' : '' }}>
            <label class="form-check-label">Remote</label>
        </div>

    </div>

    {{-- BUTTONS --}}
    <div class="d-flex gap-3">
        <a href="{{ route('admin.careers.index') }}" class="btn btn-secondary px-4">Cancel</a>

        <button class="btn btn-primary px-4">
            {{ isset($career) ? 'Update' : 'Create' }}
        </button>
    </div>

</div>


    </form>
</div>

{{-- TRIM SCRIPT --}}
<script>
    document.querySelectorAll('.trim').forEach(el => {
        el.addEventListener('change', () => el.value = el.value.trim());
    });
</script>

@endsection
