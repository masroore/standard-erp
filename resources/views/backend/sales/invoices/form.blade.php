
        <div class="invoice-detail-title">
            <h4 class="font-weight-bold"> @lang('site.add_sales')</h4>
            <a href="{{ route('dashboard.sales.index') }}" class="btn btn-primary float-right"><i class="fa fa-list"></i> @lang('site.sales_list')</a>

        </div>

        {{-- master data --}}
        <div class="invoice-detail-terms">

            <div class="row justify-content-between">

                <div class="col-md-4">

                    <div class="form-group mb-4">
                        <label for="number">@lang('site.code')</label>
                        <input type="text" name="reference_no" class="form-control form-control-sm" id="number" value="{{ autoCode('Emt','Purch') }}" >
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group mb-4">
                        <label for="date">@lang('site.date')</label>
                        <input id="basicFlatpickr" name="date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="@lang('site.select_date')" >
                    </div>
                </div>



                <div class="form-group col-md-4">
                    <label for="">@lang('site.customer')</label>
                    <select class="form-control basic" name="customer_id">
                        <option disabled selected > @lang('site.select_customer') </option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" >{{ $customer->company_name }} ({{ $customer->name }})</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="">@lang('site.stores')</label>
                    <select class="form-control basic" name="store_id">
                        {{-- <option disabled selected > @lang('site.select_store') </option> --}}
                        @foreach ($stores as $store)
                            <option value="{{ $store->id }}" >{{ $lang == 'ar' ?  $store->title_ar:  $store->title_en }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="">@lang('site.received_status')</label>
                    <select class="form-control" name="is_received">
                        <option value="0"> @lang('site.pending') </option>
                        <option value="1"> @lang('site.received') </option>

                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="">@lang('site.payment_invoice_type')</label>
                    <select class="form-control"  name="invoice_payment_type" id="payment-invoice-type">
                        <option value="1">@lang('site.cash_payment')</option>
                        <option value="2">@lang('site.fees_payment')</option>
                        <option value="3">@lang('site.deferred_payment')</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="">@lang('site.tax_type')</label>
                    <select class="form-control " name="tax_type" id="taxType">
                        <option value="3"> @lang('site.for_both') </option>
                        <option value="2"> @lang('site.for_invoice') </option>
                        <option value="1"> @lang('site.for_items') </option>

                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="">@lang('site.docment')</label>
                    <div class="custom-file mb-4">
                        <input type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
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
                            <th width="40%">@lang('site.item')</th>
                            <th width="15%">@lang('site.qty')</th>
                            <th >@lang('site.price')</th>
                            <th >@lang('site.unit')</th>
                            <th >@lang('site.discount')</th>
                            <th class="tax-type-show">@lang('site.tax')</th>
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

                                {{-- edit item data --}}
                                <button type="button" class="  btn-xs  modali" style="background-color: #fafafa !important; border:none" data-toggle="modal"
                                        data-target="#exampleModal1" title="{{$lang == 'ar' ? ' تعديل' : ' Edit '}}"> <i class="fa fa-edit"></i>
                                </button>
                                @include('backend.sales.invoices.itemmodal')


                                <div class="content-search1"> </div>
                            </td>

                            <td class="description">
                                <input type="number" min="1" id="quantity_1" name="qty[]" class="form-control form-control-sm qty1 calculat changesNo"  placeholder="@lang('site.qty')">

                            </td>

                            <td class="description">
                                <input type="hidden" id="priceinput1"    name="sale_price[]">
                                <span class="sale_price1" id="sale_price1">0.00</span>
                            </td>



                            <td class="description">
                                <span class="unit1">____</span>
                            </td>

                            <td class="description">
                                <input type="hidden" value="0" name="disc_value[]" id="discountinput_1">
                                <input type="hidden" value="0" name="disc_type[]" id="discounttypeinput_1">
                                <span class="disc1"> 0.00 </span>
                            </td>

                            <td class="description  tax-type-show">

                                <input type="hidden" id="tax_1"          name="item_tax_rate[]"   class="form-control tax-value-reset">
                                <input type="hidden" id="taxAmount_1"    name="item_tax_amount[]"   class="form-control tax-value-reset">
                                <span class="tax_amount1">0.00</span>
                            </td>



                            <td class="description">

                                <input type="hidden" id="totalLine_1" name="total_line_price[]" class=" editable-amount form-control totalLinePrice" >
                                <span class="amount1" id="total_1">0.00</span>

                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>

            <button class="btn btn-secondary additem btn-sm" id="1">@lang('site.add_item')</button>

        </div>

         {{-- totals details --}}
        <div class="invoice-detail-total">
            <div class="row">

                <div class="col-md-6">

                    <div class="form-group row">
                        <label  class="col-sm-4 col-form-label col-form-label-sm">@lang('site.subtotal')</label>
                        <div class="col-sm-8">
                            <input type="number" id="subTotal" name="sub_total" class="form-control"  min="0" id="" placeholder="0.00" readonly>
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



                    <div class="form-group row ">
                        <label for="payment-method-account" class="col-sm-4 col-form-label col-form-label-sm">@lang('site.shipping_cost')</label>
                        <div class="col-sm-8">
                            <input type="number" name="shipping_cost" class="form-control form-control-sm"  min="0" id="shippingCost" placeholder="0.00">
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

                                    <option value="1">@lang('site.cash')</option>
                                    <option value="2">@lang('site.bank_transfer')</option>
                                    <option value="2">@lang('site.vezai')</option>
                                    <option value="1">@lang('site.check')</option>

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




