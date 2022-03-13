{{-- MANDATORY Global Script --}}
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

{{-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS --}}
<script src="{{asset('public/backend/crock/rtl/assets/js/scrollspyNav.js')}}"></script>
<script src="{{asset('public/backend/crock/rtl/plugins/table/datatable/datatables.js')}}"></script>
<script src="{{asset('public/backend/crock/rtl/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
<script src="{{asset('public/backend/crock/rtl/plugins/treeview/custom-jstree.js') }}"></script>
<script src="{{asset('public/backend/crock/rtl/plugins/dropify/dropify.min.js') }}"></script>
<script src="{{asset('public/backend/crock/rtl/plugins/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('public/backend/crock/plugins/sweetalerts/sweetalert.min.js') }}"></script>

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
