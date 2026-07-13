@extends('backend.layouts.app')

@section('title', isset($media) ? 'Edit Media' : 'Upload Media')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">{{ isset($media) ? 'Edit' : 'Upload' }} Media</h5>
    </div>

    <form method="POST"
          action="{{ route('admin.media.library.saveorupdate', $media->uuid ?? null) }}"
          enctype="multipart/form-data">
        @csrf

        <div class="card-body row g-3">

            {{-- FILE --}}
            <div class="col-md-6">
                <label class="form-label">File {{ isset($media) ? '' : '*' }}</label>
                <input type="file"
                       name="file"
                       class="form-control"
                       {{ isset($media) ? '' : 'required' }}>

                @if (isset($media) && $media->path)
                    <div class="mt-2">
                        @if (str_starts_with((string) $media->mime_type, 'image/'))
                            <img src="{{ asset('storage/' . $media->path) }}"
                                 class="rounded border img-thumbnail"
                                 height="130"
                                 width="130">
                        @else
                            <a href="{{ asset('storage/' . $media->path) }}" target="_blank">
                                {{ $media->file_name }}
                            </a>
                        @endif
                    </div>
                @endif
            </div>

            {{-- COLLECTION --}}
            <div class="col-md-6">
                <label class="form-label">Collection</label>
                <input type="text"
                       name="collection"
                       class="form-control"
                       value="{{ old('collection', $media->collection ?? 'library') }}">
            </div>

            {{-- NAME --}}
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $media->name ?? '') }}">
            </div>

            {{-- ALT TEXT --}}
            <div class="col-md-6">
                <label class="form-label">Alt Text</label>
                <input type="text"
                       name="alt_text"
                       class="form-control"
                       value="{{ old('alt_text', $media->alt_text ?? '') }}">
            </div>

            {{-- CAPTION --}}
            <div class="col-md-12">
                <label class="form-label">Caption</label>
                <textarea name="caption"
                          class="form-control"
                          rows="3">{{ old('caption', $media->caption ?? '') }}</textarea>
            </div>

            {{-- SWITCHES --}}
            <div class="col-md-6">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $media->is_active ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.media.library.index') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">
                {{ isset($media) ? 'Update' : 'Upload' }}
            </button>
        </div>

    </form>
</div>
@endsection
