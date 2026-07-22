@extends('backend.layouts.app')

@section('title', isset($page) ? 'Edit Page' : 'Create Page')

@section('content')
<div class="card">

    <!-- Header -->
    <div class="card-header">
        <h5 class="mb-0">
            {{ isset($page) ? 'Edit Page' : 'Create Page' }}
        </h5>
    </div>

    <form method="POST"
        action="{{ route('admin.pages.saveorupdate', ['uuid' => $page->uuid ?? null]) }}">
        @csrf

        <div class="card-body">

            <div class="row g-3">

                {{-- TITLE --}}
                <div class="col-md-6">
                    <label class="form-label">Title *</label>
                    <input type="text" id="title_input" name="title" class="form-control"
                        value="{{ old('title', $page->title ?? '') }}" required>
                    @error('title')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- SLUG --}}
                <div class="col-md-6">
                    <label class="form-label">Slug *</label>
                    <input type="text" id="slug_input" name="slug" class="form-control"
                        value="{{ old('slug', $page->slug ?? '') }}" required>
                    @error('slug')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- META TITLE --}}
                <div class="col-md-6">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control"
                        value="{{ old('meta_title', $page->meta_title ?? '') }}">
                </div>

                {{-- CANONICAL URL --}}
                <div class="col-md-6">
                    <label class="form-label">Canonical URL</label>
                    <input type="url" name="canonical_url" class="form-control"
                        value="{{ old('canonical_url', $page->canonical_url ?? '') }}">
                </div>

                {{-- META DESCRIPTION --}}
                <div class="col-md-12">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
                </div>

                {{-- META KEYWORDS --}}
                <div class="col-md-12">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control"
                        placeholder="comma, separated, keywords"
                        value="{{ old('meta_keywords', is_array($page->meta_keywords ?? null) ? implode(', ', $page->meta_keywords) : '') }}">
                </div>

                {{-- ACTIVE --}}
                <div class="col-md-6">
                    <div class="form-check form-switch mt-4">
                        <input class="form-check-input"
                               type="checkbox"
                               name="is_active"
                               value="1"
                               {{ old('is_active', $page->is_active ?? 1) ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>

                {{-- PUBLISHED --}}
                <div class="col-md-6">
                    <div class="form-check form-switch mt-4">
                        <input class="form-check-input"
                               type="checkbox"
                               name="is_published"
                               value="1"
                               {{ old('is_published', $page->is_published ?? 0) ? 'checked' : '' }}>
                        <label class="form-check-label">Published</label>
                    </div>
                </div>

            </div>

        </div>

        <hr class="m-0">

        {{-- SECTIONS --}}
        <div class="card-body">
            <h6 class="mb-3">Sections</h6>

            <div class="row g-2 align-items-end mb-3">
                <div class="col-md-8">
                    <label class="form-label">Add a section</label>
                    <select id="sectionPicker" class="form-select">
                        <option value="">Select a section to add</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}" data-name="{{ $section->name }}">
                                {{ $section->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="button" id="addSectionBtn" class="btn btn-outline-primary w-100">
                        <i class="bx bx-plus me-1"></i> Add Section
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th>Section</th>
                            <th class="text-center">Active</th>
                            <th class="text-center">Remove</th>
                        </tr>
                    </thead>
                    <tbody id="assignedSectionsList">
                        @foreach ($page?->sections ?? [] as $section)
                            <tr data-id="{{ $section->id }}">
                                <td class="drag-handle" style="cursor: grab; width:1%;">
                                    <i class="bx bx-menu text-muted"></i>
                                </td>
                                <td>
                                    {{ $section->name }}
                                    <input type="hidden" name="sections[order][]" value="{{ $section->id }}">
                                </td>
                                <td class="text-center">
                                    <input type="checkbox"
                                           class="form-check-input"
                                           name="sections_active[{{ $section->id }}]"
                                           value="1"
                                           {{ $section->pivot->is_active ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-section-row">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p id="noSectionsMessage" class="text-muted text-center py-3 mb-0"
               style="{{ isset($page) && $page->sections->isNotEmpty() ? 'display:none;' : '' }}">
                No sections assigned yet.
            </p>

            <div class="small text-muted mt-2">
                <i class="bx bx-info-circle"></i> Drag rows by the handle to control display order on the page.
            </div>

            {{-- CONTENT TABS + PANELS (one tab per assigned section; only the clicked section's form is shown) --}}
            @php
                $assignedSectionIds = $page?->sections->pluck('id')->toArray() ?? [];
            @endphp

            <div id="sectionContentTabs" class="d-flex flex-wrap gap-2 mb-3 {{ empty($assignedSectionIds) ? 'd-none' : '' }}">
                @foreach ($page?->sections ?? [] as $section)
                    <button type="button" class="btn btn-sm btn-outline-primary section-content-tab-btn"
                        data-section-content-id="{{ $section->id }}">
                        {{ $section->name }}
                    </button>
                @endforeach
            </div>

            <div id="sectionContentPanels">
                @foreach ($sections as $section)
                    <div class="section-content-panel mt-3 d-none"
                         data-section-content-id="{{ $section->id }}">
                        <div class="card">
                            <div class="card-header bg-label-info py-2">
                                <strong>{{ $section->name }}</strong> <span class="text-muted">Content</span>
                            </div>
                            <div class="card-body">
                                @if($section->form && $section->form->fields->isNotEmpty())
                                    @include('backend.partials._dynamic_form_fields', [
                                        'fields' => $section->form->fields,
                                        'values' => $sectionContents[$section->id] ?? [],
                                        'namePrefix' => 'sections_data['.$section->id.']',
                                        'idPrefix' => 'sec'.$section->id,
                                    ])
                                @else
                                    <p class="text-muted mb-0">This section has no fields defined yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Footer -->
        <div class="card-footer text-end">

            <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
                Cancel
            </a>

            <button class="btn btn-success">
                Save Page
            </button>

        </div>

    </form>

</div>

{{-- CROP MODAL (powers the croppie-upload / gallery-cropper-upload fields inside section content) --}}

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const list = document.getElementById('assignedSectionsList');
    const picker = document.getElementById('sectionPicker');
    const addBtn = document.getElementById('addSectionBtn');
    const noSectionsMessage = document.getElementById('noSectionsMessage');
    const tabsBar = document.getElementById('sectionContentTabs');

    if (!list || !picker || !addBtn) {
        return;
    }

    new Sortable(list, {
        handle: '.drag-handle',
        animation: 150,
    });

    function toggleEmptyMessage() {
        if (noSectionsMessage) {
            noSectionsMessage.style.display = list.children.length ? 'none' : '';
        }
    }

    function disablePickerOption(id) {
        const option = picker.querySelector(`option[value="${id}"]`);
        if (option) {
            option.disabled = true;
        }
    }

    function enablePickerOption(id) {
        const option = picker.querySelector(`option[value="${id}"]`);
        if (option) {
            option.disabled = false;
        }
    }

    // Existing rows already on the page shouldn't be pickable again.
    list.querySelectorAll('tr[data-id]').forEach(function (row) {
        disablePickerOption(row.dataset.id);
    });

    addBtn.addEventListener('click', function () {
        const option = picker.selectedOptions[0];

        if (!option || !option.value) {
            return;
        }

        const id = option.value;
        const name = option.dataset.name;

        if (list.querySelector(`tr[data-id="${id}"]`)) {
            return;
        }

        const row = document.createElement('tr');
        row.dataset.id = id;
        row.innerHTML = `
            <td class="drag-handle" style="cursor: grab; width:1%;">
                <i class="bx bx-menu text-muted"></i>
            </td>
            <td>
                ${name}
                <input type="hidden" name="sections[order][]" value="${id}">
            </td>
            <td class="text-center">
                <input type="checkbox" class="form-check-input" name="sections_active[${id}]" value="1" checked>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-outline-danger remove-section-row">
                    <i class="bx bx-trash"></i>
                </button>
            </td>
        `;

        list.appendChild(row);
        disablePickerOption(id);
        picker.value = '';
        toggleEmptyMessage();
        addSectionTab(id, name);
        activateSectionTab(id);
    });

    list.addEventListener('click', function (event) {
        const button = event.target.closest('.remove-section-row');

        if (!button) {
            return;
        }

        const row = button.closest('tr[data-id]');
        const id = row.dataset.id;

        row.remove();
        enablePickerOption(id);
        toggleEmptyMessage();
        removeSectionTab(id);
    });

    function hideAllSectionPanels() {
        document.querySelectorAll('.section-content-panel').forEach(function (panel) {
            panel.classList.add('d-none');
        });
        document.querySelectorAll('.section-content-tab-btn').forEach(function (btn) {
            btn.classList.remove('btn-primary', 'active');
            btn.classList.add('btn-outline-primary');
        });
    }

    function activateSectionTab(id) {
        hideAllSectionPanels();

        const panel = document.querySelector(`.section-content-panel[data-section-content-id="${id}"]`);
        if (panel) panel.classList.remove('d-none');

        const btn = tabsBar
            ? tabsBar.querySelector(`.section-content-tab-btn[data-section-content-id="${id}"]`)
            : null;
        if (btn) {
            btn.classList.remove('btn-outline-primary');
            btn.classList.add('btn-primary', 'active');
        }
    }

    function addSectionTab(id, name) {
        if (!tabsBar) return;

        if (tabsBar.querySelector(`.section-content-tab-btn[data-section-content-id="${id}"]`)) {
            return;
        }

        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'btn btn-sm btn-outline-primary section-content-tab-btn';
        btn.dataset.sectionContentId = id;
        btn.textContent = name;

        tabsBar.appendChild(btn);
        tabsBar.classList.remove('d-none');
    }

    function removeSectionTab(id) {
        if (!tabsBar) return;

        const btn = tabsBar.querySelector(`.section-content-tab-btn[data-section-content-id="${id}"]`);
        if (btn) btn.remove();

        const panel = document.querySelector(`.section-content-panel[data-section-content-id="${id}"]`);
        if (panel) panel.classList.add('d-none');

        if (!tabsBar.children.length) {
            tabsBar.classList.add('d-none');
        }
    }

    if (tabsBar) {
        tabsBar.addEventListener('click', function (event) {
            const btn = event.target.closest('.section-content-tab-btn');
            if (!btn) return;

            activateSectionTab(btn.dataset.sectionContentId);
        });
    }

    toggleEmptyMessage();
});
</script>
<script src="{{ asset('assets/js/dynamic-form-fields.js') }}"></script>
@endpush
@endsection
