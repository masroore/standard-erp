@extends('layouts.backend.app')
@php 
	$current_lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
        {{ $current_lang == 'ar' ? ' لوحة التحكم' : 'dashboard ' }}
@endsection

@section('content')
    <h3>  {{ $current_lang == 'ar' ? 'مرحبا بك في لوحة التحكم' : 'welcome to dashboard ' }} :  {{ auth()->user()->name }} </h3>
@endsection