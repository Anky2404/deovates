@extends('backend.layouts.app')

@section('title', 'Google Reviews')

@section('content')

<div class="card mb-4">
    <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">

        <div class="d-flex align-items-center gap-4">
            <div>
                <div class="text-muted small">Average Rating</div>
                <div class="fs-4 fw-bold">
                    {{ $averageRating ? number_format($averageRating, 1) : '—' }}
                    @if ($averageRating)
                        <i class="bx bxs-star text-warning"></i>
                    @endif
                </div>
            </div>

            <div>
                <div class="text-muted small">Total Google Ratings</div>
                <div class="fs-4 fw-bold">{{ $totalCount ? number_format($totalCount) : '—' }}</div>
            </div>

            <div>
                <div class="text-muted small">Last Synced</div>
                <div class="fw-semibold">{{ $lastSyncedAt ?? 'Never' }}</div>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.google-reviews.sync') }}">
            @csrf
            <button type="submit" class="btn btn-primary">
                <i class="bx bx-refresh me-1"></i> Update Reviews
            </button>
        </form>

    </div>
</div>

<div class="card">

    <div class="card-header">
        <h5 class="mb-0">Synced Google Reviews</h5>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Author</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Posted</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($rows as $index => $row)
                    <tr>
                        <td>{{ $rows->firstItem() + $index }}</td>

                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ $row->author_photo_url ?: asset('assets/front/img/default-img.avif') }}"
                                     alt="{{ $row->author_name }}"
                                     style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                                <strong>{{ $row->author_name }}</strong>
                            </div>
                        </td>

                        <td>
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bx {{ $i <= $row->rating ? 'bxs-star text-warning' : 'bx-star text-muted' }}"></i>
                            @endfor
                        </td>

                        <td style="max-width:360px;">
                            <div class="text-truncate" title="{{ $row->review_text }}">
                                {{ $row->review_text ?? '—' }}
                            </div>
                        </td>

                        <td>{{ $row->relative_time_description ?? optional($row->review_time)->format('d M Y') }}</td>

                        <td>
                            <span class="badge toggle-status cursor-pointer bg-label-{{ $row->is_active ? 'success' : 'danger' }}"
                                data-url="{{ route('admin.google-reviews.togglestatus', $row->uuid) }}">
                                {{ $row->is_active ? 'Visible' : 'Hidden' }}
                            </span>
                        </td>

                        <td class="text-center">
                            <form action="{{ route('admin.google-reviews.destroy', $row->uuid) }}" method="POST" class="js-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            No Google reviews synced yet. Click "Update Reviews" above to fetch them.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($rows->hasPages())
        <div class="card-footer">
            {{ $rows->links() }}
        </div>
    @endif

</div>

@endsection
