@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Section Contents')

@section('content')
    <div class="card">

        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Section Content Lists</h5>

            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                    data-bs-target="#sectionContentsReorderModal">
                    <i class="bx bx-sort-alt-2 me-1"></i> Reorder
                </button>

                <a href="{{ route('admin.section-contents.createoredit') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i>
                    Create Section Content
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
                        <th>Page</th>
                        <th>Section</th>
                        <th>Section Title</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($rows as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                <strong>{{ $row->title }}</strong>
                                <div class="small text-muted">{{ $row->slug }}</div>
                            </td>

                            <td>
                                <span class="badge bg-label-primary">{{ config('constants.PAGE_NAMES.' . $row->page_name, $row->page_name) }}</span>
                            </td>

                            <td>
                                <span class="badge bg-label-info">{{ config('constants.SECTION_NAMES.' . $row->section_name, $row->section_name) }}</span>
                            </td>

                            <td class="description-column" title="{{ $row->section_title }}">
                                <span class="truncate-text">{{ $row->section_title }}</span>
                            </td>

                            <td>
                                <div class="form-check form-switch mb-0">
                                    <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                        role="switch"
                                        data-url="{{ route('admin.section-contents.togglestatus', $row->uuid) }}"
                                        {{ $row->is_active ? 'checked' : '' }}>
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('admin.section-contents.createoredit', $row->uuid) }}"
                                        class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                        <i class="bx bx-edit-alt"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.section-contents.destroy', $row->uuid) }}" method="POST"
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
                            <td colspan="7" class="text-center text-muted py-4">
                                No section content found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($rows->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $rows->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>

@include('backend.partials.reorder-modal', [
    'modalId' => 'sectionContentsReorderModal',
    'rows' => $reorderRows,
    'reorderUrl' => route('admin.section-contents.reorder'),
    'title' => 'Reorder Section Contents',
    'labelField' => 'title',
])
@endsection
