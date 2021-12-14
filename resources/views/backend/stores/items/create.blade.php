@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
       @lang('site.add_product')
@endsection
 @section('modelTitlie')
      @lang('site.products')
 @endsection
@section('content')


<div class="row layout-top-spacing">
    <div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <nav class="breadcrumb-one p-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                        <li class="breadcrumb-item"><a href="{{route('dashboard.items.index')}}">  @lang('site.products')</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span> @lang('site.add_product')</span></li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="row ">
    <div id="flFormsGrid" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                        <h4> @lang('site.please_fill_product_data')</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area p-3">
                <form action="{{ route('dashboard.items.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('backend.partials._errors')

                    @include('backend.stores.items.form')

                    <button type="submit" class="btn btn-primary mt-3">{{$lang == 'ar' ? ' حفظ ' : 'Save  '}}</button>
                </form>

            </div>
        </div>
    </div>
</div>



@endsection


@push('css')
    <style>

        .select2-dropdown{
            z-index:1050 !important;
        }

        .invoice-detail-items{
            padding: 0;

        }




    </style>
@endpush

@push('js')

<script>
    //First upload
    var firstUpload = new FileUploadWithPreview('myFirstImage')
    //Second upload
    var secondUpload = new FileUploadWithPreview('mySecondImage')

    $('#genbutton').on("click", function(){
      $.get('gencode', function(data){
        $("input[name='code']").val(data);
      });
    });

</script>

<!-- ajax -->
<script type="text/javascript">
    $("#units").change(function(){
        $.ajax({
            url: "{{ route('dashboard.unitschaild') }}?unit_id=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                $('.unit-child').html(data.html);
            }
        });
    });
</script>

<script type="text/javascript">
    $(".basic").select2({
        tags: true,
    });
</script>

<script>
     $(document).ready(function(){
        // add new row for collection product
        $('.additem').on('click', function(event) {
                event.preventDefault();
                var id = parseInt($(this).attr('id')) + 1;

                getTableElement = document.querySelector('.item-table');
                currentIndex = getTableElement.rows.length;

                $html = `<tr>
                            <td class="delete-item-row">
                                <ul class="table-controls">
                                    <li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>
                                </ul>
                            </td>

                            <td class="description">
                                <div class="form-group">
                                    <select id="store" class="form-control form-control-sm "  name="store_id[]" >

                                        @foreach ($stores as $store)
                                        <option value="{{ $store->id }}" >{{$store->title_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>

                            <td class="description">

                                <input type="text"  name="place[]"   class="form-control-sm form-control"  placeholder="@lang('site.product_place')">

                            </td>
                        </tr>`;

                $(".item-table tbody").append($html);
                $(this).attr('id',id);
                deleteItemRow();
        });

        // delete row
        function deleteItemRow() {
            deleteItem = document.querySelectorAll('.delete-item');
            for (var i = 0; i < deleteItem.length; i++) {
                deleteItem[i].addEventListener('click', function() {
                    this.parentElement.parentNode.parentNode.parentNode.remove();
                })
            }
        }

        //hid and show places
        $("#invoice-detail-items" ).hide();
            $( "#showplace" ).click(function() {
                $( "#invoice-detail-items" ).toggle( "slow", function() {
                // Animation complete.
            });
        });

        //handel product type show input
        $(".show-in-collection").hide();
        $('#type').on('change', function() {
            var productType = $( "#type" ).val() ;



            if(productType == 'service'){
                $(".hide-in-service").hide();
                $(".show-in-collection").hide();
            }else if (productType == 'standard') {
                $(".hide-in-service").show();
                $(".show-in-collection").hide();
            } else if (productType == 'collection') {
                $(".hide-in-service").hide();
                $(".show-in-collection").show();
            }

        });

     });

</script>

