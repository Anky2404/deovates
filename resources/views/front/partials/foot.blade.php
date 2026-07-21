<!-- Start Foot Scripts Section -->
<script src="{{ asset('assets/front/js/vendor/modernizr-3.5.0.min.js') }}"></script>

<script src="{{ asset('assets/front/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/front/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/front/js/jquery.slicknav.min.js') }}"></script>

<script src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/front/js/slick.min.js') }}"></script>

<script src="{{ asset('assets/front/js/gijgo.min.js') }}"></script>

<script src="{{ asset('assets/front/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/front/js/animated.headline.js') }}"></script>
<script src="{{ asset('assets/front/js/jquery.magnific-popup.js') }}"></script>

<script src="{{ asset('assets/front/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('assets/front/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/front/js/jquery.sticky.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>

<script src="{{ asset('assets/front/js/contact.js') }}"></script>
<script src="{{ asset('assets/front/js/jquery.form.js') }}"></script>
<script src="{{ asset('assets/front/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/front/js/mail-script.js') }}"></script>
<script src="{{ asset('assets/front/js/jquery.ajaxchimp.min.js') }}"></script>

<script src="{{ asset('assets/front/js/plugins.js') }}"></script>
<script src="{{ asset('assets/front/js/main.js') }}"></script>
<script src="{{ asset('assets/front/js/isotope.min.js') }}"></script>

{{-- ================= ALERT TOASTS ================= --}}
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/toast.js') }}"></script>
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

@stack('scripts')
<!-- End Foot Scripts Section -->
