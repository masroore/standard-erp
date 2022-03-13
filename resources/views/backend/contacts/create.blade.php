<div class="col-xl-8 col-lg-7 col-md-7  col-sm-5 text-sm-right text-center layout-spacing align-self-center">

        <div class="d-flex float-right">

    <select class="form-control mr-2  "  id="type_id" name="type_id">
        <option value="all">---</option>
        <option value="customers" >@lang('site.customers')</option>
        <option value="suppliers">@lang('site.suppliers')</option>
    </select>

    <div class="d-flex justify-content-sm-end justify-content-center">
        <svg id="btn-add-contact" xmlns="http://www.w3.org/2000/svg" width="24"  data-toggle="modal" data-target="#exampleModal" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>

    </div>
</div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> @lang('site.add_new_contact')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="@lang('site.close')">
                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <form id="" action="{{ route('dashboard.contacts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                <div class="modal-body">


                        <h4 class="text-left"> @lang('site.contact_info')</h4>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="contact-name">
                                    <i class="flaticon-user-11"></i>
                                    <input  required type="text"  name="name" class="form-control mt-3" placeholder=" @lang('site.name')">
                                    <span class="validation-text"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-name">
                                    <i class="flaticon-mail-26"></i>
                                    <input  required type="text"  name="email" class="form-control mt-3" placeholder=" @lang('site.email')">
                                    {{-- <span class="validation-text"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-email">
                                    <i class="flaticon-mail-26"></i>
                                    <input  required type="text" name="department" class="form-control mt-3" placeholder=" @lang('site.department')">
                                    {{-- <span class="validation-text"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-email">
                                    <i class="flaticon-mail-26"></i>
                                    <input  required type="text" id="position" name="position" class="form-control mt-3" placeholder="@lang('site.position')">
                                    {{-- <span class="validation-text"></span> --}}
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="contact-occupation">
                                    <i class="flaticon-fill-area"></i>
                                    <input  required type="text" id="address"  name="address" class="form-control mt-3" placeholder="@lang('site.address')">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="contact-phone">
                                    <i class="flaticon-telephone"></i>
                                    <input  required type="text" id="phone" name="phone[]" class="form-control mt-3" placeholder="@lang('site.phone')">
                                    {{-- <span class="validation-text"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-phone">
                                    <i class="flaticon-telephone"></i>
                                    <input  required type="text" id="phone" name="phone[]" class="form-control mt-3" placeholder="@lang('site.another_phone')">
                                    {{-- <span class="validation-text"></span> --}}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="contact-phone">
                                    <i class="flaticon-telephone"></i>
                                    <input  required type="text" id="whatsapp" name="whatsapp" class="form-control mt-3" placeholder=" @lang('site.whatsapp_number')">
                                    {{-- <span class="validation-text"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-phone">
                                    <i class="flaticon-telephone"></i>
                                    <input  required type="text" id="twitter" name="twitter" class="form-control mt-3" placeholder=" @lang('site.twitter_link')">
                                    {{-- <span class="validation-text"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-phone">
                                    <i class="flaticon-telephone"></i>
                                    <input  required type="text" id="facebook" name="facebook" class="form-control mt-3" placeholder="@lang('site.facebook_link')">
                                    {{-- <span class="validation-text"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-phone">
                                    <i class="flaticon-telephone"></i>
                                    <input  required  type="text" id="linkedin" name="linkedin" class="form-control mt-3" placeholder=" @lang('site.linkedin_link')" >
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
                                          <input  required type="radio" class="new-control-input m-1" name="contact_related" value="our-company" checked >
                                          <span class="new-control-indicator"></span><span class="new-radio-content" >@lang('site.our_company')</span>
                                        </label>
                                        <label class="new-control new-radio new-radio-text radio-info">
                                            <input  required type="radio" class="new-control-input m-1" name="contact_related" value="customer">
                                            <span class="new-control-indicator"></span><span class="new-radio-content"> @lang('site.customer')</span>
                                          </label>
                                          <label class="new-control new-radio new-radio-text radio-info">
                                            <input  required type="radio" class="new-control-input m-1" name="contact_related" value="supplier">
                                            <span class="new-control-indicator"></span><span class="new-radio-content">   @lang('site.supplier')</span>
                                          </label>
                                    </div>
                                    <div class="form-group col-12 text-left" >

                                        <div id="customers" class="d-none">

                                            <label for="customers">@lang('site.customer')</label>

                                            <select class="form-control basic" name="customer_id">
                                                <option value="">---</option>

                                                @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                        <div id="supplier" class="d-none">

                                            <label for="suppliers">@lang('site.supplier')</label>

                                            <select class="form-control basic2" name="supplier_id">
                                                <option value="">---</option>

                                                @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->contact_person }}</option>

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
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>@lang('site.cancel')</button>
                    <button type="submit" class="btn btn-primary">@lang('site.save')</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->

</div>

@push('js')
<script>

    $(document).ready(function(){
      $("#type_id").change(function(){

             var value =$(this).val();

              $.ajax({
                  type: 'get',

                  url: "{{ url('dashboard/contacts/getByType/') }}"+'/'+value,

                  success: function (data) {
                      $('#content-search').html(data);
                      },

                  error: function(data_error, exception) {
                      if(exception == 'error'){
                          var error_list = '' ;
                          $.each(data_error.responseJSON.errors, function(index,v){
                              error_list += '<li>'+v+'</li>';
                          });
                          $('.alert-errors ul').html(error_list)
                      }

                  }



              });

      });
  });
</script>

@endpush
