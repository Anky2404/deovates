@extends('backend.layouts.app')

@section('title', 'Deovate World | Technologies')

@section('content')
    <div class="card">

        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Technology Lists</h5>

            <a href="{{ route('admin.technologies.createoredit') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Create Technology
            </a>
        </div>

        <!-- Table -->
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>SN</th>
                        <th>Icon</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="table-border-bottom-0">
                    @forelse ($rows as $index => $technology)
                        <tr>
                            <!-- SN -->
                            <td>{{ $index + 1 }}</td>

                            <!-- Icon -->
                            <td>
                                @if ($technology->icon)
                                    <i class="{{ $technology->icon }} fs-4 text-primary"></i>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>

                            <!-- Name -->
                            <td>
                                <strong>{{ $technology->name }}</strong>
                            </td>

                            <!-- Slug -->
                            <td>
                                <span class="text-muted">{{ $technology->slug }}</span>
                            </td>

                            {{-- Status --}}
                            <td>
                                <span
                                    class="badge toggle-status cursor-pointer bg-label-{{ $technology->is_active ? 'success' : 'danger' }}"
                                    data-url="{{ route('admin.technologies.togglestatus', $technology->uuid) }}">
                                    {{ $technology->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>



                            <!-- Actions -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('admin.technologies.createoredit', $technology->uuid) }}"
                                        class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                        <i class="bx bx-edit-alt"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.technologies.destroy', $technology->uuid) }}"
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
                            <td colspan="6" class="text-center text-muted py-4">
                                No Technologies found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
