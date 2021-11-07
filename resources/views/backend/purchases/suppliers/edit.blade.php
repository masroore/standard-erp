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
<li class="breadcrumb-item active" aria-current="page"><span>  @lang('site.edit_supplier')</span></li>

@endcomponent


<div class="row ">
    <div id="flFormsGrid" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4> @lang('site.edit_supplier') !!</h4>
                    </div>
                </div>
            </div>
            <div class= "p-3">
                <form action="{{ route('dashboard.suppliers.update', $row->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    @include('backend.partials._errors')
                    @include('backend.purchases.suppliers.form')

                    <button type="submit" class="btn btn-primary mt-3">@lang('site.update')</button>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

<script>
    //First upload
    var firstUpload = new FileUploadWithPreview('myFirstImage')
    //Second upload
    var secondUpload = new FileUploadWithPreview('mySecondImage')
</script>

@endpush
