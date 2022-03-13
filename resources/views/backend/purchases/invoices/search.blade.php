@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp
{{-- purchase_unit_id --}}
<div class="widget-content widget-content-area{{ $id }} p-3"
style="overflow-y: scroll;height: 350px; background-color: #ccc; position: absolute; z-index: 9000000; width:350px">

    <i class="fa fa-times mb-3 btn-danger p-1 close-search" style="cursor: pointer"></i>
    @if ($StoItem->count() > 0)
    <ul class="file-tree">


        @foreach ($StoItem as $key => $row)
            @php
                $units = App\Models\Store\StoUnit::where('id',$row->unit_id )->orWhere('base_unit',$row->unit_id)->get();
                // units = $.parseJSON('[' + units + ']');
            @endphp
            <li style="cursor: pointer;" class="item"
            title="{{$lang == 'ar' ? $row->title_ar: $row->title_en}}({{ $row->code }})"
            item_id="{{$row->id}}"
            cost="{{$row->cost}}"
            tax="{{$row->tax_id}}"
            unit="{{$row->purchUnit->unit_name}}"
            unit_id="{{$row->purchase_unit_id}}"



            >{{$lang == 'ar' ? $row->title_ar: $row->title_en}} ({{ $row->code }})</li>
        @endforeach

    </ul>

    @elseif($StoItem->count() == 0)
    <div class="alert alert-light-danger border-0 mb-4" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <strong>Opps!</strong> No Items Matched </div>
    @endif



</div>

<script>
    $(".item").on('click',function(){

       var title = $(this).attr('title');
       var item_id = $(this).attr('item_id');
       var qty = $(this).attr('qty');
       var purch_price = $(this).attr('cost');
       var unit = $(this).attr('unit');
       var unit_id =  $(this).attr('unit_id');
       var taxRate = $(this).attr('tax');
       var taxAmount = purch_price * (taxRate / 100);

       var id = {{ $id }};
        //alert(unit_id);

        // handel amount befor tax


       $('.title'+id).val(title);
       $('.item_id'+id).val(item_id);
       $('.qty'+id).val(1);
       $('.tax_amount'+id).text(parseFloat(taxAmount).toFixed(2));
       $('.unit'+id).val(unit);
       $('.unit'+id).text(unit);
       $('#modalprice_'+id).val(purch_price);
       $('#priceinput'+id).val(purch_price);
       $('.purch_price'+id).text(purch_price);
       $('.amount'+id).val(purch_price);
       $('#tax_'+id).val(taxRate);
       $('#taxAmount_'+id).val(parseFloat(taxAmount).toFixed(2));
       $('#modeltax_'+id).val(taxRate);
       $('#modalunit_'+id).val(unit_id);
       $('#modeltitle'+id).text(title);




       amountBeforTax = purch_price  ;
        $('#totalLineBeforTax_'+id).val(amountBeforTax);
        $('#totalBeforTax_'+id).text(amountBeforTax);


        taxType =  $('#taxType').val() ;

        if (taxType == 1) {
            var totalPrice = taxAmount + parseFloat(purch_price) ;
            $('#totalLine_'+id).val(parseFloat(totalPrice).toFixed(2));
            $('.amount'+id).text(parseFloat(totalPrice).toFixed(2));
        }
        else if (taxType == 2) {
            ;
            $('#totalLine_'+id).val(parseFloat(amountBeforTax).toFixed(2));
            $('.amount'+id).text(parseFloat(amountBeforTax).toFixed(2));
        }


    //     var totalPrice = taxAmount + parseFloat(purch_price) ;
    //    $('#totalLine_'+id).val(parseFloat(totalPrice).toFixed(2));
    //    $('.amount'+id).text(parseFloat(totalPrice).toFixed(2));

        //alert(amountBeforTax);
       $('.widget-content-area'+id).remove();

       calculateTotal();
    });

    $(".close-search").on('click', function(){
        var id = {{ $id }};
        $('.widget-content-area'+id).remove();
    });
</script>



