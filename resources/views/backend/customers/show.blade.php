@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
       @lang('site.customers')
@endsection
@section('modelTitlie')
    @lang('site.customers')
 @endsection
@section('content')

@component('backend.partials._pagebar')

<li class="breadcrumb-item"><a href="{{route('dashboard.customers.index')}}">  @lang('site.customers')</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>  @lang('site.customer_profile')</span></li>

@endcomponent 

@endsection

