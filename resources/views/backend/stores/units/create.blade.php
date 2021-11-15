@extends('layouts.dashboard.app')
@php 
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
        {{ $lang == 'ar' ? ' اضافة وحدة جديدة' : 'Add New Unit ' }}
@endsection
 @section('modelTitlie')
        {{ $lang == 'ar' ? ' الوحدات ' : 'Units ' }}
 @endsection
@section('content')

 
<div class="row layout-top-spacing">
    <div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <nav class="breadcrumb-one p-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                        <li class="breadcrumb-item"><a href="{{route('dashboard.units.index')}}"> {{ $lang == 'ar' ? ' الوحدات ' : 'Units ' }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>{{$lang == 'ar' ? '  اضافة وحدة جديدة ' : ' Add New Unit'}}</span></li>
                       
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="row ">
    <div id="flFormsGrid" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>{{$lang == 'ar' ? 'الرجاء ادخال البيانات الاتية' : ' Please Fill User Data '}}</h4>
                    </div>                                                                        
                </div>
            </div>
            <div class="widget-content widget-content-area p-3">
                <form action="{{ route('dashboard.units.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('backend.partials._errors')
                    <div class="form-group">
                        <label class="pl-2">{{ $lang == 'ar' ? 'الوحدة الرئيسية' : 'Base Unit' }} </label>
                        <select class="form-control nested select2" name="base_unit" id="units">
                            <option value="0">{{$lang == 'ar' ? ' وحدة رئيسية' : 'base unit'}}</option>
                            @foreach($units as $unit)
                                <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="pl-2"> {{ $lang == 'ar' ? ' اسم الوحدة' : 'Unit Name' }}</label>
                        <input  type="text" name="unit_name" placeholder="{{ $lang == 'ar' ? ' اسم الوحدة' : 'Unit Name' }}" class="form-control" required>
                       
                    </div>
    
                    <div class="form-group">
                        <label class="pl-2">{{ $lang == 'ar' ? 'كود الوحدة' : 'Unit Code ' }} </label>
                        <input type="text" name="unit_code" placeholder="{{ $lang == 'ar' ? 'كود الوحدة' : 'Unit Code ' }}" class="form-control" required>
                    </div>

                    <div class="form-group hidediv">
                        <label class="pl-2">{{ $lang == 'ar' ? 'المعامل' : 'Operator' }} </label>
                        <select class="form-control nested" name="operator" >
                          
                            <option value="+">+</option>
                            <option value="+">-</option>
                            <option value="+">*</option>
                            <option value="+">/</option>
                           
                            
                        </select>
                    </div>

                    <div class="form-group hidediv">
                        <label class="pl-2">{{ $lang == 'ar' ? 'القيمة' : 'Operation Value' }} </label>
                        <input type="text" name="operation_value" placeholder="{{ $lang == 'ar' ? 'القيمة' : 'Operation Value' }}" class="form-control" >
                    </div>
    
                    <button type="submit" class="btn btn-primary mt-3">{{$lang == 'ar' ? ' حفظ ' : 'Save  '}}</button>
                </form>

            </div>
        </div>
    </div>
</div>



@endsection


@push('css')
    <style>
       
        .select2-dropdown{
            z-index:1050 !important;
        }
        .hidediv{
            display: none;
        }

        
    </style>
@endpush

@push('js')
<script type="text/javascript">
    $(".nested").select2({
        tags: true
    });  
</script>
<script>
   $(document).ready(function(){
        $('#units').on('change', function() {
            value =  this.value
            if(value == 0) {
                $(".hidediv").css("display", "none");
            }else{
                $(".hidediv").css("display", "block");
            }
           
            });
        });
</script>
@endpush





