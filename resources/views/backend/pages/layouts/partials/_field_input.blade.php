@php
    $required = $field->required ? 'required' : '';
    $disabled = $field->disabled ? 'disabled' : '';
    $class = $field->class ?? '';
    $value = $value ?? null;
@endphp

@if(in_array($field->type, ['text', 'email', 'number', 'hidden', 'date', 'time', 'password']))
    <input
        type="{{ $field->type }}"
        name="{{ $name }}"
        id="{{ $idPrefix }}"
        class="form-control {{ $class }}"
        placeholder="{{ $field->placeholder ?? $field->label }}"
        value="{{ $value }}"
        {{ $required }} {{ $disabled }}
    >

@elseif($field->type === 'textarea')
    <textarea
        name="{{ $name }}"
        id="{{ $idPrefix }}"
        class="form-control {{ $class }} {{ $field->use_ck_editor ? 'ckeditor' : '' }}"
        rows="3"
        placeholder="{{ $field->placeholder ?? $field->label }}"
        {{ $required }} {{ $disabled }}
    >{{ $value }}</textarea>

@elseif($field->type === 'select')
    @php
        $selectedValues = $field->is_multiple ? (array) $value : [(string) $value];
    @endphp
    <select
        name="{{ $name }}{{ $field->is_multiple ? '[]' : '' }}"
        id="{{ $idPrefix }}"
        class="form-select {{ $class }}"
        {{ $field->is_multiple ? 'multiple' : '' }}
        {{ $required }} {{ $disabled }}
    >
        @unless($field->is_multiple)
            <option value="">{{ 'Select '.$field->label }}</option>
        @endunless
        @foreach ($field->options ?? [] as $option)
            @php $optionValue = (string) ($option['value'] ?? $option); @endphp
            <option value="{{ $optionValue }}" {{ in_array($optionValue, $selectedValues, true) ? 'selected' : '' }}>
                {{ $option['label'] ?? $option }}
            </option>
        @endforeach
    </select>

@elseif($field->type === 'radio')
    <div>
        @foreach ($field->options ?? [] as $oIndex => $option)
            @php $optionValue = (string) ($option['value'] ?? $option); @endphp
            <div class="form-check {{ $class }}">
                <input type="radio" class="form-check-input" name="{{ $name }}"
                    id="{{ $idPrefix }}_{{ $oIndex }}" value="{{ $optionValue }}"
                    {{ (string) $value === $optionValue ? 'checked' : '' }} {{ $disabled }}>
                <label class="form-check-label" for="{{ $idPrefix }}_{{ $oIndex }}">{{ $option['label'] ?? $option }}</label>
            </div>
        @endforeach
    </div>

@elseif($field->type === 'checkbox')
    @if(!empty($field->options))
        @php $checkedValues = array_map('strval', (array) $value); @endphp
        <div>
            @foreach ($field->options as $oIndex => $option)
                @php $optionValue = (string) ($option['value'] ?? $option); @endphp
                <div class="form-check {{ $class }}">
                    <input type="checkbox" class="form-check-input" name="{{ $name }}[]"
                        id="{{ $idPrefix }}_{{ $oIndex }}" value="{{ $optionValue }}"
                        {{ in_array($optionValue, $checkedValues, true) ? 'checked' : '' }} {{ $disabled }}>
                    <label class="form-check-label" for="{{ $idPrefix }}_{{ $oIndex }}">{{ $option['label'] ?? $option }}</label>
                </div>
            @endforeach
        </div>
    @else
        <div class="form-check {{ $class }}">
            <input type="checkbox" class="form-check-input" name="{{ $name }}" id="{{ $idPrefix }}" value="1"
                {{ $value ? 'checked' : '' }} {{ $disabled }}>
            <label class="form-check-label" for="{{ $idPrefix }}">{{ $field->placeholder ?? '' }}</label>
        </div>
    @endif

@elseif($field->type === 'file')
    @php $hasExisting = is_string($value) && $value !== ''; @endphp
    @if($field->enable_croppie)
        <input type="file" name="{{ $name }}" class="form-control croppie-upload"
            data-preview="#{{ $idPrefix }}_preview" data-width="800" data-height="600"
            accept="image/*" {{ $disabled }}>
        <img id="{{ $idPrefix }}_preview" src="{{ $hasExisting ? asset('storage/'.$value) : 'https://placehold.co/130x130' }}"
            class="mt-2 rounded border img-thumbnail {{ $hasExisting ? '' : 'd-none' }}" height="130" width="130">
        <input type="text" name="{{ $name }}_alt" class="form-control mt-2" placeholder="Alt text">
    @else
        <input type="file" name="{{ $name }}" class="form-control" accept="image/*" {{ $disabled }}>
        @if($hasExisting)
            <div class="form-text mt-1">Current file: {{ $value }}</div>
        @endif
    @endif

@elseif($field->type === 'gallery')
    @php $existingItems = is_array($value) ? $value : []; @endphp
    @if($field->enable_croppie)
        <input type="file" class="form-control gallery-cropper-upload"
            data-container="#{{ $idPrefix }}_items" data-field="{{ $name }}" data-start-index="{{ count($existingItems) }}"
            data-width="800" data-height="600" multiple accept="image/*" {{ $disabled }}>
        <div id="{{ $idPrefix }}_items" class="gallery-sortable d-flex flex-wrap gap-2 mt-3">
            @foreach($existingItems as $gIndex => $item)
                <div class="gallery-crop-item position-relative d-inline-block m-1 align-top" style="width:140px;">
                    <span class="gallery-drag-handle" title="Drag to reorder"
                        style="position:absolute;top:2px;left:2px;z-index:9;cursor:move;background:#fff;border-radius:3px;padding:0 4px;font-size:14px;line-height:1.4;">&#9776;</span>
                    <button type="button" class="btn btn-danger btn-sm remove-gallery-crop-item"
                        style="position:absolute;top:2px;right:2px;z-index:9;padding:0 6px;">&times;</button>
                    <img src="{{ asset('storage/'.($item['path'] ?? '')) }}" class="rounded border img-thumbnail" width="120" height="120" style="object-fit:cover;">
                    <input type="hidden" name="{{ $name }}[{{ $gIndex }}][path]" value="{{ $item['path'] ?? '' }}">
                    <input type="text" name="{{ $name }}[{{ $gIndex }}][title]" class="form-control form-control-sm mt-1" placeholder="Title" value="{{ $item['title'] ?? '' }}">
                    <input type="text" name="{{ $name }}[{{ $gIndex }}][alt]" class="form-control form-control-sm mt-1" placeholder="Alt text" value="{{ $item['alt'] ?? '' }}">
                    <button type="button" class="btn btn-outline-secondary btn-sm copy-gallery-link w-100 mt-1"
                        data-path="{{ $item['path'] ?? '' }}" title="Copy image path">
                        <i class="bx bx-link"></i> Copy link
                    </button>
                </div>
            @endforeach
        </div>
    @else
        <input type="file" name="{{ $name }}[]" class="form-control" multiple accept="image/*" {{ $disabled }}>
        @if(!empty($existingItems))
            <div class="form-text mt-1">{{ count($existingItems) }} existing file(s) on record.</div>
        @endif
    @endif
@endif
