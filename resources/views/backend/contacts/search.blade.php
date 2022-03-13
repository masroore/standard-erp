@php
	$lang =  LaravelLocalization::getCurrentLocale();
@endphp

@foreach ($rows as $row)

<div class="items">
    <div class="item-content">
        <div class="user-profile">
            <div class="n-chk align-self-center text-center">
                <label class="new-control new-checkbox checkbox-primary">
                <input type="checkbox" class="new-control-input contact-chkbox">
                <span class="new-control-indicator"></span>
                </label>
            </div>
            @php
                (isset($row->photo))? $image = 'public/'.$row->photo : $image ='public/uploads/customers/photos/default.png';
            @endphp
            <img width="90" height="90" src="{{asset($image)}}" alt="avatar">


            <div class="user-meta-info">
                <p class="user-name" data-name="Alan Green">{{ $row->name }}</p>
                <p class="user-work" data-occupation="Web Developer">{{ $row->position }}</p>
            </div>
        </div>
        <div class="user-phone">
            <p class="info-title">@lang('site.department') : </p>
            <p class="usr-email-addr" data-email="{{ $row->department }}">{{ $row->department }}</p>
        </div>
        <div class="user-phone">
            <p class="info-title">@lang('site.email'): </p>
            <p class="usr-email-addr" data-email="{{ $row->email }}">{{ $row->email }}</p>
        </div>

        <div class="user-location">
            <p class="info-title">@lang('site.address'): </p>
            <p class="usr-location" data-location="Boston, USA">{{ $row->address }}</p>
        </div>
        <div class="user-phone">
            <p class="info-title">@lang('site.whatsapp') : </p>
            <p class="usr-email-addr" data-email="{{ $row->whatsapp_number }}">{{ $row->whatsapp }}</p>
        </div>
        <div class="user-phone">
            <p class="info-title">@lang('site.phone'): </p>
            @foreach (json_decode($row->phone) as $phone)

            <p class="usr-ph-no" style="display: contents;" data-phone="{{ $phone }}">{{ $phone }} , </p>
            @endforeach

        </div>

        <div class="action-btn">

                    <a href="{{ $row->facebook }}" target="_blank" rel="noopener noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>

                    </a>
                    <a href="{{ $row->twiter }}" target="_blank" rel="noopener noreferrer">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter twiter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
            </a>

                <a href="{{ $row->linkedin }}" target="_blank" rel="noopener noreferrer">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
            </a>


    </div>
        <div class="action-btn">

      @include('backend.contacts.edit')


            <form action="{{ route('dashboard.contacts.destroy' , $row->id) }}" method="post" style="display:inline-block">
                @csrf
                @method('delete')
            <svg type="submit" xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-minus twiter show_confirm"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="23" y1="11" x2="17" y2="11"></line></svg>

              </form>
        </div>
    </div>
</div>
@endforeach
