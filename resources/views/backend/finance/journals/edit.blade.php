@extends('layouts.dashboard.app')

@php $lang =  LaravelLocalization::getCurrentLocale(); @endphp

@section('title') @lang('site.journal entries') @endsection

@section('modelTitlie') @lang('site.journal entries') @endsection

@section('content')

@component('backend.partials._pagebar')

    <li class="breadcrumb-item"><a href="{{ route('dashboard.'. $routeName .'.index') }}">@lang('site.journal entries list') </a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.edit_journal')</span></li>

@endcomponent



  <!--  BEGIN CONTENT AREA  -->

  @include('backend.partials._errors')


        <div class=" invoice layout-top-spacing layout-spacing">
            <div class="invoice-content">

                <div class="invoice-detail-body">

                    <form action="{{ route('dashboard.'. $routeName .'.update',$jornal->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                    <h3 class="text-center">  @lang('site.edit_journal') </h3>
                    <div class="invoice-detail-terms">

                        <div class="row justify-content-between">

                            <div class="col-md-3">

                                <div class="form-group mb-4">
                                    <label for="number">@lang('site.code')</label>
                                    <input type="text" class="form-control form-control-sm" value="{{ $jornal->ref }}" name="ref" id="number">
                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-group mb-4">
                                    <label for="date">@lang('site.date')</label>

                                    <input type="text" class="form-control form-control-sm" value="{{ $jornal->date }}" name="date" id="date" placeholder="{{ $jornal->date }}">
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="form-group mb-4">
                                    <label for="number">@lang('site.document')</label>
                                    <input type="file" class="form-control form-control-sm" name="attachment" id="due" placeholder="None">
                                    @if ($jornal->attachment)
                                    <span class="badge badge-info"> <a href="{{ asset('public/uploads/journals/'.$jornal->attachment) }}" download="" title="@lang('site.download')"> <i class="fa fa-arrow-down"></i> </a></span>
                                    @endif
                                </div>

                            </div>




                        </div>

                    </div>


                    <div class="invoice-detail-items">

                        <div class="table-responsive">
                            <table class="table table-bordered item-table">
                                <thead>
                                    <tr>
                                        <th class=""></th>
                                        <th>@lang('site.select account')</th>
                                        <th class="">@lang('site.credit')</th>
                                        <th class="">@lang('site.debit')</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jornal->items as $item )
                                    <tr>
                                        <div>
                                            <td class="delete-item-row">
                                                <ul class="table-controls">
                                                    <li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>
                                                </ul>
                                            </td>

                                            <td class="description" >
                                                <input type="hidden" id="1">
                                                <select class="form-control  basic " name="account_id[]">
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"  {{ (isset($jornal) && $item->account_id  == $category->id) ? 'selected' : '' }}>{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                                                    @foreach ($category->childrenCategories as $childCategory)
                                                        @include('backend.finance.journals.child_account', ['child_category' => $childCategory])
                                                    @endforeach
                                                @endforeach

                                                </select>
                                            </td>

                                            <td class="rate">

                                                <input type="number" id="credit_1" class="form-control form-control-sm changesNo" value="{{ $item->credit }}" name="credit[]" placeholder="@lang('site.amount')">
                                            </td>
                                            <td class="text-right qty">
                                                <input type="number" id="debit_1" class="form-control form-control-sm changesNo"  value="{{ $item->debit }}" name="debit[]" placeholder="@lang('site.amount')">
                                            </td>
                                        </div>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <button type="button" class="btn btn-secondary additem btn-sm">@lang('site.add item')</button>

                    </div>

                    {{-- total --}}
                    <div class="totals-row mt-3">
                        <div class="invoice-totals-row invoice-summary-subtotal mt-2">

                            <div class="invoice-summary-label"> @lang('site.total_credit')</div>

                            <div class="invoice-summary-value">
                                <div class="subtotal-amount">
                                   <span class="amount" id="cridtot">{{ $jornal->items()->sum('credit') }}</span>
                                </div>
                            </div>

                        </div>



                        <div class="invoice-totals-row invoice-summary-total mt-2">

                            <div class="invoice-summary-label">@lang('site.total_debit')</div>

                            <div class="invoice-summary-value">
                                <div class="total-amount">
                                   <span class="amount" id="debittot">{{ $jornal->items()->sum('debit') }}</span>
                                </div>
                            </div>

                        </div>


                        <div class="invoice-totals-row invoice-summary-balance-due">

                            <div class="invoice-summary-label">@lang('site.difference')</div>

                            <div class="invoice-summary-value">
                                <div class="balance-due-amount">
                                    <span  class="amount" id="defftot">{{ $jornal->items()->sum('credit') - $jornal->items()->sum('debit')}}</span>
                                </div>
                            </div>

                        </div>
                    </div>



                    <div class="invoice-detail-note">

                        <div class="row">

                            <div class="col-md-12 align-self-center">

                                <div class="form-group row invoice-note">
                                    <label for="invoice-detail-notes" class="col-sm-12 col-form-label col-form-label-sm">@lang('site.journal description')</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="details" id="invoice-detail-notes"  style="height: 88px;">{{$jornal->details}}</textarea>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="text-right m-5">
                        <button type="submit" class="btn btn-primary mb-2">@lang('site.save')</button>

                    </div>
                </form>

                </div>

            </div>
        </div>

<!--  END CONTENT AREA  -->


@endsection
@push('js')
@if ($lang == 'ar')
<script src="{{asset('public/backend/crock/rtl/assets/js/apps/journal.js') }}"></script>
@else
<script src="{{asset('public/backend/crock/assets/js/apps/journal.js') }}"></script>
@endif

<script>
    $(document).ready(function(){

        var html = '<tr>'+
            '<td class="delete-item-row">'+
                '<ul class="table-controls">'+
                    '<li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>'+
                '</ul>'+
                '</td>'+
                `<td class="description">

                    <select class="form-control  basic"  name="account_id[]">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                            @foreach ($category->childrenCategories as $childCategory)
                                @include('backend.finance.journals.child_account', ['child_category' => $childCategory])
                            @endforeach
                        @endforeach

                    </select>
                </td>`+
                '<td class="rate">'+
                    '<input type="number" class="form-control changesNo form-control-sm"  name="credit[]" placeholder="@lang('site.amount')">'+
            ' </td>'+
                '<td class="text-right qty"><input type="number"  class="form-control changesNo form-control-sm" name="debit[]" placeholder="@lang('site.amount')"></td>'+

                '</tr>';
            document.getElementsByClassName('additem')[0].addEventListener('click', function() {
            //console.log('dfdf')

            getTableElement = document.querySelector('.item-table');
            currentIndex = getTableElement.rows.length;

            $(".item-table tbody").append(html);
            $('.basic').select2();
            deleteItemRow();

            });

            $(document).on('change keyup blur','.changesNo',function(){

                calculateTotal();
            });



            function calculateTotal(){
                sumcrdit=0;
                sumdebit=0;
                deff    =0;
                $("input[name^='credit']").each(function(){
                    sumcrdit+=Number($(this).val());
                });
                $("#cridtot").text(sumcrdit);

                $("input[name^='debit']").each(function(){
                    sumdebit+=Number($(this).val());
                });
                $("#debittot").text(sumdebit);

                deff = sumcrdit - sumdebit ;
                $("#defftot").text(deff);

            }

            $("form").submit(function(e){
               if(sumcrdit != sumdebit){
                   alert('القيد غير متزن')
                   e.preventDefault();
               }
            });
    });
</script>


@endpush

