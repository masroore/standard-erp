@php 
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@foreach ($StoItem as $key => $row)
            
            
<tr>
    <td>{{$key+1}}</td>
    <td class="sorting_1 sorting_2">
        <div class="d-flex">

            <p class="align-self-center mb-0 admin-name"> {{$lang == 'ar' ? $row->title_ar: $row->title_en}} </p>
        </div>
    </td>
    <td class="sorting_1 sorting_2">
        <div class="d-flex">

            <p class="align-self-center mb-0 admin-name">Ea </p>
        </div>
    </td>
    <td class="sorting_1 sorting_2">
        <div class="d-flex">

            <p class="align-self-center mb-0 admin-name"> {{$row->sale_price}} </p>
        </div>
    </td>
    <td class="sorting_1 sorting_2">
        <div class="form-group">
            <input  type="hidden" name="item_id[]" value="{{$row->id}}" placeholder="" class="form-control" >
            <input  type="hidden" name="sale_price[]" value="{{$row->sale_price}}" placeholder="" class="form-control" >

            <input  type="text" name="custom_price[]" placeholder="" class="form-control" >
           
        </div>

    </td>
   
</tr>

@endforeach