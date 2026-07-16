@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | FAQ Categories')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">FAQ Category Lists</h5>

        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                data-bs-target="#faqCategoriesReorderModal">
                <i class="bx bx-sort-alt-2 me-1"></i> Reorder
            </button>

            <a href="{{ route('admin.faqs.categories.createoredit') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Create FAQ Category
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Page</th>
                    <th>Description</th>
                    <th class="text-center">Total FAQs</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $category)
                    <tr>
                        <!-- SN -->
                        <td>{{ $rows->firstItem() + $index }}</td>

                        <!-- Title -->
                        <td>
                            <strong>{{ $category->title }}</strong>
                        </td>

                        <!-- Slug -->
                        <td>
                            <span class="text-muted">{{ $category->slug }}</span>
                        </td>

                        <!-- Page -->
                        <td>
                            <span class="badge bg-label-info">
                                {{ $category->page ?? '—' }}
                            </span>
                        </td>

                        <!-- Description -->
                        <td class="description-column">
                            <span class="text-muted truncate-text">
                                {{ \Illuminate\Support\Str::limit(strip_tags($category->short_description ?? ''), 60) ?: '—' }}
                            </span>
                        </td>

                        <!-- Total FAQs -->
                        <td class="text-center">
                            <a href="{{ route('admin.faqs.categories.createoredit', $category->uuid) }}"
                               class="badge bg-label-primary text-decoration-none">
                                {{ $category->faqs_count }} {{ \Illuminate\Support\Str::plural('FAQ', $category->faqs_count) }}
                            </a>
                        </td>

                        {{-- Status --}}
                        <td>
                            <div class="form-check form-switch mb-0">
                                <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                    role="switch"
                                    data-url="{{ route('admin.faqs.categories.togglestatus', $category->uuid) }}"
                                    {{ $category->is_active ? 'checked' : '' }}>
                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.faqs.categories.createoredit', $category->uuid) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>

                                <form action="{{ route('admin.faqs.categories.destroy', $category->uuid) }}"
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
                        <td colspan="8" class="text-center text-muted py-4">
                            No FAQ categories found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="card-footer">
        {{ $rows->links() }}
    </div>

</div>

@include('backend.partials.reorder-modal', [
    'modalId' => 'faqCategoriesReorderModal',
    'rows' => $reorderRows,
    'reorderUrl' => route('admin.faqs.categories.reorder'),
    'title' => 'Reorder FAQ Categories',
    'labelField' => 'title',
])
@endsection
