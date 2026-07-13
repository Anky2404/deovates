@extends('backend.layouts.app')

@section('title', isset($smtpSetting) ? 'Edit SMTP Setting' : 'Create SMTP Setting')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">{{ isset($smtpSetting) ? 'Edit' : 'Create' }} SMTP Setting</h5>
    </div>

    <form method="POST"
          action="{{ route('admin.settings.smtp.saveorupdate', $smtpSetting->uuid ?? null) }}">
        @csrf

        <div class="card-body row g-3">

            {{-- NAME --}}
            <div class="col-md-4">
                <label class="form-label">Name *</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $smtpSetting->name ?? '') }}"
                       required>
            </div>

            {{-- DRIVER --}}
            <div class="col-md-4">
                <label class="form-label">Driver *</label>
                <input type="text"
                       name="driver"
                       class="form-control"
                       placeholder="smtp"
                       value="{{ old('driver', $smtpSetting->driver ?? 'smtp') }}"
                       required>
            </div>

            {{-- ENCRYPTION --}}
            <div class="col-md-4">
                <label class="form-label">Encryption</label>
                <input type="text"
                       name="encryption"
                       class="form-control"
                       placeholder="tls / ssl"
                       value="{{ old('encryption', $smtpSetting->encryption ?? '') }}">
            </div>

            {{-- HOST --}}
            <div class="col-md-6">
                <label class="form-label">Host *</label>
                <input type="text"
                       name="host"
                       class="form-control"
                       value="{{ old('host', $smtpSetting->host ?? '') }}"
                       required>
            </div>

            {{-- PORT --}}
            <div class="col-md-6">
                <label class="form-label">Port *</label>
                <input type="number"
                       name="port"
                       class="form-control"
                       value="{{ old('port', $smtpSetting->port ?? 587) }}"
                       required>
            </div>

            {{-- USERNAME --}}
            <div class="col-md-6">
                <label class="form-label">Username</label>
                <input type="text"
                       name="username"
                       class="form-control"
                       value="{{ old('username', $smtpSetting->username ?? '') }}">
            </div>

            {{-- PASSWORD --}}
            <div class="col-md-6">
                <label class="form-label">Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       autocomplete="new-password"
                       placeholder="{{ isset($smtpSetting) ? 'Leave blank to keep current password' : '' }}"
                       value="">
            </div>

            {{-- FROM EMAIL --}}
            <div class="col-md-6">
                <label class="form-label">From Email *</label>
                <input type="email"
                       name="from_email"
                       class="form-control"
                       value="{{ old('from_email', $smtpSetting->from_email ?? '') }}"
                       required>
            </div>

            {{-- FROM NAME --}}
            <div class="col-md-6">
                <label class="form-label">From Name *</label>
                <input type="text"
                       name="from_name"
                       class="form-control"
                       value="{{ old('from_name', $smtpSetting->from_name ?? '') }}"
                       required>
            </div>

            {{-- SWITCHES --}}
            <div class="col-md-6">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_default"
                           value="1"
                           {{ old('is_default', $smtpSetting->is_default ?? 0) ? 'checked' : '' }}>
                    <label class="form-check-label">Default</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $smtpSetting->is_active ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.settings.smtp.index') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">
                {{ isset($smtpSetting) ? 'Update' : 'Create' }}
            </button>
        </div>

    </form>
</div>
@endsection
