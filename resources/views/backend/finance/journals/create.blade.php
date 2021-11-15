@extends('layouts.dashboard.app')

@php $lang =  LaravelLocalization::getCurrentLocale(); @endphp

@section('title') @lang('site.account list') @endsection

@section('modelTitlie') @lang('site.accounts') @endsection

@section('content')

@component('backend.partials._pagebar')

    <li class="breadcrumb-item"><a href="{{ route('dashboard.'. $routeName .'.index') }}">@lang('site.accounts') </a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.create journal')</span></li>

@endcomponent


  <!--  BEGIN CONTENT AREA  -->

  @include('backend.partials._errors')


        <div class=" invoice layout-top-spacing layout-spacing">
            <div class="invoice-content">

                <div class="invoice-detail-body">

                    <form action="{{ route('dashboard.'. $routeName .'.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                    <h3 class="text-center">  @lang('site.create journal') </h3>
                    <div class="invoice-detail-terms">

                        <div class="row justify-content-between">

                            <div class="col-md-3">

                                <div class="form-group mb-4">
                                    <label for="number">Invoice Number</label>
                                    <input type="text" class="form-control form-control-sm" name="ref" id="number" placeholder="#0001">
                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-group mb-4">
                                    <label for="date">Invoice Date</label>

                                    <input type="text" class="form-control form-control-sm" name="date" id="date" placeholder="Add date picker">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group mb-4">

                                    <input type="file" class="form-control form-control-sm" name="attachment" id="due" placeholder="None">
                                </div>

                            </div>




                        </div>

                    </div>


                    <div class="invoice-detail-items">

                        <div class="table-responsive">
                            <table class="table table-bordered item-table">
                                <thead>
                                    <tr>
                                        <th class=""></th>
                                        <th>@lang('site.select account')</th>
                                        <th class="">@lang('site.credit')</th>
                                        <th class="">@lang('site.debit')</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr >
                                    <div >
                                        <td class="delete-item-row">
                                            <ul class="table-controls">
                                                <li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>
                                            </ul>
                                        </td>

                                        <td class="description" >

                                            <select class="form-control  basic " name="account_id[]">
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                                                @foreach ($category->childrenCategories as $childCategory)
                                                    @include('backend.finance.journals.child_account', ['child_category' => $childCategory])
                                                @endforeach
                                            @endforeach

                                              </select>
                                        </td>

                                        <td class="rate">

                                            <input type="number" class="form-control form-control-sm" name="credit[]" placeholder="@lang('site.amount')">
                                        </td>
                                        <td class="text-right qty">
                                            <input type="number" class="form-control form-control-sm" name="debit[]" placeholder="@lang('site.amount')">
                                        </td>
                                    </div>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <button type="button" class="btn btn-secondary additem btn-sm">@lang('site.add item')</button>

                    </div>



                    <div class="invoice-detail-note">

                        <div class="row">

                            <div class="col-md-12 align-self-center">

                                <div class="form-group row invoice-note">
                                    <label for="invoice-detail-notes" class="col-sm-12 col-form-label col-form-label-sm">@lang('site.journal description')</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="details" id="invoice-detail-notes"  style="height: 88px;"></textarea>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="text-right m-5">
                        <button type="submit" class="btn btn-primary mb-2">Save</button>

                    </div>
                </form>

                </div>

            </div>
        </div>

<!--  END CONTENT AREA  -->


@endsection
@push('js')
@if ($lang == 'ar')
<script src="{{asset('public/backend/crock/rtl/assets/js/apps/journal.js') }}"></script>
@else
<script src="{{asset('public/backend/crock/assets/js/apps/journal.js') }}"></script>
@endif

<script>
    $(document).ready(function(){

        var html = '<tr>'+
            '<td class="delete-item-row">'+
                '<ul class="table-controls">'+
                    '<li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>'+
                '</ul>'+
                '</td>'+
                `<td class="description">
                    <select class="form-control  basic"  name="account_id[]">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                            @foreach ($category->childrenCategories as $childCategory)
                                @include('backend.finance.journals.child_account', ['child_category' => $childCategory])
                            @endforeach
                        @endforeach

                    </select>
                </td>`+
                '<td class="rate">'+
                    '<input type="number" class="form-control form-control-sm" name="credit[]" placeholder="@lang('site.amount')">'+
            ' </td>'+
                '<td class="text-right qty"><input type="number" class="form-control form-control-sm" name="debit[]" placeholder="@lang('site.amount')"></td>'+

                '</tr>';
        document.getElementsByClassName('additem')[0].addEventListener('click', function() {
            console.log('dfdf')

            getTableElement = document.querySelector('.item-table');
            currentIndex = getTableElement.rows.length;



            $(".item-table tbody").append(html);
            $('.basic').select2();
            deleteItemRow();

            });
    });
</script>


@endpush
