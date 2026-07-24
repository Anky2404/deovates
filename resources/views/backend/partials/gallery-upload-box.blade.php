{{--
    Boxed multi-image gallery upload prompt. Sits above the existing
    #{{ $containerId }} sortable thumbnail grid (which each page still renders
    itself, since item fields — title/alt/etc — vary slightly per module).
    Wraps the existing gallery-cropper-upload engine — no new upload logic.

    Required: $containerId  (e.g. "galleryItems", no leading #)
              $field        (form field name prefix, e.g. "gallery_items")
    Optional: $label         (default: Gallery Images)
              $startIndex    (default: 0)
              $width/$height (crop output size, default 800/600)
--}}
@php
    $label = $label ?? 'Gallery Images';
    $startIndex = $startIndex ?? 0;
    $width = $width ?? 800;
    $height = $height ?? 600;
@endphp

<label class="form-label">{{ $label }}</label>

<div class="gallery-upload-box upload-dropzone">

    <input type="file" class="gallery-upload-input gallery-cropper-upload" multiple accept="image/*"
        data-container="#{{ $containerId }}" data-field="{{ $field }}"
        data-start-index="{{ $startIndex }}" data-width="{{ $width }}" data-height="{{ $height }}">

    <div class="gallery-upload-placeholder">
        <i class="bx bx-images image-upload-icon"></i>
        <p class="image-upload-text">Drag &amp; drop images here, or click to browse</p>
    </div>

</div>
