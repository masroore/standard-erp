@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
        @lang('site.salarySetups')
@endsection
 @section('modelTitlie')
        @lang('site.salarySetups')
 @endsection
@section('content')


<div class="row layout-top-spacing">
    <div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <nav class="breadcrumb-one p-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                        <li class="breadcrumb-item"><a  href="{{route('dashboard.salarySetups.index')}}"> @lang('site.salarySetups')</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.edit_salarySetup')</span></li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@include('backend.partials._errors')




        <div class="modal-content" style="border:0">

            <form action="{{route('dashboard.salarySetups.update', $row->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="modal-body">

                    <div class="row">

                        <div class="form-group col-12">

                            <label for="percent">@lang('site.employee')</label>

                            <select class="form-control basic" name="employee_id">
                                <option value="">---</option>

                                @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" {{isset($row) && $row->employee_id == $employee->id ? 'selected'  : ''}}>{{ $employee->name }}</option>

                                @endforeach

                            </select>
                        </div>



                    </div>
                    <div class="form-group row">

                        <label for="is_percentage" class="col-sm-3 col-form-label switch s-icons s-outline  s-outline-info  mb-4 mr-2">@lang('site.percentage') *</label>
                        <label class="switch s-icons s-outline  s-outline-info  mb-4 mr-2">
                            <input type="checkbox" name="is_percentage" id="ispercentage" value="{{ $row->is_percentage }}"
                            {{ $row->is_percentage == 1 ? 'checked'  : ''}}
                            data-toggle="tooltip" data-placement="right" data-original-title="Check to calculate addition and deduction in percent."
                            onchange="handlepercent(this);" autocomplete="off" >
                            <span class="slider"></span>
                        </label>
                     </div>
                    <div class="row">

                        <table border="1" style="border: 1px solid #dedede;" width="100%">
                            <tbody>
                                <tr>
                                    <td class="col-sm-6 text-center" style="padding: 50px 20px;">
                                        <h4 class="addition_title">@lang('site.addition')</h4><br>
                                        <table id="add">
                                            <tbody>
                                                <tr>
                                                    <th class="padten">@lang('site.basic')</th>
                                                    <td><input type="number" id="basic" name="basic" value="{{ $row->basic }}"
                                                            class="form-control basic" onkeyup="salarySetupsummary()" autocomplete="off" min="0"></td>
                                                </tr>
                                                @foreach ($salaryType as $key => $item)
                                                    @if ($item->type == 'add' )
                                                    @php
                                                    $data = (array)json_decode($row->addition);
                                                    @endphp


                                                    <tr>
                                                        <th class="padten">{{ $item->benefits }}<span class="percent"
                                                                style="{{ $row->is_percentage == 0 ? 'display: none;'  : ''}}">(%)<span></span></span></th>
                                                        <td><input type="number" name="addition[{{ $item->benefits }}]"
                                                            value="{{ (isset($data[$item->benefits])) ? $data[$item->benefits] : '' }}"
                                                                class="form-control addamount"
                                                                onkeyup="salarySetupsummary()" id="add_{{ $key+1 }}"
                                                                autocomplete="off" min="0"></td>
                                                    </tr>
                                                    @endif

                                                @endforeach


                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="col-sm-6 text-center" style="padding: 50px 20px;">
                                        <h4 class="addition_title">@lang('site.deduction')</h4><br>
                                        <table id="dduct">
                                            <tbody>

                                            @foreach ($salaryType as $key => $item)
                                            @if ($item->type == 'deduct' )
                                            @php
                                            $data = (array)json_decode($row->deduction);
                                            $tax = $data['tax'];
                                            @endphp
                                            <tr>
                                                <th class="padten">{{ $item->benefits }}<span class="percent"
                                                    style="{{ $row->is_percentage == 0 ? 'display: none;'  : ''}}">(%)<span></span></span></th>
                                                <td><input type="number" name="deduction[{{ $item->benefits }}]"
                                                    value="{{ (isset($data[$item->benefits])) ? $data[$item->benefits] : '' }}"
                                                        class="form-control deducamount"
                                                        onkeyup="salarySetupsummary()" id="add_{{ $key+1 }}"
                                                        autocomplete="off" min="0"></td>
                                            </tr>
                                            @endif

                                        @endforeach
                                                <tr>
                                                    <th class="padten">@lang('site.tax')<span class="percent"
                                                        style="{{ $row->is_percentage == 0 ? 'display: none;'  : ''}}">(%)<span></span></span></th>
                                                    <td><input type="number" name="deduction[tax]"
                                                        value="{{ $tax }}"
                                                            onkeyup="salarySetupsummary()"
                                                            class="form-control deducamount" id="taxinput"
                                                            autocomplete="off" min="0"></td>

                                                </tr>

                                            </tbody>
                                        </table>

                                    </td>



                                </tr>
                            </tbody>
                        </table>



                    </div>

                    <div class="form-group row mt-4 ">
                        <label for="payable" class="col-md-3 col-form-label text-center">@lang('site.gross_salary')</label>
                             <div class="col-md-9">
                     <input type="text" class="form-control"  name="gross_salary" id="grsalary" readonly="" value="{{ $row->gross_salary }}" autocomplete="off">
                            </div>
                     </div>

                </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning">@lang('site.update')</button>
            </div>
            </form>
        </div>




@endsection


@push('css')
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
<script src="{{asset('public/backend/crock/assets/js/payroll.js') }}"></script>
@endpush
