@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Blog Categories')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Blog Category Lists</h5>

        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                data-bs-target="#blogCategoriesReorderModal">
                <i class="bx bx-sort-alt-2 me-1"></i> Reorder
            </button>

            <a href="{{ route('admin.blogs.categories.createoredit') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Create Blog Category
            </a>
        </div>
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
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $category)
                    <tr>
                        <!-- SN -->
                        <td>{{ $index + 1 }}</td>

                        <!-- Icon -->
                        <td>
                            @if($category->icon)
                                <i class="{{ $category->icon }} fs-4 text-primary"></i>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        <!-- Name -->
                        <td>
                            <strong>{{ $category->name }}</strong>
                        </td>

                        <!-- Slug -->
                        <td>
                            <span class="text-muted">{{ $category->slug }}</span>
                        </td>

                         {{-- Status --}}
                                <td>
                                    <div class="form-check form-switch mb-0">
                                        <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                            role="switch"
                                            data-url="{{ route('admin.blogs.categories.togglestatus', $category->uuid) }}"
                                            {{ $category->is_active ? 'checked' : '' }}>
                                    </div>
                                </td>



                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.blogs.categories.createoredit', $category->uuid) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>

                                <form action="{{ route('admin.blogs.categories.destroy', $category->uuid) }}"
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
                            No blog categories found.
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

@include('backend.partials.reorder-modal', [
    'modalId' => 'blogCategoriesReorderModal',
    'rows' => $reorderRows,
    'reorderUrl' => route('admin.blogs.categories.reorder'),
    'title' => 'Reorder Blog Categories',
    'labelField' => 'name',
])
@endsection
