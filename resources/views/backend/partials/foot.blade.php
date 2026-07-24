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

<script>
    window.CROPPIE_TEMP_UPLOAD_URL = "{{ route('admin.media.temp-upload') }}";
</script>
<script src="{{ asset('assets/js/image-cropper.js') }}"></script>

<script src="{{ asset('assets/js/custom.js') }}"></script>

<script src="{{ asset('assets/js/bx-icon-list.js') }}"></script>
<script src="{{ asset('assets/js/icon-picker.js') }}"></script>


{{-- ================= MAIN APP (MUST BE LAST) ================= --}}
<script src="{{ asset('assets/js/Sortable.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/main.js') }}"></script>
<script src="{{ asset('assets/backend/js/dashboards-analytics.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- ================= CKEDITOR ================= --}}
<script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>

 @once

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var $counters = document.querySelectorAll('.site-visitor-counter[data-count]');

            $counters.forEach(function(el) {
                var target = parseInt(el.getAttribute('data-count'), 10) || 0;
                var numberEl = el.querySelector('.site-visitor-counter-number');
                var animated = false;

                function animateCount() {
                    if (animated) return;
                    animated = true;

                    var start = 0;
                    var duration = 1200;
                    var startTime = null;

                    function step(timestamp) {
                        if (!startTime) startTime = timestamp;
                        var progress = Math.min((timestamp - startTime) / duration, 1);
                        var value = Math.floor(progress * (target - start) + start);
                        numberEl.textContent = value.toLocaleString();

                        if (progress < 1) {
                            window.requestAnimationFrame(step);
                        } else {
                            numberEl.textContent = target.toLocaleString();
                        }
                    }

                    window.requestAnimationFrame(step);
                }

                if ('IntersectionObserver' in window) {
                    var observer = new IntersectionObserver(function(entries) {
                        entries.forEach(function(entry) {
                            if (entry.isIntersecting) {
                                animateCount();
                                observer.disconnect();
                            }
                        });
                    }, {
                        threshold: 0.3
                    });

                    observer.observe(el);
                } else {
                    animateCount();
                }
            });
        });
    </script>
@endonce

<script>
    if (typeof CKEDITOR !== 'undefined') {
        // Class-based init: every textarea with .ckeditor-field gets a CKEditor instance.
        // data-ck-height on the element overrides the default height.
        document.querySelectorAll('.ckeditor-field').forEach(function(el, index) {
            if (!el.id) {
                el.id = 'ckeditor_' + index;
            }
            if (!CKEDITOR.instances[el.id]) {
                CKEDITOR.replace(el.id, {
                    height: parseInt(el.dataset.ckHeight, 10) || 250
                });
            }
        });

        // Legacy safety net: old hardcoded IDs from before the class-based refactor.
        // Guarded against double-init in case an element also carries .ckeditor-field.
        ['short_description', 'description', 'left_description', 'right_list'].forEach(function(id) {
            var heights = {
                short_description: 200,
                description: 400,
                left_description: 300,
                right_list: 300
            };
            if (document.getElementById(id) && !CKEDITOR.instances[id]) {
                CKEDITOR.replace(id, {
                    height: heights[id]
                });
            }
        });
    }
</script>

<script>
    // URL inputs paired with a static "https://" prefix: strip any scheme
    // the user types or pastes anyway, live, so the field always holds just
    // the domain/path and never ends up with a doubled-up protocol.
    document.querySelectorAll('.url-scheme-strip').forEach(function(el) {
        var strip = function() {
            var stripped = el.value.replace(/^\s*https?:\/\//i, '');
            if (stripped !== el.value) {
                el.value = stripped;
            }
        };
        el.addEventListener('input', strip);
        el.addEventListener('blur', strip);
        el.addEventListener('paste', function() {
            setTimeout(strip, 0);
        });
    });
</script>




{{-- ================= SWEETALERT TOAST ================= --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('success'))
            showToast('success', @json(session('success')));
        @endif

        @if (session('error'))
            showToast('error', @json(session('error')));
        @endif
    });
</script>

{{-- ================= OPTIONAL ================= --}}
<script async src="https://buttons.github.io/buttons.js"></script>


