
{{-- MANDATORY Global Style --}}
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="{{asset('public/backend/crock/rtl/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('public/backend/crock/rtl/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('public/backend/crock/assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('public/backend/crock/assets/js/loader.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('public/backend/crock/plugins/fontawsome/css/font-awesome.min.css') }}">

{{-- BEGIN THEME GLOBAL STYLES --}}
<link href="{{ asset('public/backend/crock/rtl/plugins/noUiSlider/nouislider.min.css') }}" rel="stylesheet" type="text/css">


{{-- BEGIN CUSTOM STYLE FILE --}}
<link href="{{ asset('public/backend/crock/rtl/plugins/noUiSlider/custom-nouiSlider.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/backend/crock/rtl/plugins/bootstrap-range-Slider/bootstrap-slider.css') }}" rel="stylesheet" type="text/css">


{{-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES --}}
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/crock/rtl/plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/crock/rtl/plugins/table/datatable/dt-global_style.css')}}">
<link href="{{asset('public/backend/crock/rtl/assets/css/elements/miscellaneous.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('public/backend/crock/rtl/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('public/backend/crock/rtl/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('public/backend/crock/rtl/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/crock/rtl/assets/css/elements/alert.css')}}">

<link href="{{asset('public/backend/crock/rtl/plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/crock/rtl/assets/css/forms/switches.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/crock/rtl/plugins/font-icons/fontawesome/css/regular.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/crock/rtl/plugins/font-icons/fontawesome/css/fontawesome.css')}}">
<link href="{{ asset('public/backend/crock/rtl/assets/css/elements/custom-tree_view.css') }}" rel="stylesheet" type="text/css" />

{{--  invoice style   --}}
<link href="{{ asset('public/backend/crock/rtl/assets/css/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/backend/crock/rtl/plugins/dropify/dropify.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/backend/crock/rtl/assets/css/forms/theme-checkbox-radio.css') }}">
<link href="{{ asset('public/backend/crock/rtl/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/backend/crock/rtl/plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">

@stack('css')

