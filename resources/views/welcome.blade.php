<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <!--====== Title ======-->
    <title>E.R.P Landing Page</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('public/frontend/assets/images/favicon.png') }}" type="image/png">

    <!--====== Animate CSS ======-->
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/animate.css') }}">

    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/LineIcons.2.0.css') }}">

    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/bootstrap-4.5.0.min.css') }}">

    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/default.css') }}">

    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/style.css') }}">

</head>

<body>
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->


    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER PART ENDS ======-->

    <!--====== HEADER PART START ======-->

    <header class="header-area">


        <div id="home" class="header-hero bg_cover" style="background-image: url(public/frontend/assets/images/banner-bg.svg)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="header-hero-content text-center">
                            <h2 class="header-title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.5s">TransPack E.R.P Landing Page</h2>
                            <a href="{{ route('login') }}" class="main-btn wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="1.1s">Get Started</a>
                        </div> <!-- header hero content -->
                    </div>
                </div> <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-hero-image text-center wow fadeIn" data-wow-duration="1.3s" data-wow-delay="1.4s">
                            <img src="{{ asset('public/frontend/assets/images/header-hero.png') }}" alt="hero">
                        </div> <!-- header hero image -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
            <div id="particles-1" class="particles"></div>
        </div> <!-- header hero -->
    </header>

    <!--====== HEADER PART ENDS ======-->

    <!--====== BRAMD PART START ======-->


    <!--====== FOOTER PART START ======-->

    <footer id="footer" class="footer-area pt-120">
        <div class="container">

            <div class="footer-copyright">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright d-sm-flex justify-content-between">
                            <div class="copyright-content">
                                <p class="text">Designed and Developed by <a href="https://prohussien.com" rel="nofollow">Our Team</a></p>
                            </div> <!-- copyright content -->
                        </div> <!-- copyright -->
                    </div>
                </div> <!-- row -->
            </div> <!-- footer copyright -->
        </div> <!-- container -->
        <div id="particles-2"></div>
    </footer>

    <!--====== FOOTER PART ENDS ======-->

    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->

    <!--====== PART START ======-->

<!--
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-"></div>
            </div>
        </div>
    </section>
-->

    <!--====== PART ENDS ======-->




    <!--====== Jquery js ======-->
    <script src="{{ asset('public/frontend/assets/js/vendor/jquery-3.5.1-min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/vendor/modernizr-3.7.1.min.js') }}"></script>

    <!--====== Bootstrap js ======-->
    <script src="{{ asset('public/frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/bootstrap-4.5.0.min.js') }}"></script>

    <!--====== Plugins js ======-->
    <script src="{{ asset('public/frontend/assets/js/plugins.js') }}"></script>

    <!--====== Counter Up js ======-->
    <script src="{{ asset('public/frontend/assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/jquery.counterup.min.js') }}"></script>



    <!--====== Scrolling Nav js ======-->
    <script src="{{ asset('public/frontend/assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/scrolling-nav.js') }}"></script>

    <!--====== wow js ======-->
    <script src="{{ asset('public/frontend/assets/js/wow.min.js') }}"></script>

    <!--====== Particles js ======-->
    <script src="{{ asset('public/frontend/assets/js/particles.min.js') }}"></script>

    <!--====== Main js ======-->
    <script src="{{ asset('public/frontend/assets/js/main.js') }}"></script>

</body>

</html>
