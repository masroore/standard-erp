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


{{-- BEGIN PAGE LEVEL SCRIPTS  --}}
<script src="{{ asset('public/backend/crock/plugins/noUiSlider/nouislider.min.js') }}"></script>
<script src="{{ asset('public/backend/crock/plugins/noUiSlider/custom-nouiSlider.js') }}"></script>
<script src="{{ asset('public/backend/crock/plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js') }}"></script>


{{-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS --}}
<script src="{{asset('public/backend/crock/assets/js/scrollspyNav.js')}}"></script>
<script src="{{asset('public/backend/crock/plugins/table/datatable/datatables.js')}}"></script>
<script src="{{asset('public/backend/crock/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
<script src="{{asset('public/backend/crock/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('public/backend/crock/plugins/select2/custom-select2.js')}}"></script>
<script src="{{asset('public/backend/crock/plugins/dropify/dropify.min.js') }}"></script>
<script src="{{asset('public/backend/crock/plugins/flatpickr/flatpickr.js') }}"></script>
<script src="{{asset('public/backend/crock/plugins/flatpickr/custom-flatpickr.js') }}"></script>
<script src="{{ asset('public/backend/crock/plugins/sweetalerts/sweetalert.min.js') }}"></script>
<script src="{{asset('public/backend/crock/plugins/treeview/custom-jstree.js') }}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

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
@include('sweet::alert')

@stack('js')
