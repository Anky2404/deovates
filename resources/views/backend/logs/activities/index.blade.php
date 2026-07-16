@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Activity Logs')

@section('content')
    <div class="card">

        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Activity Logs</h5>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <!-- Filters -->
            <div class="card-body border-bottom">
                <form method="GET" action="{{ url()->current() }}">
                    <div class="row g-3">

                        <!-- Role -->
                        <div class="col-md-3">
                            <label class="form-label fw-bold">User</label>
                            <select name="role" class="form-select">
                                <option value="">All Users</option>

                                @foreach ($users ?? collect() as $user)
                                    <option value="{{ $user }}" {{ request('user') == $user ? 'selected' : '' }}>
                                        {{ ucfirst($user) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Module -->
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Module</label>
                            <select name="module" class="form-select">
                                <option value="">All Modules</option>

                                @foreach ($modules as $key => $module)
                                    <option value="{{ $module }}"
                                        {{ request('module') == $module ? 'selected' : '' }}>
                                        {{ $module }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Action -->
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Action</label>
                            <select name="action" class="form-select">
                                <option value="">All Actions</option>

                                @foreach ($actions ?? collect() as $action)
                                    <option value="{{ $action }}"
                                        {{ request('action') == $action ? 'selected' : '' }}>
                                        {{ ucfirst($action) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Record ID -->
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Record ID</label>
                            <select name="subject_id" class="form-select">
                                <option value="">All IDs</option>

                                @foreach ($subjectIds ?? collect() as $id)
                                    <option value="{{ $id }}"
                                        {{ request('subject_id') == $id ? 'selected' : '' }}>
                                        ID #{{ $id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="col-12 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-filter-alt"></i> Apply Filter
                            </button>

                            <a href="{{ url()->current() }}" class="btn btn-secondary">
                                <i class="bx bx-reset"></i> Reset
                            </a>
                        </div>

                    </div>
                </form>
            </div>
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>User ID</th>
                        <th>Role</th>
                        <th>Action</th>
                        <th>Module</th>
                        <th>Description</th>
                        <th>IP Address</th>
                        <th>Method</th>
                        <th>Level</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($rows as $index => $log)
                        <tr>
                            <td>
                                {{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}
                            </td>

                            <td>
                                {{ $log->user->name ?? 'N/A' }}
                            </td>

                            <td>
                                <span class="badge bg-label-info">
                                    {{ ucfirst($log->user_role ?? 'N/A') }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-label-primary">
                                    {{ ucfirst($log->action) }}
                                </span>
                            </td>

                            <td>
                                {{ $log->module ?? 'N/A' }}
                            </td>

                            <td class="description-column" title="{{ $log->description }}">
                                <span class="truncate-text">{{ \Illuminate\Support\Str::limit($log->description, 80) }}</span>
                            </td>

                            <td>
                                {{ $log->ip_address }}
                            </td>

                            <td>
                                <span class="badge bg-label-secondary">
                                    {{ $log->method }}
                                </span>
                            </td>

                            <td>
                                @php
                                    $levelClass = match ($log->level) {
                                        'info' => 'success',
                                        'warning' => 'warning',
                                        'error' => 'danger',
                                        default => 'secondary',
                                    };
                                @endphp

                                <span class="badge bg-label-{{ $levelClass }}">
                                    {{ ucfirst($log->level) }}
                                </span>
                            </td>

                            <td>
                                {{ $log->created_at?->format('d M Y h:i A') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">
                                No activity logs found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($rows->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $rows->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
@endsection
