<div class="invoice-detail-total">
    <div class="row">

        <div class="col-md-6">

            <div class="form-group row">
                <label  class="col-sm-4 col-form-label col-form-label-sm">@lang('site.subtotal')</label>

                <div class="col-sm-8">
                    <input type="number" id="itemsTotal" name="items_total" class="form-control"  min="0"  placeholder="0.00" readonly>
                </div>
            </div>

            <div class="form-group row ">
                <label class="col-sm-4 col-form-label col-form-label-sm">@lang('site.discount')</label>
                <div class="col-sm-5">
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
                <div class="col-sm-3">

                    <input type="number" name="invoice_discount_amount" class="form-control form-control-sm"  min="0" id="invoice-discount-amount" placeholder="0.00" readonly>

                </div>
            </div>


            <div class="form-group row">
                <label  class="col-sm-4 col-form-label col-form-label-sm">@lang('site.subtotal_after_discount')</label>
                <div class="col-sm-8">
                    <input type="number" id="subTotalAfterDiscount" name="sub_total_after_discount" class="form-control"  min="0"  placeholder="0.00" readonly>
                </div>
            </div>

            <div class="form-group row " id="taxInvoiceShow">
                <label for="payment-method-code" class="col-sm-4 col-form-label col-form-label-sm">@lang('site.tax')</label>
                <div class="col-sm-5">
                    <select id="invoiceTax" class="form-control form-control-sm"  name="invoice_tax" >
                        <option  value="0">@lang('site.no')</option>
                        @foreach ($taxes as $tax)
                        <option value="{{ $tax->rate }}" >{{$tax->name . '('.$tax->rate .'%)'}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">

                        <input type="number" name="invoice_tax_amount" class="form-control form-control-sm"  min="0" id="invoice-tax-amount" placeholder="0.00" readonly>

                </div>
            </div>

            <div class="form-group row tax-type-show">
                <label  class="col-sm-4 col-form-label col-form-label-sm">@lang('site.tax_mount')</label>
                <div class="col-sm-8">
                    <input type="number" id="taxItemsAmount" name="tax_item_amount" class="form-control"  min="0"  placeholder="0.00" readonly>
                </div>
            </div>


            <div class="form-group row ">
                <label for="payment-method-code" class="col-sm-4 col-form-label col-form-label-sm">@lang('site.tax_deduction')</label>
                <div class="col-sm-5">
                    <select id="deduction_tax" class="form-control form-control-sm"  name="deduction_tax" >
                        <option  value="0">@lang('site.no')</option>
                        @foreach ($taxes as $tax)
                        <option value="{{ $tax->rate }}" >{{$tax->name . '('.$tax->rate .'%)'}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">

                        <input type="number" name="deduction_tax_amount" class="form-control form-control-sm"  min="0" id="deduction-tax-amount" placeholder="0.00" readonly>

                </div>
            </div>


            <div class="form-group row">
                <label  class="col-sm-4 col-form-label col-form-label-sm">@lang('site.subtotal_after_tax')</label>
                <div class="col-sm-8">
                    <input type="number" id="subTotalAfterTaxs" name="sub_total_after_tax" class="form-control"  min="0"  placeholder="0.00" readonly>
                </div>
            </div>



            <div class="form-group row ">
                <label for="payment-method-account" class="col-sm-4 col-form-label col-form-label-sm">@lang('site.shipping_cost')</label>
                <div class="col-sm-8">
                    <input type="number" name="shipping_cost" class="form-control form-control-sm" value="0" min="0" id="shippingCost" placeholder="0.00">
                </div>
            </div>

            <div class="form-group row">
                <label  class="col-sm-4 col-form-label col-form-label-sm">@lang('site.total')</label>
                <div class="col-sm-8">
                    <input type="number" id="grandTotal" name="grand_total" class="form-control"  min="0"  placeholder="0.00" readonly>
                </div>
            </div>



        </div>

        <div class="col-md-1"></div>

        <div class="col-md-5">

                <div class="form-group row" id="paymentType">
                    <label  class="col-sm-4 col-form-label col-form-label-sm" > @lang('site.pay_type')</label>
                    <div class="col-sm-8">
                        <select class="form-control form-control-sm"  name="pay_type" >

                            <option value="cash">@lang('site.cash')</option>
                            <option value="transfare">@lang('site.bank_transfer')</option>
                            <option value="check">@lang('site.check')</option>

                        </select>
                    </div>

                </div>

                <div class="form-group row">
                    <label  class="col-sm-4 col-form-label col-form-label-sm">@lang('site.payment_amount')</label>
                    <div class="col-sm-8">
                        <input type="number" name="paid_amount" class="form-control form-control-sm"  min="0" id="paymentAmount" placeholder="0.00" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-4 col-form-label col-form-label-sm">@lang('site.remaining_amount')</label>
                    <div class="col-sm-8">
                        <input type="number" name="remaining_amount" class="form-control form-control-sm"  min="0" id="remainingAmount" placeholder="0.00" readonly>
                    </div>
                </div>

        </div>




    </div>
</div>
