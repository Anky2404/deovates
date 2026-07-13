@extends('backend.layouts.app')

@section('title', 'Deovate World | System Logs')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">System Log Lists</h5>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>Action</th>
                    <th>Module</th>
                    <th>Level</th>
                    <th>User</th>
                    <th>IP Address</th>
                    <th>Created At</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $row)
                    <tr>
                        <!-- SN -->
                        <td>{{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}</td>

                        <!-- Action -->
                        <td>
                            <span class="badge bg-label-primary">{{ ucfirst($row->action ?? 'N/A') }}</span>
                        </td>

                        <!-- Module -->
                        <td>{{ $row->module ?? '—' }}</td>

                        <!-- Level -->
                        <td>
                            @php
                                $levelClass = match ($row->level) {
                                    'error' => 'danger',
                                    'warning' => 'warning',
                                    'info' => 'info',
                                    default => 'secondary',
                                };
                            @endphp
                            <span class="badge bg-label-{{ $levelClass }}">{{ ucfirst($row->level ?? 'N/A') }}</span>
                        </td>

                        <!-- User -->
                        <td>{{ $row->user->name ?? 'N/A' }}</td>

                        <!-- IP -->
                        <td>{{ $row->ip_address ?? '—' }}</td>

                        <!-- Created At -->
                        <td>{{ $row->created_at?->format('d M Y h:i A') }}</td>

                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.system-logs.view', $row->uuid) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-show"></i> View
                                </a>

                                <form action="{{ route('admin.system-logs.destroy', $row->uuid) }}"
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
                        <td colspan="8" class="text-center text-muted py-4">
                            No system logs found.
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
