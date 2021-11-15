@extends('layouts.dashboard.app')

@php $lang =  LaravelLocalization::getCurrentLocale(); @endphp

@section('title') @lang('site.create account') @endsection

@section('modelTitlie') @lang('site.accounts') @endsection

@section('content')

@component('backend.partials._pagebar')

    <li class="breadcrumb-item"><a href="{{ route('dashboard.'. $routeName .'.index') }}">@lang('site.accounts') </a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.create account')</span></li>

@endcomponent



<div class="row ">
    <div id="flFormsGrid" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>{{$lang == 'ar' ? 'الرجاء ادخال البيانات الاتية' : 'Please Fill User Data '}}</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area p-3">
                <form action="{{ route('dashboard.'. $routeName .'.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                    @csrf
                    @include('backend.partials._errors')
                    <div class="form-group col-md-6">
                        <label>@lang('site.account type')</label>
                        <select class="form-control nested select2" name="cat_id" >

                            @foreach ($cats as $cat)
                                <option value="{{ $cat->id }}">{{$lang == 'ar' ? $cat->title_ar: $cat->title_en}}</option>

                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>@lang('site.parent account')</label>
                        <select class="form-control nested select2" name="parent_id" >
                           
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                                @foreach ($category->childrenCategories as $childCategory)
                                    @include('backend.finance.accounts.child_account', ['child_category' => $childCategory])
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>@lang('site.name arabic')</label>
                        <input  type="text" name="title_ar"  class="form-control" required>

                    </div>

                    <div class="form-group col-md-6">
                        <label>@lang('site.name english')</label>
                        <input type="text" name="title_en"  class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>@lang('site.start amount')</label>
                        <input type="number" name="start_amount"  class="form-control" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>@lang('site.description')</label>
                        <textarea class="form-control" name="description"  rows="3"></textarea>

                    </div>
                    <button type="submit" class="btn btn-primary mt-3">{{$lang == 'ar' ? ' حفظ ' : 'Save  '}}</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>




@endsection



@push('css')
    <style>
        .select2-dropdown{
            z-index:1050 !important;
        }
    </style>
@endpush

@push('js')
<script type="text/javascript">
    $(".nested").select2({
        tags: true
    });
</script>
@endpush




