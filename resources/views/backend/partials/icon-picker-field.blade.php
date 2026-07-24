
@php
    $label = $label ?? 'Icon (Boxicons Class)';
    $value = $value ?? '';
    $inputId = $inputId ?? ($name . '_input');
    $previewId = $previewId ?? ($name . '_preview');
    $placeholder = $placeholder ?? 'bx bx-cog';
@endphp

<label class="form-label" for="{{ $inputId }}">{{ $label }}</label>
<div class="upload-dropzone icon-picker-trigger" data-target="#{{ $inputId }}"
    title="Click to browse icons">
    <i id="{{ $previewId }}" class="{{ $value ?: $placeholder }}"></i>
</div>
<input type="text" id="{{ $inputId }}" name="{{ $name }}" class="form-control mb-2 icon-picker-input"
    data-icon-preview="#{{ $previewId }}" value="{{ $value }}" placeholder="{{ $placeholder }}"
    autocomplete="off">
