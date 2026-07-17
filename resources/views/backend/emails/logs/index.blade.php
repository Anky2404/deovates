@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Email Logs')

@section('content')
<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Email Logs</h5>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>To</th>
                    <th>Subject</th>
                    <th>Template</th>
                    <th>Status</th>
                    <th>Sent At</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($rows as $index => $log)
                    <tr>
                        <td>{{ $rows->firstItem() + $index }}</td>

                        <td>
                            <strong>{{ $log->to_name ?? '—' }}</strong>
                            <div class="small text-muted">{{ $log->to_email }}</div>
                        </td>

                        <td>{{ $log->subject }}</td>

                        <td>
                            @if ($log->template)
                                <span class="badge bg-label-info">{{ $log->template->name }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        <td>
                            <span class="badge bg-label-{{ $log->status == 'sent' ? 'success' : ($log->status == 'failed' ? 'danger' : 'warning') }}">
                                {{ ucfirst($log->status) }}
                            </span>
                        </td>

                        <td>{{ $log->sent_at ? $log->sent_at->format('d M Y H:i') : '—' }}</td>

                        <td class="text-center">
                            <a href="{{ route('admin.emails.logs.view', $log->uuid) }}"
                               class="btn btn-sm btn-outline-info d-flex align-items-center gap-1 d-inline-flex">
                                <i class="bx bx-show"></i> View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            No email logs found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($rows->hasPages())
        <div class="card-footer d-flex justify-content-end">
            {{ $rows->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>
@endsection
