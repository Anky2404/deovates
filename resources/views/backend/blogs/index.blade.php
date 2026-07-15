@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Blogs')

@section('content')
    <div class="card">

        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Blog Lists</h5>

            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#blogsReorderModal">
                    <i class="bx bx-sort-alt-2 me-1"></i> Reorder
                </button>

                <a href="{{ route('admin.blogs.createoredit') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>
                    Create Blog
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>SN</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($rows as $index => $blog)
                        <tr>
                            <!-- SN -->
                            <td>{{ $index + 1 }}</td>

                            <!-- Image -->
                            <td>
                                @if ($blog->featured_image)
                                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}"
                                        class="rounded" width="50">
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>

                            <!-- Title -->
                            <td class="description-column">
                                <strong>{{ $blog->title }}</strong>
                            </td>

                            <!-- Slug -->
                            <td>
                                <span
                                    class="text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($blog->slug), 30) }}</span>
                            </td>

                            {{-- Status --}}
                            <td>
                                <div class="form-check form-switch mb-0">
                                    <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                        role="switch"
                                        data-url="{{ route('admin.blogs.togglestatus', $blog->uuid) }}"
                                        {{ $blog->is_active ? 'checked' : '' }}>
                                </div>
                            </td>

                            {{-- Featured --}}
                            <td>
                                <div class="form-check form-switch mb-0">
                                    <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                        role="switch"
                                        data-url="{{ route('admin.blogs.togglefeatured', $blog->uuid) }}"
                                        {{ $blog->is_featured ? 'checked' : '' }}>
                                </div>
                            </td>



                            <!-- Actions -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('admin.blogs.createoredit', $blog->uuid) }}"
                                        class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                        <i class="bx bx-edit-alt"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.blogs.destroy', $blog->uuid) }}" method="POST"
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
                                No Blogs found.
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
    'modalId'    => 'blogsReorderModal',
    'rows'       => $reorderRows,
    'reorderUrl' => route('admin.blogs.reorder'),
    'title'      => 'Reorder Blogs',
    'labelField' => 'title',
    'imageField' => 'featured_image',
])
@endsection
