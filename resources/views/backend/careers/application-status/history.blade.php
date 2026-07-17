@extends('backend.layouts.app')

@section('title', 'Application Status History')

@section('content')
<div class="card">

    <!-- Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Status History — {{ $application->full_name }}</h5>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.careers.applications.details', $application->uuid) }}" class="btn btn-outline-primary btn-sm">
                View Application
            </a>
            <a href="{{ route('admin.careers.application-status.index') }}" class="btn btn-secondary btn-sm">
                Back to List
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Old Status</th>
                        <th>New Status</th>
                        <th>Changed By</th>
                        <th>Remarks</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($statuses as $index => $log)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $log->old_status ? ucfirst($log->old_status) : '—' }}</td>
                            <td>{{ $log->new_status ? ucfirst($log->new_status) : '—' }}</td>
                            <td>{{ $log->changedByUser->name ?? 'System' }}</td>
                            <td>{{ $log->remarks ?? '—' }}</td>
                            <td>{{ $log->updated_at?->format('d M Y, h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">No status history found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
