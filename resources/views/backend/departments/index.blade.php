@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Departments')
@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Department Lists</h5>

        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#departmentsReorderModal">
                <i class="bx bx-sort-alt-2 me-1"></i> Reorder
            </button>

            <a href="{{ route('admin.departments.createoredit') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i>
                Create Department
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th width="60">SN</th>
                    <th width="220">Name</th>
                    <th width="220">Slug</th>
                    <th width="420">Description</th>
                    <th width="120">Status</th>
                    <th width="200" class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $department)
                    <tr>
                        <!-- SN -->
                        <td>
                            {{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}
                        </td>

                        <!-- Name -->
                        <td>
                            <strong>{{ $department->name }}</strong>
                        </td>

                        <!-- Slug -->
                        <td>
                            <span class="text-muted">{{ $department->slug }}</span>
                        </td>

                        <!-- Description -->
                        <td class="description-column"
                            title="{{ $department->description }}">
                            {{ \Illuminate\Support\Str::limit(strip_tags($department->description), 80) }}
                        </td>

                        <!-- Status -->
                        <td>
                            <div class="form-check form-switch mb-0">
                                <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                    role="switch"
                                    data-url="{{ route('admin.departments.togglestatus', $department->uuid) }}"
                                    {{ $department->is_active ? 'checked' : '' }}>
                            </div>

                        </td>

                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.departments.createoredit', $department->uuid) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>

                                <form action="{{ route('admin.departments.destroy', $department->uuid) }}"
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
                        <td colspan="6" class="text-center text-muted py-4">
                            No Departments found.
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

@include('backend.partials.reorder-modal', [
    'modalId'    => 'departmentsReorderModal',
    'rows'       => $reorderRows,
    'reorderUrl' => route('admin.departments.reorder'),
    'title'      => 'Reorder Departments',
    'labelField' => 'name',
])
@endsection
