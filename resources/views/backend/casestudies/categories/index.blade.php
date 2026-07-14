@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Case Study Categories')

@section('content')

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Case Study Category Lists</h5>

        <a href="{{ route('admin.casestudies.categories.createoredit') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Create Category
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Case Studies</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $category)
                    <tr>

                        <!-- SN -->
                        <td>{{ $rows->firstItem() + $index }}</td>

                        <!-- Icon -->
                        <td>
                            <i class="{{ $category->icon }} fs-4 text-primary"></i>
                        </td>

                        <!-- Name -->
                        <td>
                            <strong>{{ $category->name }}</strong>
                        </td>

                        <!-- Slug -->
                        <td>
                            <span class="text-muted">
                                {{ \Illuminate\Support\Str::limit($category->slug, 30) }}
                            </span>
                        </td>

                        <!-- Case Study Count -->
                        <td>
                            <span class="badge bg-label-info">
                                {{ $category->case_studies_count }}
                            </span>
                        </td>

                        <!-- Status -->
                        <td>
                            <span
                                class="badge toggle-status cursor-pointer bg-label-{{ $category->is_active ? 'success' : 'danger' }}"
                                data-url="{{ route('admin.casestudies.categories.togglestatus', $category->uuid) }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>

                        </td>

                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.casestudies.categories.createoredit', $category->uuid) }}"
                                    class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>

                                <form action="{{ route('admin.casestudies.categories.destroy', $category->uuid) }}"
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
                            No Categories Found.
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
@endsection
