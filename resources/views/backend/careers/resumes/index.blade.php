@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Resumes')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Resumes</h5>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Experience</th>
                    <th>Applications</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $resume)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $resume->full_name }}</strong></td>
                        <td>{{ $resume->email }}</td>
                        <td>{{ $resume->phone ?? '—' }}</td>
                        <td>{{ $resume->experience_years ? $resume->experience_years . ' yrs' : '—' }}</td>
                        <td>{{ $resume->applications->count() }}</td>
                        <td>
                            <span class="badge bg-label-{{ $resume->is_active ? 'success' : 'danger' }}">
                                {{ $resume->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.careers.resumes.view', $resume->uuid) }}"
                                   class="btn btn-sm btn-outline-success d-flex align-items-center gap-1">
                                    <i class="bx bx-show-alt"></i> View
                                </a>

                                <form action="{{ route('admin.careers.resumes.destroy', $resume->uuid) }}"
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
                            No Resumes found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        {{ $rows->links() }}
    </div>

</div>
@endsection
