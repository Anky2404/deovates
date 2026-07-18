@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Activity Log Details')

@section('content')
<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Activity Log Details</h5>
        <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back"></i> Back
        </a>
    </div>

    <div class="card-body">
        <div class="row g-3">

            <div class="col-md-4">
                <label class="form-label fw-bold">User</label>
                <p class="mb-0">{{ $row->user->name ?? 'N/A' }}</p>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Role</label>
                <p class="mb-0"><span class="badge bg-label-info">{{ ucfirst($row->user_role ?? 'N/A') }}</span></p>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Action</label>
                <p class="mb-0"><span class="badge bg-label-primary">{{ ucfirst($row->action) }}</span></p>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Module</label>
                <p class="mb-0">{{ $row->module ?? 'N/A' }}</p>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Subject</label>
                <p class="mb-0">{{ $row->subject_type ?? 'N/A' }} #{{ $row->subject_id ?? '-' }}</p>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Level</label>
                @php
                    $levelClass = match ($row->level) {
                        'info' => 'success',
                        'warning' => 'warning',
                        'error' => 'danger',
                        default => 'secondary',
                    };
                @endphp
                <p class="mb-0"><span class="badge bg-label-{{ $levelClass }}">{{ ucfirst($row->level ?? 'N/A') }}</span></p>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">IP Address</label>
                <p class="mb-0">{{ $row->ip_address ?? 'N/A' }}</p>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Method</label>
                <p class="mb-0"><span class="badge bg-label-secondary">{{ $row->method ?? 'N/A' }}</span></p>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Date & Time</label>
                <p class="mb-0">{{ $row->created_at?->format('d M Y h:i A') }}</p>
            </div>

            <div class="col-12">
                <label class="form-label fw-bold">URL</label>
                <p class="mb-0 text-break">{{ $row->url ?? 'N/A' }}</p>
            </div>

            <div class="col-12">
                <label class="form-label fw-bold">Description</label>
                <p class="mb-0">{{ $row->description ?? 'N/A' }}</p>
            </div>

            <div class="col-12">
                <label class="form-label fw-bold">User Agent</label>
                <p class="mb-0 text-break">{{ $row->user_agent ?? 'N/A' }}</p>
            </div>

            @if (!empty($row->old_values))
                <div class="col-md-6">
                    <label class="form-label fw-bold">Old Values</label>
                    <pre class="bg-light p-2 rounded small">{{ json_encode($row->old_values, JSON_PRETTY_PRINT) }}</pre>
                </div>
            @endif

            @if (!empty($row->new_values))
                <div class="col-md-6">
                    <label class="form-label fw-bold">New Values</label>
                    <pre class="bg-light p-2 rounded small">{{ json_encode($row->new_values, JSON_PRETTY_PRINT) }}</pre>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection
