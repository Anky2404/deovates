@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Industries')

@section('content')

<div class="card">

<div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Industries</h5>

    <div class="d-flex gap-2">
        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#industriesReorderModal">
            <i class="bx bx-sort-alt-2 me-1"></i> Reorder
        </button>

        <a href="{{ route('admin.marketing.industries.createoredit') }}"
           class="btn btn-primary">
            <i class="bx bx-plus"></i>
            Add Industry
        </a>
    </div>
</div>

<div class="table-responsive">

    <table class="table table-hover align-middle mb-0">

        <thead class="table-dark">
            <tr>
                <th width="60">#</th>
                <th width="80">Image</th>
                <th width="80" class="text-center">Icon</th>
                <th>Name</th>
                <th width="180">Slug</th>
                <th width="100" class="text-center">Status</th>
                <th width="100" class="text-center">Featured</th>
                <th width="130">Created</th>
                <th width="120" class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>

            @forelse($rows as $index => $row)

                <tr>

                    {{-- Sr No --}}
                    <td>
                        {{ $rows->firstItem() + $index }}
                    </td>

                    {{-- Image --}}
                    <td>

                        @if(!empty($row->image))

                            <img src="{{ asset('storage/' . $row->image) }}"
                                 alt="{{ $row->name }}"
                                 width="50"
                                 height="50"
                                 class="rounded border object-fit-cover">

                        @else

                            <div class="bg-light border rounded d-flex align-items-center justify-content-center"
                                 style="width:50px;height:50px;">
                                <small class="text-muted">N/A</small>
                            </div>

                        @endif

                    </td>

                    {{-- Icon --}}
                    <td class="text-center">

                        @if(!empty($row->icon))

                            <i class="{{ $row->icon }} fs-3 text-primary"></i>

                        @else

                            <span class="text-muted">—</span>

                        @endif

                    </td>

                    {{-- Name --}}
                    <td>

                        <div class="fw-semibold">
                            {{ $row->name }}
                        </div>

                        @if(!empty($row->description))
                            <small class="text-muted">
                                {{ \Illuminate\Support\Str::limit(strip_tags($row->description), 60) }}
                            </small>
                        @endif

                    </td>

                    {{-- Slug --}}
                    <td>
                        <code>{{ $row->slug }}</code>
                    </td>

                    {{-- Status --}}
                    <td class="text-center">
                        <div class="form-check form-switch mb-0 d-flex justify-content-center">
                            <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                role="switch"
                                data-url="{{ route('admin.marketing.industries.togglestatus', $row->uuid) }}"
                                {{ $row->is_active ? 'checked' : '' }}>
                        </div>
                    </td>

                    {{-- Featured --}}
                    <td class="text-center">
                        <div class="form-check form-switch mb-0 d-flex justify-content-center">
                            <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                role="switch"
                                data-url="{{ route('admin.marketing.industries.togglefeatured', $row->uuid) }}"
                                {{ $row->is_featured ? 'checked' : '' }}>
                        </div>
                    </td>

                    {{-- Created Date --}}
                    <td>
                        {{ $row->created_at?->format('d M Y') }}
                    </td>

                    {{-- Action --}}
                    <td>

                        <div class="d-flex justify-content-center gap-1">

                            <a href="{{ route('admin.marketing.industries.createoredit', $row->uuid) }}"
                               class="btn btn-sm btn-outline-primary"
                               title="Edit">

                                <i class="bx bx-edit"></i>

                            </a>

                            <form action="{{ route('admin.marketing.industries.destroy', $row->uuid) }}"
                                  method="POST"
                                  class="js-delete">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Delete">

                                    <i class="bx bx-trash"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="9" class="text-center py-5 text-muted">
                        No industries found.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@if($rows->hasPages())

    <div class="card-footer">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

            <small class="text-muted">
                Showing
                {{ $rows->firstItem() }}
                to
                {{ $rows->lastItem() }}
                of
                {{ $rows->total() }}
                entries
            </small>

            {{ $rows->links() }}

        </div>

    </div>

@endif

</div>

@include('backend.partials.reorder-modal', [
    'modalId' => 'industriesReorderModal',
    'rows' => $reorderRows,
    'reorderUrl' => route('admin.marketing.industries.reorder'),
    'title' => 'Reorder Industries',
    'labelField' => 'name',
    'imageField' => 'image',
])

@endsection

@push('styles')

<style>
    .cursor-pointer{
        cursor:pointer;
    }

    .object-fit-cover{
        object-fit:cover;
    }

    .table td,
    .table th{
        vertical-align:middle !important;
    }

    .table tbody tr:hover{
        background:#f8f9fa;
    }
</style>

@endpush
