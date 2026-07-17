@extends('backend.layouts.app')

@section('title', isset($application) ? 'Edit Application' : 'Create Application')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">{{ isset($application) ? 'Edit' : 'Create' }} Career Application</h5>
    </div>

    <form method="POST"
          action="{{ route('admin.careers.applications.saveorupdate', $application->uuid ?? null) }}">
        @csrf

        <div class="card-body row g-3">

            {{-- CAREER --}}
            <div class="col-md-6">
                <label class="form-label">Job Opening *</label>
                <select name="career_id" class="form-control" required>
                    <option value="">Select Job Opening</option>
                    @foreach($careers as $item)
                        <option value="{{ $item->id }}"
                            {{ old('career_id', $application->career_id ?? '') == $item->id ? 'selected' : '' }}>
                            {{ $item->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- FULL NAME --}}
            <div class="col-md-6">
                <label class="form-label">Full Name *</label>
                <input type="text" name="full_name" class="form-control"
                       value="{{ old('full_name', $application->full_name ?? '') }}" required>
            </div>

            {{-- EMAIL --}}
            <div class="col-md-6">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email', $application->email ?? '') }}" required>
            </div>

            {{-- PHONE --}}
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control"
                       value="{{ old('phone', $application->phone ?? '') }}">
            </div>

            {{-- CURRENT COMPANY --}}
            <div class="col-md-4">
                <label class="form-label">Current Company</label>
                <input type="text" name="current_company" class="form-control"
                       value="{{ old('current_company', $application->current_company ?? '') }}">
            </div>

            {{-- CURRENT CTC --}}
            <div class="col-md-4">
                <label class="form-label">Current CTC</label>
                <input type="number" name="current_ctc" class="form-control"
                       value="{{ old('current_ctc', $application->current_ctc ?? '') }}">
            </div>

            {{-- EXPECTED CTC --}}
            <div class="col-md-4">
                <label class="form-label">Expected CTC</label>
                <input type="number" name="expected_ctc" class="form-control"
                       value="{{ old('expected_ctc', $application->expected_ctc ?? '') }}">
            </div>

            {{-- NOTICE PERIOD --}}
            <div class="col-md-4">
                <label class="form-label">Notice Period (days)</label>
                <input type="number" name="notice_period" class="form-control"
                       value="{{ old('notice_period', $application->notice_period ?? '') }}">
            </div>

            {{-- PORTFOLIO --}}
            <div class="col-md-8">
                <label class="form-label">Portfolio URL</label>
                <input type="url" name="portfolio_url" class="form-control"
                       value="{{ old('portfolio_url', $application->portfolio_url ?? '') }}">
            </div>

            {{-- COVER LETTER --}}
            <div class="col-md-12">
                <label class="form-label">Cover Letter</label>
                <textarea name="cover_letter" class="form-control" rows="4">{{ old('cover_letter', $application->cover_letter ?? '') }}</textarea>
            </div>

            {{-- ADMIN NOTES --}}
            <div class="col-md-12">
                <label class="form-label">Admin Notes</label>
                <textarea name="admin_notes" class="form-control" rows="3">{{ old('admin_notes', $application->admin_notes ?? '') }}</textarea>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.careers.applications.index') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">
                {{ isset($application) ? 'Update' : 'Create' }}
            </button>
        </div>

    </form>
</div>
@endsection
