{{--
    Boxed single-image field for the SIMPLE (non-croppie) preview-swap inputs
    — partners' logo, authors' profile_image/cover_image, technologies'
    image, industries' image. Keeps the `image-preview-input` class (handled
    in custom.js), unlike image-upload-box.blade.php which uses croppie.

    Required: $name        (input name, e.g. "logo")
    Optional: $label        (default: Image)
              $previewUrl   (existing stored image URL, if editing)
              $previewId    (default: "<name>Preview")
--}}
@php
    $label = $label ?? 'Image';
    $previewId = $previewId ?? Str::camel($name) . 'Preview';
    $hasImage = ! empty($previewUrl);
@endphp

<label class="form-label">{{ $label }}</label>

<div class="image-upload-box upload-dropzone{{ $hasImage ? ' has-image' : '' }}"
     data-placeholder="https://placehold.co/130x130">

    <input type="file" name="{{ $name }}" class="image-preview-input"
        data-preview="#{{ $previewId }}" accept="image/*">

    <div class="image-upload-empty">
        <i class="bx bx-cloud-upload image-upload-icon"></i>
        <p class="image-upload-text">Drag &amp; drop image here, or click to browse</p>
    </div>

    <div class="image-upload-preview">
        <img id="{{ $previewId }}" src="{{ $previewUrl ?: 'https://placehold.co/130x130' }}"
            class="image-upload-thumb">
        <button type="button" class="btn btn-link btn-sm text-danger image-upload-remove">Remove file</button>
    </div>

</div>
