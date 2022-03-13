@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
       @lang('site.show_purchase_operation')
@endsection
 @section('modelTitlie')
 @lang('site.purchase_operations')
 @endsection
@section('content')

@component('backend.partials._pagebar')

    <li class="breadcrumb-item"><a href="{{ route('dashboard.purchase-operations.index') }}">  @lang('site.purchase_operations')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.show_purchase_operation')</span></li>

@endcomponent
<div class="row">
    <div class="col-md-4">
        <div class="statbox widget box box-shadow p-3">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4> @lang('site.operation_info')</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area split-buttons p-3">

                <p> <span> @lang('site.status') </span>     :
                    {{ $row->is_created_inv == 1 ? 'Completed' : 'Open' }}
                </p>
                <p> <span> @lang('site.code') </span>       :  {{ $row->code }} </p>
                <p> <span> @lang('site.start_at') </span>   :  {{ $row->start_at }} </p>
                <p> <span> @lang('site.end_at') </span>     :  {{ $row->end_at }} </p>
                <p> <span> @lang('site.created_by') </span> :   {{ $row->user->name ?? '----' }} </p>


            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="row">
            <div id="timelineBasic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4> @lang('site.operation_status')</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area pb-1">
                        <div class="p-3">
                            <div class="timeline-line">

                                <div class="item-timeline">
                                    <p class="t-time">@lang('site.step') 1  </p>
                                    <div class="t-dot t-dot-success" data-original-title="" title="">
                                    </div>
                                    <div class="t-text">

                                        <p>@lang('site.opreation_was_created') <i class="fa fa-check text-success"></i></p>
                                        <p class="t-meta-time">{{ $row->created_at }} <br>

                                        </p>
                                    </div>
                                </div>


                                <div class="item-timeline">
                                    <p class="t-time">@lang('site.step') 2</p>
                                    @if($row->is_created_cust_po == 0)
                                        <div class="t-dot t-dot-danger" data-original-title="" title="">
                                        </div>
                                        <div class="t-text">

                                            <p>@lang('site.opreation_dont_have_cos')</p>
                                            <p class="t-meta-time">
                                                <form action="{{ route('dashboard.customer-order-supply.create') }}" method="GET">
                                                    <input type="hidden" name="operration_id" value="{{$row->id}}">
                                                <button type="submit"> @lang('site.create_now')</button>
                                                </form>
                                            </p>
                                        </div>
                                    @elseif ($row->is_created_cust_po == 1)
                                        <div class="t-dot t-dot-success" data-original-title="" title="">
                                        </div>
                                        <div class="t-text">

                                            <p>@lang('site.cust_order_supply_created') <i class="fa fa-check text-success"></i></p>
                                            @foreach ($row->custOrderSuplly as $custos )
                                            <p class="t-meta-time">{{$custos->created_at  }} <br>
                                                <a href="{{ route('dashboard.customer-order-supply.show',$custos->id ) }}">@lang('site.view') </a>
                                            </p>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>


                                <div class="item-timeline">
                                    <p class="t-time">@lang('site.step') 3 </p>
                                    @if($row->is_created_pr == 0)
                                        <div class="t-dot t-dot-danger" data-original-title="" title="">
                                        </div>
                                        <div class="t-text">

                                            <p>@lang('site.opreation_dont_have_pr')</p>
                                            <p class="t-meta-time">
                                                <form action="{{ route('dashboard.purchase-requisitions.create') }}" method="GET">
                                                    <input type="hidden" name="operration_id" value="{{$row->id}}">
                                                <button type="submit"> @lang('site.create_now')</button>
                                                </form>
                                            </p>
                                        </div>
                                    @elseif ($row->is_created_pr == 1)
                                        <div class="t-dot t-dot-success" data-original-title="" title="">
                                        </div>
                                        <div class="t-text">

                                            <p>@lang('site.pr_created') <i class="fa fa-check text-success"></i></p>
                                            @foreach ($row->purchRequet as $pur )
                                            <p class="t-meta-time">{{$pur->created_at  }} <br>
                                                <a href="{{ route('dashboard.purchase-requisitions.show',$pur->id ) }}">@lang('site.view') </a>
                                            </p>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>


                                <div class="item-timeline">
                                    <p class="t-time">@lang('site.step') 4 </p>
                                    @if($row->is_created_po == 0)
                                        <div class="t-dot t-dot-danger" data-original-title="" title="">
                                        </div>
                                        <div class="t-text">

                                            <p>@lang('site.opreation_dont_have_po')</p>
                                            <p class="t-meta-time">
                                                <form action="{{ route('dashboard.purchase-orders.create') }}" method="GET">
                                                    <input type="hidden" name="operration_id" value="{{$row->id}}">
                                                <button type="submit"> @lang('site.create_now')</button>
                                                </form>
                                            </p>
                                        </div>
                                    @elseif ($row->is_created_po == 1)
                                        <div class="t-dot t-dot-success" data-original-title="" title="">
                                        </div>
                                        <div class="t-text">

                                            <p>@lang('site.po_created') <i class="fa fa-check text-success"></i></p>
                                            @foreach ($row->purchPo as $po )
                                            <p class="t-meta-time">{{$po->created_at  }} <br>
                                                <a href="{{ route('dashboard.purchase-orders.show',$po->id ) }}">@lang('site.view') </a>
                                            </p>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>


                                <div class="item-timeline">
                                    <p class="t-time">@lang('site.step') 5 </p>
                                    @if($row->is_created_receive == 0)
                                        <div class="t-dot t-dot-danger" data-original-title="" title="">
                                        </div>
                                        <div class="t-text">

                                            <p>@lang('site.opreation_dont_have_receive')</p>
                                            <p class="t-meta-time">
                                                <form action="{{ route('dashboard.receives.create') }}" method="GET">
                                                    <input type="hidden" name="operration_id" value="{{$row->id}}">
                                                <button type="submit"> @lang('site.create_now')</button>
                                                </form>
                                            </p>
                                        </div>
                                    @elseif ($row->is_created_receive == 1)
                                        <div class="t-dot t-dot-success" data-original-title="" title="">
                                        </div>
                                        <div class="t-text">

                                            <p>@lang('site.receives_created') <i class="fa fa-check text-success"></i></p>
                                            @foreach ($row->opReceive as $receive )
                                            <p class="t-meta-time">{{$receive->created_at  }} <br>
                                                <a href="{{ route('dashboard.receives.show',$receive->id ) }}">@lang('site.view') </a>
                                            </p>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>

                                <div class="item-timeline">
                                    <p class="t-time">@lang('site.step') 6 </p>
                                    @if($row->is_created_inv == 0)
                                        <div class="t-dot t-dot-danger" data-original-title="" title="">
                                        </div>
                                        <div class="t-text">

                                            <p>@lang('site.opreation_dont_have_inv')</p>
                                            <p class="t-meta-time">
                                                <form action="{{ route('dashboard.purchases.create') }}" method="GET">
                                                    <input type="hidden" name="operration_id" value="{{$row->id}}">
                                                <button type="submit"> @lang('site.create_now')</button>
                                                </form>
                                            </p>
                                        </div>
                                    @elseif ($row->is_created_inv == 1)
                                        <div class="t-dot t-dot-success" data-original-title="" title="">
                                        </div>
                                        <div class="t-text">

                                            <p>@lang('site.inv_created') <i class="fa fa-check text-success"></i></p>
                                            @foreach ($row->opInvoice as $inv )
                                            <p class="t-meta-time">{{$inv->created_at  }} <br>
                                                <a href="{{ route('dashboard.purchases.show',$inv->id ) }}">@lang('site.view') </a>
                                            </p>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>



                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('css')
<link href="{{ asset('public/backend/crock/assets/css/components/timeline/custom-timeline.css') }}" rel="stylesheet" type="text/css" />
@endpush


