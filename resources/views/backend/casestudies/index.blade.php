@extends('backend.layouts.app')

@section('title', 'Deovate World | Case Studies')

@section('content')
    <div class="card">

        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Case Study Lists</h5>

            <a href="{{ route('admin.casestudies.createoredit') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Create Case Study
            </a>
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
                                <span
                                    class="badge toggle-status cursor-pointer bg-label-{{ $caseStudy->is_active ? 'success' : 'danger' }}"
                                    data-url="{{ route('admin.casestudies.togglestatus', $caseStudy->uuid) }}">
                                    {{ $caseStudy->is_active ? 'Active' : 'Inactive' }}
                                </span>

                                @if ($caseStudy->is_featured)
                                    <span class="badge bg-label-warning ms-1">
                                        Featured
                                    </span>
                                @endif
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
                            <td colspan="9" class="text-center text-muted py-4">
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
@endsection
