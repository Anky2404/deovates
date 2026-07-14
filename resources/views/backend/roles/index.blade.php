@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Roles')

@section('content')
    <div class="card">

        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Role Lists</h5>

            <a href="{{ route('admin.roles.createoredit') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i>
                Create Role
            </a>
        </div>

        <!-- Table -->
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="60">SN</th>
                        <th width="220">Name</th>
                        <th width="220">Slug</th>
                        <th width="160">Guard</th>
                        <th width="120">Status</th>
                        <th width="200" class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="table-border-bottom-0">
                    @forelse ($rows as $index => $role)
                        <tr>
                            <!-- SN -->
                            <td>
                                {{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}
                            </td>

                            <!-- Name -->
                            <td>
                                <strong>{{ $role->name }}</strong>
                            </td>

                            <!-- Slug -->
                            <td>
                                <span class="text-muted">{{ $role->slug }}</span>
                            </td>

                            <!-- Guard -->
                            <td>
                                <span class="badge bg-label-info">
                                    {{ $role->guard ?? 'web' }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td>
                                <span
                                    class="badge toggle-status cursor-pointer bg-label-{{ $role->is_active ? 'success' : 'danger' }}"
                                    data-url="{{ route('admin.roles.togglestatus', $role->uuid) }}">
                                    {{ $role->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>



                            <!-- Actions -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('admin.roles.createoredit', $role->uuid) }}"
                                        class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                        <i class="bx bx-edit-alt"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.roles.destroy', $role->uuid) }}" method="POST"
                                        class="js-delete">
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
                            <td colspan="6" class="text-center text-muted py-4">
                                No Roles found.
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
