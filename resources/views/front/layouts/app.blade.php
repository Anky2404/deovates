<!DOCTYPE html>
<html lang="en">

<head>
    @include('front.partials.head')
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

</body>

</html>
