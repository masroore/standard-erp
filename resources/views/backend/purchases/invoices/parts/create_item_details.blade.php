 {{-- items details --}}
<div class="invoice-detail-items">
    <a class="btn btn-info mb-2" id="importFromReceives"> استيراد من اذون الاستلام </a>
    <div class="content-receives">

    </div>

    <div class="table-responsive item-receives">
        <table class="table table-bordered item-table standrd-tr">
            <thead>
                <tr>

                    <th ></th>
                    <th width="40%">@lang('site.item')</th>
                    <th width="15%">@lang('site.qty')</th>
                    <th >@lang('site.price')</th>
                    <th >@lang('site.unit')</th>
                    <th >@lang('site.discount')</th>
                    <th >@lang('site.amount')</th>
                    <th class="tax-type-show">@lang('site.tax')</th>
                    <th class="tax-type-show">@lang('site.amount_after_tax')</th>

                </tr>
            </thead>
            <tbody>



                <tr class="">
                    <td class="delete-item-row">
                        <ul class="table-controls">
                            <li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>
                        </ul>
                    </td>

                    <td class="description">
                        <input  type="hidden" id="item_1"   name="item_id[]" class=" form-control form-control-sm search item_id1" placeholder="@lang('site.item')" autocomplete="off">
                        <input type="text" id="1" class="form-control form-control-sm search title1" placeholder="@lang('site.item')" autocomplete="off">

                        {{-- edit item data --}}
                        <button type="button" class="btn-xs show-modal-invoice  modali" style="background-color: #fafafa !important; border:none" data-toggle="modal"
                                data-target="#exampleModal_1" title="@lang('site.edit')"> <i class="fa fa-edit"></i>
                        </button>
                        @include('backend.purchases.invoices.itemmodal')


                        <div class="content-search1"> </div>
                    </td>

                    <td class="description">
                        <input type="number" min="1" id="quantity_1" name="qty[]" class="form-control form-control-sm qty1 calculat changesNo"  placeholder="@lang('site.qty')">
                    </td>

                    <td class="description">
                        <input type="hidden" id="priceinput1"    name="purch_price[]">
                        <span class="purch_price1" id="purch_price1">0.00</span>
                    </td>



                    <td class="description">
                        <span class="unit1">____</span>
                    </td>

                    <td class="description">
                        <input type="hidden" value="0" name="disc_value[]" id="discountinput_1">
                        <input type="hidden" value="0" name="disc_type[]" id="discounttypeinput_1">
                        <span class="disc1"> 0.00 </span>
                    </td>

                    <td class="description">

                        <input type="hidden" id="totalLineBeforTax_1" name="total_line_befor_tax_price[]" class=" editable-amount form-control totalLinePriceBeforTax" >
                        <span class="" id="totalBeforTax_1">0.00</span>

                    </td>

                    <td class="description  tax-type-show">

                        <input type="hidden" id="tax_1"          name="item_tax_rate[]"   class="form-control tax-value-reset">
                        <input type="hidden" id="taxAmount_1"    name="item_tax_amount[]"   class="form-control tax-value-reset itemTaxLine">
                        <span class="tax_amount1">0.00</span>
                    </td>



                    <td class="tax-type-show">

                        <input type="hidden" id="totalLine_1" name="total_line_price[]" class=" editable-amount form-control totalLinePrice" >
                        <span class="amount1" id="total_1">0.00</span>

                    </td>

                </tr>


            </tbody>
        </table>
        <button class="btn btn-secondary additem btn-sm" id="1">@lang('site.add_item')</button>
    </div>



</div>

@push('js')

@include('backend.purchases.invoices.parts.receive_script')

@endpush
