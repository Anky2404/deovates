@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Services')
@section('content')
    <div class="card">

        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Service Lists</h5>

            <a href="{{ route('admin.services.createoredit') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i>
                Create Service
            </a>
        </div>

        <!-- Table -->
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th></th>
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

                <tbody id="serviceSortable"
       class="sortable-table"
       data-url="{{ route('admin.services.reorder') }}">
             
                    @forelse ($rows as $index => $service)
                        <tr data-uuid="{{ $service->uuid }}">
                            <td class="drag-handle" style="cursor: grab; width:1%;">
                <i class="bx bx-menu text-muted"></i>
            </td>

                            <td class="row-number">
                                {{ $index + 1 }}
                            </td>

                            <td>
                                @if (
                                    !empty($service->featured_image) &&
                                        \Illuminate\Support\Facades\Storage::disk('public')->exists($service->featured_image))
                                    <img src="{{ asset('storage/' . $service->featured_image) }}" alt="{{ $service->title }}"
                                        class="rounded" style="width:60px;height:60px;object-fit:cover;">
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
                                {{ \Illuminate\Support\Str::limit(strip_tags($service->description), 70) }}
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
                            <td colspan="9" class="text-center text-muted py-4">
                                No services found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($rows->isNotEmpty())
            <div class="card-footer text-muted small">
                <i class="bx bx-info-circle"></i> Drag rows by the handle to reorder.
            </div>
        @endif

    </div>
@endsection
    

