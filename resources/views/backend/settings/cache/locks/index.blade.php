@extends('backend.layouts.app')

@section('title', 'Deovate World | Cache Locks')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Cache Locks</h5>

        <form action="{{ route('admin.settings.cache.locks.clear') }}" method="POST" class="js-delete">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="bx bx-trash me-1"></i>
                Clear All Locks
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>Key</th>
                    <th>Owner</th>
                    <th>Expiration</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $lock)
                    <tr>
                        <!-- SN -->
                        <td>{{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}</td>

                        <!-- Key -->
                        <td>
                            <span class="text-muted">{{ $lock->key }}</span>
                        </td>

                        <!-- Owner -->
                        <td>{{ $lock->owner }}</td>

                        <!-- Expiration -->
                        <td>
                            {{ $lock->expiration ? \Carbon\Carbon::createFromTimestamp($lock->expiration) : '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            No cache locks found.
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
