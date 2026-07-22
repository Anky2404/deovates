@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Form Layouts')

@section('content')
<div class="card">

    {{-- HEADER --}}
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-1">{{ $form->heading ?? $form->name }}</h5>
            @if(!empty($form->paragraph))
                <p class="text-muted mb-0">{{ $form->paragraph }}</p>
            @endif
        </div>

        {{-- BACK BUTTON --}}
        <a href="{{ route('admin.pages.forms.index') }}"
           class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back"></i> Back
        </a>
    </div>

    {{-- FORM PREVIEW --}}
    <div class="card-body">
        <form>
            @include('backend.partials._dynamic_form_fields', [
                'fields' => $form->fields,
                'idPrefix' => 'form',
            ])
        </form>
    </div>

</div>

{{-- CROP MODAL (powers the croppie-upload / gallery-cropper-upload fields above) --}}
@endsection

@push('scripts')
<script src="{{ asset('assets/js/dynamic-form-fields.js') }}"></script>
@endpush
