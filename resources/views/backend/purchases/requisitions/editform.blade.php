
        <div class="invoice-detail-title">
            <h4 class="font-weight-bold"> @lang('site.add_purchase_requisitions')</h4>
            <a href="{{ route('dashboard.purchase-requisitions.index') }}" class="btn btn-primary float-right"><i class="fa fa-list"></i> @lang('site.all_purchase_requisitions')</a>

        </div>

        {{-- master data --}}
        <div class="invoice-detail-terms">

            <div class="row justify-content-between">

                <div class="col-md-4">

                    <div class="form-group mb-4">
                        <label for="number">@lang('site.code')</label>
                        <input type="text" name="reference_no" class="form-control form-control-sm" id="number" value="{{ $row->reference_no }}" >
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group mb-4">
                        <label for="number">@lang('site.requested_by')</label>
                        <input type="text" name="requested_by" class="form-control form-control-sm"  value="{{ $row->requested_by }}" >
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group mb-4">
                        <label for="date">@lang('site.date')</label>
                        <input id="basicFlatpickr" name="date" class="form-control flatpickr flatpickr-input active" type="text" value="{{ $row->date }}" >
                    </div>
                </div>


                <div class="form-group col-md-4">
                    <label for="">@lang('site.status')</label>
                    <select class="form-control" name="status">
                        <option value="0" {{ $row->status == '0' ? 'selected' : '' }}> @lang('site.pending') </option>
                        <option value="1" {{ $row->status == '1' ? 'selected' : '' }}> @lang('site.accepted') </option>
                        <option value="2" {{ $row->status == '2' ? 'selected' : '' }}> @lang('site.rejected') </option>

                    </select>
                </div>


                <div class="form-group col-md-4">
                    <label for="">@lang('site.docment')</label>
                    <div class="custom-file mb-4">
                        <input type="file" class="form-control" id="document" name="document">

                    </div>
                </div>

                <div class="form-group col-md-4"></div>



            </div>

        </div>

        {{-- items details --}}
        <div class="invoice-detail-items">

            <div class="table-responsive">
                <table class="table table-bordered item-table">
                    <thead>
                        <tr>

                            <th ></th>
                            <th width="50%">@lang('site.item')</th>
                            <th width="25%">@lang('site.qty')</th>
                            <th width="25%">@lang('site.unit')</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($row->items as $index => $item)


                        <tr>
                            <td class="delete-item-row">
                                <ul class="table-controls">
                                    <li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>
                                </ul>
                            </td>

                            <td class="description">
                                <input  type="hidden" id="item_{{ $index+1 }}"   name="item_id[]" class=" form-control form-control-sm search item_id{{ $index+1 }}" value="{{ $item->item_id }}" autocomplete="off">
                                <input type="text" id="{{ $index+1 }}" value="{{ $lang == 'ar' ? $item->item->title_ar :  $item->item->title_en}}" class="form-control form-control-sm search title{{ $index+1 }}" placeholder="@lang('site.item')" autocomplete="off">
                                <div class="content-search{{ $index+1 }}"> </div>
                            </td>

                            <td class="description">
                                <input type="number" min="1" id="quantity_{{ $index+1 }}" name="qty[]" class="form-control form-control-sm qty{{ $index+1 }} calculat changesNo" value="{{ $item->qunatity }}">

                            </td>

                            <td class="description">
                                <select id="unit{{ $index+1 }}" class="form-control form-control-sm"  name="purchase_unit_id[]" >
                                    <option  disabled selected>@lang('site.seleect_unit')</option>
                                    @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" {{ $item->item->purchase_unit_id == $unit->id ? "selected" : ''  }} >{{$unit->unit_name}}</option>
                                    @endforeach
                                </select>
                            </td>

                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

            <button class="btn btn-secondary additem btn-sm" id="1">@lang('site.add_item')</button>

        </div>

        {{-- notes --}}
        <div class="invoice-detail-note">
            <div class="row">
                <div class="col-md-12 align-self-center">
                    <div class="form-group row invoice-note">
                        <label for="invoice-detail-notes" class="col-sm-12 col-form-label col-form-label-sm">@lang('site.notes'):</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="note" id="invoice-detail-notes"  style="height: 88px;"> {{ $row->note }} </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>




