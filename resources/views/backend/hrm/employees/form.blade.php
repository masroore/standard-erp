
<div class="row">
    <div class="form-row mb-4 col-md-6">
        <div class="form-group col-md-12">
            <label for="">@lang('site.name')</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', isset($row) ? $row->name : '')}}"  placeholder="@lang('site.name')" required>
        </div>
        <div class="form-group col-md-12">
            <label for="email">@lang('site.email')</label>
            <input type="email" name="email" value="{{ old('email', isset($row) ? $row->email : '')}}" class="form-control" id="email" placeholder="@lang('site.email')" required>
        </div>
        <div class="form-group col-md-12">
            <label for="">@lang('site.phone')</label>
            <input type="number" name="phone" class="form-control" value="{{ old('phone', isset($row) ? $row->phone : '')}}"  placeholder="@lang('site.phone')" >
        </div>

        <div class="form-group col-md-12">
            <label for="">@lang('site.address')</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', isset($row) ? $row->address : '')}}"  placeholder="@lang('site.address')" >
        </div>

        <div class="form-group col-md-12">
            <label for="date">@lang('site.birthday')</label>
            <input type="text" class="form-control form-control-sm flatpickr-input" value="{{ old('birthday', isset($row) ? $row->birthday : '')}}" name="birthday" id="date" placeholder="Add date picker" readonly="readonly">
        </div>
        <div class="form-group col-md-12">
            <label for="date">@lang('site.date_of_joining')</label>
            <input id="basicFlatpickr" name="date_of_joining" value="{{ old('date_of_joining', isset($row) ? $row->date_of_joining : '')}}" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date.." readonly="readonly">
        </div>
        <div class="form-group col-md-12">
            <label for="name">@lang('site.department')</label>

            <select class="form-control basic" name="department_id">
                @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{isset($row) && $row->department_id == $department->id ? 'selected'  : ''}}>{{$lang == 'ar' ?$department->name_ar : $department->name_en}}</option>

                @endforeach

            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="gender" class="form-control-label">@lang('site.gender')</label><span class="text-danger pl-1">*</span>
            <div class="d-flex radio-check">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="g_male" value="male" name="gender"  {{isset($row) && $row->gender == 'male' ? 'checked'  : ''}} class="custom-control-input">
                    <label class="custom-control-label" for="g_male">@lang('site.male')</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="g_female" value="female" name="gender" {{isset($row) && $row->gender == 'female' ? 'checked'  : ''}}  class="custom-control-input">
                    <label class="custom-control-label" for="g_female">@lang('site.female')</label>
                </div>
            </div>
        </div>
        <div class="form-group  col-md-6">
            <label for="gender" class="form-control-label"></label><span class="text-danger pl-1"></span>

            <div class="form-check pl-0">
                <div class="custom-control custom-checkbox checkbox-info">
                    <input type="checkbox" name="status" {{  isset($row) && $row->status == 1 ? 'checked'  : ''}} value="1" class="custom-control-input" id="gridCheck">
                    <label class="custom-control-label" for="gridCheck">@lang('site.active')</label>
                </div>
            </div>
        </div>

    </div>



    <div class="form-row mb-4 col-md-6">
        <div class="form-group  col-md-12">
            <div class="form-check pl-0">
                <div class="custom-control custom-checkbox checkbox-info" id="checkboxeUser">
                    <input type="checkbox"  name="add_user" {{  isset($row) && $row->user_id > 0 ? 'checked'  : ''}} value="1" class="custom-control-input" id="add_user">
                    <label class="custom-control-label" for="add_user">@lang('site.add_user')</label>
                </div>
            </div>
        </div>


        <div class="row " id="isChecked" style="{{  isset($row) && $row->user_id > 0 ? ''  : 'display: none'}};">
            <div class="form-group col-md-12">
                <label for="email2">{{$lang == 'ar' ? ' البريد الالكتروني' : '  Email'}}</label>
                <input type="email"  name="email_user" readonly value="{{ old('email_user', isset($row) ? $row->email_user : '')}}" class="form-control" id="email2" placeholder="{{$lang == 'ar' ? ' البريد الالكتروني' : '  Email'}}" >
            </div>

            <div class="form-group col-md-12">
                <label for="inputPassword4">{{$lang == 'ar' ? ' كلمة المرور' : ' Password '}}</label>
                <input type="password"  name="password" value="" class="form-control" id="inputPassword4" placeholder="{{$lang == 'ar' ? ' كلمة المرور' : ' Password '}}">
            </div>

            <input type="hidden" name="role" value=""3>

        </div>


        <div class="form-group col-md-12">

            <div class="widget-content widget-content-area p-3" >
                <div class="custom-file-container" data-upload-id="myFirstImage">
                    <label>{{$lang == 'ar' ? '  رفع صورة المستخدم' : ' Upload User Photo'}} <a href="javascript:void(0)" class="custom-file-container__image-clear" title=" {{$lang == 'ar' ? '  حذف الصورة' : ' Clear Image'}}">x</a></label>
                    <label class="custom-file-container__custom-file" >
                        <input type="file"  name="photo" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                    </label>
                    @if (isset($row) && $row->photo != null)

                        <div class="custom-file-container__image-preview" >

                            <img width="70px" height="70px" src="{{asset('public/'.$row->photo)}}">
                        </div>
                    @else
                        <div class="custom-file-container__image-preview"></div>
                    @endif


                </div>
            </div>
        </div>


    </div>
</div>


@push('js')

<script>
    $("#email").keyup(function(){
        $('#email2').val($(this).val());
    });
</script>
<script src="{{asset('public/backend/crock/assets/js/apps/add_purchase.js') }}"></script>

@endpush





