<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal{{$row->id}}" title="{{$lang == 'ar' ? ' تعديل' : ' Edit '}}">
    <i class="fa fa-pencil" aria-hidden="true"></i>
</button>

<div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$row->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel{{$row->id}}"> @lang('site.edit_medical')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ $lang == 'ar' ? ' اغلاق' : 'Close ' }}">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <form action="{{route('dashboard.medicals.update', $row->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
            <div class="modal-body">

                <div class="row">

                    <div class="form-group col-6">

                        <label for="percent">@lang('site.employee')</label>

                        <select class="form-control " name="employee_id">
                            <option value="" >---</option>

                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" {{isset($row) && $row->employee_id == $employee->id ? 'selected'  : ''}} >{{ $employee->name }}</option>

                             @endforeach

                        </select>
                    </div>

                    <div class="form-group col-6">

                        <label for="percent">@lang('site.date')</label>
                        <input id="basicFlatpickr{{ $row->id }}" name="date" value="{{ $row->date }}" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date.." readonly="readonly">
                    </div>
                </div>
                <div class="row">

                    <div class="form-group col-6">

                        <label for="percent">@lang('site.title_en')</label>

                        <input type="text"  name="title_en" value="{{ $row->title_en }}" class="form-control " type="text" placeholder="" >

                    </div>

                    <div class="form-group col-6">

                        <label for="percent">@lang('site.title_ar')</label>

                        <input type="text"  name="title_ar" value="{{ $row->title_ar }}" class="form-control " type="text" placeholder="" >

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
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> {{ $lang == 'ar' ? ' الغاء' : 'Cancel' }}</button>
                <button type="submit" class="btn btn-warning">@lang('site.update')</button>
            </div>
            </form>
        </div>
    </div>
</div>

