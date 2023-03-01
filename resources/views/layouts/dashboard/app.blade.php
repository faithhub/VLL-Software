<!DOCTYPE html><!-- saved from url=(0014)about:internet -->
<html lang="en" dir="ltr">
<!-- Mirrored from spruko.com/demo/azea/Azea/HTML/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Nov 2022 23:57:30 GMT -->

<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="Virtual Law Library Dashboard" name="description">
    <meta content="" name="author">
    <meta name="keywords" content="Virtual Law Library dashboard">
    <!-- Title -->
    <title>Virtual Law Library Dashboard | {{ $title ?? '' }}</title>
    @include('layouts.dashboard.includes.style')
    @include('layouts.dashboard.includes.paystack')

</head>

<body class="app sidebar-mini ltr" data-new-gr-c-s-check-loaded="14.1087.0" data-gr-ext-installed="">
    <div class="horizontalMenucontainer">
        <div class="switcher-wrapper">
            <div class="demo_changer">
                <div class="form_holder sidebar-right1 ps ps--active-y">
                </div>
            </div>
        </div>
        < !-- End Switcher -->
            <!---Global-loader-->
            {{-- <div id="global-loader" style="display: none;"> <img src="../assets/images/svgs/loader.svg" alt="loader">
            </div> --}}
            <!--- End Global-loader-->
            <!-- Page -->
            <div class="page">
                <div class="page-main">
                    <!-- app-Header -->
                    @include('layouts.dashboard.includes.header')
                    <!-- /app-Header -->
                    @include('layouts.dashboard.includes.alert')
                    <!--aside open-->
                    @include('layouts.dashboard.includes.sidebar')
                    <!--aside closed-->
                    <!-- App-Content -->
                    <div class="app-content main-content">
                        <div class="side-app">
                            <!-- CONTAINER -->
                            @yield('content')
                        </div>
                    </div> <!-- End app-content-->
                    <!--Footer-->
                    @include('layouts.dashboard.includes.footer')
                    <!-- End Footer-->
                </div>
            </div> <!-- End Page -->
            <!-- Back to top -->
            {{-- <a href="#top" id="back-to-top"><i class="fe fe-chevron-up"></i></a> --}}
            <!-- Jquery js-->
    </div>
</body>
@include('layouts.dashboard.includes.script')
</html>
