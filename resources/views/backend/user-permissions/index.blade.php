@extends('backend.layouts.app')

@section('title', 'User Permissions')
@section('content')

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">User Permissions</h5>
    </div>

    <div class="card-body">
        <form method="GET" action="{{ route('admin.user-permissions.index') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label class="form-label">Select User</label>
                    <select name="user_id" id="user_id" class="form-control select2" onchange="this.form.submit()">
                        <option value="">-- choose a user --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ optional($selectedUser)->id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>

@if ($selectedUser)
    <form method="POST" action="{{ route('admin.user-permissions.update') }}">
        @csrf
        <input type="hidden" name="user_id" value="{{ $selectedUser->id }}">

        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0">{{ $selectedUser->name }}</h6>
                    <small class="text-muted">{{ $selectedUser->email }} &middot; Role: {{ $selectedUser->role?->name ?? 'N/A' }}</small>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save me-1"></i> Save Permissions
                </button>
            </div>
        </div>

        @forelse ($permissions->groupBy('module') as $module => $modulePermissions)
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">{{ config('constants.MODULES.' . $module, $module ?: 'Uncategorized') }}</h6>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input module-toggle-all" data-module="{{ $module }}">
                        <label class="form-check-label small text-muted">Select all</label>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        @foreach ($modulePermissions as $permission)
                            <div class="col-md-4 col-sm-6">
                                <div class="form-check">
                                    <input type="checkbox"
                                        class="form-check-input permission-checkbox module-{{ $module }}"
                                        name="permission_ids[]"
                                        value="{{ $permission->id }}"
                                        id="perm_{{ $permission->id }}"
                                        {{ in_array($permission->id, $userPermissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-body text-center text-muted py-4">
                    No active permissions have been defined yet.
                </div>
            </div>
        @endforelse

        <div class="text-end mb-4">
            <button type="submit" class="btn btn-primary">
                <i class="bx bx-save me-1"></i> Save Permissions
            </button>
        </div>
    </form>
@else
    <div class="card">
        <div class="card-body text-center text-muted py-5">
            <i class="bx bx-user-check" style="font-size: 2rem;"></i>
            <p class="mt-2 mb-0">Select a user above to view and manage their individual permissions.</p>
        </div>
    </div>
@endif

@endsection

@push('scripts')
<script>
$(function () {
    $('.select2').select2({ width: '100%' });

    $('.module-toggle-all').on('change', function () {
        const module = $(this).data('module');
        $('.module-' + module).prop('checked', $(this).is(':checked'));
    });

    // Keep each module's "select all" checkbox in sync if permissions are toggled individually.
    $('.permission-checkbox').on('change', function () {
        const classes = $(this).attr('class').split(/\s+/).filter(c => c.startsWith('module-'));
        if (!classes.length) return;
        const moduleClass = classes[0];
        const all = $('.' + moduleClass).length;
        const checked = $('.' + moduleClass + ':checked').length;
        $('.module-toggle-all[data-module="' + moduleClass.replace('module-', '') + '"]').prop('checked', all === checked);
    });
});
</script>
@endpush
