@php
    $label = $label ?? 'URL';
    $value = \App\Helper::stripUrlScheme(old($name, $value ?? ''));
    $inputId = $inputId ?? ($name . '_input');
    $placeholder = $placeholder ?? 'example.com';
    $required = $required ?? false;
@endphp

<label class="form-label" for="{{ $inputId }}">{{ $label }}</label>
<div class="input-group">
    <span class="input-group-text">https://</span>
    <input type="text" id="{{ $inputId }}" name="{{ $name }}" class="form-control url-scheme-strip"
        value="{{ $value }}" placeholder="{{ $placeholder }}" autocomplete="off"
        @if ($required) required @endif>
</div>
