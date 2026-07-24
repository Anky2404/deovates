/**
 * Global Boxicons picker. Any field wired with:
 *   <input type="text" id="myIconInput" class="icon-picker-input" data-icon-preview="#somePreviewEl">
 *   <button type="button" class="icon-picker-trigger" data-target="#myIconInput">...</button>
 * opens one shared modal (#iconPickerModal, see icon-picker-modal.blade.php)
 * listing every Boxicon (offline, from window.BX_ICON_LIST) with a live
 * search box. Clicking an icon fills the target input, updates its preview
 * <i> element (if any), and closes the modal.
 */
(function () {
    'use strict';

    var activeInput = null;
    var activePreview = null;

    function iconList() {
        return window.BX_ICON_LIST || [];
    }

    function renderGrid(filter) {
        var grid = document.getElementById('iconPickerGrid');
        if (!grid) return;

        var term = (filter || '').trim().toLowerCase();
        var icons = iconList();
        var matches = term ? icons.filter(function (name) { return name.indexOf(term) !== -1; }) : icons;

        var limited = matches.slice(0, 300);
        var html = limited.map(function (name) {
            return '<button type="button" class="icon-picker-item" data-icon="bx ' + name + '" title="' + name + '">' +
                '<i class="bx ' + name + '"></i>' +
                '<span>' + name.replace(/^bx-/, '') + '</span>' +
                '</button>';
        }).join('');

        grid.innerHTML = html || '<p class="text-muted text-center w-100 py-4">No icons match "' + term + '".</p>';

        var countEl = document.getElementById('iconPickerCount');
        if (countEl) {
            countEl.textContent = matches.length > limited.length
                ? ('Showing first ' + limited.length + ' of ' + matches.length + ' matches')
                : (matches.length + ' icon' + (matches.length === 1 ? '' : 's'));
        }
    }

    function openPicker(input) {
        activeInput = input;
        activePreview = input.dataset.iconPreview ? document.querySelector(input.dataset.iconPreview) : null;

        var searchBox = document.getElementById('iconPickerSearch');
        if (searchBox) searchBox.value = '';
        renderGrid('');

        $('#iconPickerModal').modal('show');
    }

    function selectIcon(iconClass) {
        if (activeInput) {
            activeInput.value = iconClass;
            activeInput.dispatchEvent(new Event('input', { bubbles: true }));
        }
        if (activePreview) {
            activePreview.className = iconClass;
        }
        $('#iconPickerModal').modal('hide');
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.addEventListener('click', function (e) {
            var trigger = e.target.closest && e.target.closest('.icon-picker-trigger');
            if (trigger) {
                var input = document.querySelector(trigger.dataset.target || '');
                if (input) openPicker(input);
                return;
            }

            var item = e.target.closest && e.target.closest('.icon-picker-item');
            if (item) {
                selectIcon(item.dataset.icon);
            }
        });

        var searchBox = document.getElementById('iconPickerSearch');
        if (searchBox) {
            searchBox.addEventListener('input', function () {
                renderGrid(searchBox.value);
            });
        }
    });
})();
