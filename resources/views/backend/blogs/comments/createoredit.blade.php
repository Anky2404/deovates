@extends('backend.layouts.app')

@section('title', isset($comment)
? config('constants.BUSINESS.name') . ' | Edit Comment'
: config('constants.BUSINESS.name') . ' | Create Comment')

@section('content')

<div class="card">
<div class="card-header">
    <h5 class="mb-0">
        {{ isset($comment) ? 'Edit' : 'Create' }}
        Blog Comment
    </h5>
</div>

<form method="POST"
      action="{{ route('admin.blogs.comments.saveorupdate', $comment->uuid ?? null) }}">

    @csrf

    <div class="card-body row g-3">

        {{-- BLOG --}}
        <div class="col-md-6">
            <label class="form-label">Blog</label>

            <select name="blog_id"
                    class="form-control"
                    required>

                <option value="">
                    Select Blog
                </option>

                @foreach($blogs as $blog)

                    <option value="{{ $blog->id }}"
                        {{ old('blog_id', $comment->blog_id ?? '') == $blog->id ? 'selected' : '' }}>
                        {{ $blog->title }}
                    </option>

                @endforeach

            </select>
        </div>

        {{-- USER --}}
        <div class="col-md-6">
            <label class="form-label">
                User (Optional)
            </label>

            <select name="user_id"
                    class="form-control">

                <option value="">
                    Guest User
                </option>

                @foreach($users as $user)

                    <option value="{{ $user->id }}"
                        {{ old('user_id', $comment->user_id ?? '') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>

                @endforeach

            </select>
        </div>

        {{-- PARENT COMMENT --}}
        <div class="col-md-6">
            <label class="form-label">
                Parent Comment
            </label>

            <input type="number"
                   name="parent_id"
                   class="form-control"
                   value="{{ old('parent_id', $comment->parent_id ?? '') }}"
                   placeholder="Optional">
        </div>

        {{-- NAME --}}
        <div class="col-md-6">
            <label class="form-label">
                Name
            </label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name', $comment->name ?? '') }}"
                   required>
        </div>

        {{-- EMAIL --}}
        <div class="col-md-6">
            <label class="form-label">
                Email
            </label>

            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email', $comment->email ?? '') }}"
                   required>
        </div>

        {{-- WEBSITE --}}
        <div class="col-md-6">
            <label class="form-label">
                Website
            </label>

            <input type="url"
                   name="website"
                   class="form-control"
                   value="{{ old('website', $comment->website ?? '') }}">
        </div>

        {{-- COMMENT --}}
        <div class="col-md-12">
            <label class="form-label">
                Comment
            </label>

            <textarea name="comment"
                      rows="6"
                      class="form-control"
                      required>{{ old('comment', $comment->comment ?? '') }}</textarea>
        </div>

        {{-- STATUS --}}
        <div class="col-md-4">
            <label class="form-label">
                Status
            </label>

            <select name="status"
                    class="form-control">

                <option value="pending"
                    {{ old('status', $comment->status ?? 'pending') == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="approved"
                    {{ old('status', $comment->status ?? '') == 'approved' ? 'selected' : '' }}>
                    Approved
                </option>

                <option value="rejected"
                    {{ old('status', $comment->status ?? '') == 'rejected' ? 'selected' : '' }}>
                    Rejected
                </option>

            </select>
        </div>

        {{-- LIKES --}}
        <div class="col-md-4">
            <label class="form-label">
                Likes
            </label>

            <input type="number"
                   min="0"
                   name="likes"
                   class="form-control"
                   value="{{ old('likes', $comment->likes ?? 0) }}">
        </div>

        {{-- DISLIKES --}}
        <div class="col-md-4">
            <label class="form-label">
                Dislikes
            </label>

            <input type="number"
                   min="0"
                   name="dislikes"
                   class="form-control"
                   value="{{ old('dislikes', $comment->dislikes ?? 0) }}">
        </div>

        {{-- ACTIVE --}}
        <div class="col-md-6">
            <div class="form-check form-switch">

                <input class="form-check-input"
                       type="checkbox"
                       name="is_active"
                       value="1"
                       {{ old('is_active', $comment->is_active ?? 1) ? 'checked' : '' }}>

                <label class="form-check-label">
                    Active
                </label>

            </div>
        </div>

        {{-- REPORTED --}}
        <div class="col-md-6">
            <div class="form-check form-switch">

                <input class="form-check-input"
                       type="checkbox"
                       name="is_reported"
                       value="1"
                       {{ old('is_reported', $comment->is_reported ?? 0) ? 'checked' : '' }}>

                <label class="form-check-label">
                    Reported
                </label>

            </div>
        </div>

    </div>

    <div class="card-footer text-end">

        <a href="{{ route('admin.blogs.comments.index') }}"
           class="btn btn-secondary">
            Cancel
        </a>

        <button class="btn btn-primary">
            {{ isset($comment) ? 'Update' : 'Create' }}
        </button>

    </div>

</form>

</div>

@endsection
