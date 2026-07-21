/**
 * Shared success/error toast helper (SweetAlert2).
 * Used by both the admin panel and the public site so every
 * non-interactive alert shares the same position, timing and look.
 */
(function (window) {
    var TOAST_DURATION = 6000;

    function showToast(icon, message) {
        if (!message || typeof Swal === 'undefined') return;

        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: icon,
            title: message,
            showConfirmButton: false,
            timer: TOAST_DURATION,
            timerProgressBar: true,
            customClass: {
                popup: 'swal2-toast-custom'
            }
        });
    }

    window.showToast = showToast;
})(window);
