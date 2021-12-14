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
                    <div class="col-md-9">
                        <nav class="breadcrumb-one p-3" aria-label="breadcrumb">


                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);"> @lang('site.products')</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.list_product')</span></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-3 p-3">
                        <a  href="{{route('dashboard.items.create')}}" class="btn btn-primary float-right">@lang('site.add_product') </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('backend.partials._errors')



<form action="" method="get">
    <div class="row  layout-spacing container flex">
        <div class="col-md-2">
            <label> @lang('site.title') </label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="col-md-2">
            <label> @lang('site.code') </label>
            <input type="text" name="code" class="form-control">
        </div>
        <div class="col-md-2">
            <label> @lang('site.title') </label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="col-md-2">
            <label> @lang('site.code') </label>
            <input type="text" name="code" class="form-control">
        </div>
        <div class="col-md-2">
            <label> @lang('site.title') </label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="col-md-2 mt-4">
            <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>

</form>

<div class="row layout-top-spacing" id="cancel-row">




    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{$lang == 'ar' ? 'الصورة' : '  Image '}}</th>
                        <th>{{$lang == 'ar' ? 'الكود' : ' Code '}}</th>
                        <th>{{$lang == 'ar' ? 'الاسم باللغة العربية' : ' Name Arabic '}}</th>
                        <th>{{$lang == 'ar' ? 'الاسم باللغة الانجليزية' : ' Name English '}}</th>
                        <th>{{$lang == 'ar' ? '  التصنيف ' : '   Category '}}</th>
                        <th>{{$lang == 'ar' ? '   العلامة التجارية' : '   Brand '}}</th>
                        <th class="no-content">{{$lang == 'ar' ? 'اجراءت' : ' Actions '}}</th>
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

                                <p class="align-self-center mb-0 admin-name"> {{$row->code}} </p>
                            </div>
                        </td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name"> {{$row->title_ar}} </p>
                            </div>
                        </td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name"> {{$row->title_en}} </p>
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name">

                                    @if ($row->cat_id != null)

                                    {{$lang == 'ar' ? $row->category->title_ar :  $row->category->title_en}}

                                    @else
                                    ____
                                    @endif
                                </p>
                            </div>
                        </td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name">

                                    @if ($row->brand_id != null)

                                    {{$lang == 'ar' ? $row->brand->title_ar :  $row->brand->title_en}}

                                    @else
                                    ____
                                    @endif
                                </p>
                            </div>
                        </td>

                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bd-example-modal-lg{{$row->id}}" title="{{$lang == 'ar' ? ' عرض' : ' Show '}}">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>


                            <a href="{{route('dashboard.items.edit', $row->id)}}" class="btn btn-warning" title="{{$lang == 'ar' ? ' تعديل' : ' Edit '}}"> <i class="fa fa-pencil" aria-hidden="true"></i></a>

                            <form action="{{route('dashboard.items.destroy', $row->id)}}" method="POST" style="display:inline-block">
                                @csrf
                                @method('delete')
                            <button type="submit" class="mr-2 btn btn-danger show_confirm" title="{{$lang == 'ar' ? 'حذف ' : 'Delete  '}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
</script>
@endpush




