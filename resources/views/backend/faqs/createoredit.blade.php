@extends('backend.layouts.app')

@section('title', $selectedCategory ? 'Manage FAQs - ' . $selectedCategory->title : 'Create FAQs')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ $selectedCategory ? 'Manage FAQs' : 'Create FAQs' }}</h5>

        @if($selectedCategory)
            <span class="badge bg-label-primary" id="faqCountBadge">
                {{ $faqs->count() }} {{ \Illuminate\Support\Str::plural('FAQ', $faqs->count()) }}
            </span>
        @endif
    </div>

    @if($selectedCategory)
        <div class="card-body border-bottom pb-3">
            <div class="row g-2 text-muted small">
                <div class="col-md-4"><strong>Category:</strong> {{ $selectedCategory->title }}</div>
                <div class="col-md-4"><strong>Slug:</strong> {{ $selectedCategory->slug }}</div>
                <div class="col-md-4"><strong>Page:</strong> {{ $selectedCategory->page ?? '—' }}</div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.faqs.saveorupdate', $selectedCategory->uuid ?? null) }}">
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

            {{-- CATEGORY --}}
            <div class="mb-3">
                <label class="form-label">Category *</label>
                <select name="faq_category_id" class="form-control @error('faq_category_id') is-invalid @enderror" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $catUuid => $title)
                        <option value="{{ $catUuid }}"
                            {{ old('faq_category_id', $selectedCategory->uuid ?? '') == $catUuid ? 'selected' : '' }}>
                            {{ $title }}
                        </option>
                    @endforeach
                </select>
                @error('faq_category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>

            {{-- FAQ ITEMS --}}
            <div class="row">

                {{-- LEFT --}}
                <div class="col-md-7">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">
                            FAQ Items
                        </h6>
                        <button type="button" class="btn btn-sm btn-primary" id="addFaqBtn">
                            + Add FAQ
                        </button>
                    </div>

                    <div id="faqContainer">
                        @foreach($faqs as $faq)
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
                                              rows="3"
                                              placeholder="Answer"
                                              required>{{ $faq->answer }}</textarea>

                                    <button type="button" class="btn btn-sm btn-danger removeFaq">
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

                    <div id="noFaqsMessage" class="text-muted text-center py-3 border rounded {{ $faqs->count() ? 'd-none' : '' }}">
                        No FAQs added yet. Click "+ Add FAQ" to create one.
                    </div>
                </div>

                {{-- RIGHT PREVIEW --}}
                <div class="col-md-5">
                    <div class="border rounded p-3 bg-light">
                        <h6>Preview <small class="text-muted">(drag to reorder)</small></h6>
                        <ul class="list-group" id="faqPreview"></ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
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

    const countBadge = document.getElementById('faqCountBadge');
    if (countBadge) {
        countBadge.textContent = items.length + ' ' + (items.length === 1 ? 'FAQ' : 'FAQs');
    }

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
