<div class="form-row mb-4">
    <div class="form-group col-md-6">
        <label for="">{{$lang == 'ar' ? 'الاسم' : ' Name '}}</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', isset($row) ? $row->name : '')}}"  placeholder="{{$lang == 'ar' ? 'الاسم' : ' Name '}}" required>
    </div>
    <div class="form-group col-md-6">
        <label for="">{{$lang == 'ar' ? 'التليفون' : ' Phone '}}</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', isset($row) ? $row->phone : '')}}"  placeholder="{{$lang == 'ar' ? 'التليفون' : ' Phone '}}" >
    </div>
</div>
<div class="form-row mb-4">
    <div class="form-group col-md-6">
        <label for="inputEmail4">{{$lang == 'ar' ? ' البريد الالكتروني' : '  Email'}}</label>
        <input type="email" name="email" value="{{ old('email', isset($row) ? $row->email : '')}}" class="form-control" id="inputEmail4" placeholder="{{$lang == 'ar' ? ' البريد الالكتروني' : '  Email'}}" required>
    </div>
    <div class="form-group col-md-6">
        <label for="inputPassword4">{{$lang == 'ar' ? ' كلمة المرور' : ' Password '}}</label>
        <input type="password" name="password" value="" class="form-control" id="inputPassword4" placeholder="{{$lang == 'ar' ? ' كلمة المرور' : ' Password '}}">
    </div>


    <div class="form-group col-md-6">
        <label for="name">@lang('site.role')</label>

        <select class="form-control basic" name="role">
            @foreach ($roles as $role)
            <option value="{{ $role->id }}" {{isset($row) && $row->role_id == $role->id ? 'selected'  : ''}}>{{ $role->name }}</option>

        @endforeach

        </select>
    </div>
    <div class="form-group  col-md-6">
        <div class="form-check pl-0">
            <div class="custom-control custom-checkbox checkbox-info">
                <input type="checkbox" name="status" {{  isset($row) && $row->status == 1 ? 'checked'  : ''}} value="1" class="custom-control-input" id="gridCheck">
                <label class="custom-control-label" for="gridCheck">{{$lang == 'ar' ? ' فعال ' : ' Active '}}</label>
            </div>
        </div>
    </div>


</div>


<div class="row layout-top-spacing">

    <div id="fuSingleFile" class="col-lg-12 layout-spacing ">
        <div class="statbox">
            {{-- <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>{{$lang == 'ar' ? ' رفع صورة المستخدم' : ' Upload User Photo '}}</h4>
                    </div>
                </div>
            </div> --}}
            <div class="widget-content widget-content-area p-3" >
                <div class="custom-file-container" data-upload-id="myFirstImage">
                    <label>{{$lang == 'ar' ? '  رفع صورة المستخدم' : ' Upload User Photo'}} <a href="javascript:void(0)" class="custom-file-container__image-clear" title=" {{$lang == 'ar' ? '  حذف الصورة' : ' Clear Image'}}">x</a></label>
                    <label class="custom-file-container__custom-file" >
                        <input type="file"  name="photo" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                    </label>
                    @if (isset($row) && $row->photo != null)

                        <div class="custom-file-container__image-preview" >

                            <img width="70px" height="70px" src="{{asset('public/uploads/users/photos/'.$row->photo)}}">
                        </div>
                    @else
                        <div class="custom-file-container__image-preview"></div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>

