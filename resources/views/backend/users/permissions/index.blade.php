@extends('backend.layouts.app')

@section('title', 'User Permissions')
@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">User Permission List</h5>

        <a href="{{ route('admin.users.permissions.createoredit') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i>
            Assign Permission to User
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th width="60">SN</th>
                    <th width="180">User</th>
                    <th width="180">Permission</th>
                    {{-- <th width="120">Module</th>
                    <th width="120">Group</th> --}}
                    <th width="120">Action</th>
                    <th width="120">Expires At</th>
                    <th width="100">Allowed</th>
                    <th width="200" class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $up)
                    <tr>

                        <!-- SN -->
                        <td>
                            {{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}
                        </td>

                        <!-- User -->
                        <td>
                            <span class="badge bg-label-primary">
                                {{ $up->user->name ?? 'N/A' }}
                            </span>
                            <br>
                            <small class="text-muted">{{ $up->user->email ?? '' }}</small>
                        </td>

                        <!-- Permission -->
                        <td>
                            <strong>{{ $up->permission->name ?? 'N/A' }}</strong>
                        </td>

                        <!-- Module -->
                        {{-- <td>
                            <span class="badge bg-label-info">
                                {{ $up->permission->module ?? 'N/A' }}
                            </span>
                        </td> --}}

                        <!-- Group -->
                        {{-- <td>
                            <span class="badge bg-label-warning">
                                {{ $up->permission->group ?? 'N/A' }}
                            </span>
                        </td> --}}
                         <!-- Action -->
                            <td>
                                @php
                                    $actions = array_flip(config('constants.actions'));
                                    $selectedActions = $up->permission->action ? explode(',', $up->permission->action) : [];
                                @endphp

                                @if (!empty($selectedActions))
                                    @foreach ($selectedActions as $act)
                                        <span class="badge bg-label-primary me-1">
                                            {{ ucfirst(str_replace('_', ' ', $actions[$act] ?? $act)) }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="badge bg-label-secondary">N/A</span>
                                @endif
                            </td>


                        <!-- Expires At -->
                        <td>
                            @if($up->expires_at)
                                <span class="badge bg-label-danger">
                                    {{ $up->expires_at->format('d M Y') }}
                                </span>
                            @else
                                <span class="badge bg-label-success">No Expiry</span>
                            @endif
                        </td>

                          <!-- Allowed -->
                                <td>
                                    <span
                                        class="badge toggle-status cursor-pointer bg-label-{{ $up->is_allowed ? 'success' : 'danger' }}"
                                        data-url="{{ route('admin.users.permissions.togglestatus', $up->uuid) }}"
                                        data-type="allow">
                                        {{ $up->is_allowed ? 'Yes' : 'No' }}

                                    </span>
                                </td>




                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <!-- Edit -->
                                <a href="{{ route('admin.users.permissions.createoredit', $up->uuid) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('admin.users.permissions.destroy', $up->uuid) }}"
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
                        <td colspan="9" class="text-center text-muted py-4">
                            No user permissions found.
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
