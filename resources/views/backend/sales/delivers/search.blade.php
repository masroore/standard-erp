@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp
{{-- purchase_unit_id --}}
<div class="widget-content widget-content-area{{ $id }} p-3"
style="overflow-y: scroll;height: 350px; background-color: #ccc; position: absolute; z-index: 9000000; width:350px">

    <i class="fa fa-times mb-3 btn-danger p-1 close-search" style="cursor: pointer"></i>
    @if ($stoItem->count() > 0)
    <ul class="file-tree">


        @foreach ($stoItem as $key => $row)
            @php
                $units = App\Models\Store\StoUnit::where('id',$row->unit_id )->orWhere('base_unit',$row->unit_id)->get();
                // units = $.parseJSON('[' + units + ']');
            @endphp
            <li style="cursor: pointer;" class="item"
            title="{{$lang == 'ar' ? $row->title_ar: $row->title_en}}({{ $row->code }})"
            item_id="{{$row->id}}"
            unit="{{$row->purchUnit->unit_name}}"
            unit_id="{{$row->purchase_unit_id}}"



            >{{$lang == 'ar' ? $row->title_ar: $row->title_en}} ({{ $row->code }})</li>
        @endforeach

    </ul>

    @elseif($stoItem->count() == 0)
    <div class="alert alert-light-danger border-0 mb-4" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <strong>@lang('site.opps')</strong>@lang('site.no_items_matched') </div>
    @endif



</div>

<script>
    $(".item").on('click',function(){

       var title = $(this).attr('title');
       var item_id = $(this).attr('item_id');
       var qty = $(this).attr('qty');
       var unit = $(this).attr('unit');
       var unit_id =  $(this).attr('unit_id');
       var id = {{ $id }};
        //alert(unit_id);

       $('.title'+id).val(title);
       $('.item_id'+id).val(item_id);
       $('.qty'+id).val(1);
       $('#unit'+id).val(unit_id);
       $('.widget-content-area'+id).remove();

       calculateTotal();
    });

    $(".close-search").on('click', function(){
        var id = {{ $id }};
        $('.widget-content-area'+id).remove();
    });
</script>



