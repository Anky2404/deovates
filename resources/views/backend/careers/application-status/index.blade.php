@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Application Status Logs')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Application Status Logs</h5>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>Applicant</th>
                    <th>Old Status</th>
                    <th>New Status</th>
                    <th>Changed By</th>
                    <th>Remarks</th>
                    <th>Updated At</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $log)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $log->application->full_name ?? '—' }}</td>
                        <td>{{ $log->old_status ? ucfirst($log->old_status) : '—' }}</td>
                        <td>{{ $log->new_status ? ucfirst($log->new_status) : '—' }}</td>
                        <td>{{ $log->changedByUser->name ?? 'System' }}</td>
                        <td>{{ $log->remarks ?? '—' }}</td>
                        <td>{{ $log->updated_at?->format('d M Y, h:i A') }}</td>
                        <td class="text-center">
                            @if($log->application)
                                <a href="{{ route('admin.careers.application-status.history', $log->application->uuid) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1 justify-content-center">
                                    <i class="bx bx-history"></i> History
                                </a>
                            @else
                                —
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            No status logs found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        {{ $rows->links() }}
    </div>

</div>
@endsection
