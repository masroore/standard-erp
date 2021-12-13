@extends('layouts.dashboard.app')
@php
$lang = LaravelLocalization::getCurrentLocale();
@endphp

@section('title')
@lang('site.employee')
@endsection
@section('modelTitlie')

@endsection
@section('content')

<div id="alert" class="alert alert-light-success border-0 mb-4 d-none" role="alert"style="width: 20%;
position: fixed;
z-index: 10000;
top: 3px;
right: 18px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    </button>
    <strong>@lang('site.done')</strong>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
</div>
<div class="row layout-top-spacing">
    <div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing pb-0">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area p-0 d-flex">
                <nav class="breadcrumb-one p-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.tickets.index') }}"> @lang('site.tickets')</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>@lang('site.ticket_details')</span>
                        </li>

                    </ol>
                </nav>

                <div class="p-2 w-20 d-flex position-absolute " style="right: 0;" >
                    <select class="form-control mr-2" id="status" name="status">
                        <option value="open" {{ ($ticket->status == 'open') ? 'selected' : '' }}>@lang('site.open')</option>
                        <option value="pending" {{ ($ticket->status == 'pending') ? 'selected' : '' }}>@lang('site.pending')</option>
                        <option value="resolved" {{ ($ticket->status == 'resolved') ? 'selected' : '' }}>@lang('site.resolved')</option>
                        <option value="closed" {{ ($ticket->status == 'closed') ? 'selected' : '' }}>@lang('site.closed')</option>
                    </select>
                    <select  class="form-control" id="priority"  name="priority">
                        <option value="low" {{ ($ticket->priority == 'low') ? 'selected' : '' }}>@lang('site.low')</option>
                        <option value="medium" {{ ($ticket->priority == 'medium') ? 'selected' : '' }}>@lang('site.medium')</option>
                        <option value="high" {{ ($ticket->priority == 'high') ? 'selected' : '' }}>@lang('site.high')</option>
                        <option value="urgent" {{ ($ticket->priority == 'urgent') ? 'selected' : '' }}> @lang('site.urgent')</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>


@include('backend.partials._errors')

