@extends('layouts.dashboard.app')

@php $lang =  LaravelLocalization::getCurrentLocale(); @endphp

@section('title') @lang('site.account list') @endsection

@section('modelTitlie') @lang('site.accounts') @endsection

@section('content')

@component('backend.partials._pagebar')

    <li class="breadcrumb-item"><a href="{{ route('dashboard.finance.'. $routeName .'.index') }}">@lang('site.accounts') </a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.account list')</span></li>

@endcomponent


<div class="row layout-top-spacing">

    <div id="treeviewAnimated" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <span class="h4 p-4 mr-2">@lang('site.account list')</span><a class="btn btn-primary" title="@lang('site.create account')" href="{{route('dashboard.finance.accounts.create')}}"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area p-3">


                <ul class="file-tree">
                    @foreach ($categories  as $category)


                    <li class="file-tree-folder">{{ $lang == 'ar' ? $category->title_ar  : $category->title_en}}

                        @if(count($category->childrenCategories))
                        <ul>
                            @foreach ($category->childrenCategories as $childCategory)
                            @include('backend.finance.accounts.account_tree', ['child_category' => $childCategory])


                            @endforeach
                        </ul>
                        @endif


                    </li>

                    @endforeach
                </ul>



            </div>
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



