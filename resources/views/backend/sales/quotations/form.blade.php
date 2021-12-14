


       
        <div class="invoice-detail-title">
            <h4 class="font-weight-bold"> @lang('site.add_quotation')</h4> 
           
        </div>

        {{-- master data --}}
        <div class="invoice-detail-terms">

            <div class="row justify-content-between">

                <div class="col-md-4">

                    <div class="form-group mb-4">
                        <label for="number">@lang('site.code')</label>
                        <input type="text" name="reference_no" class="form-control form-control-sm" id="number" value="{{ autoCode('Emt','Quota') }}">
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group mb-4">
                        <label for="date">@lang('site.from_date')</label>
                        <input id="basicFlatpickr" name="start_date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="@lang('site.select_date')">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group mb-4">
                        <label for="date">@lang('site.to_date')</label>
                        <input id="basicFlatpickr2" name="expired_date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="@lang('site.select_date')">
                    </div>

                </div>

                <div class="form-group col-md-4">
                    <label for="">@lang('site.customers')</label>
                    <select class="form-control basic" name="customer_id">
                        <option disabled selected > @lang('site.select_customer') </option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" >{{ $customer->company_name }} ({{ $customer->name }})</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="">@lang('site.status')</label>
                    <select class="form-control basic" name="status">
                        <option value="1"> @lang('site.pending') </option>
                        <option value="2"> @lang('site.accepted') </option>
                        <option value="3"> @lang('site.rejected') </option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="">@lang('site.docment')</label>
                
                    <div class="invoice-logo">
                        <div class="upload">
                            <input type="file" name="document" value=""/>
                        </div>
                    </div>
                   
                </div>

            </div>

        </div>

        {{-- items details --}}
        <div class="invoice-detail-items">

            <div class="table-responsive">
                <table class="table table-bordered item-table">
                    <thead>
                        <tr>
                            
                            <th ></th>
                            <th width="30%">@lang('site.item')</th>
                            <th width="15%">@lang('site.price')</th>
                            <th width="10%">@lang('site.qty')</th>
                            <th >@lang('site.discount')</th>
                            <th width="10%">@lang('site.tax')</th>
                            <th >@lang('site.amount')</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="delete-item-row">
                                <ul class="table-controls">
                                    <li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>
                                </ul>
                            </td>

                            <td class="description">
                                <input  type="hidden" id="item_1"   name="item_id[]" class=" form-control form-control-sm search item_id1" placeholder="@lang('site.item')" autocomplete="off">
                                <input type="text" id="1" class="form-control form-control-sm search title1" placeholder="@lang('site.item')" autocomplete="off">
                                <div class="content-search1"> </div>
                            </td>

                            <td class="description">
                                <input type="number" id="price_1"    name="sale_price[]"   class="form-control sale_price1 changesNo" placeholder="0.00">
                            </td>
                            
                            <td class="description">
                                <input type="number"  id="quantity_1" name="qty[]" class="form-control form-control-sm qty1 calculat changesNo"  placeholder="@lang('site.qty')">
                            </td>

                            <td class="description">
                                <div class="input-group">
                                    <input type="number" name="disc_value[]" id="discount_1" class="form-control changesNo rounded disc1" placeholder="@lang('site.discount')">
                                    <div class="input-group-prepend form-controlsm">
                                        <div class="input-group-text rounded" style="padding: 0;">
                                          <select class="text-center changesNo form-control-sm disc_type1 " id="disctype_1" name="disc_type[]" style="height: 100%;border: 0;width: 100%;padding: 0;">
                                              <option value="1">%</option>
                                              <option value="2">@lang('site.num')</option>
                                            </select>
                                          </div>
                                      </div>
                                </div>
                            </td>

                            <td class="description">
                                <select id="tax_1" class="form-control form-control-sm  tax1 changesNo"  name="item_tax[]" >
                                    <option  value="0">@lang('site.no')</option>
                                    @foreach ($taxes as $tax)
                                    <option value="{{ $tax->rate }}" >{{$tax->name . '('.$tax->rate .'%)'}}</option>
                                    @endforeach
                                </select>
                            </td>

                         
                            
                            <td class="text-right description">
                               
                                <input type="number" id="total_1" name="total_line_price[]" class=" editable-amount form-control amount1 totalLinePrice" readonly>
                                
                                <!--
                                <div>
                                    <button class="btn btn-warning  mb-2 mr-2 rounded-circle calculat" id="1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </button>
                                </div>
                                -->
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>

            <button class="btn btn-secondary additem btn-sm" id="1">@lang('site.add_item')</button>

        </div>

        <div class="invoice-detail-total">
            <div class="row">

                <div class="col-md-6">

                   
                    <div class="form-group row invoice-created-by">
                        <label for="payment-method-bank-name" class="col-sm-4 col-form-label col-form-label-sm">@lang('site.discount')</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="number" name="invoice_discount" id="invoiceDiscount" class="form-control  rounded " placeholder="0.00">
                                <div class="input-group-prepend form-controlsm">
                                    <div class="input-group-text rounded" style="padding: 0;">
                                      <select class="text-center  form-control-sm" id="invoiceDiscountType" name="invoice_discount_type" style="height: 100%;border: 0;width: 100%;padding: 0;">
                                          <option value="1">%</option>
                                          <option value="2">@lang('site.num')</option>

                                        </select>
                                      </div>
                                  </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row invoice-created-by">
                        <label for="payment-method-code" class="col-sm-4 col-form-label col-form-label-sm">@lang('site.tax')</label>
                        <div class="col-sm-8">
                            <select id="invoiceTax" class="form-control form-control-sm"  name="invoice_tax" >
                                <option  value="0">@lang('site.no')</option>
                                @foreach ($taxes as $tax)
                                <option value="{{ $tax->rate }}" >{{$tax->name . '('.$tax->rate .'%)'}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row invoice-created-by">
                        <label for="payment-method-account" class="col-sm-4 col-form-label col-form-label-sm">@lang('site.shipping_cost')</label>
                        <div class="col-sm-8">
                            <input type="number" name="shipping_cost" class="form-control form-control-sm"  min="0" id="shippingCost" placeholder="0.00">
                        </div>
                    </div>


                </div>

                <div class="col-md-6">
                    <div class="totals-row">
                        <div class="invoice-totals-row invoice-summary-subtotal">

                            <div class="invoice-summary-label"> @lang('site.subtotal')</div>

                            <div class="invoice-summary-value">
                                <div class="subtotal-amount">
                                    {{-- <input class="form-control text-center" id="subTotal" readonly> --}}
                                    <span class="currency">$</span><span class="amount" id="subTotal"></span>
                                </div>
                            </div>

                        </div>


                        {{--
                        <div class="invoice-totals-row invoice-summary-total">

                            <div class="invoice-summary-label">Discount</div>

                            <div class="invoice-summary-value">
                                <div class="total-amount">
                                    <span class="currency">$</span><span>10</span>
                                </div>
                            </div>

                        </div>

                        <div class="invoice-totals-row invoice-summary-tax">

                            <div class="invoice-summary-label">Tax</div>

                            <div class="invoice-summary-value">
                                <div class="tax-amount">
                                    <span id="taxAmount">0%</span>
                                </div>
                            </div>

                        </div> --}}
                        <div class="invoice-totals-row invoice-summary-balance-due">
                            <div class="invoice-summary-label">@lang('site.total')</div>
                            <div class="invoice-summary-value">
                                <div class="balance-due-amount">
                                    <span class="currency">$</span><span id="grandTotal"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- notes --}}
        <div class="invoice-detail-note">
            <div class="row">
                <div class="col-md-12 align-self-center">
                    <div class="form-group row invoice-note">
                        <label for="invoice-detail-notes" class="col-sm-12 col-form-label col-form-label-sm">@lang('site.notes'):</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="note" id="invoice-detail-notes" placeholder='@lang('site.write_note')' style="height: 88px;"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
