<a  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$row->id}}">
   <i class="fa fa-eye"></i>
</a>

<div class="modal  fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$row->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="exampleModalLabel{{$row->id}}">
                    <span class="float-left"> @lang('site.date') : {{$row->date}} </span>
                    <span class="ml-5"> @lang('site.code') : {{$row->ref}}</span>
                </p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="fa fa-times"></i> </button>


            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>@lang('site.account')</th>
                                <th>@lang('site.credit')</th>
                                <th>@lang('site.debit')</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($row->items as $item)

                            <tr>
                                <td>{{ $lang == 'ar' ? $item->account->title_ar : $item->account->title_en }}</td>
                                <td>{{ $item->credit }}</td>
                                <td>{{ $item->debit }}</td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> @lang('site.closed')</button>
            </div> --}}
        </div>
    </div>
</div>
