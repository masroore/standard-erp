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
<li class="breadcrumb-item active" aria-current="page"><span>  @lang('site.supplier_profile')</span></li>

@endcomponent

<div class="row ">
    <div id="flFormsGrid" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4> @lang('site.supplier_profile') </h4>
                    </div>
                </div>
            </div>
            <div class="p-3">
            <div class="row">
                <div class="col-md-6">
                    <div class=" mb-4 widget-content widget-content-area p-3">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>@lang('site.main_info')</h4> <br>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.company_name')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8"><p class="h5">{{ $row->company_name }}</p></div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.opening_balance')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8"><p class="h5">{{ $row->opening_balance }}</p></div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.status')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">
                                    @if ($row->is_active == 1)
                                    <span class="badge badge-success"> @lang('site.active') <i class="fa fa-check" aria-hidden="true"></i> </span>
                                    @else
                                    <span class="badge badge-danger">  @lang('site.inactive') <i class="fa fa-times" aria-hidden="true"></i> </span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4 widget-content widget-content-area p-3">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>@lang('site.contact_info')</h4> <br>

                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.contact_person')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->contact_person }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.email')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->email }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.phone')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->phone }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.mobile')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->mobile }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.fax')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->fax }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4 widget-content widget-content-area p-3">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>@lang('site.address_info')</h4> <br>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3">@lang('site.country')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">
                                    @if ($row->country_code != null)
                                        {{ $row->country->country_enName }}
                                    @else
                                        __
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3">@lang('site.city')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->city }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.address')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->address }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.longitude')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->longitude }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.latitude')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->latitude }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4 widget-content widget-content-area p-3">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>@lang('site.tax_info')</h4> <br>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.tax_id')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->tax_id }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.tax_file_num')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->tax_file_number }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" >@lang('site.cr_id')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->cr_id }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">@lang('site.id_for_orginaztion')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->id_for_orginaztion }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">@lang('site.taxs_ofice')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->tax_office }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-row mb-4 widget-content widget-content-area p-3">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>@lang('site.media_info')</h4> <br>
                        </div>
                        @if ($row->photo != null)
                        <div class="col-md-12 mt-3">
                            <img width="100%" src="{{asset('public/uploads/suppliers/photos/'.$row->photo)}}">
                        </div>
                        @endif
                        @if ($row->document != null)
                        <div class="col-md-12 mt-3">
                            <hr>
                            <br>
                            <label class=""> @lang('site.document') : </label>
                           <a class="btn btn-primary" href="{{ asset('public/uploads/suppliers/documents/'.$row->document) }}" download="">@lang('site.download')</a>

                        </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4 widget-content widget-content-area p-3">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>@lang('site.social_media')</h4> <br>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.website')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->website }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.facbook')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->facbook }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" >@lang('site.linkedin')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->linkedin }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3">@lang('site.twitter')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5">{{ $row->twitter }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3">@lang('site.location_on_map')</label>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                <p class="h5 text-wrap" style="overflow:scroll">{{ $row->location_on_map }}</p>
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


