@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
        @lang('site.holidays')
@endsection
 @section('modelTitlie')
        @lang('site.holidays')
 @endsection
@section('content')


<div class="row layout-top-spacing">
    <div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <nav class="breadcrumb-one p-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);"> @lang('site.holidays')</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.holidays_list')</span></li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@include('backend.partials._errors')

@include('backend.hrm.holidays.create')


<div class="row layout-top-spacing" id="cancel-row">


    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.note')</th>
                        <th>@lang('site.date_from')</th>
                        <th>@lang('site.date_to')</th>
                        <th class="no-content">@lang('site.actions')</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($rows as $key => $row)


                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name"> {{$row->note}} </p>
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name"> {{$row->date_from}} </p>
                            </div>
                        </td>


                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name"> {{$row->date_to}} </p>
                            </div>
                        </td>

                        <td>


                              @include('backend.hrm.holidays.edit')


                                <form action="{{route('dashboard.holidays.destroy', $row->id)}}" method="POST" style="display:inline-block">
                                    @csrf
                                 @method('delete')
                                <button type="submit" class="mr-2 btn btn-danger show_confirm" title="@lang('site.delete')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                              </form>
                        </td>
                    </tr>

                    @push('js')
                        <script>
                            var from ='basicFlatpickrFrom'+{{  $row->id }};
                            var to ='basicFlatpickrTo'+{{  $row->id }};
                            var f3 = flatpickr(document.getElementById(from));
                            var f4 = flatpickr(document.getElementById(to));
                        </script>
                    @endpush
                    @endforeach



                </tbody>

            </table>
        </div>
    </div>

</div>




@endsection


@push('css')
    <style>
        .select2-dropdown{
            z-index:1055 !important;
        }
    </style>
@endpush

@push('js')

<script type="text/javascript">
    var ss = $(".basic").select2({
         tags: true,
         dropdownParent: $("#exampleModal"),
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

</script>

<script>
    var f1 = flatpickr(document.getElementById('basicFlatpickrFrom'));
    var f2 = flatpickr(document.getElementById('basicFlatpickrTo'));
</script>

@endpush

