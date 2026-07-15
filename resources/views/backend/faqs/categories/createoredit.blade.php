@extends('backend.layouts.app')

@section('title', isset($category) ? 'Edit FAQ Category' : 'Create FAQ Category')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ isset($category) ? 'Edit FAQ Category' : 'Create FAQ Category' }}</h5>

        @if(isset($category))
            <div class="d-flex gap-2 align-items-center">
                <span class="badge bg-label-primary">
                    {{ $category->faqs->count() }} {{ \Illuminate\Support\Str::plural('FAQ', $category->faqs->count()) }}
                </span>
                <span class="badge {{ $category->is_active ? 'bg-label-success' : 'bg-label-secondary' }}">
                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
        @endif
    </div>

    @if(isset($category))
        <div class="card-body border-bottom pb-3">
            <div class="row g-2 text-muted small">
                <div class="col-md-4"><strong>Slug:</strong> {{ $category->slug }}</div>
                <div class="col-md-4"><strong>Page:</strong> {{ $category->page ?? '—' }}</div>
                <div class="col-md-4"><strong>Created:</strong> {{ $category->created_at?->format('d M Y, h:i A') }}</div>
            </div>
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.faqs.categories.saveorupdate', $category->uuid ?? null) }}">
        @csrf

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ================= CATEGORY ================= --}}
            <div class="row g-3 mb-4">

                <div class="col-md-6">
                    <label>Title *</label>
                    <input type="text" name="title" id="title_input"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $category->title ?? '') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label>Slug</label>
                    <input type="text" name="slug" id="slug_input"
                           class="form-control @error('slug') is-invalid @enderror"
                           value="{{ old('slug', $category->slug ?? '') }}">
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label>Page</label>
                    <input type="text" name="page" class="form-control @error('page') is-invalid @enderror"
                           value="{{ old('page', $category->page ?? '') }}">
                    @error('page')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label>Short Description</label>
                    <textarea name="short_description" id="short_description"
                              class="form-control @error('short_description') is-invalid @enderror"
                              rows="2">{{ old('short_description', $category->short_description ?? '') }}</textarea>
                    @error('short_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <hr>

            {{-- ================= FAQ ITEMS ================= --}}
            <div class="row">

                {{-- LEFT --}}
                <div class="col-md-7">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">
                            FAQs
                            <span class="badge bg-label-primary" id="faqCountBadge">
                                {{ isset($category) ? $category->faqs->count() : 0 }}
                            </span>
                        </h6>
                        <button type="button" class="btn btn-sm btn-primary" id="addFaqBtn">
                            + Add FAQ
                        </button>
                    </div>

                    <div id="faqContainer">
                        @foreach($category->faqs ?? [] as $faq)
                            <div class="card mb-2 faq-item" data-index="{{ $loop->index }}">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-label-secondary faq-position">#{{ $loop->iteration }}</span>
                                        <span class="cursor-move text-muted" title="Drag in preview to reorder">
                                            <i class="bx bx-move"></i>
                                        </span>
                                    </div>

                                    <input type="hidden"
                                           name="faqs[{{ $loop->index }}][id]"
                                           value="{{ $faq->id }}">

                                    <input type="text"
                                           name="faqs[{{ $loop->index }}][question]"
                                           class="form-control mb-2 faq-question"
                                           value="{{ $faq->question }}"
                                           placeholder="Question"
                                           required>

                                    <textarea name="faqs[{{ $loop->index }}][answer]"
                                              class="form-control mb-2 faq-answer"
                                              rows="2"
                                              placeholder="Answer"
                                              required>{{ $faq->answer }}</textarea>

                                    <button type="button"
                                            class="btn btn-sm btn-danger removeFaq">
                                        <i class="bx bx-trash"></i> Remove
                                    </button>

                                    <input type="hidden"
                                           name="faqs[{{ $loop->index }}][display_order]"
                                           class="faq-order"
                                           value="{{ $faq->display_order }}">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div id="noFaqsMessage" class="text-muted text-center py-3 border rounded d-none">
                        No FAQs added yet. Click "+ Add FAQ" to create one.
                    </div>
                </div>

                {{-- RIGHT PREVIEW --}}
                <div class="col-md-5">
                    <div class="border p-3 bg-light">
                        <h6>Preview <small class="text-muted">(drag to reorder)</small></h6>
                        <ul id="faqPreview" class="list-group"></ul>
                    </div>
                </div>
                 {{-- ACTIVE --}}
            <div class="mt-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                        {{ old('is_active', $category->is_active ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.faqs.categories.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>
</div>

@endsection
@push('scripts')
<script src="{{ asset('assets/js/Sortable.min.js') }}"></script>

<script>
let faqIndex = document.querySelectorAll('.faq-item').length;

// ADD
document.getElementById('addFaqBtn').addEventListener('click', function () {

    const html = `
    <div class="card mb-2 faq-item" data-index="${faqIndex}">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="badge bg-label-secondary faq-position">#</span>
                <span class="cursor-move text-muted" title="Drag in preview to reorder">
                    <i class="bx bx-move"></i>
                </span>
            </div>

            <input type="text"
                   name="faqs[${faqIndex}][question]"
                   class="form-control mb-2 faq-question"
                   placeholder="Question"
                   required>

            <textarea name="faqs[${faqIndex}][answer]"
                      class="form-control mb-2 faq-answer"
                      rows="3"
                      placeholder="Answer"
                      required></textarea>

            <button type="button" class="btn btn-sm btn-danger removeFaq">
                <i class="bx bx-trash"></i> Remove
            </button>

            <input type="hidden"
                   name="faqs[${faqIndex}][display_order]"
                   class="faq-order">
        </div>
    </div>`;

    document.getElementById('faqContainer').insertAdjacentHTML('beforeend', html);

    faqIndex++;
    refreshPreview();
});

// REMOVE
document.addEventListener('click', function(e) {
    if (e.target.closest('.removeFaq')) {
        e.target.closest('.faq-item').remove();
        refreshPreview();
    }
});

// LIVE UPDATE
document.addEventListener('input', function(e) {
    if (e.target.classList.contains('faq-question') ||
        e.target.classList.contains('faq-answer')) {
        refreshPreview();
    }
});

// PREVIEW
function refreshPreview() {

    const preview = document.getElementById('faqPreview');
    preview.innerHTML = '';

    const items = document.querySelectorAll('.faq-item');

    items.forEach((item, index) => {

        const q = item.querySelector('.faq-question').value || 'Question';
        const a = item.querySelector('.faq-answer').value || 'Answer';

        item.querySelector('.faq-order').value = index + 1;
        item.querySelector('.faq-position').textContent = '#' + (index + 1);

        preview.insertAdjacentHTML('beforeend', `
            <li class="list-group-item" data-index="${item.dataset.index}">
                <strong>${index + 1}. ${q}</strong>
                <div class="small text-muted">${a}</div>
            </li>
        `);
    });

    document.getElementById('faqCountBadge').textContent = items.length;
    document.getElementById('noFaqsMessage').classList.toggle('d-none', items.length > 0);
}

// SORTABLE
new Sortable(document.getElementById('faqPreview'), {
    animation: 150,
    onEnd: function () {

        const container = document.getElementById('faqContainer');

        document.querySelectorAll('#faqPreview li').forEach(li => {
            const item = container.querySelector(
                '.faq-item[data-index="' + li.dataset.index + '"]'
            );
            if (item) container.appendChild(item);
        });

        refreshPreview();
    }
});

// INIT
refreshPreview();
</script>
@endpush
