@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
       @lang('site.create_purchase_requisitions')
@endsection
@section('modelTitlie')
 @lang('site.purchase_requisitions')
@endsection
@section('content')

@component('backend.partials._pagebar')

    <li class="breadcrumb-item"><a href="{{ route('dashboard.purchase-requisitions.index') }}">  @lang('site.all_purchase_requisitions')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.add_purchase_requisitions')</span></li>

@endcomponent

<div class="row invoice layout-top-spacing layout-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="doc-container">

            <div class="row">
                <div class="col-xl-12">
                    @include('backend.partials._errors')
                    <div class="invoice-content">

                        <form id="form" name="requisitions" action="{{ route('dashboard.purchase-requisitions.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="invoice-detail-body">
                                <input type="hidden" name="opration_id" value="{{ $operation }}">
                                @include('backend.purchases.requisitions.form')
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
@include('backend.purchases.requisitions.validate')
@include('backend.purchases.requisitions.script')

@endpush
