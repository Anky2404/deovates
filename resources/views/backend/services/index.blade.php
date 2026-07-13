@extends('backend.layouts.app')

@section('title', 'Deovate World | Services')
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
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="table-border-bottom-0">
                    @forelse ($rows as $index => $service)
                        <tr>
                            <td>
                                {{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}
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
                                    <span
                                        class="badge toggle-status cursor-pointer bg-label-{{ $service->is_active ? 'success' : 'danger' }}"
                                        data-url="{{ route('admin.services.togglestatus', $service->uuid) }}">
                                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                                    </span>
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
                            <td colspan="6" class="text-center text-muted py-4">
                                No services found.
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
