@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Case Studies')

@section('content')
    <div class="card">

        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Case Study Lists</h5>

            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#casestudiesReorderModal">
                    <i class="bx bx-sort-alt-2 me-1"></i> Reorder
                </button>

                <a href="{{ route('admin.casestudies.createoredit') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>
                    Create Case Study
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
                        <th>Category</th>
                        <th>Views</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="table-border-bottom-0">
                    @forelse ($rows as $index => $caseStudy)
                        <tr>

                            <!-- SN -->
                            <td>{{ $rows->firstItem() + $index }}</td>

                            <!-- Image -->
                            <td>
                                @if ($caseStudy->featured_image)
                                    <img src="{{ asset('storage/' . $caseStudy->featured_image) }}"
                                        alt="{{ $caseStudy->title }}" class="rounded" width="60">
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>

                            <!-- Title -->
                            <td>
                                <strong>{{ $caseStudy->title }}</strong>
                                <div class="small text-muted">
                                    {{ \Illuminate\Support\Str::limit($caseStudy->slug, 40) }}
                                </div>
                            </td>

                            <!-- Category -->
                            <td>
                                {{ $caseStudy->category->name ?? '—' }}
                            </td>

                            <!-- Views -->
                            <td>
                                <span class="badge bg-label-info">
                                    {{ number_format($caseStudy->views) }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td>
                                <div class="form-check form-switch mb-0">
                                    <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                        role="switch"
                                        data-url="{{ route('admin.casestudies.togglestatus', $caseStudy->uuid) }}"
                                        {{ $caseStudy->is_active ? 'checked' : '' }}>
                                </div>
                            </td>

                            {{-- Featured --}}
                            <td>
                                <div class="form-check form-switch mb-0">
                                    <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                        role="switch"
                                        data-url="{{ route('admin.casestudies.togglefeatured', $caseStudy->uuid) }}"
                                        {{ $caseStudy->is_featured ? 'checked' : '' }}>
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-2">

                                    {{-- <a href="{{ route('admin.casestudies.details', $caseStudy->uuid) }}"
                                   class="btn btn-sm btn-outline-info">
                                    <i class="bx bx-show"></i>
                                </a> --}}

                                    <a href="{{ route('admin.casestudies.createoredit', $caseStudy->uuid) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>

                                    <form action="{{ route('admin.casestudies.destroy', $caseStudy->uuid) }}"
                                        method="POST" class="js-delete">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bx bx-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                No Case Studies Found.
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
    'modalId'    => 'casestudiesReorderModal',
    'rows'       => $reorderRows,
    'reorderUrl' => route('admin.casestudies.reorder'),
    'title'      => 'Reorder Case Studies',
    'labelField' => 'title',
    'imageField' => 'featured_image',
])
@endsection
