@extends('backend.layouts.app')

@section('title', isset($blog) ? 'Edit Blog' : 'Create Blog')

@section('content')
    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">{{ isset($blog) ? 'Edit Blog' : 'Create Blog' }}</h5>
        </div>

        <form id="blogForm" method="POST" action="{{ route('admin.blogs.saveorupdate', $blog->uuid ?? null) }}"
            enctype="multipart/form-data">
            @csrf

            <div class="card-body row g-3">
                {{-- TITLE --}}
                <div class="col-md-6">
                    <label class="form-label">Title *</label>
                    <input type="text" id="title_input" name="title" class="form-control"
                        value="{{ old('title', $blog->title ?? '') }}" required>
                </div>

                {{-- SLUG --}}
                <div class="col-md-6">
                    <label class="form-label">Slug *</label>
                    <input type="text" id="slug_input" name="slug" class="form-control"
                        value="{{ old('slug', $blog->slug ?? '') }}" required>
                </div>

                {{-- EXCERPT --}}
                <div class="col-md-6">
                    <label class="form-label">Excerpt *</label>
                    <textarea name="excerpt" id="short_description" class="form-control" rows="3" required>
{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
                </div>
                {{-- IMAGES (FEATURED + OG in ONE COLUMN) --}}
                <div class="col-md-6">
                    {{-- FEATURED IMAGE --}}
                    <label class="form-label">Featured Image</label>
                    <input type="file" name="featured_image" class="form-control image-preview-input"
                        data-preview="#featuredImagePreview">

                    <img id="featuredImagePreview"
                        src="{{ !empty($blog->featured_image) ? asset('storage/' . $blog->featured_image) : 'https://placehold.co/130x130' }}"
                        class="mt-2 rounded border img-thumbnail" height="130" width="130">

                    <hr class="my-3">

                    {{-- OG IMAGE --}}
                    <label class="form-label">OG Image</label>
                    <input type="file" name="og_image" class="form-control image-preview-input"
                        data-preview="#ogImagePreview">

                    <img id="ogImagePreview"
                        src="{{ !empty($blog->og_image) ? asset('storage/' . $blog->og_image) : 'https://placehold.co/130x130' }}"
                        class="mt-2 rounded border img-thumbnail" height="130" width="130">
                </div>



                {{-- CATEGORY --}}
                <div class="col-md-4">
                    <label class="form-label">Category *</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- choose category --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $blog->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- AUTHOR --}}
                <div class="col-md-4">
                    <label class="form-label">Author *</label>
                    <select name="author_id" class="form-control" required>
                        <option value="">-- choose author --</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}"
                                {{ old('author_id', $blog->author_id ?? '') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- STATUS --}}
                <div class="col-md-4">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-control" required>
                        <option value="draft" {{ old('status', $blog->status ?? '') == 'draft' ? 'selected' : '' }}>Draft
                        </option>
                        <option value="published"
                            {{ old('status', $blog->status ?? '') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>




                {{-- CONTENT --}}
                <div class="col-md-12">
                    <label class="form-label">Content *</label>
                    <textarea name="content" id="description" class="form-control" rows="6" required>{{ old('content', $blog->content ?? '') }}</textarea>
                </div>




                {{-- CANONICAL URL --}}
                <div class="col-md-4">
                    <label class="form-label">Canonical URL</label>
                    <input type="url" name="canonical_url" class="form-control"
                        value="{{ old('canonical_url', $blog->canonical_url ?? '') }}">
                </div>



                {{-- PUBLISHED AT --}}
                <div class="col-md-4">
                    <label class="form-label">Published At</label>
                    <input type="datetime-local" name="published_at" class="form-control"
                        value="{{ old('published_at', isset($blog->published_at) ? $blog->published_at->format('Y-m-d\TH:i') : '') }}">
                </div>

                {{-- TAGS MULTI SELECT --}}
<div class="col-md-4">
    <label class="form-label">Tags</label>

    {{-- SELECT FIELD --}}
    <select id="tag_selector" class="form-control">
        <option value="">-- select tag --</option>
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
    </select>

    {{-- SELECTED TAGS DISPLAY --}}
    <div id="selected_tags" class="mt-2">
        @if(isset($blog))
            @foreach($blog->tags as $tag)
                <span class="badge bg-primary me-1 mb-1 selected-tag"
                      data-id="{{ $tag->id }}">
                    {{ $tag->name }}
                    <span class="remove-tag" style="cursor:pointer;"> × </span>
                </span>
            @endforeach
        @endif
    </div>

    {{-- HIDDEN INPUT FOR SUBMITTING SELECTED TAG IDs --}}
    <input type="hidden" name="tags[]" id="tags_input"
           value="{{ isset($blog) ? $blog->tags->pluck('id')->implode(',') : '' }}">
</div>




                {{-- VIEWS --}}
                <div class="col-md-4">
                    <label class="form-label">Views</label>
                    <input type="number" name="views" class="form-control"
                        value="{{ old('views', $blog->views ?? 0) }}">
                </div>

                {{-- READING TIME --}}
                <div class="col-md-4">
                    <label class="form-label">Reading Time (Minutes)</label>
                    <input type="number" name="reading_time" class="form-control"
                        value="{{ old('reading_time', $blog->reading_time ?? 0) }}">
                </div>

                {{-- COMMENT COUNT --}}
                <div class="col-md-4">
                    <label class="form-label">Comment Count</label>
                    <input type="number" name="comment_count" class="form-control"
                        value="{{ old('comment_count', $blog->comment_count ?? 0) }}">
                </div>



                {{-- META TITLE --}}
                <div class="col-md-12">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control"
                        value="{{ old('meta_title', $blog->meta_title ?? '') }}">
                </div>

                {{-- META DESCRIPTION --}}
                <div class="col-md-6">
    <label class="form-label">Meta Description</label>
    <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
</div>


                {{-- META KEYWORDS (JSON ARRAY) --}}
                <div class="col-md-6">
                    <label class="form-label">Meta Keywords (JSON Array)</label>
                    <textarea name="meta" id="meta_input" class="form-control" rows="3" placeholder="seo, blog, marketing">{{ old('meta', !empty($blog->meta_keywords) ? json_encode($blog->meta_keywords, JSON_UNESCAPED_UNICODE) : '') }}</textarea>
                </div>




                {{-- SWITCHES --}}
                <div class="col-md-6 mt-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1"
                            {{ old('is_featured', $blog->is_featured ?? 0) ? 'checked' : '' }}>
                        <label class="form-check-label">Featured</label>
                    </div>
                </div>

                <div class="col-md-6 mt-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $blog->is_active ?? 1) ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>

            </div>

            <div class="card-footer text-end">
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
                <button class="btn btn-primary">{{ isset($blog) ? 'Update' : 'Create' }}</button>
            </div>

        </form>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {

    /* ============================================
       TAG MULTI SELECTOR
    ============================================ */

    // Convert initial hidden input value into array
    let selectedTags = $("#tags_input").val()
        ? $("#tags_input").val().split(",").map(Number)
        : [];

    // SELECT TAG
    $("#tag_selector").on("change", function () {

        const tagId = parseInt($(this).val());
        const tagName = $("#tag_selector option:selected").text();

        if (!tagId) return;

        // Prevent duplicates
        if (selectedTags.includes(tagId)) {
            $(this).val("");
            return;
        }

        // Add to array
        selectedTags.push(tagId);

        // Show badge
        $("#selected_tags").append(`
            <span class="badge bg-primary me-1 mb-1 selected-tag" data-id="${tagId}">
                ${tagName}
                <span class="remove-tag" style="cursor:pointer;"> × </span>
            </span>
        `);

        // Update hidden field
        $("#tags_input").val(selectedTags.join(","));

        $(this).val("");
    });

    // REMOVE TAG BADGE
    $(document).on("click", ".remove-tag", function () {
        const parent = $(this).closest(".selected-tag");
        const tagId = parseInt(parent.data("id"));

        // Remove from array
        selectedTags = selectedTags.filter(id => id !== tagId);

        // Update hidden field
        $("#tags_input").val(selectedTags.join(","));

        // Remove badge
        parent.remove();
    });

});
</script>

    <script>
        /* -------------------------
                   JQUERY VALIDATE
                -------------------------- */
        $(document).ready(function() {

            $("#blogForm").validate({
                rules: {
                    category_id: {
                        required: true
                    },
                    author_id: {
                        required: true
                    },
                    title: {
                        required: true
                    },
                    slug: {
                        required: true
                    },
                    excerpt: {
                        required: true
                    },
                    content: {
                        required: true
                    },
                    status: {
                        required: true
                    }
                },
                messages: {
                    category_id: "Please select a category",
                    author_id: "Please select an author",
                    title: "Title is required",
                    slug: "Slug is required",
                    excerpt: "Excerpt is required",
                    content: "Content is required",
                    status: "Please select blog status"
                },
                errorClass: "is-invalid",
                validClass: "is-valid",

                highlight: function(element) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element) {
                    $(element).removeClass("is-invalid").addClass("is-valid");
                }
            });

        });
    </script>
@endpush
