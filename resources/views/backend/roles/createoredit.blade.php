@extends('backend.layouts.app')

@section('title', isset($role) ? 'Edit Item' : 'Create Item')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">{{ isset($role) ? 'Edit' : 'Create' }} Item</h5>
    </div>

    <form id="itemForm" method="POST"
          action="{{ route('admin.roles.saveorupdate', $role->uuid ?? null) }}">
        @csrf

        <div class="card-body row g-3">

            {{-- NAME --}}
            <div class="col-md-4">
                <label class="form-label">Name *</label>
                <input type="text"
                id="title_input"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $role->name ?? '') }}"
                       >
            </div>

            {{-- SLUG --}}
            <div class="col-md-4">
                <label class="form-label">Slug *</label>
                <input type="text"
                id="slug_input"
                       name="slug"
                       class="form-control"
                       value="{{ old('slug', $role->slug ?? '') }}"
                       >
            </div>

            {{-- GUARD --}}
           <div class="col-md-4">
    <label class="form-label">Guard *</label>
    <select name="guard" class="form-control">
        @foreach(config('constants.guards') as $key => $label)
            <option value="{{ $key }}"
                {{ old('guard', $role->guard ?? 'web') == $key ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>

            {{-- ACTIVE --}}
            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $role->is_active ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">
                {{ isset($role) ? 'Update' : 'Create' }}
            </button>
        </div>

    </form>
</div>
@endsection

@push('scripts')


<script>
$(document).ready(function () {

    $("#itemForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            slug: {
                required: true,
                minlength: 2
            },
            guard: {
                required: true
            }
        },

        messages: {
            name: {
                required: "Please enter name",
                minlength: "Name must be at least 2 characters"
            },
            slug: {
                required: "Please enter slug",
                minlength: "Slug must be at least 2 characters"
            },
            guard: {
                required: "Please enter a guard name"
            }
        },

        errorClass: "is-invalid",
        validClass: "is-valid",

        highlight: function (element) {
            $(element).addClass("is-invalid");
        },

        unhighlight: function (element) {
            $(element).removeClass("is-invalid").addClass("is-valid");
        }
    });

});
</script>
@endpush
