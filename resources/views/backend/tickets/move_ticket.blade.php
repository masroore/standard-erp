

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> @lang('site.add_new_ticket')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('site.close')">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <form action="{{route('dashboard.tickets.moveTicket')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

            <div class="modal-body row">
                <div class="form-group col-md-12">
                    <label for="">@lang('site.move_type')</label>

                    <div class="n-chk">
                        <label class="new-control new-radio radio-primary">
                          <input type="radio" value="internal" class="new-control-input" name="move_type" >
                          <span class="new-control-indicator"></span>@lang('site.internal')
                        </label>
                        <label class="new-control new-radio radio-primary">
                            <input type="radio" class="new-control-input" value="external" name="move_type" checked>
                            <span class="new-control-indicator"></span>@lang('site.external')
                          </label>
                    </div>
                </div>

                <div class="form-group col-md-12">

                    <div class="users d-none">
                        <label for="percent">@lang('site.assign_to')</label>
                        <select class="form-control  basic"  multiple id="user">
                            @foreach ($users as $user)
                                <option   option value="{{ $user->id }}" >{{$user->name}}</option>

                            @endforeach
                        </select>
                    </div>




                </div>
                <div class="form-group col-md-12">

                    <label for="percent">@lang('site.move_date')</label>
                    <input  type="date-time" id="dateTimeFlatpickr" name="move_date"  class="form-control" required>

                </div>


            <div class="form-group col-md-12">

                <label for="percent">@lang('site.description')</label>

                <textarea  type="text" id="demo1" name="move_description"  class="form-control" ></textarea>

            </div>






            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> @lang('site.cancel')</button>
                <button type="submit" class="btn btn-primary">@lang('site.save')</button>
            </div>
            </form>
        </div>
    </div>
</div>

@push('js')
    <script>
        $('input[type=radio][name=move_type]').change(function() {
            if (this.value == 'internal') {
                $('#user').attr('name','users[]');
                $('.users').removeClass('d-none');

            }
            else if (this.value == 'external') {
                $('#user').removeAttr('name');
                $('.users').addClass('d-none');

            }
        });
    </script>
@endpush
