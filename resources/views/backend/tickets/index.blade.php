@extends('layouts.dashboard.app')
@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
        @lang('site.ticket')
@endsection
 @section('modelTitlie')
        @lang('site.ticket')
 @endsection
@section('content')


<div class="row layout-top-spacing">
    <div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <nav class="breadcrumb-one p-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);"> @lang('site.ticket')</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.ticket_list')</span></li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@include('backend.partials._errors')

@include('backend.tickets.create')


<div class="row layout-top-spacing" id="cancel-row">


    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
        <table id="zero-config" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>

                        <th>@lang('site.subject')</th>
                        <th>@lang('site.start_at')</th>
                        {{-- <th>@lang('site.department')</th> --}}
                        <th>@lang('site.customer')</th>
                        <th>@lang('site.priority')</th>
                        <th>@lang('site.status')</th>
                        <th>@lang('site.action')</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $key => $row)


                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="sorting_1 sorting_2"> {{$row->subject}} </td>


                        <td>
                          {{ $row->start_at }}
                        </td>
                        {{-- <td>{{($lang == 'ar')? $row->department->name_ar : $row->department->name_en}}</td> --}}
                        <td>{{$row->customer->name}}</td>
                        <td> <span class="badge badge-primary">{{$row->priority}}</span></td>
                        <td>
                            @if ($row->status == 'open')
                            <span class="badge badge-success"> @lang('site.open')  </span>
                            @elseif($row->status == 'pending')
                            <span class="badge badge-warning"> @lang('site.pending')  </span>

                            @elseif($row->status == 'resolved')
                            <span class="badge badge-info"> @lang('site.resolved') <i class="fa fa-check" aria-hidden="true"></i> </span>

                            @elseif($row->status == 'closed')
                            <span class="badge badge-danger"> @lang('site.closed') <i class="fa fa-times" aria-hidden="true"></i> </span>
                            @endif
                        </td>


                        <td>
                          {{-- <a href="{{route('dashboard.tickets.replay', $row->id)}}" class="mr-2 btn btn-success " title="@lang('site.replay')"><i class="fa fa-reply-all"></i></a> --}}
                          <a href="{{route('dashboard.tickets.show', $row->id)}}" class="mr-2 btn btn-info " title="@lang('site.show')"><i class="fa fa-eye"></i></a>

                            {{-- @include('backend.tickets.edit') --}}
                            <form action="{{route('dashboard.tickets.destroy', $row->id)}}" method="POST" style="display:inline-block">
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


    $(".basic1").select2({
        tags: true,
        dropdownParent: $("#exampleModal"),
    });
    $(".basic2").select2({
        tags: true,
        dropdownParent: $("#exampleModal"),
    });


    $(".basic3").select2({
        tags: true,
        dropdownParent: $("#exampleModal"),
    });


    $(".basic4").select2({
        tags: true,
        dropdownParent: $("#exampleModal"),
    });


    var secondUpload = new FileUploadWithPreview('mySecondImage');
    var f1 = flatpickr(document.getElementById('basicFlatpickr'));




</script>


@endpush

