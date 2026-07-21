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
 * item card is appended with a hidden "<field>[i][temp]" path, a text
 * "<field>[i][title]" input, a text "<field>[i][alt]" input, an X button to
 * remove the item, and a "Copy link" button that copies the image's
 * relative storage path to the clipboard.
 *
 * The item container additionally gets class "gallery-sortable" to enable
 * drag-to-reorder (via Sortable.js, dragging by the grip handle on each
 * card). On drop, item field names are renumbered to match the new order;
 * if the container also carries data-reorder-url + data-uuid (edit mode
 * only — there's no record to persist to yet on a create form), the new
 * order is saved immediately via AJAX POST {uuid, order: [mediaId, ...]}
 * (only items with an existing media id — see data-id below — participate).
 *
 * Requires: jQuery, Bootstrap 5 modals, Croppie, Sortable.js, and
 * window.CROPPIE_TEMP_UPLOAD_URL.
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
        wrapper.dataset.path = response.temp_path;
        wrapper.innerHTML =
            '<span class="gallery-drag-handle" title="Drag to reorder" ' +
            'style="position:absolute;top:2px;left:2px;z-index:9;cursor:move;background:#fff;border-radius:3px;padding:0 4px;font-size:14px;line-height:1.4;">&#9776;</span>' +
            '<button type="button" class="btn btn-danger btn-sm remove-gallery-crop-item" ' +
            'style="position:absolute;top:2px;right:2px;z-index:9;padding:0 6px;">&times;</button>' +
            '<img src="' + response.url + '" class="rounded border img-thumbnail" width="120" height="120" style="object-fit:cover;">' +
            '<input type="hidden" name="' + prefix + '[' + index + '][temp]" value="' + response.temp_path + '">' +
            '<input type="text" name="' + prefix + '[' + index + '][title]" class="form-control form-control-sm mt-1" placeholder="Title">' +
            '<input type="text" name="' + prefix + '[' + index + '][alt]" class="form-control form-control-sm mt-1" placeholder="Alt text">' +
            '<button type="button" class="btn btn-outline-secondary btn-sm copy-gallery-link w-100 mt-1" ' +
            'data-path="' + response.temp_path + '" title="Copy image path">' +
            '<i class="bx bx-link"></i> Copy link</button>';

        state.container.appendChild(wrapper);
    }

    // Renumber "<field>[i][...]" names to match the current DOM order, so a
    // drag reorder (or a removal) is reflected correctly on form submit.
    function reindexGalleryItems(container) {
        Array.prototype.forEach.call(container.querySelectorAll('.gallery-crop-item'), function (item, index) {
            Array.prototype.forEach.call(item.querySelectorAll('input[name]'), function (input) {
                input.name = input.name.replace(/\[\d+\]/, '[' + index + ']');
            });
        });
    }

    // Only items that already have a media id (saved rows) can be reordered
    // server-side; unsaved (temp, not-yet-submitted) items have no id yet
    // and are skipped here — they'll get one, and their position, on submit.
    function collectGalleryOrder(container) {
        return Array.prototype.map.call(container.querySelectorAll('.gallery-crop-item'), function (item) {
            return item.dataset.id || '';
        }).filter(Boolean);
    }

    // In edit mode (data-reorder-url + data-uuid present) a drag persists
    // immediately; in create mode there's no record to persist to yet, so
    // the new order just rides along with the rest of the form on submit.
    function persistGalleryOrder(container) {
        var url = container.dataset.reorderUrl;
        var uuid = container.dataset.uuid;
        var order = collectGalleryOrder(container);
        if (!url || !uuid || !order.length) return;

        $.ajax({
            url: url,
            type: 'POST',
            data: { _token: csrfToken(), uuid: uuid, order: order },
            success: function (response) {
                if (!response || !response.success) {
                    if (typeof showToast === 'function') {
                        showToast('error', (response && response.message) || 'Failed to save order');
                    }
                }
            },
            error: function () {
                if (typeof showToast === 'function') {
                    showToast('error', 'Failed to save order');
                }
            },
        });
    }

    function initGallerySortable() {
        if (typeof Sortable === 'undefined') return;

        document.querySelectorAll('.gallery-sortable').forEach(function (container) {
            if (container.sortableInstance) return;

            container.sortableInstance = new Sortable(container, {
                animation: 150,
                handle: '.gallery-drag-handle',
                onEnd: function () {
                    reindexGalleryItems(container);
                    persistGalleryOrder(container);
                },
            });
        });
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
        initGallerySortable();

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
            if (e.target.closest && e.target.closest('.remove-gallery-crop-item')) {
                var item = e.target.closest('.gallery-crop-item');
                var container = item ? item.closest('.gallery-sortable') : null;
                if (item) item.remove();
                if (container) reindexGalleryItems(container);
                return;
            }

            // 6) COPY LINK — copies the image's relative storage path.
            var copyBtn = e.target.closest && e.target.closest('.copy-gallery-link');
            if (copyBtn) {
                var path = copyBtn.dataset.path;
                if (!path) return;

                var done = function () {
                    if (typeof showToast === 'function') showToast('success', 'Image path copied');
                };
                var fail = function () {
                    if (typeof showToast === 'function') showToast('error', 'Could not copy path');
                };

                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(path).then(done, fail);
                } else {
                    var helper = document.createElement('textarea');
                    helper.value = path;
                    helper.style.position = 'fixed';
                    helper.style.opacity = '0';
                    document.body.appendChild(helper);
                    helper.select();
                    try {
                        document.execCommand('copy');
                        done();
                    } catch (err) {
                        fail();
                    }
                    document.body.removeChild(helper);
                }
            }
        });
    });
})();
