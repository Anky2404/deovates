<!DOCTYPE html>
<html lang="en">

<head>
    @include('front.partials.head')

    <title>@yield('title', config('app.name'))</title>

    <meta name="description" content="@yield('meta_description', 'Welcome to ' . config('app.name'))">
    <meta name="keywords" content="@yield('meta_keywords', '')">
    <meta name="author" content="{{ config('app.name') }}">


    @stack('styles')
</head>

<body>

    @include('front.partials.preloader')

    @include('front.partials.header')

    <main>
        @yield('content')
    </main>

    @include('front.partials.footer')

    @include('front.partials.foot')

    @stack('scripts')

</body>

</html>
