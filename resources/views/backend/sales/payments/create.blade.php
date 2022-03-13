@if ($invoiceData->is_paid == 0)
<div class="text-center">
    <button type="button" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#exampleModal">
      <i class="fa fa-plus fa-lg"></i> @lang('site.add_new')
    </button>
</div>
@endif

{{-- handel add new  --}}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('site.add_payment')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <form action="{{route('dashboard.sales-payments.store')}}" method="POST" name="brand" enctype="multipart/form-data">
                @csrf

            <div class="modal-body">
                <div class="row">
                <div class="form-group col-md-4">
                    <label> @lang('site.payment_code') </label>
                    <input  type="text" name="code" value="{{ transactionCode() }}" class="form-control">
                    <input type="hidden" name="sale_id" value="{{ $invoiceData->id }}">
                    <input type="hidden" name="customer_id" value="{{ $invoiceData->customer_id }}">
                    <input type="hidden" name="paid_amount" value="{{ $invoiceData->paid_amount }}">
                </div>

                <div class="form-group col-md-4">
                    <label> @lang('site.ref') </label>
                    <input type="text" name="ref" placeholder="" class="form-control">
                </div>

                <div class="form-group col-md-4">
                    <label> @lang('site.date') </label>
                    <input id="basicFlatpickr" name="created_at" class="form-control flatpickr flatpickr-input active" type="text" placeholder="@lang('site.select_date')" >
                </div>

                <div class="form-group col-md-4">
                    <label> @lang('site.payment_amount') </label>
                    <input type="number" id="amountToPay" name="amount" placeholder="0.00" class="form-control">
                </div>

                <div class="form-group col-md-4">
                    <label> @lang('site.remaining_amount') </label>
                    <input type="number" id="reminingAmount" name="remaining_amount" value="{{ $invoiceData->remaining_amount }}" class="form-control" readonly>
                </div>

                <div class="form-group col-md-4">
                    <label> @lang('site.payment_type') </label>
                    <select class="form-control" name="paying_method" id="pay-mthod">
                        <option value="cash">@lang('site.cash')</option>
                        <option value="transfare">@lang('site.bank_transfare')</option>
                        <option value="check">@lang('site.check')</option>
                    </select>
                </div>
                </div>
                {{-- handel check and transfare --}}
                <div class="option-visible row m-2">
                    <h3 class="form-group col-md-12 text-center m-2 check"> بيانات الشيك </h3>
                    <h3 class="form-group col-md-12 text-center m-2 transfare"> بيانات التحويل </h3>

                    <div class="form-group col-md-3">
                        <label> @lang('site.banks') </label>
                        <select class="form-control" name="bank_id">
                            <option value="">---</option>
                        @foreach ($banks as $bank )
                        <option value="{{ $bank->id }}">{{ $bank->title_en }}</option>
                        @endforeach

                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label> @lang('site.number') </label>
                        <input type="text" name="document_code" placeholder="" class="form-control">
                    </div>

                    <div class="form-group col-md-3 check">
                        <label> @lang('site.created_date') </label>
                        <input id="basicFlatpickr3" name="created_date" class="form-control basicDate flatpickr flatpickr-input active" type="text" placeholder="@lang('site.select_date')" >
                    </div>

                    <div class="form-group col-md-3">
                        <label class="check"> @lang('site.due_date') </label>
                        <label class="transfare"> @lang('site.transfare_date') </label>
                        <input  name="due_date" class="form-control basicDate flatpickr flatpickr-input active" type="text" placeholder="@lang('site.select_date')" >
                    </div>

                    <div class="form-group col-md-3 transfare">
                        <label> @lang('site.transfare_bank_fees') </label>
                        <input type="number"  name="bank_transfare_fees" placeholder="0.00" class="form-control">
                    </div>

                </div>

                <div class="form-group">
                    <label> @lang('site.notes') </label>
                    <textarea class="form-control" cols="5" name="notes"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> @lang('site.cancel')</button>
                <button type="submit" class="btn btn-primary">@lang('site.save')</button>
            </div>
            </form>
        </div>
    </div>
</div>

@push('js')

<script>
   // handel normal case
   $(document).on('change keyup blur','#amountToPay',function(){

        amount         = $('#amountToPay').val();
        newRemining    = {{ $invoiceData->remaining_amount }} - amount;

        $('#reminingAmount').val(newRemining);

}); // end of handel change qty and item
</script>

@endpush
