@extends('layouts.dashboard.app')
@php
$lang = LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
@lang('site.salaryGenerates')
@endsection
@section('modelTitlie')
@lang('site.salaryGenerates')
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
                        <li class="breadcrumb-item"><a href="javascript:void(0);"> @lang('site.salaryGenerates')</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span>@lang('site.salaryGenerates_list')</span></li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@include('backend.partials._errors')

{{-- @include('backend.hrm.payroll.salaryGenerates.create') --}}


<div class="row layout-top-spacing" id="cancel-row">


    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="panel panel-bd">

                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>
                                </h4>
                            </div>
                        </div>

                        <div class="panel-body d-flex p-3">
                            <div class="col-sm-5 col-md-5">


                                <form action="{{ route('dashboard.salaryGenerate.store') }}"  method="post" accept-charset="utf-8">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">@lang('site.salary_month') </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control monthYearPicker hasDatepicker"
                                                name="salary_name" placeholder="Salary Month" id="basicFlatpickr"
                                                autocomplete="off">


                                        </div>
                                    </div>

                                    <div class="form-group text-center">
                                        <button type="reset" class="btn btn-primary w-md m-b-5"
                                            autocomplete="off">@lang('site.reset')</button>
                                        <button type="submit"
                                            class="btn btn-success w-md m-b-5" autocomplete="off">@lang('site.generate')</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-7 col-md-7">
                                <table width="100%" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>@lang('site.sl_no')</th>
                                            <th>@lang('site.salary_name')</th>
                                            <th>@lang('site.generate_date')</th>
                                            <th>@lang('site.generate_by')</th>
                                            <th>@lang('site.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rows as $key => $row)

                                        <tr class="odd gradeX">
                                            <td>{{ $key +1 }}</td>
                                            <td>{{ $row->salary_name }}</td>
                                            <td>  {{ \Carbon\Carbon::parse($row->date)->format('d-m-Y') }}</td>
                                            <td>{{ $row->name }}</td>

                                            <td class="center">
                                                <a href={{ route('dashboard.salaryEmployee.index',$row->id) }} class="btn btn-warning"  >
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <form action="{{route('dashboard.salaryGenerate.destroy', $row->id)}}" method="POST" style="display:inline-block">
                                                    @csrf
                                                 @method('delete')
                                                <button type="submit" class="mr-2 btn btn-danger show_confirm" title="@lang('site.delete')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                              </form>
                                            </td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table> <!-- /.table-responsive -->

                            </div>

                        </div>
                    </div>
                </div>


            </div>
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

<script>

    var f4 = flatpickr(document.getElementById('basicFlatpickr'), {
        altInput: true,
    altFormat: "F  Y",
    dateFormat: "Y-m-d",
});
</script>

@endpush
