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
<script src="{{ asset('assets/js/toast.js') }}"></script>
<script src="{{ asset('assets/js/Sortable.min.js') }}"></script>
<script src="{{ asset('assets/js/croppie.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

<script>window.CROPPIE_TEMP_UPLOAD_URL = "{{ route('admin.media.temp-upload') }}";</script>
<script src="{{ asset('assets/js/image-cropper.js') }}"></script>

<script src="{{ asset('assets/js/custom.js') }}"></script>


{{-- ================= MAIN APP (MUST BE LAST) ================= --}}
<script src="{{ asset('assets/js/Sortable.min.js') }}"></script>
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
    @if(session('success'))
        showToast('success', @json(session('success')));
    @endif

    @if(session('error'))
        showToast('error', @json(session('error')));
    @endif
});
</script>

{{-- ================= OPTIONAL ================= --}}
<script async src="https://buttons.github.io/buttons.js"></script>
