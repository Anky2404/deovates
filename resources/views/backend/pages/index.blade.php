@extends('backend.layouts.app')

@section('title', 'Pages')

@section('content')
<div class="card">

    <!-- Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Page List</h5>

        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#pagesReorderModal">
                <i class="bx bx-sort-alt-2 me-1"></i> Reorder
            </button>

            <a href="{{ route('admin.pages.createoredit') }}" class="btn btn-primary">
                <i class="icon-base bx bx-plus"></i>
                Create Page
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Published</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($rows as $index => $page)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td>
                            <strong>{{ $page->title }}</strong>
                            @if($page->is_homepage)
                                <span class="badge bg-label-primary ms-1">Home</span>
                            @endif
                        </td>

                        <td>{{ $page->slug }}</td>

                        {{-- Status --}}
                        <td>
                            <div class="form-check form-switch mb-0">
                                <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                    role="switch"
                                    data-url="{{ route('admin.pages.togglestatus', $page->uuid) }}"
                                    {{ $page->is_active ? 'checked' : '' }}>
                            </div>
                        </td>

                        {{-- Published --}}
                        <td>
                            <span class="badge bg-label-{{ $page->is_published ? 'success' : 'secondary' }}">
                                {{ $page->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <!-- View -->
                                <a href="{{ route('admin.pages.details', $page->uuid) }}"
                                    class="btn btn-sm btn-outline-info">
                                    <i class="icon-base bx bx-show"></i>
                                </a>

                                <!-- Edit -->
                                <a href="{{ route('admin.pages.createoredit', $page->uuid) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="icon-base bx bx-edit-alt"></i>
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('admin.pages.destroy', $page->uuid) }}"
                                    method="POST" class="js-delete">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-sm btn-outline-danger">
                                        <i class="icon-base bx bx-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No pages found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        @if ($rows instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="mt-3 d-flex justify-content-end">
                {{ $rows->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

</div>

@include('backend.partials.reorder-modal', [
    'modalId'    => 'pagesReorderModal',
    'rows'       => $reorderRows,
    'reorderUrl' => route('admin.pages.reorder'),
    'title'      => 'Reorder Pages',
    'labelField' => 'title',
])
@endsection
