<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    @php
        $current_lang =  LaravelLocalization::getCurrentLocale();
    @endphp
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <title>@yield('title') </title>
        <link rel="icon" type="image/x-icon" href="{{asset('public/backend/crock/assets/img/favicon.ico')}}"/>

        {{-- begain style  --}}
    @if($current_lang == 'ar')
        @include('layouts.dashboard.rtl.style')
    @else
    @include('layouts.dashboard.ltr.style')
    @endif




    <style>
        .btn-link{
           background-color: #fafafa !important;
           border:none;

        }
        .btn-link:hover{
           background-color: #fafafa !important;
           border:none;

        }
    </style>


</head>
<body class="sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    @include('layouts.dashboard._header')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->



        @include('layouts.dashboard._aside')

         <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">

            <div class="layout-px-spacing">
                    @yield('content')
            </div>


            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2021 <a target="_blank" href="https://prohussein.com">Prohussein</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg> <a target="_blank" href="https://prohussein.com"> Prohussein </a> </p>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->


    </div>
    <!-- END MAIN CONTAINER -->
    @if($current_lang == 'ar')


        @include('layouts.dashboard.rtl.script')

    @else

        @include('layouts.dashboard.ltr.script')

    @endif

</body>
</html>
