<!doctype html>
<html lang="en"
      class="layout-menu-fixed layout-compact"
      data-assets-path="{{ asset('assets') }}/"
      data-template="vertical-menu-template-free">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- include head --}}
    @include('backend.partials.head')
</head>

<body>

    @if (request()->routeIs('admin.login.index', 'admin.forgot.index'))
        <div class="container-xxl">
            @yield('content')
        </div>
    @else
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">

            <div class="layout-container">

                <!-- Sidebar -->
                @include('backend.partials.sidebar')
                <!-- / Sidebar -->

                <!-- Layout container -->
                <div class="layout-page">

                    <!-- Navbar -->
                    @include('backend.partials.header')
                    <!-- / Navbar -->

                    <!-- Content wrapper -->
                    <div class="content-wrapper">

                        <!-- Content -->
                        <div class="container-xxl flex-grow-1 container-p-y">
                            @yield('content')
                        </div>
                        <!-- / Content -->

                        <!-- Footer -->
                        @include('backend.partials.footer')
                        <!-- / Footer -->
                    </div>
                    <!-- / Content wrapper -->
                </div>
                <!-- / Layout page -->

            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>

        </div>
        <!-- / Layout wrapper -->
    @endif


    <!-- ================== Core JS ================== -->

    <!-- Correct jQuery path -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>

    <!-- Dynamic page scripts -->
    @stack('scripts')

    {{-- Shared crop-and-upload modal (see public/assets/js/image-cropper.js) —
         included once here so every admin page that adds the "croppie-upload"
         or "gallery-cropper-upload" class to a file input just works, without
         each form needing to remember to include it itself. --}}
    @include('backend.partials.modal')

    <!-- Footer JS -->
    @include('backend.partials.foot')

</body>
</html>
