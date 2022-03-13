@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
@lang('site.products')
@endsection
 @section('modelTitlie')
        @lang('site.products')
 @endsection
@section('content')


<div class="row layout-top-spacing">
    <div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <div class="row">
                    <div class="col-md-8">
                        <nav class="breadcrumb-one p-3" aria-label="breadcrumb">


                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);"> @lang('site.products')</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.list_product')</span></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-3 p-3">
                        <a  href="{{route('dashboard.stores.items.create')}}" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> @lang('site.add_product') </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('dashboard.stores.items.index') }}" method="get">

    <div class="row">
        <div class="col-md-3">
            <label> @lang('site.title_en') </label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="col-md-3">
            <label> @lang('site.code') </label>
            <input type="text" name="code" class="form-control">
        </div>

        <div class="col-md-3">
            <label> @lang('site.categories') </label>
            <select class="form-control  basic select2" name="cat_id" >
                <option value="">@lang('site.select_category')</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ isset($row) && $row->cat_id == $category->id ? 'selected'  : '' }}>{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                    @foreach ($category->childrenCategories as $childCategory)
                        @include('backend.stores.items.child_category', ['child_category' => $childCategory])
                    @endforeach
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label> @lang('site.brands') </label>
            <select class="form-control  basic select2" name="brand_id" >
                <option value="">@lang('site.select_brand')</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{isset($row) && $row->brand_id == $brand->id  ? 'selected' : ''}} >{{$lang == 'ar' ? $brand->title_ar: $brand->title_en}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-10">
            <label> @lang('site.tags') </label>
            <select  class="form-control tagging" multiple="multiple"  name="tags[]" >
                @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">{{  $tag->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2 mt-4 pt-2">
            <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> @lang('site.search') </button>
        </div>
    </div>

</form>

<div class="row layout-top-spacing" id="cancel-row">

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center mt-4">
            <div class="">
                <button class="btn-info btn btn-sm"><span>PDF</span></button>
                <a href="{{ route('dashboard.stores.export.items.excellsheet') }}" class="btn-info btn btn-sm"><span>Excel</span></a>
                <button class="btn-info btn btn-sm"><span>Print</span></button>
            </div>
        </div>
        <div class="widget-content widget-content-area br-6">

            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="no-content">@lang('site.photo')</th>
                        <th>@lang('site.title_en')</th>
                        <th>@lang('site.code')</th>
                        <th>@lang('site.category')</th>
                        <th>@lang('site.brand')</th>
                        <th>@lang('site.qty')</th>
                        <th class="no-content">@lang('site.actions')</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($rows as $key => $row)


                    <tr>
                        <td>{{$key+1}}</td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                <div class="usr-img-frame mr-2 rounded-circle">
                                    @if($row->image != null)
                                    <img alt="avatar" class="img-fluid rounded-circle" src="{{asset('public/uploads/stores/items/images/'. $row->image )}}">
                                    @else
                                    <img alt="avatar" class="img-fluid rounded-circle" src="{{asset('public/uploads/stores/items/product.png')}}">
                                    @endif

                                </div>

                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name"> {{$row->title_en}} </p>
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name"> {{$row->code}} </p>
                            </div>
                        </td>
                        {{-- <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name"> {{$row->title_ar}} </p>
                            </div>
                        </td> --}}


                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name">



                                    {{   $row->category->title_en ?? '___'}}


                                </p>
                            </div>
                        </td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name">



                                    {{$lang == 'ar' ? $row->brand->title_ar ?? 'بدون' :  $row->brand->title_en ?? 'No Brand'}}


                                </p>
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name">

                                    @foreach ($row->poductqty as $qty )
                                    {{  $qty->quantity  }}
                                    @endforeach


                                </p>
                            </div>
                        </td>

                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bd-example-modal-lg{{$row->id}}" title="@lang('site.show')">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>


                            <a href="{{route('dashboard.stores.items.edit', $row->id)}}" class="btn btn-warning btn-sm" title="@lang('site.edit')"> <i class="fa fa-pencil" aria-hidden="true"></i></a>

                            <form action="{{route('dashboard.stores.items.destroy', $row->id)}}" method="POST" style="display:inline-block">
                                @csrf
                                @method('delete')
                            <button type="submit" class="mr-2 btn btn-danger show_confirm btn-sm" title="@lang('site.delete')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>

                    @include('backend.stores.items.show')
                    @endforeach



                </tbody>

            </table>
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

     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: @if($lang == 'ar') ` هل انت متأكد سوف يتم الحذف   !!` @else  `Are you sure you want to delete this row ?` @endif,
              text:  @if($lang == 'ar') "اذا قمت بحذف هذا العنصر لم تتمكن من استعادته مره اخري" @else  "If you delete this, it will be gone forever." @endif,
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });

</script>

<script type="text/javascript">
    $(".nested").select2({
        tags: true
    });
    $(".tagging").select2({
    tags: true
    });
</script>
@endpush




