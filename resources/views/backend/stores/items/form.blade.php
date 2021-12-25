<div class="row">
    <div class="col-md-7">
        <div class="row">

            <div class="col-md-8">
                <div class="form-group">
                    <label>@lang('site.item_type') </label>
                    <select id="type" class="form-control basic"  name="item_type" >
                        <option  value="standard"   {{isset($row) && $row->item_type  == 'standard'   ? 'selected' : ''}}>@lang('site.standard')</option>
                        <option  value="service"    {{isset($row) && $row->item_type  == 'service'    ? 'selected' : ''}}>@lang('site.service')</option>
                        <option  value="collection" {{isset($row) && $row->item_type  == 'collection' ? 'selected' : ''}}>@lang('site.project')</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-md-3  text-center">
                <div class="n-chk mt-5">
                    <label class="new-control new-checkbox checkbox-primary">
                    <input name="is_active" type="checkbox" class="new-control-input" checked>
                    <span class="new-control-indicator"></span>@lang('site.is_active')
                    </label>
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="">@lang('site.title_en')</label>
                <input type="text" name="title_en"  value="{{old('title_en', isset($row) ? $row->title_en : '')}}" class="form-control " required>
            </div>

            {{-- <div class="form-group col-md-6">
                <label for="">@lang('site.title_ar')</label>
                <input  type="text" name="title_ar" value="{{old('title_ar', isset($row) ? $row->title_ar : '')}}"  class="form-control " required>

            </div> --}}



            <div class="form-group col-md-6">
                <label for="">@lang('site.category')</label>
                <select class="form-control  basic select2" name="cat_id" >

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ isset($row) && $row->cat_id == $category->id ? 'selected'  : '' }}>{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                        @foreach ($category->childrenCategories as $childCategory)
                            @include('backend.stores.items.child_category', ['child_category' => $childCategory])
                        @endforeach
                    @endforeach
                </select>
            </div>



            <div class="form-group col-md-6 hide-in-service">
                <label for="">@lang('site.brand')</label>
                <select class="form-control  basic select2" name="brand_id" >
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{isset($row) && $row->brand_id == $brand->id  ? 'selected' : ''}} >{{$lang == 'ar' ? $brand->title_ar: $brand->title_en}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6 hide-in-service">
                <label for="">@lang('site.barcode')</label>
                <input type="text" name="barcode" value="{{old('barcode', isset($row) ? $row->barcode : '0')}}" class="form-control " >
            </div>

            <div class="form-group col-md-6">
                <label for="">@lang('site.code')</label>
                <div class="input-group">
                    <input  type="text" name="code" value="{{old('code', isset($row) ? $row->code : '')}}" class="form-control " id="code" aria-describedby="code">
                    <div class="input-group-append">
                        <button id="genbutton" type="button" class="btn btn-sm btn-default" title="{{ $lang == 'ar' ? 'انشاء اتوماتيك' : 'Genrate Code' }}"><i class="fa fa-refresh"></i></button>
                    </div>
                </div>
                <span class="validation-msg" id="code-error"></span>
            </div>

             {{-- collection product --}}

            <div class="col-md-12 show-in-collection mb-5">
                {{-- items details collection  --}}
                <label> @lang('site.select item for new projct')</label>
               <div class="invoice-detail-items">

                   <div class="table-responsive">
                       <table class="table table-bordered item-table-search">
                           <thead>
                               <tr>

                                   <th ></th>
                                   <th width="50%">@lang('site.item')</th>
                                   <th width="22%">@lang('site.price')</th>
                                   <th width="22%">@lang('site.qty')</th>

                               </tr>
                           </thead>
                           <tbody>
                               @if(isset ($row) && $row->item_type == 'collection')
                               @foreach ($row->collectionProduct as $collection )
                                <tr>
                                    <td class="delete-item-row">
                                        <ul class="table-controls">
                                            <li><a href="javascript:void(0);" class="delete-item"
                                                data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle>
                                                <line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15">
                                                </line></svg></a></li>
                                        </ul>
                                    </td>

                                    <td class="description">
                                        <input  type="hidden" id="item_1"  value="{{ $collection->item_id }}" name="item_id[]" class=" form-control form-control-sm search item_id1" placeholder="@lang('site.item')" autocomplete="off">
                                        <input type="text" id="1" value="{{ $collection->items->title_en }}" class="form-control form-control-sm search title1" placeholder="@lang('site.item')" autocomplete="off">
                                        <div class="content-search1"> </div>
                                    </td>

                                    <td class="description">
                                        <input type="number" id="price_1" value="{{ $collection->price }}"   name="price[]"   class="form-control sale_price1 changesNo" placeholder="0.00">
                                    </td>

                                    <td class="description">
                                        <input type="number"  id="quantity_1" name="qty[]" value="{{ $collection->qty }}" class="form-control form-control-sm qty1 calculat changesNo"  placeholder="@lang('site.qty')">
                                    </td>


                                </tr>
                               @endforeach
                               @else
                               <tr>
                                <td class="delete-item-row">
                                    <ul class="table-controls">
                                        <li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>
                                    </ul>
                                </td>

                                <td class="description">
                                    <input  type="hidden" id="item_1"   name="item_id[]" class=" form-control form-control-sm search item_id1" placeholder="@lang('site.item')" autocomplete="off">
                                    <input type="text" id="1" class="form-control form-control-sm search title1" placeholder="@lang('site.item')" autocomplete="off">
                                    <div class="content-search1"> </div>
                                </td>

                                <td class="description">
                                    <input type="number" id="price_1"    name="price[]"   class="form-control sale_price1 changesNo" placeholder="0.00">
                                </td>

                                <td class="description">
                                    <input type="number"  id="quantity_1" name="qty[]" class="form-control form-control-sm qty1 calculat changesNo"  placeholder="@lang('site.qty')">
                                </td>


                                </tr>
                               @endif


                           </tbody>
                       </table>
                   </div>

                   <button class="btn btn-info additemcollect btn-sm" id="1">@lang('site.add_item')</button>

               </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>@lang('site.tax') </label>
                    <select id="" class="form-control  form-control"  name="tax_id" >
                        <option  value="0">@lang('site.no')</option>
                        @foreach ($taxes as $tax)
                        <option value="{{ $tax->rate }}" {{isset($row) && $row->tax_id == $tax->rate  ? 'selected' : ''}}>{{$tax->name . '('.$tax->rate .'%)'}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group col-md-6 hide-in-service">
                <label for="">@lang('site.select_unit')</label>
                <select class="form-control  basic select2" name="unit_id" id="units">
                    <option disabled selected>@lang('site.select_unit')</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}" {{isset($row) && $row->unit_id != null  && $row->unit_id == $unit->id  ? 'selected' : ''}} >{{$unit->unit_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6 hide-in-service">
                <label for="">@lang('site.select_purchase_unit')</label>
                <select class="form-control  basic select2 unit-child" name="purchase_unit_id">
                    @if(isset($row))
                    <option value="{{ $unit->id }}" selected>{{ isset($row) && $row->unit_id != null ? $row->purchUnit->unit_name : ''}}</option>
                    @else
                    <option disabled selected>@lang('site.select_unit')</option>
                    @endif

                </select>
            </div>

            <div class="form-group col-md-6 hide-in-service">
                <label for="">@lang('site.select_sale_unit')</label>
                <select class="form-control  basic select2 unit-child" name="sale_unit_id" >
                    @if(isset($row))
                    <option value="{{ $unit->id }}" selected>{{ isset($row) && $row->unit_id != null ? $row->saleUnit->unit_name : ''}}</option>
                    @else
                    <option disabled selected>@lang('site.select_unit')</option>
                    @endif
                </select>
            </div>


            {{-- <div class="form-group col-md-6">
                <label for="">{{ $lang == 'ar' ? ' الرجاء اختيار  الباركود  ' : 'Select barcode' }}</label>
                <select name="barcode_symbology"  class="form-control  basic">
                    <option value="C128" {{isset($row) && $row->barcode_symbology == 'C128'  ? 'selected' : ''}}>Code 128</option>
                    <option value="C39"  {{isset($row) && $row->barcode_symbology == 'C39'  ? 'selected' : ''}}>Code 39</option>
                    <option value="UPCA" {{isset($row) && $row->barcode_symbology == 'UPCA'  ? 'selected' : ''}}>UPC-A</option>
                    <option value="UPCE" {{isset($row) && $row->barcode_symbology == 'UPCE'  ? 'selected' : ''}}>UPC-E</option>
                    <option value="EAN8" {{isset($row) && $row->barcode_symbology == 'EAN8'  ? 'selected' : ''}}>EAN-8</option>
                    <option value="EAN13" {{isset($row) && $row->barcode_symbology == 'EAN13'  ? 'selected' : ''}}>EAN-13</option>
                </select>
            </div> --}}



            <div class="form-group col-md-6">
                <label for="">@lang('site.sale_price')</label>
                <input type="number" name="sale_price" value="{{old('sale_price', isset($row) ? $row->sale_price : '0')}}" class="form-control " >
            </div>
            <div class="form-group col-md-6">
                <label for="">@lang('site.cost')</label>
                <input type="number" name="cost"  value="{{old('cost', isset($row) ? $row->cost : '0')}}" class="form-control " >
            </div>

            <div class="form-group col-md-6 hide-in-service">
                <label for="">@lang('site.alert_qty')</label>
                <input type="number" name="alert_quantity" value="{{old('alert_quantity', isset($row) ? $row->alert_quantity : '1')}}" class="form-control " >
            </div>

            <div class="col-md-6 hide-in-service">
                <div class="form-group">
                    <label>@lang('site.made_in')</label>
                    <select id="made_in" class="form-control basic"  name="made_in" >
                        <option  value="0">@lang('site.no')</option>
                        @foreach ($countries as $country)
                        <option value="{{ $country->country_code }}" {{isset($row) && $row->made_in == $country->country_code ? 'selected' : ''}}>{{ $lang == 'ar' ? $country->country_arName : $country->country_enName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group col-md-6 hide-in-service">
                <label for="">@lang('site.weight')</label>
                <input type="text" name="weight" value="{{old('weight', isset($row) ? $row->weight: '')}}" class="form-control " >
            </div>

            <div class="form-group col-md-6 hide-in-service">
                <label for="">@lang('site.height')</label>
                <input type="text" name="height" value="{{old('height', isset($row) ? $row->height : '')}}" class="form-control " >
            </div>

            <div class="form-group col-md-6 hide-in-service">
                <label for="">@lang('site.width')</label>
                <input type="text" name="width" value="{{old('width', isset($row) ? $row->width : '')}}" class="form-control " >
            </div>

            <div class="form-group col-md-6 hide-in-service">
                <label for="">@lang('site.lenght')</label>
                <input type="text" name="lenght" value="{{old('lenght', isset($row) ? $row->lenght: '')}}" class="form-control " >
            </div>

            <div class="form-group col-md-6">
                <label for="">@lang('site.discount_group')</label>
                <input type="text" name="discount_group" value="{{old('discount_group', isset($row) ? $row->discount_group : '')}}" class="form-control " >
            </div>

            {{-- <div class="col-md-6">
                <div class="form-group">
                    <label>{{ $lang == 'ar' ? 'نوع الضريبة ' : 'Tax Method' }} </label> <i class="dripicons-question" data-toggle="tooltip" title="{{trans('file.Exclusive: Poduct price = Actual product price + Tax. Inclusive: Actual product price = Product price - Tax')}}"></i>
                    <select name="tax_method" class="form-control  selectpicker">
                        <option value="1" {{isset($row) && $row->tax_method == 1  ? 'selected' : ''}}>  {{ $lang == 'ar' ? 'مبيعات ' : 'sales' }}</option>
                        <option value="2" {{isset($row) && $row->tax_method == 2 ? 'selected' : ''}}> {{ $lang == 'ar' ? ' جدول' : 'sechdule' }}</option>
                    </select>
                </div>
            </div> --}}

        </div>

    </div>

    <div class="col-md-5">
        <div class="row">
            <div class="col-md-12">
                <div class="widget-content widget-content-area p-3" >
                    <div class="custom-file-container" data-upload-id="myFirstImage">
                        <label>@lang('site.upload_image')<a href="javascript:void(0)" class="custom-file-container__image-clear" title="@lang('site.cancel')">x</a></label>
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

            <div class="col-md-12 mt-3">
                <div class="form-group">
                    <label>@lang('site.description')</label>
                    <textarea class="form-control" name="description" value="{{old('description', isset($row) ? $row->description : '')}}"  rows="5">
                       {{old('description', isset($row) ? $row->description : '')}}
                    </textarea>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>@lang('site.tags')</label>
                    <select  class="form-control tagging" multiple="multiple"  name="tags[]" >
                        @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}"  {{ in_array( $tag->id, $selectedTags) ? 'selected' : '' }}>{{  $tag->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-md-12 hide-in-service">
                <div class="n-chk mt-1">
                    <label class="new-control new-checkbox checkbox-primary">
                    <input type="checkbox" class="new-control-input checkbox_check" name="product_place" id="showplace">
                    <span class="new-control-indicator"></span>@lang('site.define_places_in_stores')
                    </label>
                </div>

                <div class="invoice-detail-items" id="invoice-detail-items">

                    <div class="table-responsive">
                        <table class="table table-bordered item-table">
                            <thead>
                                <tr>
                                    <th>X</th>
                                    <th>@lang('site.stores')</th>
                                    <th>@lang('site.product_place')</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="delete-item-row">
                                        <ul class="table-controls">
                                            <li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>
                                        </ul>
                                    </td>

                                    <td class="description">
                                        <div class="form-group">
                                            <select id="store" class="form-control form-control-sm "  name="store_id[]" >

                                                @foreach ($stores as $store)
                                                <option value="{{ $store->id }}" >{{$store->title_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>

                                    <td class="description">

                                        <input type="text"  name="place[]"     class="form-control-sm form-control"  placeholder="@lang('site.product_place')">

                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <button class="btn btn-secondary additem btn-sm" id="1">@lang('site.add_place')</button>

                </div>

            </div>

        </div>
    </div>
</div>

