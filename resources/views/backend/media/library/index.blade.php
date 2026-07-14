@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Media Library')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Media Library</h5>

        <a href="{{ route('admin.media.library.createoredit') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i>
            Upload Media
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th width="60">SN</th>
                    <th width="90">Preview</th>
                    <th>Name</th>
                    <th width="140">Collection</th>
                    <th width="120">Size</th>
                    <th width="120">Status</th>
                    <th width="200" class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $media)
                    <tr>
                        <!-- SN -->
                        <td>{{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}</td>

                        <!-- Preview -->
                        <td>
                            @if ($media->path && str_starts_with((string) $media->mime_type, 'image/'))
                                <img src="{{ asset('storage/' . $media->path) }}"
                                     alt="{{ $media->name }}"
                                     class="rounded border"
                                     width="45"
                                     height="45"
                                     style="object-fit: cover;">
                            @else
                                <i class="bx bx-file fs-3 text-muted"></i>
                            @endif
                        </td>

                        <!-- Name -->
                        <td>
                            <strong>{{ $media->name }}</strong>
                            <div class="text-muted small">{{ $media->mime_type }}</div>
                        </td>

                        <!-- Collection -->
                        <td>
                            <span class="badge bg-label-info">{{ $media->collection ?? '—' }}</span>
                        </td>

                        <!-- Size -->
                        <td>{{ $media->size ? $media->getHumanSizeAttribute() : '—' }}</td>

                        <!-- Status -->
                        <td>
                            <span
                                class="badge toggle-status cursor-pointer bg-label-{{ $media->is_active ? 'success' : 'danger' }}"
                                data-url="{{ route('admin.media.library.togglestatus', $media->uuid) }}">
                                {{ $media->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.media.library.createoredit', $media->uuid) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>

                                <form action="{{ route('admin.media.library.destroy', $media->uuid) }}"
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
                            No Media found.
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
