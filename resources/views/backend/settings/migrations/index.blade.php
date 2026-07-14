@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Migrations')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header">
        <h5 class="mb-0">Migrations</h5>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>ID</th>
                    <th>Migration</th>
                    <th>Batch</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $migration)
                    <tr>
                        <!-- SN -->
                        <td>{{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}</td>

                        <!-- ID -->
                        <td>{{ $migration->id }}</td>

                        <!-- Migration -->
                        <td>
                            <span class="text-muted">{{ $migration->migration }}</span>
                        </td>

                        <!-- Batch -->
                        <td>
                            <span class="badge bg-label-secondary">{{ $migration->batch }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            No migrations found.
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
