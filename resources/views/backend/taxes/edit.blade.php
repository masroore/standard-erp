<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal{{$row->id}}" title="{{$lang == 'ar' ? ' تعديل' : ' Edit '}}">
    <i class="fa fa-pencil" aria-hidden="true"></i>
</button>

<div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$row->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel{{$row->id}}"> @lang('site.edit_tax')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ $lang == 'ar' ? ' اغلاق' : 'Close ' }}">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <form action="{{route('dashboard.tax.update', $row->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
            <div class="modal-body">
                <div class="form-group">
                    <label for="percent">@lang('site.name')</label>
                    <input  type="text" name="name" value="{{$row->name}}" class="form-control" required>

                </div>

                <div class="form-group">
                    <label for="rate">@lang('site.rate') (%)</label>
                    <input type="text" name="rate" value="{{$row->rate}}" class="form-control" required>

                </div>



            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> {{ $lang == 'ar' ? ' الغاء' : 'Cancel' }}</button>
                <button type="submit" class="btn btn-warning">{{ $lang == 'ar' ? ' تعديل' : 'Update' }}</button>
            </div>
            </form>
        </div>
    </div>
</div>

