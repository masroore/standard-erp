<table class="table table-bordered item-table">
    <thead>
        <tr>


            <th width="35%">@lang('site.item')</th>
            <th width="15%">@lang('site.qty')</th>
            <th width="15%">@lang('site.price')</th>
            <th >@lang('site.unit')</th>
            <th >@lang('site.discount')</th>
            <th >@lang('site.amount')</th>
            <th class="tax-type-show">@lang('site.tax')</th>
            <th class="tax-type-show">@lang('site.amount_after_tax')</th>

        </tr>
    </thead>
    <tbody>

        @foreach ($deliversItemsData as $item )

        <tr>

            <td class="description">
                <input  type="hidden" id="item_{{ $loop->index+1 }}" value="{{$item->item_id  }}"  name="item_id[]" class="form-control form-control-sm  item_id{{ $loop->index+1 }}">
                <input type="text" id="{{ $loop->index+1 }}" class="form-control form-control-sm search title{{ $loop->index+1 }}" value="{{ $item->item->title_en }}" readonly>

                {{-- edit item data
                <button type="button" class="  btn-xs  modali" style="background-color: #fafafa !important; border:none" data-toggle="modal"
                        data-target="#exampleModal{{ $loop->index+1 }}" title="{{$lang == 'ar' ? ' تعديل' : ' Edit '}}"> <i class="fa fa-edit"></i>
                </button>
                {{-- @include('backend.purchases.invoices.itemmodal') --}}

            </td>

            <td class="description">
                <input type="number" min="1" id="quantity_{{ $loop->index+1 }}" name="qty[]" class="form-control form-control-sm qty{{ $loop->index+1 }}"  value="{{ $item->qunatity }}" readonly>

            </td>

            <td class="description">
                <input type="number" class="changesNo form-control form-control-sm" id="priceinput{{ $loop->index+1 }}"    name="purch_price[]">
            </td>

            <td class="description">
                <span class="unit{{ $loop->index+1 }}">{{ $item->unit->unit_name }}</span>
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

        @endforeach
    </tbody>
</table>



