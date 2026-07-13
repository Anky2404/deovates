@extends('backend.layouts.app')

@section('title', 'Email Templates')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Email Template Lists</h5>

        <a href="{{ route('admin.emails.templates.createoredit') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Create Template
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Module</th>
                    <th>Language</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">

                @forelse ($rows as $index => $template)

                <tr>

                    <!-- SN -->
                    <td>{{ $rows->firstItem() + $index }}</td>

                    <!-- Name -->
                    <td>
                        <strong>{{ $template->name }}</strong>
                        <div class="small text-muted">{{ $template->slug }}</div>
                    </td>

                    <!-- Subject -->
                    <td>{{ $template->subject }}</td>

                    <!-- Module -->
                    <td>
                        <span class="badge bg-label-info">
                            {{ $template->module ?? '—' }}
                        </span>
                    </td>

                    <!-- Language -->
                    <td>
                        {{ $template->language ?? '—' }}
                    </td>

                    <!-- Status -->
                    <td>
                         <span
                                class="badge toggle-status cursor-pointer bg-label-{{$template->is_active ? 'success' : 'danger' }}"
                                data-url="{{ route('admin.emails.templates.togglestatus',$template->uuid) }}">
                                {{$template->is_active ? 'Active' : 'Inactive' }}
                            </span>
                    </td>

                    <!-- Actions -->
                    <td class="text-center">

                        <div class="d-flex justify-content-center gap-2">

                            <!-- Details -->
                            <a href="{{ route('admin.emails.templates.details', $template->uuid) }}"
                               class="btn btn-sm btn-outline-info d-flex align-items-center gap-1">
                                <i class="bx bx-show"></i> Details
                            </a>

                            <!-- Edit -->
                            <a href="{{ route('admin.emails.templates.createoredit', $template->uuid) }}"
                               class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                <i class="bx bx-edit-alt"></i> Edit
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('admin.emails.templates.destroy', $template->uuid) }}"
                                  method="POST"
                                  class="js-delete">

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
                        No Email Templates found.
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
