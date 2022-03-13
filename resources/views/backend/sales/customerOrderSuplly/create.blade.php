@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
       @lang('site.add_os_customer')
@endsection
@section('modelTitlie')
 @lang('site.os_customers')
@endsection
@section('content')

@component('backend.partials._pagebar')

    <li class="breadcrumb-item"><a href="{{ route('dashboard.customer-order-supply.index') }}">  @lang('site.all_os_customers')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.add_os_customer')</span></li>

@endcomponent

<div class="row invoice layout-top-spacing layout-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="doc-container">

            <div class="row">
                <div class="col-xl-12">
                    @include('backend.partials._errors')
                    <div class="invoice-content">

                        <form id="form" name="po" action="{{ route('dashboard.customer-order-supply.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="invoice-detail-body">
                                <input type="hidden" name="opration_id" value="{{ $operation }}">
                                @include('backend.sales.customerOrderSuplly.form')
                                <hr>
                                <div class="form-group text-center ">
                                    <button class="btn btn-primary btn-l" type="submit"> @lang('site.save')</button>
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
@include('backend.sales.customerOrderSuplly.validate')
@include('backend.sales.customerOrderSuplly.script')

@endpush
