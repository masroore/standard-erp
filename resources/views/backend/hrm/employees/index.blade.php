@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
        @lang('site.employee')
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
                        <li class="breadcrumb-item"><a href="javascript:void(0);"> @lang('site.employee')</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span> @lang('site.employee_list')</span></li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="row layout-top-spacing" id="cancel-row">
    <div class="col-md-5"></div>
    <div class="col-md-5">
        <a href="{{route('dashboard.employees.create')}}" class="btn btn-primary center">
            <i class="fa fa-plus"></i> @lang('site.add_new_employee')</a>
    </div>

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>

                        <th>@lang('site.name')</th>
                        <th>@lang('site.phone')</th>
                        <th>@lang('site.email')</th>
                        <th>@lang('site.department')</th>
                        <th>@lang('site.date_of_joining')</th>
                        <th>@lang('site.status')</th>
                        <th>@lang('site.action')</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $key => $employee)


                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="sorting_1 sorting_2">
                            <div class="d-flex">
                                <a href="{{ route('dashboard.employees.profile',$employee->id) }}" class="d-flex">

                                <div class="usr-img-frame mr-2 rounded-circle">
                                    @if($employee->photo != null)
                                    <img alt="avatar" class="img-fluid rounded-circle" src="{{asset('public/'.$employee->photo)}}">
                                    @else
                                    <img alt="avatar" class="img-fluid rounded-circle" src="{{asset('public/img/avatar.png')}}">
                                    @endif

                                </div>
                                <p class="align-self-center mb-0 admin-name"> {{$employee->name}} </p>
                            </a>

                            </div>
                        </td>

                        <td>{{$employee->phone}}</td>
                        <td>{{$employee->email}}</td>
                        <td>
                            {{($lang=='ar') ? $employee->department_ar : $employee->department_en}}
                        </td>
                        <td>{{$employee->date_of_joining}}</td>

                        <td>
                            @if ($employee->status == 1)
                            <span class="badge badge-success"> @lang('site.active') <i class="fa fa-check" aria-hidden="true"></i> </span>
                            @else
                            <span class="badge badge-danger"> @lang('site.inactive') <i class="fa fa-times" aria-hidden="true"></i> </span>
                            @endif
                        </td>


                        <td>
                              <a href="{{route('dashboard.employees.edit', $employee->id)}}" class="btn btn-warning" title="@lang('site.edit')"> <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <form action="{{ route('dashboard.employees.destroy' , $employee->id) }}" method="POST" style="display:inline-block">
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
              title: @if($lang == 'ar') ` هل انت متأكد سوف يتم حذف هذا المستخدم !!` @else  `Are you sure you want to delete this user ?` @endif,
              text:  @if($lang == 'ar') "اذا قمت بحذف هذا المستخدم لم تتمكن من استعادته مره اخري" @else  "If you delete this, it will be gone forever." @endif,
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

