@extends('backend.layouts.app')

@section('title', isset($permission) ? 'Edit Permission' : 'Create Permission')

@section('content')
<div class="card">

    <div class="card-header">
        <h5 class="mb-0">{{ isset($permission) ? 'Edit' : 'Create' }} Permission</h5>
    </div>

    <form id="permissionForm" method="POST"
        action="{{ route('admin.permissions.saveorupdate', $permission->uuid ?? null) }}">
        @csrf

        <div class="card-body row g-3">

            <div class="col-md-6">
                <label class="form-label">Name *</label>
                <input type="text" id="title_input" name="name" class="form-control"
                    value="{{ old('name', $permission->name ?? '') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Slug *</label>
                <input type="text" id="slug_input" name="slug" class="form-control"
                    value="{{ old('slug', $permission->slug ?? '') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Module</label>
                <select name="module" id="module" class="form-control">
                    <option value="">Select Module</option>
                    @foreach(config('constants.modules') as $key => $label)
                        <option value="{{ $key }}"
                            {{ old('module', $permission->module ?? '') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Group</label>
                <select name="group[]" id="group" class="form-control select2" multiple></select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Action Key</label>

                @php
                    $actions = config('constants.actions');
                    $selectedActions = old('action', isset($permission->action)
                        ? explode(',', $permission->action)
                        : []);
                @endphp

                <select name="action[]" class="form-control select2" multiple>
                    @foreach($actions as $label => $key)
                        <option value="{{ $key }}"
                            {{ in_array((string)$key, $selectedActions) ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_',' ', $label)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control"
                    value="{{ old('display_order', $permission->display_order ?? 0) }}">
            </div>

            <div class="col-md-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $permission->description ?? '') }}</textarea>
            </div>

            <div class="col-md-12">
    <label class="form-label">Meta (JSON)</label>
    <textarea
        name="meta"
        class="form-control json-auto"
        rows="3"
    >{{ old('meta', isset($permission->meta) ? json_encode($permission->meta) : '') }}</textarea>
</div>

            <div class="col-md-6">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input" type="checkbox" name="is_system" value="1"
                        {{ old('is_system', $permission->is_system ?? 0) ? 'checked' : '' }}>
                    <label class="form-check-label">Is System</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                        {{ old('is_active', $permission->is_active ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">
                {{ isset($permission) ? 'Update' : 'Create' }}
            </button>
        </div>

    </form>
</div>
@endsection

@push('scripts')

@php
    $groupData = old('group', isset($permission->group) ? explode(',', $permission->group) : []);
@endphp

<script>
const GROUPS = @json(config('constants.groups'));
const selectedModule = "{{ old('module', $permission->module ?? '') }}";
const selectedGroups = @json($groupData);
</script>

<script>
$(function () {

    const $module = $('#module');
    const $group = $('#group');

    $('.select2').select2({
        width: '100%',
        allowClear: true
    });

    function renderGroups(module) {
        const list = GROUPS[module] || [];

        $group.empty();

        $.each(list, function (_, item) {
            const label = item.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
            const selected = selectedGroups.includes(item);
            const option = new Option(label, item, selected, selected);
            $group.append(option);
        });

        $group.trigger('change');
    }

    $module.on('change', function () {
        renderGroups(this.value);
    });

    if (selectedModule) {
        renderGroups(selectedModule);
    }

});
</script>

<script>
$(document).ready(function() {

    $("#permissionForm").validate({
        rules: {
            name: { required: true },
            slug: { required: true },
            display_order: { number: true }
        },
        errorClass: "is-invalid",
        validClass: "is-valid",
        highlight: function(el) { $(el).addClass("is-invalid"); },
        unhighlight: function(el) { $(el).removeClass("is-invalid").addClass("is-valid"); }
    });

});
</script>

@endpush
