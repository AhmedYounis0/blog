<!DOCTYPE html>
<html lang="en">
@include('theme.partials.head')
<body>
<!--================Header Menu Area =================-->
@include('theme.partials.nav')
<!--================Header Menu Area =================-->
<main class="site-main">
    @yield('content')
</main>
<!--================ Start Footer Area =================-->
@include('theme.partials.footer')
<!--================ End Footer Area =================-->
@include('theme.partials.scripts')
</body>
</html>