<script>
 $(document).ready(function(){


        // search for item  by ajax request
        $(".search").keyup(function(){
            var value =$(this).val();
            var id =$(this).attr('id');

                $.ajax({
                    type: 'get',
                    url: "{{ url('dashboard/'. $routeName .'/search/') }}"+'/'+value+'/'+id,
                    success: function (data) {
                        $('.content-search'+id).html(data);

                        },
                    error: function(data_error, exception) {
                        if(exception == 'error'){
                            var error_list = '' ;
                            $.each(data_error.responseJSON.errors, function(index,v){
                                error_list += '<li>'+v+'</li>';
                            });
                            $('.alert-errors ul').html(error_list)
                        }
                    }
                });
        });

        // add new row
        $('.additemcollect').on('click', function(event) {
            event.preventDefault();
            var id = parseInt($(this).attr('id')) + 1;

            getTableElement = document.querySelector('.item-table-search');
            currentIndex = getTableElement.rows.length;

            $html = `<tr>
                        <td class="delete-item-row">
                            <ul class="table-controls">
                                <li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>
                            </ul>
                        </td>
                        <td class="description">
                            <input type="hidden" name="item_id[]"  class=" form-control form-control-sm search item_id`+id+`" placeholder="@lang('site.item')" autocomplete="off">

                            <input type="text" id="`+id+`" class=" form-control form-control-sm search title`+id+`" placeholder="@lang('site.item')" autocomplete="off">
                                <div class="content-search`+id+`">

                                </div>
                        </td>

                        <td>
                            <input type="number"  id="price_`+id+`"  name="price[]" class="form-control changesNo sale_price`+id+`" placeholder="0.00">
                        </td>


                        <td class="description">
                            <input type="number" id="quantity_`+id+`"  name="qty[]"   class="form-control changesNo form-control-sm qty`+id+`"  placeholder="@lang('site.qty')">
                        </td>



                    </tr>`;

            $(".item-table-search tbody").append($html);
            $(this).attr('id',id);
            deleteItemRow();


                    //delete row
                    function deleteItemRow() {
            deleteItem = document.querySelectorAll('.delete-item');
            for (var i = 0; i < deleteItem.length; i++) {
                deleteItem[i].addEventListener('click', function() {
                    this.parentElement.parentNode.parentNode.parentNode.remove();
                })
            }
        }

        // search for item  by ajax request
        $(".search").keyup(function(){
            var value =$(this).val();
            var id =$(this).attr('id');

                $.ajax({
                    type: 'get',
                    url: "{{ url('dashboard/'. $routeName .'/search/') }}"+'/'+value+'/'+id,
                    success: function (data) {
                        $('.content-search'+id).html(data);

                        },
                    error: function(data_error, exception) {
                        if(exception == 'error'){
                            var error_list = '' ;
                            $.each(data_error.responseJSON.errors, function(index,v){
                                error_list += '<li>'+v+'</li>';
                            });
                            $('.alert-errors ul').html(error_list)
                        }
                    }
                });
        });


    // calculat price item after tax and discond
    $(".calculat").on('click', function(){

var id =$(this).attr('id');
var qty = $('.qty'+id).val();
var sale_price = $('.sale_price'+id).val();
var price = (qty * sale_price);
// add tax
var tax = $('.tax'+id).val();
var precentTax = price * (tax/100)  ;
var priceAfterTax =  (price + precentTax).toFixed(2);

// add discond
var disc =parseInt($('.disc'+id).val());
var disc_type =$('.disc_type'+id).find(":selected").text();

if(disc_type == 'num' && disc > 0){
    var amount =  (priceAfterTax - disc).toFixed(2) ;

}else if(disc_type == '%' && disc > 0){
    var discond = priceAfterTax * (disc/100);
    var amount =  (priceAfterTax - discond).toFixed(2) ;
}else{
    var amount = priceAfterTax;
}

$('.amount'+id).text(amount);
});

});


});





$(".tagging").select2({
    tags: true
    });


</script>



@endpush





