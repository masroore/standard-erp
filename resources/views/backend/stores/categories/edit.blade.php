@extends('layouts.dashboard.app')
@php 
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
        {{ $lang == 'ar' ? '  تعديل التصنيف' : ' Edit Category ' }}
@endsection
 @section('modelTitlie')
        {{ $lang == 'ar' ? ' التصنيفات ' : 'Categories ' }}
 @endsection
@section('content')

 
<div class="row layout-top-spacing">
    <div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <nav class="breadcrumb-one p-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                        <li class="breadcrumb-item"><a href="{{route('dashboard.categories.index')}}"> {{ $lang == 'ar' ? ' التصنيفات ' : 'Categories ' }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>{{ $lang == 'ar' ? '  تعديل التصنيف' : ' Edit Category ' }}</span></li>
                       
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="row ">
    <div id="flFormsGrid" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>{{$lang == 'ar' ? 'الرجاء ادخال البيانات الاتية' : ' Please Fill User Data '}}</h4>
                    </div>                                                                        
                </div>
            </div>
            <div class="widget-content widget-content-area p-3">
                <form action="{{ route('dashboard.categories.update',$row->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    @include('backend.partials._errors')
                    <div class="form-group">
                        <select class="form-control nested select2" name="parent_id" >
                            <option value="0" {{ $row->parent_id == 0 ? 'selected'  : '' }} >{{$lang == 'ar' ? 'تصنيف رئيسي' : 'No Parent'}}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $row->parent_id == $category->id ? 'selected'  : '' }}>{{$lang == 'ar' ? $category->title_ar: $category->title_en}}</option>
                                @foreach ($category->childrenCategories as $childCategory)
                                    @include('backend.stores.categories.child_category', ['child_category' => $childCategory])
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <input  type="text" name="title_ar" value="{{ $row->title_ar }}" class="form-control" required>
                       
                    </div>
    
                    <div class="form-group">
                        <input type="text" name="title_en" value="{{ $row->title_en }}" class="form-control" required>
                    </div>
    
                    <button type="submit" class="btn btn-primary mt-3">{{$lang == 'ar' ? ' حفظ ' : 'Save  '}}</button>
                </form>

            </div>
        </div>
    </div>
</div>



@endsection


@push('css')
    <style>
       
        .select2-dropdown{
            z-index:1050 !important;
        }

        
    </style>
@endpush

@push('js')
<script type="text/javascript">
    $(".nested").select2({
        tags: true
    });  
</script>
@endpush





