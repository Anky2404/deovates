@extends('backend.layouts.app')

@section('title', 'Comment Details')

@section('content')

<div class="card">


<div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Comment Details</h5>

    <a href="{{ route('admin.blogs.comments.index') }}"
       class="btn btn-sm btn-secondary">
        <i class="bx bx-arrow-back"></i> Back
    </a>
</div>

<div class="card-body">

    <div class="row g-4">

        {{-- BLOG --}}
        <div class="col-md-6">
            <strong>Blog</strong>
            <p>
                {{ $comment->blog->title ?? 'N/A' }}
            </p>
        </div>

        {{-- PARENT COMMENT --}}
        <div class="col-md-6">
            <strong>Parent Comment</strong>
            <p>
                {{ $comment->parent->name ?? 'Root Comment' }}
            </p>
        </div>

        {{-- NAME --}}
        <div class="col-md-6">
            <strong>Name</strong>
            <p>{{ $comment->name }}</p>
        </div>

        {{-- EMAIL --}}
        <div class="col-md-6">
            <strong>Email</strong>
            <p>{{ $comment->email }}</p>
        </div>

        {{-- WEBSITE --}}
        <div class="col-md-6">
            <strong>Website</strong>
            <p>
                @if($comment->website)
                    <a href="{{ $comment->website }}"
                       target="_blank">
                        {{ $comment->website }}
                    </a>
                @else
                    —
                @endif
            </p>
        </div>

        {{-- USER --}}
        <div class="col-md-6">
            <strong>User</strong>
            <p>
                {{ $comment->user->name ?? 'Guest User' }}
            </p>
        </div>

        {{-- LIKES --}}
        <div class="col-md-6">
            <strong>Likes</strong>
            <p>
                <span class="badge bg-label-success">
                    {{ $comment->likes }}
                </span>
            </p>
        </div>

        {{-- DISLIKES --}}
        <div class="col-md-6">
            <strong>Dislikes</strong>
            <p>
                <span class="badge bg-label-danger">
                    {{ $comment->dislikes }}
                </span>
            </p>
        </div>

        {{-- STATUS --}}
        <div class="col-md-6">
            <strong>Status</strong>
            <p>
                <span class="badge bg-label-primary">
                    {{ ucfirst($comment->status) }}
                </span>
            </p>
        </div>

        {{-- ACTIVE --}}
        <div class="col-md-6">
            <strong>Active Status</strong>
            <p>
                <span class="badge bg-label-{{ $comment->is_active ? 'success' : 'danger' }}">
                    {{ $comment->is_active ? 'Active' : 'Inactive' }}
                </span>
            </p>
        </div>

        {{-- REPORTED --}}
        <div class="col-md-6">
            <strong>Reported</strong>
            <p>
                <span class="badge bg-label-{{ $comment->is_reported ? 'warning' : 'success' }}">
                    {{ $comment->is_reported ? 'Reported' : 'Clean' }}
                </span>
            </p>
        </div>

        {{-- IP --}}
        <div class="col-md-6">
            <strong>IP Address</strong>
            <p>{{ $comment->ip_address ?? '—' }}</p>
        </div>

        {{-- COMMENT --}}
        <div class="col-md-12">
            <strong>Comment</strong>

            <div class="border rounded p-3 mt-2 bg-light">
                {!! nl2br(e($comment->comment)) !!}
            </div>
        </div>

        {{-- USER AGENT --}}
        <div class="col-md-12">
            <strong>User Agent</strong>

            <div class="border rounded p-3 mt-2 bg-light small text-muted">
                {{ $comment->user_agent ?? '—' }}
            </div>
        </div>

        {{-- CREATED --}}
        <div class="col-md-6">
            <strong>Created At</strong>
            <p>
                {{ $comment->created_at?->format('d M Y h:i A') }}
            </p>
        </div>

        {{-- UPDATED --}}
        <div class="col-md-6">
            <strong>Updated At</strong>
            <p>
                {{ $comment->updated_at?->format('d M Y h:i A') }}
            </p>
        </div>

    </div>

    <hr class="my-4">

    {{-- UPDATE STATUS FORM --}}
    <form method="POST"
          action="{{ route('admin.blogs.comments.saveorupdate', $comment->uuid) }}" method="POST">

        @csrf
       

        <div class="row g-3">

            <input type="hidden" name="blog_id" value="{{$comment->blog_id}}">
            <input type="hidden" name="parent_id" value="{{$comment->parent_id}}">
            <input type="hidden" name="name" value="{{$comment->name}}">
            <input type="hidden" name="email" value="{{$comment->email}}">
            <input type="hidden" name="comment" value="{{$comment->comment}}">

            <div class="col-md-4">

                <label class="form-label">
                    Comment Status
                </label>

                <select name="status"
                        class="form-control">

                    <option value="pending"
                        {{ $comment->status == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="approved"
                        {{ $comment->status == 'approved' ? 'selected' : '' }}>
                        Approved
                    </option>

                    <option value="rejected"
                        {{ $comment->status == 'rejected' ? 'selected' : '' }}>
                        Rejected
                    </option>

                </select>

            </div>

            <div class="col-md-4">

                <label class="form-label">
                    Active Status
                </label>

                <select name="is_active"
                        class="form-control">

                    <option value="1"
                        {{ $comment->is_active ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0"
                        {{ !$comment->is_active ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>

            </div>

            <div class="col-md-4">

                <label class="form-label">
                    Report Status
                </label>

                <select name="is_reported"
                        class="form-control">

                    <option value="0"
                        {{ !$comment->is_reported ? 'selected' : '' }}>
                        Clean
                    </option>

                    <option value="1"
                        {{ $comment->is_reported ? 'selected' : '' }}>
                        Reported
                    </option>

                </select>

            </div>

        </div>

        <div class="mt-4 text-end">

            <button class="btn btn-primary">
                Update Comment
            </button>

        </div>

    </form>

</div>


</div>

@endsection
