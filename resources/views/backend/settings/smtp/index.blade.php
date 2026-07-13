@extends('backend.layouts.app')

@section('title', 'Deovate World | SMTP Settings')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">SMTP Setting Lists</h5>

        <a href="{{ route('admin.settings.smtp.createoredit') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Create SMTP Setting
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Host</th>
                    <th>Port</th>
                    <th>Encryption</th>
                    <th>From Email</th>
                    <th>Default</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $smtp)
                    <tr>
                        <!-- SN -->
                        <td>{{ ($rows->currentPage() - 1) * $rows->perPage() + $index + 1 }}</td>

                        <!-- Name -->
                        <td>
                            <strong>{{ $smtp->name }}</strong>
                        </td>

                        <!-- Host -->
                        <td>
                            <span class="text-muted">{{ $smtp->host }}</span>
                        </td>

                        <!-- Port -->
                        <td>{{ $smtp->port }}</td>

                        <!-- Encryption -->
                        <td>
                            <span class="badge bg-label-info text-uppercase">{{ $smtp->encryption ?? 'none' }}</span>
                        </td>

                        <!-- From Email -->
                        <td>
                            <span class="text-muted">{{ $smtp->from_email }}</span>
                        </td>

                        <!-- Default -->
                        <td>
                            @if ($smtp->is_default)
                                <span class="badge bg-label-primary">Default</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        {{-- Status --}}
                        <td>
                            <span
                                class="badge toggle-status cursor-pointer bg-label-{{ $smtp->is_active ? 'success' : 'danger' }}"
                                data-url="{{ route('admin.settings.smtp.togglestatus', $smtp->uuid) }}">
                                {{ $smtp->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.settings.smtp.createoredit', $smtp->uuid) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>

                                <form action="{{ route('admin.settings.smtp.destroy', $smtp->uuid) }}"
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
                        <td colspan="9" class="text-center text-muted py-4">
                            No SMTP settings found.
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
