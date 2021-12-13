<div class="text-center">
    <button type="button" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#exampleModal">
        @lang('site.add_new')
    </button>
</div>

{{-- handel add new --}}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> @lang('site.add_new_medical')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('site.close')">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <form action="{{route('dashboard.medicals.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <div class="row">

                        <div class="form-group col-12">

                            <label for="percent">@lang('site.employee')</label>

                            <select class="form-control basic" name="employee_id">
                                <option value="">---</option>

                                @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>

                                @endforeach

                            </select>
                        </div>


                    </div>
                    <div class="row">

                        <table border="1" style="border: 1px solid #dedede;" width="100%">
                            <tbody>
                                <tr>
                                    <td class="col-sm-6 text-center" style="padding: 50px 20px;">
                                        <h4 class="addition_title">Addition</h4><br>
                                        <table id="add">
                                            <tbody>
                                                <tr>
                                                    <th class="padten">Basic</th>
                                                    <td><input type="number" id="basic" name="basic"
                                                            class="form-control" disabled="" autocomplete="off"></td>
                                                </tr>
                                                @foreach ($salaryType as $item)
                                                    @if ($item->type == 'add' )

                                                    <tr>
                                                        <th class="padten">{{ $item->benefits }}<span class="percent"
                                                                style="display: none;">(%)<span></span></span></th>
                                                        <td><input type="number" name="amount[1]"
                                                                class="form-control addamount"
                                                                onkeyup="salarySetupsummary()" id="add_0"
                                                                autocomplete="off" min="1"></td>
                                                    </tr>
                                                    @endif

                                                @endforeach


                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="col-sm-6 text-center" style="padding: 50px 20px;">
                                        <h4 class="addition_title">Deduction</h4><br>
                                        <table id="dduct">
                                            <tbody>

                                            @foreach ($salaryType as $item)
                                            @if ($item->type == 'deduct' )

                                            <tr>
                                                <th class="padten">{{ $item->benefits }}<span class="percent"
                                                        style="display: none;">(%)<span></span></span></th>
                                                <td><input type="number" name="amount[1]"
                                                        class="form-control addamount"
                                                        onkeyup="salarySetupsummary()" id="add_0"
                                                        autocomplete="off"></td>
                                            </tr>
                                            @endif

                                        @endforeach
                                                <tr>
                                                    <th class="padten">Tax<span class="percent"
                                                            style="display: none;">(%)<span></span></span></th>
                                                    <td><input type="number" name="amount[]"
                                                            onkeyup="salarySetupsummary()"
                                                            class="form-control deducamount" id="taxinput"
                                                            autocomplete="off"></td>
                                                    <td class="padten"><input type="checkbox" name="tax_manager"
                                                            id="taxmanager" onchange="handletax(this);" value="1"
                                                            autocomplete="off">Tax Manager</td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </td>



                                </tr>
                            </tbody>
                        </table>

                    </div>



                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i
                            class="flaticon-cancel-12"></i>@lang('site.cancel')</button>
                    <button type="submit" class="btn btn-primary">@lang('site.save')</button>
                </div>
            </form>
        </div>
    </div>
</div>
