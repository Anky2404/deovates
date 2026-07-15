@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Media Relations')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Media Relation Lists</h5>

        <a href="{{ route('admin.media.relations.createoredit') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i>
            Create Media Relation
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th width="60">SN</th>
                    <th width="90">Media</th>
                    <th>Model Type</th>
                    <th width="110">Model ID</th>
                    <th width="140">Collection</th>
                    <th width="110">Primary</th>
                    <th width="120">Status</th>
                    <th width="120">Featured</th>
                    <th width="200" class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $relation)
                    <tr>
                        <!-- SN -->
                        <td>{{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}</td>

                        <!-- Media -->
                        <td>
                            @if ($relation->media && $relation->media->path && str_starts_with((string) $relation->media->mime_type, 'image/'))
                                <img src="{{ asset('storage/' . $relation->media->path) }}"
                                     alt="{{ $relation->media->name }}"
                                     class="rounded border"
                                     width="45"
                                     height="45"
                                     style="object-fit: cover;">
                            @else
                                <i class="bx bx-file fs-3 text-muted"></i>
                            @endif
                        </td>

                        <!-- Model Type -->
                        <td>
                            <span class="text-muted">{{ $relation->model_type ?? '—' }}</span>
                        </td>

                        <!-- Model ID -->
                        <td>{{ $relation->model_id ?? '—' }}</td>

                        <!-- Collection -->
                        <td>
                            <span class="badge bg-label-info">{{ $relation->collection ?? '—' }}</span>
                        </td>

                        <!-- Primary -->
                        <td>
                            <span class="badge bg-label-{{ $relation->is_primary ? 'primary' : 'secondary' }}">
                                {{ $relation->is_primary ? 'Primary' : 'No' }}
                            </span>
                        </td>

                        <!-- Status -->
                        <td>
                            <div class="form-check form-switch mb-0">
                                <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                    role="switch"
                                    data-url="{{ route('admin.media.relations.togglestatus', $relation->uuid) }}"
                                    {{ $relation->is_active ? 'checked' : '' }}>
                            </div>
                        </td>

                        <!-- Featured -->
                        <td>
                            <div class="form-check form-switch mb-0">
                                <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                    role="switch"
                                    data-url="{{ route('admin.media.relations.togglefeatured', $relation->uuid) }}"
                                    {{ $relation->is_featured ? 'checked' : '' }}>
                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.media.relations.createoredit', $relation->uuid) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>

                                <form action="{{ route('admin.media.relations.destroy', $relation->uuid) }}"
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
                            No Media Relations found.
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
