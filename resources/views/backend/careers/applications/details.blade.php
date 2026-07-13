@extends('backend.layouts.app')

@section('title', 'Career Application Details')

@section('content')
    <div class="card">

        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Application Details</h5>

            <a href="{{ route('admin.careers.applications.index') }}" class="btn btn-secondary btn-sm">
                Back to List
            </a>
        </div>

        <!-- Body -->
        <div class="card-body">

            <!-- Applicant Info -->
            <h5 class="mb-3">Applicant Information</h5>
            <div class="row g-3">

                <div class="col-md-4"><strong>UUID:</strong><br>{{ $application->uuid }}</div>
                <div class="col-md-4"><strong>Full Name:</strong><br>{{ $application->full_name }}</div>
                <div class="col-md-4"><strong>Email:</strong><br>{{ $application->email }}</div>
                <div class="col-md-4"><strong>Phone:</strong><br>{{ $application->phone }}</div>
                <div class="col-md-4"><strong>Career:</strong><br>{{ $application->career->title ?? '—' }}</div>
                <div class="col-md-4"><strong>Department:</strong><br>{{ $application->department->name ?? '—' }}</div>
                <div class="col-md-4"><strong>Status:</strong><br>@php
    $currentStatus = $application->statusLogs->isEmpty()
        ? $application->status
        : $application->statusLogs->last()->new_status;
@endphp

<span class="badge {{ statusBadgeColor($currentStatus) }}">
    {{ ucfirst($currentStatus) }}
</span></div>
                <div class="col-md-4"><strong>Source:</strong><br>{{ ucfirst($application->source) ?? '—' }}</div>
                <div class="col-md-4"><strong>Applied
                        At:</strong><br>{{ $application->applied_at?->format('d M Y, h:i A') }}</div>

            </div>

            <hr>

            <!-- CTC Info -->
            <h5 class="mb-3">Compensation Details</h5>
            <div class="row g-3">

                <div class="col-md-4"><strong>Current Company:</strong><br>{{ $application->current_company ?? '—' }}</div>
                <div class="col-md-4"><strong>Current
                        CTC:</strong><br>{{ $application->current_ctc ? number_format($application->current_ctc) : '—' }}
                </div>
                <div class="col-md-4"><strong>Expected
                        CTC:</strong><br>{{ $application->expected_ctc ? number_format($application->expected_ctc) : '—' }}
                </div>
                <div class="col-md-4"><strong>Notice Period:</strong><br>{{ $application->notice_period ?? '—' }} days
                </div>

            </div>

            <hr>

            <!-- Cover Letter -->
            <h5 class="mb-3">Cover Letter</h5>
            <p>{{ $application->cover_letter ?? '—' }}</p>

            <!-- Portfolio -->
            <h5 class="mt-4">Portfolio URL</h5>
            <p>
                @if ($application->portfolio_url)
                    <a href="{{ $application->portfolio_url }}" target="_blank">{{ $application->portfolio_url }}</a>
                @else
                    —
                @endif
            </p>

            <hr>

            <!-- Admin Notes -->
            <h5 class="mb-3">Admin Notes</h5>
            <p>{{ $application->admin_notes ?? '—' }}</p>

            <hr>

            <!-- Technical Info -->
            <h5 class="mb-3">Technical Details</h5>
            <div class="row g-3">
                <div class="col-md-4"><strong>IP Address:</strong><br>{{ $application->ip_address ?? '—' }}</div>
                <div class="col-md-8"><strong>User Agent:</strong><br>{{ $application->user_agent ?? '—' }}</div>
            </div>

            <hr>

            <!-- Resume -->
            <h5 class="mb-3">Resume</h5>
            @if ($application->resume && $application->resume->file_path)
                <a href="{{ route('admin.careers.applications.downloadresume', $application->uuid) }}"
                    class="btn btn-sm btn-primary">Download Resume</a>
            @else
                <p>Resume not available.</p>
            @endif

            <hr>

            <!-- Status Logs -->
            <h5 class="mt-4">Application Status Logs</h5>

            <div class="table-responsive mt-3">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Old Status</th>
                            <th>New Status</th>
                            <th>Changed By</th>
                            <th>Remarks</th>
                            <th>Updated At</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
    function statusBadgeColor($status) {
        return match(strtolower($status)) {
            'new'         => 'bg-secondary',
            'shortlisted' => 'bg-info',
            'interview'   => 'bg-primary',
            'offered'     => 'bg-warning',
            'hired'       => 'bg-success',
            'rejected'    => 'bg-danger',
            default       => 'bg-dark',
        };
    }
