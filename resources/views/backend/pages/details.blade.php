@extends('backend.layouts.app')

@section('title', 'Page Details')

@section('content')
<div class="card">

    <!-- HEADER -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Page Details</h5>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.pages.createoredit', $page->uuid) }}" class="btn btn-primary">
                <i class="icon-base bx bx-edit-alt"></i> Edit
            </a>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                Back
            </a>
        </div>
    </div>

    <div class="card-body">

        <!-- BASIC INFO -->
        <div class="row mb-4">
            <div class="col-md-3">
                <strong>ID</strong><br>
                {{ $page->id }}
            </div>

            <div class="col-md-3">
                <strong>UUID</strong><br>
                {{ $page->uuid }}
            </div>

            <div class="col-md-3">
                <strong>Page Name</strong><br>
                {{ $page->name }}
            </div>

            <div class="col-md-3">
                <strong>Slug</strong><br>
                {{ $page->slug }}
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <strong>Template</strong><br>
                {{ $page->template->name ?? '-' }}
            </div>

            <div class="col-md-3">
                <strong>Status</strong><br>
                <span class="badge bg-label-{{ $page->is_active ? 'success' : 'secondary' }}">
                    {{ $page->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>

            <div class="col-md-3">
                <strong>Published</strong><br>
                <span class="badge bg-label-{{ $page->is_published ? 'success' : 'secondary' }}">
                    {{ $page->is_published ? 'Published' : 'Draft' }}
                </span>
            </div>

            <div class="col-md-3">
                <strong>Views</strong><br>
                {{ $page->views }}
            </div>
        </div>

        <hr>

        <!-- SECTIONS -->
        <div class="mb-3">
            <label class="form-label">Sections attached to this Page</label>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Section</th>
                            <th>Slug</th>
                            <th>Form</th>
                            <th>Order</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($page->sections as $section)
                            <tr>
                                <td>{{ $section->name }}</td>
                                <td><code>{{ $section->slug }}</code></td>
                                <td>{{ $section->form->name ?? '-' }}</td>
                                <td>{{ $section->pivot->display_order }}</td>
                                <td>
                                    <span class="badge bg-label-{{ $section->pivot->is_active ? 'success' : 'secondary' }}">
                                        {{ $section->pivot->is_active ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No sections attached to this page.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <a href="{{ route('admin.pages.createoredit', $page->uuid) }}" class="btn btn-sm btn-outline-primary">
                Manage Sections &amp; Content
            </a>
        </div>

    </div>

</div>
@endsection
