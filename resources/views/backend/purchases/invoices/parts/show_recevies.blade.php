<div class="widget-content widget-content-area p-3"
    style="overflow-y: scroll;position: absolute; z-index: 9000000;">

    <i class="fa fa-times mb-3 btn-danger p-1 close-receives" style="cursor: pointer"></i>
    @if (isset($receivesData) && $receivesData->count() > 0)

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
            <thead>
                <tr>
                    <th class="checkbox-column">
                        <div class="custom-control custom-checkbox checkbox-primary">
                            <input type="checkbox" class="custom-control-input todochkbox" id="record__select-all">
                            <label class="custom-control-label" for="record__select-all"></label>
                        </div>
                    </th>
                    <th>@lang('site.code')</th>
                    <th>@lang('site.date')</th>
                    <th>@lang('site.item_count')</th>
                    <th>@lang('site.items')</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($receivesData as $data )

                <tr>
                    <td class="checkbox-column">
                        <div class="custom-control custom-checkbox checkbox-primary">
                            <input type="checkbox" name="record_select" value="{{ $data->id }}" class="custom-control-input todochkbox record__select" id="todo-{{ $data->id }}">
                            <label class="custom-control-label" for="todo-{{ $data->id }}"></label>
                        </div>
                    </td>
                    <td>{{ $data->reference_no }}</td>
                    <td>{{ $data->date }}</td>
                    <td>{{ $data->items_count }}</td>
                    <td>
                        <a type="button" class="" data-toggle="modal" data-target="#exampleModal{{ $data->id }}">
                            <i class="fa text-success fa-lg fa-eye" title="@lang('site.items')"></i>
                        </a>
                        <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $data->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel{{ $data->id }}">@lang('site.products')</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped mb-4">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>@lang('site.item')</th>
                                                        <th>@lang('site.unit')</th>
                                                        <th>@lang('site.qty')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data->items as $ite )


                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $ite->item->title_en}}</td>
                                                        <td>{{ $ite->unit->unit_name}}</td>
                                                        <td>{{ $ite->qunatity}}</td>
                                                    </tr>

                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-danger" data-dismiss="modal">
                                            <i class="flaticon-cancel-12"></i> <strong> X </strong></button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                </tr>

                @endforeach

            </tbody>
        </table>
    </div>

    <form method="get" action="" style="display: inline-block;">

        <input type="hidden" name="record_ids" id="record-ids">
        <button  class="btn btn-danger" id="bulk-select" disabled="true"> @lang('site.import_receives')</button>
    </form><!-- end of form -->


    @elseif($receivesData->count() == 0)
    <div class="alert alert-light-danger border-0 mb-4" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <strong>@lang('site.opps')!</strong>@lang('site.no_items_matched') </div>
    @endif



</div>


