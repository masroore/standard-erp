<div class="modal fade bd-example-modal-lg" id="bd-example-modal-lg{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel{{$row->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel{{$row->id}}">{{$lang == 'ar' ? 'عرض بيانات الصنف' :  'show Item Details'}}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>

            </div>
            <div class="modal-body" id="printModel{{$row->id}}">
              <div class="row">
                    <div class="col-md-8">

                        <div class="row">
                          <div class="col-md-5">{{$lang == 'ar' ? 'الكود' : ' Code '}}</div>
                          <div class="col-md-2"> : </div>
                          <div class="col-md-5">{{$row->code}}</div>
                        </div>
                          <hr>
                        <div class="row">
                          <div class="col-md-5">{{$lang == 'ar' ? 'اسم الصنف  ' : ' Item Name  '}}</div>
                          <div class="col-md-2"> : </div>
                          <div class="col-md-5">
                              {{-- {{$row->title_ar}} <br> --}}
                            {{$row->title_en}}</div>
                        </div>
                        <hr>

                        <div class="row">
                          <div class="col-md-5">{{$lang == 'ar' ? 'التصنيف' : 'Category '}}</div>
                          <div class="col-md-2"> : </div>
                          <div class="col-md-5">
                              @if ($row->cat_id != null)
                                 {{-- {{$row->category->title_ar }} <br> --}}
                                {{$row->category->title_en }}
                                @else
                                -------
                              @endif

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-md-5">{{$lang == 'ar' ? 'العلامة التجارية' : 'Brand '}}</div>
                          <div class="col-md-2"> : </div>
                          @if ($row->brand_id != null)
                          <div class="col-md-5">
                              {{-- {{$row->brand->title_ar }} <br> --}}
                              {{$row->brand->title_en }}</div>
                          @else
                          <div class="col-md-5">____</div>
                          @endif

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-5">{{$lang == 'ar' ? ' سعر التكلفة  ' : '  Cost Price  '}}</div>
                            <div class="col-md-2"> : </div>
                            <div class="col-md-5">{{$row->cost}} </div>
                        </div>
                          <hr>
                        <div class="row">
                            <div class="col-md-5">{{$lang == 'ar' ? ' سعر البيع  ' : '  Sale Price  '}}</div>
                            <div class="col-md-2"> : </div>
                            <div class="col-md-5">{{$row->sale_price}} </div>
                        </div>
                          <hr>
                        <div class="row">
                            <div class="col-md-5">{{$lang == 'ar' ? ' كمية تنبيه نقص المخزون ' : ' Alert Quantity '}}</div>
                            <div class="col-md-2"> : </div>
                            <div class="col-md-5">{{$row->alert_quantity}} </div>
                        </div>
                          <hr>
                        <div class="row">
                            <div class="col-md-5">{{$lang == 'ar' ? ' تم الانشاء بواسطة' : ' Created By '}}</div>
                            <div class="col-md-2"> : </div>
                            <div class="col-md-5">{{$row->user->name}} </div>
                        </div>
                          <hr>

                        <div class="row">
                            <div class="col-md-5">{{$lang == 'ar' ? 'الضريبة' : '  Tax '}}</div>
                            <div class="col-md-2"> : </div>
                            <div class="col-md-5">{{  $row->tax_id }} %</div>
                        </div>
                          <hr>

                        <div class="row">
                            <div class="col-md-5">{{$lang == 'ar' ? 'نوع الضريبة' : '  Tax Method '}}</div>
                            <div class="col-md-2"> : </div>
                            <div class="col-md-5">
                                @if ($row->tax_method == 1)
                                {{ $lang == 'ar' ? 'غير شامل الضريبة ' : 'Exclusive' }}
                                @elseif($row->tax_method == 2)
                                {{ $lang == 'ar' ? ' شامل الضريبة ' : 'Inclusive' }}
                                @endif
                            </div>
                        </div>
                          <hr>
                    </div>
                  <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 border border-info mt-5">
                            @if($row->image != null)
                            <img alt="avatar" class="img-fluid rounded-circle" src="{{asset('public/uploads/stores/items/images/'. $row->image )}}">
                            @else
                            <img alt="avatar" class="img-fluid rounded-circle" src="{{asset('public/uploads/stores/items/product.png')}}">
                            @endif

                        </div>

                        <div class="col-md-12 mt-4">
                            <label class="border-bottom" >{{$lang == 'ar' ? 'الوصف ' :  'Description'}} </label>

                            <p> {{$row->description}}</p>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">

                <button class="btn" data-dismiss="modal"> {{$lang == 'ar' ? 'اغلاق  ' :  'Close'}}</button>
                <button class="btn btn-info" onclick="printDiv()"> {{$lang == 'ar' ? 'طباعة  ' :  'Print'}}</button>
            </div>
        </div>

    </div>
</div>

@push('js')

<script type="text/javascript">
  function printDiv() {
      var printContents = document.getElementById('printModel{{$row->id}}').innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
      location.reload();
  }

</script>

@endpush
