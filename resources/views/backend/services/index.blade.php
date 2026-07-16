@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Services')
@section('content')
    <div class="card">

        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Service Lists</h5>

            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                    data-bs-target="#servicesReorderModal">
                    <i class="bx bx-sort-alt-2 me-1"></i> Reorder
                </button>

                <a href="{{ route('admin.services.createoredit') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i>
                    Create Service
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($rows as $index => $service)
                        <tr>
                            <td>
                                {{ $index + 1 }}
                            </td>

                            <td>
                                @if (
                                    !empty($service->featured_image) &&
                                        \Illuminate\Support\Facades\Storage::disk('public')->exists($service->featured_image))
                                    <img src="{{ asset('storage/' . $service->featured_image) }}" alt="{{ $service->title }}"
                                        class="table-thumb rounded">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $service->title }}</strong>
                            </td>

                            <td>
                                <span class="text-muted">{{ $service->slug }}</span>
                            </td>

                            <td class="description-column" title="{{ $service->description }}">
                                <span class="truncate-text">{{ \Illuminate\Support\Str::limit(strip_tags($service->description), 70) }}</span>
                            </td>

                            <td>
                                <div class="form-check form-switch mb-0">
                                    <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                        role="switch"
                                        data-url="{{ route('admin.services.togglestatus', $service->uuid) }}"
                                        {{ $service->is_active ? 'checked' : '' }}>
                                </div>
                            </td>

                            <td>
                                <div class="form-check form-switch mb-0">
                                    <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                        role="switch"
                                        data-url="{{ route('admin.services.togglefeatured', $service->uuid) }}"
                                        {{ $service->is_featured ? 'checked' : '' }}>
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('admin.services.createoredit', $service->uuid) }}"
                                        class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                        <i class="bx bx-edit-alt"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.services.destroy', $service->uuid) }}" method="POST"
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
                            <td colspan="8" class="text-center text-muted py-4">
                                No services found.
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
    'modalId' => 'servicesReorderModal',
    'rows' => $reorderRows,
    'reorderUrl' => route('admin.services.reorder'),
    'title' => 'Reorder Services',
    'labelField' => 'title',
    'imageField' => 'featured_image',
])
@endsection
