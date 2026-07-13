@extends('backend.layouts.app')

@section('title', 'Deovate World | Queued Jobs')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header">
        <h5 class="mb-0">Queued Jobs</h5>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>ID</th>
                    <th>Queue</th>
                    <th>Attempts</th>
                    <th>Created At</th>
                    <th>Available At</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $job)
                    <tr>
                        <!-- SN -->
                        <td>{{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}</td>

                        <!-- ID -->
                        <td>{{ $job->id }}</td>

                        <!-- Queue -->
                        <td>
                            <span class="badge bg-label-info">{{ $job->queue }}</span>
                        </td>

                        <!-- Attempts -->
                        <td>{{ $job->attempts }}</td>

                        <!-- Created At -->
                        <td>
                            {{ $job->created_at ? \Carbon\Carbon::createFromTimestamp($job->created_at)->format('d M Y, h:i A') : '—' }}
                        </td>

                        <!-- Available At -->
                        <td>
                            {{ $job->available_at ? \Carbon\Carbon::createFromTimestamp($job->available_at)->format('d M Y, h:i A') : '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No queued jobs found.
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
