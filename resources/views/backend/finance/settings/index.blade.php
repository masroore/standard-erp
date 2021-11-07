@extends('layouts.dashboard.app')

@php $lang =  LaravelLocalization::getCurrentLocale(); @endphp

@section('title') @lang('site.setting_list') @endsection

@section('modelTitlie') @lang('site.settings') @endsection

@section('content')

@component('backend.partials._pagebar')

    <li class="breadcrumb-item"><a href="{{ route('dashboard.'. $routeName .'.index') }}">@lang('site.settings') </a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.setting_list')</span></li>

@endcomponent




<div class="row ">
    <div id="flFormsGrid" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <form action="{{ route('dashboard.'. $routeName .'.update',1) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 row">
                        <div class="form-group col-md-6">

                        <h4>@lang('site.please_fill_setting_data')</h4>
                    </div>

                        <div class="form-group col-md-6 text-right">


                            <button type="submit" class="btn btn-primary mt-3">@lang('site.save')</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area p-3">
                    <div class="row">
                    @include('backend.partials._errors')


                    @foreach ($rows as $key => $item)
                        <input type="hidden" name="setting_id[]" value="{{$item->id}}">
                    <div class="form-group col-md-8 row m-auto">
                        <div class="form-group col-md-6">

                        <label>{{$words[$key]}}</label>

                        <select class="form-control  basic " name="account_id[]">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{($item->account_id == $category->id ) ? 'selected' : ''}}>
                                {{$lang == 'ar' ? $category->title_ar: $category->title_en}}
                            </option>
                            @foreach ($category->childrenCategories as $childCategory)
                                @include('backend.finance.settings.child_account', ['child_category' => $childCategory])
                            @endforeach
                        @endforeach

                          </select>
                        </div>

                          <div class="form-group col-md-4">
                            <label>@lang('site.account_key')</label>
                            <input  type="text" name="account_key[]" value="{{$item->account_key}}"  class="form-control" required>

                        </div>
                    </div>
                    @endforeach

                    <div class="form-group col-md-8 row m-auto">
                        <div class="form-group col-md-6">

                        <label>@lang('site.Supplier_master_account')</label>
                        <select class="form-control  basic " name="account_id[]">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                            @foreach ($category->childrenCategories as $childCategory)
                                @include('backend.finance.journals.child_account', ['child_category' => $childCategory])
                            @endforeach
                        @endforeach

                          </select>
                        </div>

                          <div class="form-group col-md-6">
                            <label>@lang('site.account_key')</label>
                            <input  type="text" name="account_key[]"   class="form-control" required>

                        </div>
                    </div>
                    <div class="form-group col-md-8 row m-auto">
                        <div class="form-group col-md-6">

                        <label>@lang('site.Sales_master_account')</label>
                        <select class="form-control  basic " name="account_id[]">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                            @foreach ($category->childrenCategories as $childCategory)
                                @include('backend.finance.journals.child_account', ['child_category' => $childCategory])
                            @endforeach
                        @endforeach

                          </select>
                        </div>

                          <div class="form-group col-md-6">
                            <label>@lang('site.account_key')</label>
                            <input  type="text" name="account_key[]"  class="form-control" required>

                        </div>
                    </div>
                    <div class="form-group col-md-8 row m-auto">
                        <div class="form-group col-md-6">

                        <label>@lang('site.Zero_sales_tax_main_account')</label>
                        <select class="form-control  basic " name="account_id[]">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                            @foreach ($category->childrenCategories as $childCategory)
                                @include('backend.finance.journals.child_account', ['child_category' => $childCategory])
                            @endforeach
                        @endforeach

                          </select>
                        </div>


                          <div class="form-group col-md-6">
                            <label>@lang('site.account_key')</label>
                            <input  type="text" name="account_key[]"  class="form-control" required>

                        </div>
                    </div>
                    <div class="form-group col-md-8 row m-auto">
                        <div class="form-group col-md-6">

                        <label>@lang('site.Purchases_master_account')</label>
                        <select class="form-control  basic " name="account_id[]">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                            @foreach ($category->childrenCategories as $childCategory)
                                @include('backend.finance.journals.child_account', ['child_category' => $childCategory])
                            @endforeach
                        @endforeach

                          </select>

                        </div>

                          <div class="form-group col-md-6">
                            <label>@lang('site.account_key')</label>
                            <input  type="text" name="account_key[]"  class="form-control" required>

                        </div>
                    </div>
                    <div class="form-group col-md-8 row m-auto">
                        <div class="form-group col-md-6">

                        <label>@lang('site.Calculation_of_cost_of_goods_sold')</label>
                        <select class="form-control  basic " name="account_id[]">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                            @foreach ($category->childrenCategories as $childCategory)
                                @include('backend.finance.journals.child_account', ['child_category' => $childCategory])
                            @endforeach
                        @endforeach

                          </select>
                        </div>

                          <div class="form-group col-md-6">
                            <label>@lang('site.account_key')</label>
                            <input  type="text" name="account_key[]"  class="form-control" required>

                        </div>
                    </div>
                    <div class="form-group col-md-8 row m-auto">
                        <div class="form-group col-md-6">

                        <label>@lang('site.Calculation_of_cost_of_services_sold')</label>
                        <select class="form-control  basic " name="account_id[]">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                            @foreach ($category->childrenCategories as $childCategory)
                                @include('backend.finance.journals.child_account', ['child_category' => $childCategory])
                            @endforeach
                        @endforeach

                          </select>

                        </div>

                          <div class="form-group col-md-6">
                            <label>@lang('site.account_key')</label>
                            <input  type="text" name="account_key[]"  class="form-control" required>

                        </div>
                    </div>
                    <div class="form-group col-md-8 row m-auto">
                        <div class="form-group col-md-6">

                        <label>@lang('site.Store_master_account')</label>
                        <select class="form-control  basic " name="account_id[]">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                            @foreach ($category->childrenCategories as $childCategory)
                                @include('backend.finance.journals.child_account', ['child_category' => $childCategory])
                            @endforeach
                        @endforeach

                          </select>
                        </div>


                          <div class="form-group col-md-6">
                            <label>@lang('site.account_key')</label>
                            <input  type="text" name="account_key[]"  class="form-control" required>

                        </div>
                    </div>
                    <div class="form-group col-md-8 row m-auto">
                        <div class="form-group col-md-6">

                        <label>@lang('site.Fund_master_account')</label>
                        <select class="form-control  basic " name="account_id[]">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                            @foreach ($category->childrenCategories as $childCategory)
                                @include('backend.finance.journals.child_account', ['child_category' => $childCategory])
                            @endforeach
                        @endforeach

                          </select>
                        </div>

                          <div class="form-group col-md-6">
                            <label>@lang('site.account_key')</label>
                            <input  type="text" name="account_key[]"  class="form-control" required>

                        </div>
                    </div>
                    <div class="form-group col-md-8 row m-auto">
                        <div class="form-group col-md-6">

                        <label>@lang('site.bad_debts_account')</label>
                        <select class="form-control  basic " name="account_id[]">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                            @foreach ($category->childrenCategories as $childCategory)
                                @include('backend.finance.journals.child_account', ['child_category' => $childCategory])
                            @endforeach
                        @endforeach

                          </select>
                        </div>

                          <div class="form-group col-md-6">
                            <label>@lang('site.account_key')</label>
                            <input  type="text" name="account_key[]"  class="form-control" required>

                        </div>
                    </div>
                    <div class="form-group col-md-8 row m-auto">
                        <div class="form-group col-md-6">

                        <label>@lang('site.Tax_main_account_(sales)')</label>
                        <select class="form-control  basic " name="account_id[]">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                            @foreach ($category->childrenCategories as $childCategory)
                                @include('backend.finance.journals.child_account', ['child_category' => $childCategory])
                            @endforeach
                        @endforeach

                          </select>
                        </div>

                          <div class="form-group col-md-6">
                            <label>@lang('site.account_key')</label>
                            <input  type="text" name="account_key[]"  class="form-control" required>

                        </div>
                    </div>
                    <div class="form-group col-md-8 row m-auto">
                        <div class="form-group col-md-6">

                        <label>@lang('site.Tax_main_account_(purchases)')</label>
                        <select class="form-control  basic " name="account_id[]">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                            @foreach ($category->childrenCategories as $childCategory)
                                @include('backend.finance.journals.child_account', ['child_category' => $childCategory])
                            @endforeach
                        @endforeach

                          </select>
                        </div>

                          <div class="form-group col-md-6">
                            <label>@lang('site.account_key')</label>
                            <input  type="text" name="account_key[]"  class="form-control" required>

                        </div>
                    </div>
                    <div class="form-group col-md-8 row m-auto">
                        <div class="form-group col-md-6">

                        <label>@lang('site.Bank_fees_and_account_fees')</label>
                        <select class="form-control  basic " name="account_id[]">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                            @foreach ($category->childrenCategories as $childCategory)
                                @include('backend.finance.journals.child_account', ['child_category' => $childCategory])
                            @endforeach
                        @endforeach

                          </select>
                        </div>

                          <div class="form-group col-md-6">
                            <label>@lang('site.account_key')</label>
                            <input  type="text" name="account_key[]"  class="form-control" required>

                        </div>
                    </div>





                    </div>

            </div>
        </form>

        </div>
    </div>
</div>


@endsection

