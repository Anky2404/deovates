@extends('backend.layouts.app')

@section('title', 'Manage Service FAQs')

@section('content')

<form method="POST" action="{{ route('admin.services.faqs.saveorupdate') }}">
    @csrf

    {{-- SERVICE SELECT --}}
    <div class="card mb-3">
        <div class="card-body">
            <label class="form-label">Service</label>
            <select name="service_id" class="form-select" required>
                <option value="">-- Select Service --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- FAQ BUILDER --}}
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <h5 class="mb-0">Add FAQs</h5>
            <button type="button" class="btn btn-sm btn-primary" id="addFaqBtn">
                + Add FAQ
            </button>
        </div>

        <div class="card-body" id="faqContainer">
            {{-- FAQ ITEMS APPEND HERE --}}
        </div>
    </div>

    {{-- LIVE PREVIEW --}}
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">Live Preview (Drag & Drop Order)</h5>
        </div>

        <div class="card-body">
            <ul class="list-group" id="faqPreview">
                {{-- PREVIEW ITEMS --}}
            </ul>
        </div>
    </div>

    {{-- SUBMIT --}}
    <div class="text-end">
        <button class="btn btn-success">Save FAQs</button>
    </div>

</form>

@endsection

@push('scripts')

<script src="{{ asset('assets/js/Sortable.min.js') }}"></script>
<script>
let faqIndex = 0;

document.getElementById('addFaqBtn').addEventListener('click', addFaq);

function addFaq() {
    faqIndex++;

    const html = `
        <div class="border rounded p-3 mb-3 faq-item" data-index="${faqIndex}">
            <div class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="faqs[${faqIndex}][question]"
                           class="form-control question-input"
                           placeholder="Question" required>
                </div>

                <div class="col-md-6">
                    <input type="text" name="faqs[${faqIndex}][answer]"
                           class="form-control answer-input"
                           placeholder="Answer" required>
                </div>

                <div class="col-md-1 text-end">
                    <button type="button" class="btn btn-danger btn-sm removeFaq">✕</button>
                </div>
            </div>

            <input type="hidden" name="faqs[${faqIndex}][display_order]" class="order-input">
        </div>
    `;

    document.getElementById('faqContainer').insertAdjacentHTML('beforeend', html);
    refreshPreview();
}

// REMOVE FAQ
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('removeFaq')) {
        e.target.closest('.faq-item').remove();
        refreshPreview();
    }
});

// LIVE PREVIEW UPDATE
document.addEventListener('input', function (e) {
    if (e.target.classList.contains('question-input') || e.target.classList.contains('answer-input')) {
        refreshPreview();
    }
});

function refreshPreview() {
    const preview = document.getElementById('faqPreview');
    preview.innerHTML = '';

    document.querySelectorAll('.faq-item').forEach((item, index) => {
        const question = item.querySelector('.question-input').value || 'Question';
        const answer = item.querySelector('.answer-input').value || 'Answer';

        item.querySelector('.order-input').value = index + 1;

        preview.insertAdjacentHTML('beforeend', `
            <li class="list-group-item d-flex justify-content-between align-items-start"
                data-index="${item.dataset.index}">
                <div>
                    <strong>${index + 1}. ${question}</strong>
                    <div class="text-muted small">${answer}</div>
                </div>
                <span class="badge bg-secondary">⇅</span>
            </li>
        `);
    });
}

// SORTABLE PREVIEW
new Sortable(document.getElementById('faqPreview'), {
    animation: 150,
    onEnd: function () {
        const items = document.querySelectorAll('#faqPreview li');
        const faqItems = document.querySelectorAll('.faq-item');

        items.forEach((previewItem, index) => {
            const match = [...faqItems].find(f =>
                f.dataset.index === previewItem.dataset.index
            );
            document.getElementById('faqContainer').appendChild(match);
        });

        refreshPreview();
    }
});
</script>
@endpush
