
    <div class="text-center">
        <button type="button" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#exampleModal">
            @lang('site.add_new')
        </button>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> @lang('site.add_unit')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="@lang('site.cancel')">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <form action="{{ route('dashboard.units.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                    <div class="form-group">
                        <label class="pl-2"> @lang('site.base_unit') </label>
                        <select class="form-control nested select2" name="base_unit" id="units">
                            <option value="0"> @lang('site.base_unit')</option>
                            @foreach($units as $unit)
                                <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label class="pl-2">@lang('site.unit_name')</label>
                        <input  type="text" name="unit_name" placeholder="@lang('site.unit_name')" class="form-control" required>

                    </div>

                    <div class="form-group">
                        <label class="pl-2">@lang('site.unit_code') </label>
                        <input type="text" name="unit_code" placeholder="@lang('site.unit_code')" class="form-control" required>
                    </div>

                    <div class="form-group hidediv">
                        <label class="pl-2"> @lang('site.operator')</label>
                        <select class="form-control nested" name="operator" >

                            <option value="+">+</option>
                            <option value="-">-</option>
                            <option value="*">*</option>
                            <option value="/">/</option>


                        </select>
                    </div>

                    <div class="form-group hidediv">
                        <label class="pl-2">@lang('site.value') </label>
                        <input type="text" name="operation_value" placeholder="{{ $lang == 'ar' ? 'القيمة' : 'Operation Value' }}" class="form-control" >
                    </div>



                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>@lang('site.cancel')</button>
                    <button type="submit" class="btn btn-primary">@lang('site.save')</button>
                </div>
                </form>

            </div>
        </div>
    </div>






