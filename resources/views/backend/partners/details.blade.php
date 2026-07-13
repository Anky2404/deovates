@extends('backend.layouts.app')

@section('title','Enquiry Details')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Enquiry Details</h5>

        <a href="{{ route('admin.enquiries.index') }}" class="btn btn-sm btn-secondary">
            <i class="bx bx-arrow-back"></i> Back
        </a>
    </div>

    <div class="card-body">

        <div class="row g-4">

            {{-- BASIC INFO --}}
            <div class="col-md-6">
                <strong>Name</strong>
                <p>{{ $enquiry->name }}</p>
            </div>

            <div class="col-md-6">
                <strong>Email</strong>
                <p>{{ $enquiry->email }}</p>
            </div>

            <div class="col-md-6">
                <strong>Phone</strong>
                <p>{{ $enquiry->phone }}</p>
            </div>

            <div class="col-md-6">
                <strong>Company</strong>
                <p>{{ $enquiry->company_name ?? '—' }}</p>
            </div>

            <div class="col-md-6">
                <strong>Subject</strong>
                <p>{{ $enquiry->subject ?? '—' }}</p>
            </div>

            <div class="col-md-6">
                <strong>Type</strong>
                <p>
                    <span class="badge bg-label-info">
                        {{ ucfirst($enquiry->type) }}
                    </span>
                </p>
            </div>

            {{-- SERVICE DETAILS --}}
            <div class="col-md-6">
                <strong>Service Interest</strong>
                <p>{{ $enquiry->service_interest ?? '—' }}</p>
            </div>

            <div class="col-md-6">
                <strong>Project Budget</strong>
                <p>{{ $enquiry->project_budget ?? '—' }}</p>
            </div>

            <div class="col-md-6">
                <strong>Project Timeline</strong>
                <p>{{ $enquiry->project_timeline ?? '—' }}</p>
            </div>

            <div class="col-md-6">
                <strong>Source</strong>
                <p>{{ $enquiry->source ?? '—' }}</p>
            </div>

            {{-- MESSAGE --}}
            <div class="col-md-12">
                <strong>Message</strong>
                <div class="border rounded p-3 mt-2 bg-light">
                    {{ $enquiry->message }}
                </div>
            </div>

            {{-- SYSTEM INFO --}}
            <div class="col-md-6">
                <strong>IP Address</strong>
                <p>{{ $enquiry->ip_address ?? '—' }}</p>
            </div>

            <div class="col-md-6">
                <strong>User Agent</strong>
                <p class="small text-muted">
                    {{ $enquiry->user_agent ?? '—' }}
                </p>
            </div>

            <div class="col-md-6">
                <strong>Submitted At</strong>
                <p>{{ $enquiry->created_at->format('d M Y H:i') }}</p>
            </div>

            <div class="col-md-6">
                <strong>Status</strong>
                <p>
                    <span class="badge bg-label-primary">
                        {{ ucfirst($enquiry->status) }}
                    </span>
                </p>
            </div>

        </div>

        <hr class="my-4">

        {{-- ADMIN MANAGEMENT --}}
        <form method="POST"
              action="{{ route('admin.enquiries.update-status',$enquiry->uuid) }}">

            @csrf

            <div class="row g-3">

                {{-- STATUS --}}
                <div class="col-md-4">

                    <label class="form-label">Status</label>

                    <select name="status" class="form-control">

                        @foreach(['new','in_progress','converted','closed','spam'] as $status)

                            <option value="{{ $status }}"
                                {{ $enquiry->status==$status ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_',' ',$status)) }}
                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- ASSIGNED USER --}}
                <div class="col-md-4">

                    <label class="form-label">Assign To</label>

                    <select name="assigned_to" class="form-control">

                        <option value="">-- Unassigned --</option>

                        @foreach($users as $id=>$name)

                            <option value="{{ $id }}"
                                {{ $enquiry->assigned_to==$id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- FOLLOW UP --}}
                <div class="col-md-4">

                    <label class="form-label">Follow Up Date</label>

                    <input type="datetime-local"
                           name="follow_up_at"
                           class="form-control"
                           value="{{ optional($enquiry->follow_up_at)->format('Y-m-d\TH:i') }}">

                </div>

                {{-- ADMIN NOTES --}}
                <div class="col-md-12">

                    <label class="form-label">Admin Notes</label>

                    <textarea name="admin_notes"
                              class="form-control"
                              rows="4">{{ $enquiry->admin_notes }}</textarea>

                </div>

            </div>

            <div class="mt-4 text-end">

                <button class="btn btn-primary">
                    Update Enquiry
                </button>

                <a href="{{ route('admin.enquiries.markspam',$enquiry->uuid) }}"
                   class="btn btn-warning">
                    Mark as Spam
                </a>

            </div>

        </form>

    </div>

</div>

@endsection