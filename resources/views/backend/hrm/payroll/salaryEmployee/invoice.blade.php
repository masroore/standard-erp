@extends('layouts.dashboard.app')
@php
$lang = LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
@lang('site.salary_employees')
@endsection
@section('modelTitlie')
@lang('site.salary_employees')
@endsection
@section('content')


            <div class="row layout-top-spacing">
                <div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <nav class="breadcrumb-one p-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-home">
                                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                            </svg></a></li>
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">
                                            @lang('site.salary_employees')</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <span>@lang('site.salary_employees_list')</span>
                                    </li>

                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row layout-top-spacing" id="cancel-row">


                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
            <div class="row">
                <div class="col-sm-12" id="outprint">
                    <div class="panel panel-bd">
                        <div class="panel title text-right p-4">
                            <button class="btn btn-warning " id="print_button" onclick="printDiv()"><span
                                    class="fa fa-print"></span></button>
                        </div>
                        <div id="printArea">
                            <div class="panel-body" id="payslip">
                                <div class="row pl-4 pr-4">

                                    <div class="col-md-12">

                                      <div class="d-flex">
                                        <h1 class="pl-4">E.R.P</h1>
                                        <address class="w-100 text-center">
                                            <strong>HRM</strong><br>
                                            {{ $row->address }}<br>



                                        </address>
                                      </div>
                                        <div id="details" class="p-4">
                                            <div class="scope-entry">
                                                <div class="title"> @lang('site.employee_name') :{{ $row->name }}</div>
                                                <div class="title"> @lang('site.salary_date') : {{ $row->date }}</div>

                                            </div>

                                        </div>
                                        <table>

                                        </table>

                                    </div>




                                    <div class="col-sm-12">
                                        <table class="table p-4">
                                            <tbody>
                                                <tr>
                                                    <td class="left-panel">
                                                        <table class="" width="100%">

                                                            <thead>
                                                                <tr class="employee">
                                                                    <th class="name text-center" colspan="2"> @lang('site.earnings')
                                                                    </th>


                                                                </tr>
                                                            </thead>
                                                            <tbody class="details">

                                                                <tr class="entry" >
                                                                    <td class="value">   @lang('site.basic_salary')</td>
                                                                    <td class="value">
                                                                        <div>{{ $row->basic }}</div>
                                                                    </td>

                                                                </tr>

                                                                <tr class="entry nti" style="background-color: #eaeaec;">
                                                                    <td class="value valtitle">  @lang('site.total_addition')</td>
                                                                    <td class="value"><b>
                                                                        @php
                                                                        $addition = (array)json_decode($row->addition);
                                                                        $count_addition = 0;
                                                                        foreach($addition as $item ){
                                                                             $count_addition += $item;
                                                                        }
                                                                        $addition =  $count_addition  ;
                                                                        if($row->is_percentage == 1){
                                                                            $addition =  (($count_addition /100) *  $row->basic) ;
                                                                        }
                                                                        @endphp
                                                                        {{ $addition }}
                                                                        </b></td>
                                                                </tr>


                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td class="right-panel">
                                                        <table style="margin-bottom: 50px;" width="100%">



                                                            <thead>
                                                                <tr class="employee">
                                                                    <th class="name text-center" colspan="2"> @lang('site.deduction')
                                                                    </th>


                                                                </tr>
                                                            </thead>
                                                            <tbody class="details">

                                                                <tr class="entry nti" style="background-color: #eaeaec;">
                                                                    <td class="value valtitle">  @lang('site.total_deduction')</td>
                                                                    <td class="value"><b>
                                                                        @php
                                                                        $deduction = (array)json_decode($row->deduction);
                                                                        $count_deduction = 0;
                                                                        foreach($deduction as $item ){
                                                                             $count_deduction += $item;
                                                                        }
                                                                        $deduction = $count_deduction  ;
                                                                        if($row->is_percentage == 1){
                                                                            $deduction = (($count_deduction /100) *  $row->basic) ;
                                                                        }

                                                                        @endphp
                                                                        {{ $deduction }}

                                                                        </b></td>
                                                                </tr>


                                                            </tbody>

                                                        </table>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <div class="row p-4">


                                    <div class="col-sm-12">

                                        <table class="table">


                                            <tbody>
                                                <tr class="details">
                                                </tr>
                                            </tbody>
                                            <tbody class="nti">
                                                <tr>
                                                    <th class="value">Total Salary : {{ $row->total_salary }}   </th>
                                                    <td class="value total_salary"> </td>
                                                </tr>
                                            </tbody>



                                        </table>



                                    </div>
                                </div>
                                <div class="row pl-4 pr-4">
                                    <div class="col-sm-12 row">

                                        <h6 class="col-md-6 valtitle">@lang('site.payment_type') :  {{ ($row->pay_type == 1) ? 'Cash Payment' : 'Bank Payment' }}</h6>

                                    </div>

                                </div>
                                <br>
                                <div class="row p-4">
                                    <div class="col-sm-6 ">
                                        <p class="m-0">  &nbsp;	 </p>
                                        <hr class="w-50 d-inline-block m-0">
                                        <h6 class="employee_sign">
                                              @lang('site.employee_signature')</h6>


                                    </div>

                                    <div class="col-sm-6 ">
                                        <p class="m-0">  {{ $row->users->name }} </p>
                                        <hr class="w-50 d-inline-block m-0">
                                        <h6 class="authority_sign">
                                              @lang('site.paid_by')</h6>

                                    </div>
                                </div>

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
    <script>
        // function printDiv(){
        //     // alert(544848);
        //    var doc = document.getElementById("outprint");
        //     window.print();
        // }

        function printDiv()
            {


             let button = document.getElementById('print_button');
             button.style.display = "none";
             let content = document.getElementById('outprint').innerHTML;
             let originalContent = document.body.innerHTML;
             document.body.innerHTML = content;
             window.print();
             document.body.innerHTML = originalContent;
             location.reload();


            }

    </script>
@endpush
