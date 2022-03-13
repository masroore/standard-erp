<svg xmlns="http://www.w3.org/2000/svg"  data-toggle="modal" data-target="#exampleModal{{$row->id}}" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 twiter"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>


<div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$row->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel{{$row->id}}"> @lang('site.edit_contact')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ $lang == 'ar' ? ' اغلاق' : 'Close ' }}">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <form action="{{route('dashboard.contacts.update', $row->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-name">
                            <i class="flaticon-user-11"></i>
                            <input  required type="text"  name="name" class="form-control mt-3" value="{{ $row->name }}" placeholder=" @lang('site.name')">
                            <span class="validation-text"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-name">
                            <i class="flaticon-mail-26"></i>
                            <input  required type="text"  name="email" class="form-control mt-3" value="{{ $row->email }}" placeholder=" @lang('site.email')">
                            {{-- <span class="validation-text"></span> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-email">
                            <i class="flaticon-mail-26"></i>
                            <input  required type="text" name="department" class="form-control mt-3" value="{{ $row->department }}" placeholder=" @lang('site.department')">
                            {{-- <span class="validation-text"></span> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-email">
                            <i class="flaticon-mail-26"></i>
                            <input  required type="text" id="position" name="position" class="form-control mt-3" value="{{ $row->position }}" placeholder="@lang('site.position')">
                            {{-- <span class="validation-text"></span> --}}
                        </div>
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-occupation">
                            <i class="flaticon-fill-area"></i>
                            <input  required type="text" id="address"  name="address" class="form-control mt-3" value="{{ $row->address }}" placeholder="@lang('site.address')">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="contact-phone">
                            <i class="flaticon-telephone"></i>
                            <input  required type="text" id="phone" name="phone[]" class="form-control mt-3" value="{{ json_decode($row->phone)[0] }}" placeholder="@lang('site.phone')">
                            {{-- <span class="validation-text"></span> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-phone">
                            <i class="flaticon-telephone"></i>
                            <input  required type="text" id="phone" name="phone[]" class="form-control mt-3"value="{{ json_decode($row->phone)[1] }}" placeholder="@lang('site.another_phone')">
                            {{-- <span class="validation-text"></span> --}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="contact-phone">
                            <i class="flaticon-telephone"></i>
                            <input  required type="text" id="whatsapp" name="whatsapp" class="form-control mt-3" value="{{ $row->whatsapp }}" placeholder=" @lang('site.whatsapp_number')">
                            {{-- <span class="validation-text"></span> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-phone">
                            <i class="flaticon-telephone"></i>
                            <input  required type="text" id="twitter" name="twitter" class="form-control mt-3" value="{{ $row->twitter }}" placeholder=" @lang('site.twitter_link')">
                            {{-- <span class="validation-text"></span> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-phone">
                            <i class="flaticon-telephone"></i>
                            <input  required type="text" id="facebook" name="facebook" class="form-control mt-3" value="{{ $row->facebook }}" placeholder="@lang('site.facebook_link')">
                            {{-- <span class="validation-text"></span> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-phone">
                            <i class="flaticon-telephone"></i>
                            <input  required  type="text" id="linkedin" name="linkedin" class="form-control mt-3" value="{{ $row->linkedin }}" placeholder=" @lang('site.linkedin_link')" >
                            {{-- <span class="validation-text"></span> --}}
                        </div>
                    </div>

                </div>
                <hr>


                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class=" col-12 text-left">
                                <label for="percent">@lang('site.this_contact_related_by'): </label>

                                <br>
                                <label class="new-control new-radio new-radio-text radio-info ">
                                  <input  required type="radio" class="new-control-input m-1" name="contact_related" {{ ($row->is_our_company == 0) ? 'checked' : ''  }} value="our-company" checked >
                                  <span class="new-control-indicator"></span><span class="new-radio-content" >@lang('site.our_company')</span>
                                </label>
                                <label class="new-control new-radio new-radio-text radio-info">
                                    <input  required type="radio" class="new-control-input m-1" name="contact_related" {{ ($row->customer_id > 0 ) ? 'checked' : ''  }} value="customer">
                                    <span class="new-control-indicator"></span><span class="new-radio-content" > @lang('site.customer')</span>
                                  </label>
                                  <label class="new-control new-radio new-radio-text radio-info">
                                    <input  required type="radio" class="new-control-input m-1" name="contact_related" {{ ($row->supplier_id > 0 ) ? 'checked' : ''  }} value="supplier">
                                    <span class="new-control-indicator"></span><span class="new-radio-content">   @lang('site.supplier')</span>
                                  </label>
                            </div>
                            <div class="form-group col-12 text-left" >

                                <div id="customers{{ $row->id }}" class="{{ ($row->customer_id >  0 ) ? '' : 'd-none'  }}">

                                    <label for="customers">@lang('site.customer')</label>

                                    <select class="form-control basic{{ $row->id }}" name="customer_id">
                                        <option value="">---</option>

                                        @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ ($row->customer_id ==  $customer->id ) ? 'selected' : ''  }} >{{ $customer->name }}</option>

                                        @endforeach

                                    </select>
                                </div>
                                <div id="supplier{{ $row->id }}" class="{{ ($row->supplier_id >0 ) ? '' : 'd-none'  }}">

                                    <label for="suppliers">@lang('site.supplier')</label>

                                    <select class="form-control basic2{{ $row->id }}" name="supplier_id">
                                        <option value="">---</option>

                                        @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ ($row->supplier_id ==  $supplier->id ) ? 'selected' : ''  }}>{{ $supplier->contact_person }}</option>

                                        @endforeach

                                    </select>
                                </div>


                            </div>
                        </div>

                    </div>
                    <div class=" col-6 m-auto text-center">
                        <label for="percent">@lang('site.contact_photo')</label>
                        <div class="invoice-logo">
                            <div class="upload">
                                <input   type="file" name="photo" id="input-file-max-fs" class="dropify" data-max-file-size="2M" />
                            </div>
                        </div>
                    </div>

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
    <script>
            var id = "{{ $row->id }}";

        var dd = $(".basic"+id).select2({
            tags: true,
            dropdownParent: $("#exampleModal"+id),
        });
        var d2 = $(".basic2"+id).select2({
            tags: true,
            dropdownParent: $("#exampleModal"+id),
        });

        $('input[name=contact_related]').click(function(){
            var id = "{{ $row->id }}";
            var value = $(this).val();
            if(value == 'customer'){
                $('#customers'+id).removeClass('d-none');
                $('#supplier'+id).addClass('d-none');
            }else if(value == 'supplier'){
                $('#supplier'+id).removeClass('d-none');
                $('#customers'+id).addClass('d-none');
            }else{
                $('#supplier'+id).addClass('d-none');
                $('#customers'+id).addClass('d-none');
            }

        });
        </script>
@endpush
