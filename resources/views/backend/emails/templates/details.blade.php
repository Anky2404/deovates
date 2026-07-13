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

            <div class="border rounded p-3" style="background:#f5f7fb">

                <style>
                    .email-wrapper {
                        width: 100%;
                        max-width: 650px;
                        margin: auto;
                        font-family: Arial, Helvetica, sans-serif;
                    }

                    .email-header {
                        background: rgb(6, 52, 112);
                        color: #fff;
                        padding: 35px 30px;
                        text-align: center;
                    }

                    .email-logo {
                        height: 55px;
                        margin-bottom: 12px;
                    }

                    .email-title {
                        margin: 0;
                        font-size: 24px;
                        font-weight: 600;
                        color: #fff;
                    }

                    .email-subtitle {
                        margin-top: 6px;
                        font-size: 14px;
                        opacity: 0.9;
                    }

                    .email-body {
                        background: #ffffff;
                        padding: 45px 40px;
                    }

                    .email-body h1,
                    .email-body h2,
                    .email-body h3 {
                        color: rgb(6, 52, 112);
                        margin-bottom: 15px;
                    }

                    .email-body p {
                        color: #6c757d;
                        font-size: 16px;
                        line-height: 1.8;
                        margin-bottom: 15px;
                    }

                    .hero-description {
                        max-width: 820px;
                        margin-left: auto;
                        margin-right: auto;
                        font-size: 18px;
                        line-height: 1.8;
                        letter-spacing: 0.4px;
                        opacity: 0.95;
                    }

                    .font-serif {
                        font-family: Volkhov, "Times New Roman", sans-serif;
                        font-style: italic;
                    }

                    .cta-section {
                        text-align: center;
                        padding: 25px;
                        background: #ffffff;
                    }

                    .cta-btn {
                        background: rgb(6, 52, 112);
                        color: #fff;
                        padding: 14px 32px;
                        text-decoration: none;
                        border-radius: 6px;
                        font-weight: 600;
                        display: inline-block;
                    }

                    .email-footer {
                        background: #f2f5fa;
                        padding: 30px;
                        text-align: center;
                        font-size: 13px;
                        color: #666;
                    }

                    .email-footer a {
                        margin: 0 8px;
                        color: rgb(6, 52, 112);
                        text-decoration: none;
                    }

                    @media (max-width:768px) {

                        .email-body {
                            padding: 25px;
                        }

                        .email-title {
                            font-size: 20px;
                        }

                        .email-body p {
                            font-size: 15px;
                        }

                        .cta-btn {
                            padding: 12px 24px;
                        }

                    }
                </style>

                <div class="email-wrapper">

                    <table width="100%" cellpadding="0" cellspacing="0">

                        <tr>
                            <td class="email-header">

                                <img src="{{ asset('assets/frontend/images/logo.png') }}" class="email-logo"
                                    alt="Logo">

                                <h2 class="email-title">
                                    {{ config('app.name') }}
                                </h2>

                                <p class="email-subtitle">
                                    Future Ready Digital Platform
                                </p>

                            </td>
                        </tr>

                        <tr>
                            <td class="email-body">

                                {!! $template->body !!}

                            </td>
                        </tr>

                        <tr>
                            <td class="cta-section">

                                <a href="{{ url('/') }}" class="cta-btn">
                                    Visit Website
                                </a>

                            </td>
                        </tr>

                        <tr>
                            <td class="email-footer">

                                <p>
                                    © {{ date('Y') }} {{ config('app.name') }}
                                </p>

                                <p>
                                    This email was sent automatically. If you did not request this email please ignore it.
                                </p>

                                <div>

                                    <a href="{{ url('/') }}">Website</a>
                                    <a href="#">Support</a>
                                    <a href="#">Privacy</a>

                                </div>

                            </td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection
