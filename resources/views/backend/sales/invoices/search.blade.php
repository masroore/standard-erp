@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

<div class="widget-content widget-content-area{{ $id }} p-3" style="    overflow-y: scroll;height: 220px; background-color: white;">


    <ul class="file-tree">
    @foreach ($StoItem as $key => $row)


        <li style="cursor: pointer;" class="item"
         title="{{$lang == 'ar' ? $row->title_ar: $row->title_en}}"
         item_id="{{$row->id}}"
         sale_price="{{$row->sale_price}}"

         >{{$lang == 'ar' ? $row->title_ar: $row->title_en}}</li>
    @endforeach




    </ul>



</div>
 <script src="{{asset('public/backend/crock/assets/js/libs/jquery-3.1.1.min.js')}}"></script>

<script>
    $(".item").on('click',function(){
       var title = $(this).attr('title');
       var item_id = $(this).attr('item_id');
       var qty = $(this).attr('qty');
       var sale_price = $(this).attr('sale_price');
       var id = {{ $id }};
    //    alert(id);

       $('.title'+id).val(title);
       $('.item_id'+id).val(item_id);
       $('.qty'+id).val(1);
       $('.sale_price'+id).val(sale_price);
       $('.amount'+id).text(sale_price);
       $('.widget-content-area'+id).remove();
    });
</script>



