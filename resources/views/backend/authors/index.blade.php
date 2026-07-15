@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Authors')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Author Lists</h5>

        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#authorsReorderModal">
                <i class="bx bx-sort-alt-2 me-1"></i> Reorder
            </button>

            <a href="{{ route('admin.authors.createoredit') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Create Author
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $author)
                    <tr>
                        <!-- SN -->
                        <td>{{ $index + 1 }}</td>

                        <!-- Image -->
                       <td>
                                <img src="{{ $author->avatar
                                    ? asset('storage/'.$author->avatar)
                                    : asset('assets/backend/img/avatars/1.png') }}"
                                    alt="{{ $author->name }}"
                                    class="rounded-circle"
                                    width="40"
                                    height="40">
                            </td>

                        <!-- Name -->
                        <td>
                            <strong>{{ $author->name }}</strong>
                        </td>

                        <!-- Email -->
                        <td>
                            <span class="text-muted">{{ $author->email ?? '—' }}</span>
                        </td>

                        <!-- Phone -->
                        <td>
                            <span class="text-muted">{{ $author->phone ?? '—' }}</span>
                        </td>

                         {{-- Status --}}
                                <td>
                                    <div class="form-check form-switch mb-0">
                                        <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                            role="switch"
                                            data-url="{{ route('admin.authors.togglestatus', $author->uuid) }}"
                                            {{ $author->is_active ? 'checked' : '' }}>
                                    </div>
                                </td>

                                {{-- Featured --}}
                                <td>
                                    <div class="form-check form-switch mb-0">
                                        <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                            role="switch"
                                            data-url="{{ route('admin.authors.togglefeatured', $author->uuid) }}"
                                            {{ $author->is_featured ? 'checked' : '' }}>
                                    </div>
                                </td>



                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.authors.createoredit', $author->uuid) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>

                                <form action="{{ route('admin.authors.destroy', $author->uuid) }}"
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
                            No Authors found.
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

@include('backend.partials.reorder-modal', [
    'modalId'    => 'authorsReorderModal',
    'rows'       => $reorderRows,
    'reorderUrl' => route('admin.authors.reorder'),
    'title'      => 'Reorder Authors',
    'labelField' => 'name',
    'imageField' => 'profile_image',
])
@endsection
