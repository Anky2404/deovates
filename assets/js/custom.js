document.addEventListener("DOMContentLoaded", function () {

    const titleInput = document.getElementById('title_input');
    const slugInput  = document.getElementById('slug_input');

    // Only execute if both fields exist
    if (titleInput && slugInput) {

        titleInput.addEventListener('input', function () {

            let slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[\s_]+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+|-+$/g, '');

            slugInput.value = slug;
        });
    }
});


/* =====================================================
    DELETE CONFIRMATION
===================================================== */
document.querySelectorAll(".js-delete").forEach(form => {

        form.addEventListener("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Yes, delete it",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

    });


    // Toggle Status Function
$(document).on('click', '.toggle-status', function () {

    let badge = $(this);
    let type = badge.data('type') ?? '';
    let url = badge.data('url');

    $.ajax({
        url: url,
        type: 'GET',

        beforeSend: function () {

            badge.css({
                'pointer-events': 'none',
                'opacity': '0.6'
            });
        },

        success: function (response) {

            if (response.success) {

                let activeText = type ? 'Yes' : 'Active';
                let inactiveText = type ? 'No' : 'Inactive';

                if (response.status) {

                    badge
                        .removeClass('bg-label-danger')
                        .addClass('bg-label-success')
                        .text(activeText);

                } else {

                    badge
                        .removeClass('bg-label-success')
                        .addClass('bg-label-danger')
                        .text(inactiveText);
                }

                showToast('success', 'Status updated successfully');

            } else {

                showToast('error', response.message || 'Status update failed');
            }
        },

        error: function () {

            showToast('error', 'Something went wrong');
        },

        complete: function () {

            badge.css({
                'pointer-events': 'auto',
                'opacity': '1'
            });
        }
    });
});


// Toggle Status Function (switch style)
$(document).on('change', '.toggle-status-switch', function () {

    let toggle = $(this);
    let url = toggle.data('url');
    let previousState = !toggle.is(':checked');

    $.ajax({
        url: url,
        type: 'GET',

        beforeSend: function () {
            toggle.prop('disabled', true);
        },

        success: function (response) {

            if (response.success) {

                toggle.prop('checked', response.status);
                showToast('success', 'Status updated successfully');

            } else {

                toggle.prop('checked', previousState);
                showToast('error', response.message || 'Status update failed');
            }
        },

        error: function () {

            toggle.prop('checked', previousState);
            showToast('error', 'Something went wrong');
        },

        complete: function () {
            toggle.prop('disabled', false);
        }
    });
});


$('.json-auto').on('blur', function () {
        let value = $(this).val().trim();
        if (value === '') return;
        try {
            let parsed = JSON.parse(value);
            if (Array.isArray(parsed)) {
                $(this).val(JSON.stringify(parsed));
                return;
            }
        } catch (e) {}
        let match = value.match(/^(\[.*\])(.*)$/);
        if (match) {
            try {
                let oldArray = JSON.parse(match[1]);
                let extra = match[2]
                    .replace(/^,/, '')
                    .split(',')
                    .map(v => v.trim())
                    .filter(v => v !== '');
                let finalArray = [...oldArray, ...extra];
                $(this).val(JSON.stringify(finalArray));
                return;
            } catch (e) {}
        }
        let arr = value
            .split(',')
            .map(v => v.trim())
            .filter(v => v !== '');
        $(this).val(JSON.stringify(arr));
    });











// Croppie crop-and-upload wiring now lives in assets/js/image-cropper.js
// (global, reusable, and temp-upload aware — see that file for details).


    /* ===========================================================
   GLOBAL FUNCTION — SAFE JSON PARSER
=========================================================== */
function parseMetaToJson(input) {
    if (!input || input.trim() === "") return "";
    input = input.trim();
    try {
        const parsed = JSON.parse(input);
        if (typeof parsed === "object") {
            return input;
        }
    } catch (e) {}
    if (input.includes(":")) {
        const result = {};
        input.split(",").forEach(item => {
            const [key, value] = item.split(":").map(x =>
                x.trim().replace(/^['"]|['"]$/g, "")
            );
            if (key && value !== undefined) {
                result[key] = value;
            }
        });
        return JSON.stringify(result);
    }
    const arr = input
        .split(",")
        .map(x => x.trim().replace(/^['"]|['"]$/g, ""))
        .filter(Boolean);

    return JSON.stringify(arr);
}



/* ===========================================================
   GLOBAL HANDLER — FIND meta_input ANYWHERE
=========================================================== */
document.addEventListener("DOMContentLoaded", function () {

    // collect available fields (meta_input, conditions_input)
    const jsonInputs = [
        document.getElementById("meta_input"),
        document.getElementById("conditions_input")
    ].filter(Boolean);

    if (jsonInputs.length === 0) return;

    const parentForm = jsonInputs[0].closest("form");

    if (!parentForm) return;

    parentForm.addEventListener("submit", function () {

        jsonInputs.forEach(field => {

            // clean Blade whitespace issues
            field.value = field.value.trim().replace(/\n/g, " ");

            if (field.value !== "") {
                field.value = parseMetaToJson(field.value);
            }

        });

    });

});


$(document).on('change', '.image-preview-input', function () {

    let input = this;

    if ($(input).prop('multiple')) {

        let previewContainer = $($(input).data('preview'));

        let files = Array.from(input.files);

        files.forEach((file, index) => {

            let uniqueId = Date.now() + index;

            let reader = new FileReader();

            reader.onload = function (e) {

                previewContainer.append(`
                    <div
                        class="position-relative d-inline-block m-1 preview-item"
                        data-id="${uniqueId}"
                    >

                        <button
                            type="button"
                            class="btn btn-danger btn-sm remove-preview-image"
                            style="position:absolute; top:5px; right:5px; z-index:9; padding:0px 6px;"
                        >
                            ×
                        </button>

                        <img
                            src="${e.target.result}"
                            class="rounded border img-thumbnail"
                            width="130"
                            height="130"
                        >
                    </div>
                `);
            };

            reader.readAsDataURL(file);
        });

    } else {

        let preview = $($(input).data('preview'));

        if (input.files && input.files[0]) {

            let reader = new FileReader();

            reader.onload = function (e) {

                preview.attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
});

$(document).on('click', '.remove-preview-image', function () {

    $(this).closest('.preview-item').remove();
});

$(document).on('click', '.remove-old-image', function () {

    $(this).closest('.old-gallery-item').remove();
});


