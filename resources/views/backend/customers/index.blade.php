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

<li class="breadcrumb-item"><a href="javascript:void(0);">  @lang('site.customers')</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>  @lang('site.customers_list')</span></li>

@endcomponent

<div class="row layout-top-spacing" id="cancel-row">
    <div class="col-md-5"></div>
    <div class="col-md-4 mb-3">
        <a href="{{route('dashboard.customers.create')}}" class="btn btn-primary center">@lang('site.add_customers')</a>
    </div>

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.company_name')</th>

                        {{-- <th>@lang('site.company_name')</th> --}}
                        <th>@lang('site.phone')</th>
                        <th>@lang('site.email')</th>
                        <th>@lang('site.balance')</th>
                        <th>@lang('site.status')</th>

                        <th class="no-content">@lang('site.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $key => $customer)


                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                @php
                                (isset($customer->photo))? $image =$customer->photo : $image ='public/uploads/customers/photos/default.png';
                                @endphp


                                <div class="d-flex">
                                    <div class="usr-img-frame mr-2 rounded-circle">
                                        @if($image)
                                        <img alt="avatar" class="img-fluid rounded-circle" src="{{asset('public/uploads/customers/photos/'.$image)}}">
                                        @else
                                        <img alt="avatar" class="img-fluid rounded-circle" src="{{asset('public/uploads/stores/items/product.png')}}">
                                        @endif

                                    </div>

                                </div>

                                <p class="align-self-center mb-0"> {{$customer->company_name}} </p>
                            </div>
                        </td>
                        
                        {{-- <td>{{$customer->company_name}}</td> --}}
                        <td>{{$customer->phone}}</td>
                        <td>{{$customer->email}}</td>
                        <td>{{$customer->opening_balance}}</td>
                        <td>
                            @if ($customer->is_active == 1)
                            <span class="badge badge-success"> @lang('site.active') <i class="fa fa-check" aria-hidden="true"></i> </span>
                            @else
                            <span class="badge badge-danger">  @lang('site.inactive') <i class="fa fa-times" aria-hidden="true"></i> </span>
                            @endif
                        </td>


                        <td>
                              <a href="{{route('dashboard.customers.show', $customer->id)}}" class="btn btn-info" title="@lang('site.show')"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                              <a href="{{route('dashboard.customer.contacts', $customer->id)}}" class="btn btn-success" title="@lang('site.contacts')"> <i class="fa fa-users" aria-hidden="true"></i></a>
                              <a href="{{route('dashboard.customers.edit', $customer->id)}}" class="btn btn-warning" title="@lang('site.edit')"> <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <form action="{{ route('dashboard.customers.destroy' , $customer->id) }}" method="post" style="display:inline-block">
                                    @csrf
                                    @method('delete')
                                <button type="submit" class="mr-2 btn btn-danger show_confirm" title="{{$lang == 'ar' ? 'حذف ' : 'Delete  '}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                              </form>
                        </td>
                    </tr>

                    @endforeach

                </tbody>

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
              title: @if($lang == 'ar') ` هل انت متأكد سوف يتم الحذف   !!` @else  `Are you sure you want to delete this customer ?` @endif,
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
