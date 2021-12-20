

@if ($row->paid_by > 0)
<a href={{ route('dashboard.salaryEmployee.invoice',$row->id) }} class="btn btn-success"  >
    @lang('site.payslip')
</a>
@else
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal{{$row->id}}" >
    @lang('site.pay_now')
</button>
@endif

<div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$row->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel{{$row->id}}"> @lang('site.payment_form')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ $lang == 'ar' ? ' اغلاق' : 'Close ' }}">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <form action="{{route('dashboard.salaryEmployee.update', $row->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
            <div class="modal-body">


                <div class="">


                    <div class="form-group row">
                        <label for="employee_id" class="col-sm-3 col-form-label">  @lang('site.employee_name')</label>
                        <div class="col-sm-9">
                            <input type="text" name="" class="form-control" id="employee_name" value="{{ $row->name }}" readonly="" autocomplete="off">
                            <input type="hidden" name="employee_id" class="form-control" id="employee_id" value="{{ $row->employee_id }}" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="total_salary" class="col-sm-3 col-form-label">  @lang('site.total_salary') </label>
                        <div class="col-sm-9">
                            <input type="text" name="total_salary" class="form-control" id="total_salary" value="{{ $row->total_salary }}" readonly="" autocomplete="off">
                        </div>
                    </div>

                   <div class="form-group row">
                        <label for="total_working_minutes" class="col-sm-3 col-form-label"> @lang('site.working_hour')</label>
                        <div class="col-sm-9">
                            <input type="text" name="working_hour" class="form-control" id="total_working_minutes" value="00.00"  autocomplete="off">
                        </div>
                    </div>
                     <div class="form-group row">
                        <label for="working_period" class="col-sm-3 col-form-label"> @lang('site.working_day') </label>
                        <div class="col-sm-9">
                            <input type="text" name="working_day" class="form-control" id="working_period" value="0"  autocomplete="off">
                        </div>
                    </div>
                            <div class="form-group row">
                                <label for="payment_type" class="col-sm-3 col-form-label"> @lang('site.payment_type')<i class="text-danger">*</i></label>
                                <div class="col-sm-9">
                                    <select name="pay_type" class="form-control  required=" id="paytype"  tabindex="-1" aria-hidden="true" autocomplete="off">
                                        <option value="">@lang('site.select_payment_option')</option>
                                        <option value="1">@lang('site.cash_payment')</option>
                                        <option value="2">@lang('site.bank_payment')</option>
                                    </select>
                                </div>

                            </div>



                </div>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> @lang('site.cancel')</button>
                <button type="submit" class="btn btn-primary">@lang('site.pay')</button>
            </div>
            </form>
        </div>
    </div>
</div>

