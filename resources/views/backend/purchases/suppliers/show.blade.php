@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
       @lang('site.suppliers')
@endsection
@section('modelTitlie')
    @lang('site.suppliers')
 @endsection
@section('content')

@component('backend.partials._pagebar')

<li class="breadcrumb-item"><a href="{{route('dashboard.suppliers.index')}}">  @lang('site.suppliers')</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>  @lang('site.supplier_profile')</span></li>

@endcomponent

@endsection


