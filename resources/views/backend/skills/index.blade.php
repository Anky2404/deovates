@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Skills')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Skill Lists</h5>

        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#skillsReorderModal">
                <i class="bx bx-sort-alt-2 me-1"></i> Reorder
            </button>

            <a href="{{ route('admin.skills.createoredit') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Create Skill
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $skill)
                    <tr>

                        <!-- SN -->
                        <td>{{ $index + 1 }}</td>

                        <!-- Icon -->
                        <td>
                            @if($skill->icon)
                                <i class="{{ $skill->icon }} fs-4 text-primary"></i>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        <!-- Name -->
                        <td>
                            <strong>{{ $skill->name }}</strong>
                        </td>

                        <!-- Slug -->
                        <td>
                            <span class="text-muted">{{ $skill->slug }}</span>
                        </td>

                        {{-- Status --}}
                        <td>
                            <div class="form-check form-switch mb-0">
                                <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                    role="switch"
                                    data-url="{{ route('admin.skills.togglestatus', $skill->uuid) }}"
                                    {{ $skill->is_active ? 'checked' : '' }}>
                            </div>
                        </td>

                        {{-- Featured --}}
                        <td>
                            <div class="form-check form-switch mb-0">
                                <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                    role="switch"
                                    data-url="{{ route('admin.skills.togglefeatured', $skill->uuid) }}"
                                    {{ $skill->is_featured ? 'checked' : '' }}>
                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.skills.createoredit', $skill->uuid) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>

                                <form action="{{ route('admin.skills.destroy', $skill->uuid) }}"
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
                            No Skills found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="card-footer">
        {{ $rows->links('pagination::bootstrap-5') }}
    </div>

</div>

@include('backend.partials.reorder-modal', [
    'modalId'    => 'skillsReorderModal',
    'rows'       => $reorderRows,
    'reorderUrl' => route('admin.skills.reorder'),
    'title'      => 'Reorder Skills',
    'labelField' => 'name',
])
@endsection
