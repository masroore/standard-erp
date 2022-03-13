@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
       @lang('site.bankinfos')
@endsection
@section('modelTitlie')
    @lang('site.bankinfos')
 @endsection
@section('content')

@component('backend.partials._pagebar')

<li class="breadcrumb-item"><a href="{{route('dashboard.bankinfos.index')}}">  @lang('site.bankinfos')</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>  @lang('site.bankinfo_profile')</span></li>

@endcomponent

@endsection

