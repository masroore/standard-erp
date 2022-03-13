

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

                                <button type="button" class="  btn-xs  modali" style="background-color: #fafafa !important; border:none" data-toggle="modal"
                                    data-target="#exampleModal`+id+`" title="{{$lang == 'ar' ? ' تعديل' : ' Edit '}}"> <i class="fa fa-edit"></i>
                                </button>

                                @include('backend.sales.invoices.itemmodal')
                                <div class="content-search`+id+`"></div>


                            </td>

                            <td class="description">

                                <input type="number" id="quantity_`+id+`"  name="qty[]"  min="1" class="form-control changesNo form-control-sm qty`+id+`"  placeholder="@lang('site.qty')">

                            </td>

                            <td>
                                <input type="hidden" id="priceinput`+id+`"    name="sale_price[]">
                                <span class="sale_price`+id+`" id="sale_price`+id+`">0.00</span>
                            </td>


                            <td class="description">

                                <span class="unit`+id+`">____</span>
                            </td>

                            <td class="description">
                                <input type="hidden" value="0" name="disc_value[]" id="discountinput_`+id+`">
                                <input type="hidden" value="0" name="disc_type[]" id="discounttypeinput_`+id+`">
                                <span class="disc`+id+`"> 0.00 </span>
                            </td>

                            <td class="description">

                                <input type="hidden" id="totalLineBeforTax_`+id+`" name="total_line_befor_tax_price[]" class="editable-amount form-control totalLinePriceBeforTax" >
                                <span class="amount1" id="totalBeforTax_`+id+`">0.00</span>

                            </td>

                            <td class="description tax-type-show">
                                <input type="hidden" id="tax_`+id+`"    name="item_tax_rate[]"   class="form-control tax-value-reset">
                                <input type="hidden" id="taxAmount_`+id+`"    name="item_tax_amount[]"   class="form-control itemTaxLine tax-value-reset">
                                <span class="tax_amount`+id+`">0.00</span>
                            </td>

                            <td class=" description tax-type-show">
                                <input type="hidden" id="totalLine_`+id+`" name="total_line_price[]"  class="editable-amount form-control totalLinePrice amount`+id+`" readonly>
                                <span class="amount`+id+`" id="total_`+id+`">0.00</span>
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

            handelShowTax() ;


        });


        });

        // handel normal case
        $(document).on('change keyup blur','.changesNo',function(){

            id_arr          = $(this).attr('id');
            id              = id_arr.split("_");
            quantity        = $('#quantity_'+id[1]).val();
            $('#modalquantity_'+id[1]).val(quantity);
            price           = $('#modalprice_'+id[1]).val();
            $('#sale_price'+id[1]).text(price);
            $('#priceinput'+id[1]).val(price);
            total           = (parseFloat(price)*parseFloat(quantity)).toFixed(2);

            // handel dicount

            discountValue   = $('#modeldiscount_'+id[1]).val();
            discountType    = $('#disctype_'+id[1]).val();

            $('#discountinput_'+id[1]).val(discountValue);
            $('#discounttypeinput_'+id[1]).val(discountType);

            if(discountValue != '' && typeof(discountValue) != "undefined" ){
                if(discountType == 1){
                    value = discountValue / 100 * total
                    total = total - value ;
                    $('.disc'+id[1]).text(value + ' ('+ discountValue + ' %)');
                    }
                if(discountType == 2) {
                    total = total - discountValue ;
                    $('.disc'+id[1]).text(discountValue);
                    }
            } // end of discount handel

            // handel amount befor tax

            amountBeforTax = total   ;
            $('#totalLineBeforTax_'+id[1]).val(amountBeforTax);
            $('#totalBeforTax_'+id[1]).text(amountBeforTax);

            taxType =  $('#taxType').val() ;
            if( taxType == 1){
                // handel tax
                taxRate         = $('#modeltax_'+id[1]).val();
                //alert(taxRate / 100 + 1);
                if(taxRate != '' && typeof(taxRate) != "undefined" ){
                    taxAmount   = (parseFloat(amountBeforTax) * taxRate / 100) ;
                    $('.tax_amount'+id[1]).text( taxAmount.toFixed(2) + ' ('+ taxRate + ' %)');
                    $('#taxAmount_'+id[1]).val(taxAmount.toFixed(2));
                    $('#tax_'+id[1]).val(taxRate);
                    total       = parseFloat(amountBeforTax) + parseFloat(taxAmount);
                }
            }// end of handel tax for item

            // handel selected unit
            unit  = $('#modalunit_'+id[1]).children(':selected').text();
            $('.unit'+id[1]).text(unit);


            if( quantity!='' && price !='' ){

                $('#totalLine_'+id[1]).val(parseFloat(total).toFixed(2));
                $('#total_'+id[1]).text(parseFloat(total).toFixed(2));
            }

            calculateTotal();
        }); // end of handel change qty and item

        // handel model edit
        $(document).on('click','.changesNoModal',function(){

            id_arr          = $(this).attr('id');
            id              = id_arr.split("_");
            quantity        = $('#modalquantity_'+id[1]).val();
            $('#quantity_'+id[1]).val(quantity);
            price           = $('#modalprice_'+id[1]).val();
            $('#sale_price'+id[1]).text(price);
            $('#priceinput'+id[1]).val(price);

            total           = (parseFloat(price)*parseFloat(quantity)).toFixed(2);

            // handel dicount
            discountValue   = $('#modeldiscount_'+id[1]).val();
            discountType    = $('#disctype_'+id[1]).val();

            $('#discountinput_'+id[1]).val(discountValue);
            $('#discounttypeinput_'+id[1]).val(discountType);

            if(discountValue != '' && typeof(discountValue) != "undefined" ){
                if(discountType == 1){
                    value = discountValue / 100 * total
                    total = total - value ;
                    $('.disc'+id[1]).text(value + ' ('+ discountValue + ' %)');
                }
                if(discountType == 2) {
                    total = total - discountValue ;
                    $('.disc'+id[1]).text(discountValue);
                }
            } // end of discount handel

            // handel amount befor tax
            amountBeforTax = total   ;
            $('#totalLineBeforTax_'+id[1]).val(amountBeforTax);
            $('#totalBeforTax_'+id[1]).text(amountBeforTax);

            // handel tax
            taxType =  $('#taxType').val() ;
            if( taxType == 1){

                taxRate         = $('#modeltax_'+id[1]).val();
                if(taxRate != '' && typeof(taxRate) != "undefined" ){
                    taxAmount   = (parseFloat(amountBeforTax) * taxRate / 100);
                    $('.tax_amount'+id[1]).text(taxAmount.toFixed(2) + ' ('+ taxRate + ' %)');
                    $('#taxAmount_'+id[1]).val(taxAmount.toFixed(2));
                    $('#tax_'+id[1]).val(taxRate);
                    total       = parseFloat(amountBeforTax) + parseFloat(taxAmount);
                }

            }// end of handel tax for items

            // handel selected unit
            unit  = $('#modalunit_'+id[1]).children(':selected').text();
            $('.unit'+id[1]).text(unit);


            if( quantity!='' && price !='' ){

                $('#totalLine_'+id[1]).val(parseFloat(total).toFixed(2));
                $('#total_'+id[1]).text(parseFloat(total).toFixed(2));

            }

            calculateTotal();

            $('#exampleModal'+id[1]).modal('hide');

        }); // end of handel edit modal item


        $(document).on('change keyup blur','#invoiceDiscount',function(){
            calculateTotal();
        });

        $(document).on('change keyup blur','#invoiceDiscountType',function(){
            calculateTotal();
        });

        $(document).on('change keyup blur','#invoiceTax',function(){
            calculateTotal();
        });

        $(document).on('change keyup blur','#deduction_tax',function(){
            calculateTotal();
        });

        $(document).on('change keyup blur','#shippingCost',function(){
            calculateTotal();
        });

        $(document).on('change keyup blur','#taxType',function(){
            handelShowTax() ;
        });

        $(document).on('change keyup blur','#payment-invoice-type',function(){

            handelPaymentType() ;
        });

        $(document).on('change keyup blur','#paymentAmount',function(){

            handelPaymentType() ;
        });

        $('#taxInvoiceShow').show();
        $('.tax-type-show').hide();
        $('.tax-value-reset').val(0);
        //function handel taxes
        function handelShowTax(){
            taxType   = $('#taxType').val();
            // console.log(taxType);
            if(taxType == 1){
                $('#taxInvoiceShow').hide();
                $('.tax-type-show').show();
                $('#invoiceTax').val(0);

            }else if(taxType == 2){
                $('#taxInvoiceShow').show();
                $('.tax-type-show').hide();
                $('.tax-value-reset').val(0);

            }else if(taxType == 3){
                $('.tax-type-show').show();
                $('#taxInvoiceShow').show();

            }
        }

         //function handel payments type
        function handelPaymentType(){
            payType  = $('#payment-invoice-type').val();
            total    = $("#grandTotal").val();
            // console.log(taxType); 1 => cash , 2 => fees ; 3 => deffred

            if(payType == 1){
                $("#remainingAmount").attr('readonly','readonly');
                $("#paymentAmount").attr('readonly','readonly');
                $("#paymentType").show();


                $("#remainingAmount").val(0);
                $("#paymentAmount").val(total);

            }else if(payType == 2){

                $("#remainingAmount").attr('readonly','readonly');
                $("#paymentAmount").attr('readonly',false);
                $("#paymentType").show();

                payAmount     = $("#paymentAmount").val();
                reamingAmount =  $("#remainingAmount").val((total - payAmount).toFixed(2));

            }else if(payType == 3){

                $("#remainingAmount").attr('readonly','readonly');
                $("#paymentAmount").attr('readonly','readonly');
                $("#paymentType").hide();

                $("#remainingAmount").val(total);
                $("#paymentAmount").val(0);
            }
        }

        //total price calculation
        function calculateTotal(){
            itemsTotal    = 0;
            subTotal      = 0;
            shippingCost  = 0;
            total         = 0;
            itemTaxLine   = 0;
            totalAfterDiscount = 0;
            taxType       = $('#taxType').val();

            //clac subtotal without tax
            $('.totalLinePriceBeforTax').each(function(){
                if($(this).val() != '' )itemsTotal += parseFloat( $(this).val() );
            });

           $('#itemsTotal').val(itemsTotal.toFixed(2) );
           totalAfterDiscount = itemsTotal;
            //calculate discount
            discountValue   = $('#invoiceDiscount').val();
            discountType    = $('#invoiceDiscountType').val();

            if(discountType == 1) {
                value = discountValue / 100 * itemsTotal
                totalAfterDiscount = itemsTotal - value ;
                $('#invoice-discount-amount').val(value.toFixed(2));
            }
            if(discountType == 2) {
                totalAfterDiscount = itemsTotal - (discountValue) ;
                $('#invoice-discount-amount').val(discountValue);
            }
            $('#subTotalAfterDiscount').val(totalAfterDiscount.toFixed(2) );

            //handel taxes
            if(taxType == 2){
                //calculate added tax for wholl invoice
                taxRate   = $('#invoiceTax').val();
                taxAmount = totalAfterDiscount * (taxRate / 100) ;
                $('#invoice-tax-amount').val(taxAmount.toFixed(2));
            }else if(taxType == 1){
                //calculate added tax for items  taxItemAmount

                var amountId = $('[id^=taxAmount]');
                var taxAmount = 0;

                amountId.each(function(index, value){
                taxAmount += +($(value).val());
                });

                $('#taxItemsAmount').val(taxAmount.toFixed(2));
            }

            // calc deduction Tax Rate
            deductionTaxRate   = $('#deduction_tax').val()
            deductionTaxAmount =  totalAfterDiscount * (deductionTaxRate / 100) ;
            $('#deduction-tax-amount').val(deductionTaxAmount.toFixed(2));

            totalAftertaxs = totalAfterDiscount + taxAmount - deductionTaxAmount ;
            $('#subTotalAfterTaxs').val(totalAftertaxs.toFixed(2) );

            //calculate shipping cost and other expenses
            shippingCost = $('#shippingCost').val();

            //console.log(shippingCost);
            if(shippingCost != '') totalAfterExpenses = parseFloat(totalAftertaxs) + parseFloat(shippingCost);

            $('#grandTotal').val(totalAfterExpenses.toFixed(2) );

            handelPaymentType();

        }// end of calculateTotal








    </script>


