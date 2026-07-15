/**
 * Global crop-and-upload widget. Handles two kinds of fields:
 *
 * SINGLE IMAGE — give the <input type="file"> class "croppie-upload" plus:
 *   - data-preview="#someImg"     (required) the <img> to update after upload
 *   - data-width="1200"           (optional) default crop output width, px
 *   - data-height="630"           (optional) default crop output height, px
 * On file select, a modal opens with the image loaded into Croppie and two
 * number inputs for the desired output width/height — changing either
 * live-resizes the crop frame to match that aspect ratio. Confirming the
 * crop (or cancelling the modal, which uploads the original file untouched)
 * both upload the result immediately to a temp server location; the returned
 * path is written into a same-name "<input name>_temp" hidden field (created
 * automatically if it doesn't already exist) for the form's controller to
 * promote to permanent storage on save.
 *
 * GALLERY (multiple images) — give the <input type="file" multiple> class
 * "gallery-cropper-upload" plus:
 *   - data-container="#galleryItems"  (required) where item cards are appended
 *   - data-field="gallery_items"      (optional) form field name prefix
 *   - data-start-index="3"            (optional) first index for new items,
 *                                      so they don't collide with existing rows
 *   - data-width="800" / data-height="600" (optional) default crop output size
 * Each selected file is queued and cropped one at a time through the same
 * modal; after each file (cropped or cancelled-to-original) a new gallery
 * item card is appended with a hidden "<field>[i][temp]" path and a text
 * "<field>[i][alt]" input, then the next queued file opens automatically.
 *
 * Requires: jQuery, Bootstrap 5 modals, Croppie, and window.CROPPIE_TEMP_UPLOAD_URL.
 */
