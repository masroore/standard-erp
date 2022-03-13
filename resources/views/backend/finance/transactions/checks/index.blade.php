@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
    @lang('site.checks')
@endsection
 @section('modelTitlie')
        @lang('site.checks')
 @endsection
@section('content')

@component('backend.partials._pagebar')

<li class="breadcrumb-item"><a href="javascript:void(0);">  @lang('site.transactions')</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>  @lang('site.checks')</span></li>

@endcomponent

@include('backend.partials._errors')


<div class="row layout-top-spacing" id="cancel-row">

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> @lang('site.due_date')</th>
                        <th> @lang('site.created_date')</th>
                        <th> @lang('site.bank') </th>
                        <th> @lang('site.belong')</th>
                        <th> @lang('site.amount')</th>
                        <th> @lang('site.check_number')</th>
                        <th> @lang('site.status')</th>

                        <th class="no-content"> @lang('site.notes')</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($rows as $key => $row)


                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                <p class="align-self-center mb-0 ">{{ $row->due_date }} </p>
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                <p class="align-self-center mb-0"> {{ $row->release_date }}</p>
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                <p class="align-self-center mb-0">{{ $row->bank->title_en ?? '' }}</p>
                            </div>
                        </td>





                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                <p class="align-self-center mb-0">
                                    {{ $row->belong_to }} :
                                    @if ($row->belong_to == 'customer')
                                        {{ $row->customer->company_name ?? '' }}
                                    @elseif ($row->belong_to == 'supplier')
                                        {{ $row->supplier->company_name ?? '' }}
                                    @endif

                                </p>
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                <p class="align-self-center mb-0 ">{{ $row->amount }} </p>
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                <p class="align-self-center mb-0 ">{{ $row->check_number }} </p>
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                @if ($row->status == 0)
                                <span class="shadow-none badge badge-warning">@lang('site.pending')</span>
                                <button type="button" class="btn-xs show-modal-invoice  modali" style="background-color: #fafafa !important; border:none" data-toggle="modal"
                                 data-target="#exampleModal_{{ $row->id }}" title="@lang('site.edit')"> <i class="fa fa-edit"></i>
                                </button>
                                @include('backend.finance.transactions.checks.change_status')
                                @elseif ($row->status == 1)
                                <span class="shadow-none badge badge-success">@lang('site.paid')</span>
                                @elseif ($row->status == 2)
                                <span class="shadow-none badge badge-danger">@lang('site.bounced')</span>
                                @endif
                            </div>
                        </td>

                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                <p class="align-self-center mb-0"> {{ $row->notes }}</p>
                            </div>
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

