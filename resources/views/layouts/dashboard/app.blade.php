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
    <link href="{{asset('public/backend/crock/assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('public/backend/crock/assets/js/loader.js')}}"></script>
    {{-- <script src="https://use.fontawesome.com/53c80d5eef.js"></script> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/crock/plugins/fontawsome/css/font-awesome.min.css') }}">
    @if($current_lang == 'ar')
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('public/backend/crock/rtl/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/backend/crock/rtl/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

     <!-- BEGIN THEME GLOBAL STYLES -->
     <link href="{{ asset('public/backend/crock/rtl/plugins/noUiSlider/nouislider.min.css') }}" rel="stylesheet" type="text/css">
     <!-- END THEME GLOBAL STYLES -->

     <!--  BEGIN CUSTOM STYLE FILE  -->
     <link href="{{ asset('public/backend/crock/rtl/plugins/noUiSlider/custom-nouiSlider.css') }}" rel="stylesheet" type="text/css">
     <link href="{{ asset('public/backend/crock/rtl/plugins/bootstrap-range-Slider/bootstrap-slider.css') }}" rel="stylesheet" type="text/css">
     <!--  END CUSTOM STYLE FILE  -->



    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/crock/rtl/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/crock/rtl/plugins/table/datatable/dt-global_style.css')}}">
    <link href="{{asset('public/backend/crock/rtl/assets/css/elements/miscellaneous.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/backend/crock/rtl/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/backend/crock/rtl/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/crock/rtl/plugins/select2/select2.min.css')}}">
    <link href="{{asset('public/backend/crock/rtl/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/crock/rtl/assets/css/elements/alert.css')}}">

    <link href="{{asset('public/backend/crock/rtl/plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/crock/rtl/assets/css/forms/switches.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/crock/rtl/plugins/font-icons/fontawesome/css/regular.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/crock/rtl/plugins/font-icons/fontawesome/css/fontawesome.css')}}">
    <link href="{{ asset('public/backend/crock/rtl/assets/css/elements/custom-tree_view.css') }}" rel="stylesheet" type="text/css" />

     <!--  invoice style   -->
     <link href="{{ asset('public/backend/crock/rtl/assets/css/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />
     <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/crock/rtl/plugins/dropify/dropify.min.css') }}">
     <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/crock/rtl/assets/css/forms/theme-checkbox-radio.css') }}">
     <link href="{{ asset('public/backend/crock/rtl/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
     <link href="{{ asset('public/backend/crock/rtl/plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @stack('css')
    @else
     <!-- BEGIN GLOBAL MANDATORY STYLES -->
     <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
     <link href="{{asset('public/backend/crock/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{asset('public/backend/crock/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
     <!-- END GLOBAL MANDATORY STYLES -->

       <!-- BEGIN THEME GLOBAL STYLES -->
       <link href="{{ asset('public/backend/crock/plugins/noUiSlider/nouislider.min.css') }}" rel="stylesheet" type="text/css">
       <!-- END THEME GLOBAL STYLES -->

       <!--  BEGIN CUSTOM STYLE FILE  -->
       <link href="{{ asset('public/backend/crock/plugins/noUiSlider/custom-nouiSlider.css') }}" rel="stylesheet" type="text/css">
       <link href="{{ asset('public/backend/crock/plugins/bootstrap-range-Slider/bootstrap-slider.css') }}" rel="stylesheet" type="text/css">
       <!--  END CUSTOM STYLE FILE  -->

     <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/crock/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/crock/plugins/table/datatable/dt-global_style.css')}}">
    <link href="{{asset('public/backend/crock/assets/css/elements/miscellaneous.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/backend/crock/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/backend/crock/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/crock/plugins/select2/select2.min.css')}}">
    <link href="{{asset('public/backend/crock/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/crock/assets/css/elements/alert.css')}}">
    <link href="{{asset('public/backend/crock/plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/crock/assets/css/forms/switches.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/crock/plugins/font-icons/fontawesome/css/regular.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/crock/plugins/font-icons/fontawesome/css/fontawesome.css')}}">
    <link href="{{ asset('public/backend/crock/assets/css/elements/custom-tree_view.css') }}" rel="stylesheet" type="text/css" />

    <!--  invoice style   -->
    <link href="{{ asset('public/backend/crock/assets/css/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/crock/plugins/dropify/dropify.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/crock/assets/css/forms/theme-checkbox-radio.css') }}">
    <link href="{{ asset('public/backend/crock/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/backend/crock/plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
     <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->



     @stack('css')
    @endif

    <script src="{{ asset('public/backend/crock/plugins/sweetalerts/sweetalert.min.js') }}"></script>


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
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('public/backend/crock/rtl/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('public/backend/crock/rtl/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('public/backend/crock/rtl/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/backend/crock/rtl/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('public/backend/crock/rtl/assets/js/app.js')}}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{asset('public/backend/crock/rtl/assets/js/custom.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{asset('public/backend/crock/rtl/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('public/backend/crock/rtl/plugins/table/datatable/datatables.js')}}"></script>
    <script src="{{asset('public/backend/crock/rtl/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
    <script src="{{asset('public/backend/crock/rtl/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('public/backend/crock/rtl/plugins/select2/custom-select2.js')}}"></script>

    <script src="{{asset('public/backend/crock/rtl/plugins/treeview/custom-jstree.js') }}"></script>
    <script src="{{asset('public/backend/crock/rtl/plugins/dropify/dropify.min.js') }}"></script>
    <script src="{{asset('public/backend/crock/rtl/plugins/flatpickr/flatpickr.js') }}"></script>

    <script>
        $('#zero-config').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [10, 15, 20, 50,100,200,300],
            "pageLength": 10
        });
    </script>

    @stack('js')

    @else

     <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
     <script src="{{asset('public/backend/crock/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
     <script src="{{asset('public/backend/crock/bootstrap/js/popper.min.js')}}"></script>
     <script src="{{asset('public/backend/crock/bootstrap/js/bootstrap.min.js')}}"></script>
     <script src="{{asset('public/backend/crock/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
     <script src="{{asset('public/backend/crock/assets/js/app.js')}}"></script>
     <script>
         $(document).ready(function() {
             App.init();
         });
     </script>
     <script src="{{asset('public/backend/crock/assets/js/custom.js')}}"></script>
     <!-- END GLOBAL MANDATORY SCRIPTS -->

     <script src="plugins/highlight/highlight.pack.js"></script>

     <!-- END GLOBAL MANDATORY STYLES -->

     <!-- BEGIN PAGE LEVEL SCRIPTS -->


     <script src="{{ asset('public/backend/crock/plugins/noUiSlider/nouislider.min.js') }}"></script>
     <script src="{{ asset('public/backend/crock/plugins/noUiSlider/custom-nouiSlider.js') }}"></script>
     <script src="{{ asset('public/backend/crock/plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js') }}"></script>

     <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{asset('public/backend/crock/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('public/backend/crock/plugins/table/datatable/datatables.js')}}"></script>
    <script src="{{asset('public/backend/crock/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
    <script src="{{asset('public/backend/crock/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('public/backend/crock/plugins/select2/custom-select2.js')}}"></script>

    <script src="{{asset('public/backend/crock/plugins/dropify/dropify.min.js') }}"></script>
    <script src="{{asset('public/backend/crock/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{asset('public/backend/crock/plugins/flatpickr/custom-flatpickr.js') }}"></script>

    <script>
        $('#zero-config').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [10, 15, 20, 50,100,200,300],
            "pageLength": 10
        });
    </script>

    <script src="{{asset('public/backend/crock/plugins/treeview/custom-jstree.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    @stack('js')
    @endif

    @include('sweet::alert')
</body>
</html>
