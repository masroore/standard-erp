@extends('layouts.dashboard.app')
@php
$lang = LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
@lang('site.ticket')
@endsection
@section('modelTitlie')
@lang('site.ticket')
@endsection
@section('content')
<div class="layout-px-spacing">

    <div class="row layout-spacing">

        <!-- Content -->
        <div class=" col-md-6 row col-sm-12 layout-top-spacing h-100 ">

            @foreach ($ticketReplies as $replay )

            <div class="widget-content widget-content-area p-3 col-md-12 mt-5 card">
                <div class="d-flex">
                    <h4>{{ $replay->user->name }}</h4>
                    <p class="text-right w-100">
                        {{ Carbon\Carbon::parse($replay->created_at)->diffForHumans()}}
                    </p>
                </div>
                <hr>

                <p>{{  $replay->reply_content }}</p>
                @if ( isset($replay->replyAttachments->reply_id) &&     $replay->replyAttachments->reply_id > 0)

                    <a href="{{asset('public/'.$replay->replyAttachments->link)}}" class="btn btn-primary rounded bs-popover mt-3" style="width:15%" target="_blank" rel="noopener noreferrer"> @lang('site.file')</a>
                @endif

            </div>
            @endforeach

        </div>
        <div class=" col-md-6 row col-sm-12 layout-top-spacing    h-100">

            <div class="widget-content widget-content-area p-3 col-md-12  m-5 card">
                    <h4>@lang('site.add_replay')</h4>
                    <hr>

                <form action="{{ route('dashboard.tickets.replay.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $ticket_id }}">
                    <div class="custom-file-container mb-5" data-upload-id="mySecondImage">
                        <label class="custom-file-container__custom-file" >
                            <input type="file" name="file" class="custom-file-container__custom-file__custom-file-input" >
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                    </div>

                    <div class="form-group ">


                        <label for="percent">@lang('site.description')</label>

                        <textarea  type="text" name="reply_content"  class="form-control" required></textarea>

                    </div>

                    <button type="submit" class="btn btn-primary mt-3">@lang('site.save')</button>
                </form>

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


    var secondUpload = new FileUploadWithPreview('mySecondImage');
    var f1 = flatpickr(document.getElementById('basicFlatpickr'));




</script>


@endpush
