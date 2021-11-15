@php 
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

<div class="widget-content widget-content-area p-3" style="    overflow-y: scroll;height: 220px;">


    <ul class="file-tree">
    @foreach ($StoItem as $key => $row)
        

        <li style="cursor: pointer;" class="item" title="{{$lang == 'ar' ? $row->title_ar: $row->title_en}}">{{$lang == 'ar' ? $row->title_ar: $row->title_en}}</li>
    @endforeach
       

                              

    </ul>



</div>
 <script src="{{asset('public/backend/crock/assets/js/libs/jquery-3.1.1.min.js')}}"></script>

<script>
    $(".item").on('click',function(){
       var title = $(this).attr('title');
       $('#search').val(title);
       $('.widget-content-area').remove();
    });
</script>

    
    
    