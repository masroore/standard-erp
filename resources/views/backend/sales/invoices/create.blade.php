@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
        @lang('site.create_invoice')
@endsection

@section('content')

    @include('backend.sales.invoices.form')

@endsection

@push('js')
{{-- <script src="{{asset('public/backend/crock/assets/js/apps/invoice-add-sales.js') }}"></script> --}}
@endpush
