@extends('backend.layouts.app')

@section('title', isset($faq) ? 'Edit FAQ' : 'Create FAQ')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ isset($faq) ? 'Edit FAQ' : 'Create FAQ' }}</h5>
    </div>

    <form method="POST" action="{{ route('admin.faqs.saveorupdate', $faq->id ?? null) }}">
        @csrf

        <div class="card-body">

            {{-- CATEGORY --}}
            <div class="mb-3">
                <label class="form-label">Category *</label>
                <select name="faq_category_id" class="form-control" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $id => $title)
                        <option value="{{ $id }}"
                            {{ old('faq_category_id', $faq->faq_category_id ?? '') == $id ? 'selected' : '' }}>
                            {{ $title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <hr>

            {{-- FAQ SECTION --}}
            <div class="row">
                {{-- LEFT --}}
                <div class="col-md-7">

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6>FAQ Items</h6>
                        <button type="button" class="btn btn-sm btn-primary" id="addFaqBtn">
                            + Add FAQ
                        </button>
                    </div>

                    <div id="faqContainer">

                        {{-- EDIT MODE --}}
                        @if(isset($faq))
                            <div class="card mb-3 faq-item" data-index="0">
                                <div class="card-body">

                                    <input type="text"
                                           name="faqs[0][question]"
                                           class="form-control mb-2 faq-question"
                                           value="{{ $faq->question }}"
                                           required>

                                    <textarea name="faqs[0][answer]"
                                              class="form-control mb-2 faq-answer"
                                              rows="3"
                                              required>{{ $faq->answer }}</textarea>

                                    <button type="button" class="btn btn-sm btn-danger removeFaq">
                                        Remove
                                    </button>

                                    <input type="hidden"
                                           name="faqs[0][display_order]"
                                           class="faq-order"
                                           value="{{ $faq->display_order }}">
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                {{-- RIGHT PREVIEW --}}
                <div class="col-md-5">
                    <div class="border rounded p-3 bg-light">
                        <h6>Preview (Drag & Drop)</h6>
                        <ul class="list-group" id="faqPreview"></ul>
                    </div>
                </div>
            </div>

            {{-- ACTIVE --}}
            <div class="mt-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                        {{ old('is_active', $faq->is_active ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">
                {{ isset($faq) ? 'Update' : 'Create' }}
            </button>
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