<script>
    $( document ).ready(function() {


    $( "#importFromDelivers" ).click(function(event) {
        event.preventDefault();

        var customerId = $("#customerId").val();

        if(customerId != null){

        $.ajax({
                url: "{{ url('dashboard/sales/delivers/') }}"+'/'+customerId,
                type:"GET",
                success: function (data) {
                    $('.content-receives').html(data);

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
            }); // end of ajax

        }else{

            alert('please select customer');

        }


    });


    });


    $(document).on('change', '#record__select-all', function () {

    $('.record__select').prop('checked', this.checked);
    getSelectedRecords();
    });

    $(document).on('click', '.close-receives', function () {
    $('.widget-content-area').remove();
    });

    $(document).on('click', '#bulk-select', function (event) {
    event.preventDefault();
    var recordSelectIds = [];

    $.each($(".record__select:checked"), function () {
        recordSelectIds.push($(this).val());
    });

    if(recordSelectIds.length > 0){
        $.ajax({
                    url: "{{ url('dashboard/sales/delivers/items') }}"+'/'+recordSelectIds,
                    type:"GET",
                    success: function (data) {
                        $('.item-receives').html(data);

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
                }); // end of ajax
        $('.widget-content-area').remove();
        $('.standrd-tr').hide();
        $('.additem').hide();
    }else{
        alert('please select receives');
    }


    });



    function getSelectedRecords() {


    var recordSelectIds = [];

    $.each($(".record__select:checked"), function () {
        recordSelectIds.push($(this).val());
    });

    recordSelectIds.length > 0
        ? $('#bulk-select').attr('disabled', false)
        : $('#bulk-select').attr('disabled', false)

    } //$('#record-ids').val();



</script>

<script>
        $('.option-visible').hide();
        $('.transfare').hide();
        $('.check').hide();

        $(document).on('change keyup blur','#pay-mthod',function(){

            payValue   = $('#pay-mthod').val();

            if(payValue == 'check') {
                $('.option-visible').show();
                $('.check').show();
                $('.transfare').hide();
            }else if(payValue == 'transfare'){
                $('.option-visible').show();
                $('.check').hide();
                $('.transfare').show();
            }else{
                $('.option-visible').hide();
                $('.transfare').hide();
                $('.check').hide();
            }
        });
</script>