<div class="layout-px-spacing">

    <div class="row layout-spacing ">

        <!-- Content -->

        <div class=" col-md-8 col-sm-12 layout-top-spacing  p-0">



            <div class="bio layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="">{{ $ticket->subject }}</h3>

                    <div class="bio-skill-box p-0">

                        <div class="row">

                            <div class="col-12">
                                <h6>Description</h6>
                                <div class="data pl-4">testtetete</div>
                                <div class="mt-3">
                                    <h6>Attachments ({{ $ticket->ticketAttachments->count() }})</h6>

                                            @foreach ($ticket->ticketAttachments as $key => $attachment)

                                            <a href="{{asset('public/'.$attachment->link)}}"
                                                class="btn btn-sm btn-primary  btn-rounded bs-popover mt-3" target="_blank"
                                                rel="noopener noreferrer"> @lang('site.file') {{ $key + 1 }}
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 15px"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                                            </a>
                                            @endforeach

                                </div>

                                <hr>
                                 @foreach ($ticket->ticketReplies as $replay)

                                    <div class="col-12 mb-3">

                                        <div class="">
                                            <div class="d-flex">
                                                <span class="avatar-title">{{ ucfirst(substr($replay->user->name,0,1)) }}</span>
                                                <div class="p-2 d-flex">
                                                    <h5>{{ $replay->user->name }}</h5>
                                                    <p class="ml-2">
                                                        {{ Carbon\Carbon::parse($replay->created_at)->diffForHumans()}}
                                                    </p>
                                                </div>

                                            </div>


                                            <div class=" ml-5 p-2">
                                                <p style="word-break: break-all;">{{ $replay->reply_content }}</p>
                                                @if ( isset($replay->replyAttachments->reply_id) &&
                                                $replay->replyAttachments->reply_id > 0)

                                                <a href="{{asset('public/'.$replay->replyAttachments->link)}}"
                                                    class="btn btn-primary btn-sm  btn-rounded bs-popover mt-3" target="_blank"
                                                    rel="noopener noreferrer"> @lang('site.file')
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 15px"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                                                </a>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                            @endforeach
                            <hr>


                                <form action="{{ route('dashboard.tickets.replay.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                                    <div class="d-flex">
                                        <input type="file" name="file" class="form-control-file" id="mail_File_attachment" >
                                    </div>

                                    <div class="form-grop mt-2">
                                        <textarea  name="reply_content" class="form-control"></textarea>
                                    </div>

                                    <div class="form-grop m-2">
                                        <button class="btn btn-primary">@lang('site.add_comment')</button>
                                    </div>
                                </form>

                            </div>






                        </div>

                    </div>

                </div>
            </div>

        </div>

        <div class=" col-md-4 col-sm-12 layout-top-spacing  pr-0">


            <div class="education layout-spacing " id="div-status">
                <div class="widget-content widget-content-area" >
                    <h3 class="">@lang('site.ticket_details')</h3>
                    <div class="timeline-alter">

                        <div class="item-timeline">
                            <div class="t-meta-date">
                                <p class="">@lang('site.status')</p>
                            </div>
                            <div class="t-dot">
                            </div>
                            <div class="t-text">
                                <p>{{ $ticket->status }}</p>

                            </div>
                        </div>
                        <div class="item-timeline">
                            <div class="t-meta-date">
                                <p class="">@lang('site.priority')</p>
                            </div>
                            <div class="t-dot">
                            </div>
                            <div class="t-text">
                                <p>{{ $ticket->priority }}</p>

                            </div>
                        </div>
                        <div class="item-timeline">
                            <div class="t-meta-date">
                                <p class="">@lang('site.start_at')</p>
                            </div>
                            <div class="t-dot">
                            </div>
                            <div class="t-text">
                                <p>{{ $ticket->start_at }}</p>
                            </div>
                        </div>
                        <div class="item-timeline">
                            <div class="t-meta-date">
                                <p class="">@lang('site.customer')</p>
                            </div>
                            <div class="t-dot">
                            </div>
                            <div class="t-text">
                                <p>{{ $ticket->customer->name }}</p>

                            </div>
                        </div>


                        <div class="item-timeline">
                            <div class="t-meta-date">
                                <p class="">@lang('site.department')</p>
                            </div>
                            <div class="t-dot">
                            </div>
                            <div class="t-text">
                                <p> {{ ($lang == 'ar') ? $ticket->department->name_ar : $ticket->department->name_en }}</p>

                            </div>
                        </div>
                        <div class="item-timeline">
                            <div class="t-meta-date">
                                <p class="">@lang('site.assignee')</p>
                            </div>
                            <div class="t-dot">
                            </div>
                            <div class="t-text">
                                <p class="">
                                    @foreach ($ticket->users as $key => $user)

                                    {{ $user->name }} ,

                                    @endforeach
                                </p>
                            </div>
                        </div>
                        @if ($ticket->moved->count() > 0)

                        <div class="item-timeline">
                            <div class="t-meta-date">
                                <p class="">@lang('site.ticket_moved')</p>
                            </div>
                            <div class="t-dot">
                            </div>
                            <div class="t-text">
                                <p class="">
                                    @foreach ($ticket->moved as $key => $user)

                                        {{ $user->name }} ,

                                    @endforeach
                                </p>
                            </div>
                        </div>
                        @endif


                    </div>
                </div>
            </div>
            <div class="education layout-spacing ">
                <div class="widget-content widget-content-area">

                    <div class="timeline-alter">



                            <button  class="btn btn-block btn-primary"  data-toggle="modal" data-target="#exampleModal">
                                <i _ngcontent-psa-c208="" nz-icon="" nztype="export" nztheme="outline"
                                    class="anticon anticon-export"><svg viewBox="64 64 896 896" focusable="false"
                                        fill="currentColor" width="1em" height="1em" data-icon="export"
                                        aria-hidden="true">
                                        <path
                                            d="M888.3 757.4h-53.8c-4.2 0-7.7 3.5-7.7 7.7v61.8H197.1V197.1h629.8v61.8c0 4.2 3.5 7.7 7.7 7.7h53.8c4.2 0 7.7-3.4 7.7-7.7V158.7c0-17-13.7-30.7-30.7-30.7H158.7c-17 0-30.7 13.7-30.7 30.7v706.6c0 17 13.7 30.7 30.7 30.7h706.6c17 0 30.7-13.7 30.7-30.7V765.1c0-4.3-3.5-7.7-7.7-7.7zm18.6-251.7L765 393.7c-5.3-4.2-13-.4-13 6.3v76H438c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h314v76c0 6.7 7.8 10.5 13 6.3l141.9-112a8 8 0 000-12.6z">
                                        </path>
                                    </svg>
                                </i>
                                <span class="ng-star-inserted">@lang('site.move_ticket') </span>
                            </button>
                            @include('backend.tickets.move_ticket')

                            <form action="{{route('dashboard.tickets.destroy', $ticket->id)}}" method="POST" >
                                @csrf
                             @method('delete')
                             <button  type="submit" class="btn btn-block btn-outline-danger show_confirm mt-1">
                                <i _ngcontent-psa-c208="" nz-icon="" nztype="delete" nztheme="outline"
                                     class="anticon anticon-delete"><svg viewBox="64 64 896 896" focusable="false"
                                         fill="currentColor" width="1em" height="1em" data-icon="delete"
                                         aria-hidden="true">
                                         <path
                                             d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z">
                                         </path>
                                     </svg>
                                 </i>
                                 <span class="ng-star-inserted"> @lang('site.delete_ticket')! </span>
                             </button>

                          </form>








                    </div>
                </div>
            </div>


        </div>


    </div>
