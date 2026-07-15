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

@stack('scripts')
<!-- End Foot Scripts Section -->
