<button type="button" class="btn btn-warning changesModal" data-toggle="modal" data-target="#exampleModal_{{$row->id}}" title="@lang('site.edit')">
    <i class="fa fa-pencil" aria-hidden="true"></i>
</button>

<div class="modal fade" id="exampleModal_{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$row->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel{{$row->id}}"> @lang('site.edit')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('site.cancel')">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

                <form action="{{ route('dashboard.units.update', $row->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="modal-body">

                        <div class="form-group">
                            <label class="pl-2"> @lang('site.base_unit') </label> <br>
                            <select class="form-control nested select2" name="base_unit" id="units_{{$row->id}}">
                                <option value="0" {{ $row->base_unit == 0 ? 'selected' : '' }}> @lang('site.base_unit')</option>
                                @foreach($units as $unit)
                                    <option value="{{$unit->id}}" {{ $row->base_unit == $unit->id ? 'selected' : '' }}>{{$unit->unit_name}}</option>
                                @endforeach

                            </select>
                        </div>



                        <div class="form-group">
                            <label class="pl-2">@lang('site.unit_name')</label>
                            <input  type="text" name="unit_name" value="{{$row->unit_name}}" class="form-control" required>

                        </div>

                        <div class="form-group">
                            <label class="pl-2">@lang('site.unit_code') </label>
                            <input type="text" name="unit_code" value="{{$row->unit_code}}" class="form-control" required>
                        </div>

                        <div class="form-group hidediv">
                            <label class="pl-2">@lang('site.operator')</label>
                            <select class="form-control nested" name="operator" >

                                <option value="+"  {{ $row->operator == '+' ? 'selected' : '' }}>+</option>
                                <option value="-"  {{ $row->operator == '-' ? 'selected' : '' }}>-</option>
                                <option value="*"  {{ $row->operator == '*'? 'selected' : '' }}>*</option>
                                <option value="/"  {{ $row->operator == '/' ? 'selected' : '' }}>/</option>


                            </select>
                        </div>

                        <div class="form-group hidediv">
                            <label class="pl-2"> @lang('site.value') </label>
                            <input type="text" name="operation_value" value="{{$row->operation_value}}" class="form-control" >
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> @lang('site.cancel')</button>
                        <button type="submit" class="btn btn-warning">@lang('site.update')</button>
                    </div>
                </form>

        </div>
    </div>
</div>



@push('css')
    <style>

        .select2-dropdown{
            z-index:1050 !important;
        }
       


    </style>
@endpush

@push('js')
<script type="text/javascript">
    $(".nested").select2({
        tags: true
    });
</script>
<script>
   $(document).ready(function(){


       $('#units').on('change', function() {
            vla =  $('#units').val();
                if(vla == 0) {
                    $(".hidediv").css("display", "none");
                }else{
                    $(".hidediv").css("display", "block");
                }

            });


        });
</script>
<script>
    vla =  $('#units').val();

    if(vla == 0) {
        $(".hidediv").css("display", "none");
    }else{
        $(".hidediv").css("display", "block");
    }
</script>

<script type="text/javascript">
    $(document).on('click','.changesModal',function(){

        id_arr          = $(this).attr('data-target');
        id              = id_arr.split("_");

        $(".nested").select2({
            tags: true,
            dropdownParent: $("#exampleModal_"+id[1]),
        });
        unitId = "#units_"+id[1] ;
        vla =  unitId.val();
        if(vla == 0) {
            $(".hidediv").css("display", "none");
        }else{
            $(".hidediv").css("display", "block");
        }

    });
</script>
@endpush













