@extends('backend.layouts.app')

@section('title', isset($category) ? 'Edit FAQ' : 'Create FAQ')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ isset($category) ? 'Edit FAQ' : 'Create FAQ' }}</h5>
    </div>

    <form method="POST"
          action="{{ route('admin.faqs.categories.saveorupdate', $category->uuid ?? null) }}">
        @csrf

        <div class="card-body">

            {{-- ================= CATEGORY ================= --}}
            <div class="row g-3 mb-4">

                <div class="col-md-6">
                    <label>Title *</label>
                    <input type="text" name="title" id="title_input" class="form-control"
                           value="{{ old('title', $category->title ?? '') }}" required>
                </div>

                <div class="col-md-6">
                    <label>Slug</label>
                    <input type="text" name="slug" id="slug_input" class="form-control"
                           value="{{ old('slug', $category->slug ?? '') }}">
                </div>

                <div class="col-md-6">
                    <label>Page</label>
                    <input type="text" name="page" class="form-control"
                           value="{{ old('page', $category->page ?? '') }}">
                </div>

                <div class="col-md-12">
                    <label>Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2">
{{ old('short_description', $category->short_description ?? '') }}</textarea>
                </div>

            </div>

            <hr>

            {{-- ================= FAQ ITEMS ================= --}}
            <div class="row">

                {{-- LEFT --}}
                <div class="col-md-7">
                    <div class="d-flex justify-content-between mb-2">
                        <h6>FAQs</h6>
                        <button type="button" class="btn btn-sm btn-primary" id="addFaqBtn">
                            + Add FAQ
                        </button>
                    </div>

                    <div id="faqContainer">
                        @foreach($category->faqs ?? [] as $faq)
                            <div class="card mb-2 faq-item" data-index="{{ $loop->index }}">
                                <div class="card-body">

                                    <input type="hidden"
                                           name="faqs[{{ $loop->index }}][id]"
                                           value="{{ $faq->id }}">

                                    <input type="text"
                                           name="faqs[{{ $loop->index }}][question]"
                                           class="form-control mb-2 faq-question"
                                           value="{{ $faq->question }}"
                                           placeholder="Question">

                                    <textarea name="faqs[{{ $loop->index }}][answer]"
                                              class="form-control mb-2 faq-answer"
                                              rows="2">{{ $faq->answer }}</textarea>

                                    <button type="button"
                                            class="btn btn-sm btn-danger removeFaq">
                                        Remove
                                    </button>

                                    <input type="hidden"
                                           name="faqs[{{ $loop->index }}][display_order]"
                                           class="faq-order"
                                           value="{{ $faq->display_order }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- RIGHT PREVIEW --}}
                <div class="col-md-5">
                    <div class="border p-3 bg-light">
                        <h6>Preview</h6>
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
            <button class="btn btn-primary">Save</button>
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
    <div class="card mb-3 faq-item" data-index="${faqIndex}">
        <div class="card-body">

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
                Remove
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
    if (e.target.classList.contains('removeFaq')) {
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

    document.querySelectorAll('.faq-item').forEach((item, index) => {

        const q = item.querySelector('.faq-question').value || 'Question';
        const a = item.querySelector('.faq-answer').value || 'Answer';

        item.querySelector('.faq-order').value = index + 1;

        preview.insertAdjacentHTML('beforeend', `
            <li class="list-group-item" data-index="${item.dataset.index}">
                <strong>${index + 1}. ${q}</strong>
                <div class="small text-muted">${a}</div>
            </li>
        `);
    });
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