(function () {
    'use strict';

    var DEFAULT_WIDTH = 400;
    var DEFAULT_HEIGHT = 300;
    var MAX_ONSCREEN_W = 520;
    var MAX_ONSCREEN_H = 360;
    var MIN_ONSCREEN = 80;

    var state = {
        mode: null, // 'single' | 'gallery'
        input: null,
        preview: null, // single mode
        container: null, // gallery mode
        fieldPrefix: null, // gallery mode
        galleryIndex: 0, // gallery mode
        queue: [], // gallery mode: remaining File objects
        originalFile: null, // file currently being processed
        dataUrl: null,
        cropped: false,
        instance: null,
    };

    function csrfToken() {
        var meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }

    // Derives (and lazily creates) the hidden "<name>_temp" field that carries
    // the uploaded temp path, placed right after the visible file input.
    // "featured_image" -> "featured_image_temp"
    // "features[3][image]" -> "features[3][image_temp]" (bracket-aware, so
    // the controller sees it as a sibling key inside the same row array).
    function tempFieldName(name) {
        var match = name.match(/^(.*\[)([^\[\]]+)(\])$/);
        return match ? match[1] + match[2] + '_temp' + match[3] : name + '_temp';
    }

    function tempFieldFor(input) {
        var next = input.nextElementSibling;
        if (next && next.classList && next.classList.contains('croppie-temp-field')) {
            return next;
        }

        var hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.className = 'croppie-temp-field';
        hidden.name = tempFieldName(input.getAttribute('name') || 'image');
        input.insertAdjacentElement('afterend', hidden);
        return hidden;
    }

    function onscreenViewport(width, height) {
        width = parseInt(width, 10) || DEFAULT_WIDTH;
        height = parseInt(height, 10) || DEFAULT_HEIGHT;

        var scale = Math.min(MAX_ONSCREEN_W / width, MAX_ONSCREEN_H / height, 1);
        var w = Math.max(MIN_ONSCREEN, Math.round(width * scale));
        var h = Math.max(MIN_ONSCREEN, Math.round(height * scale));

        return { width: w, height: h };
    }

    function initCroppie() {
        var container = document.getElementById('croppie_container');
        var widthInput = document.getElementById('croppie_width');
        var heightInput = document.getElementById('croppie_height');
        if (!container || !state.dataUrl || !widthInput || !heightInput) return;

        var viewport = onscreenViewport(widthInput.value, heightInput.value);

        if (state.instance) {
            state.instance.destroy();
            state.instance = null;
        }

        state.instance = new Croppie(container, {
            viewport: viewport,
            boundary: { width: viewport.width + 80, height: viewport.height + 80 },
            enableExif: true,
            showZoomer: true,
        });

        state.instance.bind({ url: state.dataUrl });
    }

    function uploadToServer(file, onSuccess) {
        var url = window.CROPPIE_TEMP_UPLOAD_URL;
        if (!url) return;

        var formData = new FormData();
        formData.append('image', file);
        formData.append('_token', csrfToken());

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response && response.success) {
                    onSuccess(response);
                } else if (typeof showToast === 'function') {
                    showToast('error', (response && response.message) || 'Image upload failed');
                }
            },
            error: function () {
                if (typeof showToast === 'function') {
                    showToast('error', 'Image upload failed');
                }
            },
        });
    }

    function applyResultSingle(response) {
        state.preview.src = response.url;
        state.preview.classList.remove('d-none');

        var hidden = tempFieldFor(state.input);
        hidden.value = response.temp_path;

        // The original raw selection has already been promoted to a temp
        // upload — clear it so it isn't also submitted as a plain file.
        state.input.value = '';

        // Let any listening UI (e.g. a repeatable-row live preview list)
        // know this field's image just changed.
        state.preview.dispatchEvent(new CustomEvent('croppie:uploaded', { bubbles: true, detail: response }));
    }

    function appendGalleryItem(response) {
        var index = state.galleryIndex++;
        var prefix = state.fieldPrefix;

        var wrapper = document.createElement('div');
        wrapper.className = 'gallery-crop-item position-relative d-inline-block m-1 align-top';
        wrapper.style.width = '140px';
        wrapper.innerHTML =
            '<button type="button" class="btn btn-danger btn-sm remove-gallery-crop-item" ' +
            'style="position:absolute;top:2px;right:2px;z-index:9;padding:0 6px;">&times;</button>' +
            '<img src="' + response.url + '" class="rounded border img-thumbnail" width="120" height="120" style="object-fit:cover;">' +
            '<input type="hidden" name="' + prefix + '[' + index + '][temp]" value="' + response.temp_path + '">' +
            '<input type="text" name="' + prefix + '[' + index + '][alt]" class="form-control form-control-sm mt-1" placeholder="Alt text">';

        state.container.appendChild(wrapper);
    }

    function finalizeCurrent(response) {
        if (state.mode === 'gallery') {
            appendGalleryItem(response);
        } else if (state.mode === 'single') {
            applyResultSingle(response);
        }
    }

    function startFile(file) {
        state.originalFile = file;
        state.cropped = false;

        var reader = new FileReader();
        reader.onload = function (ev) {
            state.dataUrl = ev.target.result;
            $('#globalCroppieModal').modal('show');
            initCroppie();
        };
        reader.readAsDataURL(file);
    }

    // Moves to the next queued gallery file, or fully resets when the
    // queue (and thus the whole gallery-upload session) is drained.
    function advanceGalleryQueue() {
        if (state.queue.length) {
            startFile(state.queue.shift());
        } else {
            fullReset();
        }
    }

    function resetPerFileState() {
        if (state.instance) {
            state.instance.destroy();
            state.instance = null;
        }

        state.originalFile = null;
        state.dataUrl = null;
        state.cropped = false;
    }

    function fullReset() {
        resetPerFileState();
        state.mode = null;
        state.input = null;
        state.preview = null;
        state.container = null;
        state.fieldPrefix = null;
        state.galleryIndex = 0;
        state.queue = [];
    }

    document.addEventListener('DOMContentLoaded', function () {
        var modalEl = document.getElementById('globalCroppieModal');
        if (!modalEl) return;

        // 1) FILE SELECTED — single field or gallery field.
        document.addEventListener('change', function (e) {
            if (!e.target.classList) return;

            if (e.target.classList.contains('croppie-upload')) {
                if (!e.target.files || !e.target.files[0]) return;

                var preview = document.querySelector(e.target.dataset.preview || '');
                if (!preview) return;

                state.mode = 'single';
                state.input = e.target;
                state.preview = preview;

                document.getElementById('croppie_width').value = e.target.dataset.width || DEFAULT_WIDTH;
                document.getElementById('croppie_height').value = e.target.dataset.height || DEFAULT_HEIGHT;

                startFile(e.target.files[0]);
                return;
            }

            if (e.target.classList.contains('gallery-cropper-upload')) {
                if (!e.target.files || !e.target.files.length) return;

                var container = document.querySelector(e.target.dataset.container || '');
                if (!container) return;

                state.mode = 'gallery';
                state.input = e.target;
                state.container = container;
                state.fieldPrefix = e.target.dataset.field || 'gallery_items';
                state.galleryIndex = parseInt(e.target.dataset.startIndex, 10) || 0;
                state.queue = Array.prototype.slice.call(e.target.files);

                document.getElementById('croppie_width').value = e.target.dataset.width || DEFAULT_WIDTH;
                document.getElementById('croppie_height').value = e.target.dataset.height || DEFAULT_HEIGHT;

                // Reset so re-selecting the same file(s) later still fires 'change'.
                e.target.value = '';

                advanceGalleryQueue();
            }
        });

        // 2) LIVE RESIZE — retyping width/height reshapes the crop frame.
        var resizeTimer = null;
        ['croppie_width', 'croppie_height'].forEach(function (id) {
            var el = document.getElementById(id);
            if (!el) return;
            el.addEventListener('input', function () {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(initCroppie, 250);
            });
        });

        // 3) CROP & SAVE — render at the requested output size, upload it.
        var cropBtn = document.getElementById('crop_image_global');
        if (cropBtn) {
            cropBtn.addEventListener('click', function () {
                if (!state.instance || !state.mode) return;
                if (state.mode === 'single' && (!state.input || !state.preview)) return;

                var outWidth = parseInt(document.getElementById('croppie_width').value, 10) || DEFAULT_WIDTH;
                var outHeight = parseInt(document.getElementById('croppie_height').value, 10) || DEFAULT_HEIGHT;
                var spinner = cropBtn.querySelector('.crop-btn-spinner');

                cropBtn.disabled = true;
                if (spinner) spinner.classList.remove('d-none');

                state.instance
                    .result({
                        type: 'blob',
                        size: { width: outWidth, height: outHeight },
                        format: 'jpeg',
                        quality: 0.9,
                    })
                    .then(function (blob) {
                        var file = new File([blob], 'cropped.jpg', { type: 'image/jpeg' });

                        uploadToServer(file, function (response) {
                            state.cropped = true;
                            finalizeCurrent(response);
                            cropBtn.disabled = false;
                            if (spinner) spinner.classList.add('d-none');

                            if (state.mode === 'gallery') {
                                resetPerFileState();
                                advanceGalleryQueue();
                                if (state.mode === null) {
                                    $('#globalCroppieModal').modal('hide');
                                }
                                // else: startFile() already re-showed the modal for the next file.
                            } else {
                                $('#globalCroppieModal').modal('hide');
                            }
                        });
                    })
                    .catch(function () {
                        cropBtn.disabled = false;
                        if (spinner) spinner.classList.add('d-none');
                        if (typeof showToast === 'function') {
                            showToast('error', 'Could not process the image. Please try again.');
                        }
                    });
            });
        }

        // 4) CANCEL / CLOSE WITHOUT CROPPING — upload the original file as-is,
        //    so the selection is never silently lost. In gallery mode, this
        //    finishes the current file with its original image and then
        //    automatically opens the next queued file.
        $('#globalCroppieModal').on('hidden.bs.modal', function () {
            if (!state.mode) return;

            if (!state.cropped && state.originalFile) {
                var wasGallery = state.mode === 'gallery';

                uploadToServer(state.originalFile, function (response) {
                    finalizeCurrent(response);

                    if (wasGallery) {
                        resetPerFileState();
                        advanceGalleryQueue();
                    } else {
                        fullReset();
                    }
                });

                return;
            }

            if (state.mode !== 'gallery' || state.queue.length === 0) {
                fullReset();
            }
        });

        // 5) REMOVE a gallery item (existing or newly-added — both use the
        //    same markup/class, see the blade views that render this widget).
        document.addEventListener('click', function (e) {
            if (e.target.classList && e.target.classList.contains('remove-gallery-crop-item')) {
                var item = e.target.closest('.gallery-crop-item');
                if (item) item.remove();
            }
        });
    });
})();
