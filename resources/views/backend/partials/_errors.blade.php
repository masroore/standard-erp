@if ($errors->any())
@php 
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp
<div id="alertArrowed" class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4 class="text-danger">{{$lang == 'ar' ? ' الرجاء تصحيح الاخطاء ' : ' Correct This Errors '}} !!</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area p-3">

            @foreach ($errors->all() as $error)
            <div class="alert alert-arrow-right alert-icon-right alert-light-danger mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                <strong>{{ $error }}!</strong> 
            </div> 
            @endforeach
        </div>
    </div>
</div>

@endif

@push('css')

<style>
    .btn-light { border-color: transparent; }
</style>
    
@endpush

@push('js')
    
@endpush