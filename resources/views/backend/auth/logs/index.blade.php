@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Authentication Logs')

@section('content')
<div class="card">

    <!-- Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Authentication Logs</h5>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>User</th>
                    <th>Event</th>
                    <th>User Agent</th>
                    {{-- <th>Device</th>
                    <th>Platform</th> --}}
                    <th>Browser</th>
                    {{-- <th>Location</th> --}}
                    <th>Status</th>
                    <th>Created</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($rows as $index => $log)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <!-- User -->
                        <td>
                            @if($log->user)
                                <strong>{{ $log->user->name }}</strong>
                            @else
                                <span class="text-muted">System</span>
                            @endif
                        </td>

                        <!-- Event -->
                        <td>{{ $log->event }}</td>

                        <!-- User Agent -->
                        <td style="max-width:300px; white-space:normal;">
                            <small class="text-muted">{{ $log->user_agent }}</small>
                        </td>

                        <!-- Device -->
                        {{-- <td>{{ $log->device ?? '—' }}</td> --}}

                        <!-- Platform -->
                        {{-- <td>{{ $log->platform ?? '—' }}</td> --}}

                        <!-- Browser -->
                        <td>{{ $log->browser ?? '—' }}</td>

                        <!-- Location -->
                        {{-- <td>{{ $log->location ?? '—' }}</td> --}}

                        <!-- Status -->
                        <td>
                            <span class="badge {{ $log->is_success ? 'bg-label-success' : 'bg-label-danger' }}">
                                {{ $log->is_success ? 'Success' : 'Failed' }}
                            </span>
                        </td>

                        <!-- Created At -->
                       <td>
    <small class="text-muted">
        {{ $log->created_at?->format('d M Y, h:i A') ?? '—' }}
    </small>
</td>

                        <!-- Actions -->
                        <td class="text-center">
                            <form action="{{ route('admin.auth.logs.destroy', $log->uuid) }}" method="POST" class="js-delete">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1">
                                    <i class="bx bx-trash"></i> Delete
                                </button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted py-4">
                            No authentication logs found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="card-footer">
        {{ $rows->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection