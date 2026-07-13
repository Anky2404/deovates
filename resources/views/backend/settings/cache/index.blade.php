@extends('backend.layouts.app')

@section('title', 'Deovate World | Cache')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header">
        <h5 class="mb-0">Application Cache</h5>
    </div>

    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="text-muted small">Active Cache Driver</div>
                <div class="fw-semibold">{{ $currentDriver }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-muted small">Available Cache Stores</div>
                <div class="fw-semibold">
                    @forelse ($availableDrivers as $driver)
                        <span class="badge bg-label-{{ $driver === $currentDriver ? 'success' : 'secondary' }} me-1">
                            {{ $driver }}
                        </span>
                    @empty
                        <span class="text-muted">—</span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer text-end">
        <form action="{{ route('admin.settings.cache.clear') }}" method="POST" class="js-delete d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="bx bx-trash me-1"></i>
                Clear Cache
            </button>
        </form>
    </div>

</div>
@endsection
