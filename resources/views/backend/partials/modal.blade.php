<div class="modal fade" id="globalCroppieModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Crop Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label mb-1" for="croppie_width">Width (px)</label>
                        <input type="number" id="croppie_width" class="form-control form-control-sm" min="20" max="4000">
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-1" for="croppie_height">Height (px)</label>
                        <input type="number" id="croppie_height" class="form-control form-control-sm" min="20" max="4000">
                    </div>
                </div>

                <div id="croppie_container" style="width:100%; height:420px;"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="crop_image_global">
                    <span class="crop-btn-spinner spinner-border spinner-border-sm d-none me-1"></span>
                    Crop &amp; Save
                </button>
            </div>

        </div>
    </div>
</div>
