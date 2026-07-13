@extends('backend.layouts.app')

@section('title','Newsletter Subscribers')

@section('content')

<div class="card">

    <div class="card-header">
        <h5 class="mb-0">Newsletter Subscribers</h5>
    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Subscribed</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($rows as $index => $row)

                <tr>

                    <td>{{ $rows->firstItem() + $index }}</td>

                    <td>
                        <strong>{{ $row->email }}</strong>
                    </td>

                    <td>{{ $row->name ?? '—' }}</td>

                    <td> <span
                                    class="badge toggle-status cursor-pointer bg-label-{{ $row->is_active ? 'success' : 'danger' }}"
                                    data-url="{{ route('admin.newsletter-subscribers.togglestatus', $row->uuid) }}">
                                    {{ $row->is_active ? 'Active' : 'Inactive' }}
                                </span>
                    </td>

                    <td>
                        {{ $row->subscribed_at ? $row->subscribed_at->format('d M Y') : '—' }}
                    </td>

                    <td class="text-center">

                        <div class="d-flex justify-content-center gap-2">

                            <a href="{{ route('admin.newsletter-subscribers.details',$row->uuid) }}"
                               class="btn btn-sm btn-outline-info">
                                <i class="bx bx-show"></i>
                            </a>

                            <form action="{{ route('admin.newsletter-subscribers.destroy',$row->uuid) }}"
                                  method="POST"
                                  class="d-inline js-delete">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bx bx-trash"></i>
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        No subscribers found
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @if($rows->hasPages())

    <div class="card-footer">
        {{ $rows->links() }}
    </div>

    @endif

</div>

@endsection
