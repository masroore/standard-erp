@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
        {{ $lang == 'ar' ? '  تعديل الصنف' : ' Edit Item ' }}
@endsection
 @section('modelTitlie')
        {{ $lang == 'ar' ? ' الاصناف ' : 'Items ' }}
 @endsection
@section('content')


<div class="row layout-top-spacing">
    <div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <nav class="breadcrumb-one p-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                        <li class="breadcrumb-item"><a href="{{route('dashboard.items.index')}}"> {{ $lang == 'ar' ? ' الاصناف ' : 'Items ' }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>{{ $lang == 'ar' ? '  تعديل الصنف' : ' Edit Item ' }}</span></li>

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
                <form action="{{ route('dashboard.items.update',$row->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    @include('backend.partials._errors')
                    @include('backend.stores.items.form')

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


    </style>
@endpush

@push('js')
<script type="text/javascript">
    $(".basic").select2({
        tags: true,

    });

    $(".tagging").select2({
    tags: true
    });

</script>
@endpush





