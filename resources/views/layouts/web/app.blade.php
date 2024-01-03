<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Virtual Law Library Dashboard" name="description">
    <meta content="" name="author">
    <meta name="keywords" content="Virtual Law Library dashboard">

    <link rel="icon" type="image/png" href="{{ asset('assets/web/logo/vll-b.png') }}">
    <!-- Link of CSS files -->
    @include('layouts.web.includes.style')

    <!-- Alert -->
    @include('layouts.web.includes.alert')

    <title>Virtual Law Library - {{ $title ?? '' }}</title>
</head>

<body data-bs-spy="scroll" data-bs-offset="70">
    <!-- Start Preloader Area -->
    {{-- <div class="preloader-area">
            <div class="spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
        </div> --}}
    <!-- End Preloader Area -->

    <!-- Dark Version Btn -->
    {{-- <div class="dark-version-btn">
            <label id="switch" class="switch">
                <input type="checkbox" onchange="toggleTheme()" id="slider">
                <span class="slider round"></span>
            </label>
        </div> --}}

    <!-- Start Navbar Area -->
    @include('layouts.web.includes.nav')
    <!-- End Navbar Area -->

    <!-- Start Main Banner Area -->
    @includeWhen($banner ?? '', 'layouts.web.includes.banner')
    <!-- End Main Banner Area -->


    <!-- Content Boxes Area -->
    @yield('content')
    <!-- Content Boxes Area -->

    <!-- Start Footer Area -->
    @include('layouts.web.includes.footer')
    <!-- End Footer Area -->

    <div class="go-top"><i class="icofont-stylish-up"></i></div>

    <!-- Link of JS files -->
    @include('layouts.web.includes.script')
</body>
</html>
