@extends('layouts.dashboard.app')
@php
$lang = LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
@lang('site.attendances')
@endsection
@section('modelTitlie')
@lang('site.attendances')
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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.attendances.index') }}"> @lang('site.attendances')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span>@lang('site.attendances_list')</span></li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@include('backend.partials._errors')

{{-- fillter --}}
<div id="fs2Basic" class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">

            <div class="tile-body">
                <form action="{{ route('dashboard.attendances.search') }}" method="post" >
                @csrf

                <div class="row m-2">

                    <div class="col-md-2">
                        <label>@lang('site.employee')</label>

                        <select class="form-control nested" name="employee_id">
                            <option value="">---</option>

                            @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>

                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-2">
                      <label>@lang('site.date')</label>
                      <input id="basicFlatpickr15" class="form-control datepic" name="date" type="text" placeholder="Select Date">
                    </div>




                    <div class="col-md-2">
                        <label>@lang('site.status')</label>

                        <select class="form-control " name="status">
                            <option value="">---</option>
                            <option value="present">@lang('site.present')</option>
                            <option value="late">@lang('site.late')</option>


                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>@lang('site.created_by')</label>

                        <select class="form-control created-by" name="created_by">
                            <option value="">---</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>

                            @endforeach


                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label>@lang('site.from')</label>
                                <input  class="form-control " name="from" type="time" placeholder="Select time">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('site.to')</label>
                                <input  class="form-control " name="to" type="time" placeholder="Select time">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12  text-center mt-2">

                        <label class="new-control new-radio square-radio new-radio-text radio-primary">
                            <input type="radio" class="new-control-input" value="check_in" name="type">
                            <span class="new-control-indicator"></span><span class="new-radio-content">@lang('site.check_in')</span>
                            </label>
                            <label class="new-control new-radio square-radio new-radio-text radio-primary">
                            <input type="radio" class="new-control-input" value="check_out" name="type">
                            <span class="new-control-indicator"></span><span class="new-radio-content">@lang('site.check_out')</span>
                            </label>
                        </div>

                    </div>

                    </div>
                    <div class="col-md-1 text-center">
                        <label>@lang('site.search')</label><br>
                        <button class="btn btn-primary" type="submit"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                    </div>

                </div>
            </form>

            </div>


        </div>
    </div>
</div>

@include('backend.hrm.attendances.create')



<div class="row layout-top-spacing" id="cancel-row">


    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">


            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.date')</th>
                        <th>@lang('site.employee')</th>
                        <th>@lang('site.check_in')</th>
                        <th>@lang('site.check_out')</th>
                        <th>@lang('site.status')</th>
                        <th>@lang('site.created_by')</th>
                        <th class="no-content">@lang('site.actions')</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($rows as $key => $row)


                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name"> {{$row->date}} </p>
                            </div>
                        </td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name"> {{$row->employee_name}} </p>
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name">
                                    {{date('h:i a', strtotime($row->check_in))}}
                                 </p>
                            </div>
                        </td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name">
                                    {{date('h:i a', strtotime($row->check_out))}}
                                </p>
                            </div>
                        </td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                @if ($row->status == 'present')
                                <span class="badge badge-success"> @lang('site.present') <i class="fa fa-check"
                                        aria-hidden="true"></i> </span>
                                @else
                                <span class="badge badge-danger"> @lang('site.late') <i class="fa fa-times"
                                        aria-hidden="true"></i> </span>
                                @endif

                            </div>
                        </td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name"> {{$row->user_name}} </p>
                            </div>
                        </td>

                        <td>


                            @include('backend.hrm.attendances.edit')


                            <form action="{{route('dashboard.attendances.destroy', $row->id)}}" method="POST"
                                style="display:inline-block">
                                @csrf
                                @method('delete')
                                <button type="submit" class="mr-2 btn btn-danger show_confirm"
                                    title="@lang('site.delete')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>

                    @push('js')
                    <script>
                        var id ='basicFlatpickr'+{{  $row->id }};
                            var f2 = flatpickr(document.getElementById(id));
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
    .select2-dropdown {
        z-index: 1055 !important;
    }
</style>
@endpush

@push('js')
<script type="text/javascript">
    var ss = $(".basic").select2({
         tags: true,
         dropdownParent: $("#exampleModal"),
     });


     $(".nested").select2({
        tags: true
    });
    $(".created-by").select2({
    tags: true
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
    var f1 = flatpickr(document.getElementById('basicFlatpickr'));
    var f15 = flatpickr(document.getElementById('basicFlatpickr15'));
    var f16 = flatpickr(document.getElementById('basicFlatpickr16'));
</script>

@endpush
