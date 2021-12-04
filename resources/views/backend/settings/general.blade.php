@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp
@section('title')
   @lang('site.'. $routeName .'')
@endsection

@section('modelTitlie')
@lang('site.'. $routeName .'')
@endsection

@section('content')

@component('backend.partials._pagebar')

    <li class="breadcrumb-item"><a href="">  @lang('site.'. $routeName .'')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.general')</span></li>

@endcomponent

    <div class="row">
        <div class="col-lg-12 col-12 layout-spacing ">
            <div class="statbox widget box box-shadow p-3">
                <div class="col-md-12">
                    <div class="tile mb-4">
                <form action="{{ route('dashboard.settings.store') }}" method="POST">
                    @csrf
                    @method('post')

                    @include('backend.partials._errors')

                @php
                    $settings = ['company_name', 'company_address', 'company_email','company_phone'];
                @endphp
                <div class="row">
                @foreach($settings  as $setting)
                {{-- link --}}

                <div class="form-group col-md-6">
                    <label class="text-capitalize">  @lang('site.'. $setting .'') </label>
                    <input type="text" name="{{ $setting }}" class="form-control" value="{{ setting($setting)}}">
                </div>



                @endforeach
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.save')</button>
                </div>
            </form>
            </div>{{-- end of tile  --}}

        </div>{{-- end of col 12 --}}
            </div>
        </div>
    </div>{{-- end of row --}}

@endsection
