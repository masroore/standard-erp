@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
        @lang('site.invoices')
@endsection
 @section('modelTitlie')

 @endsection
@section('content')


<div class="row layout-top-spacing">
    <div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <nav class="breadcrumb-one p-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('site.invoices')</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.list_invoices')</span></li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="row layout-top-spacing" id="cancel-row">
    <div class="col-md-5"></div>
    <div class="col-md-2">
        <a href="{{route('dashboard.invoices.create')}}" class="btn btn-primary center">@lang('site.create_new_invoice')</a>
    </div>

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                            <th>#</th>
                            <th>@lang('site.name') </th>
                            <th >@lang('site.permissions')</th>
                            <th >@lang('site.user_count') </th>
                            <th class="no-content">@lang('site.action')</th>


                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($roles as $key => $role)


                    <tr>
                        <td>{{$key+1}}</td>


                        <td>{{$role->name}}</td>
                        <td  @if($role->permissions->count()>0) style="display: contents;"@endif>
                                @foreach ($role->permissions as $permission)
                                <span class=" badge badge-primary m-1"> {{ $permission->name }} </span>
                            @endforeach

                        </td>
                        <td class="text-center"> <span class=" badge badge-success ">{{$role->users_count}}</span></td>


                        <td>
                              <a href="{{route('dashboard.roles.edit', $role->id)}}" class="btn btn-warning" title="{{$lang == 'ar' ? ' تعديل' : ' Edit '}}"> <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <form action="{{ route('dashboard.roles.destroy' , $role->id) }}" method="post" style="display:inline-block">
                                    @csrf
                                    @method('delete')

                                <button type="submit" class="mr-2 btn btn-danger show_confirm" title="{{$lang == 'ar' ? 'حذف ' : 'Delete  '}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                              </form>
                        </td>
                    </tr>

                    @endforeach --}}

                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.name') </th>
                        <th >@lang('site.permissions')</th>
                        <th >@lang('site.user_count') </th>
                        <th class="no-content">@lang('site.action')</th>

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
              title: @if($lang == 'ar') ` هل انت متأكد سوف يتم حذف هذا الدور !!` @else  `Are you sure you want to delete this role ?` @endif,
              text:  @if($lang == 'ar') "اذا قمت بحذف هذا الدور لم تتمكن من استعادته مره اخري" @else  "If you delete this, it will be gone forever." @endif,
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

