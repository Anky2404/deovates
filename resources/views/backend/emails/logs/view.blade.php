@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Email Log Details')

@section('content')
<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Email Log Details</h5>

        <a href="{{ route('admin.emails.logs.index') }}" class="btn btn-sm btn-secondary">
            <i class="bx bx-arrow-back"></i> Back
        </a>
    </div>

    <div class="card-body">

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <strong>From</strong>
                <p class="mb-0">{{ $log->from_name ?? '—' }}</p>
                <small class="text-muted">{{ $log->from_email ?? '—' }}</small>
            </div>

            <div class="col-md-6">
                <strong>To</strong>
                <p class="mb-0">{{ $log->to_name ?? '—' }}</p>
                <small class="text-muted">{{ $log->to_email }}</small>
            </div>

            <div class="col-md-6">
                <strong>Subject</strong>
                <p>{{ $log->subject }}</p>
            </div>

            <div class="col-md-3">
                <strong>Template</strong>
                <p>{{ $log->template->name ?? '—' }}</p>
            </div>

            <div class="col-md-3">
                <strong>Status</strong>
                <p>
                    <span class="badge bg-label-{{ $log->status == 'sent' ? 'success' : ($log->status == 'failed' ? 'danger' : 'warning') }}">
                        {{ ucfirst($log->status) }}
                    </span>
                </p>
            </div>

            @if ($log->error_message)
                <div class="col-md-12">
                    <strong class="text-danger">Error</strong>
                    <p class="text-danger">{{ $log->error_message }}</p>
                </div>
            @endif
        </div>

        <hr class="my-4">

        <h6 class="mb-3">Email Preview</h6>

        @include('backend.partials.email-preview', [
            'previewId' => 'logPreview',
            'previewHtml' => view('emails.layout', [
                'subject' => $log->subject,
                'body' => $log->body ?? '<p>No stored body for this log entry.</p>',
            ])->render(),
        ])

    </div>

</div>
@endsection
