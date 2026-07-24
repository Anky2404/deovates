{{--
    Shared Boxicons picker modal — included once (see layouts/app.blade.php),
    driven by public/assets/js/icon-picker.js + bx-icon-list.js. Any field
    using @include('backend.partials.icon-picker-field', [...]) opens this.
--}}
<div class="modal fade" id="iconPickerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Choose an Icon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input type="text" id="iconPickerSearch" class="form-control mb-3"
                    placeholder="Search icons… e.g. cog, arrow, user">

                <div id="iconPickerGrid" class="icon-picker-grid"></div>

                <p id="iconPickerCount" class="small text-muted text-end mt-2 mb-0"></p>
            </div>

        </div>
    </div>
</div>
