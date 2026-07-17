@extends('backend.layouts.app')

@section('title', 'Email Template Details')

@section('content')

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Email Template Details</h5>

            <div class="d-flex gap-2">

                <a href="{{ route('admin.emails.templates.createoredit', $template->uuid) }}" class="btn btn-sm btn-primary">
                    <i class="bx bx-edit"></i> Edit
                </a>

                <a href="{{ route('admin.emails.templates.index') }}" class="btn btn-sm btn-secondary">
                    <i class="bx bx-arrow-back"></i> Back
                </a>

            </div>
        </div>

        <div class="card-body">

            <div class="row g-4">

                <div class="col-md-6">
                    <strong>Name</strong>
                    <p>{{ $template->name }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Slug</strong>
                    <p>{{ $template->slug }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Subject</strong>
                    <p>{{ $template->subject }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Module</strong>
                    <p>{{ $template->module ?? '—' }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Type</strong>
                    <p>{{ $template->type ?? '—' }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Status</strong>
                    <p>
                        <span
                            class="badge toggle-status cursor-pointer bg-label-{{ $template->is_active ? 'success' : 'danger' }}"
                            data-url="{{ route('admin.emails.templates.togglestatus', $template->uuid) }}">
                            {{ $template->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </p>
                </div>

                <div class="col-md-12">
                    <strong>Available Variables</strong>

                    <div class="mt-2">

                        @if (!empty($template->variables))

                            @foreach ($template->variables as $variable)
                                <span class="badge bg-label-info me-1">
                                    {{ '{' . '{' . $variable . '}' . '}' }}
                                </span>
                            @endforeach
                        @else
                            <span class="text-muted">No variables defined</span>

                        @endif

                    </div>
                </div>

            </div>

            <hr class="my-4">

            <h6 class="mb-3">Email Preview</h6>

            @include('backend.partials.email-preview', [
                'previewId' => 'templateDetailsPreview',
                'previewHtml' => view('emails.layout', [
                    'subject' => $template->subject,
                    'body' => $template->body,
                ])->render(),
            ])

        </div>

    </div>

@endsection
