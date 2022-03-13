<div class="invoice-detail-terms">

    <div class="row justify-content-between">

        <div class="col-md-3">

            <div class="form-group mb-4">
                <label for="number">@lang('site.code')</label>
                <input type="text" name="reference_no" class="form-control form-control-sm" id="number" value="{{ autoCode('Emt','Purch') }}" >
            </div>

        </div>

        <div class="col-md-3">

            <div class="form-group mb-4">
                <label for="date">@lang('site.date')</label>
                <input id="basicFlatpickr" name="date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="@lang('site.select_date')" >
            </div>
        </div>



        <div class="form-group col-md-3">
            <label for="">@lang('site.suppliers')</label>
            <select class="form-control basic" name="supplier_id" id="supplierId">
                <option disabled selected > @lang('site.select_supplier') </option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" >{{ $supplier->company_name }} ({{ $supplier->contact_person }})</option>
                @endforeach

            </select>
        </div>

        <div class="form-group col-md-3">
            <label for="">@lang('site.stores')</label>
            <select class="form-control basic" name="store_id" id="storeId">
                {{-- <option disabled selected > @lang('site.select_store') </option> --}}
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}" >{{ $lang == 'ar' ?  $store->title_ar:  $store->title_en }}</option>
                @endforeach

            </select>
        </div>

        <div class="form-group col-md-3">
            <label for="">@lang('site.received_status')</label>
            <select class="form-control" name="is_received">
                <option value="0"> @lang('site.pending') </option>
                <option value="1"> @lang('site.received') </option>

            </select>
        </div>

        <div class="form-group col-md-3">
            <label for="">@lang('site.payment_invoice_type')</label>
            <select class="form-control"  name="invoice_payment_type" id="payment-invoice-type">
                <option value="1">@lang('site.cash_payment')</option>
                <option value="2">@lang('site.fees_payment')</option>
                <option value="3">@lang('site.deferred_payment')</option>
            </select>
        </div>

        <div class="form-group col-md-3">
            <label for="">@lang('site.tax_type')</label>
            <select class="form-control " name="tax_type" id="taxType">
                {{-- <option value="3"> @lang('site.for_both') </option> --}}
                <option value="2"> @lang('site.for_invoice') </option>
                <option value="1"> @lang('site.for_items') </option>

            </select>
        </div>

        <div class="form-group col-md-3">
            <label for="">@lang('site.docment')</label>
            <div class="mb-4">
                <input type="file" name="document" class="form-control">

            </div>
        </div>
        <div class="form-group col-md-4"></div>



    </div>

</div>
