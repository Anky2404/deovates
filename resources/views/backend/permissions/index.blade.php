@extends('backend.layouts.app')

@section('title', 'Permissions')
@section('content')
    <div class="card">

        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Permission List</h5>

            <a href="{{ route('admin.permissions.createoredit') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i>
                Create Permission
            </a>
        </div>

        <!-- Table -->
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="60">SN</th>
                        <th width="180">Name</th>
                        <th width="180">Slug</th>
                        {{-- <th width="120">Module</th>
                        <th width="120">Group</th> --}}
                        <th width="120">Action Key</th>
                        <th width="320">Description</th>
                        <th width="100">Active</th>
                        <th width="200" class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="table-border-bottom-0">
                    @forelse ($rows as $index => $permission)
                        <tr>
                            <!-- SN -->
                            <td>
                                {{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}
                            </td>

                            <!-- Name -->
                            <td>
                                <strong>{{ $permission->name }}</strong>
                            </td>

                            <!-- Slug -->
                            <td class="text-muted">
                                {{ $permission->slug }}
                            </td>

                            {{-- <!-- Module -->
                            <td>
                                <span class="badge bg-label-primary">
                                    {{ $permission->module ?? 'N/A' }}
                                </span>
                            </td>

                            <!-- Group -->
                            <td>
                                <span class="badge bg-label-info">
                                    {{ $permission->group ?? 'N/A' }}
                                </span>
                            </td> --}}

                            <!-- Action -->
                            <td>
                                @php
                                    $actions = array_flip(config('constants.ACTIONS'));
                                    $selectedActions = $permission->action ? explode(',', $permission->action) : [];
                                @endphp

                                @if (!empty($selectedActions))
                                    @foreach ($selectedActions as $act)
                                        <span class="badge bg-label-warning me-1">
                                            {{ ucfirst(str_replace('_', ' ', $actions[$act] ?? $act)) }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="badge bg-label-secondary">N/A</span>
                                @endif
                            </td>

                            <!-- Description -->
                            <td class="description-column" title="{{ $permission->description }}">
                                <span class="truncate-text">{{ \Illuminate\Support\Str::limit(strip_tags($permission->description), 80) }}</span>
                            </td>

                             {{-- Status --}}
                            <td>
                                <div class="form-check form-switch mb-0">
                                    <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                        role="switch"
                                        data-url="{{ route('admin.permissions.togglestatus', $permission->uuid) }}"
                                        {{ $permission->is_active ? 'checked' : '' }}>
                                </div>
                            </td>



                            <!-- Actions -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <!-- Edit -->
                                    <a href="{{ route('admin.permissions.createoredit', $permission->uuid) }}"
                                        class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                        <i class="bx bx-edit-alt"></i> Edit
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.permissions.destroy', $permission->uuid) }}"
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
                                No Permissions found.
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