@push('css')
   
@endpush
@push('js')

<script>

$(document).ready(function(){

    // search for item  by ajax request
    $(".search").keyup(function(){
        var value =$(this).val();
        var id =$(this).attr('id');

            $.ajax({
                type: 'get',
                url: "{{ url('dashboard/'. $routeName .'/search/') }}"+'/'+value+'/'+id,
                success: function (data) {
                    $('.content-search'+id).html(data);

                    },
                error: function(data_error, exception) {
                    if(exception == 'error'){
                        var error_list = '' ;
                        $.each(data_error.responseJSON.errors, function(index,v){
                            error_list += '<li>'+v+'</li>';
                        });
                        $('.alert-errors ul').html(error_list)
                    }
                }
            });
    });

    // add new row
    $('.additem').on('click', function(event) {
        event.preventDefault();
        var id = parseInt($(this).attr('id')) + 1;

        getTableElement = document.querySelector('.item-table');
        currentIndex = getTableElement.rows.length;

        $html = `<tr>
                    <td class="delete-item-row">
                        <ul class="table-controls">
                            <li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>
                        </ul>
                    </td>
                    <td class="description">
                        <input type="hidden" name="item_id[]"  class=" form-control form-control-sm search item_id`+id+`" placeholder="@lang('site.item')" autocomplete="off">

                        <input type="text" id="`+id+`" class=" form-control form-control-sm search title`+id+`" placeholder="@lang('site.item')" autocomplete="off">
                            <div class="content-search`+id+`">

                            </div>
                    </td>

                    <td>
                        <input type="number"  id="price_`+id+`"  name="sale_price[]" class="form-control changesNo sale_price`+id+`" placeholder="0.00">
                    </td>


                    <td class="description">
                        <input type="number" id="quantity_`+id+`"  name="qty[]"   class="form-control changesNo form-control-sm qty`+id+`"  placeholder="@lang('site.qty')">
                    </td>

                   
                    <td class="description">
                        <div class="input-group ">
                            <input type="number" name="disc_value[]" id="discount_`+id+`" class="form-control changesNo rounded  disc`+id+`" placeholder="@lang('site.discount')">
                            <div class="input-group-prepend form-controlsm">
                                <div class="input-group-text rounded" style="padding: 0;">
                                    <select class="text-center changesNo form-control-sm disc_type`+id+`" id="disctype_`+id+`" name="disc_type[]" style="height: 100%;border: 0;width: 100%;padding: 0;">
                                        <option value="1">%</option>
                                        <option value="2">num</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="description ">
                        <select id="tax_`+id+`" class="form-control changesNo form-control-sm tax`+id+`"  name="item_tax[]" >
                            <option  value="0">@lang('site.no')</option>
                            @foreach ($taxes as $tax)
                            <option value="{{ $tax->rate }}" >{{$tax->name . '('.$tax->rate .'%)'}}</option>
                            @endforeach
                        </select>
                    </td>

                

                    <td class="text-right description">
                    
                        
                        <input type="number" id="total_`+id+`" name="total_line_price[]"  class=" editable-amount form-control totalLinePrice amount`+id+`" readonly>
                        <!--
                        <div>
                            <button class="btn btn-warning  mb-2 mr-2 rounded-circle calculat" id="`+id+`">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </button>
                        </div>
                        -->

                    </td>

                </tr>`;

        $(".item-table tbody").append($html);
        $(this).attr('id',id);
        deleteItemRow();

    // search for item  by ajax request
    $(".search").keyup(function(){

        var value =$(this).val();
        var id =$(this).attr('id');
            $.ajax({
                type: 'get',
                url: "{{ url('dashboard/'. $routeName .'/search/') }}"+'/'+value+'/'+id,
                success: function (data) {
                    $('.content-search'+id).html(data);

                    },
                error: function(data_error, exception) {
                    if(exception == 'error'){
                        var error_list = '' ;
                        $.each(data_error.responseJSON.errors, function(index,v){
                            error_list += '<li>'+v+'</li>';
                        });
                        $('.alert-errors ul').html(error_list)
                    }
                }
            });
    });

    // calculat price item after tax and discond
    $(".calculat").on('click', function(){

        var id =$(this).attr('id');
        var qty = $('.qty'+id).val();
        var sale_price = $('.sale_price'+id).val();
        var price = (qty * sale_price);
        // add tax
        var tax = $('.tax'+id).val();
        var precentTax = price * (tax/100)  ;
        var priceAfterTax =  (price + precentTax).toFixed(2);

        // add discond
        var disc =parseInt($('.disc'+id).val());
        var disc_type =$('.disc_type'+id).find(":selected").text();

        if(disc_type == 'num' && disc > 0){
            var amount =  (priceAfterTax - disc).toFixed(2) ;

        }else if(disc_type == '%' && disc > 0){
            var discond = priceAfterTax * (disc/100);
            var amount =  (priceAfterTax - discond).toFixed(2) ;
        }else{
            var amount = priceAfterTax;
        }

        $('.amount'+id).text(amount);
    });

});

    
});

