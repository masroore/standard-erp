

    <script>

        $(document).ready(function(){

            // search for item  by ajax request
            $(".search").keyup(function(){
                var value =$(this).val();
                var id =$(this).attr('id');

                    $.ajax({
                        type: 'get',
                        url: "{{ url('dashboard/'. $routeName .'/search/') }}"+'/'+value+'/'+id,
                        success: function (data) {
                            $('.content-search'+id).html(data);

                            },
                        error: function(data_error, exception) {
                            if(exception == 'error'){
                                var error_list = '' ;
                                $.each(data_error.responseJSON.errors, function(index,v){
                                    error_list += '<li>'+v+'</li>';
                                });
                                $('.alert-errors ul').html(error_list)
                            }
                        }
                    });
            });

            // add new row
            $('.additem').on('click', function(event) {
                event.preventDefault();
                var id = parseInt($(this).attr('id')) + 1;

                getTableElement = document.querySelector('.item-table');
                currentIndex = getTableElement.rows.length;

                $html = `<tr>
                            <td class="delete-item-row">
                                <ul class="table-controls">
                                    <li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>
                                </ul>
                            </td>

                            <td class="description">
                                <input type="hidden" name="item_id[]"  class=" form-control form-control-sm search item_id`+id+`" placeholder="@lang('site.item')" autocomplete="off">
                                <input type="text" id="`+id+`" class=" form-control form-control-sm search title`+id+`" placeholder="@lang('site.item')" autocomplete="off">
                                <div class="content-search`+id+`"></div>
                            </td>

                            <td class="description">

                                <input type="number" id="quantity_`+id+`"  name="qty[]"  min="1" class="form-control changesNo form-control-sm qty`+id+`"  placeholder="@lang('site.qty')">

                            </td>

                            <td class="description">

                                <div class="form-group">
                                    <select id="unit`+id+`" class="form-control form-control-sm "  name="purchase_unit_id[]" >
                                        <option  disabled selected>@lang('site.seleect_unit')</option>
                                        @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}" >{{$unit->unit_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>

                        </tr>`;

                $(".item-table tbody").append($html);
                $(this).attr('id',id);
                deleteItemRow();

            // search for item  by ajax request
            $(".search").keyup(function(){

                var value =$(this).val();
                var id =$(this).attr('id');
                    $.ajax({
                        type: 'get',
                        url: "{{ url('dashboard/'. $routeName .'/search/') }}"+'/'+value+'/'+id,
                        success: function (data) {
                            $('.content-search'+id).html(data);

                            },
                        error: function(data_error, exception) {
                            if(exception == 'error'){
                                var error_list = '' ;
                                $.each(data_error.responseJSON.errors, function(index,v){
                                    error_list += '<li>'+v+'</li>';
                                });
                                $('.alert-errors ul').html(error_list)
                            }
                        }
                    });
            });


        });


        });

    $(".tagging").select2({
    tags: true
    });
    </script>


