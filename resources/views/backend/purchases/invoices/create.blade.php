@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
       @lang('site.purchases_invoices')
@endsection
@section('modelTitlie')
 @lang('site.purchases_invoices')
@endsection
@section('content')

@component('backend.partials._pagebar')

    <li class="breadcrumb-item"><a href="{{ route('dashboard.purchases.index') }}">  @lang('site.purchases')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.add_purchases')</span></li>

@endcomponent

<div class="row invoice layout-top-spacing layout-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="doc-container">
 
            <div class="row">
                <div class="col-xl-12">
                    @include('backend.partials._errors')
                    <div class="invoice-content">

                        <form id="form" action="{{ route('dashboard.purchases.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="invoice-detail-body">
                                <input type="hidden" name="opration_id" value="{{ $operation }}">
                                @include('backend.purchases.invoices.form')
                                <hr>
                                <div class="form-group text-center ">
                                    <button class="btn btn-primary btn-l" type="submit"> @lang('site.save') @lang('site.invoice')</button>
                                </div>

                            </div>
                        </form>

                    </div>

                </div>


            </div>


        </div>

    </div>
</div>



@endsection
@push('css')
<style>
    form .error {
        color: #ff0000;
    }
</style>
@endpush
@push('js')
<script src="{{asset('public/backend/crock/assets/js/apps/add_purchase.js') }}"></script>
@include('backend.purchases.invoices.script')

@endpush
