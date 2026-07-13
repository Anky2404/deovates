@extends('backend.layouts.app')

@section('title', 'Role Permissions')
@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Role Permission List</h5>

        <a href="{{ route('admin.roles.permissions.createoredit') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i>
            Assign Permission to Role
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th width="60">SN</th>
                    <th width="180">Role</th>
                    <th width="180">Permission</th>
                    <th width="120">Module</th>
                    <th width="120">Group</th>
                    <th width="120">Action</th>
                    {{-- <th width="200">Conditions</th> --}}
                    <th width="100">Allowed</th>
                    <th width="200" class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $rp)
                    <tr>
                        <!-- SN -->
                        <td>
                            {{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}
                        </td>

                        <!-- Role -->
                        <td>
                            <span class="badge bg-label-primary">
                                {{ $rp->role->name ?? 'N/A' }}
                            </span>
                        </td>

                        <!-- Permission -->
                        <td>
                            <strong>{{ $rp->permission->name ?? 'N/A' }}</strong>
                        </td>

                        <!-- Module -->
                        <td>
                            <span class="badge bg-label-info">
                                {{ $rp->permission->module ?? 'N/A' }}
                            </span>
                        </td>

                        <!-- Group -->
                        <td>
                            <span class="badge bg-label-warning">
                                {{ $rp->permission->group ?? 'N/A' }}
                            </span>
                        </td>


                          <!-- Action -->
                            <td>
                                @php
                                    $actions = array_flip(config('constants.actions'));
                                    $selectedActions = $rp->permission->action ? explode(',', $rp->permission->action) : [];
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

                        <!-- Conditions -->
                        {{-- <td title="{{ json_encode($rp->conditions) }}">
                            {{ \Illuminate\Support\Str::limit(json_encode($rp->conditions), 40) ?? '—' }}
                        </td> --}}

                        <!-- Allowed -->
                                <td>
                                    <span
                                        class="badge toggle-status cursor-pointer bg-label-{{ $rp->is_allowed ? 'success' : 'danger' }}"
                                        data-url="{{ route('admin.roles.permissions.togglestatus', $rp->uuid) }}"
                                        data-type="allow">
                                        {{ $rp->is_allowed ? 'Yes' : 'No' }}
                                    </span>
                                </td>


                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <!-- Edit -->
                                <a href="{{ route('admin.roles.permissions.createoredit', $rp->uuid) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('admin.roles.permissions.destroy', $rp->uuid) }}"
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
                            No role permissions found.
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
