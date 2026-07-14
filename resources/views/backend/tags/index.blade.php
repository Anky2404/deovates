@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Tags')

@section('content')
    <div class="card">

        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tag Lists</h5>

            <a href="{{ route('admin.tags.createoredit') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Create Tag
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
                    @forelse ($rows as $index => $tag)
                        <tr>
                            <!-- SN -->
                            <td>{{ $index + 1 }}</td>

                            <!-- Name -->
                            <td>
                                <strong>{{ $tag->name }}</strong>
                            </td>

                            <!-- Slug -->
                            <td>
                                <span class="text-muted">{{ $tag->slug }}</span>
                            </td>

                            <td class="description-column" title="{{ $tag->meta_description }}">
                                {{ \Illuminate\Support\Str::limit(strip_tags($tag->meta_description), 70) }}
                            </td>

                            {{-- Status --}}
                            <td>
                                <span
                                    class="badge toggle-status cursor-pointer bg-label-{{ $tag->is_active ? 'success' : 'danger' }}"
                                    data-url="{{ route('admin.tags.togglestatus', $tag->uuid) }}">
                                    {{ $tag->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>



                            <!-- Actions -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('admin.tags.createoredit', $tag->uuid) }}"
                                        class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                        <i class="bx bx-edit-alt"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.tags.destroy', $tag->uuid) }}" method="POST"
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
                            <td colspan="5" class="text-center text-muted py-4">
                                No Tags found.
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
