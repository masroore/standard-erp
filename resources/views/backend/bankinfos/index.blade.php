@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
       @lang('site.bankinfos')
@endsection
@section('modelTitlie')
    @lang('site.bankinfos')
 @endsection
@section('content')

@component('backend.partials._pagebar')

<li class="breadcrumb-item"><a href="javascript:void(0);">  @lang('site.bankinfos')</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>  @lang('site.bankinfos_list')</span></li>

@endcomponent

<div class="row layout-top-spacing" id="cancel-row">
    <div class="col-md-5"></div>
    <div class="col-md-2">
        <a href="{{route('dashboard.bankinfos.create')}}" class="btn btn-primary center">@lang('site.add_bankinfos')</a>
    </div>

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.beneficiary_name')</th>
                        <th>@lang('site.bank_name')</th>
                        <th>@lang('site.bank_branch')</th>
                        <th>@lang('site.beneficiary_account')</th>
                        <th class="no-content">@lang('site.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $key => $row)


                    <tr>
                        <td>{{$key+1}}</td>


                        <td>{{$row->beneficiary_name}}</td>
                        <td>{{$row->beneficiary_bank_name}}</td>
                        <td>{{$row->beneficiary_bank_branch}}</td>
                        <td>{{$row->beneficiary_account_no}}</td>


                        <td>
                              <a href="{{route('dashboard.bankinfos.show', $row->id)}}" class="btn btn-info" title="@lang('site.show')"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                              <a href="{{route('dashboard.bankinfos.edit', $row->id)}}" class="btn btn-warning" title="@lang('site.edit')"> <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <form action="{{ route('dashboard.bankinfos.destroy' , $row->id) }}" method="post" style="display:inline-block">
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
              title: @if($lang == 'ar') ` هل انت متأكد سوف يتم الحذف   !!` @else  `Are you sure you want to delete this bankinfo ?` @endif,
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
