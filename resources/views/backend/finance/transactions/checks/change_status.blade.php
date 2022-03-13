<div class="modal fade" id="exampleModal_{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_{{ $row->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('dashboard.finance.transactions.checks.change.status') }}" method="POST" >
                @csrf
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel_1">@lang('site.edit')  @lang('site.status')<span id="modeltitle_{{ $row->id }}" ></span></h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('site.close')">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <label>@lang('site.date')</label>

                    <input id="basicFlatpickr" name="created_at" class="form-control flatpickr flatpickr-input active" type="text" value="{{ $row->due_date }}" >
                </div>
                <div class="form-group">
                    <label> @lang('site.status')</label>
                    <select class="form-control" name="check_status">
                        <option selected disabled>@lang('site.pending')</option>
                        <option value="1">@lang('site.paid')</option>
                        <option value="2">@lang('site.bounced')</option>
                    </select>
                    <input type="hidden" value="{{ $row->id }}" name="transaction_id">
                </div>


            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> @lang('site.cancel')</button>

               <button type="submit" class="btn btn-warning">@lang('site.edit')</a>
            </div>
            </form>

        </div>
    </div>
</div>