@endphp

                        @forelse($application->statusLogs as $index => $log)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                               <td>
    @if($log->old_status)
        <span class="badge {{ statusBadgeColor($log->old_status) }}">
            {{ ucfirst($log->old_status) }}
        </span>
    @else
        —
    @endif
</td>

<td>
    @if($log->new_status)
        <span class="badge {{ statusBadgeColor($log->new_status) }}">
            {{ ucfirst($log->new_status) }}
        </span>
    @else
        —
    @endif
</td>
                                <td>{{ $log->changedByUser->name ?? 'System' }}</td>
                                <td>{{ $log->remarks ?? '—' }}</td>
                                <td>{{ $log->updated_at?->format('d M Y, h:i A') }}</td>

                                <td class="text-center">
    @php
        $currentStatus = strtolower($log->new_status);
        $blockedStatuses = ['hired', 'rejected'];
    @endphp

    @if ($loop->last)
        @if (!in_array($currentStatus, $blockedStatuses))
            <button class="btn btn-sm btn-primary js-update-status"
                data-url="{{ route('admin.careers.applications.update-status', ['uuid'=>$application->uuid]) }}"
                data-current="{{ $log->new_status }}">
                Update Status
            </button>

            <button class="btn btn-sm btn-danger js-reject-status"
                data-url="{{ route('admin.careers.applications.update-status', ['uuid'=>$application->uuid]) }}">
                Reject
            </button>
        @else
            —
        @endif
    @else
        —
    @endif
</td>
                              
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-3">No status logs found.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <!-- UPDATE STATUS MODAL -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="updateStatusForm" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <label class="form-label">Next Status</label>
                        <select name="new_status" id="nextStatusDropdown" class="form-select" required></select>

                        <label class="form-label mt-3">Remarks</label>
                        <textarea name="remarks" class="form-control" rows="3"></textarea>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <!-- REJECT MODAL -->
    <div class="modal fade" id="rejectStatusModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="rejectStatusForm" method="POST">
                @csrf
                <input type="hidden" name="new_status" value="rejected">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reject Application</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" class="form-control" rows="3" required></textarea>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </div>

                </div>
            </form>
        </div>
    </div>


@endsection


@push('scripts')
    <script>
       const statusFlow = {
    'new': 'shortlisted',
    'shortlisted': 'interview',
    'interview': 'offered',
    'offered': 'hired',
    'hired': null
};

document.addEventListener('click', function (e) {

    // --------------------------
    // UPDATE STATUS BUTTON
    // --------------------------
    if (e.target.classList.contains('js-update-status')) {

        let current = e.target.getAttribute('data-current');
        let url = e.target.getAttribute('data-url');
        let dropdown = document.getElementById('nextStatusDropdown');

        dropdown.innerHTML = "";

        // Add only the next status
        if (statusFlow[current]) {
            dropdown.innerHTML += `<option value="${statusFlow[current]}">${statusFlow[current].toUpperCase()}</option>`;
        }

        // Set POST action
        let form = document.getElementById('updateStatusForm');
        form.method = "POST";
        form.action = url;

        new bootstrap.Modal(document.getElementById('updateStatusModal')).show();
    }

    // --------------------------
    // REJECT STATUS BUTTON
    // --------------------------
    if (e.target.classList.contains('js-reject-status')) {

        let url = e.target.getAttribute('data-url');

        let form = document.getElementById('rejectStatusForm');
        form.method = "POST";
        form.action = url;

        new bootstrap.Modal(document.getElementById('rejectStatusModal')).show();
    }

});
    </script>
@endpush
