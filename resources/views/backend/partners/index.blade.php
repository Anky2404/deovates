@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Partners')

@section('content')

<div class="card">


<div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Partners</h5>

    <div class="d-flex gap-2">
        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#partnersReorderModal">
            <i class="bx bx-sort-alt-2 me-1"></i> Reorder
        </button>

        <a href="{{ route('admin.marketing.partners.createoredit') }}"
           class="btn btn-primary">
            <i class="bx bx-plus"></i>
            Add Partner
        </a>
    </div>
</div>

<div class="table-responsive">

    <table class="table table-hover align-middle mb-0">

        <thead class="table-dark">
            <tr>
                <th width="60">#</th>
                <th width="80">Logo</th>
                <th>Name</th>
                <th>Type</th>
                <th>Industry</th>
                <th>Website</th>
                <th width="100">Featured</th>
                <th width="100">Status</th>
                <th width="120" class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>

            @forelse($rows as $index => $row)

                <tr>

                    <td>
                        {{ $rows->firstItem() + $index }}
                    </td>

                    {{-- Logo --}}
                    <td>

                        @if(!empty($row->logo))

                            <img src="{{ asset('storage/' . $row->logo) }}"
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

                    {{-- Name --}}
                    <td>

                        <div class="fw-semibold">
                            {{ $row->name }}
                        </div>

                        <small class="text-muted">
                            {{ $row->slug }}
                        </small>

                    </td>

                    {{-- Type --}}
                    <td>
                        {{ $row->type ?? '-' }}
                    </td>

                    {{-- Industry --}}
                    <td>
                        {{ $row->industry ?? '-' }}
                    </td>

                    {{-- Website --}}
                    <td>

                        @if($row->website_url)

                            <a href="{{ $row->website_url }}"
                               target="_blank"
                               class="text-decoration-none">

                                <i class="bx bx-link-external"></i>
                                Visit

                            </a>

                        @else

                            -

                        @endif

                    </td>

                    {{-- Featured --}}
                    <td>
                        <div class="form-check form-switch mb-0">
                            <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                role="switch"
                                data-url="{{ route('admin.marketing.partners.togglefeatured', $row->uuid) }}"
                                {{ $row->is_featured ? 'checked' : '' }}>
                        </div>
                    </td>

                    {{-- Status --}}
                    <td>
                        <div class="form-check form-switch mb-0">
                            <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                role="switch"
                                data-url="{{ route('admin.marketing.partners.togglestatus', $row->uuid) }}"
                                {{ $row->is_active ? 'checked' : '' }}>
                        </div>
                    </td>



                    {{-- Action --}}
                    <td>

                        <div class="d-flex justify-content-center gap-1">

                            <a href="{{ route('admin.marketing.partners.createoredit', $row->uuid) }}"
                               class="btn btn-sm btn-outline-primary">

                                <i class="bx bx-edit"></i>

                            </a>

                            <form action="{{ route('admin.marketing.partners.destroy', $row->uuid) }}"
                                  method="POST"
                                  class="js-delete">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger">

                                    <i class="bx bx-trash"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="9"
                        class="text-center py-5 text-muted">

                        No partners found.

                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@if($rows->hasPages())

    <div class="card-footer">

        <div class="d-flex justify-content-between align-items-center">

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
    'modalId' => 'partnersReorderModal',
    'rows' => $reorderRows,
    'reorderUrl' => route('admin.marketing.partners.reorder'),
    'title' => 'Reorder Partners',
    'labelField' => 'name',
    'imageField' => 'logo',
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
