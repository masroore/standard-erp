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

        @foreach ($receivesItemsData as $item )

        <tr>

            <td class="description">
                <input  type="hidden" id="item_{{ $loop->index+1 }}" value="{{$item->item_id  }}"  name="item_id[]" class="form-control form-control-sm  item_id{{ $loop->index+1 }}">
                <input type="text" id="{{ $loop->index+1 }}" class="form-control form-control-sm search title{{ $loop->index+1 }}" value="{{ $item->item->title_en }}" readonly>

                {{-- edit item data --}}
                <button type="button" class="btn-xs  modali" style="background-color: #fafafa !important; border:none" data-toggle="modal"
                        data-target="#exampleModal_{{ $loop->index+1 }}" title="@lang('site.edit')"> <i class="fa fa-edit"></i>
                </button>
                @include('backend.purchases.invoices.recive_item_modal')


            </td>

            <td class="description">
                <input type="number" min="1" id="quantity_{{ $loop->index+1 }}" name="qty[]"
                class="form-control form-control-sm qty{{ $loop->index+1 }}"
                 value="{{ $item->qunatity }}" readonly>

            </td>

            <td class="description">
                <input type="number" value="{{ $item->item->cost }}" class="change-receive-price form-control form-control-sm" id="priceinput_{{ $loop->index+1 }}"    name="purch_price[]">
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

                <input type="hidden" value="{{ $item->item->cost *  $item->qunatity}}" id="totalLineBeforTax_1"
                    name="total_line_befor_tax_price[]"
                    class=" editable-amount form-control totalLinePriceBeforTax" >

                <span class="" id="totalBeforTax_{{ $loop->index+1 }}"> {{ $item->item->cost *  $item->qunatity}}</span>

            </td>

            <td class="description  tax-type-show">

                <input type="hidden" id="tax_{{ $loop->index+1 }}"   value="{{ $item->item->tax_id}}"  name="item_tax_rate[]"   class="form-control tax-value-reset">
                <input type="hidden" id="taxAmount_{{ $loop->index+1 }}" value="{{ (($item->item->cost * $item->item->tax_id) / 100) *  $item->qunatity  }}"   name="item_tax_amount[]"   class="form-control tax-value-reset itemTaxLine">
                <span class="tax_amount{{ $loop->index+1 }}" id="spanTaxAmount_{{ $loop->index+1 }}"> ( {{ $item->item->tax_id }} ) {{ (($item->item->cost * $item->item->tax_id) / 100) *  $item->qunatity  }}</span>
            </td>

            <td class="tax-type-show">

                <input type="hidden" id="totalLine_{{ $loop->index+1 }}" name="total_line_price[]"
                class=" editable-amount form-control totalLinePrice"
                value="{{ ((($item->item->cost * $item->item->tax_id) / 100) *  $item->qunatity) + ($item->item->cost *  $item->qunatity)  }}">
                <span class="amount{{ $loop->index+1 }}" id="total_{{ $loop->index+1 }}">{{ ((($item->item->cost * $item->item->tax_id) / 100) *  $item->qunatity) + ($item->item->cost *  $item->qunatity)  }}</span>

            </td>

        </tr>
        @push('js')

@include('backend.purchases.invoices.parts.receive_script')

@endpush
        @endforeach
    </tbody>
</table>


