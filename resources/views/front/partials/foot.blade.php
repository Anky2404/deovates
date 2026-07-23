<!-- Start Foot Scripts Section -->
{{--
    This site's front-end runs Bootstrap 4 (assets/front/js/bootstrap.min.js
    — a separate, older bundle from the backend admin panel's Bootstrap 5).
    Front-end modals still use the `.btn-close` markup/class from Bootstrap
    5 examples, which Bootstrap 4's CSS doesn't style at all (it renders as
    a blank box) — this shim gives it the classic "×" look so every
    front-end modal's close button is visible without rewriting each one
    to Bootstrap 4's <button class="close"><span>&times;</span></button>
    markup.
--}}
<style>
    .modal .btn-close {
        width: 1em;
        height: 1em;
        padding: 0.25em;
        background: transparent;
        border: 0;
        border-radius: 0.25rem;
        opacity: 0.5;
        position: relative;
    }
    .modal .btn-close::before {
        content: "\00d7";
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        line-height: 1;
        color: #000;
    }
    .modal .btn-close:hover {
        opacity: 0.85;
    }
</style>

{{--
    defer lets the browser fetch all of these in parallel as soon as the
    HTML is parsed instead of one-at-a-time; execution still happens in
    this exact order, right before DOMContentLoaded, so nothing below that
    depends on load order (jQuery before its plugins, etc.) is affected.
--}}
<script src="{{ asset('assets/front/js/vendor/modernizr-3.5.0.min.js') }}" defer></script>

<script src="{{ asset('assets/front/js/vendor/jquery-1.12.4.min.js') }}" defer></script>
<script src="{{ asset('assets/front/js/popper.min.js') }}" defer></script>
<script src="{{ asset('assets/front/js/bootstrap.min.js') }}" defer></script>

<script src="{{ asset('assets/front/js/jquery.slicknav.min.js') }}" defer></script>

<script src="{{ asset('assets/front/js/owl.carousel.min.js') }}" defer></script>
<script src="{{ asset('assets/front/js/slick.min.js') }}" defer></script>

<script src="{{ asset('assets/front/js/gijgo.min.js') }}" defer></script>

<script src="{{ asset('assets/front/js/wow.min.js') }}" defer></script>
<script src="{{ asset('assets/front/js/animated.headline.js') }}" defer></script>
<script src="{{ asset('assets/front/js/jquery.magnific-popup.js') }}" defer></script>

<script src="{{ asset('assets/front/js/jquery.scrollUp.min.js') }}" defer></script>
<script src="{{ asset('assets/front/js/jquery.nice-select.min.js') }}" defer></script>
<script src="{{ asset('assets/front/js/jquery.sticky.js') }}" defer></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js" defer></script>

<script src="{{ asset('assets/front/js/contact.js') }}" defer></script>
<script src="{{ asset('assets/front/js/jquery.form.js') }}" defer></script>
<script src="{{ asset('assets/front/js/jquery.validate.min.js') }}" defer></script>
<script src="{{ asset('assets/front/js/mail-script.js') }}" defer></script>
<script src="{{ asset('assets/front/js/jquery.ajaxchimp.min.js') }}" defer></script>

<script src="{{ asset('assets/front/js/plugins.js') }}" defer></script>
<script src="{{ asset('assets/front/js/main.js') }}" defer></script>
<script src="{{ asset('assets/front/js/isotope.min.js') }}" defer></script>

{{-- ================= ALERT TOASTS ================= --}}
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}" defer></script>
<script src="{{ asset('assets/js/toast.js') }}" defer></script>

@if (config('constants.ELFSIGHT_WIDGET_ID'))
    {{-- Google Reviews widget (elfsight.com) platform script — loads
         site-wide but does nothing unless a page actually has the widget
         div (only resources/views/front/testimonials/index.blade.php
         right now), and is lazy/async so it doesn't block rendering. --}}
    <script src="https://elfsightcdn.com/platform.js" async></script>
@endif
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
