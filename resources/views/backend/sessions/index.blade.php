@extends('backend.layouts.app')

@section('title', 'Sessions')

@section('content')
<div class="card">

    <!-- Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Session List</h5>

        <a href="{{ route('admin.sessions.createoredit') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Create Session
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>User ID</th>
                    <th>IP Address</th>
                    <th>User Agent</th>
                    <th>Last Activity</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $session)
                    <tr>

                        <!-- SN -->
                        <td>{{ $index + 1 }}</td>

                        <!-- User ID -->
                        <td>{{ $session->user_id ?? '—' }}</td>

                        <!-- IP -->
                        <td>{{ $session->ip_address ?? '—' }}</td>

                        <!-- User Agent -->
                        <td style="max-width:250px; white-space:normal;">
                            {{ \Illuminate\Support\Str::limit($session->user_agent, 50) }}
                        </td>

                        <!-- Last Activity -->
                        <td>
                            {{ $session->last_activity
                                ? \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans()
                                : '—' }}
                        </td>

                        {{-- Status --}}
                        <td>
                            @php
                                $isActive = $session->last_activity >= now()->subMinutes(config('session.lifetime'))->timestamp;
                            @endphp

                            <span
                                class="badge toggle-status cursor-pointer bg-label-{{ $isActive ? 'success' : 'danger' }}"
                                data-url="{{ route('admin.sessions.togglestatus', $session->id) }}">
                                {{ $isActive ? 'Active' : 'Expired' }}
                            </span>
                        </td>

                        <!-- Action Buttons -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.sessions.createoredit', $session->id) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>

                                <form action="{{ route('admin.sessions.destroy', $session->id) }}"
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
                            No sessions found.
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
