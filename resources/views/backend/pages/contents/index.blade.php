@extends('backend.layouts.app')

@section('title', 'Page Contents')

@section('content')
<div class="card">

    <!-- Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Page Content List</h5>

        <a href="{{ route('admin.pages.contents.createoredit') }}" class="btn btn-primary">
            <i class="icon-base bx bx-plus"></i>
            Create Content
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Page</th>
                    <th>Form</th>
                    <th>Position</th>
                    <th>Column</th>
                    <th>Order</th>
                    <th>Device</th>
                    <th>Views</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($rows as $index => $content)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td>
                            <strong>{{ $content->page->name ?? '-' }}</strong>
                        </td>

                        <td>
                            {{ $content->form->name ?? '-' }}
                        </td>

                        <td>
                            <span class="badge bg-label-primary">
                                {{ $content->position ?? '-' }}
                            </span>
                        </td>

                        <td>{{ $content->column ?? '-' }}</td>

                        <td>{{ $content->display_order }}</td>

                        <td>
                            <span class="badge bg-label-info">
                                {{ $content->device ?? 'All' }}
                            </span>
                        </td>

                        <td>{{ $content->views }}</td>

                        {{-- Status --}}
                        <td>
                            <span
                                class="badge toggle-status cursor-pointer bg-label-{{ $content->is_active ? 'success' : 'danger' }}"
                                data-url="{{ route('admin.pages.contents.togglestatus', $content->uuid) }}">
                                {{ $content->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <!-- Edit -->
                                <a href="{{ route('admin.pages.contents.createoredit', $content->uuid) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="icon-base bx bx-edit-alt"></i>
                                    Edit
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('admin.pages.contents.destroy', $content->uuid) }}"
                                    method="POST" class="js-delete">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-sm btn-outline-danger">
                                        <i class="icon-base bx bx-trash"></i>
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-4">
                            No page contents found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        @if ($rows instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="mt-3 d-flex justify-content-end">
                {{ $rows->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

</div>
@endsection
