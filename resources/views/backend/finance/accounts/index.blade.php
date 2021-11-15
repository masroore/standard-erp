@extends('layouts.dashboard.app')

@php $lang =  LaravelLocalization::getCurrentLocale(); @endphp

@section('title') @lang('site.account list') @endsection

@section('modelTitlie') @lang('site.accounts') @endsection

@section('content')

@component('backend.partials._pagebar')

    <li class="breadcrumb-item"><a href="{{ route('dashboard.'. $routeName .'.index') }}">@lang('site.accounts') </a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.account list')</span></li>

@endcomponent


<div class="row layout-top-spacing">

    <div id="treeviewAnimated" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Animated</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area p-3">


                <ul class="file-tree">
                    @foreach ($categories  as $category)


                    <li class="file-tree-folder">{{ $lang == 'ar' ? $category->title_ar  : $category->title_en}}

                        @if(count($category->childrenCategories))
                        <ul>
                            @foreach ($category->childrenCategories as $childCategory)
                            @include('backend.finance.accounts.account_tree', ['child_category' => $childCategory])


                            @endforeach
                        </ul>
                        @endif


                    </li>

                    @endforeach
                </ul>



            </div>
        </div>
    </div>
</div>






@endsection




