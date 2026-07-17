@extends('backend.layouts.app')

@section('title', 'Enquiries')

@section('content')

    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">Enquiries</h5>
        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Assigned</th>
                        <th>Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($rows as $index=>$row)
                        <tr>

                            <td>{{ $rows->firstItem() + $index }}</td>

                            <td>
                                @unless($row->is_read)
                                    <span class="badge bg-label-danger me-1">New</span>
                                @endunless
                                <strong>{{ $row->name }}</strong>
                                <div class="text-muted small">{{ $row->company_name }}</div>
                            </td>

                            <td>{{ $row->email }}</td>

                            <td>{{ $row->phone }}</td>

                            <td>{{ $row->service_interest }}</td>

                            <td>
                                <span class="badge bg-label-primary">
                                    {{ ucfirst($row->status) }}
                                </span>
                            </td>

                            <td>{{ $row->assignedUser->name ?? '—' }}</td>

                            <td>{{ $row->created_at->format('d M Y') }}</td>

                            <td class="text-center">

                                <a href="{{ route('admin.enquiries.details', $row->uuid) }}"
                                    class="btn btn-sm btn-outline-info">
                                    <i class="bx bx-show"></i>
                                </a>

                                  <form action="{{ route('admin.enquiries.destroy', $row->uuid) }}"
                                        method="POST" class="js-delete">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bx bx-trash"></i>
                                        </button>

                                    </form>


                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="text-center text-muted">
                                No enquiries found
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        @if ($rows->hasPages())
            <div class="card-footer">
                {{ $rows->links() }}
            </div>
        @endif

    </div>

@endsection
