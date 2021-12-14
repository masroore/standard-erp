<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel1">@lang('site.edit') : <span id="modeltitle1" ></span></h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ $lang == 'ar' ? ' اغلاق' : 'Close ' }}">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <label> @lang('site.price')</label>
                    <input type="number" id="modalprice_1"  class="form-control" placeholder="0.00">
                </div>

                <div class="form-group">
                    <label> @lang('site.qty')</label>
                    <input type="number"  id="modalquantity_1"  class="form-control form-control-sm qty1 calculat "  placeholder="@lang('site.qty')" min="1">
                </div>

                <div class="form-group">
                    <label> @lang('site.unit')</label>

                    <select id="modalunit_1" class="form-control form-control-sm"  name="sale_unit_id[]" >
                        <option  disabled selected>@lang('site.seleect_unit')</option>
                        @foreach ($units as $unit)
                        <option value="{{ $unit->id }}" >{{$unit->unit_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12"> @lang('site.discount')</label>
                    <div class="input-group col-sm-12">
                        <input type="number"  id="modeldiscount_1" class="form-control item-discount  rounded disc1" placeholder="@lang('site.discount')">
                        <div class="input-group-prepend form-controlsm">
                            <div class="input-group-text rounded" style="padding: 0;">
                              <select class="text-center item-discount form-control-sm disc_type1 " id="disctype_1"  style="height: 100%;border: 0;width: 100%;padding: 0;">
                                  <option value="1">%</option>
                                  <option value="2">@lang('site.num')</option>
                                </select>
                              </div>
                          </div>
                    </div>
                    {{-- <div class="col-sm-3">

                        <input type="number" name="item_discount_amount[]" class="form-control form-control-sm"  min="0" id="item-discount-amount1" placeholder="0.00" readonly>

                    </div> --}}
                </div>

                <div class="form-group">
                    <label> @lang('site.tax')</label>
                    <select id="modeltax_1" class="form-control form-control-sm tax-value-reset tax1 "  >
                        <option  value="0">@lang('site.no')</option>
                        @foreach ($taxes as $tax)
                        <option value="{{ $tax->rate }}" >{{$tax->name . '('.$tax->rate .'%)'}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> {{ $lang == 'ar' ? ' الغاء' : 'Cancel' }}</button>

               <a type="" class="btn btn-warning changesNoModal" id="modelitemedit_1">{{ $lang == 'ar' ? ' تعديل' : 'Update' }}</a>
            </div>
            </form>

        </div>
    </div>
</div>

{{--  --}}




<div class="modal fade" id="exampleModal`+id+`" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel`+id+`" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel`+id+`">@lang('site.edit') : <span id="modeltitle`+id+`" ></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ $lang == 'ar' ? ' اغلاق' : 'Close ' }}">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>


            <div class="modal-body">
                <div class="form-group">
                    <label> @lang('site.price')</label>
                    <input type="number" id="modalprice_`+id+`"   class="form-control sale_price`+id+`" placeholder="0.00">
                </div>

                <div class="form-group">
                    <label> @lang('site.qty')</label>
                    <input type="number"  id="modalquantity_`+id+`"  class="form-control form-control-sm qty`+id+` calculat"  placeholder="@lang('site.qty')" min="1">
                </div>

                <div class="form-group">
                    <label> @lang('site.unit')</label>
                    <select id="modalunit_`+id+`" class="form-control form-control-sm "  name="sale_unit_id[]" >
                        <option  disabled selected>@lang('site.seleect_unit')</option>
                        @foreach ($units as $unit)
                        <option value="{{ $unit->id }}" >{{$unit->unit_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12"> @lang('site.discount')</label>
                    <div class="input-group col-sm-12">
                        <input type="number"  id="modeldiscount_`+id+`" class="form-control rounded item-discount disc`+id+`" placeholder="@lang('site.discount')">
                        <div class="input-group-prepend form-controlsm">
                            <div class="input-group-text rounded" style="padding: 0;">
                            <select class="text-center item-discount form-control-sm disc_type`+id+` " id="disctype_`+id+`" style="height: 100%;border: 0;width: 100%;padding: 0;">
                                <option value="1">%</option>
                                <option value="2">@lang('site.num')</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <label> @lang('site.tax')</label>
                    <select id="modeltax_`+id+`" class="form-control form-control-sm tax-value-reset tax`+id+` "   >
                        <option  value="0">@lang('site.no')</option>
                        @foreach ($taxes as $tax)
                        <option value="{{ $tax->rate }}" >{{$tax->name . '('.$tax->rate .'%)'}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> {{ $lang == 'ar' ? ' الغاء' : 'Cancel' }}</button>

                <a type="" class="btn btn-warning changesNoModal " id="modelitemedit_`+id+`">{{ $lang == 'ar' ? ' تعديل' : 'Update' }}</a>
            </div>


        </div>
    </div>
</div>


