@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Templates')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Template Lists</h5>

        <a href="{{ route('admin.templates.createoredit') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i>
            Create Template
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th width="60">SN</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th width="140">Type</th>
                    <th width="120">Usage</th>
                    <th width="120">Default</th>
                    <th width="120">Status</th>
                    <th width="200" class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $template)
                    <tr>
                        <!-- SN -->
                        <td>{{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}</td>

                        <!-- Name -->
                        <td>
                            <strong>{{ $template->name }}</strong>
                        </td>

                        <!-- Slug -->
                        <td>
                            <span class="text-muted">{{ $template->slug }}</span>
                        </td>

                        <!-- Type -->
                        <td>
                            <span class="badge bg-label-info">{{ $template->type ?? '—' }}</span>
                        </td>

                        <!-- Usage -->
                        <td>{{ $template->usage_count }}</td>

                        <!-- Default -->
                        <td>
                            <span class="badge bg-label-{{ $template->is_default ? 'primary' : 'secondary' }}">
                                {{ $template->is_default ? 'Default' : 'Not Default' }}
                            </span>
                        </td>

                        <!-- Status -->
                        <td>
                            <div class="form-check form-switch mb-0">
                                <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                    role="switch"
                                    data-url="{{ route('admin.templates.togglestatus', $template->uuid) }}"
                                    {{ $template->is_active ? 'checked' : '' }}>
                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.templates.createoredit', $template->uuid) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>

                                <form action="{{ route('admin.templates.destroy', $template->uuid) }}"
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
                            No Templates found.
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
