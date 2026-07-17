/**
 * Powers the repeatable field-groups rendered by
 * resources/views/backend/partials/_dynamic_form_fields.blade.php
 * (Form Builder live preview, Page/Section content editor, etc).
 *
 * "Add Another" clones a <template id="tpl-group-{idPrefix}-{groupKey}">,
 * replacing the "__I__" placeholder with the next instance index. The
 * remove button deletes an instance (but never the last one). Any
 * gallery-sortable container inside a freshly cloned instance is wired up
 * here too, since the global image-cropper.js only initializes containers
 * present at page load.
 */
(function () {
    'use strict';

    function initGalleryContainers(scope) {
        if (typeof Sortable === 'undefined') return;
        scope.querySelectorAll('.gallery-sortable').forEach(function (container) {
            if (container.sortableInstance) return;
            container.sortableInstance = new Sortable(container, {
                animation: 150,
                handle: '.gallery-drag-handle',
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.addEventListener('click', function (e) {
            const addBtn = e.target.closest('.add-repeater-instance');
            if (addBtn) {
                const group = addBtn.dataset.group;
                const instances = document.querySelector(`.repeater-instances[data-group-instances="${group}"]`);
                const tpl = document.getElementById(`tpl-group-${group}`);
                if (!instances || !tpl) return;

                const index = instances.children.length;
                const html = tpl.innerHTML.split('__I__').join(index);

                const wrapper = document.createElement('div');
                wrapper.innerHTML = html.trim();
                const node = wrapper.firstElementChild;

                instances.appendChild(node);
                initGalleryContainers(node);
                return;
            }

            const removeBtn = e.target.closest('.remove-repeater-instance');
            if (removeBtn) {
                const instance = removeBtn.closest('.repeater-instance');
                const instances = instance ? instance.parentElement : null;
                if (!instances) return;

                if (instances.children.length > 1) {
                    instance.remove();
                } else if (typeof showToast === 'function') {
                    showToast('error', 'At least one entry is required.');
                }
            }
        });
    });
})();
