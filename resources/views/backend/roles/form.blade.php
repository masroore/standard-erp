<div class="form-row mb-4">
    <div class="form-group col-md-12">
        <label for="">{{$lang == 'ar' ? 'الاسم' : ' Name '}}</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', isset($row) ? $row->name : '')}}"  placeholder="{{$lang == 'ar' ? 'الاسم' : ' Name '}}" required>
    </div>

</div>

<div class="n-chk m-2">

<label class="new-control new-checkbox new-checkbox-rounded checkbox-primary">

    <input type="checkbox"  class="new-control-input " id="checkAll" value=""  >
    <span class="new-control-indicator"></span>@lang('site.select_all_permissions')

  </label>
</div>

            <table class="table table-hover">
                <thead>
                    <th style="width:5%">#</th>
                    <th style="width:15%">@lang('site.model')</th>
                    <th style="width:80%">@lang('site.permissions')</th>
                    <th> </th>
                </thead>
                <tbody>

                    @php
                        $models = [ 'users','roles','finAccount','finJournal','finSetting'] ;
                    @endphp

                    @foreach($models as $index=>$model )
                    <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $model }}</td>
                    <td>

                        @php
                            $permissions_maps = ['all','create', 'read',  'update', 'delete'];
                        @endphp
                       @foreach ($permissions_maps as $key => $permissions_map)
                           <label class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
                             <input type="checkbox"  class="new-control-input {{($permissions_map == 'all') ? 'checkAll' : '' }} {{ $model }}"  id="{{$model}}" value="{{ $permissions_map . '_' . $model}}"  {{($permissions_map == 'all') ? '' : 'name=permissions[]' }}  {{ isset($row) && $row->hasPermission($permissions_map . '_' . $model)? 'checked' : '' }}>
                             <span class="new-control-indicator"></span>{{  $permissions_map   }}
                           </label>
                           {{-- <option value="{{ $permissions_map . '_' . $model}}" {{ isset($row) && $row->hasPermission($permissions_map . '_' . $model)? 'selected' : '' }} > --}}

                       @endforeach
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


@push('js')
<script>
    $(".checkAll").click(function(){
      var model =  $(this).attr('id');
    //   alert(key);
    $('.'+model).not(this).prop('checked', this.checked);
    });
    $("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>

@endpush
