@extends('backend.layouts.app')

@section('title', 'Deovate World | Careers')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Career Lists</h5>

        <a href="{{ route('admin.careers.createoredit') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Create Career
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>Title</th>
                    <th>Department</th>
                    <th>Openings</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $career)
                    <tr>

                        <!-- SN -->
                        <td>{{ $index + 1 }}</td>

                        <!-- Title -->
                        <td>
                            <strong>{{ $career->title }}</strong>
                            <br>
                            <small class="text-muted">{{ $career->slug }}</small>
                        </td>

                        <!-- Department -->
                        <td>
                            {{ $career->department->name ?? '—' }}
                        </td>


                        <!-- Openings -->
                        <td>
                            {{ $career->openings ?? 1 }}
                        </td>

                        {{-- Status --}}
                                <td>
                                    <span
                                        class="badge toggle-status cursor-pointer bg-label-{{ $career->is_active ? 'success' : 'danger' }}"
                                        data-url="{{ route('admin.careers.togglestatus', $career->uuid) }}">
                                        {{ $career->is_active ? 'Active' : 'Inactive' }}
                                    </span>


                            @if($career->is_featured)
                                <span class="badge bg-label-warning ms-1">Featured</span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.careers.createoredit', $career->uuid) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>

                                <form action="{{ route('admin.careers.destroy', $career->uuid) }}"
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
                        <td colspan="8" class="text-center text-muted py-4">
                            No Careers found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
