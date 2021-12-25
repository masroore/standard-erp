@extends('layouts.dashboard.app')

@php $lang =  LaravelLocalization::getCurrentLocale(); @endphp

@section('title') @lang('site.journal entries list') @endsection

@section('modelTitlie') @lang('site.journal entries') @endsection

@section('content')

@component('backend.partials._pagebar')

    <li class="breadcrumb-item"><a href="{{ route('dashboard.'. $routeName .'.index') }}">@lang('site.journal entries') </a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.journal entries list')</span></li>

@endcomponent


<div class="row layout-top-spacing" id="cancel-row">
    <div class="col-md-5"></div>
    <div class="col-md-2 mb-3">
        <a href="{{route('dashboard.journals.create')}}" class="btn btn-primary center">@lang('site.add_new')</a>
    </div>

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.date')</th>
                        <th>@lang('site.code')</th>
                        <th>@lang('site.description')</th>
                        <th>@lang('site.created_by')</th>
                        <th>@lang('site.file')</th>
                        <th class="no-content">@lang('site.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $key => $row)


                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="sorting_1 sorting_2">

                                <p class="align-self-center mb-0 admin-name"> {{$row->date}} </p>
                            </div>
                        </td>

                        <td>{{$row->ref}}</td>
                        <td>{{$row->details}}</td>
                        <td>{{ $row->journal->name }}</td>
                        <td><span class="badge badge-info"> <a href="{{ asset('public/uploads/journals/'.$row->attachment) }}" download="" title="@lang('site.download')"> <i class="fa fa-arrow-down"></i> </a></span></td>


                        <td>
                           @include('backend.finance.journals.show')
                              <a href="{{route('dashboard.journals.edit', $row->id)}}" class="btn btn-warning" title="@lang('site.edit')"> <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <form action="{{ route('dashboard.journals.destroy' , $row->id) }}" method="post" style="display:inline-block">
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
