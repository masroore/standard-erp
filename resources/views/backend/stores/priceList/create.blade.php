@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
@lang('site.add_new_price_list')
@endsection
 @section('modelTitlie')
 @lang('site.price_list')
 @endsection
@section('content')


<div class="row layout-top-spacing">
    <div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <nav class="breadcrumb-one p-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                        <li class="breadcrumb-item"><a href="{{route('dashboard.stores.priceList.index')}}">@lang('site.price_list')</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.add_price_list')</span></li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="row ">
    <div id="flFormsGrid" class="col-lg-8 layout-spacing m-auto" >
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('site.please_fill_price_list_data')</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area p-3">
                <form action="{{ route('dashboard.stores.priceList.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('backend.partials._errors')

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="">@lang('site.name')</label>
                            <input  type="text" name="name" placeholder="" class="form-control" required>

                        </div>
                        <div class="form-group col-md-8">
                            <label for="">@lang('site.description')</label>
                            <input  type="text" name="details" placeholder="" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <table id="zero-config" class="table dt-table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>

                                    <th>@lang('site.name')</th>
                                    <th>@lang('site.unit')</th>
                                    <th>@lang('site.price')</th>
                                    <th>@lang('site.custom_price')</th>

                                </tr>
                            </thead>
                            <tbody id="content-search">

                                @foreach ($stoItem as $key => $row)


                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td class="sorting_1 sorting_2">
                                        <div class="d-flex">
                                            <input  type="hidden" name="item_id[]" value="{{$row->id}}" placeholder="" class="form-control" >
                                            <p class="align-self-center mb-0 admin-name"> {{$lang == 'ar' ? $row->title_ar: $row->title_en}} </p>
                                        </div>
                                    </td>
                                    <td class="sorting_1 sorting_2">
                                        <div class="d-flex">
                                            <input  type="hidden" name="unit_id[]" value="{{$row->saleUnit->id}}" placeholder="" class="form-control" >
                                            <p class="align-self-center mb-0 admin-name">{{$row->saleUnit->unit_name}} </p>
                                        </div>
                                    </td>
                                    <td class="sorting_1 sorting_2">
                                        <div class="d-flex">

                                            <p class="align-self-center mb-0 admin-name"> {{$row->sale_price}} </p>
                                            <input  type="hidden" name="sale_price[]" value="{{$row->sale_price}}" placeholder="" class="form-control" >
                                        </div>
                                    </td>
                                    <td class="sorting_1 sorting_2">
                                        <div class="form-group">
                                            <input  type="text" name="custom_price[]" placeholder="" value="{{$row->sale_price}}" class="form-control" >
                                        </div>

                                    </td>

                                </tr>

                                @endforeach


                            </tbody>

                        </table>

                    </div>

                    <button type="submit" class="btn btn-primary mt-3">{{$lang == 'ar' ? ' حفظ ' : 'Save  '}}</button>
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

    $(document).ready(function(){
        $("#search").keyup(function(){

            var value =$(this).val();

                $.ajax({
                    type: 'get',

                    url: "{{ url('dashboard/'. $routeName .'/search/') }}"+'/'+value,

                    success: function (data) {
                        $('#content-search').html(data);

                        },

                    error: function(data_error, exception) {
                        if(exception == 'error'){
                            var error_list = '' ;
                            $.each(data_error.responseJSON.errors, function(index,v){
                                error_list += '<li>'+v+'</li>';
                            });
                            $('.alert-errors ul').html(error_list)
                        }

                    }



                });

        });
    });
    $(".nested").select2({
        tags: true
    });
</script>
@endpush





