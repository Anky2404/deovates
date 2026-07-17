@extends('backend.layouts.app')

@section('title','Subscriber Details')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Subscriber Details</h5>

        <a href="{{ route('admin.newsletter-subscribers.index') }}" class="btn btn-sm btn-secondary">
            <i class="bx bx-arrow-back"></i> Back
        </a>
    </div>

    <div class="card-body">

        <div class="row g-4">

            <div class="col-md-6">
                <strong>Email</strong>
                <p>{{ $subscriber->email }}</p>
            </div>

            <div class="col-md-6">
                <strong>Name</strong>
                <p>{{ $subscriber->name ?? '—' }}</p>
            </div>

            <div class="col-md-6">
                <strong>Status</strong>
                <p>
                    @if($subscriber->is_active)
                        <span class="badge bg-label-success">Active</span>
                    @else
                        <span class="badge bg-label-danger">Inactive</span>
                    @endif
                </p>
            </div>

            <div class="col-md-6">
                <strong>Confirmed</strong>
                <p>
                    @if($subscriber->is_confirmed)
                        <span class="badge bg-label-success">Yes</span>
                    @else
                        <span class="badge bg-label-warning">No</span>
                    @endif
                </p>
            </div>

            <div class="col-md-6">
                <strong>Subscribed At</strong>
                <p>{{ optional($subscriber->subscribed_at)->format('d M Y H:i') ?? '—' }}</p>
            </div>

            <div class="col-md-6">
                <strong>Confirmed At</strong>
                <p>{{ optional($subscriber->confirmed_at)->format('d M Y H:i') ?? '—' }}</p>
            </div>

            <div class="col-md-6">
                <strong>Unsubscribed At</strong>
                <p>{{ optional($subscriber->unsubscribed_at)->format('d M Y H:i') ?? '—' }}</p>
            </div>

            <div class="col-md-6">
                <strong>Source</strong>
                <p>{{ $subscriber->source ?? '—' }}</p>
            </div>

            <div class="col-md-6">
                <strong>Emails Sent</strong>
                <p>{{ $subscriber->emails_sent }}</p>
            </div>

            <div class="col-md-6">
                <strong>Last Email Sent</strong>
                <p>{{ optional($subscriber->last_email_sent_at)->format('d M Y H:i') ?? '—' }}</p>
            </div>

            <div class="col-md-6">
                <strong>IP Address</strong>
                <p>{{ $subscriber->ip_address ?? '—' }}</p>
            </div>

            <div class="col-md-6">
                <strong>User Agent</strong>
                <p class="small text-muted">{{ $subscriber->user_agent ?? '—' }}</p>
            </div>

            <div class="col-md-6">
                <strong>Created At</strong>
                <p>{{ $subscriber->created_at->format('d M Y H:i') }}</p>
            </div>

            <div class="col-md-6">
                <strong>Read At</strong>
                <p>{{ optional($subscriber->read_at)->format('d M Y H:i') ?? '—' }}</p>
            </div>

        </div>

    </div>

</div>

@endsection