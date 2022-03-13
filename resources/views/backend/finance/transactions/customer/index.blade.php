@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
    @lang('site.customer-payment')
@endsection
 @section('modelTitlie')
        @lang('site.transactions')
 @endsection
@section('content')

@component('backend.partials._pagebar')

<li class="breadcrumb-item"><a href="javascript:void(0);">  @lang('site.transactions')</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>  @lang('site.customer-payment')</span></li>

@endcomponent

@include('backend.partials._errors')

@include('backend.finance.transactions.customer.create')

<div class="row layout-top-spacing" id="cancel-row">

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> @lang('site.code') </th>
                        <th> @lang('site.ref') </th>
                        <th> @lang('site.date')</th>
                        <th> @lang('site.amount')</th>
                        <th> @lang('site.pay_type')</th>
                        <th> @lang('site.customer')</th>
                        <th> @lang('site.notes')</th>
                        <th class="no-content"> @lang('site.actions')</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($rows as $key => $row)


                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                <p class="align-self-center mb-0 ">{{ $row->code }} </p>
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                <p class="align-self-center mb-0"> {{ $row->ref }}</p>
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                <p class="align-self-center mb-0">{{ $row->created_at }}</p>
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                <p class="align-self-center mb-0 ">{{ $row->amount }} </p>
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                <p class="align-self-center mb-0"> {{ $row->paying_method }}</p>
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                <p class="align-self-center mb-0"> {{ $row->customer->company_name ?? '' }}</p>
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                <p class="align-self-center mb-0"> {{ $row->notes }}</p>
                            </div>
                        </td>

                        <td>

                              {{-- handel edit   --}}

                              @include('backend.finance.transactions.customer.edit')


                              {{-- end of edit --}}
                                <form action="" method="POST" style="display:inline-block">
                                    @csrf
                                 @method('delete')
                                <button type="submit" class="mr-2 btn btn-danger show_confirm" title="@lang('site.delete')"><i class="fa fa-trash" aria-hidden="true"></i></button>
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

    $('.option-visible').hide();
    $('.transfare').hide();
    $('.check').hide();

    $(document).on('change keyup blur','#pay-mthod',function(){

        payValue   = $('#pay-mthod').val();

        if(payValue == 'check') {
            $('.option-visible').show();
            $('.check').show();
            $('.transfare').hide();
        }else if(payValue == 'transfare'){
            $('.option-visible').show();
            $('.check').hide();
            $('.transfare').show();
        }else{
            $('.option-visible').hide();
            $('.transfare').hide();
            $('.check').hide();
        }

       // cash transfare alert(payValue);

    }); // end of handel change qty and item

</script>

<script type="text/javascript">
    var ss = $(".basic").select2({
         tags: true,
         dropdownParent: $("#exampleModal"),
     });
</script>


@endpush

