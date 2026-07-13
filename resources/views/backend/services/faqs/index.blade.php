@extends('backend.layouts.app')

@section('title', 'Deovate World | Service Faqss')

@section('content')
    <div class="card">

        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Service Faqs Lists</h5>

            <a href="{{ route('admin.services.faqs.createoredit') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Create Service Faqs
            </a>
        </div>

        <!-- Table -->
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
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
                            <td>{{ $index + 1 }}</td>

                            <td>
                                <strong>{{ $service->name }}</strong>
                            </td>

                            <td>
                                <span class="text-muted">
                                    {{ $service->slug }}
                                </span>
                            </td>

                            <td class="description-column">
                                {{ $service->description }}
                            </td>

                            {{-- Status --}}
                            <td>
                                <span
                                    class="badge toggle-status cursor-pointer bg-label-{{ $service->is_active ? 'success' : 'danger' }}"
                                    data-url="{{ route('admin.services.faqs.togglestatus', $service->uuid) }}">
                                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.services.faqs.createoredit', $service->uuid) }}"
                                        class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                        <i class="icon-base bx bx-edit-alt"></i>
                                        Edit
                                    </a>

                                    <!-- Delete Button -->

                                    <form action="{{ route('admin.services.faqs.destroy', $service->uuid) }}"
                                        method="POST" class="js-delete">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1">
                                            <i class="icon-base bx bx-trash"></i>
                                            Delete
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

    </div>
@endsection
