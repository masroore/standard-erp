@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
       @lang('site.customers')
@endsection
@section('modelTitlie')
    @lang('site.customers')
 @endsection
@section('content')

@component('backend.partials._pagebar')

<li class="breadcrumb-item"><a href="{{route('dashboard.customers.index')}}">  @lang('site.customers')</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>  @lang('site.customer_profile')</span></li>

@endcomponent

<div class="row ">
    <div id="flFormsGrid" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4> @lang('site.add_new_customer') !!</h4>
                    </div>
                </div>
            </div>
            <div class= "p-3">


            <div class="row">
                <div class="col-md-6">
                    <div class=" mb-4 widget-content widget-content-area p-3">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            {{-- <h4>@lang('site.contact_info')</h4> <br> --}}
                            <h4>@lang('site.main_info')</h4> <br>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.company_name')</label>
                            <input type="text" name="company_name" class="form-control col-md-8" value="{{ old('company_name', isset($row) ? $row->company_name : '')}}"  required>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.opening_balance')</label>
                            <input type="text" name="opening_balance" class="form-control col-md-8" value="{{ old('opening_balance', isset($row) ? $row->opening_balance : '')}}" >
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3">@lang('site.customer_group')</label>
                            <div class="col-md-8">
                                <select class="form-control nested select2 ml-2" name="group_id" >
                                    @foreach ($CustomerGroup as $group)
                                        <option value="{{ $group->id }}" {{(isset($row) && $row->group_id == $group->id) ? 'selected' : ''}}>{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.parent_company')</label>
                            <div class="col-md-8">
                            <select class="form-control nested select2" name="parent_id" >
                                @foreach ($parentCompanies as $parent)
                                    <option value="{{ $parent->id }}" {{(isset($row) && $row->parent_id == $parent->id) ? 'selected' : ''}}>{{$parent->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.status')</label>
                            <div class="form-check pl-0 col-md-8">
                                <div class="custom-control custom-checkbox checkbox-info">

                                    <input type="checkbox" name="is_active" {{  isset($row) && $row->is_active == 1 ? 'checked'  : ''}} value="1" class="custom-control-input" id="gridCheck">
                                    <label class="custom-control-label" for="gridCheck">@lang('site.active')</label>
                                </div>
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
                            <input type="text" name="name" class="form-control col-md-8" value="{{ old('name', isset($row) ? $row->name : '')}}"  required>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.email')</label>
                            <input type="email" name="email" value="{{ old('email', isset($row) ? $row->email : '')}}" class="form-control col-md-8">
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.phone')</label>
                            <input type="text" name="phone" class="form-control col-md-8" value="{{ old('phone', isset($row) ? $row->phone : '')}}" >
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.mobile')</label>
                            <input type="text" name="mobile" class="form-control col-md-8" value="{{ old('mobile', isset($row) ? $row->mobile : '')}}" >
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.fax')</label>
                            <input type="number" name="fax" class="form-control col-md-8" value="{{ old('fax', isset($row) ? $row->fax : '')}}" >
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
                            <div class="col-md-8">
                                <select class="form-control nested select2" name="country_code" >
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->country_code }}" {{ $country->country_code == 'EG' ? 'selected' : '' }} >{{$lang == 'ar' ? $country->country_arName: $country->country_enName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3">@lang('site.city')</label>
                            <input type="text" name="city" value="{{ old('city', isset($row) ? $row->city : '')}}" class="form-control col-md-8" >
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.address')</label>
                            <input type="text" name="address" value="{{ old('address', isset($row) ? $row->address : '')}}" class="form-control col-md-8" >
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.longitude')</label>
                            <input type="text" name="longitude" value="{{ old('longitude', isset($row) ? $row->longitude : '')}}" class="form-control col-md-8" >
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.latitude')</label>
                            <input type="text" name="latitude" value="{{ old('latitude', isset($row) ? $row->latitude : '')}}" class="form-control col-md-8" >
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
                            <input type="text" name="tax_id" class="form-control col-md-8" value="{{ old('tax_id', isset($row) ? $row->tax_id : '')}}"  required>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.tax_file_num')</label>
                            <input type="text" name="tax_file_number" class="form-control col-md-8" value="{{ old('tax_file_number', isset($row) ? $row->tax_file_number : '')}}"  required>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" >@lang('site.cr_id')</label>
                            <input type="text" name="cr_id" class="form-control col-md-8" value="{{ old('cr_id', isset($row) ? $row->cr_id : '')}}"  required>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">@lang('site.id_for_orginaztion')</label>
                            <input type="text" name="id_for_orginaztion" class="form-control col-md-8" value="{{ old('id_for_orginaztion', isset($row) ? $row->id_for_orginaztion : '')}}"  required>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">@lang('site.taxs_ofice')</label>
                            <input type="text" name="tax_office" class="form-control col-md-8" value="{{ old('tax_office', isset($row) ? $row->tax_office : '')}}"  required>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-row mb-4 widget-content widget-content-area p-3">
                        <div class="col-md-12 mt-3">
                            <div class="widget-content widget-content-area p-3" >
                                <div class="custom-file-container" data-upload-id="myFirstImage">
                                    <label>{{$lang == 'ar' ? '  رفع صورة للصنف' : ' Upload Item Photo'}} <a href="javascript:void(0)" class="custom-file-container__image-clear" title="@lang('site.cancel')">x</a></label>
                                    <label class="custom-file-container__custom-file" >
                                        <input type="file"  name="photo" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>

                                    @if (isset($row) && $row->photo != null)

                                    <div class="custom-file-container__image-preview" >

                                        <img width="70px" height="70px" src="{{asset('public/uploads/customers/photos/'.$row->photo)}}">
                                    </div>
                                @else
                                    <div class="custom-file-container__image-preview"></div>
                                @endif


                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <hr>
                            <label class=""> @lang('site.document')</label>
                            <input type="file" name="document" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4 widget-content widget-content-area p-3">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>@lang('site.social_media')</h4> <br>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.website')</label>
                            <input type="text" name="website" class="form-control col-md-8" value="{{ old('website', isset($row) ? $row->website : '')}}"  >
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">@lang('site.facbook')</label>
                            <input type="text" name="facbook" class="form-control col-md-8" value="{{ old('facbook', isset($row) ? $row->facbook : '')}}"  >
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" >@lang('site.linkedin')</label>
                            <input type="text" name="linkedin" class="form-control col-md-8" value="{{ old('linkedin', isset($row) ? $row->linkedin : '')}}"  >
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3">@lang('site.twitter')</label>
                            <input type="text" name="twitter" class="form-control col-md-8" value="{{ old('twitter', isset($row) ? $row->twitter : '')}}"  >
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">@lang('site.location_on_map')</label>
                            <input type="text" name="location_on_map" class="form-control col-md-8" value="{{ old('location_on_map', isset($row) ? $row->location_on_map : '')}}"  >
                        </div>
                    </div>
                </div>


            </div>


            </div>
        </div>
    </div>
</div>







@endsection

@push('js')
<script type="text/javascript">
    $(".nested").select2({
        tags: true
    });
</script>
@endpush

