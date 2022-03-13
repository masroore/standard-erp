@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
        @lang('site.contacts_customers')
@endsection
 @section('modelTitlie')
        @lang('site.contacts')
 @endsection
@section('content')
@include('backend.partials._errors')


<div class="layout-px-spacing">
    <div class="row layout-spacing layout-top-spacing" id="cancel-row">
        <div class="col-lg-12">
            <div class="widget-content searchable-container grid">
                @if ($rows->count() > 0)
                <div class="row">
                    <div class="col-md-4">
                        @foreach ($rows as $row)
                         <h3>   {{ $row->customer->company_name}} </h3>
                        @endforeach
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex filtered-grid-search layout-spacing align-self-center">
                        <form class="form-inline my-2 my-lg-0">
                            <div class="w-100">
                                <input type="text" class="form-control product-search" id="search" placeholder="Search Contacts...">
                            </div>
                        </form>
                    </div>
                </div>


                <div class="searchable-items grid" id="content-search">
                    @foreach ($rows as $row)

                        <div class="items">
                            <div class="item-content">
                                <div class="user-profile">
                                    <div class="n-chk align-self-center text-center">
                                        <label class="new-control new-checkbox checkbox-primary">
                                        <input type="checkbox" class="new-control-input contact-chkbox">
                                        <span class="new-control-indicator"></span>
                                        </label>
                                    </div>
                                    @php
                                        (isset($row->photo))? $image = 'public/'.$row->photo : $image ='public/uploads/customers/photos/default.png';
                                    @endphp
                                    <img width="90" height="90" src="{{asset($image)}}" alt="avatar">


                                    <div class="user-meta-info">
                                        <p class="user-name" data-name="Alan Green">{{ $row->name }}</p>
                                        <p class="user-work" data-occupation="Web Developer">{{ $row->position }}</p>
                                    </div>
                                </div>
                                <div class="user-phone">
                                    <p class="info-title">@lang('site.department') : </p>
                                    <p class="usr-email-addr text-center" data-department="{{ $row->department }}">{{ $row->department }}</p>
                                </div>
                                <div class="user-phone">
                                    <p class="info-title">@lang('site.email'): </p>
                                    <p class="usr-email-addr text-center" data-email="{{ $row->email }}">{{ $row->email }}</p>
                                </div>

                                <div class="user-location">
                                    <p class="info-title">@lang('site.address'): </p>
                                    <p class="usr-location text-center" data-location="{{ $row->address }}">{{ $row->address }}</p>
                                </div>
                                <div class="user-phone">
                                    <p class="info-title">@lang('site.whatsapp') : </p>
                                    <p class="usr-email-addr text-center" data-email="{{ $row->whatsapp_number }}">{{ $row->whatsapp }}</p>
                                </div>
                                <div class="user-phone">
                                    <p class="info-title">@lang('site.phone'): </p>
                                    @foreach (json_decode($row->phone) as $phone)

                                    <p class="usr-ph-no text-center" style="display: contents;" data-phone="{{ $phone }}">{{ $phone }} , </p>
                                    @endforeach

                                </div>

                                <div class="action-btn">
                                    <a href="{{ $row->facebook }}" target="_blank" rel="noopener noreferrer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                                    </a>
                                    <a href="{{ $row->twiter }}" target="_blank" rel="noopener noreferrer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter twiter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                                    </a>

                                    <a href="{{ $row->linkedin }}" target="_blank" rel="noopener noreferrer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                                    </a>
                                </div>
                                {{-- <div class="action-btn">
                                    <form action="{{ route('dashboard.contacts.destroy' , $row->id) }}" method="post" style="display:inline-block">
                                        @csrf
                                        @method('delete')
                                    <svg type="submit" xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-minus twiter show_confirm"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="23" y1="11" x2="17" y2="11"></line></svg>

                                      </form>
                                </div> --}}
                            </div>
                        </div>

                    @endforeach
                </div>
                @else
                <div class="row mt-5">
                    <div class="col-md-4">

                    </div>
                    <div class="alert alert-arrow-right alert-icon-right alert-light-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                        <strong>@lang('site.opps')</strong> @lang('site.no_items_matched')
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>



@endsection


@push('css')

<link href="{{ asset('public/backend/crock/assets/css/apps/contacts.css')}}" rel="stylesheet" type="text/css" />


    <style>
        .select2-dropdown{
            z-index:1055 !important;
        }

        @media (min-width: 576px){
            .modal-dialog {
            max-width: 50% !important;
            margin: 1.75rem auto;
        }
        }
    </style>
@endpush

@push('js')

    <script src="{{ asset('public/backend/crock/assets/js/apps/contact.js')}}"></script>

    <script type="text/javascript">
            $('.dropify').dropify({
                messages: { 'default': 'Click to Upload Photo', 'replace': 'Upload or Drag n Drop' }
            });

            $('input[name=contact_related]').click(function(){
                var value = $(this).val();
                // alert(value);

                if(value == 'customer'){
                    $('#customers').removeClass('d-none');
                    $('#supplier').addClass('d-none');
                }else if(value == 'supplier'){
                    // alert('supplier');
                    $('#supplier').removeClass('d-none');
                    $('#customers').addClass('d-none');
                }else{
                    $('#supplier').addClass('d-none');
                    $('#customers').addClass('d-none');
                }

            });

    </script>

    <script type="text/javascript">

        $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: @if($lang == 'ar') ` هل انت متأكد سوف يتم الحذف   !!` @else  `Are you sure you want to delete this row ?` @endif,
                text:  @if($lang == 'ar') "اذا قمت بحذف هذا العنصر لم تتمكن من استعادته مره اخري" @else  "If you delete this, it will be gone forever." @endif,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
            });
        });

        var ss = $(".basic").select2({
            tags: true,
            dropdownParent: $("#exampleModal"),
        });
        var ss = $(".basic2").select2({
            tags: true,
            dropdownParent: $("#exampleModal"),
        });
        var f1 = flatpickr(document.getElementById('basicFlatpickrFrom'));
        var f2 = flatpickr(document.getElementById('basicFlatpickrTo'));

    </script>
    <script>
          $(document).ready(function(){
            $("#search").keyup(function(){

                var value =$(this).val();

                    $.ajax({
                        type: 'get',

                        url: "{{ url('dashboard/contacts/search/') }}"+'/'+value,

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

