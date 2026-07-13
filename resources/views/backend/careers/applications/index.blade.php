@extends('backend.layouts.app')

@section('title', 'Career Applications')

@section('content')
    <div class="card">

        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Career Applications</h5>
        </div>

        <!-- Table -->
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>SN</th>
                        <th>Applicant Name</th>
                        <th>Email</th>
                    {{--     <th>Phone</th> --}}
                        <th>Department</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="table-border-bottom-0">
                    @forelse ($rows as $index => $app)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $app->full_name }}</td>
                            <td>{{ $app->email }}</td>
                            {{--  <td>{{ $app->phone }}</td>--}}
                            <td>{{ $app->career->title ?? '—' }}</td>
                            <td>
                                <span class="badge 
                                        @if($app->status == 'new') bg-primary
                                        @elseif($app->status == 'shortlisted') bg-success
                                        @elseif($app->status == 'rejected') bg-danger
                                        @else bg-secondary
                                        @endif">
                                    {{ ucfirst($app->status) }}
                                </span>
                            </td>
                            <!-- Actions -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('admin.careers.applications.details', $app->uuid) }}"
                                        class="btn btn-sm btn-outline-success d-flex align-items-center gap-1">
                                        <i class="bx bx-show-alt"></i> Details
                                    </a>

                                    <form action="{{ route('admin.careers.applications.destroy', $app->uuid) }}" method="POST"
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
                            <td colspan="14" class="text-center text-muted py-4">
                                No Career Applications found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection