<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal{{$row->id}}" title="@lang('site.edit')">
    <i class="fa fa-pencil" aria-hidden="true"></i>
</button>

<div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$row->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel{{$row->id}}"> @lang('site.edit_purchase_operations')</h5>
                <button type="button" class="close" data-dismiss="modal" >
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <form action="{{route('dashboard.purchase-operations.update', $row->id)}}" name="brand{{ $row->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
            <div class="modal-body">


                <div class="form-group">

                    <label> @lang('site.code')</label>
                    <input  type="text" name="code" class="form-control" value="{{ $row->code }}">

                </div>

                <div class="form-group">
                    <label> @lang('site.start_at')</label>
                    <input type="text" id="basicFlatpickr{{ $row->id }}" name="start_at" value="{{ $row->start_at }}" class="form-control">
                </div>

                <div class="form-group">
                    <label> @lang('site.end_at')</label>
                    <input type="text" id="basicFlatpickr2{{ $row->id }}" name="end_at" value="{{ $row->end_at }}" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>@lang('site.cancel')</button>
                <button type="submit" class="btn valid btn-warning">@lang('site.update')</button>
            </div>
            </form>
        </div>
    </div>
</div>
