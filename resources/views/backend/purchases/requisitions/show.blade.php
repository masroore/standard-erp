@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp


@section('title')
        @lang('site.show_purchase_requisitions')
@endsection

@section('modelTitlie')
 @lang('site.purchase_requisitions')
@endsection

@section('content')
@component('backend.partials._pagebar')

    <li class="breadcrumb-item"><a href="{{ route('dashboard.purchase-requisitions.index') }}">  @lang('site.all_purchase_requisitions')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.show_purchase_nvoice')</span></li>


@endcomponent

<div class="row container">

    <button class="btn btn-primary mr-2"  onclick="printDiv()"><i class="fa fa-print"></i> print</button>
    <button class="btn btn-primary mr-2"><i class="fa fa-file"></i> PDF</button>
    <a href="{{ asset('public/uploads/purchases/requisitions/'.$row->document) }}" class="btn btn-primary mr-2" title="" download=""><i class="fa fa-arrow-down" aria-hidden="true"></i>@lang('site.download_document')</a>
</div>

<div class="row invoice layout-top-spacing layout-spacing" id="print">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="doc-container">

            <div class="row" >

                <div class="col-xl-12">

                    <div class="invoice-container">
                        <div class="invoice-inbox">

                            <div id="ct" class="">

                                <div class="invoice-00001">
                                    <div class="content-section">

                                        <div class="inv--head-section inv--detail-section">

                                            <div class="row">

                                                <div class="col-sm-6 col-12 mr-auto">
                                                    <div class="d-flex">
                                                        <img class="company-logo" src="{{ asset('public/backend/crock/assets/img/cork-logo.png') }}" alt="company">
                                                        <h3 class="in-heading align-self-center">{{ setting('company_name') }}.</h3>

                                                    </div>

                                                </div>

                                                <div class="col-sm-6 text-sm-right ">
                                                    <p class="align-self-center"><span class="align-self-center"> @lang('site.code') : </span> <span class="">{{ $row->reference_no }}</span> </p>

                                                    <p class="align-self-center"><span class="align-self-center"> @lang('site.date') : </span> <span class="">{{ $row->date }}</span> </p>
                                                    <p> <span>@lang('site.created_by') : {{ $row->user->name }}</span> </p>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="inv--detail-section inv--customer-detail-section">



                                        </div>

                                        <div class="inv--product-table-section">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="">
                                                        <tr>
                                                            <th >#</th>
                                                            <th scope="col">@lang('site.item')</th>
                                                            <th scope="col">@lang('site.unit')</th>
                                                            <th scope="col">@lang('site.qty')</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($row->items as $index => $item)
                                                        <tr>
                                                            <td>{{ $index+1 }}</td>
                                                            <td>{{ $lang == 'ar' ? $item->item->title_ar : $item->item->title_en}}</td>
                                                            <td>{{ $item->unit->unit_name}}</td>
                                                            <td>{{ $item-> qunatity}}</td>
                                                        </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="inv--total-amounts">

                                            <div class="row mt-4">
                                                <div class="col-sm-5 col-12 order-sm-0 order-1">
                                                </div>
                                                <div class="col-sm-7 col-12 order-sm-1 order-0">
                                                    <div class="text-sm-right">
                                                        <div class="row">


                                                            <div class="col-sm-8 col-7">
                                                                <p class="">@lang('site.item_count') :  </p>
                                                            </div>
                                                            <div class="col-sm-4 col-5">
                                                                <p class="">{{ $row->item_counts }}</p>
                                                            </div>
                                                            <div class="col-sm-8 col-7">
                                                                <p class="">@lang('site.total_qty') :  </p>
                                                            </div>
                                                            <div class="col-sm-4 col-5">
                                                                <p class="">

                                                                {{ $row->total_qty }}
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        @if ($row->note != null)


                                        <div class="inv--note">

                                            <div class="row mt-4">
                                                <div class="col-sm-12 col-12 order-sm-0 order-1">
                                                    <p>@lang('site.notes') :<br>
                                                         {{ $row->note }}.</p>
                                                </div>
                                            </div>

                                        </div>

                                        @endif

                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>

                </div>

                {{-- <div class="col-xl-3">

                    <div class="invoice-actions-btn">

                        <div class="invoice-action-btn">

                            <div class="row">
                                <div class="col-xl-12 col-md-3 col-sm-6">
                                    <a href="javascript:void(0);" class="btn btn-primary btn-send">Send Invoice</a>
                                </div>
                                <div class="col-xl-12 col-md-3 col-sm-6">
                                    <a href="javascript:void(0);" class="btn btn-secondary btn-print  action-print">Print</a>
                                </div>
                                <div class="col-xl-12 col-md-3 col-sm-6">
                                    <a href="javascript:void(0);" class="btn btn-success btn-download">Download</a>
                                </div>
                                <div class="col-xl-12 col-md-3 col-sm-6">
                                    <a href="apps_invoice-edit.html" class="btn btn-dark btn-edit">Edit</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div> --}}


            </div>


        </div>

    </div>
</div>

@endsection

 @push('css')

 <link href="{{ asset('public/backend/crock/assets/css/apps/invoice-preview.css') }}" rel="stylesheet" type="text/css" />

 @endpush

 @push('js')

 <script src="{{ asset('public/backend/crock/assets/js/apps/invoice-preview.js') }}"></script>

<script type="text/javascript">
  function printDiv() {
      var printContents = document.getElementById('print').innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
      location.reload();
  }

</script>

@endpush