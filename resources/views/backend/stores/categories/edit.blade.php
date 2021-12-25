
<button type="button" class="btn btn-warning changesModal" data-toggle="modal" data-target="#exampleModal_{{$row->id}}" title="{{$lang == 'ar' ? ' تعديل' : ' Edit '}}">
    <i class="fa fa-pencil" aria-hidden="true"></i>
</button>

<div class="modal fade" id="exampleModal_{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$row->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel{{$row->id}}"> {{ $lang == 'ar' ? '  تعديل العلامة التجارية ' : 'Edit  Brand ' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ $lang == 'ar' ? ' اغلاق' : 'Close ' }}">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <form action="{{ route('dashboard.stores.categories.update',$row->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body">

                    <div class="form-group">
                        <select class="form-control nested select2" name="parent_id" >
                            <option value="0" {{ $row->parent_id == 0 ? 'selected'  : '' }} >{{$lang == 'ar' ? 'تصنيف رئيسي' : 'No Parent'}}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $row->parent_id == $category->id ? 'selected'  : '' }}>{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                                @foreach ($category->childrenCategories as $childCategory)
                                    @include('backend.stores.categories.child_category', ['child_category' => $childCategory])
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <input  type="text" name="title_ar" value="{{ $row->title_ar }}" class="form-control" required>

                    </div>

                    <div class="form-group">
                        <input type="text" name="title_en" value="{{ $row->title_en }}" class="form-control" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> @lang('site.cancel')</button>
                    <button type="submit" class="btn btn-warning">@lang('site.update')</button>
                </div>

            </form>


        </div>
    </div>
</div>



@push('js')

<script type="text/javascript">
    $(document).on('click','.changesModal',function(){

        id_arr          = $(this).attr('data-target');

        id              = id_arr.split("_");
        console.log(id);

        $(".nested").select2({
            tags: true,
            dropdownParent: $("#exampleModal_"+id[1]),
        });

    });
</script>


@endpush







