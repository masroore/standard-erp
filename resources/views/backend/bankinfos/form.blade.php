<div class="form-row mb-4 widget-content widget-content-area p-3">
    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
        <h4>@lang('site.beneficiary_info')</h4> <br>
    </div>

    <div class="form-group col-md-6">
        <label for="">@lang('site.beneficiary_name')</label>
         <input required  type="text" name="beneficiary_name" class="form-control" value="{{ old('beneficiary_name', isset($row) ? $row->beneficiary_name : '')}}"   >
    </div>
    <div class="form-group col-md-6">
        <label for="">@lang('site.beneficiary_account_no')</label>
         <input required  type="text" name="beneficiary_account_no" value="{{ old('beneficiary_account_no', isset($row) ? $row->beneficiary_account_no : '')}}" class="form-control">
    </div>
    <div class="form-group col-md-6">
        <label for="">@lang('site.beneficiary_address')</label>
         <input required  type="text" name="beneficiary_address" class="form-control" value="{{ old('beneficiary_address', isset($row) ? $row->beneficiary_address : '')}}"   >
    </div>


    <div class="form-group col-md-6">
        <label for="">@lang('site.beneficiary_city')</label>
         <input required  type="text" name="beneficiary_city" class="form-control" value="{{ old('beneficiary_city', isset($row) ? $row->beneficiary_city : '')}}" >
    </div>

    <div class="form-group col-md-6">
        <label for="">@lang('site.beneficiary_street')</label>
         <input required  type="text" name="beneficiary_street" class="form-control" value="{{ old('beneficiary_street', isset($row) ? $row->beneficiary_street : '')}}" >
    </div>






</div>

<div class="form-row mb-4 widget-content widget-content-area p-3">

    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
        <h4>@lang('site.beneficiary_bank_info')</h4> <br>
    </div>

    <div class="form-group col-md-6">
        <label for="">@lang('site.beneficiary_bank_name')</label>
         <input required  type="text" name="beneficiary_bank_name" class="form-control" value="{{ old('beneficiary_bank_name', isset($row) ? $row->beneficiary_bank_name : '')}}" >
    </div>
    <div class="form-group col-md-6">
        <label for="">@lang('site.beneficiary_bank_code')</label>
         <input required  type="text" name="beneficiary_bank_code" class="form-control" value="{{ old('beneficiary_bank_code', isset($row) ? $row->beneficiary_bank_code : '')}}" >
    </div>
    <div class="form-group col-md-6">
        <label for="">@lang('site.beneficiary_bank_swift_code')</label>
         <input required  type="text" name="beneficiary_bank_swift_code" class="form-control" value="{{ old('beneficiary_bank_swift_code', isset($row) ? $row->beneficiary_bank_swift_code : '')}}" >
    </div>
    <div class="form-group col-md-6">
        <label for="">@lang('site.iban_code')</label>
         <input required  type="text" name="iban_code" class="form-control" value="{{ old('iban_code', isset($row) ? $row->iban_code : '')}}" >
    </div>
    <div class="form-group col-md-6">
        <label for="">@lang('site.beneficiary_bank_branch')</label>
         <input required  type="text" name="beneficiary_bank_branch" class="form-control" value="{{ old('beneficiary_bank_branch', isset($row) ? $row->beneficiary_bank_branch : '')}}" >
    </div>
    <div class="form-group col-md-6">
        <label for="">@lang('site.beneficiary_bank_address')</label>
         <input required  type="text" name="beneficiary_bank_address" class="form-control" value="{{ old('beneficiary_bank_address', isset($row) ? $row->beneficiary_bank_address : '')}}" >
    </div>
    <div class="form-group col-md-6">
        <label for="">@lang('site.beneficiary_bank_city')</label>
         <input required  type="text" name="beneficiary_bank_city" class="form-control" value="{{ old('beneficiary_bank_city', isset($row) ? $row->beneficiary_bank_city : '')}}" >
    </div>
    <div class="form-group col-md-6">
        <label for="">@lang('site.intermediary_bank')</label>
         <input   type="text" name="intermediary_bank_name" class="form-control" value="{{ old('intermediary_bank_name', isset($row) ? $row->intermediary_bank_name : '')}}" >
    </div>
    <div class="form-group col-md-6">
        <label for="">@lang('site.bank_street')</label>
         <input required  type="text" name="beneficiary_bank_street" class="form-control" value="{{ old('beneficiary_bank_street', isset($row) ? $row->beneficiary_bank_street : '')}}" >
    </div>


    <div class="col-md-6">
        <div class="row">
            <div class=" col-md-6 text-left">
                <label for="percent">@lang('site.this_bank_info_related_by'): </label>

                <br>

                <label class="new-control new-radio new-radio-text radio-info">
                    <input  required type="radio" class="new-control-input m-1" name="bank_related" {{ ( isset($row) && $row->customer_id > 0 ) ? 'checked' : ''  }} value="customer">
                    <span class="new-control-indicator"></span><span class="new-radio-content" > @lang('site.customer')</span>
                  </label>
                  <label class="new-control new-radio new-radio-text radio-info">
                    <input  required type="radio" class="new-control-input m-1" name="bank_related" {{ (isset($row) && $row->supplier_id > 0 ) ? 'checked' : ''  }} value="supplier">
                    <span class="new-control-indicator"></span><span class="new-radio-content">   @lang('site.supplier')</span>
                  </label>
            </div>
            <div class="form-group  col-md-6 text-left" >
                <div id="customers" class="{{ (isset($row) && $row->customer_id >  0 ) ? '' : 'd-none'  }}">

                    <label for="customers">@lang('site.customer')</label>

                    <select class="form-control basic" name="customer_id">
                        <option value="">---</option>

                        @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ ( isset($row) &&  $row->customer_id ==  $customer->id ) ? 'selected' : ''  }} >{{ $customer->name }}</option>

                        @endforeach

                    </select>
                </div>
                <div id="supplier" class="{{ (isset($row) &&  $row->supplier_id >0 ) ? '' : 'd-none'  }}">

                    <label for="suppliers">@lang('site.supplier')</label>

                    <select class="form-control basic2" name="supplier_id">
                        <option value="">---</option>

                        @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ (isset($row) &&  $row->supplier_id ==  $supplier->id ) ? 'selected' : ''  }}>{{ $supplier->contact_person }}</option>

                        @endforeach

                    </select>
                </div>


            </div>
        </div>

    </div>
</div>

@push('js')
<script type="text/javascript">



    $('input[name=bank_related]').click(function(){
        var value = $(this).val();
        if(value == 'customer'){
            $('#customers').removeClass('d-none');
            $('#supplier').addClass('d-none');
        }else if(value == 'supplier'){
            $('#supplier').removeClass('d-none');
            $('#customers').addClass('d-none');
        }

    });
        var ss = $(".basic").select2({
            tags: true,

        });
        var ss = $(".basic2").select2({
            tags: true,

        });
</script>
@endpush


