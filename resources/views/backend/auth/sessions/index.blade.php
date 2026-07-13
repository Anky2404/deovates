@extends('backend.layouts.app')

@section('title', 'Deovate | Active Sessions')

@section('content')
<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Active Sessions</h5>

        <form action="#" method="POST" class="js-delete">
            @csrf
            <button class="btn btn-danger btn-sm">
                <i class="bx bx-trash"></i> Clear All Sessions
            </button>
        </form>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
            <tr>
                <th>SN</th>
                <th>User</th>
                <th>IP</th>
                <th>User Agent</th>
                <th>Device</th>
                <th>Platform</th>
                <th>Browser</th>
                <th>Last Activity</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>

            <tbody>
            @forelse ($rows as $index => $session)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    <td>
                        @if($session->user)
                            <strong>{{ $session->user->name }}</strong>
                        @else
                            <span class="text-muted">Guest</span>
                        @endif
                    </td>

                    <td>{{ $session->ip_address ?? '—' }}</td>

                    <td style="max-width:300px; white-space:normal;">
                        <small class="text-muted">{{ $session->user_agent ?? '—' }}</small>
                    </td>

                    <td>{{ $session->device ?? '—' }}</td>

                    <td>{{ $session->platform ?? '—' }}</td>

                    <td>{{ $session->browser ?? '—' }}</td>

                    <td>
                        <small class="text-muted">
                            {{ $session->lastActivityAt?->format('d M Y, h:i A') ?? '—' }}
                        </small>
                    </td>

                    <td class="text-center">
                        <form action="{{ route('admin.sessions.destroy', $session->id) }}"
                              method="POST" class="js-delete">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1">
                                <i class="bx bx-trash"></i> Logout
                            </button>
                        </form>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-muted py-4">
                        No active sessions found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection