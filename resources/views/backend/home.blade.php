
@extends('layouts.dashboard.app')
@php 
$lang =  LaravelLocalization::getCurrentLocale();
@endphp  
@section('title')
    {{$lang == 'ar' ? 'الصفحة الرئيسية' : 'Home Page'}}
@endsection

@section('content')

<div class="row layout-top-spacing">
    <div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <nav class="breadcrumb-one p-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{$lang == 'ar' ? 'الصفحة الرئيسية ' : 'Home Page'}}</a></li>
                        {{-- <li class="breadcrumb-item active" aria-current="page"><span>UI Kit</span></li> --}}
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="row layout-top-spacing">
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
    {{$lang == 'ar' ? 'مرحبا بك في لوحة التحكم ' : 'Welcome to control panel'}}
    </div>
</div>
    
@endsection