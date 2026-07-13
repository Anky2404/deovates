@extends('backend.layouts.app')

@section('title', 'Deovate | Blog Comments')

@section('content')

<div class="card">


<!-- Card Header -->
<div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Blog Comment Lists</h5>
</div>

<!-- Table -->
<div class="table-responsive text-nowrap">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>SN</th>
                {{-- <th>Blog</th> --}}
                <th>Name</th>
                {{-- <th>Email</th> --}}
                <th>Comment</th>
                <th>Likes</th>
                <th>Dislikes</th>
                <th>Status</th>
                <th>Reported</th>
                <th>Date</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>

        <tbody class="table-border-bottom-0">
            @forelse ($rows as $index => $comment)
                <tr>

                    <!-- SN -->
                    <td>
                        {{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}
                    </td>

                    <!-- Blog -->
                    {{-- <td>
                        <strong>
                            {{ $comment->blog->title ?? 'N/A' }}
                        </strong>
                    </td> --}}

                    <!-- Name -->
                    <td>
                        {{ $comment->name }}
                    </td>

                    <!-- Email -->
                    {{-- <td>
                        {{ Str::between($comment->email, '[', ']') ?: $comment->email }}
                    </td> --}}

                    <!-- Comment -->
                    <td style="max-width:300px">
                        {{ \Illuminate\Support\Str::limit(strip_tags($comment->comment), 80) }}
                    </td>

                    <!-- Likes -->
                    <td>
                        <span class="badge bg-label-success">
                            {{ $comment->likes }}
                        </span>
                    </td>

                    <!-- Dislikes -->
                    <td>
                        <span class="badge bg-label-danger">
                            {{ $comment->dislikes }}
                        </span>
                    </td>

                    <!-- Status -->
                    <td>
                        <span
                            class="badge toggle-status cursor-pointer bg-label-{{ $comment->is_active ? 'success' : 'danger' }}"
                            data-url="{{ route('admin.blogs.comments.togglestatus', $comment->uuid) }}">
                            {{ $comment->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>

                    <!-- Reported -->
                    <td>
                        @if($comment->is_reported)
                            <span class="badge bg-label-warning">
                                Reported
                            </span>
                        @else
                            <span class="badge bg-label-success">
                                Clean
                            </span>
                        @endif
                    </td>

                    <!-- Date -->
                    <td>
                        {{ $comment->created_at?->format('d M Y') }}
                    </td>

                    <!-- Actions -->
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">

                            <a href="{{ route('admin.blogs.comments.details', $comment->uuid) }}"
                               class="btn btn-sm btn-outline-info d-flex align-items-center gap-1">
                                <i class="bx bx-show"></i>
                                View
                            </a>

                            <a href="{{ route('admin.blogs.comments.createoredit', $comment->uuid) }}"
                               class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                <i class="bx bx-edit-alt"></i>
                                Edit
                            </a>

                            <form action="{{ route('admin.blogs.comments.destroy', $comment->uuid) }}"
                                  method="POST"
                                  class="js-delete">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1">
                                    <i class="bx bx-trash"></i>
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="11"
                        class="text-center text-muted py-4">
                        No blog comments found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if($rows->hasPages())
    <div class="card-footer d-flex justify-content-end">
        {{ $rows->links('pagination::bootstrap-5') }}
    </div>
@endif


</div>
@endsection
