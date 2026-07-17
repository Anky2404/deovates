@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Form Layouts')

@section('content')
    <div class="card">

        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Form Layout List</h5>

            <!-- Create Form Layout Button -->
            <a href="{{ route('admin.pages.forms.createoredit') }}" class="btn btn-primary">
                <i class="icon-base bx bx-plus"></i>
                Create Form Layout
            </a>
        </div>

        <!-- Table -->
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Heading</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="table-border-bottom-0">
                    @forelse ($rows as $index => $layout)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td><strong>{{ $layout->name }}</strong></td>
                            <td>{{ $layout->slug }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($layout->heading, 50) }}</td>
                            {{-- Status --}}
                            <td>
                                <div class="form-check form-switch mb-0">
                                    <input type="checkbox" class="form-check-input toggle-status-switch cursor-pointer"
                                        role="switch"
                                        data-url="{{ route('admin.pages.forms.togglestatus', $layout->uuid) }}"
                                        {{ $layout->is_active ? 'checked' : '' }}>
                                </div>
                            </td>
                            <!-- Actions -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.pages.forms.details', $layout->uuid) }}"
                                        class="btn btn-sm btn-outline-info d-flex align-items-center gap-1">
                                        <i class="icon-base bx bx-show"></i>
                                        Details
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.pages.forms.createoredit', $layout->uuid) }}"
                                        class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                        <i class="icon-base bx bx-edit-alt"></i>
                                        Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.pages.forms.destroy', $layout->uuid) }}" method="POST"
                                        class="js-delete">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1">
                                            <i class="icon-base bx bx-trash"></i>
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No form layouts found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if ($rows instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="mt-3 d-flex justify-content-end">
                    {{ $rows->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>

    </div>
@endsection
