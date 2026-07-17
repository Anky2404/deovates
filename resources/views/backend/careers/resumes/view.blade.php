@extends('backend.layouts.app')

@section('title', 'Resume Details')

@section('content')
<div class="card">

    <!-- Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Resume Details</h5>

        <a href="{{ route('admin.careers.resumes.index') }}" class="btn btn-secondary btn-sm">
            Back to List
        </a>
    </div>

    <div class="card-body">

        <h5 class="mb-3">Candidate Information</h5>
        <div class="row g-3">
            <div class="col-md-4"><strong>Full Name:</strong><br>{{ $row->full_name }}</div>
            <div class="col-md-4"><strong>Email:</strong><br>{{ $row->email }}</div>
            <div class="col-md-4"><strong>Phone:</strong><br>{{ $row->phone ?? '—' }}</div>
            <div class="col-md-4"><strong>Location:</strong><br>{{ $row->location ?? '—' }}</div>
            <div class="col-md-4"><strong>Current Role:</strong><br>{{ $row->current_role ?? '—' }}</div>
            <div class="col-md-4"><strong>Current Company:</strong><br>{{ $row->current_company ?? '—' }}</div>
            <div class="col-md-4"><strong>Experience:</strong><br>{{ $row->experience_years ? $row->experience_years . ' yrs' : '—' }}</div>
            <div class="col-md-4"><strong>Expected Salary:</strong><br>{{ $row->expected_salary ? number_format($row->expected_salary) : '—' }}</div>
            <div class="col-md-4"><strong>Notice Period:</strong><br>{{ $row->notice_period ?? '—' }} days</div>
            <div class="col-md-4"><strong>Source:</strong><br>{{ $row->source ? ucfirst($row->source) : '—' }}</div>
            <div class="col-md-4"><strong>Status:</strong><br>{{ $row->status ? ucfirst($row->status) : '—' }}</div>
        </div>

        <hr>

        <h5 class="mb-3">Links</h5>
        <div class="row g-3">
            <div class="col-md-4">
                <strong>Portfolio:</strong><br>
                @if($row->portfolio_url)
                    <a href="{{ $row->portfolio_url }}" target="_blank">{{ $row->portfolio_url }}</a>
                @else — @endif
            </div>
            <div class="col-md-4">
                <strong>LinkedIn:</strong><br>
                @if($row->linkedin_url)
                    <a href="{{ $row->linkedin_url }}" target="_blank">{{ $row->linkedin_url }}</a>
                @else — @endif
            </div>
            <div class="col-md-4">
                <strong>GitHub:</strong><br>
                @if($row->github_url)
                    <a href="{{ $row->github_url }}" target="_blank">{{ $row->github_url }}</a>
                @else — @endif
            </div>
        </div>

        @if(!empty($row->skills))
            <hr>
            <h5 class="mb-3">Skills</h5>
            <div class="d-flex flex-wrap gap-2">
                @foreach($row->skills as $skill)
                    <span class="badge bg-label-primary">{{ ucfirst($skill) }}</span>
                @endforeach
            </div>
        @endif

        @if($row->resume_file)
            <hr>
            <h5 class="mb-3">Resume File</h5>
            <a href="{{ asset('storage/' . $row->resume_file) }}" target="_blank" class="btn btn-sm btn-primary">
                <i class="bx bx-download"></i> Download Resume
            </a>
        @endif

        <hr>

        <h5 class="mb-3">Applications</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Job Opening</th>
                        <th>Status</th>
                        <th>Applied At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($row->applications as $index => $application)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $application->career->title ?? '—' }}</td>
                            <td>{{ ucfirst($application->status) }}</td>
                            <td>{{ $application->applied_at?->format('d M Y, h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">No applications found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
