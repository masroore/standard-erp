@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
       @lang('site.sales_invoices_payments')
@endsection
 @section('modelTitlie')
 @lang('site.sales_invoices_payments')
 @endsection
@section('content')

@component('backend.partials._pagebar')

    <li class="breadcrumb-item"><a href="{{ route('dashboard.sales.index') }}">  @lang('site.sales_list')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.payment_list')</span></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('dashboard.sales.show',$invoiceData->id ) }}">{{ $invoiceData->reference_no }}</a></li>

@endcomponent

@include('backend.partials._errors')

@include('backend.sales.payments.create')

<div class="row layout-top-spacing" id="cancel-row">

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> @lang('site.code') </th>

                        <th> @lang('site.date')</th>
                        <th> @lang('site.amount')</th>
                        <th> @lang('site.pay_type')</th>

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

                        <td>

                              <a  data-pay-id="{{ $row->id }}" class="mr-2 showPaymentInfo" data-toggle="modal" data-target="#exampleModal{{ $row->id }}">
                                <i class="fa fa-search fa-lg text-info"></i>
                              </a>
                              <div class="modal fade" id="exampleModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $row->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel{{ $row->id }}">@lang('site.show_payment')</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive receive-data">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> <strong> X </strong></button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                                <form action="{{route('dashboard.sales-payments.destroy', $row->id)}}" method="POST" style="display:inline-block">
                                    @csrf
                                 @method('delete')
                                <a type="submit" class="mr-2 text-danger fa-lg show_confirm" title="@lang('site.delete')"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
<script>
$( document ).ready(function() {


    $( ".showPaymentInfo" ).click(function(event) {
      //  event.preventDefault();

        var paymentId =  $(this).attr("data-pay-id");
       alert(paymentId);
        if(paymentId != null){

           $.ajax({
                url: "{{ url('dashboard/sales-payments/payments/') }}"+'/'+paymentId,
                type:"GET",
                success: function (data) {
                    $('.receive-data').html(data);

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
            }); // end of ajax

        }else{

            alert('please select click on payament ');

        }


    });

    $(".modal").on("hidden.bs.modal", function(){
        $(".receive-data").html("");
    });


});

</script>


@endpush

