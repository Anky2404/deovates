@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Job Batches')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header">
        <h5 class="mb-0">Job Batches</h5>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Total Jobs</th>
                    <th>Pending Jobs</th>
                    <th>Failed Jobs</th>
                    <th>Created At</th>
                    <th>Finished At</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $batch)
                    <tr>
                        <!-- SN -->
                        <td>{{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}</td>

                        <!-- ID -->
                        <td>
                            <span class="text-muted">{{ $batch->id }}</span>
                        </td>

                        <!-- Name -->
                        <td>
                            <strong>{{ $batch->name }}</strong>
                        </td>

                        <!-- Total Jobs -->
                        <td>{{ $batch->total_jobs }}</td>

                        <!-- Pending Jobs -->
                        <td>
                            <span class="badge bg-label-{{ $batch->pending_jobs > 0 ? 'warning' : 'success' }}">
                                {{ $batch->pending_jobs }}
                            </span>
                        </td>

                        <!-- Failed Jobs -->
                        <td>
                            <span class="badge bg-label-{{ $batch->failed_jobs > 0 ? 'danger' : 'success' }}">
                                {{ $batch->failed_jobs }}
                            </span>
                        </td>

                        <!-- Created At -->
                        <td>
                            {{ $batch->created_at ? \Carbon\Carbon::createFromTimestamp($batch->created_at)->format('d M Y, h:i A') : '—' }}
                        </td>

                        <!-- Finished At -->
                        <td>
                            {{ $batch->finished_at ? \Carbon\Carbon::createFromTimestamp($batch->finished_at)->format('d M Y, h:i A') : '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            No job batches found.
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
