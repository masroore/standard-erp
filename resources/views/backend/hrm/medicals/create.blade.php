<div class="text-center">
    <button type="button" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#exampleModal">
        @lang('site.add_new')
    </button>
</div>

{{-- handel add new  --}}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> @lang('site.add_new_medical')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('site.close')">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <form action="{{route('dashboard.medicals.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

            <div class="modal-body">

                <div class="row">

                    <div class="form-group col-6">

                        <label for="percent">@lang('site.employee')</label>

                        <select class="form-control basic" name="employee_id">
                            <option value="" >---</option>

                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" >{{ $employee->name }}</option>

                             @endforeach

                        </select>
                    </div>

                    <div class="form-group col-6">

                        <label for="percent">@lang('site.date')</label>
                        <input id="basicFlatpickr" name="date" value="" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date.." readonly="readonly">
                    </div>
                </div>
                <div class="row">

                    <div class="form-group col-6">

                        <label for="percent">@lang('site.title_en')</label>

                        <input type="text"  name="title_en" value="" class="form-control " type="text" placeholder="" >

                    </div>

                    <div class="form-group col-6">

                        <label for="percent">@lang('site.title_ar')</label>

                        <input type="text"  name="title_ar" value="" class="form-control " type="text" placeholder="" >

                    </div>

                    <div class="form-group col-6 m-auto">

                        <label for="percent">@lang('site.image')</label>
                        <div class="invoice-logo">
                            <div class="upload">
                                <input type="file" name="image" id="input-file-max-fs" class="dropify" data-max-file-size="2M" />
                            </div>
                        </div>
                    </div>

                </div>



            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>@lang('site.cancel')</button>
                <button type="submit" class="btn btn-primary">@lang('site.save')</button>
            </div>
            </form>
        </div>
    </div>
</div>


