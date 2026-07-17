@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Email Details')

@section('content')
<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Email Details</h5>

        <a href="{{ route('admin.emails.index') }}" class="btn btn-sm btn-secondary">
            <i class="bx bx-arrow-back"></i> Back
        </a>
    </div>

    <div class="card-body">

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <strong>From</strong>
                <p class="mb-0">{{ $email->from_name ?? '—' }}</p>
                <small class="text-muted">{{ $email->from_email }}</small>
            </div>

            <div class="col-md-6">
                <strong>To</strong>
                <p class="mb-0">{{ $email->to_name ?? '—' }}</p>
                <small class="text-muted">{{ $email->to_email }}</small>
            </div>

            <div class="col-md-6">
                <strong>Subject</strong>
                <p>{{ $email->subject }}</p>
            </div>

            <div class="col-md-3">
                <strong>Status</strong>
                <p>
                    <span class="badge bg-label-{{ $email->status == 'sent' ? 'success' : ($email->status == 'failed' ? 'danger' : 'warning') }}">
                        {{ ucfirst($email->status) }}
                    </span>
                </p>
            </div>

            <div class="col-md-3">
                <strong>Sent At</strong>
                <p>{{ $email->sent_at ? $email->sent_at->format('d M Y H:i') : '—' }}</p>
            </div>

            @if ($email->failure_reason)
                <div class="col-md-12">
                    <strong class="text-danger">Failure Reason</strong>
                    <p class="text-danger">{{ $email->failure_reason }}</p>
                </div>
            @endif
        </div>

        <hr class="my-4">

        <h6 class="mb-3">Email Preview</h6>

        @include('backend.partials.email-preview', [
            'previewId' => 'sentEmailPreview',
            'previewHtml' => view('emails.layout', [
                'subject' => $email->subject,
                'body' => $email->body,
            ])->render(),
        ])

    </div>

</div>
@endsection
