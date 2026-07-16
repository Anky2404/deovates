@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Failed Jobs')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header">
        <h5 class="mb-0">Failed Jobs</h5>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>ID</th>
                    <th>Queue</th>
                    <th>Connection</th>
                    <th>Exception</th>
                    <th>Failed At</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $failedJob)
                    <tr>
                        <!-- SN -->
                        <td>{{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}</td>

                        <!-- ID -->
                        <td>
                            <span class="text-muted">{{ $failedJob->id }}</span>
                        </td>

                        <!-- Queue -->
                        <td>
                            <span class="badge bg-label-info">{{ $failedJob->queue }}</span>
                        </td>

                        <!-- Connection -->
                        <td>{{ $failedJob->connection }}</td>

                        <!-- Exception -->
                        <td class="description-column" title="{{ $failedJob->exception }}">
                            <span class="truncate-text">{{ \Illuminate\Support\Str::limit(strip_tags($failedJob->exception), 80) }}</span>
                        </td>

                        <!-- Failed At -->
                        <td>
                            {{ $failedJob->failed_at ? \Illuminate\Support\Carbon::parse($failedJob->failed_at)->format('d M Y, h:i A') : '—' }}
                        </td>

                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <form action="{{ route('admin.settings.jobs.failed.retry', $failedJob->id) }}"
                                      method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                        <i class="bx bx-refresh"></i> Retry
                                    </button>
                                </form>

                                <form action="{{ route('admin.settings.jobs.failed.destroy', $failedJob->id) }}"
                                      method="POST" class="js-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1">
                                        <i class="bx bx-trash"></i> Delete
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            No failed jobs found.
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
