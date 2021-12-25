@extends('layouts.dashboard.app')
@php
$lang = LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
@lang('site.workdays')
@endsection
@section('modelTitlie')
@lang('site.workdays')
@endsection
@section('content')


<div class="row layout-top-spacing">
    <div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <nav class="breadcrumb-one p-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg></a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);"> @lang('site.workdays')</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.workdays_list')</span>
                        </li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="alert alert-success" id="success_msg" style="display: none;">
    @lang('site.saved_success')
</div>
@include('backend.partials._errors')





<div class="row layout-top-spacing" id="cancel-row">


    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.name')</th>
                        <th>@lang('site.status')</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($rows as $key => $row)


                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name"> {{$row->name}} </p>
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <label class="switch s-info  mb-4 mr-2">
                                    <input type="checkbox" class="update_status" id="{{$row->id}}"
                                        value="{{ $row->id }}" type="checkbox" {{ ($row->status == 1)? "checked" :""}}>
                                    <span class="slider round"></span>
                                </label>
                                {{-- <p class="align-self-center mb-0 admin-name"> {{$row->status}} </p> --}}
                            </div>
                        </td>

                    </tr>

                    @endforeach



                </tbody>

            </table>
            {{-- {{ $rows->links('vendor.pagination.default')}} --}}

        </div>

    </div>

</div>




@endsection



@push('js')



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

</script>

<script type="text/javascript">
    $(document).on('click', '.update_status', function (e) {
        // e.preventDefault();
        var token ="{{ csrf_token() }}";

                var id = $(this).val();

                if($(this).attr('checked') =='checked'){
                    var status = 0;
                }
                else{
                    var status = 1;
                }

// alert(id);
                $.ajax({
                    type: 'POST',
                    url: "{{ url('dashboard/workdays/status/') }}"+'/'+id,
                    headers: {'X-CSRF-TOKEN': token},

                    data:{'status':status},

                    success: function (data) {

                        if (data.status == true) {
                            $('#success_msg').show();
                            $('#taskForm')[0].reset();

                        }
                        $("#success_msg").fadeTo(2000, 500).slideUp(500, function(){
                                $("#success_msg").slideUp(500);
                            });
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


</script>


@endpush
