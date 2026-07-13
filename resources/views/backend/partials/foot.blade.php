{{-- ================= CORE HELPERS (NO DEFER) ================= --}}
<script src="{{ asset('assets/backend/vendor/js/helpers.js') }}"></script>
<script src="{{ asset('assets/backend/js/config.js') }}"></script>

{{-- ================= CORE LIBS ================= --}}
<script src="{{ asset('assets/backend/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/js/bootstrap.js') }}"></script>

{{-- ================= UI & PLUGINS ================= --}}
<script src="{{ asset('assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/js/menu.js') }}"></script>

{{-- ================= EXTRA PLUGINS ================= --}}
<script src="{{ asset('assets/backend/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/Sortable.min.js') }}"></script>
<script src="{{ asset('assets/js/croppie.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

<script src="{{ asset('assets/js/custom.js') }}"></script>


{{-- ================= MAIN APP (MUST BE LAST) ================= --}}
<script src="{{ asset('assets/backend/js/main.js') }}"></script>
<script src="{{ asset('assets/backend/js/dashboards-analytics.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- ================= CKEDITOR ================= --}}
<script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>

<script>
    if (typeof CKEDITOR !== 'undefined') {
        if (document.getElementById('short_description')) {
            CKEDITOR.replace('short_description', { height: 200 });
        }
        if (document.getElementById('description')) {
            CKEDITOR.replace('description', { height: 400 });
        }
    }
</script>

{{-- ================= SWEETALERT TOAST ================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const toastConfig = {
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        customClass: {
            popup: 'swal2-toast-custom'
        }
    };

    @if(session('success'))
        Swal.fire({
            ...toastConfig,
            icon: 'success',
            title: @json(session('success'))
        });
    @endif

    @if(session('error'))
        Swal.fire({
            ...toastConfig,
            icon: 'error',
            title: @json(session('error'))
        });
    @endif
});
</script>

{{-- ================= OPTIONAL ================= --}}
<script async src="https://buttons.github.io/buttons.js"></script>
