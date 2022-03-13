@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
       @lang('site.edit_receive')
@endsection
@section('modelTitlie')
 @lang('site.receives')
@endsection
@section('content')

@component('backend.partials._pagebar')

    <li class="breadcrumb-item"><a href="{{ route('dashboard.receives.index') }}">  @lang('site.receives_list')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.edit_receive')</span></li>

@endcomponent

<div class="row invoice layout-top-spacing layout-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="doc-container">

            <div class="row">
                <div class="col-xl-12">
                    @include('backend.partials._errors')
                    <div class="invoice-content">

                        <form id="form" name="receives" action="{{ route('dashboard.receives.update',$row->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="invoice-detail-body">
                                @include('backend.purchases.receives.editform')
                                <hr>
                                <div class="form-group text-center ">
                                    <button class="btn btn-primary btn-l" type="submit"> @lang('site.update') @lang('site.receive')</button>
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
{{-- <script src="{{asset('public/backend/crock/assets/js/apps/add_purchase.js') }}"></script> --}}
@include('backend.purchases.receives.validate')
@include('backend.purchases.receives.script')

@endpush
