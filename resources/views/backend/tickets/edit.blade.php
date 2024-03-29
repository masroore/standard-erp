<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal{{$row->id}}" title="{{$lang == 'ar' ? ' تعديل' : ' Edit '}}">
    <i class="fa fa-pencil" aria-hidden="true"></i>
</button>

<div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$row->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel{{$row->id}}"> @lang('site.edit_ticket')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ $lang == 'ar' ? ' اغلاق' : 'Close ' }}">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <form action="{{route('dashboard.tickets.update', $row->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body row">
                    <div class="form-group col-md-12">

                        <label for="percent">@lang('site.subject')</label>

                        <input  type="text" name="subject" value="{{ $row->subject }}"  class="form-control" required>

                    </div>
                    <div class="form-group col-md-12">

                        {{-- {{ dd( $row->users->toArray()) }} --}}
                        <label for="percent">@lang('site.assign_to')</label>
                        <select class="form-control  basic6{{ $row->id }}" name="users[]"  multiple id="user">

                            @foreach ($users as $user)
                                <option   option value="{{ $user->id }}" {{ (in_array($user->id,  $row->users->toArray())) ? 'selected' : '' }} >{{$user->name}}</option>

                            @endforeach
                        </select>
                </div>

                    <div class="form-group col-md-6">

                        <label for="percent">@lang('site.status')</label>

                        <select class="form-control " name="status">
                            <option value="open" {{ ( $row->status == 'open') ? 'selected' : '' }}>@lang('site.open')</option>
                            <option value="pending" {{ ( $row->status == 'pending') ? 'selected' : '' }}>@lang('site.pending')</option>
                            <option value="resolved" {{ ( $row->status == 'resolved') ? 'selected' : '' }}>@lang('site.resolved')</option>
                            <option value="closed" {{ ( $row->status == 'closed') ? 'selected' : '' }}>@lang('site.closed')</option>
                        </select>

                    </div>
                    <div class="form-group col-md-6">

                        <label for="percent">@lang('site.priority')</label>

                        <select class="form-control " name="priority">
                            <option value="low" {{ ( $row->priority == 'low') ? 'selected' : '' }}>@lang('site.low')</option>
                            <option value="medium" {{ ( $row->priority == 'medium') ? 'selected' : '' }}>@lang('site.medium')</option>
                            <option value="high" {{ ( $row->priority == 'high') ? 'selected' : '' }}>@lang('site.high')</option>
                            <option value="urgent" {{ ( $row->priority == 'urgent') ? 'selected' : '' }}>@lang('site.urgent')</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6" style="display: grid;">
                        <label for="name">@lang('site.department')</label>

                        <select class="form-control basic4{{ $row->id }}" name="department_id">
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{isset($row) && $row->department_id == $department->id ? 'selected'  : ''}}>{{$lang == 'ar' ?$department->name_ar : $department->name_en}}</option>

                            @endforeach

                        </select>
                    </div>


                    {{-- <div class="form-group col-md-6" style="display: grid;">
                        <label for="name">@lang('site.ticket_for_customer')</label>

                        <select class="form-control basic5{{ $row->id }}" name="customer_id">
                            @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" {{isset($row) && $row->customer_id == $customer->id ? 'selected'  : ''}}>{{$customer->name }}</option>
                            @endforeach

                        </select>
                    </div> --}}


                    <div class="form-group col-md-6" >

                        <label for="basicFlatpickr22">@lang('site.start_at')</label>

                        <input  type="date" id="{{ $row->id }}" name="start_at"  value="{{ $row->start_at }}" class="form-control" required>

                    </div>
                    <div class="form-group col-md-6" >

                    <div class="custom-file-container" data-upload-id="mySecondImage{{ $row->id }}">
                        <label style="display: block;">Upload (Allow Multiple) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                        <label class="custom-file-container__custom-file" >
                            <input type="file" name="files[]" class="custom-file-container__custom-file__custom-file-input" multiple>
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-12">

                    <label for="percent">@lang('site.description')</label>

                    <textarea  type="text" name="description"  class="form-control" required>{{ $row->description }}</textarea>

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
        var id ="{{$row->id}}";
        var f1 = flatpickr(document.getElementById(id));
        $(".basic4"+id).select2({
            tags: true,
            dropdownParent: $("#exampleModal"+id),
        });
        $(".basic5"+id).select2({
            tags: true,
            dropdownParent: $("#exampleModal"+id),
        });
        $(".basic6"+id).select2({
            tags: true,
            dropdownParent: $("#exampleModal"+id),
        });
        var secondUpload = new FileUploadWithPreview('mySecondImage'+id);
    </script>
@endpush
