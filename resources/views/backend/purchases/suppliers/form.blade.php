<div class="form-row mb-4 widget-content widget-content-area p-3">
    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
        <h4>@lang('site.contact_info')</h4> <br>
    </div>

    <div class="form-group col-md-4">
        <label >@lang('site.company_name')</label>
        <input type="text" name="company_name" class="form-control" value="{{ old('company_name', isset($row) ? $row->company_name : '')}}"  required>
    </div>
    <div class="form-group col-md-4">
        <label >@lang('site.contact_person')</label>
        <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person', isset($row) ? $row->contact_person : '')}}"  required>
    </div>
    <div class="form-group col-md-4">
        <label >@lang('site.email')</label>
        <input type="email" name="email" value="{{ old('email', isset($row) ? $row->email : '')}}" class="form-control">
    </div>
    <div class="form-group col-md-4">
        <label >@lang('site.phone')</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', isset($row) ? $row->phone : '')}}" >
    </div>
    <div class="form-group col-md-4">
        <label >@lang('site.mobile')</label>
        <input type="text" name="mobile" class="form-control" value="{{ old('mobile', isset($row) ? $row->mobile : '')}}" >
    </div>
    <div class="form-group col-md-4">
        <label >@lang('site.fax')</label>
        <input type="text" name="fax" class="form-control" value="{{ old('fax', isset($row) ? $row->fax : '')}}" >
    </div>

    <div class="form-group col-md-4">
        <label >@lang('site.country')</label>
        <select class="form-control nested select2" name="country_code" >
            @foreach ($countries as $country)
                <option value="{{ $country->country_code }}">{{$lang == 'ar' ? $country->country_arName: $country->country_enName}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-4">
        <label >@lang('site.city')</label>
        <input type="text" name="city" value="{{ old('city', isset($row) ? $row->city : '')}}" class="form-control" >
    </div>

    <div class="form-group col-md-4">
        <label >@lang('site.address')</label>
        <input type="text" name="address" value="{{ old('address', isset($row) ? $row->address : '')}}" class="form-control" >
    </div>

</div>

<div class="form-row mb-4 widget-content widget-content-area p-3">

    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
        <h4>@lang('site.tax_info')</h4> <br>
    </div>

    <div class="form-group col-md-3">
        <label >@lang('site.tax_id')</label>
        <input type="text" name="tax_id" class="form-control" value="{{ old('tax_id', isset($row) ? $row->tax_id : '')}}"  required>
    </div>
    <div class="form-group col-md-3">
        <label >@lang('site.tax_file_num')</label>
        <input type="text" name="tax_file_number" class="form-control" value="{{ old('tax_file_number', isset($row) ? $row->tax_file_number : '')}}"  required>
    </div>
    <div class="form-group col-md-3">
        <label >@lang('site.cr_id')</label>
        <input type="text" name="cr_id" class="form-control" value="{{ old('cr_id', isset($row) ? $row->cr_id : '')}}"  required>
    </div>
    <div class="form-group col-md-3">
        <label >@lang('site.id_for_orginaztion')</label>
        <input type="text" name="id_for_orginaztion" class="form-control" value="{{ old('id_for_orginaztion', isset($row) ? $row->id_for_orginaztion : '')}}"  required>
    </div>

    <div class="form-group col-md-2">
        <label >@lang('site.status')</label>
        <div class="form-check pl-0">
            <div class="custom-control custom-checkbox checkbox-info">

                <input type="checkbox" name="is_active" {{  isset($row) && $row->is_active == 1 ? 'checked'  : ''}} value="1" class="custom-control-input" id="gridCheck">
                <label class="custom-control-label" for="gridCheck">@lang('site.active')</label>
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



