@php
    $galleryItems = ($galleryMedia ?? collect())->where('is_active', true);
@endphp
@if ($galleryItems->isNotEmpty())
    <div class="mt-5">
        <h4 class="mb-3" style="color:#073965;">Gallery</h4>
        <div class="row g-3">
            @foreach ($galleryItems as $item)
                <div class="col-6 col-md-4">
                    <a href="{{ $item->url }}" class="gallery-popup-link d-block rounded overflow-hidden" title="{{ $item->caption }}">
                        <img src="{{ $item->url }}" alt="{{ $item->alt_text ?: $item->name }}" class="img-fluid w-100" style="aspect-ratio:4/3;object-fit:cover;">
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    @once
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (window.jQuery && jQuery.fn.magnificPopup) {
                    jQuery('.gallery-popup-link').magnificPopup({
                        type: 'image',
                        gallery: { enabled: true }
                    });
                }
            });
        </script>
    @endonce
@endif
