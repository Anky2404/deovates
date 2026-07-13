@extends('backend.layouts.app')

@section('title', 'Deovate | Portfolio Categories')

@section('content')
    <div class="card">

        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Portfolio Category Lists</h5>
            <a href="{{ route('admin.portfolios.categories.createoredit') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Create Category
            </a>
        </div>

        <!-- Table -->
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>SN</th>
                        <th>Icon / Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="table-border-bottom-0">
                    @forelse ($rows as $index => $category)
                        <tr>
                            <!-- SN -->
                            <td>{{ $index + 1 }}</td>

                            <!-- Icon / Image -->
                            <td>
                                <i class="{{ $category->icon }}"></i>
                            </td>
                            {{-- @if ($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="rounded" width="40" height="40">
                            @elseif($category->icon)
                                <i class="{{ $category->icon }} fs-4 text-primary"></i>
                            @else
                                <span class="text-muted">—</span>
                            @endif --}}
                            {{-- </td> --}}

                            <!-- Name -->
                            <td><strong>{{ $category->name }}</strong></td>

                            <!-- Slug -->
                            <td><span class="text-muted">{{ $category->slug }}</span></td>

                            <!-- Featured -->
                            <td>
                                <span
                                    class="badge {{ $category->is_featured ? 'bg-label-success' : 'bg-label-secondary' }}">
                                    {{ $category->is_featured ? 'Yes' : 'No' }}
                                </span>
                            </td>

                             {{-- Status --}}
                                <td>
                                    <span
                                        class="badge toggle-status cursor-pointer bg-label-{{ $category->is_active ? 'success' : 'danger' }}"
                                        data-url="{{ route('admin.portfolios.categories.togglestatus', $category->uuid) }}">
                                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>



                            <!-- Actions -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.portfolios.categories.createoredit', $category->uuid) }}"
                                        class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                        <i class="bx bx-edit-alt"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.portfolios.categories.destroy', $category->uuid) }}"
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
                                No categories found.
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
