@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
       @lang('site.purchase_requisitions')
@endsection
 @section('modelTitlie')
 @lang('site.purchase_requisitions')
 @endsection
@section('content')

@component('backend.partials._pagebar')

    <li class="breadcrumb-item"><a href="javascript:void(0);">  @lang('site.purchase_requisitions')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.all_purchase_requisitions')</span></li>

@endcomponent


<div class="row layout-top-spacing" id="cancel-row">

    {{--  fillter data  --}}

    <div class="row">


        <div class="col-lg-12 col-12 layout-spacing p-3">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                            <h4>@lang('site.fillter_date')</h4>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6 col-6 pt-2">
                            <a href="{{ route('dashboard.purchase-requisitions.create') }}" class="btn btn-primary float-right mr-5"> <i class="fa fa-plus" aria-hidden="true"></i> @lang('site.add_new') </a>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area p-3">
                   <form>
                    <div class="row">

                        <div class="form-group col mb-0">
                            <label for="date">@lang('site.from_date')</label>
                            <input id="basicFlatpickr" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date..">
                        </div>
                        <div class="form-group col mb-0">
                            <label for="date">@lang('site.to_date')</label>
                            <input id="basicFlatpickr2"  class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date..">
                        </div>

                    </div>

                        <button class="btn btn-primary" type="submit" >@lang('site.show') </button>
                    </form>

                </div>
            </div>
        </div>

    {{-- show data  --}}

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.code')</th>
                        <th>@lang('site.created_at')</th>
                        <th>@lang('site.item_count')</th>
                        <th>@lang('site.total_qty')</th>

                        <th class="no-content text-center">@lang('site.actions')</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($rows as $key => $row)


                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name"> {{$row->reference_no}} </p>
                            </div>
                        </td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name"> {{$row->date}} </p>
                            </div>
                        </td>



                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name"> {{$row->item_counts}} </p>
                            </div>
                        </td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">

                                <p class="align-self-center mb-0 admin-name"> {{$row->total_qty}} </p>
                            </div>
                        </td>



                        <td class="text-center">
                            <a href="{{ route('dashboard.purchase-requisitions.offer-price-request',$row->id ) }}" class="mr-2 btn btn-info btn-sm" title="@lang('site.offer_price_request')"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{ route('dashboard.purchase-requisitions.show',$row->id ) }}" class="mr-2 btn btn-info btn-sm" title="@lang('site.show')"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{ route('dashboard.purchase-requisitions.edit',$row->id ) }}" class="mr-2 btn btn-warning btn-sm" title="@lang('site.edit')"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="{{ asset('public/uploads/purchases/requisitions/'.$row->document) }}" class="mr-2 btn btn-primary btn-sm" title="@lang('site.download')" download=""><i class="fa fa-file" aria-hidden="true"></i><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                            <form action="{{route('dashboard.purchase-requisitions.destroy', $row->id)}}" method="POST" style="display:inline-block">
                                @csrf
                                @method('delete')
                            <button type="submit" class="mr-2 btn btn-danger btn-sm show_confirm" title="@lang('site.delete')"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
@endpush

