@extends('backend.layouts.app')

@section('title', 'Website Audit Leads')

@section('content')

<div class="card">

    <div class="card-header">
        <h5 class="mb-0">Website Audit Leads (Speed / SEO Checker)</h5>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>URL</th>
                    <th>Status</th>
                    <th>Submitted</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($rows as $index => $row)
                    <tr>
                        <td>{{ $rows->firstItem() + $index }}</td>
                        <td>
                            <span class="badge bg-label-{{ $row->type === 'seo' ? 'info' : 'primary' }}">
                                {{ ucfirst($row->type) }}
                            </span>
                        </td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->phone ?? '—' }}</td>
                        <td>
                            <a href="{{ $row->url }}" target="_blank" rel="noopener">{{ \Illuminate\Support\Str::limit($row->url, 40) }}</a>
                        </td>
                        <td>
                            <span class="badge bg-label-{{ $row->status === 'completed' ? 'success' : ($row->status === 'partial' ? 'warning' : 'danger') }}">
                                {{ ucfirst($row->status) }}
                            </span>
                        </td>
                        <td>{{ $row->created_at->format('d M Y, h:i A') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.website-audit-leads.details', $row->uuid) }}"
                                   class="btn btn-sm btn-outline-info">
                                    <i class="bx bx-show"></i>
                                </a>
                                <form action="{{ route('admin.website-audit-leads.destroy', $row->uuid) }}"
                                      method="POST" class="js-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            No audit leads yet.
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
