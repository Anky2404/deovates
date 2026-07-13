@extends('backend.layouts.app')

@section('title', isset($rolePermission) ? 'Edit Role Permission' : 'Assign Permission')

@section('content')
    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">{{ isset($rolePermission) ? 'Edit' : 'Assign' }} Permission to Role</h5>
        </div>

        <form id="rolePermissionForm" method="POST"
            action="{{ route('admin.roles.permissions.saveorupdate', $rolePermission->uuid ?? null) }}">
            @csrf

            <div class="card-body row g-3">

                {{-- ROLE --}}
                <div class="col-md-6">
                    <label class="form-label">Select Role *</label>
                    <select name="role_id" class="form-control" required>
                        <option value="">-- choose role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ old('role_id', $rolePermission->role_id ?? '') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- PERMISSION --}}
                <div class="col-md-6">
                    <label class="form-label">Select Permission *</label>
                    <select name="permission_id" class="form-control" required>
                        <option value="">-- choose permission --</option>
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->id }}"
                                {{ old('permission_id', $rolePermission->permission_id ?? '') == $permission->id ? 'selected' : '' }}>
                                {{ $permission->name }} ({{ $permission->module }})
                            </option>
                        @endforeach
                    </select>
                </div>


                {{-- CONDITIONS (JSON) --}}
                <div class="col-md-6">
                    <label class="form-label">Conditions (JSON)</label>
                    <textarea name="conditions" id="conditions_input" class="form-control json-auto" rows="3"
                        placeholder='status:active, limit:10'>
{{ old('conditions', !empty($rolePermission->conditions) ? json_encode($rolePermission->conditions, JSON_UNESCAPED_UNICODE) : '') }}
</textarea>

                </div>

                {{-- META (JSON) --}}
                <div class="col-md-6">
                    <label class="form-label">Meta (JSON)</label>
                    <textarea name="meta" id="meta_input" class="form-control json-auto" rows="3"
                        placeholder='note:"important", color:"red"'>
{{ old('meta', !empty($rolePermission->meta) ? json_encode($rolePermission->meta, JSON_UNESCAPED_UNICODE) : '') }}
</textarea>

                </div>


                {{-- IS ALLOWED --}}
                <div class="col-md-12 mt-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_allowed" value="1"
                            {{ old('is_allowed', $rolePermission->is_allowed ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label">Allowed</label>
                    </div>
                </div>

            </div>

            <div class="card-footer text-end">
                <a href="{{ route('admin.roles.permissions.index') }}" class="btn btn-secondary">Cancel</a>
                <button class="btn btn-primary">
                    {{ isset($rolePermission) ? 'Update' : 'Assign' }}
                </button>
            </div>

        </form>

    </div>
@endsection

@push('scripts')
    <script>
        /* ==========================================================================
           jQuery Validation
        ========================================================================== */

        $(document).ready(function() {

            $("#rolePermissionForm").validate({

                rules: {
                    role_id: {
                        required: true
                    },
                    permission_id: {
                        required: true
                    },
                    display_order: {
                        number: true
                    }
                },

                messages: {
                    role_id: {
                        required: "Please select a role"
                    },
                    permission_id: {
                        required: "Please select a permission"
                    }
                },

                errorClass: "is-invalid",
                validClass: "is-valid",

                highlight: function(element) {
                    $(element).addClass("is-invalid");
                },

                unhighlight: function(element) {
                    $(element).removeClass("is-invalid").addClass("is-valid");
                }

            });

        });
    </script>
@endpush
