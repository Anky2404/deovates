@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Emails')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Email Logs</h5>

        {{-- <a href="{{ route('admin.emails.createoredit') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Create Email
        </a> --}}
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">

            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Subject</th>
                    <th>Direction</th>
                    <th>Status</th>
                    <th>Sent At</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">

                @forelse ($emails as $index => $email)

                    <tr>

                        <!-- SN -->
                        <td>{{ $emails->firstItem() + $index }}</td>

                        <!-- From -->
                        <td>
                            <strong>{{ $email->from_name ?? '—' }}</strong>
                            <br>
                            <small class="text-muted">{{ $email->from_email }}</small>
                        </td>

                        <!-- To -->
                        <td>
                            <strong>{{ $email->to_name ?? '—' }}</strong>
                            <br>
                            <small class="text-muted">{{ $email->to_email }}</small>
                        </td>

                        <!-- Subject -->
                        <td>
                            <span class="text-dark">{{ $email->subject }}</span>
                        </td>

                        <!-- Direction -->
                        <td>
                            <span class="badge {{ $email->direction == 'incoming' ? 'bg-label-info' : 'bg-label-primary' }}">
                                {{ ucfirst($email->direction) }}
                            </span>
                        </td>

                        <!-- Status -->
                        <td>
                            <span
                                class="badge
                                {{ $email->status == 'sent' ? 'bg-label-success' : ($email->status == 'failed' ? 'bg-label-danger' : 'bg-label-warning') }}">
                                {{ ucfirst($email->status) }}
                            </span>
                        </td>

                        <!-- Sent Time -->
                        <td>
                            {{ $email->sent_at ? $email->sent_at->format('d M Y H:i') : '—' }}
                        </td>

                        <!-- Actions -->
                        <td class="text-center">

                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.emails.details', $email->uuid) }}"
                                   class="btn btn-sm btn-outline-info d-flex align-items-center gap-1">
                                    <i class="bx bx-show"></i> View
                                </a>

                                <a href="{{ route('admin.emails.createoredit', $email->uuid) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>

                                <form action="{{ route('admin.emails.destroy', $email->uuid) }}"
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
                        <td colspan="8" class="text-center text-muted py-4">
                            No Emails found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>
    </div>

    <!-- Pagination -->
    @if ($emails->hasPages())
        <div class="card-footer d-flex justify-content-end">
            {{ $emails->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>
@endsection