$(document).on('change keyup blur','.changesNo',function(){

	id_arr          = $(this).attr('id');
	id              = id_arr.split("_");
	quantity        = $('#quantity_'+id[1]).val();
	price           = $('#price_'+id[1]).val();
    total           = (parseFloat(price)*parseFloat(quantity)).toFixed(2);
    discountValue   = $('#discount_'+id[1]).val();
    discountType    = $('#disctype_'+id[1]).val();

    if(discountType == 1) total = total - ($('#discount_'+id[1]).val() / 100 * total) ;
    if(discountType == 2) total = total - ($('#discount_'+id[1]).val()) ;

    taxRate         = $('#tax_'+id[1]).val();
    taxRate         = (parseFloat(taxRate) / 100 + 1).toFixed(2);
    total           = total * taxRate ;

	if( quantity!='' && price !='' )  $('#total_'+id[1]).val(parseFloat(total).toFixed(2));
       	
	calculateTotal();
    
});

$(document).on('change keyup blur','#invoiceDiscount',function(){
	calculateTotal();
});

$(document).on('change keyup blur','#invoiceDiscountType',function(){
	calculateTotal();
});

$(document).on('change keyup blur','#invoiceTax',function(){
	calculateTotal();
});

$(document).on('change keyup blur','#shippingCost',function(){
	calculateTotal();
});

//total price calculation 
function calculateTotal(){

	subTotal      = 0; 
    shippingCost  = 0; 
    total         = 0;
    
    //calculate subtotal
	$('.totalLinePrice').each(function(){
		if($(this).val() != '' )subTotal += parseFloat( $(this).val() );
	});
    $('#subTotal').text(subTotal.toFixed(2) );
    total         = subTotal;
    //calculate discount
    discountValue   = $('#invoiceDiscount').val();
    discountType    = $('#invoiceDiscountType').val();
    
    if(discountType == 1) total = subTotal - (discountValue / 100 * subTotal) ;
    if(discountType == 2) total = subTotal - (discountValue) ;

    //calculate tax
	taxRate = $('#invoiceTax').val();
    taxRate         = (parseFloat(taxRate) / 100 + 1).toFixed(2);
    total           = total * taxRate ;

    //calculate shipping cost
    shippingCost = $('#shippingCost').val();

    console.log(shippingCost);
    if(shippingCost != '') total = parseFloat(total) + parseFloat(shippingCost);

    $('#grandTotal').text(total.toFixed(2) );
   

}



</script>

@endpush

