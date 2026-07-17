@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Compose Email')

@section('content')
<div class="row g-4">

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Compose Email</h5>
            </div>

            <form method="POST" action="{{ route('admin.emails.saveorupdate', $email->uuid ?? null) }}">
                @csrf

                <div class="card-body row g-3">

                    <input type="hidden" name="template_id" id="templateIdField" value="{{ old('template_id') }}">

                    {{-- TEMPLATE PICKER --}}
                    <div class="col-md-12">
                        <label class="form-label">Start from a template (optional)</label>
                        <select id="templatePicker" class="form-select">
                            <option value="">-- blank email --</option>
                            @foreach ($templates as $templateUuid => $name)
                                <option value="{{ $templateUuid }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">
                            Selecting a template links this send to it, so it also appears in Email Logs.
                        </div>
                    </div>

                    {{-- TO --}}
                    <div class="col-md-8">
                        <label class="form-label">To Email *</label>
                        <input type="email" name="to_email" class="form-control"
                               value="{{ old('to_email', $email->to_email ?? '') }}" required>
                        @error('to_email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">To Name</label>
                        <input type="text" name="to_name" class="form-control"
                               value="{{ old('to_name', $email->to_name ?? '') }}">
                    </div>

                    {{-- SUBJECT --}}
                    <div class="col-md-12">
                        <label class="form-label">Subject *</label>
                        <input type="text" id="subjectInput" name="subject" class="form-control"
                               value="{{ old('subject', $email->subject ?? '') }}" required>
                        @error('subject')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- BODY --}}
                    <div class="col-md-12">
                        <label class="form-label">Body *</label>
                        <textarea name="body" id="description" class="form-control" rows="10" required>{{ old('body', $email->body ?? '') }}</textarea>
                        @error('body')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="card-footer text-end">
                    <a href="{{ route('admin.emails.index') }}" class="btn btn-secondary">Cancel</a>
                    <button class="btn btn-primary">
                        <i class="bx bx-send me-1"></i> Send Email
                    </button>
                </div>

            </form>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Preview</h5>
            </div>
            <div class="card-body">
                @include('backend.partials.email-preview', [
                    'previewId' => 'composePreview',
                    'previewHtml' => view('emails.layout', [
                        'subject' => $email->subject ?? 'Your Subject Here',
                        'body' => $email->body ?? '<p>Start typing your email body — this preview updates once you open it.</p>',
                    ])->render(),
                ])
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const templatePicker = document.getElementById('templatePicker');

    if (!templatePicker) {
        return;
    }

    templatePicker.addEventListener('change', function () {
        const uuid = this.value;
        const templateIdField = document.getElementById('templateIdField');

        if (!uuid) {
            templateIdField.value = '';
            return;
        }

        fetch('{{ route('admin.emails.templates.details', ['uuid' => ':uuid']) }}'.replace(':uuid', uuid), {
            headers: { 'Accept': 'application/json' },
        })
            .then(function (response) { return response.json(); })
            .then(function (data) {
                document.getElementById('subjectInput').value = data.subject || '';
                templateIdField.value = data.id || '';

                const editorInstance = typeof CKEDITOR !== 'undefined' ? CKEDITOR.instances.description : null;

                if (editorInstance) {
                    editorInstance.setData(data.body || '');
                } else {
                    document.getElementById('description').value = data.body || '';
                }
            })
            .catch(function () {
                showToast?.('error', 'Could not load that template.');
            });
    });
});
</script>
@endpush
@endsection
