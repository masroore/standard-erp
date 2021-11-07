<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal{{$row->id}}" title="{{$lang == 'ar' ? ' تعديل' : ' Edit '}}">
    <i class="fa fa-pencil" aria-hidden="true"></i>
</button>

<div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$row->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel{{$row->id}}"> {{ $lang == 'ar' ? '  تعديل العلامة التجارية ' : 'Edit  Brand ' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ $lang == 'ar' ? ' اغلاق' : 'Close ' }}">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <form action="{{route('dashboard.stores.update', $row->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
            <div class="modal-body">
                <div class="form-group">
                    
                
                    <input  type="text" name="title_ar" value="{{$row->title_ar}}" class="form-control" required>
                
                </div>

                <div class="form-group">
                    
                
                    <input type="text" name="title_en" value="{{$row->title_en}}" class="form-control" required>
                
                </div>

              

                <div class="form-group">
                    
                    <input type="text" name="address" value="{{$row->address}}" placeholder="{{ $lang == 'ar' ? ' الرجاء ادخال العنوان' : 'Enter The Address' }}" class="form-control" >
                  
                </div>

                <div class="form-group">
                    
                    <input type="text" name="phone" value="{{$row->phone}}" placeholder="{{ $lang == 'ar' ? ' الرجاء ادخال رقم التليفون' : 'Enter phone' }}" class="form-control" >
                  
                </div>


                <div class="form-group">
                    
                    <select class="form-control basic" name="user_id">
                        <option  disabled selected>{{ $lang == 'ar' ? 'الرجاء اختيار امين المخزن' : 'Select Storekeeper' }} </option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}" {{ $row->user_id == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
                        @endforeach
                        
                    </select>
                </div>


                <div class="form-group">
                    <h5>{{ $lang == 'ar' ? ' الحالة' : 'Status' }}</h5>
                    <label class="switch s-icons s-outline  s-outline-success  mb-4 mr-2"> 
                        <input type="checkbox"  name="is_active" value="1" {{ $row->is_active == 1 ? 'checked' : '' }}>
                        <span class="slider">  </span>
                    </label>
                  
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
