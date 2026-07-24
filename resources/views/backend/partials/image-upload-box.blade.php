{{--
    Boxed single-image upload field (icon + "Drag & drop" prompt, swaps to a
    thumbnail + "Remove file" once an image is present). Wraps the existing
    croppie-upload engine — no new upload logic, just its visual shell.

    Required: $name        (input name, e.g. "featured_image")
    Optional: $label        (default: Featured Image)
              $previewUrl   (existing stored image URL, if editing)
              $previewId    (default: "<name>Preview")
              $width/$height (crop output size, default 800/600)
              $altName      (input name for the alt-text field; omit to skip it)
              $altValue     (existing alt text)
--}}
@php
    $label = $label ?? 'Featured Image';
    $previewId = $previewId ?? Str::camel($name) . 'Preview';
    $width = $width ?? 800;
    $height = $height ?? 600;
    $hasImage = ! empty($previewUrl);
@endphp

<label class="form-label">{{ $label }}</label>

<div class="image-upload-box upload-dropzone{{ $hasImage ? ' has-image' : '' }}"
     data-placeholder="https://placehold.co/130x130">

    <input type="file" name="{{ $name }}" class="image-upload-input croppie-upload"
        data-preview="#{{ $previewId }}" data-width="{{ $width }}" data-height="{{ $height }}" accept="image/*">

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

@isset($altName)
    <input type="text" name="{{ $altName }}" class="form-control mt-2"
        placeholder="Alt text (used for the image name too)" value="{{ $altValue ?? '' }}">
@endisset
