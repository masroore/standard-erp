<div class="form-row mb-4 widget-content widget-content-area p-3">
    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
        <h4>@lang('site.contact_info')</h4> <br>
    </div>

    <div class="form-group col-md-4">
        <label for="">@lang('site.name')</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', isset($row) ? $row->name : '')}}"  required>
    </div>
    <div class="form-group col-md-4">
        <label for="">@lang('site.company_name')</label>
        <input type="text" name="company_name" class="form-control" value="{{ old('company_name', isset($row) ? $row->company_name : '')}}"  required>
    </div>

    <div class="form-group col-md-4">
        <label for="">@lang('site.email')</label>
        <input type="email" name="email" value="{{ old('email', isset($row) ? $row->email : '')}}" class="form-control">
    </div>
    <div class="form-group col-md-4">
        <label for="">@lang('site.phone')</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', isset($row) ? $row->phone : '')}}" >
    </div>

    <div class="form-group col-md-4">
        <label for="">@lang('site.fax')</label>
        <input type="number" name="fax" class="form-control" value="{{ old('fax', isset($row) ? $row->fax : '')}}" >
    </div>





    <div class="form-group col-md-4">
        <label for="">@lang('site.address')</label>
        <input type="text" name="address" value="{{ old('address', isset($row) ? $row->address : '')}}" class="form-control" >
    </div>
    <div class="form-group col-md-4">
        <label for="">@lang('site.customer_group')</label>
        <select class="form-control nested select2" name="group_id" >
            @foreach ($CustomerGroup as $group)
                <option value="{{ $group->id }}" {{(isset($row) && $row->group_id == $group->id) ? 'selected' : ''}}>{{$group->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="">@lang('site.customer_group')</label>
        <select class="form-control nested select2" name="parent_id" >
            @foreach ($parentCompanies as $parent)
                <option value="{{ $parent->id }}" {{(isset($row) && $row->parent_id == $parent->id) ? 'selected' : ''}}>{{$parent->name}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row mb-4 widget-content widget-content-area p-3">

    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
        <h4>@lang('site.tax_info')</h4> <br>
    </div>



    <div class="form-group col-md-4">
        <label for="">@lang('site.tax')</label>
        <select class="form-control nested select2" name="tax_id" >
            @foreach ($taxes as $tax)
                <option value="{{ $tax->id }}" {{(isset($row) && $row->tax_id == $tax->id) ? 'selected' : ''}}>{{$tax->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="">@lang('site.tax_file_num')</label>
        <input type="text" name="tax_file_number" class="form-control" value="{{ old('tax_file_number', isset($row) ? $row->tax_file_number : '')}}"  required>
    </div>



    <div class="form-group col-md-2">
        <label for="">@lang('site.status')</label>
        <div class="form-check pl-0">
            <div class="custom-control custom-checkbox checkbox-info">

                <input type="checkbox" name="is_active" {{  isset($row) && $row->is_active == 1 ? 'checked'  : ''}} value="1" class="custom-control-input" id="gridCheck">
                <label class="custom-control-label" for="gridCheck">@lang('site.active')</label>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="widget-content widget-content-area p-3" >
            <div class="custom-file-container" data-upload-id="myFirstImage">
                <label>{{$lang == 'ar' ? '  رفع صورة للصنف' : ' Upload Item Photo'}} <a href="javascript:void(0)" class="custom-file-container__image-clear" title=" {{$lang == 'ar' ? '  حذف الصورة' : ' Clear Image'}}">x</a></label>
                <label class="custom-file-container__custom-file" >
                    <input type="file"  name="photo" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                </label>

                @if (isset($row) && $row->photo != null)

                <div class="custom-file-container__image-preview" >

                    <img width="70px" height="70px" src="{{asset($row->photo)}}">
                </div>
            @else
                <div class="custom-file-container__image-preview"></div>
            @endif


            </div>
        </div>
    </div>
</div>

@push('js')
<script type="text/javascript">
    $(".nested").select2({
        tags: true
    });
</script>
@endpush


