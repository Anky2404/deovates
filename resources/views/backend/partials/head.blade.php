<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield('title', config('constants.BUSINESS.name') . ' | Dashboard')</title>
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />


      <!-- ================= FAVICONS ================= -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/apple-touch-icon.png') }}">

<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon-32x32.png') }}">

<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon-16x16.png') }}">

<link rel="manifest" href="{{ asset('assets/site.webmanifest') }}">

    <!-- Google Fonts (Preconnect + Load) -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
    />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Base Styles (Critical – NO lazy loading) -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/fonts/iconify-icons.css') }}" />

    <!-- Theme & Layout -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/demo.css') }}" />

    <!-- Vendor Styles -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/croppie.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />

    <!-- Auth Pages Only -->
    @if (request()->routeIs('admin.login.index','admin.forgot.index'))
        <link
            rel="stylesheet"
            href="{{ asset('assets/backend/vendor/css/pages/page-auth.css') }}"
        />
    @endif

    <!-- Custom Inline Overrides -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Public Sans', sans-serif;
            background-color: #f5f5f9;
        }

        .layout-wrapper {
            display: flex;
            min-height: 100vh;
            overflow: hidden;
        }

        /* Keep every admin listing table row the same height regardless of
           image size or description length, so rows line up consistently
           across all index pages. */
        .table > tbody > tr > td {
            height: 76px;
            vertical-align: middle;
        }

        .table-thumb {
            width: 56px;
            height: 56px;
            object-fit: cover;
            border-radius: 6px;
        }

        .description-column {
            max-width: 320px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
