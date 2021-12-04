@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp
 

@section('title')
        @lang('site.add_quotation')
@endsection

@section('modelTitlie')
 @lang('site.quotations')
@endsection

@section('content')
@component('backend.partials._pagebar')

    <li class="breadcrumb-item"><a href="{{ route('dashboard.quotations.index') }}">  @lang('site.quotations')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.add_quotation')</span></li>

@endcomponent

<div class="row invoice layout-top-spacing layout-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="doc-container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="invoice-content">
                        <form action="{{ route('dashboard.quotations.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="invoice-detail-body">
                                @include('backend.sales.quotations.form')
                                <hr>
                                <div class="form-group text-center ">
                                    <button class="btn btn-primary btn-l" type="submit"> @lang('site.save') @lang('site.quotation')</button>
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

@push('js')
<script src="{{asset('public/backend/crock/assets/js/apps/invoice-add-sales.js') }}"></script>
@endpush
