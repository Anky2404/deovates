@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Notifications')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Notification Lists</h5>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>Title</th>
                    <th>Message</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Created At</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $row)
                    <tr>
                        <!-- SN -->
                        <td>{{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}</td>

                        <!-- Title -->
                        <td>
                            <strong>{{ $row->title }}</strong>
                            @if($row->type)
                                <span class="badge bg-label-secondary ms-1">{{ $row->type }}</span>
                            @endif
                        </td>

                        <!-- Message -->
                        <td style="max-width:300px;">
                            <span class="text-muted">{{ \Illuminate\Support\Str::limit($row->message, 80) }}</span>
                        </td>

                        <!-- User -->
                        <td>
                            {{ $row->user->name ?? 'N/A' }}
                        </td>

                        <!-- Status -->
                        <td>
                            @if($row->is_read)
                                <span class="badge bg-label-success">Read</span>
                            @else
                                <form action="{{ route('admin.notifications.markAsRead', $row->uuid) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="badge bg-label-danger border-0 cursor-pointer">
                                        Unread
                                    </button>
                                </form>
                            @endif
                        </td>

                        <!-- Priority -->
                        <td>
                            {{ $row->priority ?? 0 }}
                        </td>

                        <!-- Created At -->
                        <td>
                            {{ $row->created_at?->format('d M Y h:i A') }}
                        </td>

                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <form action="{{ route('admin.notifications.destroy', $row->uuid) }}"
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
                            No notifications found.
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