</div>


@endsection


@push('css')

<style>
    .CodeMirror{
        height: 200px !important;
        min-height: 200px !important;
    }

    .avatar-title {
        border-radius: 12px;
        position: relative;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 42px;
        width: 42px;
        background-color: #bae7ff;
        color: #2196f3;
    }
</style>

<link href="{{ asset('public/backend/crock/assets/css/structure.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/backend/crock/assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('public/backend/crock/plugins/editors/markdown/simplemde.min.css') }}">
@endpush
@push('js')
<script>
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
     $(".basic").select2({
        tags: true,
        dropdownParent: $("#exampleModal"),
    });
    var f1 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
    });
</script>
<script src="{{ asset('public/backend/crock/plugins/editors/markdown/simplemde.min.js') }}"></script>
<script src="{{ asset('public/backend/crock/plugins/editors/markdown/custom-markdown.js') }}"></script>

{{-- $("#app-notification__title").load(window.location.href + " #app-notification__title"); --}}

<script>
    $('#status').change(function() {
        var ticket_id = "{{$ticket->id}}";
        var status = $(this).val();
        $.ajax({
            url: "{{ route('dashboard.tickets.updateStatus') }}",
            type: "post",
            data: {"_token": "{{ csrf_token() }}",ticket_id:ticket_id,status:status} ,
            success: function (response) {
                $('#alert').removeClass("d-none");
                $("#div-status").load(window.location.href + " #div-status");

            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }
        });

    });
    $('#priority').change(function() {
        var ticket_id = "{{$ticket->id}}";
        var priority = $(this).val();
        $.ajax({
            url: "{{ route('dashboard.tickets.updatePriority') }}",
            type: "post",
            data: {"_token": "{{ csrf_token() }}",ticket_id:ticket_id,priority:priority} ,
            success: function (response) {
                $('#alert').removeClass("d-none");
                $("#div-status").load(window.location.href + " #div-status");

            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }
        });

    });
</script>

@endpush


