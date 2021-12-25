@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

<div class="widget-content widget-content-area{{ $id }} p-3"
style="overflow-y: scroll;height: 350px; background-color: #ccc; position: absolute; z-index: 9000000; width:350px">

<i class="fa fa-times mb-3 btn-danger p-1 close-search" style="cursor: pointer"></i>
@if ($StoItem->count() > 0)


    <ul class="file-tree">
    @foreach ($StoItem as $key => $row)

        <li style="cursor: pointer;" class="item"
         title="{{$lang == 'ar' ? $row->title_ar: $row->title_en}}"
         item_id="{{$row->id}}"
         sale_price="{{$row->sale_price}}"

         >{{$lang == 'ar' ? $row->title_ar: $row->title_en}}</li>
    @endforeach

    </ul>
@elseif($StoItem->count() == 0)
    <div class="alert alert-light-danger border-0 mb-4" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <strong>@lang('site.opps')</strong> @lang('site.no_items_matched')</div>
@endif


</div>
 <script src="{{asset('public/backend/crock/assets/js/libs/jquery-3.1.1.min.js')}}"></script>

<script>
    $(".item").on('click',function(){
       var title = $(this).attr('title');
       var item_id = $(this).attr('item_id');
       var qty = $(this).attr('qty');
       var sale_price = $(this).attr('sale_price');
       var id = {{ $id }};
      // alert(id);

       $('.title'+id).val(title);
       $('.item_id'+id).val(item_id);
       $('.qty'+id).val(1);
       $('.sale_price'+id).val(sale_price);
       $('.widget-content-area'+id).remove();


    });

    $(".close-search").on('click', function(){
        var id = {{ $id }};
        $('.widget-content-area'+id).remove();
    });

</script>



