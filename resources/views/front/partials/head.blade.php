<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{--
    LCP fix: hero/slider background images on this site are applied via
    JS (data-background + jQuery, see main.js), which the browser's
    preload scanner cannot see — without this hint the LCP image doesn't
    even start downloading until after jQuery loads and runs. Each page
    pushes its own above-the-fold image path here so it starts fetching
    immediately, in parallel with everything else in <head>.
--}}
@stack('preload')

<title>@yield('title', config('constants.BUSINESS.name') . ': Web Design, Website Development, SEO, Digital Marketing & Branding Agency')</title>
<meta name="title" content="@yield('title', config('constants.BUSINESS.name') . ': Web Design, Website Development, SEO, Digital Marketing & Branding Agency')">
<meta name="description" content="@yield('meta_description', config('constants.BUSINESS.name') . ' designs and builds websites, runs SEO campaigns, and manages digital marketing for growing businesses. See how our web design, development, and branding work helps clients get found online and win more customers.')">
<meta name="keywords" content="@yield('meta_keywords', 'web design agency, website development, SEO services, digital marketing agency, branding agency, custom software development, mobile app development, ecommerce website development')">
<meta name="author" content="{{ config('constants.BUSINESS.name') }}">
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="language" content="English">
<meta name="theme-color" content="#0B3C8A">

<link rel="canonical" href="{{ url()->current() }}">

   <link rel="icon" type="image/svg+xml" href="{{ asset('assets/front/favicons/favicon.svg') }}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/front/favicons/favicon-96x96.png') }}">
<link rel="shortcut icon" href="{{ asset('assets/front/favicons/favicon.ico') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/front/favicons/apple-touch-icon.png') }}">
<link rel="manifest" href="{{ asset('assets/front/favicons/site.webmanifest') }}">

<meta property="og:type" content="website">
<meta property="og:title" content="@yield('title', config('constants.BUSINESS.name') . ': Web Design, Website Development, SEO & Digital Marketing Agency')">
<meta property="og:description" content="@yield('meta_description', config('constants.BUSINESS.name') . ' designs and builds websites, runs SEO campaigns, and manages digital marketing for growing businesses.')">
<meta property="og:image" content="@yield('og_image', asset('assets/front/img/og-image.jpg'))">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:site_name" content="{{ config('constants.BUSINESS.name') }}">
<meta property="og:locale" content="en_US">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="@yield('title', config('constants.BUSINESS.name'))">
<meta name="twitter:description" content="@yield('meta_description', 'Web design, website development, SEO, and digital marketing services from ' . config('constants.BUSINESS.name') . '.')">
<meta name="twitter:image" content="@yield('og_image', asset('assets/front/img/og-image.jpg'))">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://cdnjs.cloudflare.com">
<link rel="preconnect" href="https://unpkg.com">

{{--
    Only bootstrap.min.css + style.css block render (they hold the
    above-the-fold layout, so deferring them would cause a flash of
    unstyled content). Everything else here is a carousel/icon/popup
    library only used below the fold or on interaction, so it's loaded
    via the preload+swap trick (non-blocking) instead of a normal
    <link rel="stylesheet"> — same technique already used for the two
    CDN icon fonts below. Saves ~7s of estimated render-blocking time
    on PageSpeed's mobile throttled profile.
--}}
<link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">

<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@500;600;700;800&family=Oswald:wght@300;400;500;600;700&display=swap" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" as="style" href="https://fonts.googleapis.com/css?family=Barlow:200,300,400,500,600,700,800,900|Teko:300,400,500,600,700&display=swap" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" as="style" href="{{ asset('assets/front/css/owl.carousel.min.css') }}" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" as="style" href="{{ asset('assets/front/css/slicknav.css') }}" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" as="style" href="{{ asset('assets/front/css/animate.min.css') }}" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" as="style" href="{{ asset('assets/front/css/magnific-popup.css') }}" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" as="style" href="{{ asset('assets/front/css/fontawesome-all.min.css') }}" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" as="style" href="{{ asset('assets/front/css/themify-icons.css') }}" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" as="style" href="{{ asset('assets/front/css/slick.css') }}" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" as="style" href="{{ asset('assets/front/css/nice-select.css') }}" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" as="style" href="{{ asset('assets/front/fonts/icomoon/style.css') }}" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" as="style" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" onload="this.onload=null;this.rel='stylesheet'">

<noscript>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@500;600;700;800&family=Oswald:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Barlow:200,300,400,500,600,700,800,900|Teko:300,400,500,600,700&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</noscript>
