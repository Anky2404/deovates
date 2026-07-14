@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Portfolios')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Portfolio Lists</h5>
        <a href="{{ route('admin.portfolios.createoredit') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Create Portfolio
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>Featured Image</th>
                    <th>Title</th>
                    <th>Client</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $portfolio)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <!-- Featured Image -->
                        <td>
                            @php
                                $image = $portfolio->featured_image
                                    ? asset('storage/' . $portfolio->featured_image)
                                    : asset('assets/backend/img/placeholder.png');
                            @endphp
                            <img src="{{ $image }}" alt="{{ $portfolio->title }}" class="rounded" width="60" height="40">
                        </td>

                        <!-- Title -->
                        <td><strong>{{ $portfolio->title }}</strong></td>

                        <!-- Client Name -->
                        <td>{{ $portfolio->client_name ?? '—' }}</td>

                        <!-- Category -->
                        <td>{{ $portfolio->category?->name ?? '—' }}</td>

                          {{-- Status --}}
                    <td>

                        <span
                            class="badge toggle-status cursor-pointer bg-label-{{ $portfolio->is_active ? 'success' : 'danger' }}"
                            data-url="{{ route('admin.portfolios.togglestatus', $portfolio->uuid) }}">

                            {{ $portfolio->is_active ? 'Active' : 'Inactive' }}

                        </span>

                    </td>



                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.portfolios.createoredit', $portfolio->uuid) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>

                                <form action="{{ route('admin.portfolios.destroy', $portfolio->uuid) }}"
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
                            No Portfolios found.
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
