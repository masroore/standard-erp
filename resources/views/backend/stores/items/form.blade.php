<div class="row">
    <div class="col-md-8">
        <div class="row">



            <div class="form-group col-md-6">
                <label for="">{{ $lang == 'ar' ? ' الرجاء ادخال الاسم باللغة العربية' : 'Enter Name in Arabic ' }}</label>
                <input  type="text" name="title_ar" value="{{old('title_ar', isset($row) ? $row->title_ar : '')}}"  class="form-control" required>

            </div>

            <div class="form-group col-md-6">
                <label for="">{{ $lang == 'ar' ? ' الرجاء ادخال الاسم باللغة الانجليزية' : 'Enter Name in English ' }}</label>
                <input type="text" name="title_en"  value="{{old('title_en', isset($row) ? $row->title_en : '')}}" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <label for="">{{ $lang == 'ar' ? ' الرجاء اختيار التصنيف  ' : 'Select Category' }}</label>
                <select class="form-control basic select2" name="cat_id" >
                    <option disabled selected>{{$lang == 'ar' ? 'الرجاء اختيار التصنيف' : 'Select Category'}}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ isset($row) && $row->cat_id == $category->id ? 'selected'  : '' }}>{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                        @foreach ($category->childrenCategories as $childCategory)
                            @include('backend.stores.items.child_category', ['child_category' => $childCategory])
                        @endforeach
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="">{{ $lang == 'ar' ? ' الرجاء اختيار العلامة التجارية  ' : 'Select Brand' }}</label>
                <select class="form-control basic select2" name="brand_id" >
                    <option disabled selected>{{$lang == 'ar' ? 'بدون علامة تجارية' : 'Without Brand'}}</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{isset($row) && $row->brand_id == $brand->id  ? 'selected' : ''}} >{{$lang == 'ar' ? $brand->title_ar: $brand->title_en}}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="">{{ $lang == 'ar' ? ' الرجاء ادخال الباركود' : 'Enter Barcode' }}</label>
                <input type="text" name="barcode" value="{{old('barcode', isset($row) ? $row->barcode : '')}}" class="form-control" >
            </div>
            <div class="form-group col-md-6">
                <label for="">@lang('site.select_unit')</label>
                <select class="form-control basic select2" name="unit_id" id="units">
                    <option disabled selected>@lang('site.select_unit')</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}" {{isset($row) && $row->unit_id == $unit->id  ? 'selected' : ''}} >{{$unit->unit_name}}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="">@lang('site.select_purchase_unit')</label>
                <select class="form-control basic select2 unit-child" name="purchase_unit_id">

                    <option disabled selected>@lang('site.select_unit')</option>

                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="">@lang('site.select_sale_unit')</label>
                <select class="form-control basic select2 unit-child" name="sale_unit_id" >
                    <option disabled selected>@lang('site.select_unit')</option>

                </select>
            </div>


            {{-- <div class="form-group col-md-6">
                <label for="">{{ $lang == 'ar' ? ' الرجاء اختيار  الباركود  ' : 'Select barcode' }}</label>
                <select name="barcode_symbology"  class="form-control basic">
                    <option value="C128" {{isset($row) && $row->barcode_symbology == 'C128'  ? 'selected' : ''}}>Code 128</option>
                    <option value="C39"  {{isset($row) && $row->barcode_symbology == 'C39'  ? 'selected' : ''}}>Code 39</option>
                    <option value="UPCA" {{isset($row) && $row->barcode_symbology == 'UPCA'  ? 'selected' : ''}}>UPC-A</option>
                    <option value="UPCE" {{isset($row) && $row->barcode_symbology == 'UPCE'  ? 'selected' : ''}}>UPC-E</option>
                    <option value="EAN8" {{isset($row) && $row->barcode_symbology == 'EAN8'  ? 'selected' : ''}}>EAN-8</option>
                    <option value="EAN13" {{isset($row) && $row->barcode_symbology == 'EAN13'  ? 'selected' : ''}}>EAN-13</option>
                </select>
            </div> --}}



            <div class="form-group col-md-6">
                <label for="">{{ $lang == 'ar' ? ' الرجاء سعر البيع' : 'Enter Sale Price' }}</label>
                <input type="number" name="sale_price" value="{{old('sale_price', isset($row) ? $row->sale_price : '')}}" class="form-control" >
            </div>
            <div class="form-group col-md-6">
                <label for="">{{ $lang == 'ar' ? ' الرجاء سعر التكلفة' : 'Enter Cost Price' }}</label>
                <input type="number" name="cost"  value="{{old('cost', isset($row) ? $row->cost : '')}}" class="form-control" >
            </div>

            <div class="form-group col-md-6">
                <label for="">{{ $lang == 'ar' ? ' الرجاء ادخال كميات تنبيه نقص المخزون' : 'Enter Alert Quantity ' }}</label>
                <input type="number" name="alert_quantity" value="{{old('alert_quantity', isset($row) ? $row->alert_quantity : '')}}" class="form-control" >
            </div>

            <div class="form-group col-md-6">
                <label for="">{{ $lang == 'ar' ? ' الرجاء ادخال كود الصنف  ' : 'Enter Item Code ' }}</label>
                <div class="input-group">
                    <input  type="text" name="code" value="{{old('code', isset($row) ? $row->code : '')}}" class="form-control" id="code" aria-describedby="code" required>
                    <div class="input-group-append">
                        <button id="genbutton" type="button" class="btn btn-sm btn-default" title="{{ $lang == 'ar' ? 'انشاء اتوماتيك' : 'Genrate Code' }}"><i class="fa fa-refresh"></i></button>
                    </div>
                </div>
                <span class="validation-msg" id="code-error"></span>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ $lang == 'ar' ? ' الضريبة ' : 'Tax ' }}</strong> </label>
                    <select name="tax_id" class="form-control selectpicker">
                        <option value="0" {{isset($row) && $row->tax_id == 0  ? 'selected' : ''}}>No Tax</option>
                        <option value="10" {{isset($row) && $row->tax_id == 10  ? 'selected' : ''}}>@10%</option>
                        <option value="14" {{isset($row) && $row->tax_id == 14  ? 'selected' : ''}}>@14%</option>

                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ $lang == 'ar' ? 'نوع الضريبة ' : 'Tax Method' }}</strong> </label> <i class="dripicons-question" data-toggle="tooltip" title="{{trans('file.Exclusive: Poduct price = Actual product price + Tax. Inclusive: Actual product price = Product price - Tax')}}"></i>
                    <select name="tax_method" class="form-control selectpicker">
                        <option value="1" {{isset($row) && $row->tax_method == 1  ? 'selected' : ''}}>  {{ $lang == 'ar' ? 'غير شامل الضريبة ' : 'Exclusive' }}</option>
                        <option value="2" {{isset($row) && $row->tax_method == 2 ? 'selected' : ''}}> {{ $lang == 'ar' ? ' شامل الضريبة ' : 'Inclusive' }}</option>
                    </select>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="widget-content widget-content-area p-3" >
                    <div class="custom-file-container" data-upload-id="myFirstImage">
                        <label>{{$lang == 'ar' ? '  رفع صورة للصنف' : ' Upload Item Photo'}} <a href="javascript:void(0)" class="custom-file-container__image-clear" title=" {{$lang == 'ar' ? '  حذف الصورة' : ' Clear Image'}}">x</a></label>
                        <label class="custom-file-container__custom-file" >
                            <input type="file"  name="photo" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>

                        @if (isset($row) && $row->image != null)

                        <div class="custom-file-container__image-preview" >

                            <img width="70px" height="70px" src="{{asset('public/uploads/stores/items/images/'.$row->image)}}">
                        </div>
                    @else
                        <div class="custom-file-container__image-preview"></div>
                    @endif


                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group p-3">
                    <label for="exampleFormControlTextarea1">{{$lang == 'ar' ? '  ادخال وصف الصنف ' : ' Enter Item Description'}}</label>
                    <textarea class="form-control" name="description" value="{{old('description', isset($row) ? $row->description : '')}}" id="exampleFormControlTextarea1" rows="5">
                       {{old('description', isset($row) ? $row->description : '')}}
                    </textarea>
                </div>
            </div>

        </div>
    </div>
</div>


@push('js')

<script>
    //First upload
    var firstUpload = new FileUploadWithPreview('myFirstImage')
    //Second upload
    var secondUpload = new FileUploadWithPreview('mySecondImage')

    $('#genbutton').on("click", function(){
      $.get('gencode', function(data){
        $("input[name='code']").val(data);
      });
    });

</script>

<!-- ajax -->

<script type="text/javascript">
    $("#units").change(function(){
        $.ajax({
            url: "{{ route('dashboard.unitschaild') }}?unit_id=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                $('.unit-child').html(data.html);
            }
        });
    });
</script>


@endpush
