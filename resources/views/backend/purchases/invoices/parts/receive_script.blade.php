<script>
    $( document ).ready(function() {


        $( "#importFromReceives" ).click(function(event) {
            event.preventDefault();

            var supplierId = $("#supplierId").val();

            if(supplierId != null){

               $.ajax({
                    url: "{{ url('dashboard/purchases/receives/') }}"+'/'+supplierId,
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

                alert('please select supplier');

            }


        });


    });


    $(document).on('change', '#record__select-all', function () {

        $('.record__select').prop('checked', this.checked);
        getSelectedRecords();
    });

    $(document).on('click', '.record__select', function () {
        var recordSelectIds = [];
            $.each($(".record__select:checked"), function () {
                recordSelectIds.push($(this).val());
            });
            recordSelectIds.length > 0
                ? $('#bulk-select').attr('disabled', false)
                : $('#bulk-select').attr('disabled', true)

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
                        url: "{{ url('dashboard/purchases/receives/items') }}"+'/'+recordSelectIds,
                        type:"GET",
                        success: function (data) {

                            $('.item-receives').html(data);
                            handelModelTax();
                            handelShowTax() ;
                            calculateTotal();
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
            $('.standrd-tr').remove();
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
            : $('#bulk-select').attr('disabled', true)

    } //$('#record-ids').val();

    $(document).on('change keyup blur','.change-receive-price',function(){


        id_arr          = $(this).attr('id');
        id              = id_arr.split("_");
        quantity        = $('#quantity_'+id[1]).val();
        price           = $('#priceinput_'+id[1]).val();

        //handel modal value
        $('#receiveModalPrice_'+id[1]).val(price);
        $('#receiveModalQuantity_'+id[1]).val(quantity);

        amountBeforTax  = (parseFloat(price)*parseFloat(quantity)).toFixed(2);
        $('#totalLineBeforTax_'+id[1]).val(amountBeforTax);
        $('#totalBeforTax_'+id[1]).text(amountBeforTax);


        taxType =  $('#taxType').val() ;
        if(taxType == 1){
            taxRate      = $('#tax_'+id[1]).val();
            taxAmount    = ((price * taxRate / 100) * quantity).toFixed(3) ;
            console.log(taxAmount);
            $('#taxAmount_'+id[1]).val(taxAmount);
            $('#spanTaxAmount_'+id[1]).text(taxAmount);
            totalAfterTax= parseFloat(amountBeforTax) + parseFloat(taxAmount)  ;
            $('#totalLine_'+id[1]).val(totalAfterTax);
            $('#total_'+id[1]).text(totalAfterTax);
        }
        calculateTotal();

        handelModelTax();

    }); // end of handel change qty and item

      // handel model edit
    $(document).on('click','.receiveChangesNoModal',function(){

            id_arr          = $(this).attr('id');
            id              = id_arr.split("_");
            quantity        = $('#quantity_'+id[1]).val();
            price           = $('#receiveModalPrice_'+id[1]).val();
            $('#priceinput_'+id[1]).val(price);

            amountBeforTax  = (parseFloat(price)*parseFloat(quantity)).toFixed(2);



            // handel dicount
            discountValue   = $('#receiveModelDiscount_'+id[1]).val();
            discountType    = $('#receivedisctype_'+id[1]).val();

            if(discountValue != '' && typeof(discountValue) != "undefined" ){

                if(discountType == 1){
                    value          = (discountValue / 100 * amountBeforTax).toFixed(2) ;
                    amountBeforTax = amountBeforTax - value ;
                    $('.disc'+id[1]).text(value + ' ('+ discountValue + ' %)');
                }
                if(discountType == 2) {
                    amountBeforTax = amountBeforTax - discountValue ;
                    $('.disc'+id[1]).text(discountValue);
                }

                $('#discountinput_'+id[1]).val(discountValue);
                $('#discounttypeinput_'+id[1]).val(discountType);

            } // end of discount handel

            // handel amount befor tax
            $('#totalLineBeforTax_'+id[1]).val(amountBeforTax);
            $('#totalBeforTax_'+id[1]).text(amountBeforTax);


            // handel tax
            taxType =  $('#taxType').val() ;
            if(taxType == 1){

                taxRate         = $('#receiveModelTax_'+id[1]).val();
                if(taxRate != '' && typeof(taxRate) != "undefined" ){
                    taxAmount   = (parseFloat(amountBeforTax) * taxRate / 100);
                    $('.tax_amount'+id[1]).text(taxAmount.toFixed(2) + ' ('+ taxRate + ' %)');
                    $('#taxAmount_'+id[1]).val(taxAmount.toFixed(2));
                    $('#tax_'+id[1]).val(taxRate);
                    total       = parseFloat(amountBeforTax) + parseFloat(taxAmount);
                }

            }// end of handel tax for items



            if( quantity!='' && price !='' ){

                $('#totalLine_'+id[1]).val(parseFloat(total).toFixed(2));
                $('#total_'+id[1]).text(parseFloat(total).toFixed(2));

            }

            calculateTotal();

            $('#exampleModal_'+id[1]).modal('hide');

    }); // end of handel edit modal item


    function handelModelTax(){
        taxType =  $('#taxType').val() ;
            if(taxType == 2){

                $('.hideTaxIfNotOnItem').hide()

            }else{
                $('.hideTaxIfNotOnItem').show()
            }
    }// end of handel model tax






</script>
