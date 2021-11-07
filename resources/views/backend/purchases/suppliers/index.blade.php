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

<li class="breadcrumb-item"><a href="javascript:void(0);">  @lang('site.suppliers')</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>  @lang('site.suppliers_list')</span></li>

@endcomponent

<div class="row layout-top-spacing" id="cancel-row">
    <div class="col-md-5"></div>
    <div class="col-md-2">
        <a href="{{route('dashboard.suppliers.create')}}" class="btn btn-primary center">@lang('site.add_supplier')</a>
    </div>

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.company_name')</th>
                        <th>@lang('site.contact_person')</th>
                        <th>@lang('site.phone')</th>
                        <th>@lang('site.email')</th>
                        <th>@lang('site.status')</th>
                        <th class="no-content">{{$lang == 'ar' ? 'اجراءت' : ' Actions '}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $key => $supplier)


                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0"> {{$supplier->company_name}} </p>
                            </div>
                        </td>
                        <td>{{$supplier->contact_person}}</td>
                        <td>{{$supplier->phone}}</td>
                        <td>{{$supplier->email}}</td>
                        <td>
                            @if ($supplier->is_active == 1)
                            <span class="badge badge-success"> @lang('site.active') <i class="fa fa-check" aria-hidden="true"></i> </span>
                            @else
                            <span class="badge badge-danger">  @lang('site.inactive') <i class="fa fa-times" aria-hidden="true"></i> </span>
                            @endif
                        </td>

                        <td>
                              <a href="{{route('dashboard.suppliers.show', $supplier->id)}}" class="btn btn-info" title="@lang('site.show')"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                              <a href="{{route('dashboard.suppliers.edit', $supplier->id)}}" class="btn btn-warning" title="@lang('site.edit')"> <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <form action="{{ route('dashboard.suppliers.destroy' , $supplier->id) }}" method="post" style="display:inline-block">
                                    @csrf
                                    @method('delete')
                                <button type="submit" class="mr-2 btn btn-danger show_confirm" title="{{$lang == 'ar' ? 'حذف ' : 'Delete  '}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                              </form>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>

                        <th>{{$lang == 'ar' ? 'الاسم' : ' Name '}}</th>
                        <th>{{$lang == 'ar' ? 'التليفون' : ' Phone '}}</th>
                        <th>{{$lang == 'ar' ? 'البريد الالكتروني' : ' Email '}}</th>
                        <th>{{$lang == 'ar' ? 'الحالة' : ' Status '}}</th>

                        <th class="no-content">{{$lang == 'ar' ? 'اجراءت' : ' Actions '}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>


@endsection

@push('js')


<script type="text/javascript">

     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: @if($lang == 'ar') ` هل انت متأكد سوف يتم الحذف   !!` @else  `Are you sure you want to delete this supplier ?` @endif,
              text:  @if($lang == 'ar') "اذا قمت بحذف هذا المورد لم تتمكن من استعادته مره اخري" @else  "If you delete this, it will be gone forever." @endif,
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



@endpush

