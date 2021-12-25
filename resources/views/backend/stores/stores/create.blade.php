<div class="text-center">
    <button type="button" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#exampleModal">
        {{$lang == 'ar' ? 'اضافة جديد' : ' Add new'}}
    </button>
</div>

{{-- handel add new  --}}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> {{ $lang == 'ar' ? 'اضافة مخزن جديد' : 'Add New Store ' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ $lang == 'ar' ? ' اغلاق' : 'Close ' }}">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <form action="{{route('dashboard.stores.stores.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">


                    <div class="form-group">


                        <input  type="text" name="title_ar" placeholder="{{ $lang == 'ar' ? ' الرجاء ادخال الاسم باللغة العربية' : 'Enter Name in Arabic ' }}" class="form-control" required>

                    </div>

                    <div class="form-group">


                        <input type="text" name="title_en" placeholder="{{ $lang == 'ar' ? ' الرجاء ادخال الاسم باللغة الانجليزية' : 'Enter Name in English ' }}" class="form-control" required>

                    </div>

                    <div class="form-group">

                        <input type="text" name="address" placeholder="{{ $lang == 'ar' ? ' الرجاء ادخال العنوان' : 'Enter The Address' }}" class="form-control" >

                    </div>

                    <div class="form-group">

                        <input type="text" name="phone" placeholder="{{ $lang == 'ar' ? ' الرجاء ادخال رقم التليفون' : 'Enter phone' }}" class="form-control" >

                    </div>


                    <div class="form-group">

                        <select class="form-control basic" name="user_id">
                            <option  disabled selected>{{ $lang == 'ar' ? 'الرجاء اختيار امين المخزن' : 'Select Storekeeper' }} </option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach

                        </select>
                    </div>


                    <div class="form-group">
                        <h5>{{ $lang == 'ar' ? ' الحالة' : 'Status' }}</h5>
                        <label class="switch s-icons s-outline  s-outline-success  mb-4 mr-2">
                            <input type="checkbox" checked name="is_active" value="1">
                            <span class="slider">  </span>
                        </label>

                    </div>


                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> {{ $lang == 'ar' ? ' الغاء' : 'Cancel' }}</button>
                    <button type="submit" class="btn btn-primary">{{ $lang == 'ar' ? ' حفظ' : 'Save' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
