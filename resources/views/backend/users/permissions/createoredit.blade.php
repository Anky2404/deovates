@extends('backend.layouts.app')

@section('title', isset($record) ? 'Edit User Permission' : 'Assign Permission to User')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">{{ isset($record) ? 'Edit' : 'Assign' }} Permission to User</h5>
    </div>

    <form id="userPermissionForm" method="POST"
          action="{{ route('admin.users.permissions.saveorupdate', $record->uuid ?? null) }}">
        @csrf

        <div class="card-body row g-3">

            {{-- USER --}}
            <div class="col-md-4">
                <label class="form-label">Select User *</label>
                <select name="user_id" class="form-control" required>
                    <option value="">-- choose user --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            {{ old('user_id', $record->user_id ?? '') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- PERMISSION --}}
            <div class="col-md-4">
                <label class="form-label">Select Permission *</label>
                <select name="permission_id" class="form-control" required>
                    <option value="">-- choose permission --</option>
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}"
                            {{ old('permission_id', $record->permission_id ?? '') == $permission->id ? 'selected' : '' }}>
                            {{ $permission->name }} ({{ $permission->module }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- EXPIRES AT --}}
            <div class="col-md-4">
                <label class="form-label">Expires At</label>
                <input type="date"
                       name="expires_at"
                       class="form-control"
                       value="{{ old('expires_at', isset($record->expires_at) ? $record->expires_at->format('Y-m-d') : '') }}">
            </div>

            {{-- GRANTED BY --}}
            {{-- <div class="col-md-4">
                <label class="form-label">Granted By *</label>
                <select name="granted_by" class="form-control" required>
                    <option value="">-- choose user --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            {{ old('granted_by', $record->granted_by ?? auth()->id()) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div> --}}

            {{-- CONDITIONS (JSON) --}}
            <div class="col-md-6">
                <label class="form-label">Conditions (JSON)</label>
                <textarea name="conditions"
                          id="conditions_input"
                          class="form-control json-auto"
                          rows="3"
                          placeholder='status:active, limit:10'>{{ old('conditions', !empty($record->conditions) ? json_encode($record->conditions, JSON_UNESCAPED_UNICODE) : '') }}</textarea>
            </div>

            {{-- META (JSON) --}}
            <div class="col-md-6">
                <label class="form-label">Meta (JSON)</label>
                <textarea name="meta"
                          id="meta_input"
                          class="form-control json-auto"
                          rows="3"
                          placeholder='note:"important", color:"red"'>{{ old('meta', !empty($record->meta) ? json_encode($record->meta, JSON_UNESCAPED_UNICODE) : '') }}</textarea>
            </div>

            {{-- IS ALLOWED --}}
            <div class="col-md-12 mt-3">
                <div class="form-check form-switch">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_allowed"
                           value="1"
                           {{ old('is_allowed', $record->is_allowed ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Allowed</label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.users.permissions.index') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">
                {{ isset($record) ? 'Update' : 'Assign' }}
            </button>
        </div>

    </form>

</div>
@endsection

@push('scripts')

{{-- jQuery Validate --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-bZQKpAZbZlyDdc0AGJi/7luWGINuD/7++UZ5EKeosFVJeFt3PcTJS3BM4tiTqcKoy0eZZ+j9zBbTKp8yK7qtTQ=="
        crossorigin="anonymous"></script>

<script>

    /* ==========================================================================
       jQuery Validation
    ========================================================================== */
    $(document).ready(function () {

        $("#userPermissionForm").validate({

            rules: {
                user_id: { required: true },
                permission_id: { required: true },
                // granted_by: { required: true },
                expires_at: { date: true }
            },

            messages: {
                user_id: { required: "Please select a user" },
                permission_id: { required: "Please select a permission" },
                // granted_by: { required: "Please select who granted this permission" }
            },

            errorClass: "is-invalid",
            validClass: "is-valid",

            highlight: function (element) {
                $(element).addClass("is-invalid");
            },

            unhighlight: function (element) {
                $(element).removeClass("is-invalid").addClass("is-valid");
            }

        });

    });

</script>

@endpush
